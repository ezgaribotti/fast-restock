<?php

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Http\UploadedFile;
use Laravel\Sanctum\Sanctum;
use Modules\Common\src\Entities\Operator;
use Modules\Inventories\src\Entities\Product;
use Modules\Inventories\src\Entities\ProductImage;
use Tests\TestCase;

uses(TestCase::class, DatabaseTransactions::class);

test('should upload a new product image', function () {
    Sanctum::actingAs(Operator::factory()->create());

    $product = Product::factory()->create();
    $imageFile = UploadedFile::fake()->image('image.webp');

    $response = $this->postJson(route('product-images.store'), [
        'sku' => $product->sku,
        'description' => $product->name,
        'image_file' => $imageFile,
    ]);
    $response->assertOk();
});

test('should delete a product image', function () {
    Sanctum::actingAs(Operator::factory()->create());

    $imageFile = UploadedFile::fake()->image('image.webp');

    $image = ProductImage::factory()->create([
        'path' => $imageFile->path(),
    ]);
    $response = $this->deleteJson(route('product-images.destroy', ['product_image' => $image]));
    $response->assertOk();
});
