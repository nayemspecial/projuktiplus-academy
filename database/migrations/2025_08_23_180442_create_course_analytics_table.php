<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('course_analytics', function (Blueprint $table) {
            $table->id();
            $table->foreignId('course_id')->constrained()->onDelete('cascade');
            $table->integer('total_enrollments')->default(0);
            $table->integer('active_enrollments')->default(0);
            $table->integer('completed_enrollments')->default(0);
            $table->decimal('completion_rate', 5, 2)->default(0);
            $table->decimal('average_rating', 3, 2)->default(0);
            $table->integer('total_reviews')->default(0);
            $table->decimal('revenue', 10, 2)->default(0);
            $table->date('analytics_date');
            $table->timestamps();
            
            $table->unique(['course_id', 'analytics_date']);
            $table->index(['analytics_date', 'course_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('course_analytics');
    }
};