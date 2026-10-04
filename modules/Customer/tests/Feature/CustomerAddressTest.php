<?php

use Laravel\Sanctum\Sanctum;
use Modules\Common\src\Entities\Operator;
use Modules\Customer\src\Entities\CustomerAddress;
use Tests\TestCase;

uses(TestCase::class);

describe('customer addresses', function () {

    // Integration tests

    beforeEach(function () {
        Sanctum::actingAs(Operator::factory()->create());
    });

    test('should store a new one', function () {

        $data = CustomerAddress::factory()->make()->toArray();
        $this->postJson(route('customer-addresses.store'), $data)->assertStatus(200);
    });

    test('should delete one', function () {

        $address = CustomerAddress::factory()->create();
        $this->deleteJson(route('customer-addresses.destroy', $address))->assertStatus(200);
    });
});
