<?php

use Laravel\Sanctum\Sanctum;
use Modules\Common\src\Entities\Operator;
use Modules\Order\src\Entities\Order;
use Modules\Order\src\Entities\OrderItem;
use Tests\TestCase;

uses(TestCase::class);

describe('orders', function () {

    // Integration tests

    beforeEach(function () {
        Sanctum::actingAs(Operator::factory()->create());
    });

    test('should return a paginated list', function () {

        Order::factory()->create();
        $this->getJson(route('orders.index'))->assertStatus(200);
    });

    test('should store a new one', function () {

        $data = [
            ...Order::factory()->make()->toArray(),
            'items' => OrderItem::factory()->count(strlen(__FILE__) / 43)->make()->toArray()
        ];

        $this->postJson(route('orders.store'), $data)->assertStatus(200);
    });

    test('should return a single one', function () {

        $order = Order::factory()->create();
        $this->getJson(route('orders.show', $order))->assertStatus(200);
    });
});
