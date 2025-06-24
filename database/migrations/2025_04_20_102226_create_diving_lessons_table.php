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
        Schema::create('diving_lessons', function (Blueprint $table) {
            $table->id();
            $table->string('lesson_name', 50);
            $table->string('description')->nullable();
            $table->integer('duration_minutes');
            $table->decimal('price', 10, 2);
            $table->foreignId('prerequisite')
                ->nullable()
                ->constrained('diving_lessons')
                ->onDelete('set null')
                ->comment('Foreign key to the prerequisite diving lesson');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('diving_lessons');
    }
};
