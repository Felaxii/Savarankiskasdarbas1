<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ConferenceRequest;
use App\Models\Conference;

class ConferenceController extends Controller
{
    // Display a listing of the conferences
    public function index()
    {
        $conferences = Conference::all();
        return view('admin.conferences.index', compact('conferences'));
    }

    // Show the form for creating a new conference
    public function create()
    {
        return view('admin.conferences.create');
    }

    // Store a newly created conference
    public function store(ConferenceRequest $request)
    {
        // Use $request->validated() to get the validated data
        $validatedData = $request->validated();

        // Create a new conference
        Conference::create($validatedData);

        return redirect()->route('admin.conferences.index')->with('success', 'Conference created successfully!');
    }

    // Show the form for editing a specific conference
    public function edit($id)
    {
        $conference = Conference::findOrFail($id);
        return view('admin.conferences.edit', compact('conference'));
    }

    // Update a specific conference
    public function update(ConferenceRequest $request, $id)
    {
        $conference = Conference::findOrFail($id);
        
        // Update the conference with validated data
        $conference->update($request->validated());

        return redirect()->route('admin.conferences.index')->with('success', 'Conference updated successfully!');
    }

    // Remove a specific conference
    public function destroy($id)
    {
        $conference = Conference::findOrFail($id);
        $conference->delete();

        return redirect()->route('admin.conferences.index')->with('success', 'Conference deleted successfully!');
    }
}
