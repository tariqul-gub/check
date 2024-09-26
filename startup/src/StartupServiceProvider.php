<?php

namespace Brl\Startup;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\ServiceProvider;

class StartupServiceProvider extends ServiceProvider
{

    public function register()
    {
        // Merge the config from the package
        $this->mergeConfigFrom(
            __DIR__ . '/config/startup.php',
            'startup'
        );
    }
    public function boot()
    {
        $this->loadViewsFrom(__DIR__ . '/views', 'startup');
        $this->publishes([
            __DIR__ . '/config/startup.php' => config_path('startup.php'),
        ], 'config');

        if (config('startup.route_enabled')) {
            $this->loadRoutesFrom(__DIR__ . '/routes/web.php');
        }
    }
}
