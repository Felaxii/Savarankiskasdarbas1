<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Conference;
use App\Models\User;
use App\Models\Role; 
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ClientController extends Controller
{
    // Show the latest conference on the client conferences page
    public function index()
    {
        // Get the latest conference
        $latestConference = Conference::latest()->first(); 
        return view('client.conferences.index', compact('latestConference'));
    }

    // Show the registration form for a specific conference
    public function showConferenceRegisterForm($conferenceId)
    {
        // Store the conferenceId in the session so it can be used after login
        session(['conferenceId' => $conferenceId]);

        // Find the conference by ID or fail
        $conference = Conference::findOrFail($conferenceId);

        // Return the registration form view with conference data
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
            'password' => 'required|string|min:8|confirmed',
        ]);
    
        // Find the conference by ID or fail
        $conference = Conference::findOrFail($conferenceId);
    
        // Create the user with the provided data
        $user = User::create([
            'name' => $request->name,
            'surname' => $request->surname,
            'email' => $request->email,
            'password' => bcrypt($request->password), // Hash password
        ]);
        
    
        // Assign the 'client' role to the user explicitly
        $role = \App\Models\Role::where('name', 'client')->first();
        if ($role) {
            $user->roles()->attach($role);
        }
    
        // Register the user for the conference by attaching the conference to the user
        $user->conferences()->attach($conferenceId);
    
        // Log the user in after registration
        Auth::login($user);
    
        // Redirect to the conference details page
        return redirect()->route('client.conferences.show', ['id' => $conference->id]);
    }

    // Show the login form
    public function showLoginForm()
    {
        // Get the latest conference
        $latestConference = Conference::latest()->first(); 
        return view('client.conferences.login', compact('latestConference'));
    }

    // Handle login form submission
    public function login(Request $request)
    {
        // Validate the login inputs
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);
    
        // Attempt to authenticate the user
        $user = User::where('email', $request->email)->first();
    
        // Check if the user exists and if the password is correct
        if (!$user || !Hash::check($request->password, $user->password)) {
            return back()->withErrors(['email' => 'Invalid credentials'])->withInput();
        }
    
        // Log the user in
        Auth::login($user);
    
        // Check if a conferenceId is stored in the session
        $conferenceId = session('conferenceId');
    
        // If a conferenceId exists, redirect to the conference details page (show.blade.php)
        if ($conferenceId) {
            return redirect()->route('client.conferences.show', ['id' => $conferenceId]);
        }
    
        // If no conferenceId exists, redirect to the most recent conference details page
        $latestConference = Conference::latest()->first();
        if ($latestConference) {
            return redirect()->route('client.conferences.show', ['id' => $latestConference->id]);
        }
    
        // Default fallback: redirect to the main conferences index page
        return redirect()->route('client.conferences.index');
    }
    
    

    // Show a specific conference
    public function show($id)
    {
        // Find the conference by its ID
        $conference = Conference::findOrFail($id);
    
        // Return the view with conference details
        return view('client.conferences.show', compact('conference'));
    }


    
}
