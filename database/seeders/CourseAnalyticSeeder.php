<?php

namespace Database\Seeders;

use App\Models\CourseAnalytic;
use App\Models\Course;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class CourseAnalyticSeeder extends Seeder
{
    public function run(): void
    {
        $courses = Course::all();
        $startDate = Carbon::now()->subMonths(6);
        $endDate = Carbon::now();

        foreach ($courses as $course) {
            // Create analytics for the last 6 months
            $currentDate = $startDate->copy();
            
            while ($currentDate <= $endDate) {
                CourseAnalytic::factory()->create([
                    'course_id' => $course->id,
                    'analytics_date' => $currentDate->format('Y-m-d'),
                ]);
                
                $currentDate->addDay(); // Add daily analytics
            }
        }

        $this->command->info('✅ Course analytics created for last 6 months');
        $this->command->info('📈 Total Analytics Records: ' . CourseAnalytic::count());
    }
}