<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable
{
    use Notifiable, SoftDeletes;

    protected $fillable = [
        'name', 'surname', 'email', 'password', // Ensure 'role' is not in the fillable array unless it's a direct field
    ];

    // Define the relationship to conferences through a pivot table (users_conferences)
    public function conferences()
    {
        return $this->belongsToMany(Conference::class, 'users_conferences')
                    ->withTimestamps();
    }

    // Define the relationship to roles through a pivot table (users_roles)
    public function roles()
    {
        return $this->belongsToMany(Role::class, 'users_roles');
    }

    // Optional: A helper function to check if the user has a certain role
    public function hasRole($role)
    {
        return $this->roles()->where('name', $role)->exists();
    }
}
