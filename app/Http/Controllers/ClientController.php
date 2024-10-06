<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Conference;

class ClientController extends Controller
{
    // Display all conferences

    public function index()
    {
        $conferences = Conference::current()->get(); // Only get current conferences
        return view('client.conferences.index', compact('conferences'));
    }

    public function show($id)
    {
        $conference = Conference::findOrFail($id);
        return view('client.conferences.show', compact('conference'));
    }
    // Display registration/login form
    public function create()
    {
        return view('client.register'); // Return the registration/login form view
    }

    public function register(Request $request)
    {
   
        return redirect()->route('client.conferences.index'); // Redirect to the conferences index
    }
}
