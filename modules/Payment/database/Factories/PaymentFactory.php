<?php

namespace Modules\Payment\database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\Common\src\Entities\Order;
use Modules\Payment\src\Entities\Payment;

class PaymentFactory extends Factory
{
    protected $model = Payment::class;

    public function definition(): array
    {
        return [
            'order_id' => Order::factory(),
            'external_id' => fake()->uuid(),
            'total_amount' => fake()->randomFloat(2, 1000, 9000),
            'url' => fake()->url(),
            'expires_at' => fake()->dateTime(),
        ];
    }
}
