<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckLocalProduct
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
      $language_product = $request->product->language()->first();
      if ($language_product->slug !== App()->getLocale()){
        return redirect()->route('shop');
      }
        return $next($request);
    }
}
