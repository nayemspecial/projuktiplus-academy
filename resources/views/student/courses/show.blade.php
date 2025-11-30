@extends('layouts.student')

@section('title', $course->title . ' - ProjuktiPlus LMS')

@section('student-content')
<div class="bg-white dark:bg-slate-800 rounded-lg shadow-md overflow-hidden">
    <div class="relative h-64 md:h-96">
        <img src="{{ $course->thumbnail_url }}" alt="{{ $course->title }}" class="w-full h-full object-cover">
        <div class="absolute inset-0 bg-black bg-opacity-50 flex items-end">
            <div class="p-6 md:p-10 text-white">
                <span class="inline-block px-3 py-1 mb-4 text-xs font-semibold bg-blue-600 rounded-full">
                    {{ ucfirst($course->category) }}
                </span>
                <h1 class="text-3xl md:text-4xl font-bold mb-2">{{ $course->title }}</h1>
                <p class="text-lg opacity-90 md:w-2/3">{{ \Illuminate\Support\Str::limit(strip_tags($course->description), 150) }}</p>
                
                <div class="flex items-center mt-6 space-x-6">
                    <div class="flex items-center">
                        <i class="fas fa-chalkboard-teacher mr-2"></i>
                        <span>{{ $course->instructor->name ?? 'Unknown' }}</span>
                    </div>
                    <div class="flex items-center">
                        <i class="fas fa-book-open mr-2"></i>
                        <span>{{ $totalLessons }} টি লেসন</span>
                    </div>
                    <div class="flex items-center">
                        <i class="fas fa-star text-yellow-400 mr-2"></i>
                        <span>{{ $course->rating }} ({{ $course->total_reviews }} রিভিউ)</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="p-6 md:p-10 border-b border-gray-200 dark:border-slate-700 bg-gray-50 dark:bg-slate-700/20">
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-6">
            <div class="flex-1">
                <div class="flex justify-between mb-2">
                    <span class="font-medium text-gray-700 dark:text-gray-300">আপনার প্রোগ্রেস</span>
                    <span class="font-bold text-blue-600 dark:text-blue-400">{{ $progress }}%</span>
                </div>
                <div class="w-full bg-gray-200 dark:bg-slate-700 rounded-full h-3">
                    <div class="bg-blue-600 h-3 rounded-full transition-all duration-500" style="width: {{ $progress }}%"></div>
                </div>
                <p class="text-sm text-gray-500 dark:text-gray-400 mt-2">
                    আপনি {{ $totalLessons }} টি লেসনের মধ্যে {{ $completedLessonsCount }} টি সম্পন্ন করেছেন
                </p>
            </div>
            <div class="md:w-1/3 text-right">
                <a href="{{ route('student.courses.content', $course->id) }}" class="inline-flex items-center justify-center w-full md:w-auto px-6 py-3 border border-transparent text-base font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 transition shadow-sm">
                    <i class="fas fa-play-circle mr-2"></i>
                    {{ $progress > 0 ? 'চালিয়ে যান' : 'কোর্স শুরু করুন' }}
                </a>
            </div>
        </div>
    </div>

    <div class="p-6 md:p-10" x-data="{ activeTab: 'curriculum' }">
        <div class="flex border-b border-gray-200 dark:border-slate-700 mb-6">
            <button @click="activeTab = 'curriculum'" class="px-6 py-3 font-medium text-sm focus:outline-none transition border-b-2" :class="activeTab === 'curriculum' ? 'border-blue-600 text-blue-600 dark:text-blue-400' : 'border-transparent text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-300'">
                ক্যারিকুলাম
            </button>
            <button @click="activeTab = 'description'" class="px-6 py-3 font-medium text-sm focus:outline-none transition border-b-2" :class="activeTab === 'description' ? 'border-blue-600 text-blue-600 dark:text-blue-400' : 'border-transparent text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-300'">
                বিস্তারিত
            </button>
            <button @click="activeTab = 'instructor'" class="px-6 py-3 font-medium text-sm focus:outline-none transition border-b-2" :class="activeTab === 'instructor' ? 'border-blue-600 text-blue-600 dark:text-blue-400' : 'border-transparent text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-300'">
                ইন্সট্রাক্টর
            </button>
        </div>

        <div>
            <div x-show="activeTab === 'curriculum'" class="space-y-4">
                @foreach($course->sections as $section)
                <div x-data="{ open: false }" class="border border-gray-200 dark:border-slate-700 rounded-lg overflow-hidden">
                    <button @click="open = !open" class="flex items-center justify-between w-full px-5 py-4 bg-gray-50 dark:bg-slate-800/50 hover:bg-gray-100 dark:hover:bg-slate-700 transition">
                        <h3 class="text-base font-medium text-gray-800 dark:text-white">
                            {{ $section->title }}
                            <span class="text-sm font-normal text-gray-500 dark:text-gray-400 ml-2">({{ $section->lessons->count() }} টি লেসন)</span>
                        </h3>
                        <i class="fas fa-chevron-down text-gray-400 transition-transform" :class="{'rotate-180': open}"></i>
                    </button>
                    <div x-show="open" x-collapse style="display: none;">
                        <div class="divide-y divide-gray-200 dark:divide-slate-700">
                            @foreach($section->lessons as $lesson)
                            <a href="{{ route('student.courses.lessons.show', [$course->id, $lesson->id]) }}" class="flex items-center px-5 py-3 hover:bg-gray-50 dark:hover:bg-slate-700/50 transition group">
                                <div class="mr-4 text-gray-400 group-hover:text-blue-500">
                                    <i class="{{ $lesson->video_type ? 'fas fa-play-circle' : 'far fa-file-alt' }}"></i>
                                </div>
                                <div class="flex-1">
                                    <span class="text-sm text-gray-700 dark:text-gray-300">{{ $lesson->title }}</span>
                                </div>
                                <div class="text-xs text-gray-500 dark:text-gray-400">
                                    {{ $lesson->video_duration ?? 'Text' }}
                                </div>
                            </a>
                            @endforeach
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

            <div x-show="activeTab === 'description'" style="display: none;">
                <div class="prose dark:prose-invert max-w-none text-gray-600 dark:text-gray-300">
                    {!! $course->description !!}
                </div>
            </div>

            <div x-show="activeTab === 'instructor'" style="display: none;">
                <div class="flex items-start">
                    <img src="{{ $course->instructor->avatar_url ?? asset('images/default-avatar.png') }}" alt="{{ $course->instructor->name }}" class="w-20 h-20 rounded-full object-cover mr-6">
                    <div>
                        <h3 class="text-xl font-bold text-gray-800 dark:text-white">{{ $course->instructor->name }}</h3>
                        <p class="text-blue-600 dark:text-blue-400 mb-4">কোর্স ইন্সট্রাক্টর</p>
                        <p class="text-gray-600 dark:text-gray-300">{{ $course->instructor->bio ?? 'এই ইন্সট্রাক্টরের কোনো বায়ো দেওয়া হয়নি।' }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection