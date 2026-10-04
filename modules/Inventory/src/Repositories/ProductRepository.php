<?php

namespace Modules\Inventory\src\Repositories;

use App\Repositories\Repository;
use Modules\Inventory\src\Entities\Product;
use Modules\Inventory\src\Interfaces\ProductRepositoryInterface;

class ProductRepository extends Repository implements ProductRepositoryInterface
{
    public function __construct(Product $entity)
    {
        parent::__construct($entity);
    }

    public function findBySku(string $sku): ?Product
    {
        return $this->entity->whereSku($sku)->first();
    }
}
