<?php

namespace Database\Seeders;

use App\Models\Quiz;
use App\Models\Lesson;
use App\Models\Question;
use App\Models\Answer;
use Illuminate\Database\Seeder;

class QuizSeeder extends Seeder
{
    public function run(): void
    {
        $lessons = Lesson::all();

        foreach ($lessons as $lesson) {
            // 30% chance to have a quiz
            if (rand(1, 100) <= 30) {
                $quiz = Quiz::factory()->create(['lesson_id' => $lesson->id]);

                // Create 5-10 questions for each quiz
                $questions = Question::factory()->count(rand(5, 10))->create([
                    'quiz_id' => $quiz->id
                ]);

                foreach ($questions as $question) {
                    // Create 4 answers for each question
                    $answers = Answer::factory()->count(4)->create([
                        'question_id' => $question->id
                    ]);

                    // Make one answer correct
                    $answers->random()->update(['is_correct' => true]);
                }
            }
        }

        $this->command->info('✅ Quizzes with questions and answers created');
    }
}