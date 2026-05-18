<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\{Auth, Response, Crypt, Hash};
use Yajra\DataTables\Facades\DataTables;
use Carbon\Carbon;
use App\Models\{User, MembershipPlan};
use Illuminate\Support\Str;
use Illuminate\Database\QueryException;
use DB;
use Log;

class MembershipController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'search_key' => 'nullable|string|max:300',  
            'status' => 'nullable|in:0,1',
        ]);
        if ($validator->passes()) {

            $data = MembershipPlan::select(
                'membership_plans.id',  
                'membership_plans.name',
                'membership_plans.amount_in_inr',
                'membership_plans.amount_in_usd',
                'membership_plans.duration',
                'membership_plans.description',
                'membership_plans.is_active',
            );

            if ($request->filled('is_active')) {
                $data->Where('is_active', $request->is_active);
            }   
            //search function
            if ($request->filled('search_key')) {
                $searchKey = $request->search_key;
            
                $data->where(function ($query) use ($searchKey) {
                    $query->where('membership_plans.name', 'LIKE', "%$searchKey%")
                        ->orWhere('membership_plans.amount_in_inr', 'LIKE', "%$searchKey%")
                        ->orWhere('membership_plans.amount_in_usd', 'LIKE', "%$searchKey%")
                        ->orWhere('membership_plans.duration', 'LIKE', "%$searchKey%")
                        ->orWhere('membership_plans.description', 'LIKE', "%$searchKey%");
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
            'name' => 'required|string|min:3|max:50|regex:/^[A-Za-z._\-\s]+$/',
            'amount_in_inr' =>'required|numeric|min:0',
            'amount_in_usd' =>'required|numeric|min:0',
            'duration' =>'required|numeric|min:1|max:1000',
            'description' =>'string|max:250',
        ], [
            'name.required' => 'Please enter employee name.',
            'name.regex' => 'Only alphabets, spaces, dots (.), underscores (_), and hyphens (-) are allowed.',
            'name.min' => 'Employee name should be between 3-50 characters.',
            'name.max' => 'Employee name should be between 3-50 characters.',

            'amount_in_inr.required' => 'Please enter amount.',
            'amount_in_inr.numeric' => 'Amount should be a number.',
            'amount_in_inr.min' => 'Amount should be greater than or equal to 0.',

            'amount_in_usd.required' => 'Please enter amount.',
            'amount_in_usd.numeric' => 'Amount should be a number.',
            'amount_in_usd.min' => 'Amount should be greater than or equal to 0.',

            'duration.required' => 'Please enter duration.',
            'duration.numeric' => 'Duration should be a number.',
            'duration.min' => 'Duration should be greater than or equal to 1.',
            'duration.max' => 'Duration should be less than or equal to 1000.',

            'description.max' => 'Description should be between 0-250 characters.',

        ]);        
        
        if ($validator->passes()) {
            try {
                DB::beginTransaction();

                $membership = new MembershipPlan();
                $membership->name = $request->name;
                $membership->amount_in_inr = $request->amount_in_inr;
                $membership->amount_in_usd = $request->amount_in_usd;
                $membership->duration = $request->duration;
                $membership->description = $request->description;
                $membership->benefits = $request->benefits;
                $membership->is_active = $request->boolean('is_active');
                $membership->save();
                DB::commit();

                return response()->json([
                    'status' => 'success',
                    'message' => 'Membership added successfully',
                    'data' => $membership
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
        return response()->json([
            'status' => 'error',
            'message' => 'Validation failed',
            'data' => $validator->errors()
        ], 422);
    }

    public function show(Request $request, $id)
    {
        if (!$id) {
            return response()->json([
                'status' => 'error',
                'message' => 'Plan ID is required in the URL.'
            ], 422);
        }

        try {
            $membershipData = MembershipPlan::findOrFail($id);           
            
            return response()->json([
                'status' => true,
                'message' => 'Membership details retrieved successfully',
                'data' => $membershipData
            ], 200);
            
        } catch (\Exception $e) {
            return response()->json([
                'error' => $e->getMessage()
            ], 500);
            return response()->json([
                'status' => 'error',
                'message' => 'Membership plan not found',
            ], 404);
        }
    }

    public function update(Request $request)
    {
        $membershipId = $request->membership_id;

        $validator = \Validator::make($request->all(), [
            'name' => 'required|string|min:3|max:50|regex:/^[A-Za-z._\-\s]+$/',
            'amount_in_inr' =>'required|numeric|min:0',
            'amount_in_usd' =>'required|numeric|min:0',
            'duration' =>'required|numeric|min:1|max:1000',
            'description' =>'string|max:250',
        ], [
            'name.required' => 'Please enter employee name.',
            'name.regex' => 'Only alphabets, spaces, dots (.), underscores (_), and hyphens (-) are allowed.',
            'name.min' => 'Employee name should be between 3-50 characters.',
            'name.max' => 'Employee name should be between 3-50 characters.',

            'amount_in_inr.required' => 'Please enter amount.',
            'amount_in_inr.numeric' => 'Amount should be a number.',
            'amount_in_inr.min' => 'Amount should be greater than or equal to 0.',

            'amount_in_usd.required' => 'Please enter amount.',
            'amount_in_usd.numeric' => 'Amount should be a number.',
            'amount_in_usd.min' => 'Amount should be greater than or equal to 0.',

            'duration.required' => 'Please enter duration.',
            'duration.numeric' => 'Duration should be a number.',
            'duration.min' => 'Duration should be greater than or equal to 1.',
            'duration.max' => 'Duration should be less than or equal to 1000.',

            'description.max' => 'Description should be between 0-250 characters.',

        ]);

        if ($validator->passes()) {

            try{
                $membership = MembershipPlan::find($membershipId);
                if (!$membership) {
                    return response()->json([
                        'status' => 'error',
                        'message' => 'Membership plan not found'
                    ], 404);
                }


                // Update user data
                $membership->name = $request->name;
                $membership->amount_in_inr = $request->amount_in_inr;
                $membership->amount_in_usd = $request->amount_in_usd;
                $membership->duration = $request->duration;
                $membership->description = $request->description;
                $membership->benefits = $request->benefits;
                $membership->is_active = $request->is_active;

                $membership->save();

                return response()->json([
                    'status' => 'success',
                    'message' => 'Membership plan updated successfully',
                    'data' => $membership
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

        return response()->json([
            'status' => 'error',
            'message' => 'Validation failed',
            'data' => $validator->errors()
        ], 422);
    }


    public function resumeUpdate(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'user_id' => 'required|exists:users,id',
            'resume' => 'required|file|mimes:pdf,doc,docx|max:2048',
        ],
        [
            'resume.max' => 'The file size must not exceed 2MB (2048 KB).',
        ]);
        if ($validator->passes()) {

            $user = User::findOrFail($request->user_id);

            // Initialize audit strings
            $oldValueString = '';
            $newValueString = '';

            if ($request->hasFile('resume')) {
                // Store old resume filename for audit
                $oldValueString = 'resume=' . ($user->resume ?? 'No file');

                // Handle old file deletion
                if ($user->resume) {
                    $oldFilePath = public_path('resume/' . $user->resume);
                    if (file_exists($oldFilePath)) {
                        unlink($oldFilePath);
                    }
                }

                // Process new file
                $file = $request->file('resume');
                $fileName = time() . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('resume'), $fileName);

                // Store new resume filename for audit
                $newValueString = 'resume=' . $fileName;

                // Update user record
                $user->resume = $fileName;
                $user->save();

                // Create audit log entry
                \DB::table('audit_history')->insert([
                    'page' => 'resume update',
                    'tableid' => $user->id,
                    'oldvalue' => $oldValueString,
                    'newvalue' => $newValueString,
                    'updated_by' => $request->user()->id,
                    'created_at' => now(),
                    'updated_at' => now()
                ]);
            }

            return response()->json([
                'status' => 'success',
                'message' => 'Resume updated successfully',
                'resume' => $user->resume
            ]);
        }
        return response()->json([
            'status' => 'error',
            'message' => 'Validation failed',
            'data' => $validator->errors()
        ], 422);
    }

}
