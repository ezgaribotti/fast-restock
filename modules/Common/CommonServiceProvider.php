<?php

namespace Modules\Common;

use App\Traits\ModuleLoader;
use Illuminate\Support\ServiceProvider;

class CommonServiceProvider extends ServiceProvider
{
    use ModuleLoader;

    public function boot(): void
    {
        $this->loadModule($this);

        if ($this->app->runningInConsole()) {
            $this->commands([]);
        }
    }

    public function register(): void
    {
    }
}
