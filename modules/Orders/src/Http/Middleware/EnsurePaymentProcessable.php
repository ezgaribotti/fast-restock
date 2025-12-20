<?php

namespace Modules\Orders\src\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Modules\Common\src\Entities\Payment;
use Modules\Common\src\Enums\PaymentStatus;
use Symfony\Component\HttpFoundation\Response;

class EnsurePaymentProcessable
{
    public function __construct()
    {
    }

    public function handle(Request $request, Closure $next): Response
    {
        if (! $request->hasValidSignature()) {
            return response('Invalid signature.');

        }
        $payment = Payment::whereTrackingCode($request->tracking_code)->first();
        if (!$payment) {
            return response('Payment is not processable.');
        }

        if ($payment->status !== PaymentStatus::InProgress) {
            return response('Payment has already been processed.');
        }
        return $next($request);
    }
}
