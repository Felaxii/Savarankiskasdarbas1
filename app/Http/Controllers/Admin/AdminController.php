<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Conference;  // Example for handling conferences (you can modify this)
use App\Models\User;  // Example for handling users (you can modify this)

class AdminController extends Controller
{
    // Constructor to apply auth middleware and role-based access control
    public function __construct()
    {
        $this->middleware('auth');  // Ensure user is logged in
        $this->middleware('role:admin');  // Ensure user is an admin
    }

    // Admin dashboard
    public function index()
    {
        // You can retrieve data to show on the admin dashboard, e.g., conferences, users, etc.
        $conferences = Conference::all();  // Example: get all conferences
        $users = User::all();  // Example: get all users

        // Return view with data
        return view('admin.dashboard', compact('conferences', 'users'));
    }

    // Example method to show a list of conferences
    public function listConferences()
    {
        $conferences = Conference::all();  // Fetch all conferences from database
        return view('admin.conferences.index', compact('conferences'));  // Show conferences in a view
    }

    // Example method to create a new conference
    public function createConference(Request $request)
    {
        // Validate the incoming request
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'date' => 'required|date',
        ]);

        // Create a new conference
        Conference::create([
            'name' => $request->input('name'),
            'description' => $request->input('description'),
            'date' => $request->input('date'),
        ]);

        // Redirect back with success message
        return redirect()->route('admin.conferences.index')->with('success', 'Conference created successfully!');
    }

    // Example method to delete a conference
    public function deleteConference($id)
    {
        $conference = Conference::findOrFail($id);
        $conference->delete();

        // Redirect back with success message
        return redirect()->route('admin.conferences.index')->with('success', 'Conference deleted successfully!');
    }

    // Example method to manage users (list, activate/deactivate, etc.)
    public function manageUsers()
    {
        $users = User::all();  // Fetch all users from database
        return view('admin.users.index', compact('users'));  // Show users in a view
    }
}
