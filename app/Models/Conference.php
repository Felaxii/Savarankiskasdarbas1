<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Conference extends Model
{
    protected $fillable = ['title', 'description', 'speakers', 'date', 'time', 'address'];

    // Scope to get only current/future conferences
    public function scopeCurrent($query)
    {
        return $query->where('date', '>=', now());
    }

    // Scope to get past conferences
    public function scopePast($query)
    {
        return $query->where('date', '<', now());
    }
}
