<?php

namespace App\Http\Controllers;

use App\Models\Conference;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    // Display all past and upcoming conferences
    public function index()
    {
        $conferences = Conference::all();
        return view('employee.index', compact('conferences'));
    }

    // Show details of a specific conference along with registered clients
    public function show($id)
    {
        $conference = Conference::with('registrations')->findOrFail($id);
        return view('employee.show', compact('conference'));
    }
}
