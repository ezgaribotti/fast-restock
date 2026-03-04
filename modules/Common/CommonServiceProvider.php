<?php

namespace Modules\Common;

use App\Traits\ModuleLoader;
use Illuminate\Support\ServiceProvider;
use Modules\Common\src\Interfaces\StripeServiceInterface;
use Modules\Common\src\Services\StripeService;

class CommonServiceProvider extends ServiceProvider
{
    use ModuleLoader;

    public function boot(): void
    {
        $this->loadModule();
    }

    public function register(): void
    {
        $this->app->bind(StripeServiceInterface::class, StripeService::class);
    }
}
