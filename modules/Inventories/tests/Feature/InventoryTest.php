<?php

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Modules\Inventories\src\Entities\Inventory;
use Modules\Inventories\src\Jobs\AlertLowStock;
use Illuminate\Support\Facades\Queue;
use Tests\TestCase;

uses(TestCase::class, DatabaseTransactions::class);

test('should dispatch low stock job when stock is below threshold', function () {
    Queue::fake();
    $inventory = Inventory::factory()->create(['alert_threshold' => 1]);
    $inventory->decrement('stock', $inventory->stock);

    Queue::assertPushed(AlertLowStock::class);
});
