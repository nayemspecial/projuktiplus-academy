@extends('layouts.student')

@section('title', $lesson->title . ' - ' . $course->title)

@section('student-content')
    <div x-data="lessonApp()" class="space-y-6">
        
        <!-- 1. Top Bar: Course Title & Navigation -->
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 bg-white dark:bg-slate-800 p-4 rounded-xl shadow-sm border border-gray-100 dark:border-slate-700">
            <div>
                <div class="flex items-center text-sm text-gray-500 dark:text-gray-400 mb-1">
                    <a href="{{ route('student.courses.index') }}" class="hover:text-blue-600 transition">কোর্স</a>
                    <i class="fas fa-chevron-right text-[10px] mx-2"></i>
                    <span class="truncate max-w-xs">{{ $course->title }}</span>
                </div>
                <h1 class="text-xl font-bold text-gray-800 dark:text-white line-clamp-1">{{ $lesson->title }}</h1>
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

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 h-[calc(100vh-200px)] min-h-[600px]">
            
            <!-- Left Column: Video & Content (Scrollable) -->
            <div class="lg:col-span-2 flex flex-col gap-6 overflow-y-auto pr-2 custom-scrollbar">
                
                <!-- Video Player -->
                <div class="bg-black rounded-xl overflow-hidden shadow-lg aspect-video relative group">
                    @if($lesson->video_type == 'youtube' || $lesson->video_type == 'vimeo')
                         <iframe src="{{ $lesson->video_embed_url }}" class="w-full h-full absolute inset-0" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                    @elseif($lesson->video_type == 'html5')
                        <video controls controlsList="nodownload" class="w-full h-full absolute inset-0" oncontextmenu="return false;">
                            <source src="{{ $lesson->video_url }}" type="video/mp4">
                            আপনার ব্রাউজার ভিডিও ট্যাগ সমর্থন করে না।
                        </video>
                    @else
                        <div class="absolute inset-0 flex items-center justify-center text-white/70 flex-col bg-gray-900">
                            <i class="far fa-file-alt text-5xl mb-3 opacity-50"></i>
                            <p>এই লেসনের জন্য কোনো ভিডিও নেই।</p>
                        </div>
                    @endif
                </div>

                <!-- Lesson Details -->
                <div class="bg-white dark:bg-slate-800 p-6 rounded-xl shadow-sm border border-gray-100 dark:border-slate-700">
                    <!-- Navigation Buttons -->
                    <div class="flex justify-between items-center mb-6 pb-6 border-b border-gray-100 dark:border-slate-700">
                        @if($prevLesson)
                        <a href="{{ route('student.courses.lessons.show', [$course->id, $prevLesson->id]) }}" class="flex items-center text-sm font-medium text-gray-600 dark:text-gray-400 hover:text-blue-600 dark:hover:text-blue-400 transition">
                            <i class="fas fa-long-arrow-alt-left mr-2"></i> পূর্ববর্তী
                        </a>
                        @else
                        <div></div>
                        @endif

                        @if($nextLesson)
                        <a href="{{ route('student.courses.lessons.show', [$course->id, $nextLesson->id]) }}" class="flex items-center text-sm font-medium text-gray-600 dark:text-gray-400 hover:text-blue-600 dark:hover:text-blue-400 transition">
                            পরবর্তী <i class="fas fa-long-arrow-alt-right ml-2"></i>
                        </a>
                        @endif
                    </div>

                    <!-- Description -->
                    <div class="prose dark:prose-invert max-w-none mb-8 text-gray-600 dark:text-gray-300 text-sm leading-relaxed">
                        @if($lesson->content)
                            {!! $lesson->content !!}
                        @else
                            <p class="italic opacity-60">কোনো বিবরণ নেই।</p>
                        @endif
                    </div>

                    <!-- Attachments -->
                    @if(!empty($lesson->attachments))
                    <div class="bg-indigo-50 dark:bg-slate-700/30 border border-indigo-100 dark:border-slate-600 rounded-lg p-4">
                        <h3 class="text-sm font-bold text-gray-800 dark:text-white mb-3 flex items-center">
                            <i class="fas fa-paperclip mr-2 text-indigo-500"></i> রিসোর্স ফাইল
                        </h3>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                            @foreach($lesson->attachments as $attachment)
                            <a href="{{ asset('storage/'.($attachment['path'] ?? '#')) }}" target="_blank" class="flex items-center p-2 bg-white dark:bg-slate-800 border border-gray-200 dark:border-slate-600 rounded hover:border-indigo-500 dark:hover:border-indigo-500 transition group">
                                <div class="h-8 w-8 rounded bg-indigo-100 dark:bg-indigo-900/40 text-indigo-600 dark:text-indigo-400 flex items-center justify-center mr-3">
                                    <i class="far fa-file text-sm"></i>
                                </div>
                                <div class="overflow-hidden flex-1">
                                    <h4 class="text-xs font-medium text-gray-700 dark:text-gray-200 truncate">{{ $attachment['name'] ?? 'ফাইল' }}</h4>
                                    <p class="text-[10px] text-gray-500 dark:text-gray-400">{{ $attachment['size'] ?? '' }}</p>
                                </div>
                                <i class="fas fa-download ml-2 text-xs text-gray-400 group-hover:text-indigo-600 transition"></i>
                            </a>
                            @endforeach
                        </div>
                    </div>
                    @endif
                </div>
            </div>

            <!-- Right Column: Course Curriculum (Sidebar Style) -->
            <div class="lg:col-span-1 bg-white dark:bg-slate-800 rounded-xl shadow-sm border border-gray-100 dark:border-slate-700 flex flex-col overflow-hidden h-full">
                
                <div class="p-4 border-b border-gray-100 dark:border-slate-700 bg-gray-50/50 dark:bg-slate-800">
                    <h3 class="font-bold text-gray-800 dark:text-white mb-1">কোর্স কন্টেন্ট</h3>
                    <div class="flex justify-between items-center text-xs text-gray-500 dark:text-gray-400">
                        <span>{{ $progress }}% সম্পন্ন</span>
                        <span>{{ count($completedLessonIds) }}/{{ $course->lessons->count() }} লেসন</span>
                    </div>
                    <div class="w-full bg-gray-200 dark:bg-slate-700 rounded-full h-1.5 mt-2">
                        <div class="bg-blue-600 dark:bg-blue-500 h-1.5 rounded-full transition-all duration-500" :style="`width: ${progress}%`"></div>
                    </div>
                </div>

                <div class="flex-1 overflow-y-auto custom-scrollbar p-2 space-y-2">
                    @foreach($course->sections as $section)
                    <div x-data="{ open: {{ $section->lessons->contains('id', $lesson->id) ? 'true' : 'false' }} }" class="rounded-lg border border-gray-100 dark:border-slate-700 overflow-hidden">
                        
                        <button @click="open = !open" class="w-full px-4 py-3 flex items-center justify-between bg-gray-50 dark:bg-slate-700/50 hover:bg-gray-100 dark:hover:bg-slate-700 transition">
                            <span class="text-xs font-bold text-gray-700 dark:text-gray-300 text-left line-clamp-1">{{ $section->title }}</span>
                            <i class="fas fa-chevron-down text-[10px] text-gray-400 transition-transform duration-200" :class="{'rotate-180': open}"></i>
                        </button>

                        <div x-show="open" x-collapse class="bg-white dark:bg-slate-800">
                            @foreach($section->lessons as $secLesson)
                                @php
                                    $isActive = $secLesson->id === $lesson->id;
                                    $isCompleted = in_array($secLesson->id, $completedLessonIds);
                                @endphp

                                <a href="{{ $secLesson->quiz ? route('student.quizzes.show', $secLesson->quiz->id) : route('student.courses.lessons.show', [$course->id, $secLesson->id]) }}" 
                                   class="block px-4 py-2.5 border-l-[3px] transition-all hover:bg-blue-50 dark:hover:bg-slate-700/50 {{ $isActive ? 'border-blue-500 bg-blue-50 dark:bg-slate-700/50' : 'border-transparent' }}">
                                    
                                    <div class="flex items-start gap-2.5">
                                        <div class="mt-0.5 flex-shrink-0">
                                            @if($isCompleted)
                                                <i class="fas fa-check-circle text-green-500 text-xs"></i>
                                            @elseif($isActive)
                                                <div class="w-3 h-3 rounded-full bg-blue-500 flex items-center justify-center">
                                                    <div class="w-1 h-1 bg-white rounded-full animate-pulse"></div>
                                                </div>
                                            @elseif($secLesson->quiz)
                                                <i class="fas fa-question-circle text-purple-500 text-xs"></i>
                                            @else
                                                <i class="far fa-circle text-gray-300 dark:text-slate-600 text-xs"></i>
                                            @endif
                                        </div>
                                        
                                        <div class="flex-1 min-w-0">
                                            <p class="text-xs {{ $isActive ? 'font-bold text-blue-700 dark:text-blue-300' : 'text-gray-600 dark:text-gray-400' }} line-clamp-2 leading-snug">
                                                {{ $secLesson->title }}
                                            </p>
                                            <div class="flex items-center gap-2 mt-1">
                                                @if($secLesson->video_duration)
                                                    <span class="text-[10px] text-gray-400 flex items-center">
                                                        <i class="far fa-clock mr-1"></i> {{ $secLesson->video_duration }}
                                                    </span>
                                                @endif
                                                @if($secLesson->quiz)
                                                    <span class="text-[9px] font-bold bg-purple-100 text-purple-700 px-1.5 py-0.5 rounded">কুইজ</span>
                                                @endif
                                            </div>
                                        </div>
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

    <style>
        /* Custom Scrollbar for Content Areas */
        .custom-scrollbar::-webkit-scrollbar { width: 4px; }
        .custom-scrollbar::-webkit-scrollbar-track { background: transparent; }
        .custom-scrollbar::-webkit-scrollbar-thumb { background-color: #cbd5e1; border-radius: 4px; }
        .dark .custom-scrollbar::-webkit-scrollbar-thumb { background-color: #475569; }
        .custom-scrollbar::-webkit-scrollbar-thumb:hover { background-color: #94a3b8; }
    </style>

    <script>
        function lessonApp() {
            return {
                isCompleted: @json(in_array($lesson->id, $completedLessonIds)),
                progress: {{ $enrollment->progress }},
                loading: false,

                toggleComplete() {
                    this.loading = true;
                    
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
                            this.progress = data.progress;
                            // আপনি চাইলে এখানে টোস্ট মেসেজ দেখাতে পারেন
                        }
                    })
                    .catch(error => console.error('Error:', error))
                    .finally(() => {
                        this.loading = false;
                    });
                }
            }
        }
    </script>
@endsection