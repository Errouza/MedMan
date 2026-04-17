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
        Schema::create('visit_treatments', function (Blueprint $table) {
            $table->id('visit_treatment_id');
            $table->foreignId('visit_id')->constrained('visits', 'visit_id')->cascadeOnDelete();
            $table->string('treatment_name');
            $table->text('treatment_notes')->nullable();
            $table->decimal('price', 15, 2)->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('visit_treatments');
    }
};
