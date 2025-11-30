<?php

namespace Modules\Shipments\src\Repositories;

use App\Repositories\Repository;
use Modules\Common\src\Entities\Order;
use Modules\Shipments\src\Interfaces\OrderRepositoryInterface;

class OrderRepository extends Repository implements OrderRepositoryInterface
{
    public function __construct(Order $entity)
    {
        parent::__construct($entity);
    }
}
