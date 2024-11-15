<?php

namespace App\Models;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Conference extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['title', 'description', 'speakers', 'date', 'time', 'address'];

    public function registrations()
    {
        return $this->belongsToMany(User::class, 'users_conferences')
        ->withTimestamps()
        ->whereNull('users_conferences.deleted_at');
    }

public function users()
{
    return $this->belongsToMany(User::class, 'users_conferences')
                ->withTimestamps()
                ->whereNull('users_conferences.deleted_at');
}

        
    
}