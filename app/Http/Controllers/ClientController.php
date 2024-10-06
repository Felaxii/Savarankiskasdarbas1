<?php

namespace App\Http\Controllers;

use App\Models\Conference;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    // Display a list of all conferences
    public function index()
    {
        $conferences = Conference::all();
        return view('client.index', compact('conferences'));
    }

    // Show details of a specific conference
    public function show($id)
    {
        $conference = Conference::findOrFail($id);
        return view('client.show', compact('conference'));
    }

    // Handle registration for a conference (this method can be expanded)
    public function register(Request $request, $id)
    {
        // Validate request data here, e.g., name, email, etc.
        // Register user to the conference (you might need a pivot table)
        // Example: $conference->registrations()->attach($userId);
        
        return redirect()->route('client.index')->with('success', 'Successfully registered for the conference!');
    }
}
