<?php

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Laravel\Sanctum\Sanctum;
use Modules\Common\src\Entities\Operator;
use Modules\Inventories\src\Entities\Product;
use Modules\Inventories\src\Jobs\AlertLowStock;
use Illuminate\Support\Facades\Queue;
use Tests\TestCase;

uses(TestCase::class, DatabaseTransactions::class);

test('should return list of products', function () {
    Sanctum::actingAs(Operator::factory()->create());

    $response = $this->getJson(route('products.index'));
    $response->assertOk();
});

test('should store a new product', function () {
    Sanctum::actingAs(Operator::factory()->create());

    $product = Product::factory()->make();
    $response = $this->postJson(route('products.store'), $product->toArray());
    $response->assertOk();
});

test('should return a product', function () {
    Sanctum::actingAs(Operator::factory()->create());

    $product = Product::factory()->create();
    $response = $this->getJson(route('products.show', ['product' => $product]));
    $response->assertOk();
});

test('should update a product', function () {
    Sanctum::actingAs(Operator::factory()->create());

    $product = Product::factory()->create();
    $response = $this->putJson(route('products.update', [
        'product' => $product
    ]), Product::factory()->make(['active' => false])->toArray());
    $response->assertOk();
});

test('should delete a product', function () {
    Sanctum::actingAs(Operator::factory()->create());

    $product = Product::factory()->create();
    $response = $this->deleteJson(route('products.destroy', ['product' => $product]));
    $response->assertOk();
});

test('should dispatch low stock job when stock is below threshold', function () {
    Queue::fake();
    $product = Product::factory()->create(['alert_threshold' => 1]);
    $product->decrement('stock', $product->stock);

    Queue::assertPushed(AlertLowStock::class);
});
