<?php

use App\Http\Resources\MessageResource;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\HttpException;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(function () {
    })
    ->withMiddleware(function (Middleware $middleware): void {
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        $exceptions->render(function (HttpException $exception) {
            return new MessageResource($exception->getMessage(), $exception->getStatusCode());
        });

        $exceptions->render(function (Throwable $throwable) {
            if ($throwable instanceof ValidationException || $throwable instanceof AuthenticationException) {

                // Use the default error rendering
                return null;
            }
            return new MessageResource($throwable->getMessage(), 500);
        });
    })->create();
