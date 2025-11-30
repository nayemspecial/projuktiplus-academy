<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // 1. Certificate Templates Table (টেমপ্লেট ফিচারের জন্য প্রয়োজনীয়)
        Schema::create('certificate_templates', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('background_image');
            $table->longText('content_layout')->nullable();
            $table->boolean('is_default')->default(false);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        // 2. Certificates Table (আপনার দেওয়া কারেকশন অনুযায়ী)
        Schema::create('certificates', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('course_id')->constrained()->onDelete('cascade');
            $table->foreignId('enrollment_id')->constrained()->onDelete('cascade');
            
            $table->string('certificate_number')->unique();
            $table->string('certificate_url');
            $table->date('issue_date');
            $table->date('expiry_date')->nullable();
            $table->integer('validity_period')->nullable()->comment('In months');
            
            // Fixed: text to string with length for indexing
            $table->string('verification_code', 100); 
            
            $table->boolean('is_revoked')->default(false);
            $table->text('revocation_reason')->nullable();
            $table->timestamp('revoked_at')->nullable();
            $table->timestamps();
            
            // Indexes
            $table->index(['user_id', 'course_id']);
            $table->index(['certificate_number']);
            $table->index(['verification_code']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('certificates');
        Schema::dropIfExists('certificate_templates');
    }
};