<?php

namespace Modules\Orders\src\Http\Controllers;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Fluent;
use Illuminate\Support\Str;
use Modules\Common\src\Http\Resources\UrlToPayResource;
use Modules\Common\src\Interfaces\StripeServiceInterface;
use Modules\Orders\src\Http\Requests\StoreOrderRequest;
use Modules\Orders\src\Http\Requests\UpdateOrderRequest;
use Modules\Orders\src\Http\Resources\OrderResource;
use Modules\Orders\src\Http\Resources\OrderSummaryResource;
use Modules\Orders\src\Interfaces\OrderRepositoryInterface;
use Modules\Orders\src\Interfaces\PaymentRepositoryInterface;
use Modules\Orders\src\Interfaces\ProductRepositoryInterface;

class OrderController extends Controller
{
    public function __construct(
        protected OrderRepositoryInterface $orderRepository,
        protected ProductRepositoryInterface $productRepository,
        protected PaymentRepositoryInterface $paymentRepository,
        protected StripeServiceInterface $stripeService,
    )
    {
    }

    public function index(Request $request): object
    {
        $orders = $this->orderRepository->paginate($request->filters);
        return response()->withPaginate(OrderSummaryResource::collection($orders));
    }

    public function store(StoreOrderRequest $request): object
    {
        $countryId = null; // Valid if they are from the same country

        $totalAmount = 0;
        $weight = 0;
        $items = [];
        collect($request->items)->each(function ($item) use (&$countryId, &$totalAmount, &$weight, &$items) {
            $item = new Fluent($item);
            $product = $this->productRepository->find($item->product_id);

            if ($countryId && $countryId !== $product->supplier->country_id) {
                abort(422, 'Only items from the same country can be ordered.');
            }
            $countryId = $product->supplier->country_id;
            $totalAmount += $product->unit_price * $item->quantity;
            $weight += $product->weight * $item->quantity;

            $items[] = new Fluent(['product' => $product, 'quantity' => $item->quantity]);
        });
        $trackingCode = Str::ulid();

        $order = $this->orderRepository->create([
            'tracking_code' => $trackingCode,
            'country_id' => $countryId,
            'customer_address_id' => $request->customer_address_id,
            'weight' => $weight,
            'total_amount' => $totalAmount,
        ]);

        collect($items)->each(function ($item) use ($order) {
            $product = $item->product;

            $order->products()->attach($product->id, [
                'fixed_price' => $product->unit_price,
                'quantity' => $item->quantity
            ]);

            $stock = $product->stock - $item->quantity;
            $this->productRepository->update($product->id, ['stock' => $stock]);
        });

        $routeNames = config('orders.after_paying.route_names');

        $customer = $order->customerAddress->customer;
        $session = $this->stripeService->createSession($order->id, $trackingCode, $customer->email, $items, $routeNames);

        $payment = $this->paymentRepository->create([
            'session_id' => $session->id,
            'tracking_code' => $trackingCode,
            'url' => $session->url,
            'total_amount' => $totalAmount,
            'expires_at' => Carbon::createFromTimestamp($session->expires_at),
        ]);

        $this->orderRepository->update($order->id, [
            'total_amount' => $totalAmount,
            'payment_id' => $payment->id,
        ]);

        $order = $this->orderRepository->find($order->id);
        return response()->success($request->pay_shipping ? new OrderResource($order) : new UrlToPayResource($session->url));
    }

    public function show(string $id): object
    {
        $order = $this->orderRepository->find($id);
        if (!$order) {
            abort(404, 'Order not found.');
        }

        return response()->success(new OrderResource($order));
    }

    public function update(UpdateOrderRequest $request, string $id): object
    {
        $this->orderRepository->update($id, $request->validated());
        return response()->justMessage('Order successfully updated.');
    }
}
