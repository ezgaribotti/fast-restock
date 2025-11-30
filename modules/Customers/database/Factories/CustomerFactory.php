<?php

namespace Modules\Customers\database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\Customers\src\Entities\Customer;

class CustomerFactory extends Factory
{
    protected $model = Customer::class;

    public function definition(): array
    {
        return [
            'first_name' => fake()->firstName(),
            'last_name' => fake()->lastName(),
            'email' => fake()->unique()->safeEmail(),
            'full_phone' => fake()->phoneNumber(),
        ];
    }
}
