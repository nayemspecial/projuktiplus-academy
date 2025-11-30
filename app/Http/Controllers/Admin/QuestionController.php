<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Question;
use App\Models\Quiz;
use App\Models\Answer;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $questions = Question::with('quiz.lesson.section.course', 'answers')
            ->orderBy('quiz_id')
            ->orderBy('order')
            ->paginate(10);
            
        return view('admin.questions.index', compact('questions'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $quizzes = Quiz::with('lesson.section.course')->get()->mapWithKeys(function ($quiz) {
            return [$quiz->id => $quiz->lesson->section->course->title . ' - ' . $quiz->lesson->title . ' - ' . $quiz->title];
        });
        
        $questionTypes = [
            'multiple_choice' => 'Multiple Choice',
            'true_false' => 'True/False',
            'short_answer' => 'Short Answer',
            'essay' => 'Essay'
        ];
        
        return view('admin.questions.create', compact('quizzes', 'questionTypes'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'quiz_id' => 'required|exists:quizzes,id',
            'question' => 'required|string',
            'type' => 'required|in:multiple_choice,true_false,short_answer,essay',
            'points' => 'required|integer|min:1',
            'explanation' => 'nullable|string',
            'order' => 'nullable|integer',
        ]);

        // Set default order if not provided
        if (!isset($validated['order'])) {
            $lastOrder = Question::where('quiz_id', $validated['quiz_id'])
                ->max('order');
            $validated['order'] = $lastOrder ? $lastOrder + 1 : 1;
        }

        $question = Question::create($validated);

        // If it's multiple choice or true/false, create default answers
        if (in_array($validated['type'], ['multiple_choice', 'true_false'])) {
            $this->createDefaultAnswers($question, $validated['type']);
        }

        return redirect()->route('admin.questions.index')
            ->with('success', 'প্রশ্ন সফলভাবে তৈরি করা হয়েছে।');
    }

    /**
     * Create default answers for the question
     */
    private function createDefaultAnswers(Question $question, $type)
    {
        if ($type === 'multiple_choice') {
            $answers = [
                ['answer' => 'Option 1', 'is_correct' => true, 'order' => 1],
                ['answer' => 'Option 2', 'is_correct' => false, 'order' => 2],
                ['answer' => 'Option 3', 'is_correct' => false, 'order' => 3],
                ['answer' => 'Option 4', 'is_correct' => false, 'order' => 4],
            ];
        } else { // true_false
            $answers = [
                ['answer' => 'True', 'is_correct' => true, 'order' => 1],
                ['answer' => 'False', 'is_correct' => false, 'order' => 2],
            ];
        }

        foreach ($answers as $answerData) {
            $question->answers()->create($answerData);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Question $question)
    {
        $question->load('quiz.lesson.section.course', 'answers');
        return view('admin.questions.show', compact('question'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Question $question)
    {
        $quizzes = Quiz::with('lesson.section.course')->get()->mapWithKeys(function ($quiz) {
            return [$quiz->id => $quiz->lesson->section->course->title . ' - ' . $quiz->lesson->title . ' - ' . $quiz->title];
        });
        
        $questionTypes = [
            'multiple_choice' => 'Multiple Choice',
            'true_false' => 'True/False',
            'short_answer' => 'Short Answer',
            'essay' => 'Essay'
        ];
        
        $question->load('answers');
        
        return view('admin.questions.edit', compact('question', 'quizzes', 'questionTypes'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Question $question)
    {
        $validated = $request->validate([
            'quiz_id' => 'required|exists:quizzes,id',
            'question' => 'required|string',
            'type' => 'required|in:multiple_choice,true_false,short_answer,essay',
            'points' => 'required|integer|min:1',
            'explanation' => 'nullable|string',
            'order' => 'nullable|integer',
        ]);

        $question->update($validated);

        return redirect()->route('admin.questions.index')
            ->with('success', 'প্রশ্ন সফলভাবে আপডেট করা হয়েছে।');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Question $question)
    {
        $question->delete();

        return redirect()->route('admin.questions.index')
            ->with('success', 'প্রশ্ন সফলভাবে ডিলিট করা হয়েছে।');
    }
}