<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Answer;
use App\Models\Question;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class AnswerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $answers = Answer::with('question.quiz.lesson.section.course')
            ->orderBy('question_id')
            ->orderBy('order')
            ->paginate(10);
            
        return view('admin.answers.index', compact('answers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $questions = Question::with('quiz.lesson.section.course')->get()->mapWithKeys(function ($question) {
            return [$question->id => $question->quiz->lesson->section->course->title . ' - ' . 
                    $question->quiz->lesson->title . ' - ' . 
                    $question->quiz->title . ' - ' . 
                    Str::limit($question->question, 50)];
        });
        
        return view('admin.answers.create', compact('questions'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'question_id' => 'required|exists:questions,id',
            'answer' => 'required|string',
            'is_correct' => 'boolean',
            'order' => 'nullable|integer',
        ]);

        // Set default order if not provided
        if (!isset($validated['order'])) {
            $lastOrder = Answer::where('question_id', $validated['question_id'])
                ->max('order');
            $validated['order'] = $lastOrder ? $lastOrder + 1 : 1;
        }

        Answer::create($validated);

        return redirect()->route('admin.answers.index')
            ->with('success', 'উত্তর সফলভাবে তৈরি করা হয়েছে।');
    }

    /**
     * Display the specified resource.
     */
    public function show(Answer $answer)
    {
        $answer->load('question.quiz.lesson.section.course');
        return view('admin.answers.show', compact('answer'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Answer $answer)
    {
        $questions = Question::with('quiz.lesson.section.course')->get()->mapWithKeys(function ($question) {
            return [$question->id => $question->quiz->lesson->section->course->title . ' - ' . 
                    $question->quiz->lesson->title . ' - ' . 
                    $question->quiz->title . ' - ' . 
                    Str::limit($question->question, 50)];
        });
        
        return view('admin.answers.edit', compact('answer', 'questions'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Answer $answer)
    {
        $validated = $request->validate([
            'question_id' => 'required|exists:questions,id',
            'answer' => 'required|string',
            'is_correct' => 'boolean',
            'order' => 'nullable|integer',
        ]);

        $answer->update($validated);

        return redirect()->route('admin.answers.index')
            ->with('success', 'উত্তর সফলভাবে আপডেট করা হয়েছে।');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Answer $answer)
    {
        $answer->delete();

        return redirect()->route('admin.answers.index')
            ->with('success', 'উত্তর সফলভাবে ডিলিট করা হয়েছে।');
    }
}