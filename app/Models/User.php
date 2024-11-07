<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'name', 'surname', 'email', 
    ];
  
    public function conferences()
    {
        return $this->belongsToMany(Conference::class, 'users_conferences');
    }

    public function roles()
    {
        return $this->belongsToMany(Role::class, 'users_roles');
    }
}
