<?php

namespace Modules\Order\src\Repositories;

use App\Repositories\Repository;
use Modules\Order\src\Entities\Order;
use Modules\Order\src\Interfaces\OrderRepositoryInterface;

class OrderRepository extends Repository implements OrderRepositoryInterface
{
    public function __construct(Order $entity)
    {
        parent::__construct($entity);
    }
}
