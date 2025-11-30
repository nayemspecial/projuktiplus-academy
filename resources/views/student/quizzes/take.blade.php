@extends('layouts.student')

@section('title', $quiz->title . ' - কুইজ চলছে')

@section('student-content')
<div x-data="quizApp()" x-init="initTimer()" class="max-w-4xl mx-auto">
    
    <div class="bg-white dark:bg-slate-800 rounded-lg shadow-sm p-4 mb-6 sticky top-0 z-20 border-b border-gray-200 dark:border-slate-700 flex justify-between items-center">
        <div>
            <h2 class="text-lg font-bold text-gray-800 dark:text-white truncate">{{ $quiz->title }}</h2>
            <p class="text-sm text-gray-500 dark:text-gray-400">
                প্রশ্ন: <span x-text="currentQuestionIndex + 1"></span> / {{ $questions->count() }}
            </p>
        </div>
        @if($quiz->time_limit)
        <div class="flex items-center px-4 py-2 bg-blue-50 dark:bg-blue-900/20 rounded-lg" :class="{'bg-red-50 dark:bg-red-900/20 text-red-600': timeRemaining < 60}">
            <i class="fas fa-stopwatch mr-2 text-lg" :class="timeRemaining < 60 ? 'text-red-500' : 'text-blue-500'"></i>
            <span class="text-xl font-mono font-bold" x-text="formattedTime"></span>
        </div>
        @endif
    </div>

    <form id="quizForm" action="{{ route('student.quizzes.submit', $quiz->id) }}" method="POST">
        @csrf
        
        <div class="space-y-8 mb-8">
            @foreach($questions as $index => $question)
            <div x-show="currentQuestionIndex === {{ $index }}" class="bg-white dark:bg-slate-800 rounded-lg shadow p-6 md:p-8">
                <div class="mb-6">
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white mb-4">
                        <span class="inline-block bg-blue-100 dark:bg-blue-900/30 text-blue-600 dark:text-blue-400 text-sm px-2.5 py-0.5 rounded mr-2">
                            প্রশ্ন {{ $index + 1 }}
                        </span>
                        {{ $question->question }}
                    </h3>
                </div>

                <div class="space-y-3">
                    @foreach($question->answers as $answer)
                    <label class="flex items-center p-4 border-2 border-gray-200 dark:border-slate-700 rounded-lg cursor-pointer hover:bg-gray-50 dark:hover:bg-slate-700/50 transition" 
                           :class="{'border-blue-500 bg-blue-50 dark:bg-blue-900/10': answers[{{ $question->id }}] == {{ $answer->id }}}">
                        <input type="radio" 
                               name="answers[{{ $question->id }}]" 
                               value="{{ $answer->id }}" 
                               x-model="answers[{{ $question->id }}]"
                               class="h-5 w-5 text-blue-600 focus:ring-blue-500 border-gray-300 dark:border-slate-600 dark:bg-slate-700">
                        <span class="ml-3 text-gray-700 dark:text-gray-300">{{ $answer->answer }}</span>
                    </label>
                    @endforeach
                </div>
            </div>
            @endforeach
        </div>

        <div class="flex justify-between">
            <button type="button" 
                    @click="prevQuestion" 
                    x-show="currentQuestionIndex > 0" 
                    class="px-6 py-2 border border-gray-300 dark:border-slate-600 text-gray-700 dark:text-gray-300 font-medium rounded-md hover:bg-gray-50 dark:hover:bg-slate-700 transition">
                <i class="fas fa-arrow-left mr-2"></i> পূর্ববর্তী
            </button>
            
            <div class="ml-auto"> <button type="button" 
                        @click="nextQuestion" 
                        x-show="currentQuestionIndex < {{ $questions->count() - 1 }}" 
                        class="px-6 py-2 bg-blue-600 text-white font-medium rounded-md hover:bg-blue-700 transition">
                    পরবর্তী <i class="fas fa-arrow-right ml-2"></i>
                </button>
                
                <button type="submit" 
                        x-show="currentQuestionIndex === {{ $questions->count() - 1 }}" 
                        class="px-8 py-2 bg-green-600 text-white font-medium rounded-md hover:bg-green-700 transition"
                        onclick="return confirm('আপনি কি নিশ্চিত যে আপনি কুইজটি সাবমিট করতে চান?')">
                    <i class="fas fa-check-circle mr-2"></i> সাবমিট করুন
                </button>
            </div>
        </div>

    </form>
</div>

<script>
    function quizApp() {
        return {
            currentQuestionIndex: 0,
            answers: {},
            timeRemaining: {{ $quiz->time_limit ? $quiz->time_limit * 60 : 0 }}, // In seconds
            timer: null,

            initTimer() {
                if (this.timeRemaining > 0) {
                    this.timer = setInterval(() => {
                        this.timeRemaining--;
                        if (this.timeRemaining <= 0) {
                            clearInterval(this.timer);
                            this.submitQuiz();
                        }
                    }, 1000);
                }
            },

            get formattedTime() {
                const minutes = Math.floor(this.timeRemaining / 60);
                const seconds = this.timeRemaining % 60;
                return `${String(minutes).padStart(2, '0')}:${String(seconds).padStart(2, '0')}`;
            },

            nextQuestion() {
                if (this.currentQuestionIndex < {{ $questions->count() - 1 }}) {
                    this.currentQuestionIndex++;
                    window.scrollTo(0, 0);
                }
            },

            prevQuestion() {
                if (this.currentQuestionIndex > 0) {
                    this.currentQuestionIndex--;
                    window.scrollTo(0, 0);
                }
            },

            submitQuiz() {
                alert('সময় শেষ! আপনার কুইজ অটোমেটিক সাবমিট হচ্ছে।');
                document.getElementById('quizForm').submit();
            }
        }
    }
</script>
@endsection