<?php

namespace Modules\Customers\src\Interfaces;

use App\Interfaces\RepositoryInterface;
use Modules\Customers\src\Entities\CustomerAddress;

interface CustomerAddressRepositoryInterface extends RepositoryInterface
{
    public function getByCustomerId(int $customerId): CustomerAddress;
}
