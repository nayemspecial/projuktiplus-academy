<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('course_id')->constrained()->onDelete('cascade');
            $table->string('transaction_id')->unique();
            $table->string('payment_gateway')->default('stripe');
            $table->decimal('amount', 10, 2);
            $table->decimal('gateway_fee', 10, 2)->default(0);
            $table->decimal('platform_fee', 10, 2)->default(0);
            $table->decimal('instructor_earnings', 10, 2)->default(0);
            $table->string('currency')->default('USD');
            $table->enum('status', ['pending', 'completed', 'failed', 'refunded', 'disputed'])->default('pending');
            $table->json('payment_details')->nullable();
            $table->json('refund_details')->nullable();
            $table->timestamp('completed_at')->nullable();
            $table->timestamp('refunded_at')->nullable();
            $table->timestamps();
            
            $table->index(['user_id', 'status']);
            $table->index(['course_id', 'status']);
            $table->index(['transaction_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};