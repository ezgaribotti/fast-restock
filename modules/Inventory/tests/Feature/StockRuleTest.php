<?php

use Laravel\Sanctum\Sanctum;
use Modules\Common\src\Entities\Operator;
use Modules\Inventory\src\Entities\StockRule;
use Tests\TestCase;

uses(TestCase::class);

describe('stock rules', function () {

    // Integration tests

    beforeEach(function () {
        Sanctum::actingAs(Operator::factory()->create());
    });

    test('should return a paginated list', function () {

        StockRule::factory()->create();
        $this->getJson(route('stock-rules.index'))->assertStatus(200);
    });

    test('should store a new one', function () {

        $data = StockRule::factory()->make()->toArray();
        $this->postJson(route('stock-rules.store'), $data)->assertStatus(200);
    });

    test('should return a single one', function () {

        $rule = StockRule::factory()->create();
        $this->getJson(route('stock-rules.show', $rule))->assertStatus(200);
    });

    test('should update one', function () {

        $rule = StockRule::factory()->create();

        $data = StockRule::factory()->make()->toArray();
        $this->putJson(route('stock-rules.update', $rule), $data)->assertStatus(200);
    });

    test('should delete one', function () {

        $rule = StockRule::factory()->create();
        $this->deleteJson(route('stock-rules.destroy', $rule))->assertStatus(200);
    });
});
