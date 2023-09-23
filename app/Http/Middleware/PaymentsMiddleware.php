<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PaymentsMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if(!empty(Auth::check())){
            if(Auth::user()->role_as == 1 || Auth::user()->role_as == 4 || Auth::user()->role_as == 5){
                return $next($request);
            }
            else{
                Auth::logout();
            return redirect(url("/"));
            }

        }else{
            Auth::logout();
            return redirect(url("/"));
        }
    }
}
