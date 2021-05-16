<?php

namespace RyanChandler\Bearer\Concerns;

use RyanChandler\Bearer\Models\Token;

trait InteractsWithExpiration
{
    /**
     * Add months to the expiration date.
     */
    public function addMonths(int $months): Token
    {
        $expires = $this->expires_at ?: now();

        return $this->expires($expires->addMonths($months));
    }

    /**
     * Add weeks to the expiration date.
     */
    public function addWeeks(int $weeks): Token
    {
        $expires = $this->expires_at ?: now();

        return $this->expires($expires->addWeeks($weeks));
    }

    /**
     * Add days to the expiration date.
     */
    public function addDays(int $days): Token
    {
        $expires = $this->expires_at ?: now();

        return $this->expires($expires->addDays($days));
    }

    /**
     * Add hours to the expiration date.
     */
    public function addHours(int $hours): Token
    {
        $expires = $this->expires_at ?: now();

        return $this->expires($expires->addHours($hours));
    }

    /**
     * Add minutes to the expiration date.
     */
    public function addMinutes(int $minutes): Token
    {
        $expires = $this->expires_at ?: now();

        return $this->expires($expires->addMinutes($minutes));
    }
}
