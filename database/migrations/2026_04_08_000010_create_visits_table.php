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
        Schema::create('visits', function (Blueprint $table) {
            $table->id('visit_id');
            $table->foreignId('patient_id')->constrained('patients', 'patient_id')->cascadeOnDelete();
            // Note: assuming doctor_id from doctors table, not users table, because of the doctors table created. If not, it references users. But the prompt has 'doctors' table with doctor_id (PK), so doctor_id references doctors.
            $table->foreignId('doctor_id')->constrained('doctors', 'doctor_id')->cascadeOnDelete();
            $table->datetime('visit_date');
            $table->enum('status', ['waiting', 'in_progress', 'done', 'paid'])->default('waiting');
            $table->foreignId('created_by')->nullable()->constrained('users', 'user_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('visits');
    }
};
