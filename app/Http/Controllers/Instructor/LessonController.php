<?php

namespace App\Http\Controllers\Instructor;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Lesson;
use App\Models\Section;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class LessonController extends Controller
{
    /**
     * নতুন লেসন তৈরি করুন
     */
    public function store(Request $request, Course $course, Section $section)
    {
        $this->authorizeOwnership($course);

        $request->validate([
            'title' => 'required|string|max:255',
            'video_url' => 'nullable|url',
            'content' => 'nullable|string',
        ]);

        $order = $section->lessons()->max('order') + 1;

        $section->lessons()->create([
            'title' => $request->title,
            'slug' => Str::slug($request->title) . '-' . Str::random(6),
            'video_url' => $request->video_url,
            'video_type' => 'youtube', // To-do: Add selector in modal
            'content' => $request->content,
            'order' => $order,
            'is_published' => false,
        ]);

        return redirect()->back()->with('success', 'নতুন লেসন সফলভাবে যোগ করা হয়েছে!');
    }

    /**
     * লেসন আপডেট করুন
     */
    public function update(Request $request, Lesson $lesson)
    {
        $this->authorizeOwnership($lesson->section->course);

        $request->validate([
            'title' => 'required|string|max:255',
            'video_url' => 'nullable|url',
            'content' => 'nullable|string',
        ]);

        $lesson->update($request->only('title', 'video_url', 'content'));

        return redirect()->back()->with('success', 'লেসন সফলভাবে আপডেট করা হয়েছে!');
    }

    /**
     * লেসন ডিলিট করুন
     */
    public function destroy(Lesson $lesson)
    {
        $this->authorizeOwnership($lesson->section->course);
        
        $lesson->delete();

        return redirect()->back()->with('success', 'লেসন সফলভাবে ডিলিট করা হয়েছে!');
    }

    /**
     * [আপডেট] লেসন রি-অর্ডার (Drag-and-Drop)
     */
    public function reorder(Request $request)
    {
        $request->validate([
            'lessons' => 'required|array',
            'lessons.*' => 'integer', // লেসন আইডিগুলোর অ্যারে
            'section_id' => 'required|integer', // কোন সেকশনে ড্রপ করা হলো
        ]);

        // মালিকানা যাচাই
        $section = Section::find($request->section_id);
        if (!$section || $section->course->instructor_id !== Auth::id()) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        // লুপ চালিয়ে প্রতিটি লেসনের 'order' এবং 'section_id' আপডেট করুন
        foreach ($request->lessons as $index => $lessonId) {
            Lesson::where('id', $lessonId)
                ->update([
                    'order' => $index + 1,
                    'section_id' => $request->section_id
                ]);
        }

        return response()->json(['message' => 'লেসন সফলভাবে সাজানো হয়েছে!']);
    }

    /**
     * লেসন স্ট্যাটাস আপডেট (পাবলিশ/ড্রাফট)
     */
    public function updateStatus(Request $request, Lesson $lesson)
    {
        $this->authorizeOwnership($lesson->section->course);

        $newStatus = !$lesson->is_published;
        
        $lesson->update([
            'is_published' => $newStatus,
            'published_at' => $newStatus ? now() : null,
        ]);

        $message = $newStatus ? 'লেসন সফলভাবে পাবলিশ করা হয়েছে!' : 'লেসন সফলভাবে ড্রাফট করা হয়েছে!';

        return redirect()->back()->with('success', $message);
    }
    
    /**
     * হেল্পার মেথড: এই ইন্সট্রাকটর কোর্সের মালিক কিনা তা চেক করে
     */
    private function authorizeOwnership(Course $course)
    {
        if ($course->instructor_id !== Auth::id()) {
            abort(403, 'আপনি এই কোর্সের মালিক নন।');
        }
    }
}