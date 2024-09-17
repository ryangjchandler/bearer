<?php

namespace RyanChandler\Bearer\Tests;

use RyanChandler\Bearer\Facades\Bearer;

class BearerTest extends TestCase
{
    public function test_it_can_create_token()
    {
        $token = Bearer::generate();

        $this->assertDatabaseHas('bearer_tokens', [
            'token' => $token->token,
        ]);
    }

    public function test_it_can_create_token_with_domains()
    {
        $token = Bearer::generate([
            'https://example.com',
        ]);

        $this->assertDatabaseHas('bearer_tokens', [
            'token' => $token->token,
        ]);

        $this->assertSame([
            'https://example.com',
        ], $token->domains->toArray());
    }

    public function test_it_can_create_token_with_expires_at()
    {
        $time = now()->addDays()->startOfDay();

        $token = Bearer::generate([], $time);

        $this->assertTrue($time->equalTo($token->expires_at));
    }

    public function test_it_can_create_token_with_description()
    {
        $description = "Example description for the token.";

        $token = Bearer::generate([], null, $description);

        $this->assertDatabaseHas('bearer_tokens', [
            'token' => $token->token,
            'description' => $description,
        ]);
    }
}
