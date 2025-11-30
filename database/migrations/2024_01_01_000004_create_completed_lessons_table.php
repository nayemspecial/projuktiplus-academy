<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('completed_lessons', function (Blueprint $table) {
            $table->id();
            $table->foreignId('enrollment_id')->constrained()->onDelete('cascade');
            $table->foreignId('lesson_id')->constrained()->onDelete('cascade');
            $table->integer('time_spent')->default(0)->comment('Time in seconds');
            $table->integer('watch_count')->default(1);
            $table->timestamp('completed_at');
            $table->timestamps();
            
            $table->unique(['enrollment_id', 'lesson_id']);
            $table->index(['enrollment_id', 'completed_at']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('completed_lessons');
    }
};