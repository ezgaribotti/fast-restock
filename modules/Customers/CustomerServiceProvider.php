<?php

namespace Modules\Customers;

use App\Traits\ModuleLoader;
use Illuminate\Support\ServiceProvider;
use Modules\Customers\src\Interfaces\CountryRepositoryInterface;
use Modules\Customers\src\Interfaces\CustomerAddressRepositoryInterface;
use Modules\Customers\src\Interfaces\CustomerRepositoryInterface;
use Modules\Customers\src\Repositories\CountryRepository;
use Modules\Customers\src\Repositories\CustomerAddressRepository;
use Modules\Customers\src\Repositories\CustomerRepository;

class CustomerServiceProvider extends ServiceProvider
{
    use ModuleLoader;

    public function boot(): void
    {
        $this->loadModule($this);
    }

    public function register(): void
    {
        $this->app->bind(CountryRepositoryInterface::class, CountryRepository::class);
        $this->app->bind(CustomerRepositoryInterface::class, CustomerRepository::class);
        $this->app->bind(CustomerAddressRepositoryInterface::class, CustomerAddressRepository::class);
    }
}
