<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Conference extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'description', 'speakers', 'date', 'time', 'address'];

    public function registrations()
    {
        return $this->belongsToMany(User::class, 'conference_user');
    }
}
