<?php

namespace Modules\Order\src\Repositories;

use App\Repositories\Repository;
use Modules\Order\src\Entities\OrderItem;
use Modules\Order\src\Interfaces\OrderItemRepositoryInterface;

class OrderItemRepository extends Repository implements OrderItemRepositoryInterface
{
    public function __construct(OrderItem $entity)
    {
        parent::__construct($entity);
    }
}
