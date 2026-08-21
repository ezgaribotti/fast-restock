<?php

use Laravel\Sanctum\Sanctum;
use Modules\Auth\src\Entities\Operator;
use Modules\Auth\src\Entities\Permission;
use Modules\Auth\src\Enums\OperatorStatus;
use Tests\TestCase;

uses(TestCase::class);

describe('operators', function () {

    // Integration tests

    beforeEach(function () {
        Sanctum::actingAs(Operator::factory()->create());
    });

    test('should return a paginated list', function () {

        Operator::factory()->create();
        $this->getJson(route('operators.index'))->assertStatus(200);
    });

    test('should store a new one', function () {

        $password = 'password';

        // The entity hashes the password
        $data = [
            ...Operator::factory()->make()->toArray(),
            'password' => $password,
            'password_confirmation' => $password
        ];

        $this->postJson(route('operators.store'), $data)->assertStatus(200);
    });

    test('should return a single one', function () {

        $operator = Operator::factory()->create();
        $this->getJson(route('operators.show', $operator))->assertStatus(200);
    });

    test('should update one', function () {

        $operator = Operator::factory()->create();
        $data = [
            ...$operator->toArray(),
            'status' => OperatorStatus::Blocked,
        ];

        $this->putJson(route('operators.update', $operator), $data)->assertStatus(200);
    });

    test('should delete one', function () {

        $operator = Operator::factory()->create();
        $this->deleteJson(route('operators.destroy', $operator))->assertStatus(200);
    });

    test('should synchronize the permissions', function () {

        $operator = Operator::factory()->create();
        $permissions = Permission::factory(5)->create()->map(function ($permission) {
            return $permission->id;
        });
        $data = [
            'operator_id' => $operator->id,
            'permissions' => $permissions
        ];

        $this->postJson(route('operators.sync-permissions'), $data)->assertStatus(200);
    });
});
