<?php

namespace Modules\Auth;

use App\Concerns\BootsAsModule;
use Illuminate\Support\ServiceProvider;
use Modules\Auth\src\Interfaces\OperatorRepositoryInterface;
use Modules\Auth\src\Interfaces\PasswordResetCodeRepositoryInterface;
use Modules\Auth\src\Interfaces\PermissionRepositoryInterface;
use Modules\Auth\src\Repositories\OperatorRepository;
use Modules\Auth\src\Repositories\PasswordResetCodeRepository;
use Modules\Auth\src\Repositories\PermissionRepository;

class AuthServiceProvider extends ServiceProvider
{
    use BootsAsModule;

    public function register(): void
    {
        $this->app->bind(OperatorRepositoryInterface::class, OperatorRepository::class);
        $this->app->bind(PermissionRepositoryInterface::class, PermissionRepository::class);
        $this->app->bind(PasswordResetCodeRepositoryInterface::class, PasswordResetCodeRepository::class);
    }

    public function boot(): void
    {
        $this->bootThisAsModule();
    }
}
