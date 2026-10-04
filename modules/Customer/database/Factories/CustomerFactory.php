<?php

namespace Modules\Customer\database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\Customer\src\Entities\Customer;

class CustomerFactory extends Factory
{
    protected $model = Customer::class;

    public function definition(): array
    {
        return [
            'first_name' => fake()->firstName(),
            'last_name' => fake()->lastName(),
            'email' => fake()->unique()->safeEmail(),
            'phone_number' => fake()->phoneNumber(),
        ];
    }
}
