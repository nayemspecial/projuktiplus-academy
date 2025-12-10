@extends('layouts.student')

@section('title', $lesson->title . ' - ' . $course->title)

@push('styles')
    <!-- Plyr CSS -->
    <link rel="stylesheet" href="https://cdn.plyr.io/3.7.8/plyr.css" />
    <style>
        /* Plyr Customization */
        .plyr--video {
            --plyr-color-main: #4F46E5; /* Indigo-600 */
            border-radius: 0.75rem;
            overflow: hidden;
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
        }
        /* Custom Scrollbar for Sidebar */
        .lesson-nav::-webkit-scrollbar { width: 5px; }
        .lesson-nav::-webkit-scrollbar-thumb { background-color: #cbd5e1; border-radius: 4px; }
        .dark .lesson-nav::-webkit-scrollbar-thumb { background-color: #475569; }
    </style>
@endpush

@section('student-content')
    <div x-data="lessonApp()" class="h-[calc(100vh-100px)] flex flex-col">
        
        <!-- 1. Top Bar -->
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 bg-white dark:bg-slate-800 p-4 rounded-xl shadow-sm border border-gray-100 dark:border-slate-700 mb-4 shrink-0">
            <div>
                <div class="flex items-center text-sm text-gray-500 dark:text-gray-400 mb-1">
                    <a href="{{ route('student.courses.index') }}" class="hover:text-blue-600 transition">কোর্স</a>
                    <i class="fas fa-chevron-right text-[10px] mx-2"></i>
                    <a href="{{ route('student.courses.show', $course->id) }}" class="hover:text-blue-600 transition truncate max-w-xs">{{ $course->title }}</a>
                </div>
                <h1 class="text-lg md:text-xl font-bold text-gray-800 dark:text-white line-clamp-1">{{ $lesson->title }}</h1>
            </div>
            
            <div class="flex items-center gap-3">
                <button @click="toggleComplete" 
                        :disabled="loading"
                        class="flex items-center px-4 py-2 rounded-lg text-sm font-bold transition shadow-sm border"
                        :class="isCompleted ? 'bg-green-50 text-green-700 border-green-200 dark:bg-green-900/20 dark:text-green-400 dark:border-green-800' : 'bg-white text-gray-700 border-gray-300 hover:bg-gray-50 dark:bg-slate-700 dark:text-gray-200 dark:border-slate-600 dark:hover:bg-slate-600'">
                    
                    <svg x-show="loading" class="animate-spin -ml-1 mr-2 h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                    </svg>
                    
                    <i x-show="!loading && isCompleted" class="fas fa-check-circle mr-2"></i>
                    <i x-show="!loading && !isCompleted" class="far fa-circle mr-2"></i>
                    <span x-text="isCompleted ? 'সম্পন্ন হয়েছে' : 'সম্পন্ন হিসেবে মার্ক করুন'"></span>
                </button>
            </div>
        </div>

        <!-- 2. Main Player & Sidebar Area -->
        <div class="flex flex-col lg:flex-row gap-6 flex-1 overflow-hidden">
            
            <!-- Left Column: Video & Content -->
            <div class="lg:w-3/4 flex flex-col gap-6 overflow-y-auto pr-2 custom-scrollbar">
                
                <!-- Player Area -->
                <div class="bg-black rounded-xl overflow-hidden shadow-lg aspect-video relative group border border-slate-200 dark:border-slate-700">
                    
                    @if($lesson->type == 'video' && $lesson->video_url)
                        <!-- Video Player (Plyr) -->
                         @if($lesson->video_type == 'youtube' && isset($videoId))
                            <div id="player" data-plyr-provider="youtube" data-plyr-embed-id="{{ $videoId }}"></div>
                        @elseif($lesson->video_type == 'vimeo' && isset($videoId))
                            <div id="player" data-plyr-provider="vimeo" data-plyr-embed-id="{{ $videoId }}"></div>
                        @elseif($lesson->video_type == 'html5' || $lesson->video_url)
                            <video id="player" playsinline controls>
                                <source src="{{ $lesson->video_url }}" type="video/mp4" />
                            </video>
                        @endif

                    @elseif($lesson->type == 'quiz')
                        <!-- Quiz Interface -->
                        <div x-data="quizPlayer({{ $lesson->id }})" class="absolute inset-0 bg-slate-50 dark:bg-slate-800 text-slate-800 dark:text-white flex flex-col overflow-y-auto">
                            
                            <!-- Loading State -->
                            <div x-show="loading" class="flex-1 flex items-center justify-center">
                                <div class="animate-spin rounded-full h-12 w-12 border-b-2 border-indigo-600"></div>
                            </div>

                            <!-- Start Screen -->
                            <div x-show="!loading && !started && !finished" class="flex-1 flex flex-col items-center justify-center p-6 text-center">
                                <div class="w-20 h-20 bg-purple-100 dark:bg-purple-900/30 rounded-full flex items-center justify-center mb-6 text-purple-600">
                                    <i class="fas fa-question text-4xl"></i>
                                </div>
                                <h2 class="text-2xl font-bold mb-2" x-text="quiz.title"></h2>
                                <p class="text-slate-500 mb-6">মোট প্রশ্ন: <span x-text="quiz.questions?.length"></span>টি | সময়: <span x-text="quiz.time_limit"></span> মিনিট</p>
                                
                                <template x-if="previousAttempt">
                                    <div class="mb-6 p-4 bg-yellow-50 dark:bg-yellow-900/20 rounded-lg border border-yellow-200 dark:border-yellow-700">
                                        <p class="text-sm text-yellow-800 dark:text-yellow-200">
                                            পূর্ববর্তী ফলাফল: <span class="font-bold" x-text="previousAttempt.score + '%'"></span> 
                                            (<span x-text="previousAttempt.passed ? 'পাস' : 'ফেল'"></span>)
                                        </p>
                                    </div>
                                </template>

                                <button @click="startQuiz()" class="px-8 py-3 bg-purple-600 hover:bg-purple-700 text-white rounded-xl font-bold transition shadow-lg shadow-purple-500/30 flex items-center gap-2">
                                    <i class="fas fa-play"></i> কুইজ শুরু করুন
                                </button>
                            </div>

                            <!-- Quiz Questions -->
                            <div x-show="started && !finished" class="flex-1 flex flex-col max-w-2xl mx-auto w-full p-6">
                                <div class="flex justify-between items-center mb-6">
                                    <span class="text-sm font-bold text-slate-500">প্রশ্ন <span x-text="currentQuestionIndex + 1"></span>/<span x-text="quiz.questions?.length"></span></span>
                                    <span class="text-sm font-mono bg-slate-200 dark:bg-slate-700 px-3 py-1 rounded text-red-500" x-text="formatTime(timeLeft)"></span>
                                </div>

                                <div class="flex-1">
                                    <h3 class="text-xl font-bold mb-6 leading-relaxed" x-text="currentQuestion.text"></h3>
                                    
                                    <div class="space-y-3">
                                        <template x-for="option in currentQuestion.options" :key="option.id">
                                            <label class="flex items-center p-4 rounded-lg border-2 cursor-pointer transition-all"
                                                   :class="answers[currentQuestion.id] === option.id ? 'border-purple-600 bg-purple-50 dark:bg-purple-900/20' : 'border-slate-200 dark:border-slate-700 hover:border-purple-300'">
                                                <input type="radio" :name="'q_'+currentQuestion.id" :value="option.id" x-model="answers[currentQuestion.id]" class="w-5 h-5 text-purple-600 focus:ring-purple-500 border-gray-300">
                                                <span class="ml-3 font-medium" x-text="option.text"></span>
                                            </label>
                                        </template>
                                    </div>
                                </div>

                                <div class="mt-8 flex justify-between">
                                    <button @click="prevQuestion()" x-show="currentQuestionIndex > 0" class="px-4 py-2 border border-slate-300 dark:border-slate-600 rounded-lg text-sm font-bold hover:bg-slate-100 dark:hover:bg-slate-700 transition">আগের প্রশ্ন</button>
                                    <div class="flex-1"></div>
                                    <button @click="nextQuestion()" x-show="currentQuestionIndex < quiz.questions.length - 1" class="px-6 py-2 bg-indigo-600 hover:bg-indigo-700 text-white rounded-lg text-sm font-bold transition">পরবর্তী</button>
                                    <button @click="submitQuiz()" x-show="currentQuestionIndex === quiz.questions.length - 1" class="px-6 py-2 bg-green-600 hover:bg-green-700 text-white rounded-lg text-sm font-bold transition shadow-lg shadow-green-500/30">জমা দিন</button>
                                </div>
                            </div>

                            <!-- Result Screen -->
                            <div x-show="finished" class="flex-1 flex flex-col items-center justify-center p-6 text-center">
                                <div class="w-24 h-24 rounded-full flex items-center justify-center mb-6 animate-bounce-slow"
                                     :class="result.passed ? 'bg-green-100 dark:bg-green-900/30 text-green-600' : 'bg-red-100 dark:bg-red-900/30 text-red-600'">
                                    <i class="fas text-5xl" :class="result.passed ? 'fa-trophy' : 'fa-times-circle'"></i>
                                </div>
                                <h2 class="text-3xl font-bold mb-2" x-text="result.passed ? 'অভিনন্দন!' : 'দুঃখিত!'"></h2>
                                <p class="text-slate-500 mb-6" x-text="result.passed ? 'আপনি কুইজে পাস করেছেন।' : 'আপনি পাস মার্ক তুলতে পারেননি। আবার চেষ্টা করুন।'"></p>
                                
                                <div class="grid grid-cols-2 gap-4 w-full max-w-sm mb-8">
                                    <div class="p-4 bg-slate-50 dark:bg-slate-700/50 rounded-xl border border-slate-200 dark:border-slate-600">
                                        <p class="text-xs text-slate-500 uppercase font-bold">স্কোর</p>
                                        <p class="text-2xl font-bold" :class="result.passed ? 'text-green-600' : 'text-red-500'" x-text="result.score + '%'"></p>
                                    </div>
                                    <div class="p-4 bg-slate-50 dark:bg-slate-700/50 rounded-xl border border-slate-200 dark:border-slate-600">
                                        <p class="text-xs text-slate-500 uppercase font-bold">সঠিক উত্তর</p>
                                        <p class="text-2xl font-bold text-slate-800 dark:text-white" x-text="result.correct_count + '/' + result.total"></p>
                                    </div>
                                </div>

                                <div class="flex gap-4">
                                    <button @click="location.reload()" class="px-6 py-2 border border-slate-300 dark:border-slate-600 rounded-lg font-bold hover:bg-slate-100 dark:hover:bg-slate-700 transition">আবার চেষ্টা করুন</button>
                                    @if($nextLesson)
                                    <a href="{{ route('student.courses.lessons.show', [$course->id, $nextLesson->id]) }}" class="px-6 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg font-bold transition shadow-lg flex items-center gap-2">
                                        পরবর্তী লেসন <i class="fas fa-arrow-right"></i>
                                    </a>
                                    @endif
                                </div>
                            </div>
                        </div>

                    @else
                        <!-- No Video Placeholder -->
                        <div class="absolute inset-0 flex flex-col items-center justify-center text-white/70 flex-col bg-slate-900">
                            <i class="far fa-file-alt text-5xl mb-3 opacity-50"></i>
                            <p>এই লেসনের জন্য কোনো ভিডিও নেই। টেক্সট কন্টেন্ট দেখুন।</p>
                        </div>
                    @endif
                </div>

                <!-- Navigation Buttons (Prev/Next) -->
                <div class="flex justify-between items-center">
                    @if($prevLesson)
                        <a href="{{ route('student.courses.lessons.show', [$course->id, $prevLesson->id]) }}" class="px-4 py-2 bg-white dark:bg-slate-800 border border-gray-200 dark:border-slate-700 rounded-lg text-sm font-medium hover:bg-gray-50 dark:hover:bg-slate-700 transition">
                            <i class="fas fa-arrow-left mr-2"></i> আগের লেসন
                        </a>
                    @else
                        <button disabled class="px-4 py-2 bg-gray-100 dark:bg-slate-800 border border-gray-200 dark:border-slate-700 rounded-lg text-sm font-medium text-gray-400 cursor-not-allowed">
                            <i class="fas fa-arrow-left mr-2"></i> আগের লেসন
                        </button>
                    @endif

                    @if($nextLesson)
                        <a href="{{ route('student.courses.lessons.show', [$course->id, $nextLesson->id]) }}" class="px-4 py-2 bg-indigo-600 text-white border border-indigo-600 rounded-lg text-sm font-medium hover:bg-indigo-700 transition shadow-lg shadow-indigo-500/30">
                            পরবর্তী লেসন <i class="fas fa-arrow-right ml-2"></i>
                        </a>
                    @else
                        <button disabled class="px-4 py-2 bg-green-600 text-white border border-green-600 rounded-lg text-sm font-medium cursor-default opacity-80">
                            কোর্স সম্পন্ন <i class="fas fa-check ml-2"></i>
                        </button>
                    @endif
                </div>

                <!-- Lesson Content / Description -->
                <div class="bg-white dark:bg-slate-800 p-6 rounded-xl shadow-sm border border-gray-100 dark:border-slate-700">
                    <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-4">বিবরণ</h3>
                    <div class="prose dark:prose-invert max-w-none text-sm text-gray-600 dark:text-gray-300">
                        {!! $lesson->content ?? '<p class="italic">কোনো বিবরণ নেই।</p>' !!}
                    </div>
                </div>
            </div>

            <!-- Right Column: Curriculum Sidebar -->
            <div class="lg:w-1/4 bg-white dark:bg-slate-800 rounded-xl shadow-sm border border-gray-100 dark:border-slate-700 flex flex-col overflow-hidden h-full">
                <div class="p-4 border-b border-gray-100 dark:border-slate-700 bg-gray-50 dark:bg-slate-800/50">
                    <h3 class="font-bold text-gray-800 dark:text-white text-sm">কোর্স কন্টেন্ট</h3>
                    <div class="w-full bg-gray-200 dark:bg-slate-700 rounded-full h-1.5 mt-2">
                        <div class="bg-indigo-600 h-1.5 rounded-full transition-all duration-500" style="width: {{ $enrollment->progress }}%"></div>
                    </div>
                    <p class="text-xs text-gray-500 mt-1 text-right">{{ $enrollment->progress }}% সম্পন্ন</p>
                </div>
                
                <div class="flex-1 overflow-y-auto lesson-nav p-2 space-y-2">
                    @foreach($course->sections as $section)
                        <div x-data="{ open: true }" class="border border-gray-100 dark:border-slate-700 rounded-lg overflow-hidden">
                            <button @click="open = !open" class="w-full flex justify-between items-center p-3 bg-gray-50 dark:bg-slate-700/30 hover:bg-gray-100 dark:hover:bg-slate-700 transition text-left">
                                <span class="font-bold text-xs text-gray-700 dark:text-gray-300 uppercase">{{ $section->title }}</span>
                                <i class="fas fa-chevron-down text-[10px] text-gray-400 transition-transform duration-200" :class="{'rotate-180': !open}"></i>
                            </button>
                            
                            <div x-show="open" class="bg-white dark:bg-slate-800">
                                @foreach($section->lessons as $secLesson)
                                    @php
                                        $isActive = $secLesson->id === $lesson->id;
                                        $isCompleted = in_array($secLesson->id, $completedLessonIds);
                                    @endphp
                                    <a href="{{ route('student.courses.lessons.show', [$course->id, $secLesson->id]) }}" 
                                       class="flex items-start gap-2.5 p-3 border-b border-gray-50 dark:border-slate-700/50 last:border-0 hover:bg-blue-50 dark:hover:bg-slate-700/50 transition
                                              {{ $isActive ? 'bg-blue-50 dark:bg-blue-900/20 border-l-2 border-l-blue-500' : 'border-l-2 border-l-transparent' }}">
                                        
                                        <div class="mt-0.5 flex-shrink-0">
                                            @if($isCompleted)
                                                <i class="fas fa-check-circle text-green-500 text-xs"></i>
                                            @elseif($secLesson->type == 'video')
                                                <i class="far fa-play-circle {{ $isActive ? 'text-blue-600' : 'text-slate-400' }} text-xs"></i>
                                            @elseif($secLesson->type == 'quiz')
                                                <i class="far fa-question-circle text-purple-500 text-xs"></i>
                                            @else
                                                <i class="far fa-file-alt text-orange-500 text-xs"></i>
                                            @endif
                                        </div>
                                        
                                        <div class="flex-1 min-w-0">
                                            <p class="text-xs font-medium truncate {{ $isActive ? 'text-blue-700 dark:text-blue-400' : 'text-gray-600 dark:text-gray-400' }}">
                                                {{ $secLesson->title }}
                                            </p>
                                            <span class="text-[10px] text-gray-400 flex items-center gap-1">
                                                <i class="far fa-clock"></i> {{ $secLesson->video_duration ?? '10:00' }}
                                            </span>
                                        </div>
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
    <!-- Plyr JS -->
    <script src="https://cdn.plyr.io/3.7.8/plyr.polyfilled.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            if(document.getElementById('player')) {
                const player = new Plyr('#player', {
                    controls: ['play-large', 'play', 'progress', 'current-time', 'mute', 'volume', 'captions', 'settings', 'pip', 'airplay', 'fullscreen'],
                    hideControls: true, 
                    youtube: { noCookie: true, rel: 0, showinfo: 0, iv_load_policy: 3, modestbranding: 1 }
                });
            }
        });

        function lessonApp() {
            return {
                isCompleted: @json(in_array($lesson->id, $completedLessonIds)),
                loading: false,

                toggleComplete() {
                    this.loading = true;
                    // রাউট নাম ঠিক করা হয়েছে (কন্ট্রোলারের সাথে মিলিয়ে)
                    fetch("{{ route('student.lessons.complete', $lesson->id) }}", {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'Accept': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                        },
                        body: JSON.stringify({ completed: !this.isCompleted })
                    })
                    .then(res => res.json())
                    .then(data => {
                        if (data.success) {
                            this.isCompleted = data.completed;
                            // অপশনাল: প্রোগ্রেস বার আপডেট করার লজিক এখানে যোগ করা যেতে পারে
                        }
                    })
                    .catch(error => console.error('Error:', error))
                    .finally(() => {
                        this.loading = false;
                    });
                }
            }
        }
        
        // Alpine Logic for Quiz (Merged)
        document.addEventListener('alpine:init', () => {
            Alpine.data('quizPlayer', (lessonId) => ({
                quiz: {},
                loading: true,
                started: false,
                finished: false,
                currentQuestionIndex: 0,
                timeLeft: 0,
                timerInterval: null,
                answers: {},
                previousAttempt: null,
                result: {},

                get currentQuestion() {
                    return this.quiz.questions ? this.quiz.questions[this.currentQuestionIndex] : {};
                },

                init() {
                    fetch(`{{ url('/student/quizzes/data') }}/${lessonId}`)
                        .then(res => res.json())
                        .then(data => {
                            if(data.error) {
                                alert(data.error); return;
                            }
                            this.quiz = data.quiz;
                            this.previousAttempt = data.previous_attempt;
                            this.loading = false;
                        });
                },

                startQuiz() {
                    this.started = true;
                    this.timeLeft = this.quiz.time_limit * 60;
                    this.startTimer();
                },

                startTimer() {
                    this.timerInterval = setInterval(() => {
                        if (this.timeLeft > 0) {
                            this.timeLeft--;
                        } else {
                            this.submitQuiz();
                        }
                    }, 1000);
                },

                formatTime(seconds) {
                    const m = Math.floor(seconds / 60);
                    const s = seconds % 60;
                    return `${m}:${s < 10 ? '0' : ''}${s}`;
                },

                nextQuestion() {
                    if (this.currentQuestionIndex < this.quiz.questions.length - 1) {
                        this.currentQuestionIndex++;
                    }
                },

                prevQuestion() {
                    if (this.currentQuestionIndex > 0) {
                        this.currentQuestionIndex--;
                    }
                },

                submitQuiz() {
                    clearInterval(this.timerInterval);
                    
                    fetch(`{{ url('/student/quizzes') }}/${this.quiz.id}/submit`, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: JSON.stringify({ answers: this.answers })
                    })
                    .then(res => res.json())
                    .then(data => {
                        this.result = data;
                        this.finished = true;
                    });
                },

                nextLesson() {
                    @if($nextLesson)
                        window.location.href = "{{ route('student.courses.lessons.show', [$course->id, $nextLesson->id ?? 0]) }}";
                    @endif
                }
            }));
        });
    </script>
    @endpush

@endsection