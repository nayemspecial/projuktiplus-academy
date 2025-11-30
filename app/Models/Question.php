<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;

    protected $fillable = [
        'quiz_id',
        'question',
        'type',
        'points',
        'explanation',
        'order',
    ];

    protected $casts = [
        'points' => 'integer',
    ];

    // Relationships
    public function quiz()
    {
        return $this->belongsTo(Quiz::class);
    }

    public function answers()
    {
        return $this->hasMany(Answer::class)->orderBy('order');
    }

    // Scopes
    public function scopeMultipleChoice($query)
    {
        return $query->where('type', 'multiple_choice');
    }

    public function scopeTrueFalse($query)
    {
        return $query->where('type', 'true_false');
    }

    public function scopeByQuiz($query, $quizId)
    {
        return $query->where('quiz_id', $quizId);
    }

    // Methods
    public function getCorrectAnswersAttribute()
    {
        return $this->answers()->where('is_correct', true)->get();
    }

    public function hasMultipleCorrectAnswers()
    {
        return $this->answers()->where('is_correct', true)->count() > 1;
    }
}