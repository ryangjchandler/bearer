<?php

namespace RyanChandler\Bearer\Facades;

use Illuminate\Support\Facades\Facade;
use RyanChandler\Bearer\Bearer as BearerManager;

/**
 * @method static \RyanChandler\Bearer\Models\Token|null find(string $token)
 * @method static \RyanChandler\Bearer\Bearer generateTokenUsing(\Closure $callback)
 * @method static \RyanChandler\Bearer\Models\Token generate(array $domains = [], \DateTimeInterface $expiresAt = null)
 */
class Bearer extends Facade
{
    protected static function getFacadeAccessor()
    {
        return BearerManager::class;
    }
}
