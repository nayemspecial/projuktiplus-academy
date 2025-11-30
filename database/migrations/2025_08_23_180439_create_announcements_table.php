<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('announcements', function (Blueprint $table) {
            $table->id();
            $table->foreignId('course_id')->constrained()->onDelete('cascade');
            $table->foreignId('instructor_id')->constrained('users')->onDelete('cascade');
            $table->string('title');
            $table->text('content');
            $table->boolean('is_published')->default(true);
            $table->boolean('is_urgent')->default(false);
            $table->timestamp('published_at')->nullable();
            $table->timestamps();
            $table->softDeletes();
            
            $table->index(['course_id', 'is_published']);
            $table->index(['instructor_id', 'created_at']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('announcements');
    }
};