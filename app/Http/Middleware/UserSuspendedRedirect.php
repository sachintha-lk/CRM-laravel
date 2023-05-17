<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class UserSuspendedRedirect
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::user()) {
            if (Auth::user()->status == false) {
                // dd('User is suspended');
               Auth::guard('web')->logout();
            
        
               return redirect('/login')->with('errormsg', 'Your account has been suspended. Please contact the administrator.');

            }
        }
        return $next($request);
    }
}
