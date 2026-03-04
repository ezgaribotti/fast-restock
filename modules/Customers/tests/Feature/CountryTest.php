<?php

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Laravel\Sanctum\Sanctum;
use Modules\Common\src\Entities\Operator;
use Tests\TestCase;

uses(TestCase::class, DatabaseTransactions::class);

test('should return list of countries', function () {
    Sanctum::actingAs(Operator::factory()->create());

    $response = $this->getJson(route('countries.index'));
    $response->assertOk();
});
