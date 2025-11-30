<?php
// app/Http/Middleware/StudentMiddleware.php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class StudentMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Check if user is authenticated and has student role
        if (!Auth::check() || Auth::user()->role !== 'student') {
            // Redirect to login or show unauthorized error
            return redirect()->route('login')->with('error', 'You do not have student access.');
        }

        return $next($request);
    }
}