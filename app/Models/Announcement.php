<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Announcement extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'course_id',
        'instructor_id',
        'title',
        'content',
        'is_published',
        'is_urgent',
        'published_at',
    ];

    protected $casts = [
        'is_published' => 'boolean',
        'is_urgent' => 'boolean',
        'published_at' => 'datetime',
    ];

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function instructor()
    {
        return $this->belongsTo(User::class, 'instructor_id');
    }

    public function scopePublished($query)
    {
        return $query->where('is_published', true);
    }

    public function scopeUrgent($query)
    {
        return $query->where('is_urgent', true);
    }

    public function scopeByCourse($query, $courseId)
    {
        return $query->where('course_id', $courseId);
    }

    public function scopeByInstructor($query, $instructorId)
    {
        return $query->where('instructor_id', $instructorId);
    }
}