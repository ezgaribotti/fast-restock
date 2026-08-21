<?php

namespace Modules\Customer\src\Repositories;

use App\Repositories\Repository;
use Modules\Customer\src\Entities\CustomerAddress;
use Modules\Customer\src\Interfaces\CustomerAddressRepositoryInterface;

class CustomerAddressRepository extends Repository implements CustomerAddressRepositoryInterface
{
    public function __construct(CustomerAddress $entity)
    {
        parent::__construct($entity);
    }
}
