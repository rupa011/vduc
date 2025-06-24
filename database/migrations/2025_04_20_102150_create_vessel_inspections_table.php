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
        Schema::create('vessel_inspections', function (Blueprint $table) {
            $table->id();
            $table->foreignId('vessel_id')->constrained('vessels')->cascadeOnDelete();
            $table->foreignId('schedule_id')->constrained('vessel_schedules')->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vessel_inspections');
    }
};
