<?php

namespace Database\Seeders;

use App\Models\Review;
use App\Models\Enrollment;
use Illuminate\Database\Seeder;

class ReviewSeeder extends Seeder
{
    public function run(): void
    {
        $completedEnrollments = Enrollment::where('status', 'completed')->get();

        foreach ($completedEnrollments as $enrollment) {
            // 60% chance to leave a review
            if (rand(1, 100) <= 60) {
                Review::factory()->create([
                    'user_id' => $enrollment->user_id,
                    'course_id' => $enrollment->course_id,
                ]);
            }
        }

        $this->command->info('✅ Reviews created for completed enrollments');
    }
}