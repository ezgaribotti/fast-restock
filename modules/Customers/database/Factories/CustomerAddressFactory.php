<?php

namespace Modules\Customers\database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\Customers\src\Entities\Country;
use Modules\Customers\src\Entities\Customer;
use Modules\Customers\src\Entities\CustomerAddress;

class CustomerAddressFactory extends Factory
{
    protected $model = CustomerAddress::class;

    public function definition(): array
    {
        return [
            'customer_id' => Customer::factory(),
            'country_id' => Country::factory(),
            'street_address' => fake()->streetAddress(),
            'city' => fake()->city(),
            'state' => fake()->citySuffix(),
            'postal_code' => fake()->postcode(),
            'description' => fake()->text(),
        ];
    }
}
