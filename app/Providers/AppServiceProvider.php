<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Faker\Provider\Base as Faker;
use Faker\Generator;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
    }

    public function boot(): void
    {
        // For use in the factories

        $faker = fake();
        $faker->addProvider(new class($faker) extends Faker {
            public function randomDecimal(int $minimum = 100): float {
                return $this->generator->randomFloat(2, $minimum, $minimum * 2);
            }
        });
        app()->singleton(Generator::class, fn() => $faker);
    }
}
