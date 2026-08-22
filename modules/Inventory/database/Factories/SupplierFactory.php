<?php

namespace Modules\Inventory\database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\Inventory\src\Entities\Supplier;

class SupplierFactory extends Factory
{
    protected $model = Supplier::class;

    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
        ];
    }
}
