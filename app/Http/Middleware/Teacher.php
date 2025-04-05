<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class Teacher
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Check if the user is authenticated
        if (!Auth::check()) {
            Alert::error('Error', 'You must be logged in to access this page.');
            // Redirect to the login page or any other page
            return redirect('/');
        }
        // Check if the user has the 'teacher' role
        if (Auth::user()->role != 'teacher') {
            Alert::error('Error', 'You do not have permission to access this page.');
            return redirect('/');
        }
        return $next($request);
    }
}
