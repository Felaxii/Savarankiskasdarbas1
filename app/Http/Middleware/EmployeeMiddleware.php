<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class EmployeeMiddleware
{
    public function handle($request, Closure $next)
    {
        if (session('role') !== 'employee') {
            return redirect()->route('welcome'); // Redirect to welcome if not an employee
        }
    
        return $next($request);
    }
}
