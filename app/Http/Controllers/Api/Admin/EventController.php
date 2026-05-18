<?php

namespace App\Http\Controllers\Api\Admin;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\{Auth, Response, Crypt, Hash, Storage};
use Yajra\DataTables\Facades\DataTables;
use Carbon\Carbon;
use App\Models\{User, membershipPlan, Event, Sponsor};
use Illuminate\Support\Str;
use Illuminate\Database\QueryException;
use DB;
use Log;

class EventController extends Controller
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

            $data = Event::withCount(['transactions as completed_transaction_count' => function ($query) {
                $query->where('status', 'completed');
            }])
            ->where('is_deleted', 0);

            if ($request->filled('is_active')) {
                $data->Where('is_active', $request->is_active);
            } 
            if ($request->filled('event_type')) {
                $data->Where('event_type', $request->event_type);
            }   

            if ($request->filled('date_from')) {
                $startDate = Carbon::createFromFormat('d/m/Y', $request->date_from)->startOfDay();
                $data->where('event_start_datetime', '>=', $startDate);
            }
            
            if ($request->filled('date_to')) {
                $endDate = Carbon::createFromFormat('d/m/Y', $request->date_to)->addDay()->startOfDay();
                $data->where('event_start_datetime', '<', $endDate);
            }
            
            //search function
            if ($request->filled('search_key')) {
                $searchKey = $request->search_key;
            
                $data->where(function ($query) use ($searchKey) {
                    $query->where('events.name', 'LIKE', "%$searchKey%")
                        ->orWhere('events.venue_address', 'LIKE', "%$searchKey%")
                        ->orWhere('events.description', 'LIKE', "%$searchKey%");
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

    public function getAllEvents()
    {
        $data = Event::where('is_deleted', 0)->orderBy('created_at', 'desc')->get(['id', 'name']);
        if ($data->isEmpty()) {
            return response()->json([
                'status' => 'error',
                'message' => 'No Events found',
                'data' => []
            ], 200);
        }
        return response()->json([
            'status' => 'success',
            'message' => 'Events fetched successfully',
            'data' => $data
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    /* public function store(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'name' => 'required|string|min:3|max:250',
            // 'name' => 'required|string|min:3|max:255|regex:/^[A-Za-z0-9.\s_-]+$/',
            'description' => 'nullable|string|max:500',
            'event_start_datetime' => 'required|date_format:Y-m-d H:i:s',
            'event_end_datetime' => 'nullable|date_format:Y-m-d H:i:s|after_or_equal:event_start_datetime',
            'venue_address' => 'nullable|string|max:250',
            'amount_in_inr' => 'nullable|numeric|min:0|max:999999',
            'amount_in_usd' => 'nullable|numeric|min:0|max:999999',
            'google_maps_link' => 'nullable',
            'google_meet_link' => 'nullable|url|max:255',
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
            }],
            'sponsor' => ['nullable', 'array'],
            'sponsor.*' => [
                'string',
                function ($attribute, $value, $fail) {
                    if (!preg_match('/^data:image\/(jpeg|png|jpg|gif|webp);base64,/', $value)) {
                        return $fail('Each sponsor image must be a valid base64 encoded image.');
                    }

                    $sizeInBytes = (int)(strlen(rtrim($value, '=')) * 3 / 4);
                    if ($sizeInBytes > 2 * 1024 * 1024) { // 2MB max
                        return $fail('Each sponsor image must not exceed 2MB.');
                    }
                }
            ],
        ], [
            'name.required' => 'Please enter event name.',
            // 'name.regex' => 'Only letters, spaces, dots (.), underscores (_) and hyphens (-) are allowed.',
            'name.min' => 'Event name must be at least 3 characters.',
            'name.max' => 'Event name must not exceed 250 characters.',

            'description.max' => 'Description must not exceed 500 characters.',
            'event_start_datetime.required' => 'Event date and time is required.',
            
            // 'event_end_datetime.required' => 'Event date and time is required.',
            'event_end_datetime.date_format' => 'Invalid datetime format. Use YYYY-MM-DD HH:MM:SS.',
            'event_end_datetime.after_or_equal' => 'Registration End date must be same or after start date.',


            'venue_address.max' => 'Venue address should not exceed 255 characters.',

            'amount_in_inr.numeric' => 'Amount should be a number.',
            'amount_in_inr.min' => 'Amount should between 0 and 999999.',

            'amount_in_usd.numeric' => 'Amount should be a number.',
            'amount_in_usd.min' => 'Amount should between 0 and 999999.',

            'google_meet_link.url' => 'Please enter a valid Google Meet URL.',
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
            $event->event_type = $request->event_type;
            $event->event_mode = $request->event_mode;
            $event->description = $request->description;
            $event->event_start_datetime = $request->event_start_datetime;
            $event->event_end_datetime = $request->event_end_datetime;
            $event->venue_address = $request->venue_address;
            $event->amount_in_inr = $request->amount_in_inr;
            $event->amount_in_usd = $request->amount_in_usd;
            $event->google_maps_link = $request->google_maps_link;
            $event->google_meet_link = $request->google_meet_link;
            $event->total_seats = $request->total_seats;
            $event->display_start_date = $request->display_start_date_submit;
            $event->display_end_date = $request->display_end_date_submit;
            $event->is_active = $request->is_active ?? 0;
            if($request->banner){
                $event->banner = Helper::storeBase64Image($request->banner, 'event_banners');
            }
            $event->save();
            DB::commit();
            
            if ($request->sponsor) {
                $sponsorPaths = [];
                foreach ($request->sponsor as $sponsorImage) {
                    $path = Helper::storeBase64Image($sponsorImage, 'event_sponsors');

                    Sponsor::create([
                        'event_id' => $event->id,
                        'image' => $path,
                    ]);
                }
            }
            

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
                'status' => false,
                'message' => 'Some error occurred. Please try again.'
            ], 500);

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('General Error', ['error' => $e->getMessage()]);
            return response()->json([
                'status' => false,
                'message' => 'Something went wrong. Please try again later.'
            ], 500);
        }
    } */
   public function store(Request $request)
{
    $validator = \Validator::make($request->all(), [

        'name' => 'required|string|min:3|max:250',

        'description' => 'nullable|string|max:500',

        'event_start_datetime' =>
            'required|date_format:Y-m-d H:i:s',

        'event_end_datetime' =>
            'nullable|date_format:Y-m-d H:i:s|after_or_equal:event_start_datetime',

        'venue_address' =>
            'nullable|string|max:250',

        'amount_in_inr' =>
            'nullable|numeric|min:0|max:999999',

        'amount_in_usd' =>
            'nullable|numeric|min:0|max:999999',

        'google_maps_link' => 'nullable',

        'google_meet_link' =>
            'nullable|url|max:255',

        'total_seats' =>
            'nullable|integer|min:1',

        'display_start_date_submit' =>
            'nullable|date|date_format:Y-m-d',

        'display_end_date_submit' =>
            'nullable|date|date_format:Y-m-d|after_or_equal:display_start_date_submit',

        'is_active' =>
            'nullable|in:0,1',

        /*
        FILE VALIDATION
        */

        'banner' =>
            'required|image|mimes:jpeg,png,jpg,gif,webp|max:5120',

        'sponsor' =>
            'required|array',

        'sponsor.*' =>
            'image|mimes:jpeg,png,jpg,gif,webp|max:5120',

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

        /*
        ===============================
        BANNER FILE
        ===============================
        */

        if ($request->hasFile('banner')) {

            $file = $request->file('banner');

            $base64 =
                base64_encode(
                    file_get_contents(
                        $file->getRealPath()
                    )
                );

            $event->banner =
                Helper::storeBase64Image(
                    'data:image/' .
                    $file->getClientOriginalExtension() .
                    ';base64,' .
                    $base64,
                    'event_banners'
                );
        }

        /*
        ===============================
        EVENT DATA
        ===============================
        */

        $event->name = $request->name;
        $event->event_type = $request->event_type;
        $event->event_mode = $request->event_mode;
        $event->description = $request->description;

        $event->event_start_datetime =
            $request->event_start_datetime;

        $event->event_end_datetime =
            $request->event_end_datetime;

        $event->venue_address =
            $request->venue_address;

        $event->amount_in_inr =
            $request->amount_in_inr;

        $event->amount_in_usd =
            $request->amount_in_usd;

        $event->google_maps_link =
            $request->google_maps_link;

        $event->google_meet_link =
            $request->google_meet_link;

        $event->total_seats =
            $request->total_seats;

        $event->display_start_date =
            $request->display_start_date_submit;

        $event->display_end_date =
            $request->display_end_date_submit;

        $event->is_active =
            $request->is_active ?? 0;

        $event->save();


        /*
        ===============================
        SPONSOR FILES
        ===============================
        */

        if ($request->hasFile('sponsor')) {

            foreach ($request->file('sponsor') as $file) {

                $base64 =
                    base64_encode(
                        file_get_contents(
                            $file->getRealPath()
                        )
                    );

                $path =
                    Helper::storeBase64Image(
                        'data:image/' .
                        $file->getClientOriginalExtension() .
                        ';base64,' .
                        $base64,
                        'event_sponsors'
                    );

                Sponsor::create([
                    'event_id' => $event->id,
                    'image' => $path,
                ]);
            }
        }

        DB::commit();

        return response()->json([

            'status' => 'success',
            'message' => 'Event added successfully.',
            'data' => $event

        ], 200);

    }

    catch (QueryException $e) {

        DB::rollBack();

        Log::error('SQL Error', [
            'error' => $e->getMessage(),
            'sql' => $e->getSql(),
            'bindings' => $e->getBindings()
        ]);

        return response()->json([
            'status' => false,
            'message' =>
                'Some database error occurred.'
        ], 500);
    }

    catch (\Exception $e) {

        DB::rollBack();

        Log::error('General Error', [
            'error' => $e->getMessage()
        ]);

        return response()->json([
            'status' => false,
            'message' =>
                'Something went wrong.'
        ], 500);
    }
}



    public function show(Request $request, $id)
    {
        if (!$id) {
            return response()->json([
                'status' => 'error',
                'message' => 'Event ID is required in the URL.'
            ], 422);
        }

        try {          
            $eventData = Event::with('sponsors')->where('id', $id)->where('is_deleted', 0)->firstOrFail();

            return response()->json([
                'status' => true,
                'message' => 'Event details retrieved successfully',
                'data' => $eventData
            ], 200);
            
        } catch (\Exception $e) {
            return response()->json([
                'error' => $e->getMessage()
            ], 500);
            return response()->json([
                'status' => 'error',
                'message' => 'Event not found',
            ], 404);
        }
    }

    public function registerList(Request $request, $event_id)
    {
        if (!$event_id) {
            return response()->json([
                'status' => 'error',
                'message' => 'Event ID is required in the URL.'
            ], 422);
        }

        try {          
            $eventData = Event::with(['transactions' => function ($query) {
                    $query->where('status', 'completed');
                }])
                ->where('id', $event_id)
                ->where('is_deleted', 0)
                ->firstOrFail();

            return response()->json([
                'status' => true,
                'message' => 'Event details retrieved successfully',
                'data' => $eventData
            ], 200);
            
        } catch (\Exception $e) {
            return response()->json([
                'error' => $e->getMessage()
            ], 500);
            return response()->json([
                'status' => 'error',
                'message' => 'Event not found',
            ], 404);
        }
    }

    public function removeSponsor(Request $request, $id)
    {
        if (!$id) {
            return response()->json([
                'status' => 'error',
                'message' => 'Sponsor ID is required in the URL.'
            ], 422);
        }

        try {
            $sponsor = Sponsor::findOrFail($id);

            // If you also need to delete image from storage
            if ($sponsor->image && Storage::exists('public/' . $sponsor->image)) {
                Storage::delete('public/' . $sponsor->image);
            }

            $sponsor->delete();

            return response()->json([
                'status' => true,
                'message' => 'Sponsor deleted successfully',
            ], 200);

        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Sponsor not found',
            ], 404);

        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'An error occurred: ' . $e->getMessage(),
            ], 500);
        }
    }

    /* public function update(Request $request)
    {
        $eventId = $request->event_id;

        $validator = \Validator::make($request->all(), [
            'event_id' => 'required|numeric',
            'name' => 'required|string|min:3|max:250',
            'description' => 'nullable|string|max:500',
            'event_start_datetime' => 'required|date_format:Y-m-d H:i:s',
            'event_end_datetime' => 'nullable|date_format:Y-m-d H:i:s|after_or_equal:event_start_datetime',
            'venue_address' => 'nullable|string|max:250',
            'amount_in_inr' => 'nullable|numeric|min:0|max:999999',
            'amount_in_usd' => 'nullable|numeric|min:0|max:999999',
            'google_maps_link' => 'nullable',
            'google_meet_link' => 'nullable|url|max:255',
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
            }],
            'sponsor' => ['nullable', 'array'],
            'sponsor.*' => [
                'string',
                function ($attribute, $value, $fail) {
                    if (!preg_match('/^data:image\/(jpeg|png|jpg|gif|webp);base64,/', $value)) {
                        return $fail('Each sponsor image must be a valid base64 encoded image.');
                    }

                    $sizeInBytes = (int)(strlen(rtrim($value, '=')) * 3 / 4);
                    if ($sizeInBytes > 2 * 1024 * 1024) {
                        return $fail('Each sponsor image must not exceed 2MB.');
                    }
                }
            ],
        ], [
            'name.required' => 'Please enter event name.',
            // 'name.regex' => 'Only letters, spaces, dots (.), underscores (_) and hyphens (-) are allowed.',
            'name.min' => 'Event name must be at least 3 characters.',
            'name.max' => 'Event name must not exceed 250 characters.',
            'description.max' => 'Description must not exceed 500 characters.',
            'event_start_datetime.required' => 'Event date and time is required.',
            'event_start_datetime.date_format' => 'Invalid datetime format. Use YYYY-MM-DD HH:MM:SS.',
            // 'event_end_datetime.required' => 'Event date and time is required.',
            'event_end_datetime.date_format' => 'Invalid datetime format. Use YYYY-MM-DD HH:MM:SS.',
            'event_end_datetime.after_or_equal' => 'Registration End date must be same or after start date.',
            'venue_address.max' => 'Venue address should not exceed 250 characters.',
            'amount_in_inr.numeric' => 'Amount should be a number.',
            'amount_in_inr.min' => 'Amount should between 0 and 999999.',
            'amount_in_usd.numeric' => 'Amount should be a number.',
            'amount_in_usd.min' => 'Amount should between 0 and 999999.',
            'google_meet_link.url' => 'Please enter a valid Google Meet URL.',
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
            $event = Event::where('id', $eventId)->where('is_deleted', 0)->first();

            if (!$event) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Event not found'
                ], 404);
            }

            // Delete old banner if it exists
            if ($request->banner && $event->banner && Storage::exists('public/' . $event->banner)) {
                Storage::delete('public/' . $event->banner);
            }

            // Save new banner if provided
            if ($request->banner) {
                $event->banner = Helper::storeBase64Image($request->banner, 'event_banners');
            }

            // Update the event details
            $event->name = $request->name;
            $event->event_type = $request->event_type;
            $event->event_mode = $request->event_mode;
            $event->description = $request->description;
            $event->event_start_datetime = $request->event_start_datetime;
            $event->event_end_datetime = $request->event_end_datetime;
            $event->venue_address = $request->venue_address;
            $event->amount_in_inr = $request->amount_in_inr;
            $event->amount_in_usd = $request->amount_in_usd;
            $event->google_maps_link = $request->google_maps_link;
            $event->google_meet_link = $request->google_meet_link;
            $event->total_seats = $request->total_seats;
            $event->display_start_date = $request->display_start_date_submit;
            $event->display_end_date = $request->display_end_date_submit;
            $event->is_active = $request->is_active ?? 0;

            // Handle sponsor images
            if ($request->sponsor) {
                // Delete existing sponsor images if any
                $existingsponsorImages = json_decode($event->sponsor, true);
                if ($existingsponsorImages) {
                    foreach ($existingsponsorImages as $existingImage) {
                        if (Storage::exists('public/' . $existingImage)) {
                            Storage::delete('public/' . $existingImage);
                        }
                    }
                }

                // Save new sponsor images
                $sponsorPaths = [];
                foreach ($request->sponsor as $sponsorImage) {
                    $path = Helper::storeBase64Image($sponsorImage, 'event_sponsors');
                    
                    Sponsor::create([
                        'event_id' => $event->id,
                        'image' => $path,
                    ]);
                }
            }

            $event->save();

            return response()->json([
                'status' => 'success',
                'message' => 'Event updated successfully.',
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
    } */
   public function update(Request $request)
{
    $eventId = $request->event_id;

    $validator = \Validator::make($request->all(), [

        'event_id' => 'required|numeric',
        'name' => 'required|string|min:3|max:250',
        'description' => 'nullable|string|max:500',

        'event_start_datetime' => 'required|date_format:Y-m-d H:i:s',
        'event_end_datetime' => 'nullable|date_format:Y-m-d H:i:s|after_or_equal:event_start_datetime',

        'venue_address' => 'nullable|string|max:250',

        'amount_in_inr' => 'nullable|numeric|min:0|max:999999',
        'amount_in_usd' => 'nullable|numeric|min:0|max:999999',

        'google_maps_link' => 'nullable',
        'google_meet_link' => 'nullable|url|max:255',

        'total_seats' => 'nullable|integer|min:1',

        'display_start_date_submit' => 'nullable|date|date_format:Y-m-d',
        'display_end_date_submit' => 'nullable|date|date_format:Y-m-d|after_or_equal:display_start_date_submit',

        'is_active' => 'nullable|in:0,1',

        // FILE VALIDATION
        'banner' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:5120',

        'sponsor' => 'nullable|array',
        'sponsor.*' => 'image|mimes:jpeg,png,jpg,gif,webp|max:5120',

    ], [
        'name.required' => 'Please enter event name.',
        'name.min' => 'Event name must be at least 3 characters.',
        'name.max' => 'Event name must not exceed 250 characters.',
    ]);

    if ($validator->fails()) {
        return response()->json([
            'status' => 'error',
            'message' => 'Validation failed',
            'data' => $validator->errors()
        ], 422);
    }

    try {

        $event = Event::where('id', $eventId)
            ->where('is_deleted', 0)
            ->first();

        if (!$event) {
            return response()->json([
                'status' => 'error',
                'message' => 'Event not found'
            ], 404);
        }

        /*
        =========================================
        HANDLE BANNER IMAGE
        =========================================
        */

        if ($request->hasFile('banner')) {

            // Delete old banner
            if ($event->banner &&
                Storage::exists('public/' . $event->banner)) {

                Storage::delete('public/' . $event->banner);
            }

            $file = $request->file('banner');

            // Convert to base64
            $base64 = base64_encode(
                file_get_contents($file->getRealPath())
            );

            // Store using helper
            $event->banner = Helper::storeBase64Image(
                'data:image/' .
                $file->getClientOriginalExtension() .
                ';base64,' .
                $base64,
                'event_banners'
            );
        }

        /*
        =========================================
        UPDATE EVENT DATA
        =========================================
        */

        $event->name = $request->name;
        $event->event_type = $request->event_type;
        $event->event_mode = $request->event_mode;
        $event->description = $request->description;

        $event->event_start_datetime = $request->event_start_datetime;
        $event->event_end_datetime = $request->event_end_datetime;

        $event->venue_address = $request->venue_address;

        $event->amount_in_inr = $request->amount_in_inr;
        $event->amount_in_usd = $request->amount_in_usd;

        $event->google_maps_link = $request->google_maps_link;
        $event->google_meet_link = $request->google_meet_link;

        $event->total_seats = $request->total_seats;

        $event->display_start_date = $request->display_start_date_submit;
        $event->display_end_date = $request->display_end_date_submit;

        $event->is_active = $request->is_active ?? 0;

        /*
        =========================================
        HANDLE SPONSOR IMAGES
        =========================================
        */

        if ($request->hasFile('sponsor')) {

            // Delete old sponsor images
            Sponsor::where('event_id', $event->id)->delete();

            foreach ($request->file('sponsor') as $file) {

                $base64 = base64_encode(
                    file_get_contents($file->getRealPath())
                );

                $path = Helper::storeBase64Image(
                    'data:image/' .
                    $file->getClientOriginalExtension() .
                    ';base64,' .
                    $base64,
                    'event_sponsors'
                );

                Sponsor::create([
                    'event_id' => $event->id,
                    'image' => $path,
                ]);
            }
        }

        $event->save();

        return response()->json([
            'status' => 'success',
            'message' => 'Event updated successfully.',
            'data' => $event
        ], 200);

    } catch (\Exception $e) {

        Log::error('General Error', [
            'error' => $e->getMessage()
        ]);

        return response()->json([
            'status' => 'error',
            'message' => 'Something went wrong.'
        ], 500);
    }
}

    public function removeEvent(Request $request, $id)
    {
        if (!$id) {
            return response()->json([
                'status' => 'error',
                'message' => 'Event ID is required in the URL.'
            ], 422);
        }

        try {
            $event = Event::findOrFail($id);
            $event->is_deleted = 1;
            $event->save();

            return response()->json([
                'status' => true,
                'message' => 'Event deleted successfully',
            ], 200);

        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Event not found',
            ], 404);

        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'An error occurred: ' . $e->getMessage(),
            ], 500);
        }
    }
}
