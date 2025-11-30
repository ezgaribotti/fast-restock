<?php

namespace Modules\Orders\src\Repositories;

use App\Repositories\Repository;
use Modules\Common\src\Entities\Product;
use Modules\Orders\src\Interfaces\ProductRepositoryInterface;

class ProductRepository extends Repository implements ProductRepositoryInterface
{
    public function __construct(Product $entity)
    {
        parent::__construct($entity);
    }
}
