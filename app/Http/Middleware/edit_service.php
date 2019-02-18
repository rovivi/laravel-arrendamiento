<?php

namespace App\Http\Middleware;

use Closure;

class edit_service
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

        
        //return view('welcome');

        return $next($request);
    }
}
