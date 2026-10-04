<?php

namespace Modules\Auth\database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\Auth\src\Entities\PasswordResetCode;

class PasswordResetCodeFactory extends Factory
{
    protected $model = PasswordResetCode::class;

    public function definition(): array
    {
        return [];
    }
}
