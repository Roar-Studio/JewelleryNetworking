<?php

namespace App\Http\Controllers;

use App\Models\DDA;
use Illuminate\Http\Request;

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
        // Validate the form
        $validated = $request->validate([
            'first_name'       => 'required|string|max:255',
            'last_name'        => 'required|string|max:255',
            'email'            => 'required|email|max:255',
            'phone'            => 'nullable|string|max:20',
            'city'             => 'required|string|max:255',
            'country'          => 'required|string|max:255',
            'organisation'     => 'nullable|string|max:255',
            'participant_type' => 'required|string|max:255',

            'piece_name'       => 'required|string|max:255',
            'award_category'   => 'required|string|max:255',
            'materials'        => 'required|string|max:255',
            'year'             => 'required|string|max:10',
            'deity'            => 'required|string|max:255',
            'statement'        => 'required|string',
        ]);

        // Generate Entry ID
        $entryId = 'DDA' . str_pad((DDA::count() + 1), 6, '0', STR_PAD_LEFT);

        // Save data
        $submission = new DDA();

        $submission->entry_id = $entryId;

        $submission->first_name = $validated['first_name'];
        $submission->last_name = $validated['last_name'];
        $submission->email = $validated['email'];
        $submission->phone = $validated['phone'];
        $submission->city = $validated['city'];
        $submission->country = $validated['country'];
        $submission->organisation = $validated['organisation'] ?? null;
        $submission->participant_type = $validated['participant_type'];

        $submission->piece_name = $validated['piece_name'];
        $submission->award_category = $validated['award_category'];
        $submission->materials = $validated['materials'];
        $submission->year = $validated['year'];
        $submission->deity = $validated['deity'];
        $submission->statement = $validated['statement'];

        // Images will be added later
        $submission->images = [];

        // Declaration will be handled later
        $submission->declaration = true;

        // Default status
        $submission->status = 'Pending';

        $submission->save();

        return redirect()
            ->back()
            ->with('success', 'Submission saved successfully! Entry ID: ' . $entryId);
    }

    /**
     * Show a single submission
     */
    public function show($id)
    {
        $submission = DDA::findOrFail($id);

        return view('deitiesdesignawards.admin.show', compact('submission'));
    }
}