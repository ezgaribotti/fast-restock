<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->enum('status', ['in_progress', 'paid', 'canceled'])->default('in_progress');
            $table->string('tracking_code');
            $table->string('session_id')->unique();
            $table->text('url');
            $table->text('hosted_invoice_url')->nullable();
            $table->decimal('total_amount');
            $table->timestamp('expires_at');
            $table->timestamp('paid_at')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
