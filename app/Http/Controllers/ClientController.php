<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Conference;
use App\Models\User;

class ClientController extends Controller
{
    // Show the latest conference on the client conferences page
    public function index()
    {
        $latestConference = Conference::latest()->first(); 
        return view('client.conferences.index', compact('latestConference'));
    }

    // Show the registration form for a specific conference
    public function showConferenceRegisterForm($conferenceId)
    {
        // Find the conference by ID or fail
        $conference = Conference::findOrFail($conferenceId);

        // Pass the conference data to the registration form
        return view('client.conferences.register', compact('conference'));
    }

    // Handle the conference registration form submission
    public function conferenceRegister(Request $request, $conferenceId)
    {
        // Validate user input (name, surname, and email)
        $request->validate([
            'name' => 'required|string|max:255',
            'surname' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email', 
            'password' => 'required|string|min:8|confirmed', // Ensure password is at least 8 characters and confirmed
        ]);
    
        // Find the conference by ID or fail
        $conference = Conference::findOrFail($conferenceId);
    
        // Create the user with the provided data 
        $user = User::create([
            'name' => $request->name,
            'surname' => $request->surname,
            'email' => $request->email,
            'password' => bcrypt($request->password), // Encrypt the password
        ]);
    
        // Register the user for the conference by attaching the conference to the user
        $user->conferences()->attach($conferenceId);
    
        // Redirect to the conference details page with a success message
        return redirect()->route('client.conferences.show', ['id' => $conference->id])
                         ->with('success', 'You have successfully registered for the conference!');
    }
    public function show($id)
{
    // Find the conference by ID
    $conference = Conference::findOrFail($id);

    // Return the view for a specific conference
    return view('client.conferences.show', compact('conference'));
}

}
