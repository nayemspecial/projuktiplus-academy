<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('payment_gateways', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique(); // e.g., stripe, paypal, manual
            $table->string('title'); // e.g., Stripe Payment
            $table->boolean('is_active')->default(false);
            $table->boolean('test_mode')->default(true);
            $table->json('credentials')->nullable(); // API keys, secrets এখানে JSON হিসেবে থাকবে
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('payment_gateways');
    }
};