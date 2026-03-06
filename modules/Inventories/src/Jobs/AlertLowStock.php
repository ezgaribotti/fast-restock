<?php

namespace Modules\Inventories\src\Jobs;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Modules\Inventories\src\Entities\Inventory;

class AlertLowStock implements ShouldQueue
{
    use Queueable;

    public function __construct(public Inventory $inventory)
    {
    }

    public function handle(): void
    {
        $product = $this->inventory->product;

        logger()->alert(sprintf('There is a product (%s) with low stock.', $product->sku));
    }
}
