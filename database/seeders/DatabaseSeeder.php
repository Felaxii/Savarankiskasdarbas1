<?php

// database/seeders/DatabaseSeeder.php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Seed a Test User directly
        User::create([
            'name' => 'Test User',
            'surname' => 'User',  // Add surname field
            'email' => 'test@example.com',
            'password' => Hash::make('testpassword'),  // Hashing password
        ]);

        // Seed Employee User directly
        User::create([
            'name' => 'Employee Name',
            'surname' => 'Surname',  // Add surname field
            'email' => env('EMPLOYEE_LOGIN'),
            'password' => Hash::make(env('EMPLOYEE_PASSWORD')),
            'role' => 'employee', // Assuming role field exists
        ]);

        // Seed Admin User directly
        User::create([
            'name' => 'Admin Name',
            'surname' => 'Surname',  // Add surname field
            'email' => env('ADMIN_LOGIN'),
            'password' => Hash::make(env('ADMIN_PASSWORD')),
            'role' => 'admin', // Assuming role field exists
        ]);
    }
}
