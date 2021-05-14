<?php

namespace RyanChandler\Bearer\Database\Factories;

use Carbon\Carbon;
use DateTime;
use Illuminate\Support\Str;
use RyanChandler\Bearer\Models\Token;
use Illuminate\Database\Eloquent\Factories\Factory;

class TokenFactory extends Factory
{
    protected $model = Token::class;

    public function expired(Carbon $expiresAt = null)
    {
        return $this->state([
            'expires_at' => $expiresAt ?? now()
        ]);
    }

    public function definition()
    {
        return [
            'token' => Str::random(32),
        ];
    }
}
