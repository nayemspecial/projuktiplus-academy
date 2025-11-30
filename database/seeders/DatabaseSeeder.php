<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            CourseSeeder::class,
            EnrollmentSeeder::class,
            ReviewSeeder::class,
            PaymentSeeder::class,
            AnnouncementSeeder::class,
            MessageSeeder::class,
            WithdrawalSeeder::class,
            CourseAnalyticSeeder::class,
        ]);
    }
}