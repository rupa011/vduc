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
        Schema::create('divers_logs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('application_id')->constrained('diving_applications')->restrictOnDelete();
            $table->integer('dive_no');
            $table->string('location', 100);
            $table->decimal('depth', 10, 2);
            $table->integer('bottom_time');
            $table->integer('mins_stop')->nullable();
            $table->dateTime('time_in');
            $table->dateTime('time_out');
            $table->integer('tank_start');
            $table->integer('tank_end');
            $table->integer('visibility')->nullable();
            $table->integer('current')->nullable();
            $table->decimal('weight', 10, 2)->nullable();
            $table->decimal('temperature', 10, 2);
            $table->date('date');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('diver_logs');
    }
};
