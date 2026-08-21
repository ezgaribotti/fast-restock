<?php

use Laravel\Sanctum\Sanctum;
use Modules\Common\src\Entities\Operator;
use Modules\Customer\src\Entities\Customer;
use Modules\Customer\src\Enums\CustomerStatus;
use Tests\TestCase;

uses(TestCase::class);

describe('customers', function () {

    // Integration tests

    beforeEach(function () {
        Sanctum::actingAs(Operator::factory()->create());
    });

    test('should return a paginated list', function () {

        Customer::factory()->create();
        $this->getJson(route('customers.index'))->assertStatus(200);
    });

    test('should store a new one', function () {

        $data = Customer::factory()->make()->toArray();
        $this->postJson(route('customers.store'), $data)->assertStatus(201);
    });

    test('should return a single one', function () {

        $customer = Customer::factory()->create();
        $this->getJson(route('customers.show', $customer))->assertStatus(200);
    });

    test('should update one', function () {

        $customer = Customer::factory()->create();
        $data = [
            ...$customer->toArray(),
            'status' => CustomerStatus::Banned,
        ];

        $this->putJson(route('customers.update', $customer), $data)->assertStatus(200);
    });

    test('should delete one', function () {

        $customer = Customer::factory()->create();
        $this->deleteJson(route('customers.destroy', $customer))->assertStatus(200);
    });
});
