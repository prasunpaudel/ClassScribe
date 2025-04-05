<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;


class Student
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if(!Auth::check()){
            Alert::error('Error', 'You must be logged in to access this page.');
            return redirect('/');
        }
        if(Auth::user()->role != 'student'){
            Alert::error('Error', 'You do not have permission to access this page.');
            return redirect('/');
        }
        return $next($request);
    }
}
