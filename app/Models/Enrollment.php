<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Enrollment extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'user_id',
        'course_id',
        'price_paid',
        'status',
        'progress',
        'completed_lessons',
        'total_lessons',
        'completed_at',
        'last_accessed_at',
        'cancellation_reason',
    ];

    protected $casts = [
        'price_paid' => 'decimal:2',
        'completed_at' => 'datetime',
        'last_accessed_at' => 'datetime',
    ];

    // Relationships
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function completedLessons()
    {
        return $this->hasMany(CompletedLesson::class);
    }

    public function certificates()
    {
        return $this->hasMany(Certificate::class);
    }

    public function quizAttempts()
    {
        return $this->hasMany(QuizAttempt::class);
    }

    public function payment()
    {
        return $this->hasOne(Payment::class);
    }

    // Scopes
    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }

    public function scopeCompleted($query)
    {
        return $query->where('status', 'completed');
    }

    public function scopeCancelled($query)
    {
        return $query->where('status', 'cancelled');
    }

    public function scopeByUser($query, $userId)
    {
        return $query->where('user_id', $userId);
    }

    public function scopeByCourse($query, $courseId)
    {
        return $query->where('course_id', $courseId);
    }

    // Methods
    public function markAsCompleted()
    {
        $this->update([
            'status' => 'completed',
            'progress' => 100,
            'completed_at' => now(),
        ]);
    }

    public function updateProgress()
    {
        $totalLessons = $this->course->lessons()->count();
        $completedLessons = $this->completedLessons()->count();
        
        $progress = $totalLessons > 0 ? round(($completedLessons / $totalLessons) * 100) : 0;

        $this->update([
            'progress' => $progress,
            'completed_lessons' => $completedLessons,
            'total_lessons' => $totalLessons,
        ]);

        if ($progress === 100 && $this->status !== 'completed') {
            $this->markAsCompleted();
        }
    }

    public function isCompleted()
    {
        return $this->status === 'completed';
    }

    public function isActive()
    {
        return $this->status === 'active';
    }
}