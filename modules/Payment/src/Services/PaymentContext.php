<?php

namespace Modules\Payment\src\Services;

use Carbon\CarbonInterface;
use Modules\Payment\src\Interfaces\PaymentStrategyInterface;
use Modules\Payment\src\Services\Strategies\StripeStrategy;

class PaymentContext
{
    private PaymentStrategyInterface $strategy;

    public function using(?string $class = null): static
    {
        // One is always used by default

        $this->strategy = app($class ?? StripeStrategy::class);
        return $this;
    }

    public function pay(array $lineItems, CarbonInterface $expiresAt, string $returnUrl): array
    {
        return ($this->strategy ?? $this->using())->pay($lineItems, $expiresAt, $returnUrl);
    }
}
