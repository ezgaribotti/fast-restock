<?php

namespace App\Providers;

use Dedoc\Scramble\Scramble;
use Dedoc\Scramble\Support\Generator\Operation;
use Illuminate\Support\ServiceProvider;

class ScrambleServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        Scramble::configure()
            ->withOperationTransformers(function (Operation $operation) {});
    }

    public function boot(): void
    {
    }
}
