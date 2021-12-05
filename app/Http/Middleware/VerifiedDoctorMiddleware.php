<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class VerifiedDoctorMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        abort_if(!auth()->user()->is_verified, 401, 'account not verified');
        return $next($request);
    }
}
