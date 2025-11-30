<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Lesson extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'section_id',
        'title',
        'slug',
        'content',
        'video_url',
        'video_duration',
        'video_type',
        'attachments',
        'order',
        'is_free',
        'is_published',
        'preview',
        'published_at',
    ];

    protected $casts = [
        'attachments' => 'array',
        'is_free' => 'boolean',
        'is_published' => 'boolean',
        'preview' => 'boolean',
        'published_at' => 'datetime',
    ];

    // Relationships
    public function section()
    {
        return $this->belongsTo(Section::class);
    }

    public function course()
    {
        return $this->hasOneThrough(Course::class, Section::class);
    }

    public function completedLessons()
    {
        return $this->hasMany(CompletedLesson::class);
    }

    public function quiz()
    {
        return $this->hasOne(Quiz::class);
    }

    // Scopes
    public function scopePublished($query)
    {
        return $query->where('is_published', true);
    }

    public function scopeFree($query)
    {
        return $query->where('is_free', true);
    }

    public function scopePreview($query)
    {
        return $query->where('preview', true);
    }

    public function scopeBySection($query, $sectionId)
    {
        return $query->where('section_id', $sectionId);
    }

    // Methods
    public function getVideoEmbedUrlAttribute()
    {
        if ($this->video_type === 'youtube') {
            return "https://www.youtube.com/embed/" . $this->extractYoutubeId($this->video_url);
        } elseif ($this->video_type === 'vimeo') {
            return "https://player.vimeo.com/video/" . $this->extractVimeoId($this->video_url);
        }
        return $this->video_url;
    }

    private function extractYoutubeId($url)
    {
        preg_match('/(?:youtube\.com\/(?:[^\/]+\/.+\/|(?:v|e(?:mbed)?)\/|.*[?&]v=)|youtu\.be\/)([^"&?\/\s]{11})/', $url, $matches);
        return $matches[1] ?? null;
    }

    private function extractVimeoId($url)
    {
        preg_match('/vimeo\.com\/(?:.*?\/)?([0-9]+)/', $url, $matches);
        return $matches[1] ?? null;
    }

    public function hasQuiz()
    {
        return $this->quiz()->exists();
    }
}