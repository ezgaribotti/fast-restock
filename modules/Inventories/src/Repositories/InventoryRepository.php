<?php

namespace Modules\Inventories\src\Repositories;

use App\Repositories\Repository;
use Modules\Inventories\src\Entities\Inventory;
use Modules\Inventories\src\Interfaces\InventoryRepositoryInterface;

class InventoryRepository extends Repository implements InventoryRepositoryInterface
{
    public function __construct(Inventory $entity)
    {
        parent::__construct($entity);
    }
}
