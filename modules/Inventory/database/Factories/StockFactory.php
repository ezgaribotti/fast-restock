<?php

namespace Modules\Inventory\database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\Inventory\src\Entities\Product;
use Modules\Inventory\src\Entities\Stock;

class StockFactory extends Factory
{
    protected $model = Stock::class;

    public function definition(): array
    {
        $location = implode(chr(45), [
            ucfirst(fake()->randomLetter()),
            ...str_split(fake()->randomNumber(6, true), 2),
        ]);

        return [
            'product_id' => Product::factory(),
            'quantity' => fake()->numberBetween(100, 900),
            'picking_location' => $location,
        ];
    }
}
