<?php

namespace App\Http\Middleware;

use Closure;

class CheckBanned
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
        if(auth()-check() && auth()->user()->isBan){
			auth()->logout();
			$message = "Your account is banned. Please contact Administrator.";
			return redirect()->route('login')->withMessage($message);
		}
		
		return $next($request);
    }
}
