<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends Controller
{
    // Handle employee and admin login form submission
    public function login(Request $request)
    {
        // Validate login inputs
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        // Check if the user is logging in as employee
        if ($request->email == env('EMPLOYEE_LOGIN') && Hash::check($request->password, env('EMPLOYEE_PASSWORD'))) {
            // Employee login
            $user = User::where('email', env('EMPLOYEE_LOGIN'))->first();
            Auth::login($user);

            // Redirect to employee conference view
            return redirect()->route('employee.conferences.index');
        }

        // Check if the user is logging in as admin
        if ($request->email == env('ADMIN_LOGIN') && Hash::check($request->password, env('ADMIN_PASSWORD'))) {
            // Admin login
            $user = User::where('email', env('ADMIN_LOGIN'))->first();
            Auth::login($user);

            // Redirect to admin dashboard (handling directly in web.php or elsewhere)
            return redirect()->route('admin.dashboard');
        }

        // If credentials do not match, return error
        return back()->withErrors(['email' => 'Invalid credentials'])->withInput();
    }

    // Handle logout
    public function logout(Request $request)
    {
        Auth::logout();
        return redirect()->route('welcome');
    }
}
