<?php

namespace Modules\Inventory\database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\Inventory\src\Entities\PurchaseOrder;
use Modules\Inventory\src\Entities\Stock;
use Modules\Inventory\src\Entities\Supplier;

class PurchaseOrderFactory extends Factory
{
    protected $model = PurchaseOrder::class;

    public function definition(): array
    {
        return [
            'stock_id' => Stock::factory(),
            'supplier_id' => Supplier::factory(),
        ];
    }
}
