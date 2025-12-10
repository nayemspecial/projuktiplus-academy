<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Lesson;
use App\Models\Enrollment;
use App\Models\CompletedLesson;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CourseController extends Controller
{
    /**
     * স্টুডেন্টের সব কোর্সের তালিকা
     */
    public function index(Request $request)
    {
        $search = $request->get('search');
        $filter = $request->get('filter', 'all');
        
        $query = Course::whereHas('enrollments', function($query) {
            $query->where('user_id', Auth::id());
        })->with(['enrollments' => function($query) {
            $query->where('user_id', Auth::id());
        }, 'instructor']);

        if ($search) {
            $query->where(function($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhereHas('instructor', function($iq) use ($search) {
                      $iq->where('name', 'like', "%{$search}%");
                  });
            });
        }

        if ($filter === 'active') {
            $query->whereHas('enrollments', function($q) {
                $q->where('user_id', Auth::id())
                  ->where('status', 'active')
                  ->where('progress', '<', 100);
            });
        } elseif ($filter === 'completed') {
            $query->whereHas('enrollments', function($q) {
                $q->where('user_id', Auth::id())
                  ->where('status', 'completed')
                  ->orWhere('progress', 100);
            });
        }

        $courses = $query->orderByDesc('created_at')->paginate(9);

        return view('student.courses.index', compact('courses', 'search', 'filter'));
    }

    /**
     * সিঙ্গেল কোর্স ওভারভিউ পেজ
     */
    public function show(Course $course)
    {
        $enrollment = Enrollment::where('user_id', Auth::id())
            ->where('course_id', $course->id)
            ->firstOrFail();

        $totalLessons = $course->lessons()->count();
        $completedLessonsCount = $enrollment->completed_lessons;
        $progress = $enrollment->progress;

        return view('student.courses.show', compact('course', 'enrollment', 'progress', 'completedLessonsCount', 'totalLessons'));
    }

    /**
     * কোর্সে এনরোলমেন্ট (ফ্রি বা পেইড)
     */
    public function enroll(Course $course)
    {
        $existingEnrollment = Enrollment::where('user_id', Auth::id())
            ->where('course_id', $course->id)
            ->first();

        if ($existingEnrollment) {
            // যদি পেন্ডিং থাকে তবে ড্যাশবোর্ডে পাঠাবে
            if($existingEnrollment->status == 'pending') {
                return redirect()->route('student.dashboard')->with('info', 'আপনার এনরোলমেন্ট রিকোয়েস্ট পেন্ডিং আছে।');
            }
            // অ্যাক্টিভ থাকলে প্লেয়ারে পাঠাবে
            return redirect()->route('student.courses.content', $course->id)
                ->with('info', 'আপনি ইতিমধ্যে এই কোর্সে এনরোল করা আছেন।');
        }

        // ফ্রি কোর্সের ক্ষেত্রে সরাসরি অ্যাক্টিভ
        // পেইড হলে CheckoutController এর মাধ্যমে আসবে, তাই এখানে শুধু ফ্রি হ্যান্ডেল করা সেফ
        if($course->price == 0){
             Enrollment::create([
                'user_id' => Auth::id(),
                'course_id' => $course->id,
                'price_paid' => 0,
                'status' => 'active',
                'progress' => 0,
                'completed_lessons' => 0,
                'total_lessons' => $course->lessons()->count(),
                'last_accessed_at' => now(),
                'enrolled_at' => now(),
            ]);
            return redirect()->route('student.courses.content', $course->id)
            ->with('success', 'কোর্সে সফলভাবে এনরোল করা হয়েছে!');
        }
        
        return redirect()->route('courses.checkout', $course->slug);
    }

    /**
     * 'চালিয়ে যান' বাটন ক্লিক করলে এখানে আসবে (Smart Redirect)
     */
    public function content(Course $course)
    {
        $enrollment = Enrollment::where('user_id', Auth::id())
            ->where('course_id', $course->id)
            ->where('status', 'active')
            ->firstOrFail();

        // লাস্ট এক্সেস করা লেসন বের করা (CompletedLesson থেকে)
        $lastCompleted = $enrollment->completedLessons()->latest('completed_at')->first();
        
        // যদি কোনো লেসন কমপ্লিট না করে থাকে, প্রথম লেসনে পাঠাবে
        if (!$lastCompleted) {
            return $this->startCourse($course);
        }
        
        // সব লেসন অর্ডার অনুযায়ী আনা
        $allLessons = $course->lessons()->orderBy('section_id')->orderBy('order')->get();
        
        // লাস্ট কমপ্লিট লেসনের ইনডেক্স
        $lastCompletedIndex = $allLessons->search(function($item) use ($lastCompleted) {
            return $item->id === $lastCompleted->lesson_id;
        });
        
        // যদি পরের লেসন থাকে, সেখানে রিডাইরেক্ট করবে
        if ($lastCompletedIndex !== false && isset($allLessons[$lastCompletedIndex + 1])) {
            $nextLesson = $allLessons[$lastCompletedIndex + 1];
            return redirect()->route('student.courses.lessons.show', [$course->id, $nextLesson->id]);
        }
        
        // কোর্স শেষ হয়ে গেলে বা কিছু না পেলে শেষ লেসনেই রাখবে
        $lastLesson = $allLessons->last();
        return redirect()->route('student.courses.lessons.show', [$course->id, $lastLesson->id]);
    }

    public function startCourse(Course $course)
    {
        // প্রথম লেসন খোঁজা
        $firstLesson = Lesson::whereHas('section', function($q) use($course){
                $q->where('course_id', $course->id);
            })
            ->orderBy('section_id')
            ->orderBy('order')
            ->first();

        if (!$firstLesson) {
            return redirect()->route('student.courses.show', $course->id)
                ->with('error', 'এই কোর্সে এখনও কোনো লেসন নেই।');
        }

        return redirect()->route('student.courses.lessons.show', [$course->id, $firstLesson->id]);
    }

    /**
     * মেইন লেসন প্লেয়ার ভিউ (ভিডিও/কুইজ)
     */
    public function showLesson(Course $course, Lesson $lesson)
    {
        $enrollment = Enrollment::where('user_id', Auth::id())
            ->where('course_id', $course->id)
            ->where('status', 'active')
            ->firstOrFail();

        // সিকিউরিটি চেক
        if ($lesson->section->course_id !== $course->id) {
            abort(404);
        }

        $enrollment->update(['last_accessed_at' => now()]);

        // সাইডবারের জন্য ডাটা লোড
        $course->load(['sections' => function ($q) {
            $q->orderBy('order', 'asc')
              ->with(['lessons' => function ($lq) {
                  $lq->orderBy('order', 'asc');
              }]);
        }]);

        $completedLessonIds = $enrollment->completedLessons()
            ->pluck('lesson_id')
            ->toArray();

        // প্রোগ্রেস
        $progress = $enrollment->progress;

        // নেভিগেশন লজিক
        $allLessons = $course->sections->pluck('lessons')->collapse();
        
        $currentLessonIndex = $allLessons->search(function ($item) use ($lesson) {
            return $item->id === $lesson->id;
        });

        $prevLesson = $currentLessonIndex > 0 ? $allLessons[$currentLessonIndex - 1] : null;
        $nextLesson = $currentLessonIndex < $allLessons->count() - 1 ? $allLessons[$currentLessonIndex + 1] : null;

        // [NEW] ভিডিও ID এক্সট্রাক্ট করা (Plyr এর জন্য)
        $videoId = null;
        if ($lesson->video_type === 'youtube' && $lesson->video_url) {
            preg_match('/(?:youtube\.com\/(?:[^\/]+\/.+\/|(?:v|e(?:mbed)?)\/|.*[?&]v=)|youtu\.be\/)([^"&?\/\s]{11})/', $lesson->video_url, $matches);
            $videoId = $matches[1] ?? null;
        } elseif ($lesson->video_type === 'vimeo' && $lesson->video_url) {
            preg_match('/vimeo\.com\/(?:.*?\/)?([0-9]+)/', $lesson->video_url, $matches);
            $videoId = $matches[1] ?? null;
        }

        return view('student.courses.player', compact(
            'course',
            'lesson',
            'enrollment',
            'completedLessonIds',
            'progress',
            'prevLesson',
            'nextLesson',
            'videoId' // ভিউতে পাস করা হচ্ছে
        ));
    }

    /**
     * [NEW] লেসন কমপ্লিট মার্ক করা (AJAX Request)
     */
    public function markLessonComplete(Request $request, Lesson $lesson)
    {
        $enrollment = Enrollment::where('user_id', Auth::id())
            ->where('course_id', $lesson->section->course_id)
            ->firstOrFail();

        $completed = $request->boolean('completed');

        if ($completed) {
            CompletedLesson::firstOrCreate([
                'enrollment_id' => $enrollment->id,
                'lesson_id' => $lesson->id
            ], ['completed_at' => now(), 'time_spent' => 0]);
        } else {
            CompletedLesson::where('enrollment_id', $enrollment->id)
                ->where('lesson_id', $lesson->id)
                ->delete();
        }

        // এনরোলমেন্ট প্রগ্রেস আপডেট (মডেলের মেথড কল)
        $enrollment->updateProgress();

        return response()->json([
            'success' => true,
            'completed' => $completed,
            'progress' => $enrollment->refresh()->progress
        ]);
    }
}