<?php

namespace App\Concerns;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;

trait BootsAsModule
{
    public function bootThisAsModule(): void
    {
        $this->bootAsModuleFor($this);
    }

    public function bootAsModuleFor(ServiceProvider $provider): void
    {
        $class = Str::of(get_class($provider))->replace(chr(92), DIRECTORY_SEPARATOR)->dirname()->lcfirst();
        $moduleName = Str::kebab(basename($class));

        // Default structure for each module

        $paths = ['config'. DIRECTORY_SEPARATOR .'config.php', 'database'. DIRECTORY_SEPARATOR .'migrations',
            'lang', 'resources'. DIRECTORY_SEPARATOR .'views', 'routes'. DIRECTORY_SEPARATOR .'api.php',
            'routes'. DIRECTORY_SEPARATOR .'console.php'];

        // Full paths are used
        $paths = array_map(
            fn ($path) => base_path($class) . DIRECTORY_SEPARATOR . $path, $paths);

        $provider->mergeConfigFrom($paths[0], $moduleName);
        $provider->loadMigrationsFrom($paths[1]);
        $provider->loadJsonTranslationsFrom($paths[2]);
        $provider->loadViewsFrom($paths[3], $moduleName);

        [$prefix, $middleware] = array_fill(0, 2, pathinfo($paths[4], PATHINFO_FILENAME));

        Route::prefix($prefix)
            ->middleware($middleware)->group($paths[4]);

        if ($provider->app->runningInConsole()) {
            require_once $paths[5];
        }
    }
}
