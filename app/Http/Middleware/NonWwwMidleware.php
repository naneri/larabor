<?php

namespace App\Http\Middleware;

use Closure;
use Redirect;

class NonWwwMidleware
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
        // redirecting "www." domain to non-www
        if (substr($request->header('host'), 0, 4) === 'www.') {
            $request->headers->set('host', config('app.app_domain'));
            return Redirect::to($request->fullUrl());
        }

        return $next($request);
    }
}
