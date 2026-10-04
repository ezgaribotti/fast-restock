<?php

use Laravel\Sanctum\Sanctum;
use Modules\Common\src\Entities\Operator;
use Modules\Inventory\src\Entities\PurchaseOrder;
use Modules\Inventory\src\Enums\PurchaseOrderStatus;
use Tests\TestCase;

uses(TestCase::class);

describe('purchase orders', function () {

    // Integration tests

    beforeEach(function () {
        Sanctum::actingAs(Operator::factory()->create());
    });

    test('should return a paginated list', function () {

        PurchaseOrder::factory()->create();
        $this->getJson(route('purchase-orders.index'))->assertStatus(200);
    });

    test('should return a single one', function () {

        $order = PurchaseOrder::factory()->create();
        $this->getJson(route('purchase-orders.show', $order))->assertStatus(200);
    });

    test('should update one', function () {

        $order = PurchaseOrder::factory()->create();
        $data = [
            ...$order->toArray(),
            'status' => PurchaseOrderStatus::Received,
        ];

        $this->putJson(route('purchase-orders.update', $order), $data)->assertStatus(200);
    });
});
