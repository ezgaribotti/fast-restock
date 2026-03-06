<?php

namespace Modules\Inventories\src\Observers;

use Modules\Inventories\src\Entities\Inventory;
use Modules\Inventories\src\Jobs\AlertLowStock;

class StockObserver
{
    public function __construct()
    {
    }

    public function updated(Inventory $inventory): void
    {
        if (! $inventory->alert_threshold) {

            // I don't have a threshold to compare

            return;
        }

        if ($inventory->stock <= $inventory->alert_threshold) {
            AlertLowStock::dispatch($inventory);
        }
    }
}
