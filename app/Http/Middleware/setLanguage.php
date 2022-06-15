<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class setLanguage
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
  if ($request->session()->has('language')) {
   \App::setLocale($request->session()->get('language'));
  }
  return $next($request);
 }
}