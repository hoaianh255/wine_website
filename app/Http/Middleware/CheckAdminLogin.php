<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckAdminLogin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check()) {
            $roles = Auth::user()->roles()->get();
            if (count($roles) >= 1) {
                return $next($request);
            } else {
                Auth::logout();
                return redirect("/");
            }
        } else {
            Auth::logout();
            return redirect("/");
        }
    }

}