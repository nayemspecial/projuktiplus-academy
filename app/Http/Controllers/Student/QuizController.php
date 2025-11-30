<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Quiz;
use App\Models\QuizAttempt;
use App\Models\Question;
use App\Models\Answer;
use App\Models\Enrollment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class QuizController extends Controller
{
    /**
     * স্টুডেন্টের সব কুইজের তালিকা
     */
    public function index()
    {
        // ইউজার যেসব কোর্সে এনরোল করা আছে, সেই কোর্সের লেসনগুলোর কুইজ খুঁজে বের করা
        $enrollments = Enrollment::where('user_id', Auth::id())->active()->pluck('course_id');
        
        $quizzes = Quiz::whereHas('lesson.section.course', function ($query) use ($enrollments) {
                $query->whereIn('id', $enrollments);
            })
            ->published()
            ->with(['lesson.section.course', 'attempts' => function ($query) {
                $query->where('user_id', Auth::id())->latest();
            }])
            ->paginate(10);

        return view('student.quizzes.index', compact('quizzes'));
    }

    /**
     * কুইজ শুরুর আগের পেজ (Instruction Page)
     */
    public function show(Quiz $quiz)
    {
        $this->authorizeQuizAccess($quiz);

        $previousAttempts = $quiz->attempts()
            ->where('user_id', Auth::id())
            ->orderBy('attempt_number', 'desc')
            ->get();

        $canRetake = $quiz->canRetake(Auth::id());

        return view('student.quizzes.show', compact('quiz', 'previousAttempts', 'canRetake'));
    }

    /**
     * কুইজ শুরু করা (Attempt তৈরি করা এবং প্রশ্ন দেখানো)
     */
    public function start(Request $request, Quiz $quiz)
    {
        $this->authorizeQuizAccess($quiz);

        if (!$quiz->canRetake(Auth::id())) {
            return redirect()->route('student.quizzes.show', $quiz->id)
                ->with('error', 'আপনি আর এই কুইজটি দিতে পারবেন না।');
        }

        // নতুন অ্যাটেম্পট তৈরি করা
        $enrollment = Enrollment::where('user_id', Auth::id())
            ->where('course_id', $quiz->lesson->section->course_id)
            ->firstOrFail();

        $attemptNumber = $quiz->attempts()->where('user_id', Auth::id())->max('attempt_number') + 1;

        $attempt = QuizAttempt::create([
            'user_id' => Auth::id(),
            'quiz_id' => $quiz->id,
            'enrollment_id' => $enrollment->id,
            'attempt_number' => $attemptNumber,
            'started_at' => now(),
        ]);

        // প্রশ্নগুলো লোড করা (শাফলিং অপশন চেক করে)
        $questions = $quiz->questions()
            ->with(['answers' => function ($query) use ($quiz) {
                if ($quiz->shuffle_answers) {
                    $query->inRandomOrder();
                } else {
                    $query->orderBy('order');
                }
            }]);

        if ($quiz->shuffle_questions) {
            $questions = $questions->inRandomOrder()->get();
        } else {
            $questions = $questions->orderBy('order')->get();
        }

        return view('student.quizzes.take', compact('quiz', 'attempt', 'questions'));
    }

    /**
     * কুইজ সাবমিট করা এবং রেজাল্ট ক্যালকুলেশন
     */
    public function submit(Request $request, Quiz $quiz)
    {
        $attempt = QuizAttempt::where('user_id', Auth::id())
            ->where('quiz_id', $quiz->id)
            ->whereNull('completed_at')
            ->latest('started_at')
            ->firstOrFail();

        // সময় শেষ হয়েছে কিনা চেক করা (যদি টাইম লিমিট থাকে)
        if ($quiz->time_limit) {
            $startTime = $attempt->started_at;
            $endTime = $startTime->copy()->addMinutes($quiz->time_limit)->addSeconds(30); // 30s grace period
            
            if (now()->greaterThan($endTime)) {
                // টাইম আউট লজিক
            }
        }

        // উত্তর প্রসেস করা এবং স্কোর হিসাব করা
        $userAnswers = $request->input('answers', []);
        $totalScore = 0;
        $correctAnswersCount = 0;
        $processedAnswers = [];

        foreach ($quiz->questions as $question) {
            $userAnswerId = $userAnswers[$question->id] ?? null;
            $isCorrect = false;
            $earnedPoints = 0;

            if ($userAnswerId) {
                // মাল্টিপল চয়েস (আপাতত সিঙ্গেল কারেক্ট আনসার ধরে নিচ্ছি আপনার মাইগ্রেশন অনুযায়ী)
                $correctAnswer = $question->answers()->where('is_correct', true)->first();
                if ($correctAnswer && $correctAnswer->id == $userAnswerId) {
                    $isCorrect = true;
                    $earnedPoints = $question->points;
                    $correctAnswersCount++;
                }
            }

            $totalScore += $earnedPoints;
            $processedAnswers[] = [
                'question_id' => $question->id,
                'answer_id' => $userAnswerId,
                'is_correct' => $isCorrect,
                'points' => $earnedPoints
            ];
        }

        // ফাইনাল স্কোর পার্সেন্টেজ
        $totalPossiblePoints = $quiz->total_points;
        $scorePercentage = $totalPossiblePoints > 0 ? round(($totalScore / $totalPossiblePoints) * 100) : 0;
        $passed = $scorePercentage >= $quiz->passing_score;

        // অ্যাটেম্পট আপডেট করা
        $attempt->update([
            'score' => $scorePercentage,
            'total_questions' => $quiz->questions()->count(),
            'correct_answers' => $correctAnswersCount,
            'time_taken' => now()->diffInSeconds($attempt->started_at),
            'passed' => $passed,
            'answers' => $processedAnswers, // JSON এ সেভ হবে
            'completed_at' => now(),
        ]);

        return redirect()->route('student.quizzes.result', $quiz->id);
    }

    /**
     * কুইজের ফলাফল দেখানো
     */
    public function result(Quiz $quiz)
    {
        $this->authorizeQuizAccess($quiz);

        $attempt = QuizAttempt::where('user_id', Auth::id())
            ->where('quiz_id', $quiz->id)
            ->whereNotNull('completed_at')
            ->latest('completed_at')
            ->firstOrFail();

        return view('student.quizzes.result', compact('quiz', 'attempt'));
    }

    /**
     * হেল্পার মেথড: ইউজার এই কুইজ দিতে পারবে কিনা চেক করা
     */
    private function authorizeQuizAccess(Quiz $quiz)
    {
        // ১. কুইজ পাবলিশড কিনা
        if (!$quiz->is_published) abort(404);

        // ২. ইউজার কোর্সে এনরোল্ড কিনা
        $isEnrolled = Enrollment::where('user_id', Auth::id())
            ->where('course_id', $quiz->lesson->section->course_id)
            ->active()
            ->exists();

        if (!$isEnrolled) abort(403, 'আপনি এই কোর্সে এনরোল করা নেই।');
    }
}