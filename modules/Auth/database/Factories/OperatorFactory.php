<?php

namespace Modules\Auth\database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\Auth\src\Entities\Operator;

class OperatorFactory extends Factory
{
    protected $model = Operator::class;

    public function definition(): array
    {
        [$firstName, $lastName] = [
            fake()->firstName(), fake()->lastName()];

        $initials = $firstName[0] . $lastName[0]; // Operator's two-letter initials

        return [
            'full_name' => $firstName . chr(32) . $lastName,
            'internal_code' => $initials . fake()->unique()->randomNumber(8, true),
            'email' => fake()->unique()->safeEmail(),
            'password' => fake()->password(),
        ];
    }
}
