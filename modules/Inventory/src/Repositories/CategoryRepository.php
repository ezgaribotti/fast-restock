<?php

namespace Modules\Inventory\src\Repositories;

use App\Repositories\Repository;
use Modules\Inventory\src\Entities\Category;
use Modules\Inventory\src\Interfaces\CategoryRepositoryInterface;

class CategoryRepository extends Repository implements CategoryRepositoryInterface
{
    public function __construct(Category $entity)
    {
        parent::__construct($entity);
    }
}
