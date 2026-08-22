<?php

namespace Modules\Inventory\src\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Resources\MessageResource;
use Illuminate\Http\Request;
use Modules\Inventory\src\Enums\PurchaseOrderStatus;
use Modules\Inventory\src\Http\Requests\UpdatePurchaseOrderRequest;
use Modules\Inventory\src\Http\Resources\PurchaseOrderResource;
use Modules\Inventory\src\Interfaces\PurchaseOrderRepositoryInterface;

class PurchaseOrderController extends Controller
{
    public function __construct(
        protected PurchaseOrderRepositoryInterface $purchaseOrderRepository,
    )
    {
    }

    public function index(Request $request)
    {
        return PurchaseOrderResource::collection(
            $this->purchaseOrderRepository->paginate($request->all()));
    }

    public function show(string $id)
    {
        return new PurchaseOrderResource(
            $this->purchaseOrderRepository->findOrFail($id));
    }

    public function update(UpdatePurchaseOrderRequest $request, string $id)
    {
        $order = $this->purchaseOrderRepository->findOrFail($id);
        if ($order->ordered_at || $order->received_at) {

            // It can only be triggered once to avoid duplicate orders

            abort(400, 'Purchase order cannot be updated.');
        }

        // The same product can have multiple stock locations

        if ($request->status === PurchaseOrderStatus::Ordered) {
            if (! $request->quantity || ! $request->unit_cost) {

                // Only required when transitioning from pending to ordered

                abort(422, 'Quantity and unit cost are required.');
            }

            $order->ordered_at = now();

        } elseif ($request->status === PurchaseOrderStatus::Received) {
            $order->received_at = now();
        }

        $this->purchaseOrderRepository->update($order, $request->validated());

        return new MessageResource('Purchase order successfully updated.');
    }
}
