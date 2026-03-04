<?php

namespace Modules\Inventories\src\Repositories;

use App\Repositories\Repository;
use Modules\Inventories\src\Entities\Product;
use Modules\Inventories\src\Interfaces\ProductRepositoryInterface;

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
