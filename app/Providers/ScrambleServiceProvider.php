<?php

namespace App\Providers;

use Dedoc\Scramble\Scramble;
use Dedoc\Scramble\SecurityDocumentation\MiddlewareAuthSecurityStrategy;
use Dedoc\Scramble\Support\Generator\Operation;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

class ScrambleServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        Scramble::configure()
            ->withOperationTransformers(function (Operation $operation) {});

        $routeName = 'scramble.docs.ui';

        // Any unmatched route falls back to the API docs

        Route::fallback(function () use ($routeName) {
            return Redirect::route($routeName);
        });
    }

    public function boot(): void
    {
        $config = config('scramble');

        // Scalar as a renderer

        $config = (object) $config;
        $config->renderer = array_key_last($config->renderers);
        $config->security_strategy = MiddlewareAuthSecurityStrategy::class;

        array_pop($config->middleware);

        // Runs after the package's own boot, so this config wins over its defaults
        Scramble::configure()
            ->config(get_object_vars($config));
    }
}
