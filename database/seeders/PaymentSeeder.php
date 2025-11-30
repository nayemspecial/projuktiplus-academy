<?php

namespace Database\Seeders;

use App\Models\Payment;
use App\Models\Enrollment;
use Illuminate\Database\Seeder;

class PaymentSeeder extends Seeder
{
    public function run(): void
    {
        $enrollments = Enrollment::with(['user', 'course'])->get();

        foreach ($enrollments as $enrollment) {
            // Only create payment for paid courses
            if ($enrollment->price_paid > 0) {
                Payment::factory()->create([
                    'user_id' => $enrollment->user_id,
                    'course_id' => $enrollment->course_id,
                    'amount' => $enrollment->price_paid,
                    'instructor_earnings' => $enrollment->price_paid * 0.82,
                    'platform_fee' => $enrollment->price_paid * 0.15,
                    'gateway_fee' => $enrollment->price_paid * 0.03,
                ]);
            }
        }

        $this->command->info('✅ Payments created for all paid enrollments');
    }
}