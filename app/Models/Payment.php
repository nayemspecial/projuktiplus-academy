<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'course_id',
        'enrollment_id',
        'transaction_id',
        'payment_gateway',
        'amount',
        'gateway_fee',
        'platform_fee',
        'instructor_earnings',
        'currency',
        'status',
        'payment_details',
        'refund_details',
        'completed_at',
        'refunded_at',
    ];

    protected $casts = [
        'amount' => 'decimal:2',
        'gateway_fee' => 'decimal:2',
        'platform_fee' => 'decimal:2',
        'instructor_earnings' => 'decimal:2',
        'payment_details' => 'array',
        'refund_details' => 'array',
        'completed_at' => 'datetime',
        'refunded_at' => 'datetime',
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

    public function enrollment() 
    { 
        return $this->belongsTo(Enrollment::class); 
    }

    // Scopes
    public function scopeCompleted($query)
    {
        return $query->where('status', 'completed');
    }

    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }

    public function scopeFailed($query)
    {
        return $query->where('status', 'failed');
    }

    public function scopeRefunded($query)
    {
        return $query->where('status', 'refunded');
    }

    public function scopeByUser($query, $userId)
    {
        return $query->where('user_id', $userId);
    }

    // Methods
    public function markAsCompleted()
    {
        $this->update([
            'status' => 'completed',
            'completed_at' => now(),
        ]);
    }

    public function markAsRefunded($refundDetails = null)
    {
        $this->update([
            'status' => 'refunded',
            'refunded_at' => now(),
            'refund_details' => $refundDetails,
        ]);
    }

    public function isCompleted()
    {
        return $this->status === 'completed';
    }

    public function isRefunded()
    {
        return $this->status === 'refunded';
    }
}