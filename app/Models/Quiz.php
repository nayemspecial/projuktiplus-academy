<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Quiz extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'lesson_id',
        'title',
        'description',
        'time_limit',
        'passing_score',
        'max_attempts',
        'is_published',
        'shuffle_questions',
        'shuffle_answers',
        'show_correct_answers',
        'published_at',
    ];

    protected $casts = [
        'is_published' => 'boolean',
        'shuffle_questions' => 'boolean',
        'shuffle_answers' => 'boolean',
        'show_correct_answers' => 'boolean',
        'published_at' => 'datetime',
    ];

    // Relationships
    public function lesson()
    {
        return $this->belongsTo(Lesson::class);
    }

    public function questions()
    {
        return $this->hasMany(Question::class)->orderBy('order');
    }

    public function attempts()
    {
        return $this->hasMany(QuizAttempt::class);
    }

    // Scopes
    public function scopePublished($query)
    {
        return $query->where('is_published', true);
    }

    public function scopeByLesson($query, $lessonId)
    {
        return $query->where('lesson_id', $lessonId);
    }

    // Methods
    public function getTotalQuestionsAttribute()
    {
        return $this->questions()->count();
    }

    public function getTotalPointsAttribute()
    {
        return $this->questions()->sum('points');
    }

    public function isPassed($score)
    {
        return $score >= $this->passing_score;
    }

    public function canRetake($userId)
    {
        $attemptCount = $this->attempts()->where('user_id', $userId)->count();
        return $this->max_attempts === 0 || $attemptCount < $this->max_attempts;
    }
}