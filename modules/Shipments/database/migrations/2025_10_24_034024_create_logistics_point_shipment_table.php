<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('logistics_point_shipment', function (Blueprint $table) {
            $table->foreignId('shipment_id')->constrained();
            $table->foreignId('logistics_point_id')->constrained();
            $table->unsignedInteger('sequence')->default(1);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('logistics_point_shipment');
    }
};
