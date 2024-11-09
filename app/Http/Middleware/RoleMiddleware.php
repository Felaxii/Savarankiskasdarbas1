<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, $role)
    {
        if (!Auth::check()) {
            return redirect()->route('welcome');
        }

        $user = Auth::user();
        if ($user->role === $role) {
            return $next($request);
        }

        // Redirect if the user role doesn't match
        return redirect()->route('access.denied');
    }
}
