<?php

namespace Carrollbradford\Toolbox\Facades;

use Illuminate\Support\Facades\Facade;
use Carrollbradford\Toolbox\Helpers\RequestHelper as Helper;

/**
* @see \Carrollbradford\Toolbox\Helpers\RequestHelper
*/
class RequestHelper extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return new Helper();
    }
}
