<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfAdminAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = 'admin')
    {   
        if (Auth::guard($guard)->check() && Auth::guard($guard)->User() &&  Auth::guard($guard)->user()->isAdmin() ) {
            return redirect('/admin/dashboard');
        }

        return $next($request);
    }
}
