<?php

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Laravel\Sanctum\Sanctum;
use Modules\Auth\src\Entities\Operator;
use Modules\Auth\src\Entities\Permission;
use Tests\TestCase;

uses(TestCase::class, DatabaseTransactions::class);

test('should return list of operators', function () {
    Sanctum::actingAs(Operator::factory()->create());

    $response = $this->getJson(route('operators.index'));
    $response->assertOk();
});

test('should store a new operator', function () {
    Sanctum::actingAs(Operator::factory()->create());

    $operator = Operator::factory()->make();
    $password = 'password';

    $response = $this->postJson(route('operators.store'), array_merge($operator->toArray(), [
        'password' => $password,
        'password_confirmation' => $password
    ]));
    $response->assertOk();
});

test('should return an operator', function () {
    $operator = Operator::factory()->create();
    Sanctum::actingAs($operator);

    $response = $this->getJson(route('operators.show', ['operator' => $operator]));
    $response->assertOk();
});

test('should update an operator', function () {
    $operator = Operator::factory()->create();
    Sanctum::actingAs($operator);

    $response = $this->putJson(route('operators.update', [
        'operator' => $operator
    ]), Operator::factory()->make(['status' => 'blocked'])->toArray());
    $response->assertOk();
});

test('should delete an operator', function () {
    $operator = Operator::factory()->create();
    Sanctum::actingAs($operator);

    $response = $this->deleteJson(route('operators.destroy', ['operator' => $operator]));
    $response->assertOk();
});

test('should synchronize the permissions', function () {
    $operator = Operator::factory()->create();
    Sanctum::actingAs($operator);

    $response = $this->postJson(route('operators.sync-permissions'), [
        'operator_id' => $operator->id,
        'permissions' => [Permission::factory()->create()->id]
    ]);
    $response->assertOk();
});
