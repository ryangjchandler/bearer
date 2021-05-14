<?php

namespace RyanChandler\Bearer;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;
use RyanChandler\Bearer\Commands\BearerCommand;

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
