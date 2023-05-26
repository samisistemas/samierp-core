<?php

namespace SamiSistemas\SamiERPLib;

use Illuminate\Support\ServiceProvider;

class SamiERPLibServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
        $this->loadMigrationsFrom(__DIR__.'/../database/migrations');

        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__.'/../config/config.php' => config_path('samierp-lib.php'),
            ], 'config');
        }
    }

    /**
     * Register the application services.
     */
    public function register()
    {
        // Automatically apply the package configuration
        $this->mergeConfigFrom(__DIR__.'/../config/config.php', 'samierp-lib');

        // Register the main class to use with the facade
        $this->app->singleton('samierp-lib', function () {
            return new SamiERPLib;
        });
    }
}
