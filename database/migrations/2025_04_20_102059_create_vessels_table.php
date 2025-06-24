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
        Schema::create('vessels', function (Blueprint $table) {
            $table->id();
            $table->string('vessel_name', 100)->unique();
            $table->string('vessel_owner', 100);
            $table->string('vessel_location', 30);
            $table->string('imo_on', 15)->unique();
            $table->string('home_port', 30);
            $table->string('place_of_built', 30);
            $table->string('type_of_service', 30);
            $table->string('length', 30);
            $table->string('no_screws', 15);
            $table->string('breadth', 20);
            $table->string('material', 30);
            $table->string('depth', 30);
            $table->string('gross_tonnage', 30);
            $table->string('engine', 30);
            $table->string('net_tonnage', 30);
            $table->date('year_built');
            $table->date('launch_date');
            $table->string('horse_power', 30);
            $table->foreignId('user_id')->constrained('users')->cascadeOnUpdate()->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vessels');
    }
};
