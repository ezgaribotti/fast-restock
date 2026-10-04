<?php

namespace Modules\Order\database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\Common\src\Entities\Customer;
use Modules\Order\src\Entities\Order;

class OrderFactory extends Factory
{
    protected $model = Order::class;

    public function definition(): array
    {
        return [
            'tracking_code' => strtoupper(uniqid()),
            'customer_id' => Customer::factory(),
            'total_amount' => fake()->randomFloat(2, 1000, 9000),
        ];
    }
}
