<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('reviews', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('course_id')->constrained()->onDelete('cascade');
            $table->integer('rating')->unsigned()->between(1, 5);
            $table->text('comment')->nullable();
            $table->boolean('is_approved')->default(false);
            $table->boolean('featured')->default(false);
            $table->json('helpful')->nullable()->comment('Users who found this helpful');
            $table->json('not_helpful')->nullable()->comment('Users who found this not helpful');
            $table->timestamps();
            $table->softDeletes();
            
            $table->unique(['user_id', 'course_id']);
            $table->index(['course_id', 'rating']);
            $table->index(['course_id', 'is_approved']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('reviews');
    }
};