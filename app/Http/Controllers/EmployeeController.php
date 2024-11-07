<?php

namespace App\Http\Controllers;

use App\Models\Conference;

class EmployeeController extends Controller
{
    public function index()
    {
        $conferences = Conference::all(); 
        return view('employee.conferences.index', compact('conferences'));
    }

    public function show($id)
    {
        $conference = Conference::findfirst($id);
        return view('employee.conferences.show', compact('conference'));
    }
    public function showAttendees($conferenceId)
    {
       
        $conference = Conference::findOrFail($conferenceId);
       
        $attendees = $conference->users()->whereNull('users.deleted_at')->get();
    
        return view('employee.conferences.attendees', compact('conference', 'attendees'));
    }
}

