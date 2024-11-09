<?php

namespace App\Http\Controllers;

use App\Models\Conference;

class EmployeeController extends Controller
{
    public function index()
    {
        // Get all conferences to display to the employee
        $conferences = Conference::all(); 
        return view('employee.conferences.index', compact('conferences'));
    }

    public function show($id)
    {
        // Fix: Use findOrFail to throw an exception if the conference is not found
        $conference = Conference::findOrFail($id);
        return view('employee.conferences.show', compact('conference'));
    }
    public function showAttendees($conferenceId)
    {
        // Ensure the conference exists
        $conference = Conference::findOrFail($conferenceId);
    
        // Get the attendees for this conference (include soft-deleted users)
        $attendees = $conference->users()
            ->withTrashed() // Include soft-deleted users
            ->whereNull('users_conferences.deleted_at') // Ensure the registration is not deleted
            ->get();
    
        // Pass the conference and attendees data to the view
        return view('employee.conferences.attendees', compact('conference', 'attendees'));
    }
}
