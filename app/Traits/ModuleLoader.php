<?php

namespace App\Traits;

use Illuminate\Support\Fluent;
use Illuminate\Support\Str;

trait ModuleLoader
{
    public function loadModule(): void
    {
        $class = Str::of(get_class($this))->replace(chr(92), DIRECTORY_SEPARATOR)->dirname()->lcfirst();
        $moduleName = Str::kebab(basename($class));

        // Default directory structure for each module

        $paths = config('modules.paths');

        $paths = new Fluent($paths);
        foreach ($paths as $key => $path) {
            $paths[$key] = base_path($class) . DIRECTORY_SEPARATOR . $path;
        }

        $this->loadMigrationsFrom($paths->migrations);
        $this->loadJsonTranslationsFrom($paths->json_translations);
        $this->loadRoutesFrom($paths->routes);
        $this->loadViewsFrom($paths->views, $moduleName);
        $this->mergeConfigFrom($paths->config, $moduleName);

        if ($this->app->runningInConsole()) {
            require_once $paths->console_tasks;
        }
    }
}
