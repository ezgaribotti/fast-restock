<?php

namespace Modules\Order\src\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Order\src\Http\Requests\StoreOrderRequest;
use Modules\Order\src\Http\Resources\OrderResource;
use Modules\Order\src\Interfaces\OrderItemRepositoryInterface;
use Modules\Order\src\Interfaces\OrderRepositoryInterface;
use Modules\Order\src\Interfaces\StockRepositoryInterface;

class OrderController extends Controller
{
    public function __construct(
        protected OrderRepositoryInterface $orderRepository,
        protected OrderItemRepositoryInterface $orderItemRepository,
        protected StockRepositoryInterface $stockRepository,
    )
    {
    }

    public function index(Request $request)
    {
        return OrderResource::collection(
            $this->orderRepository->paginate($request->all()));
    }

    public function store(StoreOrderRequest $request)
    {
        $totalAmount = 0;
        $items = [];
        foreach ($request->items as $item) {
            ksort($item);
            [$quantity, $stockId] = array_values($item);

            // Lock the ordered unit price from the product
            $stock = $this->stockRepository->find($stockId);
            $unitSalePrice = $stock->product->unit_price;

            $items[] = [
                ...$item,
                'unit_sale_price' => $unitSalePrice,
                'order_id' => &$orderId, // Set after order creation
            ];

            // Sum the total amount
            $totalAmount += $unitSalePrice * $quantity;
        }

        $order = $this->orderRepository->create([
            ...$request->validated(),
            'tracking_code' => strtoupper(uniqid()),
            'total_amount' => $totalAmount,
        ]);

        $orderId = $order->id;
        $this->orderItemRepository->insertMany($items);

        return new OrderResource($order);
    }

    public function show(string $id)
    {
        return new OrderResource($this->orderRepository->findOrFail($id));
    }
}
