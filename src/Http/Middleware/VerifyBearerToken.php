<?php

namespace RyanChandler\Bearer\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
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
        $token = $this->findTokenStringFromRequest($request);

        if (! is_string($token)) {
            return $token;
        }

        $token = $this->bearer->find($token);

        if (! $token) {
            return $this->abort('Please provide a valid token.');
        }

        if ($token->expired) {
            return $this->abort('This token has expired.');
        }

        if (! config('bearer.verify_domains') || ! $token->domains || $token->domains->collect()->isEmpty()) {
            return $next($request);
        }

        if (! in_array($request->getSchemeAndHttpHost(), $token->domains->toArray())) {
            return $this->abort('This token cannot be used with your domain.');
        }

        return $next($request);
    }

    protected function findTokenStringFromRequest(Request $request)
    {
        if ($request->has('token')) {
            return $request->input('token');
        }

        $token = $request->header('Authorization');

        if (! $token) {
            return $this->abort('Please provide a valid token.');
        }

        $token = Str::after($token, 'Bearer ');

        if (! $token) {
            return $this->abort('Please provide a valid token.');
        }

        return $token;
    }

    protected function abort(string $message)
    {
        return response()->json([
            'status' => 401,
            'message' => $message,
        ], 401);
    }
}
