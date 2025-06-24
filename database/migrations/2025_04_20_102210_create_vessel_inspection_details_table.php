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
        Schema::create('vessel_inspection_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('vessel_inspection_id')->constrained('vessel_inspections')->cascadeOnDelete();
            $table->string('title', 50);
            $table->text('description');
            $table->string('remarks')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vessel_inspection_details');
    }
};
