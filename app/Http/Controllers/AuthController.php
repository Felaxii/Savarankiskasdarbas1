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
        if (Auth::check()) {
            $user = Auth::user();
            
            // Assign 'client' role if not already assigned
            if (!$user->hasRole('client')) {
                $user->assignRole('client');
            }
        } else {
            Session::put('role', 'guest');
        }

        return redirect()->route('client.conferences.index');
    }

    // Employee Login
    public function loginEmployee(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $user = Auth::user();

            if ($user->hasRole('employee')) {
                session(['role' => 'employee']);
                return redirect()->route('employee.conferences.index');
            }

            Auth::logout();
            return back()->withErrors(['email' => 'Unauthorized: Employee role required']);
        }

        return back()->withErrors(['email' => 'Invalid credentials'])->withInput();
    }
    
    // Admin Login
    public function loginAdmin(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $user = Auth::user();

            if ($user->hasRole('admin')) {
                session(['role' => 'admin']);
                return redirect()->route('admin.home');
            }

            Auth::logout();
            return back()->withErrors(['email' => 'Unauthorized: Admin role required']);
        }

        return back()->withErrors(['email' => 'Invalid credentials'])->withInput();
    }

    // Client Login
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::guard('client')->attempt($request->only('email', 'password'))) {
            return redirect()->route('client.redirectToLatestConference');
        }

        return back()->withErrors(['email' => 'Invalid credentials']);
    }

    // Logout logic
    public function logout(Request $request)
    {
        Auth::logout();
        return redirect()->route('welcome');
    }

    // Display Login Form
    public function displayLogin(Request $request)
    {
        $loginType = $request->route()->getName() === 'admin.login' ? 'Admin' : 'Employee';
        return view('auth.login', compact('loginType'));
    }

    // Example function to show users with conferences
    public function showUsersWithConferences()
    {
        $users = User::with(['conferences' => function ($query) {
            $query->whereNull('users_conferences.deleted_at');
        }])
        ->whereNull('users.deleted_at')
        ->get();

        return view('admin.users.index', compact('users'));
    }
}
