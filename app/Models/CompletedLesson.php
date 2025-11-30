<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompletedLesson extends Model
{
    use HasFactory;

    protected $fillable = [
        'enrollment_id',
        'lesson_id',
        'time_spent',
        'watch_count',
        'completed_at',
    ];

    protected $casts = [
        'completed_at' => 'datetime',
    ];

    // Relationships
    public function enrollment()
    {
        return $this->belongsTo(Enrollment::class);
    }

    public function lesson()
    {
        return $this->belongsTo(Lesson::class);
    }

    // Scopes
    public function scopeByEnrollment($query, $enrollmentId)
    {
        return $query->where('enrollment_id', $enrollmentId);
    }

    public function scopeByLesson($query, $lessonId)
    {
        return $query->where('lesson_id', $lessonId);
    }

    public function scopeRecent($query)
    {
        return $query->orderBy('completed_at', 'desc');
    }
}