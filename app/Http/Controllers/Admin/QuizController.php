<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Quiz;
use App\Models\Lesson;
use Illuminate\Http\Request;

class QuizController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $quizzes = Quiz::with('lesson.section.course')
            ->orderBy('created_at', 'desc')
            ->paginate(10);
            
        return view('admin.quizzes.index', compact('quizzes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $lessons = Lesson::with('section.course')->get()->mapWithKeys(function ($lesson) {
            return [$lesson->id => $lesson->section->course->title . ' - ' . $lesson->section->title . ' - ' . $lesson->title];
        });
        
        return view('admin.quizzes.create', compact('lessons'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'lesson_id' => 'required|exists:lessons,id',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'time_limit' => 'nullable|integer|min:0',
            'passing_score' => 'required|integer|min:0|max:100',
            'max_attempts' => 'required|integer|min:0',
            'is_published' => 'boolean',
            'shuffle_questions' => 'boolean',
            'shuffle_answers' => 'boolean',
            'show_correct_answers' => 'boolean',
        ]);

        // Set published_at if published
        if ($validated['is_published'] ?? false) {
            $validated['published_at'] = now();
        }

        Quiz::create($validated);

        return redirect()->route('admin.quizzes.index')
            ->with('success', 'কুইজ সফলভাবে তৈরি করা হয়েছে।');
    }

    /**
     * Display the specified resource.
     */
    public function show(Quiz $quiz)
    {
        $quiz->load('lesson.section.course', 'questions.answers');
        return view('admin.quizzes.show', compact('quiz'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Quiz $quiz)
    {
        $lessons = Lesson::with('section.course')->get()->mapWithKeys(function ($lesson) {
            return [$lesson->id => $lesson->section->course->title . ' - ' . $lesson->section->title . ' - ' . $lesson->title];
        });
        
        return view('admin.quizzes.edit', compact('quiz', 'lessons'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Quiz $quiz)
    {
        $validated = $request->validate([
            'lesson_id' => 'required|exists:lessons,id',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'time_limit' => 'nullable|integer|min:0',
            'passing_score' => 'required|integer|min:0|max:100',
            'max_attempts' => 'required|integer|min:0',
            'is_published' => 'boolean',
            'shuffle_questions' => 'boolean',
            'shuffle_answers' => 'boolean',
            'show_correct_answers' => 'boolean',
        ]);

        // Set published_at if being published now
        if (($validated['is_published'] ?? false) && !$quiz->is_published) {
            $validated['published_at'] = now();
        }

        $quiz->update($validated);

        return redirect()->route('admin.quizzes.index')
            ->with('success', 'কুইজ সফলভাবে আপডেট করা হয়েছে।');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Quiz $quiz)
    {
        $quiz->delete();

        return redirect()->route('admin.quizzes.index')
            ->with('success', 'কুইজ সফলভাবে ডিলিট করা হয়েছে।');
    }
}