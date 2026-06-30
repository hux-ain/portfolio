<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Check if user is authenticated
        if (!auth()->check()) {
            return redirect()->route('login')->with('error', 'Please login to access admin panel.');
        }

        // Check if user has admin role
        // We'll use a simple is_admin column in users table
        if (!auth()->user()->is_admin) {
            return redirect()->route('home')->with('error', 'Access denied. Admin privileges required.');
        }

        return $next($request);
    }
}
