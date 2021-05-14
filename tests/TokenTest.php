<?php

namespace RyanChandler\Bearer\Tests;

use RyanChandler\Bearer\Models\Token;

class TokenTest extends TestCase
{
    public function test_it_can_be_created()
    {
        $token = Token::factory()->create();

        $this->assertDatabaseHas('bearer_tokens', [
            'token' => $token->token,
        ]);
    }

    public function test_it_can_have_domains()
    {
        $token = Token::factory()->create();

        $token->addDomain('https://example.com');

        $this->assertSame(['https://example.com'], $token->domains->toArray());

        $token->addDomain('https://laravel.com');

        $this->assertSame(['https://example.com', 'https://laravel.com'], $token->domains->toArray());
    }

    public function test_it_can_cast_domains_to_array()
    {
        $token = Token::factory()
            ->domains([
                'https://example.com',
            ])
            ->create();

        $this->assertSame(['https://example.com'], $token->domains->toArray());

        $token->domains[] = 'https://laravel.com';

        $this->assertSame(['https://example.com', 'https://laravel.com'], $token->domains->toArray());
    }

    public function test_it_can_expire()
    {
        $token = Token::factory()
            ->expired()
            ->create();

        $this->assertTrue($token->expired);
    }
}
