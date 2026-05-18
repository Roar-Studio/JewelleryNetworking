<?php

namespace App\Http\Controllers\Api\Admin;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\{Auth, Response, Crypt, Hash, Storage, Mail};
use Yajra\DataTables\Facades\DataTables;
use Carbon\Carbon;
use App\Models\{User, Customer, Category, MembershipPlan, TransactionDetail, MediaImage};
use App\Mail\{EventRegisteredMail, MembershipAcknowledgementMail};
use Illuminate\Support\Str;
use App\Mail\{WelcomeMail};
use Illuminate\Validation\Rule;
use Illuminate\Database\QueryException;
use DB;
use Log;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // dd($request->all());
        $validator = \Validator::make($request->all(), [
            'search_key' => 'nullable|string|max:300',  
            'joining_date' => 'nullable|date_format:d-m-Y',
            'plan_type' => 'nullable|integer',
            'status' => 'nullable|in:0,1',
        ]);
        if ($validator->passes()) {

            $data = Customer::select(
                'customers.id',  
                'customers.first_name',
                'customers.last_name',
                'customers.mobile_no',
                'customers.mobile_no_cc',
                'customers.email',
                'customers.plan_type',
                'customers.plan_started_at',
                'customers.plan_expired_at',
                'customers.is_active',
                'customers.created_at'
            )->where('is_deleted', 0);

            // Apply filters based on request parameters
            if ($request->filled('plan_type')) {
                $data->Where('plan_type', $request->plan_type);
            }
            if ($request->filled('is_active')) {
                $data->Where('is_active', $request->is_active);
            }   
            //search function
            if ($request->filled('search_key')) {
                $searchKey = $request->search_key;
            
                $data->where(function ($query) use ($searchKey) {
                    $query->where('customers.first_name', 'LIKE', "%$searchKey%")
                        ->orWhere('customers.last_name', 'LIKE', "%$searchKey%")
                        ->orWhereRaw("CONCAT(customers.first_name, ' ', customers.last_name) LIKE ?", ["%{$searchKey}%"])
                        ->orWhere('customers.mobile_no', 'LIKE', "%$searchKey%")
                        ->orWhere('customers.email', 'LIKE', "%$searchKey%");
                });
            }
            
            
            

            return DataTables::of($data)
                    ->addColumn('responsive_id', function ($row){
                        return '';
                    })
                    ->editColumn('created_at', function ($row) {
                        return \Carbon\Carbon::parse($row->created_at)->format('Y-m-d H:i:s');
                    })
                    ->addColumn('membership_id', function ($row) {
                        $prefix = match ((int)$row->plan_type) {
                            1 => 'F',
                            2 => 'S',
                            3 => 'P',
                            default => 'X',
                        };
                        if($prefix != 'X'){
                            return $prefix . str_pad($row->id, 6, '0', STR_PAD_LEFT);
                        }
                        else{
                            return '';
                        }
                    })
                    // ->addColumn('is_active', function ($row) {
                    //     return isset($row->is_active) && ($row->is_active == 0) ? "InActive" : "Active";
                    // })
                    ->toJson();
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
                'message' => 'User ID is required in the URL.'
            ], 422);
        }

        try {
            $customerData = Customer::with('membership_plan','media_images')->where('is_deleted', 0)->findOrFail($id);           
            
            return response()->json([
                'status' => true,
                'message' => 'Customer details retrieved successfully',
                'data' => $customerData
            ], 200);
            
        } catch (\Exception $e) {
            return response()->json([
                'error' => $e->getMessage()
            ], 500);
            return response()->json([
                'status' => 'error',
                'message' => 'User not found',
            ], 404);
        }
    }

    public function activityHistory(Request $request, $cust_id)
    {
        if (!$cust_id) {
            return response()->json([
                'status' => 'error',
                'message' => 'User ID is required in the URL.'
            ], 422);
        }

        try {
            $customerData = Customer::find($cust_id);
            // $transactions = $customerData->transactions; // all transactions
            
            // OR with only membership plan ones
            $membershipTransactions = $customerData->transactions()->with('transactionable')
                ->where('transactionable_type', \App\Models\MembershipPlan::class)
                ->orderBy('id', 'DESC')
                ->get();

            return response()->json([
                'status' => true,
                'message' => 'Activity retrieved successfully',
                'data' => $membershipTransactions
            ], 200);
            
        } catch (\Exception $e) {
            return response()->json([
                'error' => $e->getMessage()
            ], 500);
            return response()->json([
                'status' => 'error',
                'message' => 'User not found',
            ], 404);
        }
    }

    /* public function store(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'first_name'            => 'required|string|min:3|max:50|regex:/^[A-Za-z0-9\s.]+$/',
            'last_name'             => 'nullable|string|min:3|max:50|regex:/^[A-Za-z0-9\s.]+$/',
            'username' => [
                'required', 'string', 'min:3', 'max:50', 'regex:/^[A-Za-z0-9\s.]+$/',
                Rule::unique('customers')->where('is_deleted', 0),
            ],
            'email' => [
                'required', 'email', 'max:50',
                Rule::unique('customers')->where('is_deleted', 0),
            ],
            'mobile_no' => [
                'required', 'digits_between:7,15', 'regex:/^[6-9]\d{6,14}$/',
                Rule::unique('customers')->where('is_deleted', 0),
            ],
            'mobile_no_cc'          => 'nullable|string|max:10',
            'mobile_no_ic'          => 'nullable|string|max:5',
            'profile_photo'         => 'nullable|string',
            'company_logo'          => 'nullable|string',
            'company_video'         => 'nullable|string',
            'media_images'          => 'nullable|array',
            'media_images.*'        => 'nullable|string',
            'category_id'           => 'required|exists:categories,id',
            'company_name'          => 'nullable|string|max:50',
            'company_address'       => 'nullable|string|max:250',
            'google_map_link'       => 'nullable|url|max:255',
            'business_description'  => 'nullable|string|max:255',
            'trn_no'                => 'nullable|string|max:20',
            'website'               => 'nullable|url|max:100',
            'facebook_link'         => 'nullable|url|max:250',
            'x_link'                => 'nullable|url|max:250',
            'linkedin_link'         => 'nullable|url|max:250',
            'youtube_link'          => 'nullable|url|max:250',
            'instagram_link'        => 'nullable|url|max:250',
            'specialisation'        => 'nullable|string|max:200',
            'plan_type'             => 'nullable|in:1,2,3',
            'is_active'             => 'required|boolean',
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

            $user = new Customer();

            $fieldsToTrack = [
                'first_name', 'last_name', 'username', 'email', 'mobile_no', 'password', 'mobile_no_cc', 'mobile_no_ic',
                'trn_no', 'website', 'specialization', 'facebook_link', 'x_link', 'linkedin_link', 'youtube_link',
                'instagram_link', 'category_id', 'plan_type', 'is_active', 'company_name', 'company_address',
                'google_map_link', 'business_description'
            ];

            $oldValueString = '';
            $newValueString = '';

            foreach ($fieldsToTrack as $field) {
                $oldValue = $user->$field;
                $newValue = $request->$field;

                if ($oldValue != $newValue && $request->has($field)) {
                    $oldValueString .= "$field=" . ($oldValue ?? 'N/A') . ', ';
                    $newValueString .= "$field=" . ($newValue ?? 'N/A') . ', ';
                }
            }

            $oldValueString = rtrim($oldValueString, ', ');
            $newValueString = rtrim($newValueString, ', ');

            foreach ($fieldsToTrack as $field) {
                if ($request->has($field)) {
                    $user->$field = $request->$field;
                }
            }

            // Handle profile photo
            if (!empty($request->profile_photo)) {
                $user->profile_photo = Helper::storeBase64Image($request->profile_photo, 'profile_photo');
            }

            // ✅ Upload new company logo and video
            $user->company_logo = $request->company_logo ? Helper::storeBase64Image($request->company_logo, 'company_logo') : null;
            $user->company_video = $request->company_video ? Helper::storeBase64Video($request->company_video, 'company_video') : null;

            $user->password = Hash::make($request->password);
            $user->plan_type = 1;
            $user->save();
            DB::commit();
            // ✅ Handle media images
            if ($request->media_images && is_array($request->media_images)) {
                foreach ($request->media_images as $mediaImage) {
                    $path = Helper::storeBase64Image($mediaImage, 'media_images');

                    MediaImage::create([
                        'customer_id' => $user->id,
                        'image' => $path,
                    ]);
                }
            }

            if (!empty($oldValueString) && !empty($newValueString)) {
                \DB::table('audit_history')->insert([
                    'page' => 'edit customer',
                    'tableid' => $user->id,
                    'oldvalue' => $oldValueString,
                    'newvalue' => $newValueString,
                    'updated_by' => $request->user()->id,
                    'created_at' => now(),
                    'updated_at' => now()
                ]);
            }

            $memberShipId = "";
             $prefix = match ((int)$user->plan_type) {
                1 => 'F',
                2 => 'S',
                3 => 'P',
                default => 'X',
            };
            if($prefix != 'X'){
                $memberShipId = $prefix . str_pad($user->id, 6, '0', STR_PAD_LEFT);
            }
           
            Mail::to($user->email)->send(new WelcomeMail($user->first_name , $memberShipId));

            return response()->json([
                'status' => 'success',
                'message' => 'Customer created successfully',
                'data' => $user
            ], 200);
        } catch (QueryException $e) {
            DB::rollBack();
            // Log the SQL + bindings for debugging
            Log::error('Some Error while saving customer', [
                'error' => $e->getMessage(),
                'sql' => $e->getSql(),
                'bindings' => $e->getBindings()
            ]);

            return response()->json([
                'status' => 'error',
                'message' => 'Some error occurred while creating customer. Please try again.'
            ], 500);

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('General Error while saving customer', ['error' => $e->getMessage()]);
            return response()->json([
                'status' => 'error',
                'message' => 'Something went wrong. Please try again later.'
            ], 500);
        }
    } */


    public function store(Request $request)
    {
        $validator = \Validator::make($request->all(), [

            'first_name' =>
                'required|string|min:3|max:50|regex:/^[A-Za-z0-9\s.]+$/',

            'last_name' =>
                'nullable|string|min:3|max:50|regex:/^[A-Za-z0-9\s.]+$/',

            'username' => [
                'required','string','min:3','max:50',
                'regex:/^[A-Za-z0-9\s.]+$/',
                Rule::unique('customers')->where('is_deleted',0),
            ],

            'email' => [
                'required','email','max:50',
                Rule::unique('customers')->where('is_deleted',0),
            ],

            'mobile_no' => [
                'required',
                'digits_between:7,15',
                'regex:/^[6-9]\d{6,14}$/',
                Rule::unique('customers')->where('is_deleted',0),
            ],

            'mobile_no_cc' => 'nullable|string|max:10',
            'mobile_no_ic' => 'nullable|string|max:5',

            /*
            FILE VALIDATION
            */

            'profile_photo' =>
                'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',

            'company_logo' =>
                'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',

            'company_video' =>
                'nullable|file|mimes:mp4,webm,ogg|max:10240',

            'media_images' =>
                'nullable|array',

            'media_images.*' =>
                'image|mimes:jpeg,png,jpg,gif,webp|max:2048',

            /*
            OTHER FIELDS
            */

            'category_id' => 'required|exists:categories,id',
            'company_name' => 'nullable|string|max:50',
            'company_address' => 'nullable|string|max:250',
            'google_map_link' => 'nullable|url|max:255',
            'business_description' => 'nullable|string|max:255',
            'trn_no' => 'nullable|string|max:20',
            'website' => 'nullable|url|max:100',
            'facebook_link' => 'nullable|url|max:250',
            'x_link' => 'nullable|url|max:250',
            'linkedin_link' => 'nullable|url|max:250',
            'youtube_link' => 'nullable|url|max:250',
            'instagram_link' => 'nullable|url|max:250',
            'specialization' => 'nullable|string|max:200',
            'plan_type' => 'nullable|in:1,2,3',
            'is_active' => 'required|boolean',

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

            $user = new Customer();


            /*
            ASSIGN FIELDS
            */

            $fields = [

                'first_name',
                'last_name',
                'username',
                'email',
                'mobile_no',
                'mobile_no_cc',
                'mobile_no_ic',
                'trn_no',
                'website',
                'specialization',
                'facebook_link',
                'x_link',
                'linkedin_link',
                'youtube_link',
                'instagram_link',
                'category_id',
                'plan_type',
                'is_active',
                'company_name',
                'company_address',
                'google_map_link',
                'business_description'

            ];

            foreach ($fields as $field) {

                if ($request->has($field)) {

                    $user->$field =
                        $request->$field;
                }
            }


            /*
            PASSWORD
            */

            $user->password =
                Hash::make($request->password);

            $user->plan_type =
                $request->plan_type ?? 1;


            /*
            PROFILE PHOTO
            */

            if ($request->hasFile('profile_photo')) {

                $path =
                    $request->file('profile_photo')
                    ->store('profile_photos','public');

                $user->profile_photo = $path;
            }


            /*
            COMPANY LOGO
            */

            if ($request->hasFile('company_logo')) {

                $path =
                    $request->file('company_logo')
                    ->store('company_logos','public');

                $user->company_logo = $path;
            }


            /*
            COMPANY VIDEO
            */

            if ($request->hasFile('company_video')) {

                $path =
                    $request->file('company_video')
                    ->store('company_videos','public');

                $user->company_video = $path;
            }


            $user->save();


            /*
            MEDIA IMAGES
            */

            if ($request->hasFile('media_images')) {

                foreach ($request->file('media_images') as $media) {

                    $path =
                        $media->store('media_images','public');

                    MediaImage::create([

                        'customer_id' =>
                            $user->id,

                        'image' =>
                            $path

                    ]);
                }
            }


            DB::commit();


            /*
            MEMBERSHIP ID
            */

            $prefix = match ((int)$user->plan_type) {

                1 => 'F',
                2 => 'S',
                3 => 'P',
                default => 'X',

            };

            $memberShipId = '';

            if ($prefix != 'X') {

                $memberShipId =
                    $prefix .
                    str_pad(
                        $user->id,
                        6,
                        '0',
                        STR_PAD_LEFT
                    );
            }


            /*
            SEND EMAIL
            */

            Mail::to($user->email)->send(

                new WelcomeMail(
                    $user->first_name,
                    $memberShipId
                )

            );


            return response()->json([

                'status' => 'success',

                'message' =>
                    'Customer created successfully',

                'data' =>
                    $user

            ], 200);

        }

        catch (\Exception $e) {

            DB::rollBack();

            Log::error(
                'Customer Create Error',
                ['error' => $e->getMessage()]
            );

            return response()->json([

                'status' => 'error',

                'message' =>
                    'Something went wrong. Please try again later.'

            ], 500);
        }
    }

    /* public function update(Request $request)
    {
        $customerid = $request->user_id;

        $validator = \Validator::make($request->all(), [
            'user_id'               => 'required|exists:customers,id',
            'first_name'            => 'required|string|min:3|max:50|regex:/^[A-Za-z0-9\s.]+$/',
            'last_name'             => 'nullable|string|min:3|max:50|regex:/^[A-Za-z0-9\s.]+$/',
            'username' => [
                'required', 'string', 'min:3', 'max:50', 'regex:/^[A-Za-z0-9\s.]+$/',
                Rule::unique('customers')->ignore($customerid)->where('is_deleted', 0),
            ],
            'email' => [
                'required', 'email', 'max:50',
                Rule::unique('customers')->ignore($customerid)->where('is_deleted', 0),
            ],
            'mobile_no' => [
                'required', 'digits_between:7,15', 'regex:/^[6-9]\d{6,14}$/',
                Rule::unique('customers')->ignore($customerid)->where('is_deleted', 0),
            ],
            'mobile_no_cc'          => 'nullable|string|max:10',
            'mobile_no_ic'          => 'nullable|string|max:5',
            'profile_photo'         => 'nullable|string',
            'company_logo'          => 'nullable|string',
            'company_video'         => 'nullable|string',
            'media_images'          => 'nullable|array',
            'media_images.*'        => 'nullable|string',
            'category_id'           => 'required|exists:categories,id',
            'company_name'          => 'nullable|string|max:50',
            'company_address'       => 'nullable|string|max:250',
            'google_map_link'       => 'nullable|url|max:255',
            'business_description'  => 'nullable|string|max:255',
            'trn_no'                => 'nullable|string|max:20',
            'website'               => 'nullable|url|max:100',
            'facebook_link'         => 'nullable|url|max:250',
            'x_link'                => 'nullable|url|max:250',
            'linkedin_link'         => 'nullable|url|max:250',
            'youtube_link'          => 'nullable|url|max:250',
            'instagram_link'        => 'nullable|url|max:250',
            'specialisation'        => 'nullable|string|max:200',
            'plan_type'             => 'nullable|in:1,2,3',
            'is_active'             => 'required|boolean',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Validation failed',
                'data' => $validator->errors()
            ], 422);
        }

        try{
            $user = Customer::find($customerid);
            if (!$user) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'User not found'
                ], 404);
            }

            $fieldsToTrack = [
                'first_name', 'last_name', 'username', 'email', 'mobile_no', 'mobile_no_cc', 'mobile_no_ic',
                'trn_no', 'website', 'specialization', 'facebook_link', 'x_link', 'linkedin_link', 'youtube_link',
                'instagram_link', 'category_id', 'plan_type', 'is_active', 'company_name', 'company_address',
                'google_map_link', 'business_description'
            ];

            $oldValueString = '';
            $newValueString = '';

            foreach ($fieldsToTrack as $field) {
                $oldValue = $user->$field;
                $newValue = $request->$field;

                if ($oldValue != $newValue && $request->has($field)) {
                    $oldValueString .= "$field=" . ($oldValue ?? 'N/A') . ', ';
                    $newValueString .= "$field=" . ($newValue ?? 'N/A') . ', ';
                }
            }

            $oldValueString = rtrim($oldValueString, ', ');
            $newValueString = rtrim($newValueString, ', ');

            foreach ($fieldsToTrack as $field) {
                if ($request->has($field)) {
                    $user->$field = $request->$field;
                }
            }

            // Handle profile photo
            $user->profile_photo = $request->profile_photo ? Helper::storeBase64Image($request->profile_photo, 'profile_photo') : $user->profile_photo;


            // ✅ Delete old files if uploading new ones
            if ($request->company_logo && $user->company_logo && Storage::exists('public/' . $user->company_logo)) {
                Storage::delete('public/' . $user->company_logo);
            }
            if ($request->company_video && $user->company_video && Storage::exists('public/' . $user->company_video)) {
                Storage::delete('public/' . $user->company_video);
            }

            // ✅ Upload new company logo and video
            $user->company_logo = $request->company_logo ? Helper::storeBase64Image($request->company_logo, 'company_logo') : $user->company_logo;
            $user->company_video = $request->company_video ? Helper::storeBase64Video($request->company_video, 'company_video') : $user->company_video;

            // ✅ Handle media images
            if ($request->media_images && is_array($request->media_images)) {
                foreach ($request->media_images as $mediaImage) {
                    $path = Helper::storeBase64Image($mediaImage, 'media_images');

                    MediaImage::create([
                        'customer_id' => $user->id,
                        'image' => $path,
                    ]);
                }
            }

            if (!empty($oldValueString) && !empty($newValueString)) {
                \DB::table('audit_history')->insert([
                    'page' => 'edit customer',
                    'tableid' => $user->id,
                    'oldvalue' => $oldValueString,
                    'newvalue' => $newValueString,
                    'updated_by' => $request->user()->id,
                    'created_at' => now(),
                    'updated_at' => now()
                ]);
            }

            $user->save();

            return response()->json([
                'status' => 'success',
                'message' => 'Customer updated successfully',
                'data' => $user
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
    } */
    
    public function update(Request $request)
    {
        $customerid = $request->user_id;

        $validator = \Validator::make($request->all(), [

            'user_id' => 'required|exists:customers,id',

            'first_name' => 'required|string|min:3|max:50|regex:/^[A-Za-z0-9\s.]+$/',

            'last_name' => 'nullable|string|min:3|max:50|regex:/^[A-Za-z0-9\s.]+$/',

            'username' => [
                'required',
                'string',
                'min:3',
                'max:50',
                'regex:/^[A-Za-z0-9\s.]+$/',
                Rule::unique('customers')
                    ->ignore($customerid)
                    ->where('is_deleted', 0),
            ],

            'email' => [
                'required',
                'email',
                'max:50',
                Rule::unique('customers')
                    ->ignore($customerid)
                    ->where('is_deleted', 0),
            ],

            'mobile_no' => [
                'required',
                'digits_between:7,15',
                'regex:/^[6-9]\d{6,14}$/',
                Rule::unique('customers')
                    ->ignore($customerid)
                    ->where('is_deleted', 0),
            ],

            'mobile_no_cc' => 'nullable|string|max:10',
            'mobile_no_ic' => 'nullable|string|max:5',

            /*
            ==========================
            FILE VALIDATION
            ==========================
            */

            'profile_photo' =>
                'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',

            'company_logo' =>
                'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',

            'company_video' =>
                'nullable|file|mimes:mp4,webm,ogg|max:10240',

            'media' => 'nullable|array',
            'media.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',

            'category_id' =>
                'required|exists:categories,id',

            'company_name' =>
                'nullable|string|max:50',

            'company_address' =>
                'nullable|string|max:250',

            'google_map_link' =>
                'nullable|url|max:255',

            'business_description' =>
                'nullable|string|max:255',

            'trn_no' =>
                'nullable|string|max:20',

            'website' =>
                'nullable|url|max:100',

            'facebook_link' =>
                'nullable|url|max:250',

            'x_link' =>
                'nullable|url|max:250',

            'linkedin_link' =>
                'nullable|url|max:250',

            'youtube_link' =>
                'nullable|url|max:250',

            'instagram_link' =>
                'nullable|url|max:250',

            'specialisation' =>
                'nullable|string|max:200',

            'plan_type' =>
                'nullable|in:1,2,3',

            'is_active' =>
                'required|boolean',
        ]);

        if ($validator->fails()) {

            return response()->json([
                'status' => 'error',
                'message' => 'Validation failed',
                'data' => $validator->errors()
            ], 422);
        }

        try {

            $user = Customer::find($customerid);

            if (!$user) {

                return response()->json([
                    'status' => 'error',
                    'message' => 'User not found'
                ], 404);
            }

            /*
            ==========================
            TRACK FIELD CHANGES
            ==========================
            */

            $fieldsToTrack = [

                'first_name',
                'last_name',
                'username',
                'email',
                'mobile_no',
                'mobile_no_cc',
                'mobile_no_ic',
                'trn_no',
                'website',
                'specialization',
                'facebook_link',
                'x_link',
                'linkedin_link',
                'youtube_link',
                'instagram_link',
                'category_id',
                'plan_type',
                'is_active',
                'company_name',
                'company_address',
                'google_map_link',
                'business_description'
            ];

            $oldValueString = '';
            $newValueString = '';

            foreach ($fieldsToTrack as $field) {

                $oldValue = $user->$field;
                $newValue = $request->$field;

                if ($oldValue != $newValue && $request->has($field)) {

                    $oldValueString .=
                        "$field=" .
                        ($oldValue ?? 'N/A') .
                        ', ';

                    $newValueString .=
                        "$field=" .
                        ($newValue ?? 'N/A') .
                        ', ';
                }
            }

            $oldValueString = rtrim($oldValueString, ', ');
            $newValueString = rtrim($newValueString, ', ');

            foreach ($fieldsToTrack as $field) {

                if ($request->has($field)) {

                    $user->$field =
                        $request->$field;
                }
            }

            /*
            ==========================
            PROFILE PHOTO
            ==========================
            */

            if ($request->hasFile('profile_photo')) {

                if ($user->profile_photo &&
                    Storage::exists('public/' . $user->profile_photo)) {

                    Storage::delete(
                        'public/' . $user->profile_photo
                    );
                }

                $file = $request->file('profile_photo');

                $fileName =
                    time().'_profile.'.
                    $file->getClientOriginalExtension();

                $file->storeAs(
                    'public/profile_photo',
                    $fileName
                );

                $user->profile_photo =
                    'profile_photo/' . $fileName;
            }

            /*
            ==========================
            COMPANY LOGO
            ==========================
            */

            if ($request->hasFile('company_logo')) {

                if ($user->company_logo &&
                    Storage::exists('public/' . $user->company_logo)) {

                    Storage::delete(
                        'public/' . $user->company_logo
                    );
                }

                $file = $request->file('company_logo');

                $fileName =
                    time().'_logo.'.
                    $file->getClientOriginalExtension();

                $file->storeAs(
                    'public/company_logo',
                    $fileName
                );

                $user->company_logo =
                    'company_logo/' . $fileName;
            }

            /*
            ==========================
            COMPANY VIDEO
            ==========================
            */

            if ($request->hasFile('company_video')) {

                if ($user->company_video &&
                    Storage::exists('public/' . $user->company_video)) {

                    Storage::delete(
                        'public/' . $user->company_video
                    );
                }

                $file = $request->file('company_video');

                $fileName =
                    time().'_video.'.
                    $file->getClientOriginalExtension();

                $file->storeAs(
                    'public/company_video',
                    $fileName
                );

                $user->company_video =
                    'company_video/' . $fileName;
            }

            

            /*
            ==============================
            MEDIA IMAGES (ADD ONLY — NO DELETE)
            ==============================
            */

            if ($request->hasFile('media')) {

                $files = $request->file('media');

                if (is_array($files)) {

                    foreach ($files as $file) {

                        if ($file->isValid()) {

                            $fileName =
                                time().'_media_'.
                                uniqid().'.'.
                                $file->getClientOriginalExtension();

                            $file->storeAs(
                                'public/media_images',
                                $fileName
                            );

                            MediaImage::create([

                                'customer_id' => $user->id,

                                'image' =>
                                    'media_images/'.$fileName,
                            ]);
                        }
                    }
                }
            }

            /*
            ==========================
            AUDIT LOG
            ==========================
            */

            if (!empty($oldValueString) &&
                !empty($newValueString)) {

                \DB::table('audit_history')->insert([

                    'page' => 'edit customer',

                    'tableid' => $user->id,

                    'oldvalue' => $oldValueString,

                    'newvalue' => $newValueString,

                    'updated_by' =>
                        $request->user()->id,

                    'created_at' => now(),

                    'updated_at' => now()
                ]);
            }

            $user->save();

            return response()->json([

                'status' => 'success',

                'message' =>
                    'Customer updated successfully',

                'data' => $user

            ], 200);

        } catch (QueryException $e) {

            Log::error('Some Error', [

                'error' => $e->getMessage(),

                'sql' => $e->getSql(),

                'bindings' => $e->getBindings()
            ]);

            return response()->json([

                'status' => 'error',

                'message' =>
                    'Some error occurred. Please try again.'
            ], 500);

        } catch (\Exception $e) {

            Log::error('General Error', [

                'error' => $e->getMessage()
            ]);

            return response()->json([

                'status' => 'error',

                'message' =>
                    'Something went wrong. Please try again later.'
            ], 500);
        }
    }
    public function removeUploaded(Request $request)
    {
        // ✅ Step 1: Validate input
        $validated = $request->validate([
            'userId' => 'required|integer|exists:customers,id',
            'type'   => 'required|string|in:company_logo,profile_photo,company_video',
        ]);

        // ✅ Step 2: Fetch customer
        $customer = Customer::find($validated['userId']);
        if (!$customer) {
            return response()->json([
                'status'  => 'error',
                'message' => 'Customer not found.'
            ], 404);
        }

        // ✅ Step 3: Handle file deletion safely
        $type = $validated['type'];
        $filePath = null;

        switch ($type) {
            case 'company_logo':
                $filePath = $customer->company_logo;
                $customer->company_logo = null;
                break;

            case 'profile_photo':
                $filePath = $customer->profile_photo;
                $customer->profile_photo = null;
                break;

            case 'company_video':
                $filePath = $customer->company_video;
                $customer->company_video = null;
                break;
        }

        // ✅ Step 4: Delete file if it exists
        if ($filePath && Storage::exists('public/' . $filePath)) {
            Storage::delete('public/' . $filePath);
        }

        // ✅ Step 5: Save updates
        $customer->save();

        return response()->json([
            'status'  => 'success',
            'message' => ucfirst(str_replace('_', ' ', $type)) . ' removed successfully.',
        ], 200);
    }

    public function removeMediaImage(Request $request, $id)
    {
        
        $mediaImage = MediaImage::where('id', $id)->first();
        if (!$mediaImage) {
            return response()->json(['status' => 'error', 'message' => 'Media image not found'], 404);
        }

        // Delete the image file from storage
        if (Storage::exists('public/' . $mediaImage->image)) {
            Storage::delete('public/' . $mediaImage->image);
        }

        // Delete the media image record
        $mediaImage->delete();

        return response()->json(['status' => 'success', 'message' => 'Media image removed successfully'], 200);
    }

    public function getAllCategories()
    {
        $data = Category::get(['id', 'name']);
        if ($data->isEmpty()) {
            return response()->json([
                'status' => 'error',
                'message' => 'No Category found',
                'data' => []
            ], 404);
        }
        return response()->json([
            'status' => 'success',
            'message' => 'Category fetched successfully',
            'data' => $data
        ], 200);
    }

    public function checkValidUserName(Request $request)
    {
        $request->validate([
            'username' => 'required|string|max:100',
        ]);

        // Get the customer ID and username from the request
        $username = $request->username;

        // Check if the username is unique (ignoring the current customer)
        $usernameExists = Customer::where('username', $username)
            ->exists();

        // Return response
        if ($usernameExists) {
            return response()->json([
                'status' => false,
                'message' => 'username already exists.',
            ]);
        }

        return response()->json([
            'status' => true,
            'message' => 'username is available.',
        ]);
    }

    public function getAllCustomers()
    {
        $data = Customer::where('is_deleted', 0)->orderBy('created_at', 'desc')->get(['id', 'first_name','email']);
        if ($data->isEmpty()) {
            return response()->json([
                'status' => 'error',
                'message' => 'No Customer found',
                'data' => []
            ], 404);
        }
        return response()->json([
            'status' => 'success',
            'message' => 'Customer fetched successfully',
            'data' => $data
        ], 200);
    }



    public function membershipUpdate(Request $request)
    {
        $isBasicPlan = $request->plan_type == 1;

        // Validation rules
        $rules = [
            'customer_id' => 'required|exists:customers,id',
            'plan_type' => 'required|numeric',
        ];

        // Conditional fields
        $conditionalFields = [
            'payment_id' => 'string|min:3|max:50|regex:/^[A-Za-z0-9._\-\s]+$/|unique:transaction_details,transaction_id',
            'transaction_date_submit' => 'date',
            'amount' => 'numeric|min:1',
            'currency_type' => 'nullable|string|in:INR,USD',
            'payment_mode' => 'string',
        ];

        foreach ($conditionalFields as $field => $rule) {
            if ($isBasicPlan) {
                if ($request->filled($field)) {
                    $rules[$field] = $rule;
                }
            } else {
                $rules[$field] = 'required|' . $rule;
            }
        }

        $messages = [
            'customer_id.required' => 'Customer ID is required.',
            'customer_id.exists' => 'Customer not found.',
            'plan_type.required' => 'Please select plan type.',
            'plan_type.numeric' => 'Plan type should be numeric.',

            'payment_id.required' => 'Please enter employee name.',
            'payment_id.min' => 'Employee name should be between 3-50 characters.',
            'payment_id.max' => 'Employee name should be between 3-50 characters.',
            'payment_id.regex' => 'Only alphabets, spaces, dots (.), underscores (_), and hyphens (-) are allowed.',

            'transaction_date_submit.required' => 'Please enter a transaction date.',
            'transaction_date_submit.date' => 'Please enter a valid date.',

            'amount.required' => 'Please enter a payment amount.',
            'amount.numeric' => 'Payment amount should be a number.',
            'amount.min' => 'Payment amount should be at least 1.',

            'currency.in' => 'Please select valid Currency(IN/USD).',

            'payment_mode.required' => 'Please select a payment mode.',
        ];

        $validator = \Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Validation failed',
                'data' => $validator->errors()
            ], 422);
        }

        $customer = Customer::find($request->customer_id);
        $membershipPlan = MembershipPlan::find($request->plan_type);
        $currentPlan = $customer->plan_type;
        $newPlan = $request->plan_type;

        // Prevent downgrade
        if ((int)$newPlan < (int)$currentPlan) {
            return response()->json([
                'status' => 'error',
                'message' => 'Downgrade not allowed. You cannot switch to a lower plan.',
            ], 403);
        }

        $now = now();
        $startDate = $now;
        $expireDate = $now->copy()->addYear();
        $action = '';
        $remark = '';

        if ($currentPlan == 1 && in_array($newPlan, [2, 3])) {
            $startDate = \Carbon\Carbon::parse($request->transaction_date_submit);
            $expireDate = $startDate->copy()->addYear();
            $action = "upgraded from Basic to {$membershipPlan->name}";
        } elseif ($currentPlan == 2 && $newPlan == 3) {
            $customerExpire = \Carbon\Carbon::parse($customer->plan_expired_at);
            $customerStart = \Carbon\Carbon::parse($customer->plan_started_at);

            if ($customerExpire->isPast()) {
                $startDate = \Carbon\Carbon::parse($request->transaction_date_submit);
                $expireDate = $startDate->copy()->addYear();
                $action = "upgraded from Standard to Premium after expiry";
            } else {
                $startDate = $customerStart;
                $diffInMonths = $now->diffInMonths($customerExpire, false);

                if ($diffInMonths > 3) {
                    $expireDate = $customerExpire;
                    $action = "upgraded from Standard to Premium (expiry in more than 3 months)";
                } else {
                    $expireDate = $customerExpire->copy()->addMonth();
                    $action = "upgraded from Standard to Premium (expiry within 3 months)";
                }
            }
        } elseif ($currentPlan == $newPlan && in_array($newPlan, [2, 3])) {
            $startDate = \Carbon\Carbon::parse($customer->plan_expired_at)->addDay();
            $expireDate = $startDate->copy()->addYear();
            $action = "renewed the {$membershipPlan->name}";
        }

        // Build auto note
        $remark = "Plan {$membershipPlan->name} {$action}, starts on {$startDate->format('d-m-Y')} and expires on {$expireDate->format('d-m-Y')}.";

        $price_without_gst = $request->amount / 1.18;
        $gst = $request->amount - $price_without_gst;
        // Create transaction

        $order_id = 'ORD-' . strtoupper(Str::random(10));

        $membershipPlan->transactions()->create([
            'transaction_id' => $isBasicPlan ? null : $request->payment_id,
            'order_id' => $order_id,
            'customer_id' => $request->customer_id,
            'currency_type' => $request->currency_type,
            'total_amount' => $isBasicPlan ? 0 : $request->amount,
            'status' => 'completed',
            'payment_method' => $isBasicPlan ? null : $request->payment_mode,
            'transaction_date' => $isBasicPlan ? $now : $request->transaction_date_submit,
            'payer_first_name' => $customer->first_name,
            'payer_last_name' => $customer->last_name,
            'payer_mobile_no' => $customer->mobile_no,
            'payer_email' => $customer->email,
            'price' => $price_without_gst,
            'gst' => $gst,
            'discount' => 0,
            'start_date' => $startDate,
            'expire_date' => $expireDate,
            'note' => $request->note,
            'remark' => $remark,
            'updated_by_admin' => 1
        ]);

        // Update customer
        $customer->plan_type = $newPlan;
        $customer->plan_started_at = $startDate;
        $customer->plan_expired_at = $expireDate;
        $customer->save();

        Mail::to($customer->email)->send(new MembershipAcknowledgementMail(
            $customer->first_name.' '.$customer->last_name,
            Carbon::parse($expireDate)->format('Y-m-d'), 
            $membershipPlan->name, 
            $membershipPlan->benefits, 
            $order_id
        ));

        return response()->json([
            'status' => 'success',
            'message' => "Customer has successfully {$action}. New expiry date is {$expireDate->format('d-m-Y')}.",
            'data' => $customer
        ]);
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

    public function removeCustomer(Request $request, $id)
    {
        if (!$id) {
            return response()->json([
                'status' => 'error',
                'message' => 'Customer ID is required in the URL.'
            ], 422);
        }

        try {
            $customer = Customer::findOrFail($id);
            $customer->is_deleted = 1;
            $customer->save();

            return response()->json([
                'status' => true,
                'message' => 'Customer deleted successfully',
            ], 200);

        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Customer not found',
            ], 404);

        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'An error occurred: ' . $e->getMessage(),
            ], 500);
        }
    }

}
