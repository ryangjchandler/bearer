<?php

namespace RyanChandler\Bearer;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Ryangjchandler\Bearer\Bearer
 */
class BearerFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'bearer';
    }
}
