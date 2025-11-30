<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Enrollment;
use App\Models\CompletedLesson;
use App\Models\QuizAttempt;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DB;

class ProgressController extends Controller
{
    /**
     * Show the main progress overview page.
     */
    public function index()
    {
        $userId = Auth::id();

        // ১. সব এনরোলমেন্ট (কোর্স ও লেসন কাউন্ট সহ)
        $enrollments = Enrollment::where('user_id', $userId)
            ->with('course')
            ->get();

        if ($enrollments->isEmpty()) {
            return view('student.progress.index', ['stats' => null, 'coursesProgress' => collect()]);
        }

        // ২. সামগ্রিক পরিসংখ্যান
        $totalCourses = $enrollments->count();
        $completedCourses = $enrollments->where('status', 'completed')->count();
        $averageProgress = round($enrollments->avg('progress'));
        $totalLessons = $enrollments->sum('total_lessons');
        $completedLessons = $enrollments->sum('completed_lessons');

        // ৩. মোট সময় (যদি CompletedLesson মডেলে time_spent ট্র্যাক করা হয়)
        // এই কুয়েরিটি অপ্টিমাইজ করা প্রয়োজন হতে পারে যদি 'time_spent' লেসন মডেলে থাকে
        $totalTimeSpentSeconds = CompletedLesson::whereHas('enrollment', function ($q) use ($userId) {
            $q->where('user_id', $userId);
        })->sum('time_spent'); // time_spent সেকেন্ডে আছে ধরা হচ্ছে
        
        $totalHoursSpent = round($totalTimeSpentSeconds / 3600, 1);

        // ৪. কুইজ পরিসংখ্যান
        $quizAttempts = QuizAttempt::where('user_id', $userId)->get();
        $totalQuizzesTaken = $quizAttempts->count();
        $passedQuizzes = $quizAttempts->where('passed', true)->count();
        $averageQuizScore = $totalQuizzesTaken > 0 ? round($quizAttempts->avg('score')) : 0;


        // সব পরিসংখ্যান একটি অ্যারেতে গুছিয়ে নেওয়া
        $stats = [
            'totalCourses' => $totalCourses,
            'completedCourses' => $completedCourses,
            'averageProgress' => $averageProgress,
            'totalLessons' => $totalLessons,
            'completedLessons' => $completedLessons,
            'totalHoursSpent' => $totalHoursSpent,
            'totalQuizzesTaken' => $totalQuizzesTaken,
            'passedQuizzes' => $passedQuizzes,
            'averageQuizScore' => $averageQuizScore,
        ];

        // ভিউতে পাঠানো
        return view('student.progress.index', [
            'stats' => $stats,
            'coursesProgress' => $enrollments->sortByDesc('progress') // কোর্সগুলো প্রোগ্রেস অনুযায়ী সাজিয়ে পাঠানো
        ]);
    }
}