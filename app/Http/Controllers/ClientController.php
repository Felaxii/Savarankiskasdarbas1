<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Conference;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ClientController extends Controller
{
    // Show the latest conference on the client conferences page
    public function index()
    {
        // Get the latest conference
        $latestConference = Conference::orderBy('created_at', 'desc')->first();

        return view('client.conferences.index', compact('latestConference'));
    }

    // Show the registration form for a specific conference
    public function showConferenceRegisterForm($conferenceId)
    {
        session(['conferenceId' => $conferenceId]);
        $conference = Conference::findOrFail($conferenceId);
        return view('client.conferences.register', compact('conference'));
    }

    // Handle the conference registration form submission
    public function conferenceRegister(Request $request, $conferenceId)
    {
        // Validate user input
        $request->validate([
            'name' => 'required|string|max:255',
            'surname' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
        ]);
    
        // Find the conference
        $conference = Conference::findOrFail($conferenceId);
    
        // Create the user with the provided data
        $user = User::create([
            'name' => $request->name,
            'surname' => $request->surname,
            'email' => $request->email,
            'password' => bcrypt($request->password), // Hash password
        ]);
        
        // Register the user for the conference
        $user->conferences()->attach($conferenceId);
    
        // Log the user in
        Auth::login($user);
    
        // Redirect to the conference details page
        return redirect()->route('client.conferences.show', ['id' => $conference->id]);
    }

    // Show the login form
    public function showLoginForm()
    {
        // Fetch the latest conference
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

        // Redirect to the latest conference page after login
        return redirect()->route('client.conferences.show', ['id' => Conference::latest()->first()->id]);
    }

    public function continueAsClient(Request $request)
    {
        // Set the session or role directly for the client
        session(['role' => 'client']);  // Assign client role
    
        // Redirect to client dashboard
        return redirect()->route('client.conferences.index');
    }

    // Show a specific conference
    public function show($id)
    {
        $conference = Conference::findOrFail($id);
        return view('client.conferences.show', compact('conference'));
    }
    
}
