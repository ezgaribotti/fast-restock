<?php

namespace Modules\Inventories\database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\Inventories\src\Entities\Inventory;
use Modules\Inventories\src\Entities\Product;
use Modules\Inventories\src\Entities\Warehouse;

class InventoryFactory extends Factory
{
    protected $model = Inventory::class;

    public function definition(): array
    {
        return [
            'product_id' => Product::factory(),
            'warehouse_id' => Warehouse::factory(),
            'stock' => fake()->randomNumber(),
        ];
    }
}
