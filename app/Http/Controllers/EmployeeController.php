<?php

namespace App\Http\Controllers;

use App\Models\Conference;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    public function index()
    {
        // Fetch all conferences to show to the client
        $conferences = Conference::all();
        return view('client.conferences.index', compact('conferences'));
    }

    public function show($id)
    {
        // Show a specific conference
        $conference = Conference::findOrFail($id);
        return view('client.conferences.show', compact('conference'));
    }
}
