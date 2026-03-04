<?php

namespace Modules\Inventories\src\Repositories;

use App\Repositories\Repository;
use Modules\Inventories\src\Entities\Supplier;
use Modules\Inventories\src\Interfaces\SupplierRepositoryInterface;

class SupplierRepository extends Repository implements SupplierRepositoryInterface
{
    public function __construct(Supplier $entity)
    {
        parent::__construct($entity);
    }
}
