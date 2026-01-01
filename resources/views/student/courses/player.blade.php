@extends('layouts.student')

@section('title', $lesson->title . ' - ' . $course->title)

@push('styles')
    <link rel="stylesheet" href="https://cdn.plyr.io/3.7.8/plyr.css" />
    <style>
        /* --- Custom Player Theme --- */
        :root {
            --plyr-color-main: #2563eb; /* Blue-600 */
            --plyr-video-background: #0f172a; /* Slate-900 */
            --plyr-menu-background: rgba(255, 255, 255, 0.95);
            --plyr-menu-color: #334155;
        }
        
        .dark {
            --plyr-menu-background: rgba(30, 41, 59, 0.95);
            --plyr-menu-color: #e2e8f0;
        }

        .plyr {
            border-radius: 0.5rem;
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
        }
        
        /* Mobile responsive radius */
        @media (min-width: 1024px) {
            .plyr { border-radius: 0.75rem; }
        }

        /* --- Security Overlays --- */
        .video-overlay-top {
            position: absolute; top: 0; left: 0; width: 100%; height: 60px;
            z-index: 20; background: transparent; cursor: default;
        }
        .video-overlay-right {
            position: absolute; top: 0; right: 0; width: 80px; height: 70px;
            z-index: 21; background: transparent; cursor: default;
        }

        /* --- Custom Scrollbar (Desktop Only) --- */
        @media (min-width: 1024px) {
            .custom-scrollbar::-webkit-scrollbar { width: 5px; }
            .custom-scrollbar::-webkit-scrollbar-track { background: transparent; }
            .custom-scrollbar::-webkit-scrollbar-thumb { background-color: #cbd5e1; border-radius: 10px; }
            .dark .custom-scrollbar::-webkit-scrollbar-thumb { background-color: #475569; }
            .custom-scrollbar::-webkit-scrollbar-thumb:hover { background-color: #94a3b8; }
        }
    </style>
@endpush

@section('student-content')
    <div x-data="lessonApp()" class="flex flex-col lg:flex-row gap-6 p-3 md:p-6 max-w-[1920px] mx-auto lg:h-[calc(100vh-80px)]">
        
        <div class="w-full lg:flex-1 flex flex-col min-w-0 lg:h-full lg:overflow-hidden">
            
            <div class="bg-black rounded-lg lg:rounded-xl overflow-hidden shadow-lg lg:shadow-2xl relative group shrink-0 w-full">
                <div class="aspect-video w-full relative">
                    
                    @if($lesson->video_type == 'google_drive')
                        <iframe 
                            src="https://drive.google.com/file/d/{{ $lesson->video_url }}/preview" 
                            class="w-full h-full absolute inset-0 border-0"
                            allow="autoplay; encrypted-media" 
                            allowfullscreen>
                        </iframe>
                        <div class="video-overlay-top" title="Protected Content"></div>
                        <div class="video-overlay-right" title="Protected Content"></div>

                    @elseif($lesson->video_type == 'youtube' || $lesson->video_type == 'vimeo')
                        <div id="player" class="plyr__video-embed w-full h-full">
                            <iframe
                                src="{{ $lesson->video_embed_url }}"
                                allowfullscreen
                                allowtransparency
                                allow="autoplay"
                            ></iframe>
                        </div>
                        <div class="video-overlay-top"></div>

                    @elseif($lesson->video_type == 'html5')
                        <video id="player" playsinline controls data-poster="{{ $course->thumbnail_url }}">
                            <source src="{{ $lesson->video_url }}" type="video/mp4" />
                        </video>

                    @else
                        <div class="absolute inset-0 flex flex-col items-center justify-center text-slate-500 bg-slate-900">
                            <i class="far fa-play-circle text-4xl lg:text-6xl mb-3 opacity-50"></i>
                            <p class="text-xs lg:text-base">ভিডিওটি প্রসেস করা হচ্ছে।</p>
                        </div>
                    @endif
                </div>
            </div>

            <div class="mt-4 flex flex-col gap-3 pb-4 border-b border-slate-200 dark:border-slate-700 shrink-0">
                <div class="flex justify-between items-start gap-4">
                    <div>
                        <h1 class="text-lg md:text-2xl font-bold text-slate-800 dark:text-white leading-tight line-clamp-2">
                            {{ $lesson->title }}
                        </h1>
                        <p class="text-xs md:text-sm text-slate-500 dark:text-slate-400 mt-1 line-clamp-1">
                            {{ $course->title }} &bull; {{ $lesson->section->title }}
                        </p>
                    </div>
                    
                    <button @click="toggleComplete" 
                            :disabled="loading"
                            class="lg:hidden p-3 rounded-full shadow-sm border transition-colors shrink-0"
                            :class="isCompleted 
                                ? 'bg-green-100 text-green-600 border-green-200 dark:bg-green-900/30 dark:border-green-800' 
                                : 'bg-slate-100 text-slate-600 border-slate-200 dark:bg-slate-800 dark:text-slate-300 dark:border-slate-700'">
                        <i class="text-lg" :class="isCompleted ? 'fas fa-check' : 'far fa-circle'"></i>
                    </button>
                </div>

                <div class="hidden lg:flex items-center justify-end">
                    <button @click="toggleComplete" 
                            :disabled="loading"
                            class="flex items-center px-5 py-2.5 rounded-lg text-sm font-bold transition-all shadow-sm border transform active:scale-95"
                            :class="isCompleted 
                                ? 'bg-green-100 text-green-700 border-green-200 dark:bg-green-900/30 dark:text-green-400 dark:border-green-800' 
                                : 'bg-slate-800 text-white border-transparent hover:bg-slate-700 dark:bg-white dark:text-slate-900 dark:hover:bg-slate-200'">
                        <span x-show="loading" class="animate-spin mr-2"><i class="fas fa-spinner"></i></span>
                        <i x-show="!loading" class="mr-2" :class="isCompleted ? 'fas fa-check-circle' : 'far fa-circle'"></i>
                        <span x-text="isCompleted ? 'সম্পন্ন হয়েছে' : 'মার্ক কমপ্লিট'"></span>
                    </button>
                </div>
            </div>

            <div class="lg:flex-1 lg:overflow-y-auto custom-scrollbar mt-4 pr-1 space-y-6">
                
                <div class="flex justify-between items-center gap-2">
                    @if($prevLesson)
                    <a href="{{ route('student.courses.lessons.show', [$course->id, $prevLesson->id]) }}" class="flex-1 lg:flex-none flex items-center justify-center lg:justify-start px-4 py-2.5 bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-lg text-xs md:text-sm font-medium text-slate-600 dark:text-slate-300 hover:text-blue-600 dark:hover:text-blue-400 hover:border-blue-300 transition shadow-sm">
                        <i class="fas fa-arrow-left mr-2"></i> <span class="truncate">আগের লেসন</span>
                    </a>
                    @else
                    <div class="flex-1 lg:flex-none"></div>
                    @endif

                    @if($nextLesson)
                    <a href="{{ route('student.courses.lessons.show', [$course->id, $nextLesson->id]) }}" class="flex-1 lg:flex-none flex items-center justify-center lg:justify-start px-4 py-2.5 bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-lg text-xs md:text-sm font-medium text-slate-600 dark:text-slate-300 hover:text-blue-600 dark:hover:text-blue-400 hover:border-blue-300 transition shadow-sm">
                        <span class="truncate">পরের লেসন</span> <i class="fas fa-arrow-right ml-2"></i>
                    </a>
                    @endif
                </div>

                <div class="bg-white dark:bg-slate-800 rounded-xl p-5 border border-slate-200 dark:border-slate-700 shadow-sm">
                    <h3 class="text-base md:text-lg font-bold text-slate-800 dark:text-white mb-3 border-b border-slate-100 dark:border-slate-700 pb-2">বিবরণ</h3>
                    <div class="prose dark:prose-invert max-w-none text-slate-600 dark:text-slate-300 text-sm leading-relaxed">
                        @if($lesson->content)
                            {!! $lesson->content !!}
                        @else
                            <p class="text-slate-400 italic text-xs">ভিডিওটি মনোযোগ দিয়ে দেখুন।</p>
                        @endif
                    </div>

                    @if(!empty($lesson->attachments))
                    <div class="mt-6 pt-4 border-t border-slate-100 dark:border-slate-700">
                        <h3 class="text-xs md:text-sm font-bold text-slate-800 dark:text-white mb-3 flex items-center gap-2">
                            <i class="fas fa-paperclip text-blue-500"></i> রিসোর্স ফাইল
                        </h3>
                        <div class="grid grid-cols-1 gap-2">
                            @foreach($lesson->attachments as $attachment)
                            <a href="{{ asset('storage/'.($attachment['path'] ?? '#')) }}" target="_blank" class="flex items-center p-2.5 bg-slate-50 dark:bg-slate-700/50 border border-slate-200 dark:border-slate-600 rounded-lg hover:border-blue-500 dark:hover:border-blue-500 transition group">
                                <div class="h-8 w-8 rounded-lg bg-white dark:bg-slate-800 text-blue-600 flex items-center justify-center mr-3 shadow-sm">
                                    <i class="far fa-file-alt text-sm"></i>
                                </div>
                                <div class="overflow-hidden flex-1">
                                    <h4 class="text-xs md:text-sm font-bold text-slate-700 dark:text-slate-200 truncate">{{ $attachment['name'] ?? 'File' }}</h4>
                                    <p class="text-[9px] text-slate-500 dark:text-slate-400 uppercase">{{ $attachment['size'] ?? 'DOWNLOAD' }}</p>
                                </div>
                                <i class="fas fa-download ml-2 text-xs text-slate-400 group-hover:text-blue-600 transition"></i>
                            </a>
                            @endforeach
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>

        <div class="w-full lg:w-96 bg-white dark:bg-slate-800 rounded-xl shadow-lg border border-slate-200 dark:border-slate-700 flex flex-col shrink-0 mt-6 lg:mt-0 lg:h-full overflow-hidden">
            <div class="p-4 border-b border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-800/50">
                <h3 class="font-bold text-slate-800 dark:text-white mb-2 text-sm md:text-base">কোর্স কারিকুলাম</h3>
                
                <div class="flex justify-between items-center text-[10px] md:text-xs font-semibold text-slate-500 dark:text-slate-400 mb-1.5">
                    <span>{{ $progress }}% সম্পন্ন</span>
                    <span>{{ count($completedLessonIds) }} / {{ $course->lessons->count() }} লেসন</span>
                </div>
                <div class="w-full bg-slate-200 dark:bg-slate-700 rounded-full h-1.5">
                    <div class="bg-blue-600 h-1.5 rounded-full transition-all duration-500 shadow-sm" style="width: {{ $progress }}%"></div>
                </div>
            </div>

            <div class="flex-1 overflow-y-auto custom-scrollbar p-2 max-h-[500px] lg:max-h-full">
                <div class="space-y-2">
                    @foreach($course->sections as $section)
                    <div x-data="{ open: {{ $section->lessons->contains('id', $lesson->id) ? 'true' : 'false' }} }" class="rounded-lg border border-slate-200 dark:border-slate-700 overflow-hidden bg-white dark:bg-slate-800">
                        
                        <button @click="open = !open" class="w-full px-3 py-2.5 flex items-center justify-between bg-slate-50 dark:bg-slate-700/30 hover:bg-slate-100 dark:hover:bg-slate-700 transition-colors">
                            <span class="text-xs font-bold text-slate-700 dark:text-slate-200 uppercase tracking-wide text-left line-clamp-1">{{ $section->title }}</span>
                            <i class="fas fa-chevron-down text-[10px] text-slate-400 transition-transform duration-200" :class="{'rotate-180': open}"></i>
                        </button>

                        <div x-show="open" x-collapse class="divide-y divide-slate-100 dark:divide-slate-700/50">
                            @foreach($section->lessons as $secLesson)
                                @php
                                    $isActive = $secLesson->id === $lesson->id;
                                    $isCompleted = in_array($secLesson->id, $completedLessonIds);
                                @endphp

                                <a href="{{ $secLesson->quiz ? route('student.quizzes.show', $secLesson->quiz->id) : route('student.courses.lessons.show', [$course->id, $secLesson->id]) }}" 
                                   class="block px-3 py-2.5 border-l-[3px] transition-all hover:bg-blue-50 dark:hover:bg-slate-700/50 
                                          {{ $isActive ? 'border-blue-600 bg-blue-50 dark:bg-blue-900/10' : 'border-transparent' }}">
                                    
                                    <div class="flex gap-2.5">
                                        <div class="mt-0.5 shrink-0">
                                            @if($isCompleted)
                                                <i class="fas fa-check-circle text-green-500 text-xs"></i>
                                            @elseif($isActive)
                                                <div class="relative flex h-3 w-3">
                                                  <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-blue-400 opacity-75"></span>
                                                  <span class="relative inline-flex rounded-full h-3 w-3 bg-blue-500"></span>
                                                </div>
                                            @elseif($secLesson->quiz)
                                                <i class="fas fa-clipboard-question text-purple-500 text-xs"></i>
                                            @else
                                                <i class="far fa-circle text-slate-300 dark:text-slate-600 text-xs"></i>
                                            @endif
                                        </div>
                                        
                                        <div class="min-w-0 flex-1">
                                            <p class="text-xs md:text-sm line-clamp-2 leading-snug {{ $isActive ? 'font-bold text-blue-700 dark:text-blue-300' : 'font-medium text-slate-600 dark:text-slate-400' }}">
                                                {{ $secLesson->title }}
                                            </p>
                                            <div class="flex items-center gap-2 mt-1">
                                                @if($secLesson->video_duration)
                                                    <span class="text-[9px] text-slate-400 flex items-center">
                                                        <i class="far fa-clock mr-1"></i> {{ $secLesson->video_duration }}
                                                    </span>
                                                @endif
                                                @if($secLesson->quiz)
                                                    <span class="text-[9px] font-bold bg-purple-100 dark:bg-purple-900/30 text-purple-700 dark:text-purple-300 px-1.5 py-0.5 rounded">Quiz</span>
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

    @push('scripts')
    <script src="https://cdn.plyr.io/3.7.8/plyr.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            
            // --- Plyr Setup ---
            if(document.querySelector('#player')) {
                const player = new Plyr('#player', {
                    controls: ['play-large', 'play', 'progress', 'current-time', 'mute', 'volume', 'settings', 'pip', 'airplay', 'fullscreen'],
                    youtube: { noCookie: true, rel: 0, showinfo: 0, iv_load_policy: 3, modestbranding: 1, disablekb: 1 },
                    settings: ['quality', 'speed', 'loop'],
                    speed: { selected: 1, options: [0.5, 0.75, 1, 1.25, 1.5, 2] }
                });
                player.on('ended', event => { markAsComplete(); });
            }

            // --- Google Drive Timer Setup ---
            @if($lesson->video_type == 'google_drive' && $lesson->video_duration)
                const durationStr = "{{ $lesson->video_duration }}"; 
                const parts = durationStr.split(':').map(Number);
                let seconds = 0;
                
                if(parts.length === 3) { seconds = parts[0] * 3600 + parts[1] * 60 + parts[2]; }
                else if(parts.length === 2) { seconds = parts[0] * 60 + parts[1]; }
                
                if(seconds > 0) {
                    const timeToWatch = (seconds * 0.9) * 1000;
                    setTimeout(() => { markAsComplete(); }, timeToWatch);
                }
            @endif
        });

        // --- Alpine JS Logic ---
        function markAsComplete() {
            const appElement = document.querySelector('[x-data="lessonApp()"]');
            if (appElement) {
                const alpineData = Alpine.$data(appElement);
                if (!alpineData.isCompleted) {
                    alpineData.toggleComplete();
                }
            }
        }

        function lessonApp() {
            return {
                isCompleted: @json(in_array($lesson->id, $completedLessonIds)),
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
    @endpush
@endsection