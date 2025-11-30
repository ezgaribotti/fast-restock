<?php

namespace Modules\Shipments\database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\Shipments\src\Entities\TrackingStatus;

class TrackingStatusFactory extends Factory
{
    protected $model = TrackingStatus::class;

    public function definition(): array
    {
        return [
            'name' => fake()->unique()->name,
            'priority' => fake()->randomDigit()
        ];
    }
}
