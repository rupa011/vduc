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
        Schema::table('vessel_inspection_details', function (Blueprint $table) {
            $table->string('marine_growth')->nullable();
            $table->string('corrosion')->nullable();
            $table->string('paint_coating')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('vessel_inspection_details', function (Blueprint $table) {
            $table->dropColumn(['marine_growth', 'corrosion', 'paint_coating']);
        });
    }
};
