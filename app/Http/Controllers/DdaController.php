<?php

namespace App\Http\Controllers;

use App\Models\DDA;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DdaController extends Controller
{
    /**
     * Display all submissions
     */
    public function index()
    {
        $submissions = DDA::latest()->get();

        return view('deitiesdesignawards.admin.index', compact('submissions'));
    }

    /**
     * Store a new submission
     */
    public function store(Request $request)
    {
        // Validate Form
        $validated = $request->validate([
            // Step 1
            'first_name'       => 'required|string|max:255',
            'last_name'        => 'required|string|max:255',
            'email'            => 'required|email|max:255',
            'phone'            => 'nullable|string|max:20',
            'city'             => 'required|string|max:255',
            'country'          => 'required|string|max:255',
            'organisation'     => 'nullable|string|max:255',
            'participant_type' => 'required|string|max:255',

            // Step 2
            'piece_name'       => 'required|string|max:255',
            'award_category'   => 'required|string|max:255',
            'materials'        => 'required|string|max:255',
            'year'             => 'required|string|max:10',
            'deity'            => 'required|string|max:255',
            'statement'        => 'required|string',

            // Step 3
            'images'           => 'required|array|min:1|max:10',
            'images.*'         => 'image|mimes:jpg,jpeg,png|max:25600',
        ]);

        /*
        |--------------------------------------------------------------------------
        | Generate Entry ID
        |--------------------------------------------------------------------------
        */
        $entryId = 'DDA' . str_pad(DDA::count() + 1, 6, '0', STR_PAD_LEFT);

        /*
        |--------------------------------------------------------------------------
        | Upload Images to AWS S3
        |--------------------------------------------------------------------------
        */

        $imageUrls = [];

        if ($request->hasFile('images')) {

            foreach ($request->file('images') as $image) {

                $fileName = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();

                $path = Storage::disk('s3')->putFileAs(
                    'submissions/' . $entryId,
                    $image,
                    $fileName
                );

                $imageUrls[] = Storage::disk('s3')->url($path);
            }
        }

        /*
        |--------------------------------------------------------------------------
        | Save Submission
        |--------------------------------------------------------------------------
        */

        $submission = new DDA();

        $submission->entry_id = $entryId;

        // Participant Information
        $submission->first_name = $validated['first_name'];
        $submission->last_name = $validated['last_name'];
        $submission->email = $validated['email'];
        $submission->phone = $validated['phone'];
        $submission->city = $validated['city'];
        $submission->country = $validated['country'];
        $submission->organisation = $validated['organisation'] ?? null;
        $submission->participant_type = $validated['participant_type'];

        // Entry Details
        $submission->piece_name = $validated['piece_name'];
        $submission->award_category = $validated['award_category'];
        $submission->materials = $validated['materials'];
        $submission->year = $validated['year'];
        $submission->deity = $validated['deity'];
        $submission->statement = $validated['statement'];

        // Images
        $submission->images = $imageUrls;

        // Declaration
        $submission->declaration = true;

        // Status
        $submission->status = 'Pending';

        $submission->save();

        return redirect()
            ->back()
            ->with('success', 'Submission saved successfully! Entry ID: ' . $entryId);
    }

    /**
     * Display a single submission
     */
    public function show($id)
    {
        $submission = DDA::findOrFail($id);

        return view('deitiesdesignawards.admin.show', compact('submission'));
    }
}