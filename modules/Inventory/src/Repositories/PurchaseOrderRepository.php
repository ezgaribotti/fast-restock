<?php

namespace Modules\Inventory\src\Repositories;

use App\Repositories\Repository;
use Modules\Inventory\src\Entities\PurchaseOrder;
use Modules\Inventory\src\Interfaces\PurchaseOrderRepositoryInterface;

class PurchaseOrderRepository extends Repository implements PurchaseOrderRepositoryInterface
{
    public function __construct(PurchaseOrder $entity)
    {
        parent::__construct($entity);
    }
}
