<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB; // এই লাইনটি অবশ্যই থাকতে হবে

return new class extends Migration
{
    public function up(): void
    {
        DB::statement("ALTER TABLE enrollments MODIFY COLUMN status ENUM('pending', 'active', 'completed', 'cancelled', 'refunded') NOT NULL DEFAULT 'active'");
    }
    public function down(): void
    {
        DB::statement("ALTER TABLE enrollments MODIFY COLUMN status ENUM('active', 'completed', 'cancelled', 'refunded') NOT NULL DEFAULT 'active'");
    }
};