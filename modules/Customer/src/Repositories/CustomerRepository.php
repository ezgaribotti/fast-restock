<?php

namespace Modules\Customer\src\Repositories;

use App\Repositories\Repository;
use Modules\Customer\src\Entities\Customer;
use Modules\Customer\src\Interfaces\CustomerRepositoryInterface;

class CustomerRepository extends Repository implements CustomerRepositoryInterface
{
    public function __construct(Customer $entity)
    {
        parent::__construct($entity);
    }
}
