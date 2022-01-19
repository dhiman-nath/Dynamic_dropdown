<?php

namespace App\Http\Middleware;
// namespace  App\Http\Middleware\Auth;
use Auth;
// use Illuminate\Auth\Middleware\Authenticate as Middleware;

use Closure;

class PhoneVerification
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
       
        $user=Auth::user();

       if (($user!=null) && ($user->isverified == 0)){
            return redirect()->route('auth.verify');
        }

        return $next($request);
    }
    
    
}
