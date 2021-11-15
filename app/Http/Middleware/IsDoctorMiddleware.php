<?php

namespace App\Http\Middleware;

use Closure;

class IsDoctorMiddleware
{
	/**
	 * Handle an incoming request.
	 *
	 * @param \Illuminate\Http\Request $request
	 * @param \Closure $next
	 * @return mixed
	 */
	public function handle($request, Closure $next)
	{
	    if (optional(auth()->user())->type != 'doctor')
        {
            abort(404, 'not found, only doctors');
        }
		return $next($request);
	}
}
