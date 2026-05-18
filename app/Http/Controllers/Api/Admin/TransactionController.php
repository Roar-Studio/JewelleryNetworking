<?php

namespace App\Http\Controllers\Api\Admin;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\{Auth, Response, Crypt, Hash, Storage};
use Yajra\DataTables\Facades\DataTables;
use Carbon\Carbon;
use App\Models\{User, Customer, membershipPlan, TransactionDetail};
use Illuminate\Support\Str;
use Illuminate\Database\QueryException;
use DB;
use Log;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'search_key' => 'nullable|string|max:300',
            'status' => 'nullable|in:pending,completed,failed,refunded',
            'service' => 'nullable|in:membership,event'
        ]);

        if (!$validator->passes()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Validation failed',
                'data' => $validator->errors()
            ], 422);
        }

        $query = TransactionDetail::select(
            'transaction_details.*',
            'customers.first_name as customer_name',
            'customers.mobile_no as mobile_no',
            'customers.mobile_no_cc as mobile_no_cc',
            'customers.plan_type as plan_type'
        )
        ->leftJoin('customers', 'transaction_details.customer_id', '=', 'customers.id');

        if ($request->filled('status')) {
            $query->where('transaction_details.status', $request->status);
        }
        if ($request->filled('service_name')) {
            $serviceType = $request->service_name;
            if ($serviceType === 'Membership') {
                $query->where('transaction_details.transactionable_type', 'App\Models\MembershipPlan');
            } elseif ($serviceType === 'Event') {
                $query->where('transaction_details.transactionable_type', 'App\Models\Event');
            }
        }
        if ($request->filled('date_from')) {
            $startDate = Carbon::createFromFormat('d/m/Y', $request->date_from)->startOfDay();
            $query->where('transaction_details.transaction_date', '>=', $startDate);
        }
        
        if ($request->filled('date_to')) {
            $endDate = Carbon::createFromFormat('d/m/Y', $request->date_to)->addDay()->startOfDay();
            $query->where('transaction_details.transaction_date', '<=', $endDate);
        }

        if ($request->filled('search_key')) {
            $searchKey = $request->search_key;
            $query->where(function ($q) use ($searchKey) {
                $q->where('transaction_details.transaction_id', 'LIKE', "%$searchKey%")
                ->orWhere('transaction_details.total_amount', 'LIKE', "%$searchKey%")
                ->orWhere('transaction_details.order_id', 'LIKE', "%$searchKey%")
                ->orWhere('customers.first_name', 'LIKE', "%$searchKey%")
                ->orWhere('customers.last_name', 'LIKE', "%$searchKey%")
                ->orWhere('customers.mobile_no', 'LIKE', "%$searchKey%");
            });
        }

        return DataTables::eloquent($query)
            ->addColumn('membership_id', function ($row) {
                $prefix = match ((int)$row->plan_type) {
                    1 => 'F',
                    2 => 'S',
                    3 => 'P',
                    default => 'X',
                };
                if($prefix != 'X'){
                    return $prefix . str_pad($row->customer_id, 6, '0', STR_PAD_LEFT);
                }
                else{
                    return '';
                }
            })
            ->orderColumn('customer_name', function ($query, $order) {
                $query->orderBy('customers.first_name', $order);
            })
            ->orderColumn('mobile_no', function ($query, $order) {
                $query->orderBy('customers.mobile_no', $order);
            })
            ->toJson();
    }



    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'name' => 'required|string|min:3|max:50|regex:/^[A-Za-z.\s_-]+$/',
            'description' => 'nullable|string|max:500',
            'event_datetime' => 'required|date_format:Y-m-d H:i:s',
            'venue_address' => 'nullable|string|max:255',
            'google_maps_link' => 'nullable|url|max:255',
            'total_seats' => 'nullable|integer|min:1',
            'display_start_date_submit' => 'nullable|date|date_format:Y-m-d',
            'display_end_date_submit' => 'nullable|date|date_format:Y-m-d|after_or_equal:display_start_date_submit',
            'is_active' => 'nullable|in:0,1',
            'banner' => ['nullable', 'string', function ($attribute, $value, $fail) {
                if (!preg_match('/^data:image\/(jpeg|png|jpg|gif|webp);base64,/', $value)) {
                    return $fail('The event banner must be a valid base64 encoded image.');
                }

                $sizeInBytes = (int)(strlen(rtrim($value, '=')) * 3 / 4);
                if ($sizeInBytes > 2 * 1024 * 1024) {
                    return $fail('The event banner must not exceed 2MB.');
                }
            }]
        ], [
            'name.required' => 'Please enter event name.',
            'name.regex' => 'Only letters, spaces, dots (.), underscores (_) and hyphens (-) are allowed.',
            'name.min' => 'Event name must be at least 3 characters.',
            'name.max' => 'Event name must not exceed 50 characters.',

            'description.max' => 'Description must not exceed 500 characters.',
            'event_datetime.required' => 'Event date and time is required.',
            'event_datetime.date_format' => 'Invalid datetime format. Use YYYY-MM-DD HH:MM:SS.',

            'venue_address.max' => 'Venue address should not exceed 255 characters.',
            'google_maps_link.url' => 'Please enter a valid Google Maps URL.',
            'total_seats.integer' => 'Total seat must be an integer.',
            'display_start_date.date' => 'Start date must be a valid date.',
            'display_end_date.after_or_equal' => 'End date must be same or after start date.',

            'is_active.in' => 'Is active is required'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Validation failed',
                'data' => $validator->errors()
            ], 422);
        }

        try {
            DB::beginTransaction();
        
            $event = new Event();
            $event->name = $request->name;
            $event->description = $request->description;
            $event->event_datetime = $request->event_datetime;
            $event->venue_address = $request->venue_address;
            $event->google_maps_link = $request->google_maps_link;
            $event->total_seats = $request->total_seats;
            $event->display_start_date = $request->display_start_date_submit;
            $event->display_end_date = $request->display_end_date_submit;
            $event->is_active = $request->is_active ?? 0;
            if($request->banner){
                $event->banner = Helper::storeBase64Image($request->banner, 'event_banners');
            }            
            $event->save();
            DB::commit();

            return response()->json([
                'status' => 'success',
                'message' => 'Event added successfully.',
                'data' => $event
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
                'message' => 'Transaction ID is required in the URL.'
            ], 422);
        }

        try { 
            $transactionsData = TransactionDetail::with(['transactionable', 'customer','coupon'])->select(
                'transaction_details.id',
                'transaction_details.order_id',
                'transaction_details.customer_id',
                'transaction_details.transaction_id',
                'transaction_details.payment_method',
                'transaction_details.transaction_date',
                'transaction_details.transactionable_id',
                'transaction_details.transactionable_type',
                'transaction_details.status',
                'transaction_details.total_amount',
                'transaction_details.price',
                'transaction_details.gst',
                'transaction_details.discount',
                'transaction_details.coupon_id',
                'transaction_details.payer_first_name',
                'transaction_details.payer_last_name',
                'transaction_details.payer_email',
                'transaction_details.payer_mobile_no',
                'transaction_details.payer_mobile_no_cc',
                'transaction_details.payer_taxid',
                'transaction_details.payer_company_name',
                'transaction_details.payer_company_address',
                'transaction_details.currency_type',
            )->findOrFail($id);

            
            $transactionsData->membership_id = null;
            if($transactionsData->customer){
                $prefix = match ((int)$transactionsData->customer->plan_type) {
                    1 => 'F', // Free
                    2 => 'S', // Standard
                    3 => 'P', // Premium
                    default => 'X', // fallback
                };
    
                $transactionsData->membership_id = $prefix . str_pad($transactionsData->customer->id, 6, '0', STR_PAD_LEFT); // e.g., F0001
            }
            
            return response()->json([
                'status' => true,
                'message' => 'Transaction details retrieved successfully',
                'data' => $transactionsData
            ], 200);
            
        } catch (\Exception $e) {
            return response()->json([
                'error' => $e->getMessage()
            ], 500);
            return response()->json([
                'status' => 'error',
                'message' => 'Transaction not found',
            ], 404);
        }
    }

    public function update(Request $request)
    {
        $eventId = $request->event_id;

        $validator = \Validator::make($request->all(), [
            'event_id' => 'required|numeric',
            'name' => 'required|string|min:3|max:50|regex:/^[A-Za-z.\s_-]+$/',
            'description' => 'nullable|string|max:500',
            'event_datetime' => 'required|date_format:Y-m-d H:i:s',
            'venue_address' => 'nullable|string|max:255',
            'google_maps_link' => 'nullable|url|max:255',
            'total_seats' => 'nullable|integer|min:1',
            'display_start_date_submit' => 'nullable|date|date_format:Y-m-d',
            'display_end_date_submit' => 'nullable|date|date_format:Y-m-d|after_or_equal:display_start_date_submit',
            'is_active' => 'nullable|in:0,1',
            'banner' => ['nullable', 'string', function ($attribute, $value, $fail) {
                if (!preg_match('/^data:image\/(jpeg|png|jpg|gif|webp);base64,/', $value)) {
                    return $fail('The event banner must be a valid base64 encoded image.');
                }

                $sizeInBytes = (int)(strlen(rtrim($value, '=')) * 3 / 4);
                if ($sizeInBytes > 2 * 1024 * 1024) {
                    return $fail('The event banner must not exceed 2MB.');
                }
            }]
        ], [
            'name.required' => 'Please enter event name.',
            'name.regex' => 'Only letters, spaces, dots (.), underscores (_) and hyphens (-) are allowed.',
            'name.min' => 'Event name must be at least 3 characters.',
            'name.max' => 'Event name must not exceed 50 characters.',

            'description.max' => 'Description must not exceed 500 characters.',
            'event_datetime.required' => 'Event date and time is required.',
            'event_datetime.date_format' => 'Invalid datetime format. Use YYYY-MM-DD HH:MM:SS.',

            'venue_address.max' => 'Venue address should not exceed 255 characters.',
            'google_maps_link.url' => 'Please enter a valid Google Maps URL.',
            'total_seats.integer' => 'Total seat must be an integer.',
            'display_start_date.date' => 'Start date must be a valid date.',
            'display_end_date.after_or_equal' => 'End date must be same or after start date.',

            'is_active.in' => 'Is active is required'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Validation failed',
                'data' => $validator->errors()
            ], 422);
        }

        try{
            $event = Event::find($eventId);
            if (!$event) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Event not found'
                ], 404);
            }

            if ($event->banner && Storage::exists('public/' . $event->banner)) {
                Storage::delete('public/' . $event->banner);
            }
        
            // Save new banner
            if (!empty($request->banner)) {
                $event->banner = Helper::storeBase64Image($request->banner, 'event_banners');
            }
            $event->name = $request->name;
            $event->description = $request->description;
            $event->event_datetime = $request->event_datetime;
            $event->venue_address = $request->venue_address;
            $event->google_maps_link = $request->google_maps_link;
            $event->total_seats = $request->total_seats;
            $event->display_start_date = $request->display_start_date_submit;
            $event->display_end_date = $request->display_end_date_submit;
            $event->is_active = $request->is_active ?? 0;
            $event->save();

            return response()->json([
                'status' => 'success',
                'message' => 'Event added successfully.',
                'data' => $event
            ], 200);
        
        } catch (QueryException $e) {
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
            Log::error('General Error', ['error' => $e->getMessage()]);
            return response()->json([
                'status' => 'error',
                'message' => 'Something went wrong. Please try again later.'
            ], 500);
        }

    }

}
