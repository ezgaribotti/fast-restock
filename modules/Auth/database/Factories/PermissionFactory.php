<?php

namespace Modules\Auth\database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\Auth\src\Entities\Permission;

class PermissionFactory extends Factory
{
    protected $model = Permission::class;

    public function definition(): array
    {
        $name = fake()->unique()->name();

        // The ability is used to create Sanctum tokens

        return [
            'name' => $name,
            'ability' => str_replace(chr(32), chr(45), lcfirst($name)),
        ];
    }
}
