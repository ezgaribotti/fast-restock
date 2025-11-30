<?php

namespace Modules\Inventories\src\Repositories;

use App\Repositories\Repository;
use Modules\Inventories\src\Entities\ProductImage;
use Modules\Inventories\src\Interfaces\ProductImageRepositoryInterface;

class ProductImageRepository extends Repository implements ProductImageRepositoryInterface
{
    public function __construct(ProductImage $entity)
    {
        parent::__construct($entity);
    }
}
