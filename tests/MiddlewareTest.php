<?php

namespace RyanChandler\Bearer\Tests;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use RyanChandler\Bearer\Http\Middleware\VerifyBearerToken;

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
        $this->get('/bearer')->assertStatus(403);
    }

    public function test_it_aborts_with_invalid_token()
    {
        $this->get('/bearer', [
            'Authorization' => 'Bearer '.Str::random(32),
        ])->assertStatus(403);
    }
}
