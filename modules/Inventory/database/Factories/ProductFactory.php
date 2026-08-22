<?php

namespace Modules\Inventory\database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\Inventory\src\Entities\Category;
use Modules\Inventory\src\Entities\Product;
use Modules\Inventory\src\Entities\Supplier;

class ProductFactory extends Factory
{
    protected $model = Product::class;

    public function definition(): array
    {
        $factors = [4, 9, 2];

        $sku = null;
        foreach ($factors as $factor) {

            // Quadratic equation
            $sku .= str_repeat(chr((-4 * ($factor ** 2) + 24 * $factor + 283) / 5), $factor);
        }

        // This sku doesn't follow a real format

        $sku = substr_replace(
            strtoupper(fake()->unique()->bothify($sku)), chr(45), 11, 0);

        $dimensions = [fake()->numberBetween(100, 400), 100, 100, 400];
        shuffle($dimensions);

        // They must be real
        [$weight, $height, $width, $length] = $dimensions;

        return [
            'name' => fake()->name(),
            'sku' => $sku,
            'unit_price' => fake()->randomFloat(2, 1000, 9000),
            'category_id' => Category::factory(),
            'supplier_id' => Supplier::factory(),
            'weight' => $weight,
            'height' => $height,
            'width' => $width,
            'length' => $length,
            'description' => fake()->sentence(),
        ];
    }
}
