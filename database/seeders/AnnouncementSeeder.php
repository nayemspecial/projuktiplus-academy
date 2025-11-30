<?php

namespace Database\Seeders;

use App\Models\Announcement;
use App\Models\Course;
use Illuminate\Database\Seeder;

class AnnouncementSeeder extends Seeder
{
    public function run(): void
    {
        $courses = Course::all();

        foreach ($courses as $course) {
            // Each course gets 2-5 announcements
            $announcementCount = rand(2, 5);
            
            Announcement::factory()->count($announcementCount)->create([
                'course_id' => $course->id,
                'instructor_id' => $course->instructor_id,
            ]);
        }

        $this->command->info('✅ Announcements created for all courses');
        $this->command->info('📢 Total Announcements: ' . Announcement::count());
    }
}