<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use Notifiable, SoftDeletes, HasRoles;

    protected $fillable = [
        'name', 'surname', 'email', 'password',
    ];

    public function conferences()
    {
        return $this->belongsToMany(Conference::class, 'users_conferences', 'user_id', 'conference_id')
                    ->whereNull('users_conferences.deleted_at') 
                    ->withTimestamps()
                    ->withTrashed(); 
    }

public function roles()
{
    return $this->morphToMany('Spatie\Permission\Models\Role', 'model', 'model_has_roles', 'model_id', 'role_id');
}
public function scopeWithActiveConferences($query)
{
    return $query->with(['conferences' => function ($query) {
        $query->whereNull('users_conferences.deleted_at');
    }])
    ->whereNull('users.deleted_at');
}
}

