<?php

namespace Modules\Common;

use App\Traits\ModuleLoader;
use Illuminate\Support\ServiceProvider;

class CommonServiceProvider extends ServiceProvider
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
