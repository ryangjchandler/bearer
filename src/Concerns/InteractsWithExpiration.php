<?php

namespace RyanChandler\Bearer\Concerns;

trait InteractsWithExpiration
{
    public function addMonths(int $months)
    {
        $expires = $this->expires_at ?: now();

        return $this->expires($expires->addMonths($months));
    }

    public function addWeeks(int $weeks)
    {
        $expires = $this->expires_at ?: now();

        return $this->expires($expires->addWeeks($weeks));
    }

    public function addDays(int $days)
    {
        $expires = $this->expires_at ?: now();

        return $this->expires($expires->addDays($days));
    }

    public function addHours(int $hours)
    {
        $expires = $this->expires_at ?: now();

        return $this->expires($expires->addHours($hours));
    }

    public function addMinutes(int $minutes)
    {
        $expires = $this->expires_at ?: now();

        return $this->expires($expires->addMinutes($minutes));
    }
}
