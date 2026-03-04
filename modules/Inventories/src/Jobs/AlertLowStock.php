<?php

namespace Modules\Inventories\src\Jobs;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Modules\Inventories\src\Entities\Product;

class AlertLowStock implements ShouldQueue
{
    use Queueable;

    public function __construct(public Product $product)
    {
    }

    public function handle(): void
    {
        logger()->alert(sprintf('There is a product (%s) with low stock.', $this->product->sku));
    }
}
