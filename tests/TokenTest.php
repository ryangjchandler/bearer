<?php

namespace RyanChandler\Bearer\Tests;

use RyanChandler\Bearer\Models\Token;
use Illuminate\Support\Carbon;

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

        $token->addDomain('https://laravel.com');

        $this->assertSame(['https://example.com', 'https://laravel.com'], $token->domains->toArray());
    }

    public function test_it_can_expire()
    {
        $token = Token::factory()
            ->expired()
            ->create();

        $this->assertTrue($token->expired);
    }

    public function test_it_can_interacts_with_expiration_time_in_minutes()
    {
        $token = Token::factory()->expired()->create();

        $token->addMinutes($minutes = rand(1, 7));
        $this->assertFalse($token->expired);
        $this->assertTrue($token->expires_at->isFuture());

        Carbon::withTestNow(
            now()->addMonths($minutes + 1),
            fn () => $this->assertTrue($token->expired)
        );
    }

    public function test_it_can_interacts_with_expiration_time_in_hours()
    {
        $token = Token::factory()->expired()->create();

        $token->addHours($hours = rand(1, 7));
        $this->assertFalse($token->expired);
        $this->assertTrue($token->expires_at->isFuture());

        Carbon::withTestNow(
            now()->addMonths($hours + 1),
            fn () => $this->assertTrue($token->expired)
        );
    }

    public function test_it_can_interacts_with_expiration_time_in_days()
    {
        $token = Token::factory()->expired()->create();

        $token->addDays($days = rand(1, 7));
        $this->assertFalse($token->expired);
        $this->assertTrue($token->expires_at->isFuture());

        Carbon::withTestNow(
            now()->addMonths($days + 1),
            fn () => $this->assertTrue($token->expired)
        );
    }

    public function test_it_can_interacts_with_expiration_time_in_weeks()
    {
        $token = Token::factory()->expired()->create();

        $token->addWeeks($weeks = rand(1, 7));
        $this->assertFalse($token->expired);
        $this->assertTrue($token->expires_at->isFuture());

        Carbon::withTestNow(
            now()->addMonths($weeks + 1),
            fn () => $this->assertTrue($token->expired)
        );
    }

    public function test_it_can_interacts_with_expiration_time_in_months()
    {
        $token = Token::factory()->expired()->create();

        $token->addMonths($months = rand(1, 7));
        $this->assertFalse($token->expired);
        $this->assertTrue($token->expires_at->isFuture());

        Carbon::withTestNow(
            now()->addMonths($months + 1),
            fn () => $this->assertTrue($token->expired)
        );
    }
}
