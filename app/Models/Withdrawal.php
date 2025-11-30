<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Withdrawal extends Model
{
    use HasFactory;

    protected $fillable = [
        'instructor_id',
        'amount',
        'payment_method',
        'account_name',
        'account_number',
        'bank_name',
        'branch_name',
        'mobile_wallet',
        'status',
        'notes',
        'processed_at',
    ];

    protected $casts = [
        'amount' => 'decimal:2',
        'processed_at' => 'datetime',
    ];

    public function instructor()
    {
        return $this->belongsTo(User::class, 'instructor_id');
    }

    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }

    public function scopeApproved($query)
    {
        return $query->where('status', 'approved');
    }

    public function scopeProcessed($query)
    {
        return $query->where('status', 'processed');
    }

    public function scopeRejected($query)
    {
        return $query->where('status', 'rejected');
    }

    public function scopeByInstructor($query, $instructorId)
    {
        return $query->where('instructor_id', $instructorId);
    }

    public function markAsApproved()
    {
        $this->update(['status' => 'approved']);
    }

    public function markAsProcessed()
    {
        $this->update([
            'status' => 'processed',
            'processed_at' => now(),
        ]);
    }

    public function markAsRejected($reason = null)
    {
        $this->update([
            'status' => 'rejected',
            'notes' => $reason,
        ]);
    }
}