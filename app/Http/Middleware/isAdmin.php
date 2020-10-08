<?php

namespace App\Http\Middleware;
use Illuminate\Support\Facades\Auth; 

use Closure;

class isAdmin
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
        if(!Auth::check()){ # Bir giriş olup olmadığını kontrol ediyor.
            return redirect()->route('admin.login');
        }
        return $next($request);
    }
}
