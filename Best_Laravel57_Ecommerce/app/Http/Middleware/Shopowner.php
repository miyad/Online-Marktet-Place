<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Shopowner_model;

class Shopowner 
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    // public function handle($request, Closure $next)
    // {
    //     if(Auth::check() && Auth::user()->isShopowner()){
    //         return $next($request);
    //     }
    //     return redirect('Shopowner_home');
    // }
    public function handle($request, Closure $next)
    {
        if(Auth::check() && Auth::user()->isShopowner()){
            return $next($request);
        }
        return redirect('Shopowner_home');
        
    }
}
