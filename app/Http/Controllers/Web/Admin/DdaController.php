<?php

namespace App\Http\Controllers\Web\Admin;

use App\Http\Controllers\Controller;
use App\Models\DDA;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class DdaController extends Controller
{
    /**
     * Display all DDA submissions.
     */
    public function index()
    {
        $submissions = DDA::latest()->get();

        return view(
            'admin.manage.dda_management.index',
            compact('submissions')
        );
    }

    /**
     * Display one submission.
     */
    public function show($id)
    {
        $submission = DDA::findOrFail($id);

        $transaction = $submission->transactions()
            ->latest()
            ->first();

        return view(
            'admin.manage.dda_management.show',
            compact('submission', 'transaction')
        );
    }

    /**
     * Show Edit Page.
     */
    public function edit($id)
    {
        $submission = DDA::findOrFail($id);

        $transaction = $submission->transactions()
            ->latest()
            ->first();

        return view(
            'admin.manage.dda_management.edit',
            compact('submission', 'transaction')
        );
    }

    /**
     * Update Submission.
     */
    public function update(Request $request, $id)
    {
        $submission = DDA::findOrFail($id);

        /*
        |--------------------------------------------------------------------------
        | Validation (existing rules reused, image rules added)
        |--------------------------------------------------------------------------
        */

        $validated = $request->validate([

            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email',

            'phone' => 'nullable|string|max:30',

            'city' => 'required|string|max:255',

            'country' => 'required|string|max:255',

            'organisation' => 'nullable|string|max:255',

            'participant_type' => 'required|string|max:255',

            'deity_category_a' => 'required|string|max:255',

            'jewellery_piece_a' => 'required|string|max:255',

            'material_a' => 'required|string|max:255',

            'statement_a' => 'required',

            'deity_category_b' => 'nullable|string|max:255',

            'jewellery_piece_b' => 'nullable|string|max:255',

            'material_b' => 'nullable|string|max:255',

            'statement_b' => 'nullable',

            'status' => [
                'required',
                Rule::in([
                    'Pending',
                    'Under Review',
                    'Approved',
                    'Rejected'
                ]),
            ],

            /*
            |--------------------------------------------------------------------------
            | Image Rules
            |--------------------------------------------------------------------------
            */

            'delete_images_a' => 'nullable|array',
            'delete_images_a.*' => 'string',

            'delete_images_b' => 'nullable|array',
            'delete_images_b.*' => 'string',

            'replace_images_a' => 'nullable|array',
            'replace_images_a.*' => 'nullable|image|mimes:jpg,jpeg,png|max:25600',

            'replace_images_b' => 'nullable|array',
            'replace_images_b.*' => 'nullable|image|mimes:jpg,jpeg,png|max:25600',

            'new_images_a' => 'nullable|array|max:10',
            'new_images_a.*' => 'image|mimes:jpg,jpeg,png|max:25600',

            'new_images_b' => 'nullable|array|max:10',
            'new_images_b.*' => 'image|mimes:jpg,jpeg,png|max:25600',

        ]);

        /*
        |--------------------------------------------------------------------------
        | Process Entry A Images
        |--------------------------------------------------------------------------
        */

        $submission->images_a = $this->processImages(
            $submission,
            'images_a',
            'entry_a',
            $request->input('existing_images_a', $submission->images_a ?? []),
            $request->input('delete_images_a', []),
            $request->file('replace_images_a', []),
            $request->file('new_images_a', [])
        );

        /*
        |--------------------------------------------------------------------------
        | Process Entry B Images
        |--------------------------------------------------------------------------
        */

        $submission->images_b = $this->processImages(
            $submission,
            'images_b',
            'entry_b',
            $request->input('existing_images_b', $submission->images_b ?? []),
            $request->input('delete_images_b', []),
            $request->file('replace_images_b', []),
            $request->file('new_images_b', [])
        );

        /*
        |--------------------------------------------------------------------------
        | Update Remaining Fields
        |--------------------------------------------------------------------------
        */

        $submission->first_name = $validated['first_name'];
        $submission->last_name = $validated['last_name'];
        $submission->email = $validated['email'];
        $submission->phone = $validated['phone'] ?? null;
        $submission->city = $validated['city'];
        $submission->country = $validated['country'];
        $submission->organisation = $validated['organisation'] ?? null;
        $submission->participant_type = $validated['participant_type'];

        $submission->deity_category_a = $validated['deity_category_a'];
        $submission->jewellery_piece_a = $validated['jewellery_piece_a'];
        $submission->material_a = $validated['material_a'];
        $submission->statement_a = $validated['statement_a'];

        $submission->deity_category_b = $validated['deity_category_b'] ?? null;
        $submission->jewellery_piece_b = $validated['jewellery_piece_b'] ?? null;
        $submission->material_b = $validated['material_b'] ?? null;
        $submission->statement_b = $validated['statement_b'] ?? null;

        $submission->status = $validated['status'];

        $submission->save();

        return redirect()
            ->route('manage.dda.show', $submission->id)
            ->with('success', 'Submission updated successfully.');
    }

    /**
     * Update Review Status only.
     */
    public function updateStatus(Request $request, $id)
    {
        $submission = DDA::findOrFail($id);

        $validated = $request->validate([
            'status' => [
                'required',
                Rule::in([
                    'Pending',
                    'Under Review',
                    'Approved',
                    'Rejected'
                ]),
            ],
        ]);

        $submission->status = $validated['status'];

        $submission->save();

        return redirect()
            ->route('manage.dda.show', $submission->id)
            ->with('success', 'Submission status updated successfully.');
    }

    /**
     * Process an image set (images_a or images_b):
     * - Removes images marked for deletion (and deletes them from S3)
     * - Replaces images marked for replacement (deletes old from S3, uploads new)
     * - Appends any newly uploaded images
     *
     * Returns the final ordered array of image URLs to store in the JSON column.
     *
     * @param  DDA    $submission
     * @param  string $column        images_a | images_b
     * @param  string $folder        entry_a | entry_b
     * @param  array  $existingUrls  Current image URLs, keyed by original index
     * @param  array  $deleteIndexes Indexes (as strings) marked for deletion
     * @param  array  $replaceFiles  Uploaded files keyed by index, for replacement
     * @param  array  $newFiles      New uploaded files to append
     * @return array
     */
    private function processImages(
        DDA $submission,
        string $column,
        string $folder,
        array $existingUrls,
        array $deleteIndexes,
        array $replaceFiles,
        array $newFiles
    ): array {
        $finalImages = [];

        foreach ($existingUrls as $index => $url) {

            $indexKey = (string) $index;

            // Skip (and delete from S3) if marked for deletion
            if (in_array($indexKey, $deleteIndexes, true)) {
                $this->deleteImageFromS3($url);
                continue;
            }

            // Replace if a new file was uploaded for this index
            if (isset($replaceFiles[$index]) && $replaceFiles[$index] instanceof UploadedFile) {
                $this->deleteImageFromS3($url);

                $finalImages[] = $this->uploadImageToS3(
                    $replaceFiles[$index],
                    $submission->entry_id,
                    $folder
                );

                continue;
            }

            // Otherwise keep the existing image as-is
            $finalImages[] = $url;
        }

        // Append newly uploaded images
        foreach ($newFiles as $file) {
            if ($file instanceof UploadedFile) {
                $finalImages[] = $this->uploadImageToS3(
                    $file,
                    $submission->entry_id,
                    $folder
                );
            }
        }

        return array_values($finalImages);
    }

    /**
     * Upload a single image to S3 and return its public URL.
     */
    private function uploadImageToS3(UploadedFile $image, string $entryId, string $folder): string
    {
        $fileName = uniqid() . '_' . time() . '.' . $image->getClientOriginalExtension();

        $path = Storage::disk('s3')->putFileAs(
            "submissions/{$entryId}/{$folder}",
            $image,
            $fileName
        );

        return Storage::disk('s3')->url($path);
    }

    /**
     * Delete a single image from S3 given its stored URL.
     */
    private function deleteImageFromS3(?string $url): void
    {
        if (empty($url)) {
            return;
        }

        $key = $this->getS3KeyFromUrl($url);

        if ($key && Storage::disk('s3')->exists($key)) {
            Storage::disk('s3')->delete($key);
        }
    }

    /**
     * Convert a stored S3 URL back into its object key so it can be deleted.
     */
    private function getS3KeyFromUrl(string $url): ?string
    {
        $baseUrl = rtrim(Storage::disk('s3')->url(''), '/');

        if (str_starts_with($url, $baseUrl)) {
            return ltrim(substr($url, strlen($baseUrl)), '/');
        }

        // Fallback: try to extract everything after "submissions/"
        $position = strpos($url, 'submissions/');

        if ($position !== false) {
            return substr($url, $position);
        }

        return null;
    }
}