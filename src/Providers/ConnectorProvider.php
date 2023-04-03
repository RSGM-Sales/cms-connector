<?php

namespace RSGMSales\Connector\Providers;

use Illuminate\Support\ServiceProvider;
use RSGMSales\Connector\Connector;

class ConnectorProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot(): void
    {
        $this->publishes([
            __DIR__.'/../config/connector.php' => config_path('connector.php'),
        ]);
    }

    public function register()
    {
        $this->app->bind('connector', function($app) {
            return new Connector();
        });

        $this->mergeConfigFrom(
            __DIR__.'/../config/cms.php','cms'
        );
    }
}
