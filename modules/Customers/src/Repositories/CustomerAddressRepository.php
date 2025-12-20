<?php

namespace Modules\Customers\src\Repositories;

use App\Repositories\Repository;
use Modules\Customers\src\Entities\CustomerAddress;
use Modules\Customers\src\Interfaces\CustomerAddressRepositoryInterface;

class CustomerAddressRepository extends Repository implements CustomerAddressRepositoryInterface
{
    public function __construct(CustomerAddress $entity)
    {
        parent::__construct($entity);
    }

    public function getByCustomerId(int $customerId): CustomerAddress
    {
        return $this->entity->whereCustomerId($customerId)->get();
    }
}
