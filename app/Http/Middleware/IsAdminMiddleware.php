<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class IsAdminMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (optional(auth()->user())->type != 'admin') {
            abort(404, 'not found');
        }
        return $next($request);
    }
}
