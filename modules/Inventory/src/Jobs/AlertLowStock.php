<?php

namespace Modules\Inventory\src\Jobs;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Modules\Inventory\src\Entities\Stock;
use Modules\Inventory\src\Interfaces\PurchaseOrderRepositoryInterface;

class AlertLowStock implements ShouldQueue
{
    use Queueable;

    public function __construct(public Stock $stock)
    {
    }

    public function handle(PurchaseOrderRepositoryInterface $purchaseOrderRepository): void
    {
        $stock = $this->stock;

        // From this point onward, manual action is required

        $purchaseOrderRepository->create([
            'stock_id' => $stock->id,
            'supplier_id' => $stock->product->supplier_id,
        ]);
    }
}
