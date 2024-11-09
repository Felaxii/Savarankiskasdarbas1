<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Session;

class AuthController extends Controller
{
// Continue as Client: Automatically assign the 'client' role
public function continueAsClient()
{
    // Check if the user is logged in
    if (Auth::check()) {
        $user = Auth::user();
        
        // Check if the user already has the 'client' role to avoid duplicate role assignment
        if (!$user->hasRole('client')) {
            $user->assignRole('client');
        }
    } else {
        // If not logged in, redirect to login page or assign a guest role if needed
        Session::put('role', 'guest');
    }

    return redirect()->route('client.conferences.index');
}

    public function loginEmployee(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);
    
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $user = Auth::user();
            
            // Check if the user has the 'employee' role
            if ($user->hasRole('employee')) {
                return redirect()->route('employee.conferences.index');
            }
            
            Auth::logout();
            return back()->withErrors(['email' => 'Unauthorized: Employee role required']);
        }
    
        return back()->withErrors(['email' => 'Invalid credentials'])->withInput();
    }
    
    // Example for admin login
    public function loginAdmin(Request $request)
    {
        // Login logic for admin
        // Once logged in, redirect to admin home
        return redirect()->route('admin.home');
    }

    // Logout logic
    public function logout(Request $request)
    {
        Auth::logout();
        return redirect()->route('welcome');
    }

    // Display login form (for Employee or Admin)
    public function displayLogin()
    {
        return view('auth.login');
    }

    public function authenticated(Request $request, $user)
    {
        if ($user->role === 'admin') {
            return redirect()->route('admin.home'); // Admin dashboard
        } elseif ($user->role === 'employee') {
            return redirect()->route('employee.conferences.index'); // Employee dashboard
        }

        return redirect()->route('client.dashboard'); // Default to client dashboard
    }
    public function login(Request $request)
{
    // Validate login
    $request->validate([
        'email' => 'required|email',
        'password' => 'required',
    ]);

    // Attempt to log in as a client
    if (Auth::guard('client')->attempt($request->only('email', 'password'))) {
        return redirect()->route('client.redirectToLatestConference');
    }

    return back()->withErrors(['email' => 'Invalid credentials']);
}
}
