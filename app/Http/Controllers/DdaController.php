<?php

namespace App\Http\Controllers;

use App\Models\DDA;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DdaController extends Controller
{
    /**
     * Display all submissions.
     */
    public function index()
    {
        $submissions = DDA::latest()->get();

        return view('deitiesdesignawards.admin.index', compact('submissions'));
    }

    /**
     * Store a new submission.
     */
    public function store(Request $request)
    {
        /*
        |--------------------------------------------------------------------------
        | Validation
        |--------------------------------------------------------------------------
        */
        
        $validated = $request->validate([

            /*
            |--------------------------------------------------------------------------
            | Participant Information
            |--------------------------------------------------------------------------
            */

            'first_name'       => 'required|string|max:255',
            'last_name'        => 'required|string|max:255',
            'email'            => 'required|email|max:255',
            'phone'            => 'required|string|max:20',
            'city'             => 'required|string|max:255',
            'country'          => 'required|string|max:255',
            'organisation'     => 'nullable|string|max:255',
            'participant_type' => 'required|string',
            'participant_type_other' => [
                'nullable',
                'string',
                'max:255',
                'required_if:participant_type,other',
            ],

            /*
            |--------------------------------------------------------------------------
            | Entry A
            |--------------------------------------------------------------------------
            */

            'deity_category_a' => 'required|string|max:255',
            'jewellery_piece_a' => 'required|string|max:255',
            'material_a'       => 'required|string|max:255',
            'statement_a'      => 'required|string|min:150',

            'images_a'         => 'required|array|min:1|max:10',
            'images_a.*'       => 'image|mimes:jpg,jpeg,png|max:25600',

            /*
            |--------------------------------------------------------------------------
            | Entry B
            |--------------------------------------------------------------------------
            */

            'deity_category_b' => 'required|string|max:255',
            'jewellery_piece_b' => 'required|string|max:255',
            'material_b'       => 'required|string|max:255',
            'statement_b'      => 'required|string|min:150',

            'images_b'         => 'required|array|min:1|max:10',
            'images_b.*'       => 'image|mimes:jpg,jpeg,png|max:25600',

            /*
            |--------------------------------------------------------------------------
            | Declaration
            |--------------------------------------------------------------------------
            */

            'declaration'      => 'accepted',
        ]);

        /*
        |--------------------------------------------------------------------------
        | Duplicate Submission Prevention
        |--------------------------------------------------------------------------
        | Block a new submission if an existing record with the same Email ID
        | or Phone Number is still "active" (Pending, Payment Pending, or
        | Under Review). Submissions marked Completed, Rejected, or Cancelled
        | are considered resolved and do not block a fresh submission.
        */

        $activeStatuses = [
            'Pending',
            'Payment Pending',
            'Under Review',
        ];

        $duplicateSubmission = DDA::where(function ($query) use ($validated) {

            $query->where('email', $validated['email']);

            if (!empty($validated['phone'])) {
                $query->orWhere('phone', $validated['phone']);
            }
        })
            ->whereIn('status', $activeStatuses)
            ->exists();
        
        $nextId = (DDA::max('id') ?? 0) + 1;
        $entryId = 'DDA' . str_pad($nextId, 6, '0', STR_PAD_LEFT);
        

        /*
        |--------------------------------------------------------------------------
        | Generate Entry ID
        |--------------------------------------------------------------------------
        */

        $nextId = (DDA::max('id') ?? 0) + 1;

        $entryId = 'DDA' . str_pad($nextId, 6, '0', STR_PAD_LEFT);

        /*
        |--------------------------------------------------------------------------
        | Upload Entry A Images
        |--------------------------------------------------------------------------
        */
        

        // $imagesA = [];


        // if ($request->hasFile('images_a')) {

        //     foreach ($request->file('images_a') as $image) {

        //         $fileName = uniqid() . '_' . time() . '.' . $image->getClientOriginalExtension();

        //         $path = Storage::disk('s3')->putFileAs(
        //             "submissions/{$entryId}/entry_a",
        //             $image,
        //             $fileName
        //         );

        //         $imagesA[] = Storage::disk('s3')->url($path);
        //     }
        // }

        $imagesA = [];

        if ($request->hasFile('images_a')) {

        foreach ($request->file('images_a') as $image) {

        $fileName = uniqid() . '_' . time() . '.' . $image->getClientOriginalExtension();

        try {

    $path = Storage::disk('s3')->putFileAs(
        "submissions/{$entryId}/entry_a",
        $image,
        $fileName
    );

    $imagesA[] = Storage::disk('s3')->url($path);

} catch (\Exception $e) {

    dd($e->getMessage());

}

    }

}

        /*
        |--------------------------------------------------------------------------
        | Upload Entry B Images
        |--------------------------------------------------------------------------
        */

        // $imagesB = [];

        // if ($request->hasFile('images_b')) {

        //     foreach ($request->file('images_b') as $image) {

        //         $fileName = uniqid() . '_' . time() . '.' . $image->getClientOriginalExtension();

        //         $path = Storage::disk('s3')->putFileAs(
        //             "submissions/{$entryId}/entry_b",
        //             $image,
        //             $fileName
        //         );

        //         $imagesB[] = Storage::disk('s3')->url($path);
        //     }
        // }

        $imagesB = [];

if ($request->hasFile('images_b')) {

    foreach ($request->file('images_b') as $image) {

        $fileName = uniqid() . '_' . time() . '.' . $image->getClientOriginalExtension();

        try {

            $path = Storage::disk('s3')->putFileAs(
                "submissions/{$entryId}/entry_b",
                $image,
                $fileName
            );

            $imagesB[] = Storage::disk('s3')->url($path);

        } catch (\Exception $e) {

            dd($e->getMessage());

        }

    }

}
        /*
        |--------------------------------------------------------------------------
        | Save Submission
        |--------------------------------------------------------------------------
        */

        $submission = new DDA();

        /*
        |--------------------------------------------------------------------------
        | Participant
        |--------------------------------------------------------------------------
        */

        $submission->entry_id         = $entryId;

        $submission->first_name       = $validated['first_name'];
        $submission->last_name        = $validated['last_name'];
        $submission->email            = $validated['email'];
        $submission->phone            = $validated['phone'] ?? null;
        $submission->city             = $validated['city'];
        $submission->country          = $validated['country'];
        $submission->organisation     = $validated['organisation'] ?? null;
        if ($validated['participant_type'] === 'other') {
            $submission->participant_type = $validated['participant_type_other'];
        } else {
            $submission->participant_type = $validated['participant_type'];
        }

        /*
        |--------------------------------------------------------------------------
        | Entry A
        |--------------------------------------------------------------------------
        */

        $submission->deity_category_a = $validated['deity_category_a'];
        $submission->jewellery_piece_a = $validated['jewellery_piece_a'];
        $submission->material_a = $validated['material_a'];
        $submission->statement_a = $validated['statement_a'];
        $submission->images_a = $imagesA;

        /*
        |--------------------------------------------------------------------------
        | Entry B
        |--------------------------------------------------------------------------
        */

        $submission->deity_category_b = $validated['deity_category_b'];
        $submission->jewellery_piece_b = $validated['jewellery_piece_b'];
        $submission->material_b = $validated['material_b'];
        $submission->statement_b = $validated['statement_b'];
        $submission->images_b = $imagesB;

        /*
        |--------------------------------------------------------------------------
        | Other Fields
        |--------------------------------------------------------------------------
        */

        $submission->declaration = true;
        $submission->status = 'Pending';

        $submission->save();

        /*
        |--------------------------------------------------------------------------
        | Redirect to Order Summary
        |--------------------------------------------------------------------------
        */

        return redirect()->route('dda.order.summary', $submission->id);
    }

    /**
     * Display a submission.
     */
    public function show($id)
    {
        $submission = DDA::findOrFail($id);

        return view('deitiesdesignawards.admin.show', compact('submission'));
    }
}
