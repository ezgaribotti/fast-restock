<?php

namespace Modules\Shipments\database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\Common\src\Entities\Country;
use Modules\Shipments\src\Entities\Tax;

class TaxFactory extends Factory
{
    protected $model = Tax::class;

    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'country_id' => Country::factory(),
            'tax_rate' => fake()->numberBetween(5, 95),
        ];
    }
}
