<?php

namespace Modules\Payment\src\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
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

        $expiresAt = now()->addMinutes(30); // To prevent payments from remaining open

        [$externalId, $totalAmount, $url] = $this->paymentContext->pay($lineItems, $expiresAt, $request->return_url);

        $payment = $this->paymentRepository->create([
            ...$request->validated(),
            'external_id' => $externalId,
            'url' => $url,
            'total_amount' => $totalAmount,
            'expires_at' => $expiresAt,
        ]);

        return new PaymentResource($payment);
    }

    public function show(string $id)
    {
        return new PaymentResource($this->paymentRepository->findOrFail($id));
    }
}
