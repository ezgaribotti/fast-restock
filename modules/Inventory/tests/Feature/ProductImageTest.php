<?php

use Laravel\Sanctum\Sanctum;
use Modules\Common\src\Entities\Operator;
use Modules\Inventory\src\Entities\ProductImage;
use Tests\TestCase;

uses(TestCase::class);

describe('product images', function () {

    // Integration tests

    beforeEach(function () {
        Sanctum::actingAs(Operator::factory()->create());
    });

    test('should store a new one', function () {

        $data = ProductImage::factory()->make()->toArray();
        $this->postJson(route('product-images.store'), $data)->assertStatus(200);
    });

    test('should delete one', function () {

        $image = ProductImage::factory()->create();
        $this->deleteJson(route('product-images.destroy', $image))->assertStatus(200);
    });
});
