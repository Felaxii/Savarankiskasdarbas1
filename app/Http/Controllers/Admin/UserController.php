<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    // Display the list of users
    public function index()
    {
        // Fetch all users (you can add pagination if needed)
        $users = User::all();

        // Return the users view with the list of users
        return view('admin.users.index', compact('users'));
    }

    // Show the form for editing a user
    public function edit($id)
    {
        // Find the user by ID
        $user = User::findOrFail($id);
        
        // Return the edit view with the user data
        return view('admin.users.edit', compact('user'));
    }

    // Update the user in the database
    public function update(Request $request, $id)
    {
        // Validate the input
        $request->validate([
            'name' => 'required|string|max:255',
            'surname' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $id,
        ]);

        // Find the user by ID
        $user = User::findOrFail($id);

        // Update the user with the new data
        $user->update([
            'name' => $request->name,
            'surname' => $request->surname,
            'email' => $request->email,
        ]);

        // Redirect back with a success message
        return redirect()->route('admin.users.index')
                         ->with('success', 'User updated successfully!');
    }

    // Delete the user
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('admin.users.index')
                         ->with('success', 'User deleted successfully!');
    }
}
