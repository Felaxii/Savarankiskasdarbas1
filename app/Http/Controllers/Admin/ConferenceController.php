<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ConferenceRequest;
use App\Models\Conference;
use Illuminate\Http\Request;

class ConferenceController extends Controller
{
    public function index()
    {
        $conferences = Conference::all(); 
        return view('admin.conferences.index', compact('conferences')); 
    }

    public function create()
    {
        return view('admin.conferences.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'speakers' => 'required|string|max:255',
            'date' => 'required|date',
            'time' => 'required|date_format:H:i',
            'address' => 'required|string|max:255',
        ]);

        Conference::create($request->all());
    
        return redirect()->route('admin.conferences.index')->with('success', 'Conference created successfully!');
    }

    public function edit($id)
    {
        $conference = Conference::findOrFail($id);
        return view('admin.conferences.edit', compact('conference'));
    }

    public function update(ConferenceRequest $request, $id)
    {
        $conference = Conference::findOrFail($id);

        // Update conference details
        $conference->update($request->validated());

        return redirect()->route('admin.conferences.index')->with('success', 'Conference updated successfully!');
    }

    public function destroy($id)
    {
        $conference = Conference::findOrFail($id);
        $conference->delete();

        return redirect()->route('admin.conferences.index')->with('success', 'Conference deleted successfully!');
    }

    public function showAttendees($conferenceId)
    {
        $conference = Conference::findOrFail($conferenceId);

        // Fetch attendees who are not deleted
        $attendees = $conference->users()->whereNull('deleted_at')->get();

        return view('employee.conferences.attendees', compact('conference', 'attendees'));
    }
}
