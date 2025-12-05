<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Lesson;
use App\Models\Section;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class LessonController extends Controller
{
    /**
     * নতুন লেসন স্টোর করা
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'section_id' => 'required|exists:sections,id',
            'title' => 'required|string|max:255',
            'video_url' => 'nullable|url',
            'duration' => 'nullable|string', // ফর্মের ইনপুট নাম 'duration'
            'content' => 'nullable|string',
            'is_free' => 'boolean',
            'is_published' => 'boolean',
        ]);

        $section = Section::findOrFail($request->section_id);
        $lastOrder = $section->lessons()->max('order');

        // স্লাগ জেনারেশন (ইউনিক করার জন্য টাইমস্ট্যাম্প বা রেন্ডম স্ট্রিং যোগ করা ভালো)
        $slug = Str::slug($request->title) . '-' . Str::random(6);

        Lesson::create([
            'section_id' => $request->section_id,
            'title' => $request->title,
            'slug' => $slug,
            'video_url' => $request->video_url,
            'video_type' => 'youtube', // ডিফল্ট
            // [FIX] ইনপুট 'duration' কে ডাটাবেসের 'video_duration' কলামে ম্যাপ করা হলো
            'video_duration' => $request->duration, 
            'content' => $request->content,
            'is_free' => $request->boolean('is_free'),
            'is_published' => $request->boolean('is_published'),
            'order' => $lastOrder ? $lastOrder + 1 : 1,
            'published_at' => $request->boolean('is_published') ? now() : null,
        ]);

        return back()->with('success', 'লেসন সফলভাবে তৈরি করা হয়েছে।');
    }

    /**
     * লেসন আপডেট করা
     */
    public function update(Request $request, Lesson $lesson)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'video_url' => 'nullable|url',
            'duration' => 'nullable|string',
            'content' => 'nullable|string',
            'is_free' => 'boolean',
            'is_published' => 'boolean',
        ]);

        // স্লাগ আপডেট লজিক (শুধু টাইটেল পাল্টালে স্লাগ পাল্টাবে)
        $slug = $lesson->slug;
        if ($lesson->title !== $request->title) {
            $slug = Str::slug($request->title) . '-' . Str::random(6);
        }
        
        $isPublished = $request->boolean('is_published');

        $lesson->update([
            'title' => $request->title,
            'slug' => $slug,
            'video_url' => $request->video_url,
            // [FIX] আপডেট করার সময়ও ম্যাপিং ঠিক করা হলো
            'video_duration' => $request->duration,
            'content' => $request->content,
            'is_free' => $request->boolean('is_free'),
            'is_published' => $isPublished,
            'published_at' => $isPublished && !$lesson->published_at ? now() : $lesson->published_at,
        ]);

        return back()->with('success', 'লেসন আপডেট করা হয়েছে।');
    }

    /**
     * লেসন ডিলিট করা
     */
    public function destroy(Lesson $lesson)
    {
        $lesson->delete();
        return back()->with('success', 'লেসন ডিলিট করা হয়েছে।');
    }

    /**
     * [Drag & Drop] লেসন রি-অর্ডার
     */
    public function reorder(Request $request)
    {
        $request->validate([
            'lessons' => 'required|array',
            'lessons.*' => 'integer|exists:lessons,id',
            'section_id' => 'required|integer|exists:sections,id'
        ]);

        $sectionId = $request->section_id;

        foreach ($request->lessons as $index => $lessonId) {
            Lesson::where('id', $lessonId)->update([
                'order' => $index + 1,
                'section_id' => $sectionId
            ]);
        }

        return response()->json(['success' => true, 'message' => 'লেসন সাজানো হয়েছে।']);
    }
}