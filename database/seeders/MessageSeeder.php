<?php

namespace Database\Seeders;

use App\Models\Message;
use App\Models\User;
use Illuminate\Database\Seeder;

class MessageSeeder extends Seeder
{
    public function run(): void
    {
        $students = User::where('role', 'student')->get();
        $instructors = User::where('role', 'instructor')->get();

        foreach ($students as $student) {
            // Each student sends 1-3 messages to instructors
            $messageCount = rand(1, 3);
            $targetInstructors = $instructors->random($messageCount);

            foreach ($targetInstructors as $instructor) {
                Message::factory()->create([
                    'sender_id' => $student->id,
                    'receiver_id' => $instructor->id,
                ]);
            }
        }

        $this->command->info('✅ Messages created between students and instructors');
        $this->command->info('💬 Total Messages: ' . Message::count());
    }
}