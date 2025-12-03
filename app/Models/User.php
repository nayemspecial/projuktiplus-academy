<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable
{
    use HasFactory, Notifiable, SoftDeletes;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'password',
        'avatar',
        'role',
        'status',
        'bio',
        'website',
        'social_links',
        'email_verified_at',
        'settings',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
        'social_links' => 'array',
        'settings' => 'array',
    ];

    // Relationships
    public function courses()
    {
        return $this->hasMany(Course::class, 'instructor_id');
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

    public function notifications()
    {
        return $this->hasMany(Notification::class);
    }

    public function quizAttempts()
    {
        return $this->hasMany(QuizAttempt::class);
    }

    public function wishlists()
    {
        return $this->hasMany(Wishlist::class);
    }

    public function couponUsages()
    {
        return $this->hasMany(CouponUsage::class);
    }

    // Scopes
    public function scopeInstructors($query)
    {
        return $query->where('role', 'instructor');
    }

    public function scopeStudents($query)
    {
        return $query->where('role', 'student');
    }

    public function scopeAdmins($query)
    {
        return $query->where('role', 'admin');
    }

    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }

    // Methods
    public function isAdmin()
    {
        return $this->role === 'admin';
    }

    public function isInstructor()
    {
        return $this->role === 'instructor';
    }

    public function isStudent()
    {
        return $this->role === 'student';
    }

    /**
     * [UPDATED] প্রফেশনাল ডিফল্ট অ্যাভাটার (UI Avatars)
     * যদি ইউজার ছবি আপলোড না করে থাকে, তবে তার নামের প্রথম অক্ষর দিয়ে একটি সুন্দর ছবি জেনারেট হবে।
     */
    public function getAvatarUrlAttribute()
    {
        if ($this->avatar) {
            return asset('storage/' . $this->avatar);
        }

        // UI Avatars API ব্যবহার করে ডাইনামিক ইমেজ
        $name = urlencode($this->name);
        return "https://ui-avatars.com/api/?name={$name}&background=random&color=fff&size=128&bold=true&font-size=0.5";
    }
}