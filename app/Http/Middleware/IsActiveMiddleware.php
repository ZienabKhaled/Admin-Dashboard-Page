<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class IsActiveMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
         // Check if the user is logged in
         if (Auth::check()) {
            // Check if the user is active
            if (Auth::user()->is_active) {
                return $next($request);
            } else {
                // Redirect or respond with an error message if the user is not active
                return 'inactive-account';
                // You can define the 'inactive-account' route in your routes file
            }
        }

        // If the user is not logged in, you can handle it as needed
        // For example, you can redirect to the login page
        return redirect()->route('login');
    }
}
