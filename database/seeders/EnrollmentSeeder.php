<?php

namespace Database\Seeders;

use App\Models\Enrollment;
use App\Models\User;
use Illuminate\Database\Seeder;

class EnrollmentSeeder extends Seeder
{
    public function run(): void
    {
        $students = User::where('role', 'student')->get();

        foreach ($students as $student) {
            // Each student enrolls in 2-4 courses
            Enrollment::factory()->count(rand(2, 4))->create([
                'user_id' => $student->id
            ]);
        }

        $this->command->info('✅ Enrollments created for all students');
    }
}