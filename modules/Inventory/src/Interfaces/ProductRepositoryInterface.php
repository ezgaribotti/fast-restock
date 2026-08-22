<?php

namespace Modules\Inventory\src\Interfaces;

use App\Interfaces\RepositoryInterface;
use Modules\Inventory\src\Entities\Product;

interface ProductRepositoryInterface extends RepositoryInterface
{
    public function findBySku(string $sku): ?Product;
}
