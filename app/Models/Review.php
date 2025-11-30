<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Review extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'user_id',
        'course_id',
        'rating',
        'comment',
        'is_approved',
        'featured',
        'helpful',
        'not_helpful',
    ];

    protected $casts = [
        'rating' => 'integer',
        'is_approved' => 'boolean',
        'featured' => 'boolean',
        'helpful' => 'array',
        'not_helpful' => 'array',
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

    // Scopes
    public function scopeApproved($query)
    {
        return $query->where('is_approved', true);
    }

    public function scopeFeatured($query)
    {
        return $query->where('featured', true);
    }

    public function scopeByRating($query, $rating)
    {
        return $query->where('rating', $rating);
    }

    public function scopeByCourse($query, $courseId)
    {
        return $query->where('course_id', $courseId);
    }

    // Methods
    public function markHelpful($userId)
    {
        $helpful = $this->helpful ?? [];
        if (!in_array($userId, $helpful)) {
            $helpful[] = $userId;
            $this->helpful = $helpful;
            $this->save();
        }
    }

    public function markNotHelpful($userId)
    {
        $notHelpful = $this->not_helpful ?? [];
        if (!in_array($userId, $notHelpful)) {
            $notHelpful[] = $userId;
            $this->not_helpful = $notHelpful;
            $this->save();
        }
    }

    public function getHelpfulCountAttribute()
    {
        return count($this->helpful ?? []);
    }

    public function getNotHelpfulCountAttribute()
    {
        return count($this->not_helpful ?? []);
    }
}