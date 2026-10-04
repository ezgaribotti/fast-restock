<?php

namespace Modules\Payment\src\Repositories;

use App\Repositories\Repository;
use Modules\Common\src\Entities\Order;
use Modules\Payment\src\Interfaces\OrderRepositoryInterface;

class OrderRepository extends Repository implements OrderRepositoryInterface
{
    public function __construct(Order $entity)
    {
        parent::__construct($entity);
    }
}
