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
        Schema::create('diving_applications', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->cascadeOnUpdate()->restrictOnDelete();
            $table->foreignId('lesson_id')->constrained('diving_lessons')->restrictOnDelete();
            $table->enum('status', ['Pending', 'Approved', 'Ongoing', 'Completed', 'Rejected'])->default('Pending');
            $table->date('schedule_date')->nullable();
            $table->time('schedule_time')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('diving_applications');
    }
};
