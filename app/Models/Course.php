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

    // Methods & Accessors

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

    /**
     * [FIX] সেফটি অ্যাক্সেসর: যদি ডাটাবেসে JSON স্ট্রিং থাকে বা নাল থাকে,
     * তবুও এটি যেন সবসময় অ্যারে রিটার্ন করে। এতে foreach এরর হবে না।
     */
    public function getWhatYouWillLearnAttribute($value)
    {
        // যদি ভ্যালু না থাকে, খালি অ্যারে রিটার্ন করো
        if (is_null($value)) return [];
        
        // যদি ইতিমধ্যে অ্যারে হয় (কাস্টের কারণে), তবে সেটাই রিটার্ন করো
        if (is_array($value)) return $value;
        
        // যদি স্ট্রিং হয়, ডিকোড করার চেষ্টা করো
        $decoded = json_decode($value, true);
        
        // ডিকোড সফল হলে অ্যারে, নাহলে খালি অ্যারে
        return is_array($decoded) ? $decoded : [];
    }

    // Requirements এবং Target Audience এর জন্যও একই সেফটি
    public function getRequirementsAttribute($value)
    {
        if (is_null($value)) return [];
        if (is_array($value)) return $value;
        $decoded = json_decode($value, true);
        return is_array($decoded) ? $decoded : [];
    }

    public function getTargetAudienceAttribute($value)
    {
        if (is_null($value)) return [];
        if (is_array($value)) return $value;
        $decoded = json_decode($value, true);
        return is_array($decoded) ? $decoded : [];
    }

    // [OPTIMIZATION]
    // rating, total_reviews, total_students এর জন্য অ্যাক্সেসরগুলো সরিয়ে ফেলা হয়েছে।
    // কারণ এগুলো আপনার ডাটাবেস কলামেই আছে। অহেতুক কুয়েরি চালিয়ে সাইট স্লো করার দরকার নেই।
    // এখন সরাসরি ডাটাবেসের ভ্যালু ব্যবহার হবে।
}