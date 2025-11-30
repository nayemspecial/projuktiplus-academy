<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuizAttempt extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'quiz_id',
        'enrollment_id',
        'attempt_number',
        'score',
        'total_questions',
        'correct_answers',
        'time_taken',
        'passed',
        'answers',
        'started_at',
        'completed_at',
    ];

    protected $casts = [
        'passed' => 'boolean',
        'answers' => 'array',
        'started_at' => 'datetime',
        'completed_at' => 'datetime',
    ];

    // Relationships
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function quiz()
    {
        return $this->belongsTo(Quiz::class);
    }

    public function enrollment()
    {
        return $this->belongsTo(Enrollment::class);
    }

    // Scopes
    public function scopePassed($query)
    {
        return $query->where('passed', true);
    }

    public function scopeFailed($query)
    {
        return $query->where('passed', false);
    }

    public function scopeByUser($query, $userId)
    {
        return $query->where('user_id', $userId);
    }

    public function scopeByQuiz($query, $quizId)
    {
        return $query->where('quiz_id', $quizId);
    }

    public function scopeRecent($query)
    {
        return $query->orderBy('completed_at', 'desc');
    }

    // Methods
    public function calculateScore()
    {
        $totalPoints = $this->quiz->total_points;
        $earnedPoints = 0;

        foreach ($this->answers as $answer) {
            $question = Question::find($answer['question_id']);
            if ($question) {
                if ($this->isAnswerCorrect($question, $answer['answer'])) {
                    $earnedPoints += $question->points;
                }
            }
        }

        $this->score = $totalPoints > 0 ? round(($earnedPoints / $totalPoints) * 100) : 0;
        $this->correct_answers = $earnedPoints;
        $this->passed = $this->score >= $this->quiz->passing_score;
    }

    private function isAnswerCorrect($question, $userAnswer)
    {
        $correctAnswers = $question->correctAnswers->pluck('id')->toArray();

        if ($question->type === 'multiple_choice') {
            sort($userAnswer);
            sort($correctAnswers);
            return $userAnswer == $correctAnswers;
        }

        return in_array($userAnswer, $correctAnswers);
    }

    public function getTimeTakenFormattedAttribute()
    {
        $minutes = floor($this->time_taken / 60);
        $seconds = $this->time_taken % 60;
        return sprintf('%02d:%02d', $minutes, $seconds);
    }
}