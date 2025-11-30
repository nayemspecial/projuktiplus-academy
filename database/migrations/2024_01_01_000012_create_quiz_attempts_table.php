<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('quiz_attempts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('quiz_id')->constrained()->onDelete('cascade');
            $table->foreignId('enrollment_id')->constrained()->onDelete('cascade');
            $table->integer('attempt_number')->default(1);
            $table->integer('score')->default(0);
            $table->integer('total_questions')->default(0);
            $table->integer('correct_answers')->default(0);
            $table->integer('time_taken')->default(0)->comment('Time in seconds');
            $table->boolean('passed')->default(false);
            $table->json('answers')->nullable()->comment('User answers in JSON format');
            $table->timestamp('started_at')->nullable();
            $table->timestamp('completed_at')->nullable();
            $table->timestamps();
            
            $table->index(['user_id', 'quiz_id']);
            $table->index(['enrollment_id', 'quiz_id']);
            $table->unique(['user_id', 'quiz_id', 'attempt_number']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('quiz_attempts');
    }
};