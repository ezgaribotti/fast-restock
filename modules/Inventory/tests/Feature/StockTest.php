<?php

use Laravel\Sanctum\Sanctum;
use Modules\Common\src\Entities\Operator;
use Modules\Inventory\src\Entities\Stock;
use Tests\TestCase;

uses(TestCase::class);

describe('stocks', function () {

    // Integration tests

    beforeEach(function () {
        Sanctum::actingAs(Operator::factory()->create());
    });

    test('should return a paginated list', function () {

        Stock::factory()->create();
        $this->getJson(route('stocks.index'))->assertStatus(200);
    });

    test('should store a new one', function () {

        $data = Stock::factory()->make()->toArray();
        $this->postJson(route('stocks.store'), $data)->assertStatus(200);
    });

    test('should return a single one', function () {

        $stock = Stock::factory()->create();
        $this->getJson(route('stocks.show', $stock))->assertStatus(200);
    });

    test('should update one', function () {

        $stock = Stock::factory()->create();

        $data = Stock::factory()->make()->toArray();
        $this->putJson(route('stocks.update', $stock), $data)->assertStatus(200);
    });

    test('should delete one', function () {

        $stock = Stock::factory()->create();
        $this->deleteJson(route('stocks.destroy', $stock))->assertStatus(200);
    });
});
