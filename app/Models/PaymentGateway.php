<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentGateway extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'title',
        'is_active',
        'test_mode',
        'credentials',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'test_mode' => 'boolean',
        'credentials' => 'array', // অটোমেটিক JSON হ্যান্ডেল করবে
    ];

    /**
     * রিলেশনশিপ: এই গেটওয়ে ব্যবহার করে করা পেমেন্টসমূহ।
     * আমরা 'id' এর বদলে 'name' কলাম ব্যবহার করে লিঙ্ক করছি।
     */
    public function payments()
    {
        return $this->hasMany(Payment::class, 'payment_gateway', 'name');
    }

    // স্কোপ: শুধুমাত্র অ্যাক্টিভ গেটওয়েগুলো পাওয়ার জন্য
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }
}