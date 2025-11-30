@extends('layouts.student')

@section('title', 'কুইজ ফলাফল - ' . $quiz->title)

@section('student-content')
<div class="mx-auto">
    <div class="bg-white dark:bg-slate-800 rounded-lg shadow-lg overflow-hidden mb-8">
        
        <div class="p-8 text-center border-b border-gray-200 dark:border-slate-700 {{ $attempt->passed ? 'bg-green-50 dark:bg-green-900/20' : 'bg-red-50 dark:bg-red-900/20' }}">
            @if($attempt->passed)
                <div class="inline-flex items-center justify-center w-20 h-20 bg-green-100 dark:bg-green-900/30 rounded-full mb-4">
                    <i class="fas fa-trophy text-4xl text-green-600 dark:text-green-500"></i>
                </div>
                <h1 class="text-3xl font-bold text-green-700 dark:text-green-400 mb-2">অভিনন্দন! আপনি উত্তীর্ণ হয়েছেন</h1>
            @else
                <div class="inline-flex items-center justify-center w-20 h-20 bg-red-100 dark:bg-red-900/30 rounded-full mb-4">
                    <i class="fas fa-times text-4xl text-red-600 dark:text-red-500"></i>
                </div>
                <h1 class="text-3xl font-bold text-red-700 dark:text-red-400 mb-2">দুঃখিত, আপনি অকৃতকার্য হয়েছেন</h1>
            @endif
            <p class="text-gray-600 dark:text-gray-300">
                আপনার স্কোর: <span class="font-bold text-2xl">{{ $attempt->score }}%</span>
                (পাস মার্ক: {{ $quiz->passing_score }}%)
            </p>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-3 divide-y sm:divide-y-0 sm:divide-x divide-gray-200 dark:border-slate-700 border-b border-gray-200">
            <div class="p-6 text-center">
                <p class="text-sm text-gray-500 dark:text-gray-400 uppercase tracking-wide">মোট প্রশ্ন</p>
                <p class="text-2xl font-semibold text-gray-900 dark:text-white mt-1">{{ $attempt->total_questions }}</p>
            </div>
            <div class="p-6 text-center">
                <p class="text-sm text-gray-500 dark:text-gray-400 uppercase tracking-wide">সঠিক উত্তর</p>
                <p class="text-2xl font-semibold text-green-600 dark:text-green-400 mt-1">{{ $attempt->correct_answers }}</p>
            </div>
            <div class="p-6 text-center">
                <p class="text-sm text-gray-500 dark:text-gray-400 uppercase tracking-wide">ভুল উত্তর</p>
                <p class="text-2xl font-semibold text-red-600 dark:text-red-400 mt-1">{{ $attempt->total_questions - $attempt->correct_answers }}</p>
            </div>
        </div>

        <div class="p-6 md:p-8 flex flex-col sm:flex-row justify-center gap-4 bg-gray-50 dark:bg-slate-800/50">
            <a href="{{ route('student.courses.content', $quiz->lesson->section->course_id) }}" class="inline-flex items-center justify-center px-6 py-3 border border-transparent text-base font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 transition">
                <i class="fas fa-arrow-right mr-2"></i> কোর্সে ফিরে যান
            </a>
            
            @if(!$attempt->passed && $quiz->canRetake(auth()->id()))
                <form action="{{ route('student.quizzes.start', $quiz->id) }}" method="POST">
                    @csrf
                    <button type="submit" class="w-full inline-flex items-center justify-center px-6 py-3 border border-gray-300 dark:border-slate-600 text-base font-medium rounded-md text-gray-700 dark:text-white bg-white dark:bg-slate-700 hover:bg-gray-50 dark:hover:bg-slate-600 transition">
                        <i class="fas fa-redo mr-2"></i> আবার চেষ্টা করুন
                    </button>
                </form>
            @endif
        </div>
    </div>

    @if($quiz->show_correct_answers)
    <div class="bg-white dark:bg-slate-800 rounded-lg shadow-lg overflow-hidden">
        <div class="p-6 border-b border-gray-200 dark:border-slate-700">
            <h3 class="text-xl font-bold text-gray-800 dark:text-white">বিস্তারিত উত্তরপত্র</h3>
        </div>
        <div class="p-6 space-y-8">
            @php
                // JSON থেকে ইউজারের উত্তরগুলো অ্যারে আকারে নেওয়া
                $userAnswers = collect($attempt->answers);
            @endphp

            @foreach($quiz->questions as $index => $question)
                @php
                    // এই প্রশ্নের জন্য ইউজারের দেওয়া উত্তর খুঁজে বের করা
                    $userResponse = $userAnswers->firstWhere('question_id', $question->id);
                    $userAnswerId = $userResponse['answer_id'] ?? null;
                    $isCorrect = $userResponse['is_correct'] ?? false;
                @endphp
                <div class="p-4 rounded-lg border {{ $isCorrect ? 'border-green-200 dark:border-green-800 bg-green-50 dark:bg-green-900/10' : 'border-red-200 dark:border-red-800 bg-red-50 dark:bg-red-900/10' }}">
                    <div class="flex items-start mb-4">
                        <span class="inline-flex items-center justify-center h-6 w-6 rounded-full text-sm font-medium mr-3 {{ $isCorrect ? 'bg-green-100 text-green-800 dark:bg-green-800 dark:text-green-100' : 'bg-red-100 text-red-800 dark:bg-red-800 dark:text-red-100' }}">
                            {{ $index + 1 }}
                        </span>
                        <div>
                            <h4 class="text-lg font-medium text-gray-900 dark:text-white">{{ $question->question }}</h4>
                            <p class="text-sm mt-1 {{ $isCorrect ? 'text-green-600 dark:text-green-400' : 'text-red-600 dark:text-red-400' }}">
                                @if($isCorrect)
                                    <i class="fas fa-check-circle mr-1"></i> সঠিক উত্তর
                                @else
                                    <i class="fas fa-times-circle mr-1"></i> ভুল উত্তর
                                @endif
                            </p>
                        </div>
                    </div>

                    <div class="space-y-2 ml-9">
                        @foreach($question->answers as $answer)
                            @php
                                $isUserSelected = $userAnswerId == $answer->id;
                                $isActuallyCorrect = $answer->is_correct;
                                
                                $optionClass = 'border-gray-200 dark:border-slate-700 bg-white dark:bg-slate-800';
                                $icon = '';

                                if ($isUserSelected && $isActuallyCorrect) {
                                    // ইউজার সঠিক উত্তর দিয়েছে
                                    $optionClass = 'border-green-500 bg-green-100 dark:bg-green-900/30 dark:border-green-500 text-green-900 dark:text-white';
                                    $icon = '<i class="fas fa-check text-green-600 dark:text-green-400 ml-auto"></i>';
                                } elseif ($isUserSelected && !$isActuallyCorrect) {
                                    // ইউজার ভুল উত্তর দিয়েছে
                                    $optionClass = 'border-red-500 bg-red-100 dark:bg-red-900/30 dark:border-red-500 text-red-900 dark:text-white';
                                    $icon = '<i class="fas fa-times text-red-600 dark:text-red-400 ml-auto"></i>';
                                } elseif ($isActuallyCorrect) {
                                    // এটি সঠিক উত্তর কিন্তু ইউজার সিলেক্ট করেনি
                                    $optionClass = 'border-green-500 bg-white dark:bg-slate-800 dark:border-green-400';
                                    $icon = '<i class="fas fa-check text-green-500 ml-auto"></i>';
                                }
                            @endphp
                            <div class="flex items-center p-3 border-2 rounded-md {{ $optionClass }}">
                                <span class="flex-1 {{ $isActuallyCorrect ? 'font-medium' : '' }}">{{ $answer->answer }}</span>
                                {!! $icon !!}
                            </div>
                        @endforeach
                    </div>

                    @if($question->explanation && ($isCorrect || $quiz->show_correct_answers))
                        <div class="mt-4 ml-9 p-3 bg-blue-50 dark:bg-blue-900/20 rounded-md text-sm text-blue-800 dark:text-blue-300">
                            <span class="font-bold"><i class="fas fa-info-circle mr-1"></i> ব্যাখ্যা:</span> {{ $question->explanation }}
                        </div>
                    @endif
                </div>
            @endforeach
        </div>
    </div>
    @endif

</div>
@endsection