<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('withdrawals', function (Blueprint $table) {
            $table->id();
            $table->foreignId('instructor_id')->constrained('users')->onDelete('cascade');
            $table->decimal('amount', 10, 2);
            $table->string('payment_method')->default('bank');
            $table->string('account_name');
            $table->string('account_number');
            $table->string('bank_name')->nullable();
            $table->string('branch_name')->nullable();
            $table->string('mobile_wallet')->nullable();
            $table->enum('status', ['pending', 'approved', 'rejected', 'processed'])->default('pending');
            $table->text('notes')->nullable();
            $table->timestamp('processed_at')->nullable();
            $table->timestamps();
            
            $table->index(['instructor_id', 'status']);
            $table->index(['status', 'created_at']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('withdrawals');
    }
};