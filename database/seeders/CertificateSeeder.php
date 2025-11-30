<?php

namespace Database\Seeders;

use App\Models\Certificate;
use App\Models\Enrollment;
use Illuminate\Database\Seeder;

class CertificateSeeder extends Seeder
{
    public function run(): void
    {
        $completedEnrollments = Enrollment::where('status', 'completed')->get();

        foreach ($completedEnrollments as $enrollment) {
            // 80% chance to get certificate
            if (rand(1, 100) <= 80) {
                Certificate::factory()->create([
                    'user_id' => $enrollment->user_id,
                    'course_id' => $enrollment->course_id,
                    'enrollment_id' => $enrollment->id,
                    'issue_date' => $enrollment->completed_at ?? now(),
                ]);
            }
        }

        $this->command->info('✅ Certificates created for completed courses');
    }
}