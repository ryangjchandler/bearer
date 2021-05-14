<?php

namespace RyanChandler\Bearer\Facades;

use Illuminate\Support\Facades\Facade;
use RyanChandler\Bearer\Bearer as BearerManager;

/**
 * @method static \RyanChandler\Bearer\Models\Token|null find(string $token)
 */
class Bearer extends Facade
{
    protected static function getFacadeAccessor()
    {
        return BearerManager::class;
    }
}
