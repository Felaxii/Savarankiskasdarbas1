<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class EmployeeMiddleware
{
    public function handle($request, Closure $next)
    {
        // Check if the user has the 'employee' role OR the 'admin' role
        if (Auth::check() && (Auth::user()->hasRole('employee') || Auth::user()->hasRole('admin'))) {
            return $next($request);
        }

        // Redirect or deny access if neither role matches
        return redirect()->route('welcome')->withErrors('Access Denied');
    }
}