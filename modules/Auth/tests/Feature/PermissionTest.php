<?php

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Laravel\Sanctum\Sanctum;
use Modules\Auth\src\Entities\Operator;
use Tests\TestCase;

uses(TestCase::class, DatabaseTransactions::class);

test('should return list of permissions', function () {
    Sanctum::actingAs(Operator::factory()->create());

    $response = $this->getJson(route('permissions.index'));
    $response->assertOk();
});
