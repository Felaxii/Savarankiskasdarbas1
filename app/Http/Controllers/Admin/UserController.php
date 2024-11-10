<?php

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function createEmployee()
    {
        if (User::where('email', 'employee@example.com')->exists()) {
            return redirect()->route('admin.users.index')->with('error', 'Employee already exists.');
        }
        $user = User::create([
            'name' => 'Employee',
            'surname' => 'Employee',
            'email' => 'employee@gmail.com',
            'password' => Hash::make('Employee'),  
        ]);

        $user->assignRole('employee');

        return redirect()->route('admin.users.index')->with('success', 'Employee created successfully.');
    }

    public function createAdmin()
    {
        if (User::where('email', 'admin@gmail.com')->exists()) {
            return redirect()->route('admin.users.index')->with('error', 'Admin already exists.');
        }

        $user = User::create([
            'name' => 'Admin',
            'surname' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('Admin'), 
        ]);

        $user->assignRole('admin');


        return redirect()->route('admin.users.index')->with('success', 'Admin created successfully.');
    }
}
