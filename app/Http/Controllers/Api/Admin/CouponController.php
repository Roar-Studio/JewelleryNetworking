<?php

namespace App\Http\Controllers\Api\Admin;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\{Auth, Response, Crypt, Hash, Storage};
use Yajra\DataTables\Facades\DataTables;
use Carbon\Carbon;
use App\Models\{User, membershipPlan, Event, Coupon};
use Illuminate\Support\Str;
use Illuminate\Database\QueryException;
use DB;
use Log;

class CouponController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Deactivate expired coupons
        $a = Coupon::where('is_deleted', 0)
            ->where('is_active', 1)
            ->where('end_date', '<=', Carbon::yesterday())
            ->update(['is_active' => 0]);
        
        $validator = \Validator::make($request->all(), [
            'search_key' => 'nullable|string|max:300',  
            'status' => 'nullable|in:0,1',
        ]);
        if ($validator->passes()) {

            $data = Coupon::select(
                'coupons.id',  
                'coupons.coupon_code',
                'coupons.coupon_name',
                'coupons.coupon_type',
                'coupons.start_date',
                'coupons.end_date',
                'coupons.is_active',
            )->where('is_deleted', 0);

            if ($request->filled('is_active')) {
                $data->Where('is_active', $request->is_active);
            }   

            if ($request->filled('date_from')) {
                $startDate = Carbon::createFromFormat('d/m/Y', $request->date_from)->startOfDay();
                $data->where('start_date', '>=', $startDate);
            }
            
            if ($request->filled('date_to')) {
                $endDate = Carbon::createFromFormat('d/m/Y', $request->date_to)->addDay()->startOfDay();
                $data->where('start_date', '<', $endDate);
            }

            //search function
            if ($request->filled('search_key')) {
                $searchKey = $request->search_key;
            
                $data->where(function ($query) use ($searchKey) {
                    $query->where('coupons.coupon_code', 'LIKE', "%$searchKey%")
                        ->orWhere('coupons.coupon_name', 'LIKE', "%$searchKey%")
                        ->orWhere('coupons.description', 'LIKE', "%$searchKey%");
                });
            }
            
            
            

            return DataTables::of($data)
                    ->addColumn('responsive_id', function ($row){
                        return '';
                    })
                    ->make(true);
        }
        return response()->json([
            'status' => 'error',
            'message' => 'Validation failed',
            'data' => $validator->errors()
        ], 422);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'coupon_name' => 'required|string|max:25',
            'coupon_code' => 'required|string|max:10',
            'marketing_text' => 'required|string|max:20',
        
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
        
            'coupon_type' => 'required|in:generic,user_specific,membership,event,special',
            'membership_type' => 'required_if:coupon_type,membership|nullable|string',
            'event_type' => 'required_if:coupon_type,event|nullable|string',
            'user_specific' => 'required_if:coupon_type,user_specific|nullable|array',
        
            'discount_type' => 'required|in:flat,percent',
        
            'discount_flat_inr' => 'required_if:discount_type,flat|nullable|numeric|min:0|max:999999',
            'discount_flat_usd' => 'required_if:discount_type,flat|nullable|numeric|min:0|max:999999',
        
            'discount_percent_inr' => 'required_if:discount_type,percent|nullable|numeric|min:0|max:999999',
            'discount_percent_usd' => 'required_if:discount_type,percent|nullable|numeric|min:0|max:999999',
        
            'maximum_discount_inr' => 'required_if:discount_type,percent|nullable|numeric|min:0|max:999999',
            'maximum_discount_usd' => 'required_if:discount_type,percent|nullable|numeric|min:0|max:999999',

            'minimum_purchase_inr' => 'required_if:discount_type,flat|nullable|numeric|min:0|max:999999',
            'minimum_purchase_usd' => 'required_if:discount_type,flat|nullable|numeric|min:0|max:999999',
        
            'max_use_per_user' => 'nullable|numeric|max:99',
        
            'is_active' => 'required|in:0,1'
        ], [
            'coupon_name.required' => 'Please enter the coupon name.',
            'coupon_name.max' => 'Coupon name must not exceed 25 characters.',
        
            'coupon_code.required' => 'Please enter the coupon code.',
            'coupon_code.max' => 'Coupon code must not exceed 10 characters.',
        
            'marketing_text.required' => 'Please enter the marketing text.',
            'marketing_text.max' => 'Marketing text must not exceed 20 characters.',
        
            'start_date.required' => 'Start date is required.',
            'start_date.date' => 'Start date must be a valid date.',
        
            'end_date.required' => 'End date is required.',
            'end_date.date' => 'End date must be a valid date.',
            'end_date.after_or_equal' => 'End date must be same or after start date.',
        
            'coupon_type.required' => 'Please select coupon type.',
        
            'membership_type.required_if' => 'Please select a membership type for this coupon.',
            'event_type.required_if' => 'Please select an event type for this coupon.',
            'user_specific.required_if' => 'Please select users for this coupon.',
        
            'discount_type.required' => 'Please select discount type.',
        
            'discount_flat_inr.required_if' => 'Please enter flat discount (INR).',
            'discount_flat_inr.numeric' => 'Flat discount (INR) must be a number.',
            'discount_flat_inr.max' => 'Flat discount (INR) must not exceed 6 digits.',
        
            'discount_flat_usd.required_if' => 'Please enter flat discount (USD).',
            'discount_flat_usd.numeric' => 'Flat discount (USD) must be a number.',
            'discount_flat_usd.max' => 'Flat discount (USD) must not exceed 6 digits.',
        
            'discount_percent_inr.required_if' => 'Please enter percent discount (INR).',
            'discount_percent_inr.numeric' => 'Percent discount (INR) must be a number.',
            'discount_percent_inr.max' => 'Percent discount (INR) must not exceed 6 digits.',
        
            'discount_percent_usd.required_if' => 'Please enter percent discount (USD).',
            'discount_percent_usd.numeric' => 'Percent discount (USD) must be a number.',
            'discount_percent_usd.max' => 'Percent discount (USD) must not exceed 6 digits.',
        
            'maximum_discount_inr.required_if' => 'Please enter max discount limit (INR).',
            'maximum_discount_inr.numeric' => 'Max discount limit (INR) must be a number.',
            'maximum_discount_inr.max' => 'Max discount limit (INR) must not exceed 6 digits.',
        
            'maximum_discount_usd.required_if' => 'Please enter max discount limit (USD).',
            'maximum_discount_usd.numeric' => 'Max discount limit (USD) must be a number.',
            'maximum_discount_usd.max' => 'Max discount limit (USD) must not exceed 6 digits.',

            'minimum_purchase_inr.required_if' => 'Please enter min purchase limit (INR).',
            'minimum_purchase_inr.numeric' => 'Min purchase limit (INR) must be a number.',
            'minimum_purchase_inr.max' => 'Min purchase limit (INR) must not exceed 6 digits.',
        
            'minimum_purchase_usd.required_if' => 'Please enter min purchase limit (USD).',
            'minimum_purchase_usd.numeric' => 'Min purchase limit (USD) must be a number.',
            'minimum_purchase_usd.max' => 'Min purchase limit (USD) must not exceed 6 digits.',
        
            'max_use_per_user.numeric' => 'Max use per user must be a number.',
            'max_use_per_user.max' => 'Max use per user must not exceed 2 digits.',
        
            'status.required' => 'Please select coupon status.',
            'status.in' => 'Invalid status value.'
        ]);
        
        

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Validation failed',
                'data' => $validator->errors()
            ], 422);
        }
        $couponCodeExists = Coupon::where('coupon_code', $request->coupon_code)->exists();

        // Return response
        if ($couponCodeExists) {
            return response()->json([
                'status' => false,
                'message' => 'Coupon code already exists.',
            ], 409);
        }
        if($request->discount_type == 'flat' && ($request->discount_flat_inr >= $request->minimum_purchase_inr || $request->discount_flat_usd >= $request->minimum_purchase_usd)){
            return response()->json([
                'status' => false,
                'message' => 'Discounted amount should be less than Minimum purchase amount',
            ], 422);
        }


        try {
            DB::beginTransaction();

            $coupon = new Coupon();
            $coupon->coupon_name = $request->coupon_name;
            $coupon->coupon_code = $request->coupon_code;
            $coupon->marketing_text = $request->marketing_text;
            $coupon->start_date = $request->start_date;
            $coupon->end_date = $request->end_date;
            $coupon->coupon_type = $request->coupon_type;
            $coupon->membership_type = $request->membership_type;
            $coupon->event_type = $request->event_type;
            $coupon->user_specific = json_encode($request->user_specific);

            $coupon->discount_type = $request->discount_type;
            if($request->discount_type == 'flat'){
                $coupon->discount_flat_inr = $request->discount_flat_inr;
                $coupon->discount_flat_usd = $request->discount_flat_usd;
                $coupon->minimum_purchase_inr = $request->minimum_purchase_inr;
                $coupon->minimum_purchase_usd = $request->minimum_purchase_usd;
            }
            elseif($request->discount_type == 'percent'){
                $coupon->discount_percent_inr = $request->discount_percent_inr;
                $coupon->discount_percent_usd = $request->discount_percent_usd;
                $coupon->maximum_discount_inr = $request->maximum_discount_inr;
                $coupon->maximum_discount_usd = $request->maximum_discount_usd;
            }
            $coupon->max_use_per_user = $request->max_use_per_user;
            $coupon->is_active = $request->is_active;
            $coupon->save();
            DB::commit();

            return response()->json([
                'status' => 'success',
                'message' => 'Coupon added successfully.',
                'data' => $coupon
            ], 200);

        } catch (QueryException $e) {
            DB::rollBack();
            // Log the SQL + bindings for debugging
            Log::error('Some Error', [
                'error' => $e->getMessage(),
                'sql' => $e->getSql(),
                'bindings' => $e->getBindings()
            ]);

            return response()->json([
                'status' => 'error',
                'message' => 'Some error occurred. Please try again.'
            ], 500);

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('General Error', ['error' => $e->getMessage()]);
            return response()->json([
                'status' => 'error',
                'message' => 'Something went wrong. Please try again later.'
            ], 500);
        }
    }



    public function show(Request $request, $id)
    {
        if (!$id) {
            return response()->json([
                'status' => 'error',
                'message' => 'Coupon ID is required in the URL.'
            ], 422);
        }

        try {
            $couponData = Coupon::findOrFail($id);           
            
            return response()->json([
                'status' => true,
                'message' => 'Coupon details retrieved successfully',
                'data' => $couponData
            ], 200);
            
        } catch (\Exception $e) {
            return response()->json([
                'error' => $e->getMessage()
            ], 500);
            return response()->json([
                'status' => 'error',
                'message' => 'Coupon not found',
            ], 404);
        }
    }

    public function update(Request $request)
    {
        $couponId = $request->coupon_id;

        
        $validator = \Validator::make($request->all(), [
            'coupon_id' => 'required|numeric',
            'coupon_name' => 'required|string|max:25',
            'coupon_code' => 'required|string|max:10',
            'marketing_text' => 'required|string|max:20',
        
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
        
            'coupon_type' => 'required|in:generic,user_specific,membership,event,special',
            'membership_type' => 'required_if:coupon_type,membership|nullable|string',
            'event_type' => 'required_if:coupon_type,event|nullable|string',
            'user_specific' => 'required_if:coupon_type,user_specific|nullable|array',

        
            'discount_type' => 'required|in:flat,percent',
        
            'discount_flat_inr' => 'required_if:discount_type,flat|nullable|numeric|min:0|max:999999',
            'discount_flat_usd' => 'required_if:discount_type,flat|nullable|numeric|min:0|max:999999',
        
            'discount_percent_inr' => 'required_if:discount_type,percent|nullable|numeric|min:0|max:999999',
            'discount_percent_usd' => 'required_if:discount_type,percent|nullable|numeric|min:0|max:999999',
        
            'maximum_discount_inr' => 'required_if:discount_type,percent|nullable|numeric|min:0|max:999999',
            'maximum_discount_usd' => 'required_if:discount_type,percent|nullable|numeric|min:0|max:999999',
        
            'max_use_per_user' => 'nullable|numeric|max:99',
        
            'is_active' => 'required|in:0,1'
        ], [
            'coupon_id.required' => 'Please enter coupon id',
            'coupon_id.numeric' => 'Coupon id must be a number.',

            'coupon_name.required' => 'Please enter the coupon name.',
            'coupon_name.max' => 'Coupon name must not exceed 25 characters.',
        
            'coupon_code.required' => 'Please enter the coupon code.',
            'coupon_code.max' => 'Coupon code must not exceed 10 characters.',
        
            'marketing_text.required' => 'Please enter the marketing text.',
            'marketing_text.max' => 'Marketing text must not exceed 20 characters.',
        
            'start_date.required' => 'Start date is required.',
            'start_date.date' => 'Start date must be a valid date.',
        
            'end_date.required' => 'End date is required.',
            'end_date.date' => 'End date must be a valid date.',
            'end_date.after_or_equal' => 'End date must be same or after start date.',
        
            'coupon_type.required' => 'Please select coupon type.',
        
            'membership_type.required_if' => 'Please select a membership type for this coupon.',
            'event_type.required_if' => 'Please select an event type for this coupon.',
            'user_specific.required_if' => 'Please select users for this coupon.',

        
            'discount_type.required' => 'Please select discount type.',
        
            'discount_flat_inr.required_if' => 'Please enter flat discount (INR).',
            'discount_flat_inr.numeric' => 'Flat discount (INR) must be a number.',
            'discount_flat_inr.max' => 'Flat discount (INR) must not exceed 6 digits.',
        
            'discount_flat_usd.required_if' => 'Please enter flat discount (USD).',
            'discount_flat_usd.numeric' => 'Flat discount (USD) must be a number.',
            'discount_flat_usd.max' => 'Flat discount (USD) must not exceed 6 digits.',
        
            'discount_percent_inr.required_if' => 'Please enter percent discount (INR).',
            'discount_percent_inr.numeric' => 'Percent discount (INR) must be a number.',
            'discount_percent_inr.max' => 'Percent discount (INR) must not exceed 6 digits.',
        
            'discount_percent_usd.required_if' => 'Please enter percent discount (USD).',
            'discount_percent_usd.numeric' => 'Percent discount (USD) must be a number.',
            'discount_percent_usd.max' => 'Percent discount (USD) must not exceed 6 digits.',
        
            'maximum_discount_inr.required_if' => 'Please enter max discount limit (INR).',
            'maximum_discount_inr.numeric' => 'Max discount limit (INR) must be a number.',
            'maximum_discount_inr.max' => 'Max discount limit (INR) must not exceed 6 digits.',
        
            'maximum_discount_usd.required_if' => 'Please enter max discount limit (USD).',
            'maximum_discount_usd.numeric' => 'Max discount limit (USD) must be a number.',
            'maximum_discount_usd.max' => 'Max discount limit (USD) must not exceed 6 digits.',

            'minimum_purchase_inr.required_if' => 'Please enter min purchase limit (INR).',
            'minimum_purchase_inr.numeric' => 'Min purchase limit (INR) must be a number.',
            'minimum_purchase_inr.max' => 'Min purchase limit (INR) must not exceed 6 digits.',
        
            'minimum_purchase_usd.required_if' => 'Please enter min purchase limit (USD).',
            'minimum_purchase_usd.numeric' => 'Min purchase limit (USD) must be a number.',
            'minimum_purchase_usd.max' => 'Min purchase limit (USD) must not exceed 6 digits.',
        
            'max_use_per_user.numeric' => 'Max use per user must be a number.',
            'max_use_per_user.max' => 'Max use per user must not exceed 2 digits.',
        
            'status.required' => 'Please select coupon status.',
            'status.in' => 'Invalid status value.'
        ]);
        

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Validation failed',
                'data' => $validator->errors()
            ], 422);
        }

        $coupon = Coupon::find($couponId);
        if (!$coupon) {
            return response()->json([
                'status' => 'error',
                'message' => 'Coupon not found'
            ], 404);
        }
        
        if($request->discount_type == 'flat' && ($request->discount_flat_inr >= $request->minimum_purchase_inr || $request->discount_flat_usd >= $request->minimum_purchase_usd)){
            return response()->json([
                'status' => false,
                'message' => 'Discounted amount should be less than Minimum purchase amount',
            ], 422);
        }

        try {
            DB::beginTransaction();

            $coupon->coupon_name = $request->coupon_name;
            $coupon->coupon_code = $request->coupon_code;
            $coupon->marketing_text = $request->marketing_text;
            $coupon->start_date = $request->start_date;
            $coupon->end_date = $request->end_date;
            $coupon->coupon_type = $request->coupon_type;
            $coupon->membership_type = $request->membership_type;
            $coupon->event_type = $request->event_type;
            $coupon->user_specific = $request->user_specific;

            $coupon->discount_type = $request->discount_type;
            if($request->discount_type == 'flat'){
                $coupon->discount_flat_inr = $request->discount_flat_inr;
                $coupon->discount_flat_usd = $request->discount_flat_usd;
                $coupon->minimum_purchase_inr = $request->minimum_purchase_inr;
                $coupon->minimum_purchase_usd = $request->minimum_purchase_usd;
            }
            elseif($request->discount_type == 'percent'){
                $coupon->discount_percent_inr = $request->discount_percent_inr;
                $coupon->discount_percent_usd = $request->discount_percent_usd;
                $coupon->maximum_discount_inr = $request->maximum_discount_inr;
                $coupon->maximum_discount_usd = $request->maximum_discount_usd;
            }
            $coupon->max_use_per_user = $request->max_use_per_user;
            $coupon->is_active = $request->is_active;

            $coupon->save();

            DB::commit();

            return response()->json([
                'status' => 'success',
                'message' => 'Coupon updated successfully.',
                'data' => $coupon
            ], 200);
        } catch (QueryException $e) {
            DB::rollBack();

            Log::error('Database Error while updating coupon', [
                'error'    => $e->getMessage(),
                'sql'      => $e->getSql(),
                'bindings' => $e->getBindings(),
            ]);

            return response()->json([
                'status'  => 'error',
                'message' => 'Database error occurred. Please try again.'
            ], 500);

        } catch (\Exception $e) {
            DB::rollBack();

            Log::error('General Error while updating coupon', [
                'error' => $e->getMessage()
            ]);

            return response()->json([
                'status'  => 'error',
                'message' => 'Something went wrong. Please try again later.'
            ], 500);
        }

    }

    public function removeCoupon(Request $request, $id)
    {
        if (!$id) {
            return response()->json([
                'status' => 'error',
                'message' => 'Sponsor ID is required in the URL.'
            ], 422);
        }

        try {
            $coupon = Coupon::findOrFail($id);
            $coupon->is_deleted = 1;
            $coupon->save();

            return response()->json([
                'status' => true,
                'message' => 'Coupon deleted successfully',
            ], 200);

        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Coupon not found',
            ], 404);

        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'An error occurred: ' . $e->getMessage(),
            ], 500);
        }
    }

    public function checkValidCouponCode(Request $request)
    {
        $request->validate([
            'coupon_code' => 'required|string|max:100',
        ]);

        $couponCodeExists = Coupon::where('coupon_code', $request->coupon_code)->exists();

        // Return response
        if ($couponCodeExists) {
            return response()->json([
                'status' => false,
                'message' => 'Coupon code already exists.',
            ]);
        }

        return response()->json([
            'status' => true,
            'message' => 'Coupon code is available.',
        ]);
    }

}
