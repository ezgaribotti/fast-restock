<?php

namespace Modules\Customer\database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\Customer\src\Entities\Customer;
use Modules\Customer\src\Entities\CustomerAddress;

class CustomerAddressFactory extends Factory
{
    protected $model = CustomerAddress::class;

    public function definition(): array
    {
        $postalCode = fake()->postcode(); // Must be real

        return [
            'customer_id' => Customer::factory(),
            'street_address' => fake()->streetAddress(),
            'city' => fake()->city(),
            'state' => fake()->state(),
            'postal_code' => $postalCode,
        ];
    }
}
