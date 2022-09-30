<?php

namespace Carrollbradford\Toolbox\Facades;

use Illuminate\Support\Facades\Facade;
use Carrollbradford\Toolbox\Helpers\LocalApiPort as LocalApi;

/**
* @see \Carrollbradford\Toolbox\Helpers\RequestHelper
*/
class LocalApiPort extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return new LocalApi();
    }
}
