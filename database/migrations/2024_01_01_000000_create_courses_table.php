<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('courses', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->text('description');
            $table->text('short_description')->nullable();
            $table->foreignId('instructor_id')->constrained('users')->onDelete('cascade');
            $table->string('thumbnail')->nullable();
            $table->string('video_preview')->nullable();
            $table->decimal('price', 10, 2)->default(0);
            $table->decimal('discount_price', 10, 2)->nullable();
            $table->enum('level', ['beginner', 'intermediate', 'advanced'])->default('beginner');
            $table->enum('status', ['draft', 'under_review', 'published', 'rejected', 'archived'])->default('draft');
            $table->enum('category', ['web-design', 'web-development', 'mobile-development', 'data-science', 'ux-ui', 'digital-marketing', 'business', 'photography']);
            $table->string('language')->default('english');
            $table->string('duration')->nullable();
            $table->integer('total_lessons')->default(0);
            $table->integer('total_students')->default(0);
            $table->float('rating')->default(0);
            $table->integer('total_reviews')->default(0);
            $table->json('requirements')->nullable();
            $table->json('what_you_will_learn')->nullable();
            $table->json('target_audience')->nullable();
            $table->boolean('featured')->default(false);
            $table->boolean('certificate_included')->default(true);
            $table->integer('lifetime_access')->default(1);
            $table->timestamp('published_at')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('courses');
    }
};