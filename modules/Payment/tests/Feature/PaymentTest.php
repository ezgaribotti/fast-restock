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
});
