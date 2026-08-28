<?php

namespace Modules\Payment;

use App\Concerns\BootsAsModule;
use Illuminate\Support\ServiceProvider;
use Modules\Payment\src\Interfaces\OrderRepositoryInterface;
use Modules\Payment\src\Interfaces\PaymentRepositoryInterface;
use Modules\Payment\src\Repositories\OrderRepository;
use Modules\Payment\src\Repositories\PaymentRepository;

class PaymentServiceProvider extends ServiceProvider
{
    use BootsAsModule;

    public function register(): void
    {
        $this->app->bind(PaymentRepositoryInterface::class, PaymentRepository::class);
        $this->app->bind(OrderRepositoryInterface::class, OrderRepository::class);
    }

    public function boot(): void
    {
        $this->bootThisAsModule();
    }
}
