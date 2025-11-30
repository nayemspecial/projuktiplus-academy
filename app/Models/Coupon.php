<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'description',
        'type',
        'value',
        'min_order_amount',
        'max_uses',
        'used_count',
        'valid_from',
        'valid_to',
        'is_active',
        'applicable_courses',
        'applicable_users',
    ];

    protected $casts = [
        'value' => 'decimal:2',
        'min_order_amount' => 'decimal:2',
        'is_active' => 'boolean',
        'valid_from' => 'date',
        'valid_to' => 'date',
        'applicable_courses' => 'array',
        'applicable_users' => 'array',
    ];

    // Relationships
    public function usages()
    {
        return $this->hasMany(CouponUsage::class);
    }

    // Scopes
    public function scopeActive($query)
    {
        return $query->where('is_active', true)
                    ->where(function ($query) {
                        $query->whereNull('valid_from')
                              ->orWhere('valid_from', '<=', now());
                    })
                    ->where(function ($query) {
                        $query->whereNull('valid_to')
                              ->orWhere('valid_to', '>=', now());
                    });
    }

    public function scopeValidForCourse($query, $courseId)
    {
        return $query->where(function ($query) use ($courseId) {
            $query->whereNull('applicable_courses')
                  ->orWhereJsonContains('applicable_courses', $courseId);
        });
    }

    public function scopeValidForUser($query, $userId)
    {
        return $query->where(function ($query) use ($userId) {
            $query->whereNull('applicable_users')
                  ->orWhereJsonContains('applicable_users', $userId);
        });
    }

    // Methods
    public function isValid()
    {
        return $this->is_active &&
               (!$this->valid_from || $this->valid_from <= now()) &&
               (!$this->valid_to || $this->valid_to >= now()) &&
               (!$this->max_uses || $this->used_count < $this->max_uses);
    }

    public function calculateDiscount($amount)
    {
        if ($this->type === 'percentage') {
            $discount = ($amount * $this->value) / 100;
            return min($discount, $amount);
        }
        return min($this->value, $amount);
    }

    public function canBeUsed($userId, $courseId)
    {
        return $this->isValid() &&
               (!$this->applicable_users || in_array($userId, $this->applicable_users)) &&
               (!$this->applicable_courses || in_array($courseId, $this->applicable_courses));
    }
}