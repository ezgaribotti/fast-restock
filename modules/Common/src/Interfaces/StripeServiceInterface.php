<?php

namespace Modules\Common\src\Interfaces;

interface StripeServiceInterface
{
    public function createSession(int $referenceId, string $trackingCode, string $email, array $items, array $routeNames): object;

    public function retrieveSession(string $id): object;

    public function expireSession(string $id): void;

    public function updateSession(string $id, float $shippingCost): object;
}
