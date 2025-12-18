<?php

namespace Modules\Customers\src\Repositories;

use App\Repositories\Repository;
use Modules\Customers\src\Entities\Customer;
use Modules\Customers\src\Interfaces\CustomerRepositoryInterface;

class CustomerRepository extends Repository implements CustomerRepositoryInterface
{
    public function __construct(Customer $entity)
    {
        parent::__construct($entity);
    }

    public function findByEmail(string $email): ?Customer
    {
        return $this->entity->whereEmail($email)->first();
    }
}
