<?php

namespace RyanChandler\Bearer;

use Closure;
use DateTimeInterface;
use Illuminate\Support\Str;
use RyanChandler\Bearer\Models\Token;

class Bearer
{
    protected Closure $generateTokenCallback;

    public function __construct()
    {
        $this->generateTokenCallback = function () {
            return (string) Str::orderedUuid();
        };
    }

    public function find(string $token): ?Token
    {
        if (Str::startsWith($token, 'Bearer ')) {
            $token = Str::after($token, 'Bearer ');
        }

        return Token::where('token', $token)->first();
    }

    public function generateTokenUsing(Closure $callback)
    {
        $this->generateTokenCallback = $callback;

        return $this;
    }

    public function generate(array $domains = [], ?DateTimeInterface $expiresAt = null, ?string $description = null): Token
    {
        if ($description !== null && strlen($description) > 255) {
            throw new \InvalidArgumentException('Token descriptions must be <= 255 characters.');
        }

        $callback = $this->generateTokenCallback;

        return Token::create([
            'token' => $callback(),
            'domains' => $domains,
            'description' => $description,
            'expires_at' => $expiresAt,
        ]);
    }
}
