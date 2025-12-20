<?php

namespace Modules\Inventories\src\Repositories;

use App\Repositories\Repository;
use Modules\Inventories\src\Entities\Category;
use Modules\Inventories\src\Interfaces\CategoryRepositoryInterface;

class CategoryRepository extends Repository implements CategoryRepositoryInterface
{
    public function __construct(Category $entity)
    {
        parent::__construct($entity);
    }
}
