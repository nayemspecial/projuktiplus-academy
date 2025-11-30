<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CourseAnalytic extends Model
{
    use HasFactory;

    protected $fillable = [
        'course_id',
        'total_enrollments',
        'active_enrollments',
        'completed_enrollments',
        'completion_rate',
        'average_rating',
        'total_reviews',
        'revenue',
        'analytics_date',
    ];

    protected $casts = [
        'completion_rate' => 'decimal:2',
        'average_rating' => 'decimal:2',
        'revenue' => 'decimal:2',
        'analytics_date' => 'date',
    ];

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function scopeByDateRange($query, $startDate, $endDate)
    {
        return $query->whereBetween('analytics_date', [$startDate, $endDate]);
    }

    public function scopeByCourse($query, $courseId)
    {
        return $query->where('course_id', $courseId);
    }

    public function scopeLatestFirst($query)
    {
        return $query->orderBy('analytics_date', 'desc');
    }
}