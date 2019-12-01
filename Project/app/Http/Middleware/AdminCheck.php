<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class AdminCheck
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {   
        // dd("Auth");
        $usersRole = "admin";
        if(Auth::user() != null){
            $usersRole = Auth::user()->role;
        } 
        
        if(($usersRole != "admin") && (Auth::user() != NULL)){
            // dd(Auth::user()->role);
            return redirect('/');
        }    
        return $next($request);

    }
}
