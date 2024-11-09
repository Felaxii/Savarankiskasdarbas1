<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleAndPermissionSeeder extends Seeder
{
    public function run()
    {
        // Create permissions
        $viewConferences = Permission::create(['name' => 'view conferences']);
        $registerForConferences = Permission::create(['name' => 'register for conferences']);
        $viewEmployeeConferences = Permission::create(['name' => 'view employee conferences']);
        $viewRegisteredPeople = Permission::create(['name' => 'view registered people']);
        
        // Create roles
        $client = Role::create(['name' => 'client']);
        $employee = Role::create(['name' => 'employee']);
        $admin = Role::create(['name' => 'admin']);
        
        // Assign permissions to roles
        // Client can view and register for conferences
        $client->givePermissionTo($viewConferences, $registerForConferences);

        // Employee can view employee conferences and registered users
        $employee->givePermissionTo($viewEmployeeConferences, $viewConferences, $viewRegisteredPeople);

        // Admin can do everything
        $admin->givePermissionTo($viewConferences, $registerForConferences, $viewEmployeeConferences, $viewRegisteredPeople);
    }
}
