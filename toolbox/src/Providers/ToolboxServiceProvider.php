<?php

namespace Carrollbradford\Toolbox\Providers;

// Framework
use Illuminate\Foundation\AliasLoader;
use Illuminate\Support\ServiceProvider;

// Package
use Carrollbradford\Toolbox\Helpers\DateHelper;
use Carrollbradford\Toolbox\Helpers\DBHelper;
use Carrollbradford\Toolbox\Facades\DollarAmount;
use Carrollbradford\Toolbox\Helpers\LogInfo;
use Carrollbradford\Toolbox\Facades\RequestHelper;
use Carrollbradford\Toolbox\Helpers\StringHelper;
use Carrollbradford\Toolbox\Helpers\UrlHelper;
use Carrollbradford\Toolbox\Facades\LocalApiPort;

class ToolboxServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->booting(function () {
            $loader = AliasLoader::getInstance();
            $loader->alias('DateHelper', DateHelper::class);
            $loader->alias('DBHelper', DBHelper::class);
            $loader->alias('DollarAmount', DollarAmount::class);
            $loader->alias('LogInfo', LogInfo::class);
            $loader->alias('RequestHelper', RequestHelper::class);
            $loader->alias('StringHelper', StringHelper::class);
            $loader->alias('UrlHelper', UrlHelper::class);
            $loader->alias('LocalApiPort', LocalApiPort::class);
        });
    }
}
