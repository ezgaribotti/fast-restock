<?php

namespace Modules\Inventories\database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\Inventories\src\Entities\Warehouse;

class WarehouseFactory extends Factory
{
    protected $model = Warehouse::class;

    public function definition(): array
    {
        return [
            'name' => fake()->name(),
        ];
    }
}
