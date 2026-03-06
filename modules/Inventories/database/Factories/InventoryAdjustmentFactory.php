<?php

namespace Modules\Inventories\database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\Inventories\src\Entities\InventoryAdjustment;

class InventoryAdjustmentFactory extends Factory
{
    protected $model = InventoryAdjustment::class;

    public function definition(): array
    {
        return [];
    }
}
