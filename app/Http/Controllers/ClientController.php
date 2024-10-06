<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Conference;
use App\Models\User;

class ClientController extends Controller
{
    // Show the client conferences index page
    public function index()
    {
        // Fetch the latest conference
        $latestConference = Conference::latest()->first(); // Fetch the latest conference

        return view('client.conferences.index', compact('latestConference')); // Pass the variable to the view
    }

    // Show the registration form
    public function showRegisterForm()
    {
        return view('client.register');
    }

    // Handle the registration logic
    public function register(Request $request)
    {
        // Validate the incoming request data
        $request->validate([
            'username' => 'required|string|max:255|unique:users',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|string|min:8',
        ]);

        // Create a new user with the validated data
        User::create([
            'username' => $request->username,
            'email' => $request->email,
            'password' => bcrypt($request->password), // Hash the password
        ]);

        // Redirect to conferences index with a success message
        return redirect()->route('client.conferences.index')->with('success', 'User registered successfully!');
    }
}
