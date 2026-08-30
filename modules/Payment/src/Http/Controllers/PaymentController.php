<?php

namespace Modules\Payment\src\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Resources\MessageResource;
use Illuminate\Http\Request;
use Modules\Payment\src\Enums\PaymentStatus;
use Modules\Payment\src\Http\Requests\StorePaymentRequest;
use Modules\Payment\src\Http\Resources\PaymentResource;
use Modules\Payment\src\Interfaces\OrderRepositoryInterface;
use Modules\Payment\src\Interfaces\PaymentRepositoryInterface;
use Modules\Payment\src\Services\PaymentContext;

class PaymentController extends Controller
{
    public function __construct(
        protected PaymentRepositoryInterface $paymentRepository,
        protected OrderRepositoryInterface $orderRepository,
        protected PaymentContext $paymentContext,
    )
    {
    }

    public function index(Request $request)
    {
        return PaymentResource::collection(
            $this->paymentRepository->paginate($request->all()));
    }

    public function store(StorePaymentRequest $request)
    {
        $order = $this->orderRepository->findOrFail($request->order_id);

        $lineItems = [];
        foreach ($order->items as $orderItem) {
            $lineItems[] = [
                $orderItem->quantity, $orderItem->unit_sale_price, $orderItem->stock->product->name];
        }

        $payment = $this->paymentRepository->create([
            ...$this->paymentContext->pay($lineItems, $request->return_url)->toArray(),
            ...$request->validated(),
        ]);

        return new PaymentResource($payment);
    }

    public function show(string $id)
    {
        $payment = $this->paymentRepository->findOrFail($id);
        if ($payment->status === PaymentStatus::Pending) {

            // Verifies the payment status

            $this->paymentRepository->update($payment,
                $this->paymentContext->retrieve($payment->reference_id)->toArray());
        }
        return new PaymentResource($payment);
    }

    public function destroy(string $id)
    {
        $payment = $this->paymentRepository->findOrFail($id);
        if ($payment->status === PaymentStatus::Pending) {
            $this->paymentContext->expire($payment->reference_id);

            // Nothing else needs to be done
        }

        return new MessageResource('Payment successfully expired.');
    }
}
