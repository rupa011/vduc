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
        Schema::create('vessel_schedules', function (Blueprint $table) {
            $table->id();
            $table->foreignId('service_id')->constrained('vessel_services')->cascadeOnDelete();
            $table->foreignId('vessel_id')->constrained('vessels')->cascadeOnDelete();
            $table->date('schedule_date');
            $table->enum('status', ['Pending', 'Approved', 'Declined', 'Completed'])->default('Pending');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vessel_schedules');
    }
};
