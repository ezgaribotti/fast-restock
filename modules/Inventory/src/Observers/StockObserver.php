<?php

namespace Modules\Inventory\src\Observers;

use Modules\Inventory\src\Entities\Stock;
use Modules\Inventory\src\Jobs\AlertLowStock;

class StockObserver
{
    public function updated(Stock $stock): void
    {
        $stockRule = $stock->product->stockRule;
        if (! $stockRule) {

            // No stock rule set, no action needed
            return;
        }

        if ($stock->quantity <= $stockRule->alert_threshold) {
            AlertLowStock::dispatch($stock);
        }
    }
}
