<?php

namespace Modules\Customers\database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\Customers\src\Entities\Country;

class CountryFactory extends Factory
{
    protected $model = Country::class;

    public function definition(): array
    {
        return [
            'name' => fake()->country(),
            'iso_code' => fake()->countryCode(),
        ];
    }
}
