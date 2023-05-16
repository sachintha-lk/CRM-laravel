<?php

namespace App\Http\Middleware;

use App\Models\Role;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ValidateRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
    
        $user_role = $request->user()->role()->first()->name;

        foreach ($roles as $role) {
            if ($user_role == $role) {
                return $next($request);
            }
        }
        
        return redirect('/dashboard')->with('errormsg', 'You do not have permission to access this page.');
    }
}
