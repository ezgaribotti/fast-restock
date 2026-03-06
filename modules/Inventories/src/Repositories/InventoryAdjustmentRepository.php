<?php

namespace Modules\Inventories\src\Repositories;

use App\Repositories\Repository;
use Modules\Inventories\src\Entities\InventoryAdjustment;
use Modules\Inventories\src\Interfaces\InventoryAdjustmentRepositoryInterface;

class InventoryAdjustmentRepository extends Repository implements InventoryAdjustmentRepositoryInterface
{
    public function __construct(InventoryAdjustment $entity)
    {
        parent::__construct($entity);
    }
}
