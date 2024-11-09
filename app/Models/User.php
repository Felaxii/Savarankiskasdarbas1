<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Role;

class User extends Authenticatable
{
    use Notifiable, SoftDeletes;

    protected $fillable = [
        'name', 'surname', 'email', 'password', 
    ];

    // Define the relationship to conferences through a pivot table (users_conferences)
    public function conferences()
    {
        return $this->belongsToMany(Conference::class, 'users_conferences')
                    ->withTimestamps();
    }

    // Define the relationship to roles through the 'users' table (assumes a column like 'role' exists in users)
    public function roles()
    {
        return $this->belongsToMany(Role::class, 'users_roles', 'user_id', 'role_id');
    }

    // Optional: A helper function to check if the user has a certain role
    public function hasRole($roleName)
    {
        // Check if the user has a role, assuming 'roles' table is used
        return $this->role === $roleName;
    }
}
