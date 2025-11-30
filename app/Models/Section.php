<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Section extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'course_id',
        'title',
        'description',
        'order',
        'is_published',
    ];

    protected $casts = [
        'is_published' => 'boolean',
    ];

    // Relationships
    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function lessons()
    {
        return $this->hasMany(Lesson::class)->orderBy('order');
    }

    public function publishedLessons()
    {
        return $this->hasMany(Lesson::class)->where('is_published', true)->orderBy('order');
    }

    // Scopes
    public function scopePublished($query)
    {
        return $query->where('is_published', true);
    }

    public function scopeByCourse($query, $courseId)
    {
        return $query->where('course_id', $courseId);
    }

    // Methods
    public function getTotalLessonsAttribute()
    {
        return $this->lessons()->count();
    }

    public function getTotalDurationAttribute()
    {
        return $this->lessons()->sum('video_duration');
    }
}