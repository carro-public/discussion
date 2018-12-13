<?php

namespace CarroPublic\Discussion\Facades;

use Illuminate\Support\Facades\Facade;

class Discussion extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'discussion';
    }
}
