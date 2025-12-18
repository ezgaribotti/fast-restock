<?php

namespace Modules\Inventories;

use App\Traits\ModuleLoader;
use Illuminate\Support\ServiceProvider;
use Modules\Inventories\src\Interfaces\CategoryRepositoryInterface;
use Modules\Inventories\src\Interfaces\ProductImageRepositoryInterface;
use Modules\Inventories\src\Interfaces\ProductRepositoryInterface;
use Modules\Inventories\src\Interfaces\SupplierRepositoryInterface;
use Modules\Inventories\src\Repositories\CategoryRepository;
use Modules\Inventories\src\Repositories\ProductImageRepository;
use Modules\Inventories\src\Repositories\ProductRepository;
use Modules\Inventories\src\Repositories\SupplierRepository;

class InventoryServiceProvider extends ServiceProvider
{
    use ModuleLoader;

    public function boot(): void
    {
        $this->loadModule($this);
    }

    public function register(): void
    {
        $this->app->bind(CategoryRepositoryInterface::class, CategoryRepository::class);
        $this->app->bind(SupplierRepositoryInterface::class, SupplierRepository::class);
        $this->app->bind(ProductRepositoryInterface::class, ProductRepository::class);
        $this->app->bind(ProductImageRepositoryInterface::class, ProductImageRepository::class);
    }
}
