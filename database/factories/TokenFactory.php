<?php

namespace RyanChandler\Bearer\Database\Factories;

use Carbon\Carbon;
use DateTime;
use Illuminate\Support\Str;
use RyanChandler\Bearer\Models\Token;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Arr;

class TokenFactory extends Factory
{
    protected $model = Token::class;

    public function expired(Carbon $expiresAt = null)
    {
        return $this->state([
            'expires_at' => $expiresAt ?? now()
        ]);
    }

    public function domains($domains)
    {
        $domains = Arr::wrap($domains);

        return $this->state([
            'domains' => $domains,
        ]);
    }

    public function definition()
    {
        return [
            'token' => Str::random(32),
        ];
    }
}
