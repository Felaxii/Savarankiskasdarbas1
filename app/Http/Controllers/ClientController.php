<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Conference;
use App\Models\User;

class ClientController extends Controller
{
    public function index()
    {
   
        $latestConference = Conference::latest()->first(); 

        return view('client.conferences.index', compact('latestConference')); 
    }
    public function showRegisterForm()
    {
        return view('client.register');
    }

    public function register(Request $request)
    {

        $request->validate([
            'username' => 'required|string|max:255|unique:users',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|string|min:8',
        ]);

        User::create([
            'username' => $request->username,
            'email' => $request->email,
            'password' => bcrypt($request->password), 
        ]);
        return redirect()->route('client.conferences.index')->with('success', 'User registered successfully!');
    }
}
