<?php

use Laravel\Sanctum\Sanctum;
use Modules\Common\src\Entities\Operator;
use Modules\Payment\src\Entities\Payment;
use Tests\TestCase;

uses(TestCase::class);

describe('payments', function () {

    // Integration tests

    beforeEach(function () {
        Sanctum::actingAs(Operator::factory()->create());
    });

    test('should return a paginated list', function () {

        Payment::factory()->create();
        $this->getJson(route('payments.index'))->assertStatus(200);
    });

    test('should store a new one', function () {

        $data = Payment::factory()->make()->toArray();
        $this->postJson(route('payments.store'), $data)->assertStatus(200);
    })->skip();

    test('should return a single one', function () {

        $payment = Payment::factory()->create();
        $this->getJson(route('payments.show', $payment))->assertStatus(200);
    });
});
