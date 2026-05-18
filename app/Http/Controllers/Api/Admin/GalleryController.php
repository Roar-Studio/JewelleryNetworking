<?php

namespace App\Http\Controllers\Api\Admin;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\{Auth, Response, Crypt, Hash, Storage};
use Yajra\DataTables\Facades\DataTables;
use Carbon\Carbon;
use App\Models\{User, Gallery, GalleryCategory, Videos};
use Illuminate\Support\Str;
use Illuminate\Database\QueryException;
use DB;
use Log;

class GalleryController extends Controller
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

            $data = GalleryCategory::where('is_deleted', 0);

            if ($request->filled('is_active')) {
                $data->Where('is_active', $request->is_active);
            }   

            //search function
            if ($request->filled('search_key')) {
                $searchKey = $request->search_key;
            
                $data->where(function ($query) use ($searchKey) {
                    $query->where('gallery_categories.name', 'LIKE', "%$searchKey%")
                        ->orWhere('gallery_categories.gallery_type', 'LIKE', "%$searchKey%");
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
            'gallery_name' => 'required|string|max:50',
            //'location' => 'required|string|max:50',
            //'gallery_date_submit' => 'required|date',
            'gallery_type' => 'required|in:event,media',
            'is_active' => 'required|in:0,1',
        ], [
            'gallery_name.required' => 'Please enter the gallery name.',
            'gallery_name.max' => 'Gallery name must not exceed 50 characters.',

            // 'location.required' => 'Please enter the location.',
            // 'location.max' => 'Location must not exceed 50 characters.',

            // 'gallery_date_submit.required' => 'Start date is required.',
            // 'gallery_date_submit.date' => 'Start date must be a valid date.',

            'gallery_type.required' => 'Please select gallery type.',
            'gallery_type.in' => 'Invalid gallery type.',

            'is_active.required' => 'Status is required.',
            'is_active.in' => 'Invalid status value.',
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

            // Save gallery category
            $gallery_category = new GalleryCategory();
            $gallery_category->name = $request->gallery_name;
            $gallery_category->location = $request->location;
            $gallery_category->gallery_type = $request->gallery_type;
            $gallery_category->gallery_date = $request->gallery_date_submit;
            $gallery_category->is_active = $request->is_active;
            $gallery_category->save();
            DB::commit();

            return response()->json([
                'status' => 'success',
                'message' => 'Gallery added successfully.'
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

    public function fileUpload(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'category_id' => 'required',
            'file' => 'required'
        ], [
            'category_id.required' => 'Please enter category id.',
            'file' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Validation failed',
                'data' => $validator->errors()
            ], 422);
        }

        try{
            // Save gallery category
            $gallery_category = GalleryCategory::find($request->category_id);


            
            $file = $request->file('file');
            
            $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $path = 'uploads/gallery/' . $filename;
            Storage::disk('public')->putFileAs('uploads/gallery', $file, $filename);
            
            $gallery = new Gallery();
            $gallery->gallery_type = $gallery_category->gallery_type;
            $gallery->gallery_category_id = $gallery_category->id;
            $gallery->url = $path;
            $gallery->is_active = $gallery_category->is_active;
            $gallery->save();

            return response()->json([
                'status' => 'success',
                'message' => 'Gallery added successfully.',
                'data' => $gallery

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




    public function show(Request $request, $id)
    {
        if (!$id) {
            return response()->json([
                'status' => 'error',
                'message' => 'Coupon ID is required in the URL.'
            ], 422);
        }

        try {
            $gallery = GalleryCategory::with('media_files')->findOrFail($id);           
            
            return response()->json([
                'status' => true,
                'message' => 'gallery details retrieved successfully',
                'data' => $gallery
            ], 200);
            
        } catch (\Exception $e) {
            return response()->json([
                'error' => $e->getMessage()
            ], 500);
            return response()->json([
                'status' => 'error',
                'message' => 'Gallery not found',
            ], 404);
        }
    }

    public function update(Request $request)
    {
        $galleryId = $request->gallery_id;

        
        $validator = \Validator::make($request->all(), [
            'gallery_id' => 'required|numeric',
            'gallery_name' => 'required|string|max:50',
            // 'location' => 'required|string|max:50',
            //'gallery_date_submit' => 'required|date',
            'gallery_type' => 'required|in:event,media',
            'is_active' => 'required|in:0,1'
        ], [
            'gallery_id.required' => 'Please enter gallery id',
            'gallery_id.numeric' => 'Gallery id must be a number.',

            'gallery_name.required' => 'Please enter the gallery name.',
            'gallery_name.max' => 'Gallery name must not exceed 50 characters.',

            // 'location.required' => 'Please enter the location.',
            // 'location.max' => 'Location must not exceed 50 characters.',

            // 'gallery_date_submit.required' => 'Gallery date is required.',
            // 'gallery_date_submit.date' => 'Gallery date must be a valid date.',
        
            'gallery_type.required' => 'Please select gallery type.',
        
            'is_active.required' => 'Please select coupon is_active.',
            'is_active.in' => 'Invalid status value.'
        ]);
        

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Validation failed',
                'data' => $validator->errors()
            ], 422);
        }

        try {
            $galleryCategory = GalleryCategory::find($galleryId);
            if (!$galleryCategory) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'gallery not found'
                ], 404);
            }

            $galleryCategory->name = $request->gallery_name;
            $galleryCategory->location = $request->location;
            $galleryCategory->gallery_date = $request->gallery_date_submit;
            $galleryCategory->gallery_type = $request->gallery_type;
            $galleryCategory->is_active = $request->is_active;

            $galleryCategory->save();

            $galleries = Gallery::where('gallery_category_id', $galleryCategory->id)->update(['gallery_type' => $request->gallery_type]);

            return response()->json([
                'status' => 'success',
                'message' => 'Gallery updated successfully.',
                'data' => $galleryCategory
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

    public function removeGallery(Request $request, $id)
    {
        if (!$id) {
            return response()->json([
                'status' => 'error',
                'message' => 'Gallery ID is required in the URL.'
            ], 422);
        }
        
        try {
            $gallery = GalleryCategory::findOrFail($id);
            $gallery->is_deleted = 1;
            $gallery->save();
            
            $galleries = Gallery::where('gallery_category_id', $id)->get();

            foreach ($galleries as $gallery) {
                
                if ($gallery->url && Storage::disk('public')->exists($gallery->url)) {
                    Storage::disk('public')->delete($gallery->url);
                }
                $gallery->delete();
            }

            return response()->json([
                'status' => true,
                'message' => 'Gallery deleted successfully',
            ], 200);

        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Gallery not found',
            ], 404);

        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'An error occurred: ' . $e->getMessage(),
            ], 500);
        }
    }

    public function removeGalleryFile(Request $request, $id)
    {
        if (!$id) {
            return response()->json([
                'status' => 'error',
                'message' => 'Gallery ID is required in the URL.'
            ], 422);
        }

        try {
            $gallery = Gallery::findOrFail($id);

            if ($gallery->url && Storage::disk('public')->exists($gallery->url)) {
                Storage::disk('public')->delete($gallery->url);
            }

            $gallery->delete();


            return response()->json([
                'status' => true,
                'message' => 'Gallery File deleted successfully',
            ], 200);

        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Gallery File not found',
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

    public function addVideos(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'gallery_id'   => 'required|exists:gallery_categories,id',
            'youtube_urls' => 'required|array|min:1',
            'youtube_urls.*' => 'required|url'
        ], [
            'gallery_id.required'   => 'Please enter category id.',
            'gallery_id.exists'     => 'Invalid gallery category.',
            'youtube_urls.required' => 'Please enter at least one YouTube URL.',
            'youtube_urls.*.url'    => 'Please enter a valid YouTube URL.'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status'  => 'error',
                'message' => 'Validation failed',
                'data'    => $validator->errors()
            ], 422);
        }

        // Get gallery category
        $gallery_category = GalleryCategory::find($request->gallery_id);

        $videos = [];
        foreach ($request->youtube_urls as $url) {
            $video = new Videos();
            $video->gallery_type        = $gallery_category->gallery_type;
            $video->gallery_category_id = $gallery_category->id;
            $video->youtube_url         = $url;
            $video->is_active           = $gallery_category->is_active;
            $video->save();

            $videos[] = $video;
        }

        return response()->json([
            'status'  => 'success',
            'message' => 'Videos added successfully.',
            'data'    => $videos
        ], 200);
    }
    public function manageVideos(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'gallery_id' => 'required|exists:gallery_categories,id',
            // 'videos' => 'required|array|min:1',
            // 'videos.*.youtube_url' => 'required|url',
            'videos.*.id' => 'nullable|exists:videos,id'
        ], [
            'gallery_id.required' => 'Please enter category id.',
            'gallery_id.exists' => 'Invalid gallery category.',
            // 'videos.required' => 'Please enter at least one video.',
            // 'videos.*.youtube_url.required' => 'YouTube URL is required.',
            'videos.*.youtube_url.url' => 'Please enter a valid YouTube URL.'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Validation failed',
                'data' => $validator->errors()
            ], 422);
        }

        try {
            $gallery_category = GalleryCategory::find($request->gallery_id);
            
            // Get existing video IDs for this gallery
            $existingVideoIds = Videos::where('gallery_category_id', $gallery_category->id)
                                    ->pluck('id')
                                    ->toArray();
            
            $processedVideoIds = [];
            $videos = [];
            
            foreach ($request->videos as $videoData) {
                if (!empty($videoData['id'])) {
                    // Update existing video
                    $video = Videos::find($videoData['id']);
                    if ($video && $video->gallery_category_id == $gallery_category->id) {
                        $video->youtube_url = $videoData['youtube_url'];
                        $video->save();
                        $processedVideoIds[] = $video->id;
                        $videos[] = $video;
                    }
                } else {
                    // Create new video
                    $video = new Videos();
                    $video->gallery_type = $gallery_category->gallery_type;
                    $video->gallery_category_id = $gallery_category->id;
                    $video->youtube_url = $videoData['youtube_url'];
                    $video->is_active = $gallery_category->is_active;
                    $video->save();
                    
                    $processedVideoIds[] = $video->id;
                    $videos[] = $video;
                }
            }
            
            // Delete videos that are no longer in the request
            $videosToDelete = array_diff($existingVideoIds, $processedVideoIds);
            if (!empty($videosToDelete)) {
                Videos::whereIn('id', $videosToDelete)->delete();
            }

            return response()->json([
                'status' => 'success',
                'message' => 'Videos updated successfully.',
                'data' => $videos
            ], 200);
            
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Something went wrong: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Remove single video
     */
    public function removeVideo($id)
    {
        try {
            $video = Videos::find($id);
            
            if (!$video) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Video not found.'
                ], 404);
            }
            
            $video->delete();
            
            return response()->json([
                'status' => 'success',
                'message' => 'Video deleted successfully.'
            ], 200);
            
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Something went wrong: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Update the existing view method to include videos
     */
    public function view($id)
    {
        try {
            $gallery = GalleryCategory::with(['media_files', 'videos'])->find($id);
            
            if (!$gallery) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Gallery not found.'
                ], 404);
            }
            
            // Format the response
            $galleryData = [
                'id' => $gallery->id,
                'name' => $gallery->name,
                'location' => $gallery->location,
                'gallery_type' => $gallery->gallery_type,
                'gallery_date' => $gallery->gallery_date,
                'is_active' => $gallery->is_active,
                'media_files' => $gallery->media_files ?? [],
                'videos' => $gallery->videos ?? []
            ];
            
            return response()->json([
                'status' => 'success',
                'message' => 'Gallery details retrieved successfully.',
                'data' => $galleryData
            ], 200);
            
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Something went wrong: ' . $e->getMessage()
            ], 500);
        }
    }

}
