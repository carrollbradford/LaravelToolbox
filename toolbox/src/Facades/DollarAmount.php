<?php

namespace Carrollbradford\Toolbox\Facades;

use Illuminate\Support\Facades\Facade;
use Carrollbradford\Toolbox\Helpers\DollarAmountHelper;

/**
* @see \Carrollbradford\Toolbox\Helpers\DollarAmountHelper
*/
class DollarAmount extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return new DollarAmountHelper();
    }
}
