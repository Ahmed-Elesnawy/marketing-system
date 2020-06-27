<?php

namespace App\Http\Middleware;

use Closure;

class PendingOrActive
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
        if ( auth()->check() and auth()->user()->status == 'pending' )
        {
            return redirect(route('auth.pending'));
        }
        return $next($request);
    }
}
