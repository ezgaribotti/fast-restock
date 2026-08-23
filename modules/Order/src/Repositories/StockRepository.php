<?php

namespace Modules\Order\src\Repositories;

use App\Repositories\Repository;
use Modules\Common\src\Entities\Stock;
use Modules\Order\src\Interfaces\StockRepositoryInterface;

class StockRepository extends Repository implements StockRepositoryInterface
{
    public function __construct(Stock $entity)
    {
        parent::__construct($entity);
    }
}
