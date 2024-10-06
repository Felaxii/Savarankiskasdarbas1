<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Conference;
use Illuminate\Http\Request;

class ConferenceController extends Controller
{
    // Display a list of all conferences
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

    // Store a newly created conference in storage
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'speakers' => 'required|string',
            'date' => 'required|date',
            'time' => 'required|date_format:H:i',
            'address' => 'required|string|max:255',
        ]);

        Conference::create($request->all());

        return redirect()->route('admin.conferences.index')->with('success', 'Conference created successfully!');
    }

    // Show the form for editing a specific conference
    public function edit($id)
    {
        $conference = Conference::findOrFail($id);
        return view('admin.conferences.edit', compact('conference'));
    }

    // Update a specific conference
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'speakers' => 'required|string',
            'date' => 'required|date',
            'time' => 'required|date_format:H:i',
            'address' => 'required|string|max:255',
        ]);

        $conference = Conference::findOrFail($id);
        $conference->update($request->all());

        return redirect()->route('admin.conferences.index')->with('success', 'Conference updated successfully!');
    }

    // Delete a specific conference
    public function destroy($id)
    {
        $conference = Conference::findOrFail($id);
        
        // Ensure conference is not already occurred
        if ($conference->date < now()) {
            return redirect()->route('admin.conferences.index')->with('error', 'Cannot delete past conferences!');
        }
        
        $conference->delete();
        return redirect()->route('admin.conferences.index')->with('success', 'Conference deleted successfully!');
    }
}
