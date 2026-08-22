<?php

namespace Modules\Inventory\src\Repositories;

use App\Repositories\Repository;
use Modules\Inventory\src\Entities\Supplier;
use Modules\Inventory\src\Interfaces\SupplierRepositoryInterface;

class SupplierRepository extends Repository implements SupplierRepositoryInterface
{
    public function __construct(Supplier $entity)
    {
        parent::__construct($entity);
    }
}
