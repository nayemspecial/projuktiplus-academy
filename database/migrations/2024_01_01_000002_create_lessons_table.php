<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('lessons', function (Blueprint $table) {
            $table->id();
            $table->foreignId('section_id')->constrained()->onDelete('cascade');
            $table->string('title');
            $table->string('slug')->unique();
            $table->text('content')->nullable();
            $table->string('video_url')->nullable();
            $table->string('video_duration')->nullable();
            $table->string('video_type')->nullable()->comment('youtube, vimeo, uploaded');
            $table->json('attachments')->nullable();
            $table->integer('order')->default(0);
            $table->boolean('is_free')->default(false);
            $table->boolean('is_published')->default(false);
            $table->boolean('preview')->default(false);
            $table->timestamp('published_at')->nullable();
            $table->timestamps();
            $table->softDeletes();
            
            $table->index(['section_id', 'order']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('lessons');
    }
};