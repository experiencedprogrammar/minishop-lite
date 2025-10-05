<?php

namespace App\Http\Middleware;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        // If the user is not logged in or not an admin
        if (!Auth::check() || Auth::user()->role !== 'admin') {
            return redirect('/admin'); // redirect to admin login
        }

        return $next($request);
    }
}
