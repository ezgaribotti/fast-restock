<?php

use Illuminate\Support\Str;
use Laravel\Sanctum\Sanctum;
use Modules\Auth\src\Entities\Operator;
use Modules\Auth\src\Entities\PasswordResetCode;
use Modules\Auth\src\Enums\OperatorStatus;
use Tests\TestCase;

uses(TestCase::class);

describe('auth', function () {

    // Integration tests

    test('should log in', function () {

        $operator = Operator::factory()->create();
        $data = [
            'internal_code' => $operator->internal_code,
            'password' => 'password',
        ];

        $this->postJson(route('auth.login'), $data)->assertStatus(200);
    });

    test('should fail when credentials are wrong', function () {

        $operator = Operator::factory()->create();
        $data = [
            'internal_code' => $operator->internal_code,
            'password' => 'wrong',
        ];

        $this->postJson(route('auth.login'), $data)->assertStatus(401);
    });

    test('should fail when status is suspended', function () {

        $status = OperatorStatus::Suspended;

        // Suspended operators can recover by resetting their password

        $operator = Operator::factory()->create(get_defined_vars());
        $data = [
            'internal_code' => $operator->internal_code,
            'password' => 'password',
        ];

        $this->postJson(route('auth.login'), $data)->assertStatus(403);
    });

    test('should return the authenticated operator', function () {

        Sanctum::actingAs(Operator::factory()->create());
        $this->getJson(route('auth.current-operator'))->assertStatus(200);
    });

    test('should log out', function () {

        Sanctum::actingAs(Operator::factory()->create());
        $this->postJson(route('auth.logout'))->assertStatus(200);
    });

    test('should send reset password code', function () {

        $operator = Operator::factory()->create();
        $data = [

            // Emails are unique per operator
            'email' => $operator->email,
        ];

        $this->postJson(route('auth.forgot-password'), $data)->assertStatus(200);
    });

    test('should reset password', function () {

        $code = strtoupper(Str::random(6));

        // The reset code can only be used once
        $operator = tap(Operator::factory()->create(), function (Operator $operator) use ($code) {

            // The entity hashes the code

            PasswordResetCode::factory()->create([
                'email' => $operator->email,
                'code' => $code,
            ]);
        });

        // The reset code is associated with the operator's email

        $password = 'password';
        $data = [
            'email' => $operator->email,
            'password' => $password,
            'password_confirmation' => $password,
            'code' => $code,
        ];

        $this->postJson(route('auth.reset-password'), $data)->assertStatus(200);
    });
});
