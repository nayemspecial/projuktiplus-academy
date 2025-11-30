<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Lesson;
use App\Models\Enrollment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LessonController extends Controller
{
    public function markComplete(Request $request, Lesson $lesson)
    {
        // ১. এনরোলমেন্ট খুঁজে বের করা (একটু জটিল কুয়েরি কারণ লেসন -> সেকশন -> কোর্স -> এনরোলমেন্ট)
        $enrollment = Enrollment::where('user_id', Auth::id())
            ->whereHas('course.sections.lessons', function ($query) use ($lesson) {
                $query->where('id', $lesson->id);
            })
            ->firstOrFail();

        $completed = $request->input('completed', true);

        if ($completed) {
            // লেসনটি কমপ্লিট হিসেবে মার্ক করুন
            // firstOrCreate ব্যবহার করা ভালো যাতে ডুপ্লিকেট এন্ট্রি না হয়
            $enrollment->completedLessons()->firstOrCreate(
                ['lesson_id' => $lesson->id],
                ['completed_at' => now()]
            );
        } else {
            // যদি আন-মার্ক করার অপশন থাকে
            $enrollment->completedLessons()->where('lesson_id', $lesson->id)->delete();
        }

        // ২. এনরোলমেন্টের মোট প্রোগ্রেস আপডেট করুন
        // (Enrollment মডেলে updateProgress মেথডটি থাকতে হবে যা আগে দিয়েছি)
        $enrollment->updateProgress();

        return response()->json([
            'success' => true,
            'completed' => $completed,
            'progress' => $enrollment->progress
        ]);
    }
}