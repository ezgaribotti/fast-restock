<?php

namespace Modules\Shipments\database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\Common\src\Entities\Country;
use Modules\Shipments\src\Entities\LogisticsPoint;

class LogisticsPointFactory extends Factory
{
    protected $model = LogisticsPoint::class;

    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'country_id' => Country::factory(),
            'latitude' => fake()->latitude(),
            'longitude' => fake()->longitude(),
            'service_fee' => fake()->randomDecimal(),
        ];
    }
}
