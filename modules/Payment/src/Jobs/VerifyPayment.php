<?php

namespace Modules\Payment\src\Jobs;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Modules\Payment\src\Entities\Payment;
use Modules\Payment\src\Enums\PaymentStatus;
use Modules\Payment\src\Interfaces\PaymentRepositoryInterface;
use Modules\Payment\src\Services\PaymentContext;

class VerifyPayment implements ShouldQueue
{
    use Queueable;

    public function __construct(public Payment $payment)
    {
    }

    public function handle(
        PaymentRepositoryInterface $paymentRepository,
        PaymentContext $paymentContext,
    ): void
    {
        $payment = $this->payment;
        $attempt = $paymentContext->retrieve($payment->reference_id);

        if ($attempt->status !== PaymentStatus::Pending) {

            // Keep the original lock time if the worker claimed it, or set one now if verified directly
            $payment->locked_at = $payment->locked_at ?? now();

            $paymentRepository->update($payment, $attempt->toArray());
            return;
        }

        // It's still pending, so it will be verified later

        $payment->locked_at = null;
        $paymentRepository->update($payment);
    }
}
