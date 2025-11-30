<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Certificate extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'course_id',
        'enrollment_id',
        'template_id',
        'certificate_number',
        'certificate_url',
        'issue_date',
        'expiry_date',
        'validity_period',
        'verification_code',
        'is_revoked',
        'revocation_reason',
        'revoked_at',
    ];

    protected $casts = [
        'issue_date' => 'date',
        'expiry_date' => 'date',
        'is_revoked' => 'boolean',
        'revoked_at' => 'datetime',
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

    public function template()
    {
        return $this->belongsTo(CertificateTemplate::class, 'template_id');
    }

    // Scopes
    public function scopeValid($query)
    {
        return $query->where('is_revoked', false)
                    ->where(function ($query) {
                        $query->whereNull('expiry_date')
                              ->orWhere('expiry_date', '>', now());
                    });
    }

    public function scopeRevoked($query)
    {
        return $query->where('is_revoked', true);
    }

    public function scopeExpired($query)
    {
        return $query->where('expiry_date', '<', now())->where('is_revoked', false);
    }

    // Methods
    public function revoke($reason = null)
    {
        $this->update([
            'is_revoked' => true,
            'revocation_reason' => $reason,
            'revoked_at' => now(),
        ]);
    }

    public function isValid()
    {
        return !$this->is_revoked && (!$this->expiry_date || $this->expiry_date > now());
    }

    public function isExpired()
    {
        return $this->expiry_date && $this->expiry_date < now();
    }

    public function getCertificateUrlAttribute()
    {
        return $this->attributes['certificate_url'] ? asset('storage/' . $this->attributes['certificate_url']) : null;
    }
}