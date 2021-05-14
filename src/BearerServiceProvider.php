<?php

namespace RyanChandler\Bearer;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;
use RyanChandler\Bearer\Commands\BearerCommand;

class BearerServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package
            ->name('bearer')
            ->hasConfigFile()
            ->hasViews()
            ->hasMigration('create_bearer_table')
            ->hasCommand(BearerCommand::class);
    }
}
