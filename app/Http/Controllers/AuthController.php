<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    // Continue as Client: Automatically assign the 'client' role
    public function continueAsClient()
    {
        // Assign the 'client' role to the session
        Session::put('role', 'client');
        
        // Redirect to client conferences page
        return redirect()->route('client.conferences.index');
    
    }

    public function loginEmployee(Request $request)
    {
        $credentials = $request->only('name', 'password');
        
        if ($credentials['name'] === env('EMPLOYEE_LOGIN') && Hash::check($credentials['password'], env('EMPLOYEE_PASSWORD'))) {
            Auth::loginUsingId(1); // Assuming the Employee has ID 1
            return redirect()->route('employee.conferences.index');
        }
        
        return back()->withErrors(['Invalid credentials.']);
    }

    // Login for Admin
    public function loginAdmin(Request $request)
    {
        $credentials = $request->only('name', 'password');
        
        if ($credentials['name'] === env('ADMIN_LOGIN') && Hash::check($credentials['password'], env('ADMIN_PASSWORD'))) {
            Auth::loginUsingId(2); // Assuming Admin has ID 2
            return redirect()->route('admin.home');
        }
        
        return back()->withErrors(['Invalid credentials.']);
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
}
