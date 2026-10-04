<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Modules\Inventory\src\Entities\Stock;
use Modules\Inventory\src\Entities\Supplier;
use Modules\Inventory\src\Enums\PurchaseOrderStatus;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('purchase_orders', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Stock::class)->constrained();
            $table->foreignIdFor(Supplier::class)->constrained();
            $table->string('status')->default(PurchaseOrderStatus::Pending->value);
            $table->integer('quantity')->nullable();
            $table->decimal('unit_cost')->nullable();
            $table->timestamp('ordered_at')->nullable();
            $table->timestamp('received_at')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('purchase_orders');
    }
};
