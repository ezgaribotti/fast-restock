<?php

namespace Modules\Orders\src\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Common\src\Enums\PaymentStatus;
use Modules\Common\src\Interfaces\MailerooServiceInterface;
use Modules\Common\src\Interfaces\StripeServiceInterface;
use Modules\Common\src\Services\StripeService;
use Modules\Orders\src\Events\ShippingPaid;
use Modules\Orders\src\Interfaces\OrderRepositoryInterface;
use Modules\Orders\src\Interfaces\PaymentRepositoryInterface;
use Modules\Orders\src\Interfaces\ProductRepositoryInterface;
use Modules\Orders\src\Mail\OrderPaid;

class ProcessPaymentController extends Controller
{
    public function __construct(
        protected OrderRepositoryInterface $orderRepository,
        protected PaymentRepositoryInterface $paymentRepository,
        protected ProductRepositoryInterface $productRepository,
        protected StripeServiceInterface $stripeService,
        protected MailerooServiceInterface $mailerooService,
    )
    {
    }

    public function success(Request $request): object
    {
        $order = $this->orderRepository->find($request->reference_id);
        $payment = $order->payment;
        $session = $this->stripeService->retrieveSession($payment->session_id);

        if ($session->status != StripeService::COMPLETE || $session->payment_status != StripeService::PAYMENT_PAID) {

            return response('Unpaid or incomplete payment to process.');
        }
        $this->paymentRepository->update($payment->id, [
            'status' => PaymentStatus::Paid, 'paid_at' => now()]);

        if ($session->shipping_options) {
            ShippingPaid::dispatch($order);
        }
        $customer = $order->customerAddress->customer;

        $this->mailerooService->send($customer->email, $customer->first_name,
            new OrderPaid($order, count($session->shipping_options) === 1));

        return response('Payment successfully processed.');
    }

    public function cancel(Request $request): object
    {
        $order = $this->orderRepository->find($request->reference_id);
        $payment = $order->payment;

        // Restore reserved stock

        $order->products->each(function ($product) {
            $this->productRepository->update($product->id, [
                'stock' => $product->stock + $product->pivot->quantity
            ]);
        });

        $this->stripeService->expireSession($payment->session_id);
        $this->paymentRepository->update($payment->id, ['status' => PaymentStatus::Canceled]);

        return response('Payment successfully canceled.');
    }
}
