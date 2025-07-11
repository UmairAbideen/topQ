<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedirectAuthenticated
{
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check()) {
            return back(); // Redirect authenticated users away from registration form
        }

        return $next($request);
    }
}
