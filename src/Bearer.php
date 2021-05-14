<?php

namespace RyanChandler\Bearer;

use Illuminate\Support\Str;
use RyanChandler\Bearer\Models\Token;

class Bearer
{
    public function find(string $token): ?Token
    {
        if (Str::startsWith($token, 'Bearer ')) {
            $token = Str::after($token, 'Bearer ');
        }

        return Token::where('token', $token)->first();
    }
}
