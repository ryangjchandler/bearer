<?php

namespace RyanChandler\Bearer\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class VerifyBearerToken
{
    protected $bearer;

    public function __construct(Bearer $bearer)
    {
        $this->bearer = $bearer;
    }

    public function handle(Request $request, Closure $next)
    {
        $token = $request->header('Authorization');

        abort_if(! $token, 403);

        $token = Str::after($token, 'Bearer ');

        abort_if(! $token, 403);

        $token = $this->bearer->find($token);

        abort_if(! $token || $token->expired, 403);

        if (! config('bearer.verify_domains') || ! $token->domains) {
            return $next($request);
        }

        abort_if(! in_array($request->getSchemeAndHttpHost(), $token->domains->toArray()), 403);

        return $next($request);
    }
}
