<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Modules\Inventory\src\Entities\Category;
use Modules\Inventory\src\Entities\Supplier;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('sku')->unique();
            $table->boolean('is_active')->default(true);
            $table->decimal('unit_price');
            $table->foreignIdFor(Category::class)->constrained();
            $table->foreignIdFor(Supplier::class)->constrained();
            $table->integer('weight')->comment('In grams.');
            $table->integer('height')->comment('Dimensions are stored in millimeters.');
            $table->integer('width');
            $table->integer('length');
            $table->text('description')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
