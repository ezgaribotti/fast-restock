<?php

namespace Modules\Orders;

use App\Traits\ModuleLoader;
use Illuminate\Support\ServiceProvider;
use Modules\Orders\src\Interfaces\OrderRepositoryInterface;
use Modules\Orders\src\Interfaces\PaymentRepositoryInterface;
use Modules\Orders\src\Interfaces\ProductRepositoryInterface;
use Modules\Orders\src\Repositories\OrderRepository;
use Modules\Orders\src\Repositories\PaymentRepository;
use Modules\Orders\src\Repositories\ProductRepository;

class OrderServiceProvider extends ServiceProvider
{
    use ModuleLoader;

    public function boot(): void
    {
        $this->loadModule($this);
    }

    public function register(): void
    {
        $this->app->bind(OrderRepositoryInterface::class, OrderRepository::class);
        $this->app->bind(ProductRepositoryInterface::class, ProductRepository::class);
        $this->app->bind(PaymentRepositoryInterface::class, PaymentRepository::class);
    }
}
