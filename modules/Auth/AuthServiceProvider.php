<?php

namespace Modules\Auth;

use App\Traits\ModuleLoader;
use Illuminate\Support\ServiceProvider;
use Modules\Auth\src\Interfaces\OperatorRepositoryInterface;
use Modules\Auth\src\Interfaces\PasswordResetTokenRepositoryInterface;
use Modules\Auth\src\Interfaces\PermissionRepositoryInterface;
use Modules\Auth\src\Repositories\OperatorRepository;
use Modules\Auth\src\Repositories\PasswordResetTokenRepository;
use Modules\Auth\src\Repositories\PermissionRepository;

class AuthServiceProvider extends ServiceProvider
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
        $this->app->bind(OperatorRepositoryInterface::class, OperatorRepository::class);
        $this->app->bind(PermissionRepositoryInterface::class, PermissionRepository::class);
        $this->app->bind(PasswordResetTokenRepositoryInterface::class, PasswordResetTokenRepository::class);
    }
}
