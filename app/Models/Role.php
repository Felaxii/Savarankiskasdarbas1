<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    // Specify the table name (optional if table name follows Laravel's naming conventions)
    protected $table = 'roles';

    // Specify the fillable attributes for mass assignment
    protected $fillable = [
        'name',
    ];

    // Define the many-to-many relationship with User
    public function users()
    {
        return $this->belongsToMany(User::class, 'users_roles');
    }
}
