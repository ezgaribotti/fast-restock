<?php

namespace Modules\Inventory\database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\Inventory\src\Entities\Product;
use Modules\Inventory\src\Entities\ProductImage;

class ProductImageFactory extends Factory
{
    protected $model = ProductImage::class;

    public function definition(): array
    {
        $hostedUrl = fake()->imageUrl(); // Must be real

        return [
            'product_id' => Product::factory(),
            'hosted_url' => $hostedUrl,
            'description' => fake()->sentence(),
        ];
    }
}
