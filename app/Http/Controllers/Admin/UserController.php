<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all(); // Fetch all users
        return view('admin.users.index', compact('users'));
    }

    public function edit($id)
    {
        $user = User::findOrFail($id); // Find user by ID
        return view('admin.users.edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        // Validate and update user information
        $user = User::findOrFail($id);
        $user->update($request->only(['name', 'surname', 'email']));
        return redirect()->route('admin.users.index')->with('success', 'User updated successfully!');
    }
}
