<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class ModuleManagerServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $path = base_path('module_providers.json');

        $providers = json_decode(file_get_contents($path), true);
        foreach ($providers as $provider) {
            $this->app->register($provider);
        }
    }

    public function boot(): void
    {
    }
}
