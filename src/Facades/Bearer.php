<?php

namespace RyanChandler\Bearer\Facades;

use Illuminate\Support\Facades\Facade;
use RyanChandler\Bearer\Bearer as BearerManager;

class Bearer extends Facade
{
    protected static function getFacadeAccessor()
    {
        return BearerManager::class;
    }
}
