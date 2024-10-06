<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Conference;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    // List all conferences
    public function index()
    {
        $conferences = Conference::all();
        return view('client.conferences.index', compact('conferences'));
    }

    // Show a specific conference
    public function show($id)
    {
        $conference = Conference::findOrFail($id);
        return view('client.conferences.show', compact('conference'));
    }

    // Register for a conference (dummy implementation)
    public function register(Request $request)
    {
        // This is a dummy registration, doesn't store data
        return redirect()->back()->with('success', 'You have registered successfully! (dummy action)');
    }
}
