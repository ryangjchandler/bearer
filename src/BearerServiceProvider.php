<?php

namespace RyanChandler\Bearer;

use Ryangjchandler\Bearer\Commands\BearerCommand;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class BearerServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        $package
            ->name('bearer')
            ->hasConfigFile()
            ->hasMigration('create_bearer_table')
            ->hasCommand(BearerCommand::class);
    }
}
