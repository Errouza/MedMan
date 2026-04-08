<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id('payment_id');
            $table->foreignId('visit_id')->unique()->constrained('visits', 'visit_id')->cascadeOnDelete();
            $table->decimal('amount', 15, 2)->default(0);
            $table->enum('payment_method', ['cash', 'qris'])->nullable();
            $table->enum('payment_status', ['paid', 'unpaid'])->default('unpaid');
            $table->datetime('paid_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
