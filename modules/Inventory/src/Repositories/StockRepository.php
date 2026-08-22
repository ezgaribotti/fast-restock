<?php

namespace Modules\Inventory\src\Repositories;

use App\Repositories\Repository;
use Modules\Inventory\src\Entities\Stock;
use Modules\Inventory\src\Interfaces\StockRepositoryInterface;

class StockRepository extends Repository implements StockRepositoryInterface
{
    public function __construct(Stock $entity)
    {
        parent::__construct($entity);
    }
}
