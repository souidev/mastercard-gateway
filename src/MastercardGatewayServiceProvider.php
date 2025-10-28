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
        $this->app->singleton('mastercard-gateway', function ($app) {
            $config = $app['config']->get('mastercard-gateway');

            return new MastercardGateway(
                new Merchant($config),
                new Connection($config),
                new Parser
            );
        });
    }
}
