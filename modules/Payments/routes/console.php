<?php

use Illuminate\Support\Facades\Schedule;
use Modules\Common\src\Enums\PaymentStatus;
use Modules\Common\src\Interfaces\StripeServiceInterface;
use Modules\Common\src\Services\StripeService;
use Modules\Payments\src\Entities\Payment;

Schedule::call(function () {
    $stripeService = app(StripeServiceInterface::class);

    // Cancel expired payments

    $payments = Payment::whereStatus(PaymentStatus::InProgress)
        ->whereBetween('created_at', [now()->subYear(), now()->subWeek()])
        ->get();

    foreach ($payments as $payment) {
        $session = $stripeService->retrieveSession($payment->session_id);

        if ($session->status === StripeService::EXPIRED) {
            Payment::find($payment->id)
                ->update(['status' => PaymentStatus::Canceled]);
        }
    }
})->daily();
