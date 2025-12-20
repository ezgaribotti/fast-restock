<?php

namespace Modules\Inventories\database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\Inventories\src\Entities\Category;
use Modules\Inventories\src\Entities\Product;
use Modules\Inventories\src\Entities\Supplier;

class ProductFactory extends Factory
{
    protected $model = Product::class;

    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'sku' => fake()->unique()->unixTime(),
            'unit_price' => fake()->randomDecimal(),
            'weight' => fake()->randomDecimal(),
            'stock' => fake()->randomNumber(),
            'category_id' => Category::factory(),
            'supplier_id' => Supplier::factory(),
            'description' => fake()->text(),
        ];
    }
}
