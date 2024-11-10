<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Conference; 
use App\Models\User; 

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
        $conferences = Conference::all(); 
        $users = User::all();  
        return view('admin.home', compact('conferences', 'users'));
    }

    // Method to list all conferences
    public function listConferences()
    {
        // Try to fetch all conferences from the database
        try {
            $conferences = Conference::all(); 
            return view('admin.conferences.index', compact('conferences')); 
        } catch (\Exception $e) {
            // Catch any exception and log it for debugging
            \Log::error('Error fetching conferences: ' . $e->getMessage());
            return response()->view('errors.500', [], 500);
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
        'title' => 'required|string|max:255',
        'description' => 'required|string',
        'speakers' => 'required|string', 
        'date' => 'required|date',
        'time' => 'required|date_format:H:i', 
        'address' => 'required|string',
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
    // Method to show the conference edit form
    public function editConference($id)
{
    // Fetch the conference by ID
    $conference = Conference::findOrFail($id);  

    // Return the view and pass the conference data
    return view('admin.conferences.edit', compact('conference'));
}
    // Method to update a conference
    public function updateConference(Request $request, $id)
{
    $request->validate([
        'title' => 'required|string|max:255',
        'description' => 'required|string',
        'speakers' => 'required|string', 
        'date' => 'required|date',
        'time' => 'required|date_format:H:i',
        'address' => 'required|string', 
    ]);

    // Find the conference by ID
    $conference = Conference::findOrFail($id);

    // Update the conference with the new data
    $conference->update([
        'title' => $request->input('title'),
        'description' => $request->input('description'),
        'speakers' => $request->input('speakers'),
        'date' => $request->input('date'),
        'time' => $request->input('time'),
        'address' => $request->input('address'),
    ]);

    return redirect()->route('admin.conferences.index')->with('success', 'Conference updated successfully!');
}

    // Method to manage users
    public function manageUsers()
    {
        $users = User::all();
        return view('admin.users.index', compact('users'));
    }
        // Method to show the user edit form
        public function editUser(User $user)
        {
            // Return the edit view and pass the user to it
            return view('admin.users.edit', compact('user'));
        }
    
        // Method to delete a user
        public function destroyUser(User $user)
        {
            // Delete the user
            $user->delete();
    
            // Redirect back to the user management page with success message
            return redirect()->route('admin.users.index')->with('success', 'User deleted successfully!');
        }
        public function updateUser(Request $request, User $user)
        {
            // Validate the incoming request
            $request->validate([
                'name' => 'required|string|max:255',
                'surname' => 'required|string|max:255',
                'email' => 'required|email|unique:users,email,' . $user->id,  
            ]);
        
            // Update the user with only the allowed fields
            $user->update([
                'name' => $request->input('name'),
                'surname' => $request->input('surname'),
                'email' => $request->input('email'),
            ]);
    
    
            // Redirect to the user management page with a success message
            return redirect()->route('admin.users.index')->with('success', 'User updated successfully!');
        }
}
