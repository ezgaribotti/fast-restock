<?php

use Laravel\Sanctum\Sanctum;
use Modules\Common\src\Entities\Operator;
use Modules\Inventory\src\Entities\Supplier;
use Tests\TestCase;

uses(TestCase::class);

describe('suppliers', function () {

    // Integration tests

    beforeEach(function () {
        Sanctum::actingAs(Operator::factory()->create());
    });

    test('should return a list', function () {

        Supplier::factory()->create();
        $this->getJson(route('suppliers.index'))->assertStatus(200);
    });
});
