<?php

namespace RSGMSales\Connector\Providers;

use Illuminate\Support\ServiceProvider;
use RSGMSales\Connector\Connector;
use RSGMSales\Connector\SiteApi;
use RSGMSales\Connector\UserApi;

class ConnectorProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->publishes([
            __DIR__ . '/../config/connector.php' => config_path('connector.php'),
        ]);
    }

    public function register(): void
    {
        $this->app->singleton(
            abstract: Connector::class,
            concrete: fn() => new Connector(
                siteApi: new SiteApi(),
                userApi: new UserApi()
            )
        );
    }
}
