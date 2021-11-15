<?php

namespace App\Http\Middleware;

use Closure;

class IsPatientMiddleware
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
        if (optional(auth()->user())->type != 'patient')
        {
            abort(404, 'not found, only patients');
        }
		return $next($request);
	}
}
