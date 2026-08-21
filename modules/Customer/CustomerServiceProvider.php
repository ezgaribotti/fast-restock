<?php

namespace Modules\Customer;

use App\Concerns\BootsAsModule;
use Illuminate\Support\ServiceProvider;
use Modules\Customer\src\Interfaces\CustomerAddressRepositoryInterface;
use Modules\Customer\src\Interfaces\CustomerRepositoryInterface;
use Modules\Customer\src\Repositories\CustomerAddressRepository;
use Modules\Customer\src\Repositories\CustomerRepository;

class CustomerServiceProvider extends ServiceProvider
{
    use BootsAsModule;

    public function register(): void
    {
        $this->app->bind(CustomerRepositoryInterface::class, CustomerRepository::class);
        $this->app->bind(CustomerAddressRepositoryInterface::class, CustomerAddressRepository::class);
    }

    public function boot(): void
    {
        $this->bootThisAsModule();
    }
}
