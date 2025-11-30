<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Course extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'title',
        'slug',
        'description',
        'short_description',
        'instructor_id',
        'thumbnail',
        'video_preview',
        'price',
        'discount_price',
        'level',
        'status',
        'category',
        'language',
        'duration',
        'total_lessons',
        'total_students',
        'rating',
        'total_reviews',
        'requirements',
        'what_you_will_learn',
        'target_audience',
        'featured',
        'certificate_included',
        'lifetime_access',
        'published_at',
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'discount_price' => 'decimal:2',
        'rating' => 'float',
        'requirements' => 'array',
        'what_you_will_learn' => 'array',
        'target_audience' => 'array',
        'featured' => 'boolean',
        'certificate_included' => 'boolean',
        'lifetime_access' => 'boolean',
        'published_at' => 'datetime',
    ];

    // Relationships
    public function instructor()
    {
        return $this->belongsTo(User::class, 'instructor_id');
    }

    public function sections()
    {
        return $this->hasMany(Section::class);
    }

    public function enrollments()
    {
        return $this->hasMany(Enrollment::class);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }

    public function certificates()
    {
        return $this->hasMany(Certificate::class);
    }

    public function wishlists()
    {
        return $this->hasMany(Wishlist::class);
    }

    public function lessons()
    {
        return $this->hasManyThrough(Lesson::class, Section::class);
    }

    // Scopes
    public function scopePublished($query)
    {
        return $query->where('status', 'published');
    }

    public function scopeDraft($query)
    {
        return $query->where('status', 'draft');
    }

    public function scopeFeatured($query)
    {
        return $query->where('featured', true);
    }

    public function scopeByCategory($query, $category)
    {
        return $query->where('category', $category);
    }

    public function scopeByInstructor($query, $instructorId)
    {
        return $query->where('instructor_id', $instructorId);
    }

    // Methods
    public function getThumbnailUrlAttribute()
    {
        return $this->thumbnail ? asset('storage/' . $this->thumbnail) : asset('images/default-course.jpg');
    }

    public function getVideoPreviewUrlAttribute()
    {
        return $this->video_preview ? asset('storage/' . $this->video_preview) : null;
    }

    public function getCurrentPriceAttribute()
    {
        return $this->discount_price ?? $this->price;
    }

    public function getDiscountPercentageAttribute()
    {
        if ($this->discount_price && $this->price > 0) {
            return round((($this->price - $this->discount_price) / $this->price) * 100);
        }
        return 0;
    }

    public function isFree()
    {
        return $this->price == 0;
    }

    public function hasDiscount()
    {
        return !is_null($this->discount_price);
    }
}