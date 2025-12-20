<?php

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Str;
use Laravel\Sanctum\Sanctum;
use Modules\Auth\src\Entities\Operator;
use Modules\Auth\src\Entities\PasswordResetToken;
use Modules\Auth\src\Enums\OperatorStatus;
use Tests\TestCase;

uses(TestCase::class, DatabaseTransactions::class);

test('should log in and return an access token', function () {
    $operator = Operator::factory()->create();

    $response = $this->postJson(route('login'), [
        'internal_code' => $operator->internal_code,
        'password' => 'password',
    ]);
    $response->assertOk();
});

test('should return an error when the credentials are wrong', function () {
    $operator = Operator::factory()->create();

    $response = $this->postJson(route('login'), [
        'internal_code' => $operator->internal_code,
        'password' => 'wrong',
    ]);
    $response->assertStatus(401);
});

test('should return an error when the operator is suspended or blocked', function () {
    $operator = Operator::factory()->create(['status' => OperatorStatus::Suspended]);

    $response = $this->postJson(route('login'), [
        'internal_code' => $operator->internal_code,
        'password' => 'password',
    ]);
    $response->assertStatus(403);
});

test('should return the authenticated operator', function () {
    Sanctum::actingAs(Operator::factory()->create());

    $response = $this->getJson(route('current-operator'));
    $response->assertOk();
});

test('should log out successfully', function () {
    Sanctum::actingAs(Operator::factory()->create());

    $response = $this->postJson(route('logout'));
    $response->assertOk();
});

test('should send link to reset password successfully', function () {
    $operator = Operator::factory()->create();

    $response = $this->postJson(route('forgot-password'), [
        'email' => $operator->email,
        'return_url' => URL::current(),
    ]);
    $response->assertOk();
});

test('should reset password successfully', function () {
    $operator = Operator::factory()->create();
    $token = Str::random(56);

    PasswordResetToken::factory()->create([
        'email' => $operator->email,
        'token' => Hash::make($token)
    ]);

    $password = 'password';
    $response = $this->postJson(route('reset-password', ['token' => $token]), [
        'email' => $operator->email,
        'password' => $password,
        'password_confirmation' => $password,
    ]);
    $response->assertOk();
});
