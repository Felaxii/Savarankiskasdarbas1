<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Conference;

class ClientController extends Controller
{
    // Display the latest conference for clients
    public function index()
    {
        // Fetch only the latest conference
        $latestConference = Conference::latest()->first(); // Fetch the latest conference

        return view('client.conferences.index', compact('latestConference'));
    }

    public function show($id)
    {
        $conference = Conference::findOrFail($id); // Use findOrFail for better error handling
        return view('client.conferences.show', compact('conference'));
    }

    
    public function create()
    {
        return view('client.register'); // Return the registration/login form view
    }

    public function register(Request $request)
    {
        // Placeholder for registration logic

        return redirect()->route('client.conferences.index'); // Redirect to the conferences index
    }
}
