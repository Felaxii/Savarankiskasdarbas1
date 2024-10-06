<?php

namespace App\Http\Controllers;

use App\Models\Conference;

class EmployeeController extends Controller
{
    public function index()
    {
        $conferences = Conference::all(); // Get all conferences
        return view('employee.conferences.index', compact('conferences')); // Return view with conferences
    }

    public function show($id)
    {
        $conference = Conference::findOrFail($id); // Find the conference by ID
        return view('employee.conferences.show', compact('conference')); // Return specific conference view
    }
}
