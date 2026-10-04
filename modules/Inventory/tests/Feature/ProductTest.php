<?php

use Laravel\Sanctum\Sanctum;
use Modules\Common\src\Entities\Operator;
use Modules\Inventory\src\Entities\Product;
use Tests\TestCase;

uses(TestCase::class);

describe('products', function () {

    // Integration tests

    beforeEach(function () {
        Sanctum::actingAs(Operator::factory()->create());
    });

    test('should return a paginated list', function () {

        Product::factory()->create();
        $this->getJson(route('products.index'))->assertStatus(200);
    });

    test('should store a new one', function () {

        $data = Product::factory()->make()->toArray();
        $this->postJson(route('products.store'), $data)->assertStatus(200);
    });

    test('should return a single one', function () {

        $product = Product::factory()->create();
        $this->getJson(route('products.show', $product))->assertStatus(200);
    });

    test('should update one', function () {

        $product = Product::factory()->create();
        $data = [
            ...$product->toArray(),
            'is_active' => false,
        ];

        $this->putJson(route('products.update', $product), $data)->assertStatus(200);
    });

    test('should delete one', function () {

        $product = Product::factory()->create();
        $this->deleteJson(route('products.destroy', $product))->assertStatus(200);
    });
});
