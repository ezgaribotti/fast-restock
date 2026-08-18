<?php

use Laravel\Sanctum\Sanctum;
use Modules\Auth\src\Entities\Operator;
use Modules\Auth\src\Entities\Permission;
use Tests\TestCase;

uses(TestCase::class);

describe('permissions', function () {

    // Integration tests

    beforeEach(function () {
        Sanctum::actingAs(Operator::factory()->create());
    });

    test('should return a list', function () {

        Permission::factory()->create();
        $this->getJson(route('permissions.index'))->assertStatus(200);
    });
});
