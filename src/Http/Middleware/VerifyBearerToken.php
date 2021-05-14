<?php

namespace RyanChandler\Bearer\Http\Middleware;

use Closure;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class VerifyBearerToken
{
    public function handle(Request $request, Closure $next)
    {
        $token = $request->header('Authorization');

        if (! $token) {
            abort(403);
        }

        $token = Str::after($token, 'Bearer ');

        return $next($request);
    }
}
