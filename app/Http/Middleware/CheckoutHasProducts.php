<?php

namespace App\Http\Middleware;

use Closure;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;


class CheckoutHasProducts
{
    public function handle(Request $request, Closure $next)
    {
        if (Cart::count() > 0) {
            return $next($request);
        } else {
            return redirect("/cart");
        }
    }
}