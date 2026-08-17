<?php

namespace Modules\Common;

use App\Concerns\BootsAsModule;
use Illuminate\Support\ServiceProvider;

class CommonServiceProvider extends ServiceProvider
{
    use BootsAsModule;

    public function register(): void
    {
    }

    public function boot(): void
    {
        $this->bootThisAsModule();
    }
}
