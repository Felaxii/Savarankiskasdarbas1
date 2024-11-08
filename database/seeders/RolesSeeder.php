<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class RolesSeeder extends Seeder
{
    public function run()
    {
        // Create roles if they don't already exist
        Role::firstOrCreate(['name' => 'client']);
        Role::firstOrCreate(['name' => 'employee']);
        Role::firstOrCreate(['name' => 'admin']);
    }
}

