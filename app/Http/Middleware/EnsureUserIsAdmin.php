<?php
// app/Http/Middleware/EnsureUserIsAdmin.php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class EnsureUserIsAdmin
{
    public function handle(Request $request, Closure $next)
    {
        // Check if the logged-in user is an admin
        if (auth()->check() && auth()->user()->role !== 'admin') {
            return redirect('/');  // Redirect to home if not admin
        }

        return $next($request);
    }
}
