<?php

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Laravel\Sanctum\Sanctum;
use Modules\Common\src\Entities\Operator;
use Modules\Common\src\Entities\CustomerAddress;
use Modules\Common\src\Entities\Product;
use Modules\Orders\src\Entities\Order;
use Tests\TestCase;

uses(TestCase::class, DatabaseTransactions::class);

test('should return list of orders', function () {
    Sanctum::actingAs(Operator::factory()->create());

    $response = $this->getJson(route('orders.index'));
    $response->assertOk();
});

test('should store a new order', function () {
    Sanctum::actingAs(Operator::factory()->create());

    $customerAddress = CustomerAddress::factory()->create();
    $product = Product::factory()->create();

    $item = ['product_id' => $product->id, 'quantity' => 1];

    $response = $this->postJson(route('orders.store'), [
        'pay_shipping' => true,
        'customer_address_id' => $customerAddress->id,
        'items' => [$item],
    ]);
    $response->assertOk();
});

test('should return an order', function () {
    Sanctum::actingAs(Operator::factory()->create());

    $order = Order::factory()->create();
    $response = $this->getJson(route('orders.show', ['order' => $order]));
    $response->assertOk();
});

test('should update an order', function () {
    Sanctum::actingAs(Operator::factory()->create());

    $order = Order::factory()->create();
    $response = $this->putJson(route('orders.update', ['order' => $order]));
    $response->assertOk();
});
