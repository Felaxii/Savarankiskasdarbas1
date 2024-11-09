<?php

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Illuminate\Http\Request;

class UserController extends Controller
{
    // Method to create an employee user
    public function createEmployee()
    {
        // Check if the employee already exists to avoid duplicates
        if (User::where('email', 'employee@example.com')->exists()) {
            return redirect()->route('admin.users.index')->with('error', 'Employee already exists.');
        }

        // Create a new user with fixed values
        $user = User::create([
            'name' => 'Employee',
            'surname' => 'Employee',
            'email' => 'employee@gmail.com',
            'password' => Hash::make('Employee'),  // Password is hashed
        ]);

        // Assign the 'employee' role
        $user->assignRole('employee');

        // Redirect back with a success message
        return redirect()->route('admin.users.index')->with('success', 'Employee created successfully.');
    }

    // Method to create an admin user (same idea)
    public function createAdmin()
    {
        // Check if the admin already exists
        if (User::where('email', 'admin@gmail.com')->exists()) {
            return redirect()->route('admin.users.index')->with('error', 'Admin already exists.');
        }

        // Create a new user (admin)
        $user = User::create([
            'name' => 'Admin',
            'surname' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('Admin'),  // Password is hashed
        ]);

        // Assign the 'admin' role
        $user->assignRole('admin');

        // Redirect with success message
        return redirect()->route('admin.users.index')->with('success', 'Admin created successfully.');
    }
}
