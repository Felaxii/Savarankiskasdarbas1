<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class RoleMiddleware
{
    public function handle($request, Closure $next, $role)
    {
        if (auth()->check() && auth()->user()->hasRole($role)) {
            return $next($request);
        }
    
        return redirect()->route('access.denied')->with('error', 'Access Denied: Insufficient permissions.');
    }
}
