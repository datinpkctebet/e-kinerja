<?php

namespace App\Http\Middleware;

use Closure;

class Member
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
        if (empty(session('employee'))) {
            return redirect('login');
        }

        return $next($request);
    }
}
