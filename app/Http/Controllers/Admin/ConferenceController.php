<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ConferenceRequest;
use App\Models\Conference;
use Illuminate\Http\Request;

class ConferenceController extends Controller
{
    // Display a listing of the conferences
    public function index()
    {
        $conferences = Conference::all(); // Fetch all conferences
        return view('admin.conferences.index', compact('conferences')); // Pass to the view
    }

    // Show the form for creating a new conference
    public function create()
    {
        return view('admin.conferences.create');
    }

    // Store a newly created conference
    public function store(Request $request)
    {
        // Validate the incoming request data
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'speakers' => 'required|string|max:255',
            'date' => 'required|date',
            'time' => 'required|date_format:H:i',
            'address' => 'required|string|max:255',
        ]);
    
        // Create a new conference with the validated data
        Conference::create($request->all());
    
        // Redirect back to the index with a success message
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
