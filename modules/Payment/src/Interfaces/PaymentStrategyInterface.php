<?php

namespace Modules\Payment\src\Interfaces;

use Carbon\CarbonInterface;

interface PaymentStrategyInterface
{
    public function pay(array $lineItems, CarbonInterface $expiresAt, string $returnUrl): array;
}
