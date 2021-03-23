<?php

namespace App\Http\Middleware;
use Illuminate\Support\Facades\Auth;
use Closure;

class AdminRole
{

    public function handle($request, Closure $next)
    {
        if (Auth::check()) {
            if (auth()->user()->type == 'super_admin') {
                return $next($request);
            }elseif (auth()->user()->type == 'admin') {
                return $next($request);
            }else{
                return redirect()->route('home');
            }
        }else{
            return redirect()->route('home');
        }

    }
}
