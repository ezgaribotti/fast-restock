<?php

namespace Modules\Inventory\src\Repositories;

use App\Repositories\Repository;
use Modules\Inventory\src\Entities\ProductImage;
use Modules\Inventory\src\Interfaces\ProductImageRepositoryInterface;

class ProductImageRepository extends Repository implements ProductImageRepositoryInterface
{
    public function __construct(ProductImage $entity)
    {
        parent::__construct($entity);
    }
}
