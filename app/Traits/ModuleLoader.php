<?php

namespace App\Traits;

use Illuminate\Support\Fluent;
use Illuminate\Support\ServiceProvider;

trait ModuleLoader
{
    public function loadModule(ServiceProvider $provider): void
    {
        $class = str_replace(chr(92), DIRECTORY_SEPARATOR, get_class($provider));

        $basePath = base_path(substr(lcfirst($class), 0, strrpos($class, DIRECTORY_SEPARATOR) + 1));
        $moduleName = lcfirst(explode(DIRECTORY_SEPARATOR, $class)[1]);

        // Default directory structure for each module

        $paths = config('modules.paths');

        $paths = new Fluent($paths);
        foreach ($paths as $key => $path) {
            $paths[$key] = $basePath . $path;
        }

        $provider->loadMigrationsFrom($paths->migrations);
        $provider->loadJsonTranslationsFrom($paths->json_translations);
        $provider->loadRoutesFrom($paths->routes);
        $provider->loadViewsFrom($paths->views, $moduleName);
        $provider->mergeConfigFrom($paths->config, $moduleName);

        if ($provider->app->runningInConsole()) {
            require_once $paths->console_tasks;
        }
    }
}
