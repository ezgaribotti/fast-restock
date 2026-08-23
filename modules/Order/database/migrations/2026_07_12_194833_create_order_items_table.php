<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Modules\Common\src\Entities\Stock;
use Modules\Order\src\Entities\Order;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('order_items', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Order::class)->constrained();
            $table->foreignIdFor(Stock::class)->constrained();
            $table->integer('quantity');
            $table->decimal('unit_sale_price')->comment('The sale price per unit locked.');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('order_items');
    }
};
