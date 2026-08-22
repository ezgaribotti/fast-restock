<?php

namespace Modules\Inventory;

use App\Concerns\BootsAsModule;
use Illuminate\Support\ServiceProvider;
use Modules\Inventory\src\Entities\Stock;
use Modules\Inventory\src\Interfaces\CategoryRepositoryInterface;
use Modules\Inventory\src\Interfaces\ProductImageRepositoryInterface;
use Modules\Inventory\src\Interfaces\ProductRepositoryInterface;
use Modules\Inventory\src\Interfaces\PurchaseOrderRepositoryInterface;
use Modules\Inventory\src\Interfaces\StockRepositoryInterface;
use Modules\Inventory\src\Interfaces\StockRuleRepositoryInterface;
use Modules\Inventory\src\Interfaces\SupplierRepositoryInterface;
use Modules\Inventory\src\Observers\StockObserver;
use Modules\Inventory\src\Repositories\CategoryRepository;
use Modules\Inventory\src\Repositories\ProductImageRepository;
use Modules\Inventory\src\Repositories\ProductRepository;
use Modules\Inventory\src\Repositories\PurchaseOrderRepository;
use Modules\Inventory\src\Repositories\StockRepository;
use Modules\Inventory\src\Repositories\StockRuleRepository;
use Modules\Inventory\src\Repositories\SupplierRepository;

class InventoryServiceProvider extends ServiceProvider
{
    use BootsAsModule;

    public function register(): void
    {
        $this->app->bind(CategoryRepositoryInterface::class, CategoryRepository::class);
        $this->app->bind(SupplierRepositoryInterface::class, SupplierRepository::class);
        $this->app->bind(ProductRepositoryInterface::class, ProductRepository::class);
        $this->app->bind(ProductImageRepositoryInterface::class, ProductImageRepository::class);
        $this->app->bind(StockRepositoryInterface::class, StockRepository::class);
        $this->app->bind(StockRuleRepositoryInterface::class, StockRuleRepository::class);
        $this->app->bind(PurchaseOrderRepositoryInterface::class, PurchaseOrderRepository::class);
    }

    public function boot(): void
    {
        $this->bootThisAsModule();
        Stock::observe(StockObserver::class);
    }
}
