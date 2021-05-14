<?php

namespace RyanChandler\Bearer\Tests;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use RyanChandler\Bearer\Http\Middleware\VerifyBearerToken;
use RyanChandler\Bearer\Models\Token;

class MiddlewareTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();

        $this->app['router']->get('/bearer', function (Request $request) {
            return 'Bearer...';
        })->middleware(VerifyBearerToken::class);
    }

    public function test_it_aborts_with_no_token()
    {
        $this->get('/bearer')->assertStatus(401);
    }

    public function test_it_aborts_with_invalid_token()
    {
        $this->get('/bearer', [
            'Authorization' => 'Bearer '.Str::random(32),
        ])->assertStatus(401);
    }

    public function test_it_aborts_with_expired_token()
    {
        $token = Token::factory()->expired()->create();

        $this->get('/bearer', [
            'Authorization' => 'Bearer ' . $token->token,
        ])->assertStatus(401);
    }

    public function test_it_does_not_abort_with_valid_token()
    {
        $token = Token::factory()->create();

        $this->get('/bearer', [
            'Authorization' => 'Bearer ' . $token->token,
        ])->assertStatus(200);
    }

    public function test_it_aborts_for_invalid_domain()
    {
        $token = Token::factory()->domains([
            'http://example.com',
        ])->create();

        $this->get('/bearer', [
            'Authorization' => 'Bearer ' . $token->token,
        ])->assertStatus(401);
    }

    public function test_it_does_not_abort_for_valid_domain()
    {
        $token = Token::factory()->domains([
            'http://localhost',
        ])->create();

        $this->get('/bearer', [
            'Authorization' => 'Bearer ' . $token->token,
        ])->assertStatus(200);
    }
}
