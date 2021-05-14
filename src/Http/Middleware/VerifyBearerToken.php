<?php

namespace RyanChandler\Bearer\Http\Middleware;

use Closure;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use RyanChandler\Bearer\Bearer;

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

        if (! $token) {
            return $this->abort('Please provide a valid token.');
        }

        $token = Str::after($token, 'Bearer ');

        if (! $token) {
            return $this->abort('Please provide a valid token.');
        }

        $token = $this->bearer->find($token);

        if (! $token) {
            return $this->abort('Please provide a valid token.');
        }

        if ($token->expired) {
            return $this->abort('This token has expired.');
        }

        if (! config('bearer.verify_domains') || ! $token->domains) {
            return $next($request);
        }

        if (! in_array($request->getSchemeAndHttpHost(), $token->domains->toArray())) {
            return $this->abort('This token cannot be used with your domain.');
        }

        return $next($request);
    }

    protected function abort(string $message)
    {
        return response()->json([
            'status' => 401,
            'message' => $message,
        ], 401);
    }
}
