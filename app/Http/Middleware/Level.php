<?php

namespace App\Http\Middleware;

use Closure;

class level
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next,...$levels)
    {
        if (in_array($request->user()->level,$levels)) {
            return redirect('/home');
        }
        return $next($request);
    }
}