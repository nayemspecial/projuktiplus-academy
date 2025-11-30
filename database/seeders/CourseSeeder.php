<?php

namespace Database\Seeders;

use App\Models\Course;
use App\Models\Section;
use App\Models\Lesson;
use App\Models\User;
use Illuminate\Database\Seeder;

class CourseSeeder extends Seeder
{
    public function run(): void
    {
        $instructors = User::where('role', 'instructor')->get();

        // Create 8 courses
        Course::factory()->count(8)->create()->each(function ($course) use ($instructors) {
            $course->update(['instructor_id' => $instructors->random()->id]);
            
            // Create 3-5 sections per course
            Section::factory()->count(rand(3, 5))->create(['course_id' => $course->id])
                ->each(function ($section) {
                    // Create 4-8 lessons per section
                    Lesson::factory()->count(rand(4, 8))->create(['section_id' => $section->id]);
                });
        });

        $this->command->info('✅ 8 courses with sections and lessons created');
    }
}