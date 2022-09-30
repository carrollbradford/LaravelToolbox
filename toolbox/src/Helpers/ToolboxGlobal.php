<?php
use Carrollbradford\Toolbox\Helpers\DateHelper;
use Carrollbradford\Toolbox\Helpers\UrlHelper;

if (!function_exists('emptyOrValue')) {
    /**
    * Global function to handle if comparison of empty values
    * Pass this wrapped like: emptyOrValue(($value ?? null), $default),
    * so that it wont fail on unset props when working with objects or arrays
    * @param mixed $value
    * @param mixed $default Value that should be used in case of Empty
    * @return mixed Returns the Original value, default or just null.
    */
    function emptyOrValue($value, $default = null)
    {
        return !empty($value) ? $value : $default;
    }
}

if (!function_exists('dateHelper')) {
    /**
    * Global function to expose the dateHelper static class and its methods
    * @see \Carrollbradford\Toolbox\Helpers\DateHelper
    * @return mixed
    */
    function dateHelper()
    {
        return app(DateHelper::class);
    }
}

if (!function_exists('host')) {
    /**
    * Global function to get the current host url
    * @see \Carrollbradford\Toolbox\Helpers\UrlHelper
    * @return mixed
    */
    function host()
    {
        return UrlHelper::host();
    }
}

if (!function_exists('makeUrl')) {
    /**
    * Global function to get compose a fully qualified URL
    * @see \Carrollbradford\Toolbox\Helpers\UrlHelper
    * @param string $path
    * @return mixed
    */
    function makeUrl(string $path)
    {
        return UrlHelper::makeUrl($path);
    }
}
