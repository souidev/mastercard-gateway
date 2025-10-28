<?php

namespace Souidev\MastercardGateway;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class MastercardGatewayServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        $package
            ->name('mastercard-gateway')
            ->hasConfigFile();
    }

    public function packageRegistered()
    {
        $this->app->singleton(Merchant::class, function ($app) {
            return new Merchant($app['config']->get('mastercard-gateway'));
        });

        $this->app->singleton(Connection::class, function ($app) {
            return new Connection($app['config']->get('mastercard-gateway'));
        });

        $this->app->singleton('mastercard-gateway', function ($app) {
            return new MastercardGateway(
                $app->make(Merchant::class),
                $app->make(Connection::class),
                new Parser
            );
        });
    }
}
