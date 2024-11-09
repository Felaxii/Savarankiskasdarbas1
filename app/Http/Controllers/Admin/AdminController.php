<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Conference;  // Example for handling conferences (you can modify this)
use App\Models\User;  // Example for handling users (you can modify this)

class AdminController extends Controller
{
    public function __construct()
    {
        // Ensure this controller is only accessible by admins via the middleware
        $this->middleware('role:admin'); // This ensures only admins can access the admin dashboard
    }

    // Admin dashboard
    public function index()
    {
        $conferences = Conference::all();  // Get all conferences
        $users = User::all();  // Get all users
        return view('admin.home', compact('conferences', 'users'));
    }

    // Method to list all conferences
    public function listConferences()
    {
        // Try to fetch all conferences from the database
        try {
            $conferences = Conference::all(); // Ensure the model is correctly imported
            return view('admin.conferences.index', compact('conferences')); // Passing data to the view
        } catch (\Exception $e) {
            // Catch any exception and log it for debugging
            \Log::error('Error fetching conferences: ' . $e->getMessage());
            return response()->view('errors.500', [], 500); // Return a custom 500 error page
        }
    }

    // Method to create a new conference
    public function createConference()
    {
        return view('admin.conferences.create');
    }

    // Method to store a new conference
    public function storeConference(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'date' => 'required|date',
        ]);

        Conference::create($request->all());

        return redirect()->route('admin.conferences.index')->with('success', 'Conference created successfully!');
    }

    // Method to delete a conference
    public function deleteConference($id)
    {
        $conference = Conference::findOrFail($id);
        $conference->delete();
        
        return redirect()->route('admin.conferences.index')->with('success', 'Conference deleted successfully!');
    }

    // Method to manage users
    public function manageUsers()
    {
        $users = User::all();
        return view('admin.users.index', compact('users'));
    }
}
