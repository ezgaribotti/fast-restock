<?php

namespace Modules\Payments;

use App\Traits\ModuleLoader;
use Illuminate\Support\ServiceProvider;

class PaymentServiceProvider extends ServiceProvider
{
    use ModuleLoader;

    public function boot(): void
    {
        $this->loadModule();
    }

    public function register(): void
    {
    }
}
