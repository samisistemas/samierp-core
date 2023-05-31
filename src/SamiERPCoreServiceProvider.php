<?php

namespace SamiSistemas\SamiERPCore;

use Illuminate\Support\ServiceProvider;

class SamiERPCoreServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
        $this->loadMigrationsFrom(__DIR__ . '/../database/migrations');

        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__ . '/../config/config.php' => config_path('samierp-core.php'),
            ], 'config');
        }

        $this->loadRoutesFrom(__DIR__ . '/../routes/web.php');
    }

    /**
     * Register the application services.
     */
    public function register()
    {
        // Automatically apply the package configuration
        $this->mergeConfigFrom(__DIR__ . '/../config/config.php', 'config');

        // Merge config database
        $this->mergeConfigFrom(__DIR__ . '/../config/database.php', 'database');

        // Register the main class to use with the facade
        $this->app->singleton('samierp-core', function () {
            return new SamiERPCore();
        });
    }
}
