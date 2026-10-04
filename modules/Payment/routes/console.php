<?php

use Illuminate\Support\Facades\Schedule;
use Modules\Payment\src\Interfaces\PaymentRepositoryInterface;
use Modules\Payment\src\Jobs\VerifyPayment;

Schedule::call(function (PaymentRepositoryInterface $paymentRepository) {

    $payments = $paymentRepository->claimPaymentsToVerify();
    foreach ($payments as $payment) {
        VerifyPayment::dispatch($payment);
    }
})->everyMinute();
