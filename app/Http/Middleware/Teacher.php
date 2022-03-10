<?php

namespace App\Http\Middleware;
use Closure;
use Illuminate\Support\Facades\Auth;

class Teacher
{
    public function handle($request, Closure $next, $guard = null)
    {
        if (Auth::guard($guard)->check()) {
            
            if($guard == "admin"){
                //user was authenticated with admin guard.
                return redirect()->route('admin.home');
            } else if($guard == "teacher"){
                //user was authenticated with teacher guard.
                return redirect()->route('teacher.home');
            } else {
                //default guard.
                return redirect()->route('home');
            }

        }
        return $next($request);
    }
}
