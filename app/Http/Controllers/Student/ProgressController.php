<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Enrollment;
use App\Models\CompletedLesson;
use App\Models\QuizAttempt;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ProgressController extends Controller
{
    /**
     * Show the main progress overview page.
     */
    public function index()
    {
        $userId = Auth::id();

        // ১. সব এনরোলমেন্ট (কোর্স ও লেসন রিলেশন সহ)
        $enrollments = Enrollment::where('user_id', $userId)
            ->with(['course.sections.lessons', 'course.instructor'])
            ->get();

        // যদি কোনো এনরোলমেন্ট না থাকে
        if ($enrollments->isEmpty()) {
            return view('student.progress.index', [
                'courseStats' => [
                    'total_lessons' => 0, 'completed' => 0, 'percentage' => 0, 
                    'daily_goal' => 3, 'today_completed' => 0, 'current_streak' => 0
                ],
                'lessonMap' => [],
                'stats' => null
            ]);
        }

        // ২. সামগ্রিক পরিসংখ্যান
        $totalCourses = $enrollments->count();
        $completedCourses = $enrollments->where('status', 'completed')->count();
        $averageProgress = round($enrollments->avg('progress') ?? 0);
        
        // [FIXED] Enrollment IDs বের করা হচ্ছে CompletedLesson কুয়েরির জন্য
        $enrollmentIds = $enrollments->pluck('id');

        // কমপ্লিটেড লেসন আইডি বের করা (Enrollment ID দিয়ে)
        $completedLessonIds = CompletedLesson::whereIn('enrollment_id', $enrollmentIds)
            ->pluck('lesson_id')
            ->toArray();
            
        $completedLessonsCount = count($completedLessonIds);
        
        // মোট লেসন কাউন্ট
        $totalLessons = 0;
        foreach ($enrollments as $enrollment) {
            $totalLessons += $enrollment->course->lessons_count 
                             ?? $enrollment->course->sections->sum(fn($sec) => $sec->lessons->count());
        }

        // ৩. মোট সময় (Time Spent) - Enrollment ID দিয়ে
        $totalTimeSpentSeconds = CompletedLesson::whereIn('enrollment_id', $enrollmentIds)
            ->sum('time_spent') ?? 0;
        $totalHoursSpent = round($totalTimeSpentSeconds / 3600, 1);

        // ৪. কুইজ পরিসংখ্যান (QuizAttempt মডেলে user_id থাকলে এটি ঠিক আছে)
        $quizAttempts = QuizAttempt::where('user_id', $userId)->get();
        $totalQuizzesTaken = $quizAttempts->count();
        $passedQuizzes = $quizAttempts->where('passed', true)->count();
        $averageQuizScore = $totalQuizzesTaken > 0 ? round($quizAttempts->avg('score')) : 0;

        // ৫. গ্যামিফিকেশন স্ট্যাটস (Streak & Daily Goal) - Enrollment ID দিয়ে
        
        // আজকের কমপ্লিটেড
        $todayCompleted = CompletedLesson::whereIn('enrollment_id', $enrollmentIds)
            ->whereDate('created_at', Carbon::today())
            ->count();

        // স্ট্রিক ক্যালকুলেশন
        $activityDates = CompletedLesson::whereIn('enrollment_id', $enrollmentIds)
            ->select(DB::raw('DATE(created_at) as date'))
            ->distinct()
            ->orderBy('date', 'desc')
            ->pluck('date')
            ->toArray();

        $currentStreak = 0;
        if (!empty($activityDates)) {
            $checkDate = Carbon::now();
            if (in_array($checkDate->toDateString(), $activityDates)) {
                $currentStreak++;
                $checkDate->subDay();
            } elseif (in_array($checkDate->copy()->subDay()->toDateString(), $activityDates)) {
                $checkDate->subDay();
            } else {
                $checkDate = null; 
            }

            if ($checkDate) {
                while (in_array($checkDate->toDateString(), $activityDates)) {
                    $currentStreak++;
                    $checkDate->subDay();
                }
            }
        }

        // ৬. লেসন ম্যাপ জেনারেশন
        $lessonMap = [];
        $globalIndex = 1;
        $foundCurrent = false; 

        foreach ($enrollments as $enrollment) {
            if ($enrollment->course && $enrollment->course->sections) {
                foreach ($enrollment->course->sections as $section) {
                    foreach ($section->lessons as $lesson) {
                        $isCompleted = in_array($lesson->id, $completedLessonIds);
                        
                        $status = 'locked';
                        if ($isCompleted) {
                            $status = 'completed';
                        } elseif (!$foundCurrent) {
                            $status = 'current';
                            $foundCurrent = true; 
                        }

                        $type = 'video'; 
                        if (isset($lesson->type)) {
                            if ($lesson->type == 'quiz') $type = 'quiz';
                            elseif ($lesson->type == 'assignment' || $lesson->type == 'text') $type = 'assignment';
                        }

                        $score = null;
                        if ($type == 'quiz' && $status == 'completed') {
                            $attempt = $quizAttempts->where('quiz_id', $lesson->quiz_id ?? 0)->first();
                            $score = $attempt ? $attempt->score : null;
                        }

                        $lessonMap[] = [
                            'id' => $globalIndex++, 
                            'real_id' => $lesson->id,
                            'title' => $lesson->title,
                            'course_title' => $enrollment->course->title,
                            'type' => $type, 
                            'status' => $status, 
                            'duration' => $lesson->duration ?? '10:00',
                            'score' => $score
                        ];
                    }
                }
            }
        }

        $courseStats = [
            'total_lessons' => $totalLessons,
            'completed' => $completedLessonsCount,
            'percentage' => $totalLessons > 0 ? round(($completedLessonsCount / $totalLessons) * 100) : 0,
            'daily_goal' => 3, 
            'today_completed' => $todayCompleted,
            'current_streak' => $currentStreak
        ];

        $stats = [
            'totalCourses' => $totalCourses,
            'completedCourses' => $completedCourses,
            'averageProgress' => $averageProgress,
            'totalLessons' => $totalLessons,
            'completedLessons' => $completedLessonsCount,
            'totalHoursSpent' => $totalHoursSpent,
            'totalQuizzesTaken' => $totalQuizzesTaken,
            'passedQuizzes' => $passedQuizzes,
            'averageQuizScore' => $averageQuizScore,
        ];

        return view('student.progress.index', compact('courseStats', 'lessonMap', 'stats'));
    }
}