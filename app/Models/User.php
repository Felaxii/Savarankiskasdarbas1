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

    // Define the relationship to conferences through a pivot table (users_conferences)
    public function conferences()
    {
        return $this->belongsToMany(Conference::class, 'users_conferences', 'user_id', 'conference_id')
                    ->whereNull('users_conferences.deleted_at') // Ensure proper null checks
                    ->withTimestamps()
                    ->withTrashed(); // This ensures it handles soft deletes correctly
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

