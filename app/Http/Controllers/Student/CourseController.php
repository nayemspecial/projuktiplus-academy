<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Lesson;
use App\Models\Enrollment;
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
     * কোর্সে এনরোলমেন্ট
     */
    public function enroll(Course $course)
    {
        $existingEnrollment = Enrollment::where('user_id', Auth::id())
            ->where('course_id', $course->id)
            ->first();

        if ($existingEnrollment) {
            return redirect()->route('student.courses.content', $course->id)
                ->with('info', 'আপনি ইতিমধ্যে এই কোর্সে এনরোল করা আছেন।');
        }

        Enrollment::create([
            'user_id' => Auth::id(),
            'course_id' => $course->id,
            'price_paid' => $course->price ?? 0,
            'status' => 'active',
            'progress' => 0,
            'completed_lessons' => 0,
            'total_lessons' => $course->lessons()->count(),
            'last_accessed_at' => now(),
        ]);

        return redirect()->route('student.courses.content', $course->id)
            ->with('success', 'কোর্সে সফলভাবে এনরোল করা হয়েছে!');
    }

    /**
     * 'চালিয়ে যান' বাটন ক্লিক করলে এখানে আসবে
     */
    public function content(Course $course)
    {
        $enrollment = Enrollment::where('user_id', Auth::id())
            ->where('course_id', $course->id)
            ->where('status', 'active')
            ->firstOrFail();

        $completedLessonIds = $enrollment->completedLessons()->pluck('lesson_id')->toArray();
        
        // পরবর্তী লেসন বের করার লজিক
        $nextLessonToWatch = Lesson::query()
            ->join('sections', 'lessons.section_id', '=', 'sections.id')
            ->where('sections.course_id', $course->id)
            ->where('sections.is_published', true)
            ->where('lessons.is_published', true)
            ->whereNotIn('lessons.id', $completedLessonIds)
            ->orderBy('sections.order', 'asc')
            ->orderBy('lessons.order', 'asc')
            ->select('lessons.*')
            ->first();

        if ($nextLessonToWatch) {
             return redirect()->route('student.courses.lessons.show', [$course->id, $nextLessonToWatch->id]);
        }

        return $this->startCourse($course);
    }

    /**
     * কোর্স শুরু করার মেথড
     */
    public function startCourse(Course $course)
    {
        $firstLesson = Lesson::query()
            ->join('sections', 'lessons.section_id', '=', 'sections.id')
            ->where('sections.course_id', $course->id)
            ->where('sections.is_published', true)
            ->where('lessons.is_published', true)
            ->orderBy('sections.order', 'asc')
            ->orderBy('lessons.order', 'asc')
            ->select('lessons.*')
            ->first();

        if (!$firstLesson) {
            return redirect()->route('student.courses.show', $course->id)
                ->with('error', 'এই কোর্সে এখনও কোনো লেসন নেই।');
        }

        return redirect()->route('student.courses.lessons.show', [$course->id, $firstLesson->id]);
    }

    /**
     * মেইন লেসন প্লেয়ার ভিউ (Model Binding Version)
     */
    public function showLesson(Course $course, Lesson $lesson)
    {
        // ১. ম্যানুয়াল ভ্যালিডেশন: লেসনটি আসলেই এই কোর্সের কিনা
        if ($lesson->section->course_id != $course->id) {
            abort(404);
        }

        // ২. লেসনটি পাবলিশ করা আছে কিনা
        if (!$lesson->is_published) {
            abort(404);
        }

        // ৩. এনরোলমেন্ট চেক
        $enrollment = Enrollment::where('user_id', Auth::id())
            ->where('course_id', $course->id)
            ->where('status', 'active')
            ->firstOrFail();

        $enrollment->update(['last_accessed_at' => now()]);

        // ৪. সাইডবারের ডাটা লোড (Eager Loading)
        $course->load(['sections' => function ($q) {
            $q->where('is_published', true)
              ->orderBy('order', 'asc')
              ->with(['lessons' => function ($lq) {
                  $lq->where('is_published', true)
                     ->orderBy('order', 'asc')
                     ->with('quiz');
              }]);
        }]);

        $completedLessonIds = $enrollment->completedLessons()
            ->pluck('lesson_id')
            ->toArray();

        // ৫. নেভিগেশন লজিক (flatMap ব্যবহার করা হয়েছে যা নিরাপদ)
        $allLessons = $course->sections->flatMap(function($section) {
            return $section->lessons->where('is_published', true);
        })->values();
        
        $currentLessonIndex = $allLessons->search(function ($item) use ($lesson) {
            return $item->id === $lesson->id;
        });

        $prevLesson = $currentLessonIndex > 0 ? $allLessons[$currentLessonIndex - 1] : null;
        $nextLesson = $currentLessonIndex < $allLessons->count() - 1 ? $allLessons[$currentLessonIndex + 1] : null;

        $progress = $enrollment->progress;

        return view('student.courses.player', compact(
            'course',
            'lesson',
            'enrollment',
            'completedLessonIds',
            'progress',
            'prevLesson',
            'nextLesson'
        ));
    }

    public function updateProgress(Request $request, Course $course)
    {
        $enrollment = Enrollment::where('user_id', Auth::id())
            ->where('course_id', $course->id)
            ->firstOrFail();

        return response()->json([
            'success' => true,
            'progress' => $enrollment->progress,
            'message' => 'প্রোগ্রেস সিঙ্ক করা হয়েছে!'
        ]);
    }
}