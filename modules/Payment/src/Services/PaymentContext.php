<?php

namespace Modules\Payment\src\Services;

use Exception;
use Modules\Payment\src\Data\PaymentAttempt;
use Modules\Payment\src\Interfaces\PaymentStrategyInterface;
use Modules\Payment\src\Services\Strategies\StripeStrategy;
use Throwable;

class PaymentContext
{
    private PaymentStrategyInterface $strategy;

    public function using(?string $class = null): static
    {
        // One is always used by default

        $this->strategy = app($class ?? StripeStrategy::class);
        return $this;
    }

    public function pay(array $lineItems, string $returnUrl): PaymentAttempt
    {
        try {
            return ($this->strategy ?? $this->using())->pay($lineItems, $returnUrl);

        } catch (Throwable $throwable) {
            logger()->error($throwable->getMessage());

            throw new Exception('Unable to create the payment.');
        }
    }

    public function retrieve(string $referenceId): PaymentAttempt
    {
        try {
            return ($this->strategy ?? $this->using())->retrieve($referenceId);

        } catch (Throwable $throwable) {
            logger()->error($throwable->getMessage());

            throw new Exception('Unable to retrieve the payment.');
        }
    }

    public function expire(string $referenceId): void
    {
        try {
            ($this->strategy ?? $this->using())->expire($referenceId);

        } catch (Throwable $throwable) {
            logger()->error($throwable->getMessage());

            // Continues even if it fails, so it can be expired later
        }
    }
}
