<?php

namespace Modules\Order;

use App\Concerns\BootsAsModule;
use Illuminate\Support\ServiceProvider;
use Modules\Order\src\Interfaces\OrderItemRepositoryInterface;
use Modules\Order\src\Interfaces\OrderRepositoryInterface;
use Modules\Order\src\Interfaces\StockRepositoryInterface;
use Modules\Order\src\Repositories\OrderItemRepository;
use Modules\Order\src\Repositories\OrderRepository;
use Modules\Order\src\Repositories\StockRepository;

class OrderServiceProvider extends ServiceProvider
{
    use BootsAsModule;

    public function register(): void
    {
        $this->app->bind(OrderRepositoryInterface::class, OrderRepository::class);
        $this->app->bind(OrderItemRepositoryInterface::class, OrderItemRepository::class);
        $this->app->bind(StockRepositoryInterface::class, StockRepository::class);
    }

    public function boot(): void
    {
        $this->bootThisAsModule();
    }
}
