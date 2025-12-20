<?php

namespace Modules\Auth\database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\Auth\src\Entities\PasswordResetToken;

class PasswordResetTokenFactory extends Factory
{
    protected $model = PasswordResetToken::class;

    public function definition(): array
    {
        return [
            'email' => fake()->unique()->safeEmail(),
        ];
    }
}
