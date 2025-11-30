<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('enrollments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('course_id')->constrained()->onDelete('cascade');
            $table->decimal('price_paid', 10, 2);
            $table->enum('status', ['active', 'completed', 'cancelled', 'refunded'])->default('active');
            $table->integer('progress')->default(0);
            $table->integer('completed_lessons')->default(0);
            $table->integer('total_lessons')->default(0);
            $table->dateTime('completed_at')->nullable();
            $table->dateTime('last_accessed_at')->nullable();
            $table->text('cancellation_reason')->nullable();
            $table->timestamps();
            $table->softDeletes();
            
            $table->unique(['user_id', 'course_id']);
            $table->index(['user_id', 'status']);
            $table->index(['course_id', 'status']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('enrollments');
    }
};