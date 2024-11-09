<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class Authenticate
{
    public function handle($request, Closure $next)
    {
        // Check if the user is logged in
        if (Auth::check()) {
            return $next($request);
        }

        // Redirect to login if not authenticated
        return redirect()->route('login'); // Adjust to your login route
    }
}
