<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Conference;

class ClientController extends Controller
{
    // Display all conferences
    public function index()
    {
        $conferences = Conference::all(); // Get all conferences
        return view('client.conferences.index', compact('conferences')); // Return view with conferences
    }

    // Display specific conference details
    public function show($id)
    {
        $conference = Conference::findOrFail($id); // Find the conference by ID
        return view('client.conferences.show', compact('conference')); // Return specific conference view
    }

    // Display registration/login form
    public function create()
    {
        return view('client.register'); // Return the registration/login form view
    }

    public function register(Request $request)
    {
        // Here you would handle the registration logic (if any)
        // For now, simply refresh the page as per your requirements
        return redirect()->route('client.conferences.index'); // Redirect to the conferences index
    }
}
