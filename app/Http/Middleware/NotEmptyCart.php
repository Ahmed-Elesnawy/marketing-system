<?php

namespace App\Http\Middleware;

use Closure;
use Cart;

class NotEmptyCart
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
        if ( Cart::session(user()->id)->isEmpty() )
        {
            return redirect(route('dashboard.products.index'));
        }
        return $next($request);
    }
}
