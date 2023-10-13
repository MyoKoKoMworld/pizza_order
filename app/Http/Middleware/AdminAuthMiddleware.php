<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AdminAuthMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // dd(url()->current());
        // dd(route('Auth#login'));
        if(!empty(Auth::user())){
            if(url()->current() == route('Auth#login') || url()->current() == route('Auth#register')){
                return back();
            }
            if(Auth::user()->role == "user"){
                abort('404');
            }
            else{
                return $next($request);


            }
            // dd('admin');

        }
        else{
            return $next($request);


        }


    }
}
