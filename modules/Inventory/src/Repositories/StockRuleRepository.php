<?php

namespace Modules\Inventory\src\Repositories;

use App\Repositories\Repository;
use Modules\Inventory\src\Entities\StockRule;
use Modules\Inventory\src\Interfaces\StockRuleRepositoryInterface;

class StockRuleRepository extends Repository implements StockRuleRepositoryInterface
{
    public function __construct(StockRule $entity)
    {
        parent::__construct($entity);
    }
}
