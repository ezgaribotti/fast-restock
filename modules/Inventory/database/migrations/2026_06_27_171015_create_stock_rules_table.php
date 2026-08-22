<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Modules\Inventory\src\Entities\Product;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('stock_rules', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Product::class)->constrained();
            $table->integer('alert_threshold');
            $table->integer('capacity_limit');
            $table->integer('optimum_quantity');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('stock_rules');
    }
};
