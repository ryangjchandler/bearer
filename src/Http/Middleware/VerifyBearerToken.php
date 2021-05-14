<?php

namespace RyanChandler\Bearer\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class VerifyBearerToken
{
    public function handle(Request $request, Closure $next)
    {
        return $next($request);
    }
}
