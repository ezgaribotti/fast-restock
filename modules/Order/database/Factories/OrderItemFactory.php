<?php

namespace Modules\Order\database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\Common\src\Entities\Stock;
use Modules\Order\src\Entities\OrderItem;

class OrderItemFactory extends Factory
{
    protected $model = OrderItem::class;

    public function definition(): array
    {
        return [
            'stock_id' => Stock::factory(),
            'quantity' => fake()->numberBetween(1, 10),
        ];
    }
}
