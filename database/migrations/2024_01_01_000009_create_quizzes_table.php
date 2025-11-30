<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('quizzes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('lesson_id')->constrained()->onDelete('cascade');
            $table->string('title');
            $table->text('description')->nullable();
            $table->integer('time_limit')->nullable()->comment('In minutes');
            $table->integer('passing_score')->default(70);
            $table->integer('max_attempts')->default(1);
            $table->boolean('is_published')->default(false);
            $table->boolean('shuffle_questions')->default(false);
            $table->boolean('shuffle_answers')->default(false);
            $table->boolean('show_correct_answers')->default(false);
            $table->timestamp('published_at')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('quizzes');
    }
};