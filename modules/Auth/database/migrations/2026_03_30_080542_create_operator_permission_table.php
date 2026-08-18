<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Modules\Auth\src\Entities\Operator;
use Modules\Auth\src\Entities\Permission;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('operator_permission', function (Blueprint $table) {
            $table->foreignIdFor(Operator::class)->constrained();
            $table->foreignIdFor(Permission::class)->constrained();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('operator_permission');
    }
};
