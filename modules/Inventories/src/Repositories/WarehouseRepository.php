<?php

namespace Modules\Inventories\src\Repositories;

use App\Repositories\Repository;
use Modules\Inventories\src\Entities\Warehouse;
use Modules\Inventories\src\Interfaces\WarehouseRepositoryInterface;

class WarehouseRepository extends Repository implements WarehouseRepositoryInterface
{
    public function __construct(Warehouse $entity)
    {
        parent::__construct($entity);
    }
}
