<?php

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Laravel\Sanctum\Sanctum;
use Modules\Common\src\Entities\Operator;
use Modules\Customers\src\Entities\Customer;
use Modules\Customers\src\Enums\CustomerStatus;
use Tests\TestCase;

uses(TestCase::class, DatabaseTransactions::class);

test('should return list of customers', function () {
    Sanctum::actingAs(Operator::factory()->create());

    $response = $this->getJson(route('customers.index'));
    $response->assertOk();
});

test('should store a new customer', function () {
    Sanctum::actingAs(Operator::factory()->create());

    $customer = Customer::factory()->make();
    $response = $this->postJson(route('customers.store'), $customer->toArray());
    $response->assertOk();
});

test('should return a customer', function () {
    Sanctum::actingAs(Operator::factory()->create());

    $customer = Customer::factory()->create();
    $response = $this->getJson(route('customers.show', ['customer' => $customer]));
    $response->assertOk();
});

test('should update a customer', function () {
    Sanctum::actingAs(Operator::factory()->create());

    $customer = Customer::factory()->create();
    $response = $this->putJson(route('customers.update', [
        'customer' => $customer
    ]), Customer::factory()->make(['status' => CustomerStatus::Banned])->toArray());
    $response->assertOk();
});

test('should delete a customer', function () {
    Sanctum::actingAs(Operator::factory()->create());

    $customer = Customer::factory()->create();
    $response = $this->deleteJson(route('customers.destroy', ['customer' => $customer]));
    $response->assertOk();
});
