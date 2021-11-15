<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class WithVerifiedEmailMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        abort_if($request->user()->email_verified_at == null, 302, 'email not verified, please verify');
        return $next($request);
    }
}
