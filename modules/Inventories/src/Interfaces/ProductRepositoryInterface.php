<?php

namespace Modules\Inventories\src\Interfaces;

use App\Interfaces\RepositoryInterface;
use Modules\Inventories\src\Entities\Product;

interface ProductRepositoryInterface extends RepositoryInterface
{
    public function findBySku(string $sku): ?Product;
}
