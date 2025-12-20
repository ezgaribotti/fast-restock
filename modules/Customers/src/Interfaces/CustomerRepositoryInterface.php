<?php

namespace Modules\Customers\src\Interfaces;

use App\Interfaces\RepositoryInterface;
use Modules\Customers\src\Entities\Customer;

interface CustomerRepositoryInterface extends RepositoryInterface
{
    public function findByEmail(string $email): ?Customer;
}
