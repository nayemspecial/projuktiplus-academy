<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('payments', function (Blueprint $table) {
            // enrollment_id কলাম যোগ করা হচ্ছে
            $table->foreignId('enrollment_id')
                  ->nullable() // আগের ডাটার জন্য নালাবল রাখা ভালো
                  ->after('course_id')
                  ->constrained()
                  ->onDelete('cascade'); 
        });
    }

    public function down(): void
    {
        Schema::table('payments', function (Blueprint $table) {
            $table->dropForeign(['enrollment_id']);
            $table->dropColumn('enrollment_id');
        });
    }
};