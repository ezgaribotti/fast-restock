<?php

namespace Modules\Inventories\src\Observers;

use Modules\Inventories\src\Entities\Product;
use Modules\Inventories\src\Jobs\AlertLowStock;

class StockObserver
{
    public function __construct()
    {
    }

    public function updated(Product $product): void
    {
        if (! $product->alert_threshold) {

            // I don't have a threshold to compare

            return;
        }

        if ($product->stock <= $product->alert_threshold) {
            AlertLowStock::dispatch($product);
        }
    }
}
