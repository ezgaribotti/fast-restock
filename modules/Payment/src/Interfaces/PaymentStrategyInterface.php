<?php

namespace Modules\Payment\src\Interfaces;

use Modules\Payment\src\Data\PaymentAttempt;

interface PaymentStrategyInterface
{
    public function pay(array $lineItems, string $returnUrl): PaymentAttempt;

    public function retrieve(string $referenceId): PaymentAttempt;

    public function expire(string $referenceId): void;
}
