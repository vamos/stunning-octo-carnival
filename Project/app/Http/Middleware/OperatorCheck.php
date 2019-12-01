<?php

namespace App\Http\Middleware;

use Closure;
use Auth;


class OperatorCheck
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
        $usersRole = NULL;
        // dd(Auth::user());
        if(Auth::user() != null){
            $usersRole = Auth::user()->role;
        } 
        
        if( (($usersRole != "admin") && ($usersRole != "operátor")) && (Auth::user() != NULL)){
            return redirect('/');
        }    

        return $next($request);
    }
}
