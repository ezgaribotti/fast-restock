<?php

namespace App\Providers;

use Faker\Generator;
use Faker\Provider\Base;
use Illuminate\Foundation\Http\Events\RequestHandled;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->afterResolving(Generator::class, function (Generator $faker) {
            $faker->addProvider(new class($faker) extends Base {

                // Override default methods

                public function name(): string
                {
                    return rtrim($this->generator->sentence(2), chr(46));
                }

                public function password(): string
                {
                    return __FUNCTION__;
                }
            });
        });
    }

    public function boot(): void
    {
        // Normalize status code 201 before the response is sent

        $abstract = 'events';

        $this->app[$abstract]->listen(RequestHandled::class, function (RequestHandled $event) {
            if ($event->response->getStatusCode() === 201) {
                $event->response->setStatusCode(200);
            }
        });
    }
}
