<?php

namespace Database\Factories;

use App\Models\Lesson;
use Illuminate\Database\Eloquent\Factories\Factory;

class QuizFactory extends Factory
{
    public function definition(): array
    {
        return [
            'lesson_id' => Lesson::factory(),
            'title' => $this->faker->sentence(),
            'description' => $this->faker->paragraph(),
            'time_limit' => 30,
            'passing_score' => 70,
            'max_attempts' => 3,
            'is_published' => true,
            'shuffle_questions' => false,
            'shuffle_answers' => false,
            'show_correct_answers' => true,
            'published_at' => now(),
        ];
    }
}