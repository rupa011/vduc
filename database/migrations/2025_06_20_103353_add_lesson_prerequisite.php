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
        Schema::table('diving_lessons', function (Blueprint $table) {
            if (!Schema::hasColumn('diving_lessons', 'prerequisite')) {
                $table->foreignId('prerequisite')
                    ->nullable()
                    ->constrained('diving_lessons')
                    ->onDelete('set null')
                    ->comment('Foreign key to the prerequisite diving lesson');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('diving_lessons', function (Blueprint $table) {
            if (Schema::hasColumn('diving_lessons', 'prerequisite')) {
                $table->dropForeign(['prerequisite']);
                $table->dropColumn('prerequisite');
            }
        });
    }
};
