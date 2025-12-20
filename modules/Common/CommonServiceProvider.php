<?php

namespace Modules\Common;

use App\Traits\ModuleLoader;
use Illuminate\Support\ServiceProvider;
use Modules\Common\src\Interfaces\StripeServiceInterface;
use Modules\Common\src\Providers\EventServiceProvider;
use Modules\Common\src\Services\StripeService;

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
        $this->app->register(EventServiceProvider::class);

        $this->app->bind(StripeServiceInterface::class, StripeService::class);
    }
}
