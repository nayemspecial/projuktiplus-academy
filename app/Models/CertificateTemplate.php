<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CertificateTemplate extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'background_image', // সার্টিফিকেটের ব্যাকগ্রাউন্ড ইমেজ
        'content_layout',   // HTML/CSS স্ট্রাকচার বা কনফিগারেশন
        'is_default',       // ডিফল্ট টেমপ্লেট কিনা
        'is_active',
    ];

    protected $casts = [
        'is_default' => 'boolean',
        'is_active' => 'boolean',
    ];

    public function certificates()
    {
        return $this->hasMany(Certificate::class, 'template_id');
    }
}