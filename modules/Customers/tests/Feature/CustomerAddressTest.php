<?php

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Laravel\Sanctum\Sanctum;
use Modules\Common\src\Entities\Operator;
use Modules\Customers\src\Entities\CustomerAddress;
use Tests\TestCase;

uses(TestCase::class, DatabaseTransactions::class);

test('should store a new address', function () {
    Sanctum::actingAs(Operator::factory()->create());

    $address = CustomerAddress::factory()->make();
    $response = $this->postJson(route('customer-addresses.store'), $address->toArray());
    $response->assertOk();
});

test('should delete an address', function () {
    Sanctum::actingAs(Operator::factory()->create());

    $address = CustomerAddress::factory()->create();
    $response = $this->deleteJson(route('customer-addresses.destroy', [
        'customer_address' => $address
    ]));
    $response->assertOk();
});
