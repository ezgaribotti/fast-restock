<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Modules\Common\src\Entities\Order;
use Modules\Payment\src\Enums\PaymentStatus;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Order::class)->constrained();
            $table->string('reference_id')->comment('Reference used to look up this payment at the provider.');
            $table->string('status')->default(PaymentStatus::Pending->value);
            $table->decimal('total_amount');
            $table->string('url');
            $table->timestamp('paid_at')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
