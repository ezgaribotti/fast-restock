<?php

namespace Modules\Inventory\database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\Inventory\src\Entities\Product;
use Modules\Inventory\src\Entities\StockRule;

class StockRuleFactory extends Factory
{
    protected $model = StockRule::class;

    public function definition(): array
    {
        [$alertThreshold, $capacityLimit] = [10, fake()->numberBetween(100, 900)];

        return [
            'product_id' => Product::factory(),
            'alert_threshold' => $alertThreshold,
            'capacity_limit' => $capacityLimit,
            'optimum_quantity' => $capacityLimit - $alertThreshold,
        ];
    }
}
