<?php

namespace App\Http\Middleware;

use Closure;

class Pustu
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
        if (session('employee')['privilege'] !== 'Pustu' && session('employee')['privilege'] !== 'Administrator') {
            return back()->withErrors(['Method not allowed!']);
        }

        return $next($request);
    }
}
