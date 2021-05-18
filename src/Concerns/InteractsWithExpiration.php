<?php

namespace RyanChandler\Bearer\Concerns;

use RyanChandler\Bearer\Models\Token;

trait InteractsWithExpiration
{
    public function addMonths(int $months): Token
    {
        $expires = $this->expires_at ?: now();

        return $this->expires($expires->addMonths($months));
    }

    public function addWeeks(int $weeks): Token
    {
        $expires = $this->expires_at ?: now();

        return $this->expires($expires->addWeeks($weeks));
    }

    public function addDays(int $days): Token
    {
        $expires = $this->expires_at ?: now();

        return $this->expires($expires->addDays($days));
    }

    public function addHours(int $hours): Token
    {
        $expires = $this->expires_at ?: now();

        return $this->expires($expires->addHours($hours));
    }

    public function addMinutes(int $minutes): Token
    {
        $expires = $this->expires_at ?: now();

        return $this->expires($expires->addMinutes($minutes));
    }
}
