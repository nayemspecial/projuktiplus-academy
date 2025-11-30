<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Enrollment;
use App\Models\Lesson;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ResourceController extends Controller
{
    /**
     * স্টুডেন্টের সব কোর্সের রিসোর্সগুলো দেখানো
     */
    public function index(Request $request)
    {
        $userId = Auth::id();
        
        // ১. স্টুডেন্ট যে কোর্সগুলোতে এনরোল্ড আছে সেগুলোর ID নিন
        $enrolledCourseIds = Enrollment::where('user_id', $userId)
            ->active()
            ->pluck('course_id');

        // ২. সেই কোর্সগুলোর সব লেসন খুঁজে বের করুন যেগুলোতে attachments আছে
        $query = Lesson::whereHas('section.course', function ($q) use ($enrolledCourseIds) {
            $q->whereIn('course_id', $enrolledCourseIds);
        })
        ->where('is_published', true)
        ->whereNotNull('attachments') // শুধু attachments আছে এমন লেসন
        ->with('section.course'); // কোর্স ও সেকশনের তথ্যসহ লোড করুন

        // ৩. সার্চ ফিল্টার (যদি থাকে)
        $search = $request->get('search');
        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhereHas('section.course', function ($cq) use ($search) {
                      $cq->where('title', 'like', "%{$search}%");
                  });
            });
        }
        
        // ৪. ক্যাটাগরি ফিল্টার (কোর্স অনুযায়ী)
        $courseFilter = $request->get('course');
        if ($courseFilter) {
            $query->whereHas('section.course', function ($q) use ($courseFilter) {
                $q->where('id', $courseFilter);
            });
        }

        $lessonsWithResources = $query->paginate(20);
        
        // ফিল্টারের জন্য কোর্সগুলোর তালিকা
        $courses = Enrollment::where('user_id', $userId)
            ->active()
            ->with('course')
            ->get()
            ->pluck('course');

        return view('student.resources.index', compact('lessonsWithResources', 'courses', 'search', 'courseFilter'));
    }

    /**
     * রিসোর্স ডাউনলোড (এই রাউটটি এখনো তৈরি হয়নি, তবে থাকা ভালো)
     * আপনার student.php তে 'download/{resource}' রাউট আছে, কিন্তু রিসোর্স আলাদা মডেল না হওয়ায়
     * আমাদের লেসন থেকে ফাইল ডাউনলোড করতে হবে।
     */
    public function downloadResource(Lesson $lesson, $attachmentKey)
    {
        // ... (এই ফাংশনটি পরে ইমপ্লিমেন্ট করা যাবে)
        // আপাতত লেসন প্লেয়ার থেকেই ডাউনলোড করা যাচ্ছে
    }
}