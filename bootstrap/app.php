<?php

use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\HttpException;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(using: function () {
    })
    ->withMiddleware(function (Middleware $middleware): void {
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        $exceptions->render(function (AuthenticationException $exception) {
            return response()->error(401, $exception->getMessage());
        });
        $exceptions->render(function (ValidationException $exception) {
            return response()->error(422, $exception->getMessage());
        });
        $exceptions->render(function (HttpException $exception) {
            return response()->error($exception->getStatusCode(), $exception->getMessage());
        });
        $exceptions->render(function (Throwable $throwable) {
            return response()->error(500, $throwable->getMessage());
        });
    })->create();
