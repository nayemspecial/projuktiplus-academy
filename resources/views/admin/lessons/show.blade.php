@extends('layouts.admin')

@section('title', $lesson->title . ' - ProjuktiPlus LMS Admin')

@section('admin-content')

<div class="bg-white dark:bg-slate-800 rounded-lg shadow-lg overflow-hidden border border-gray-200 dark:border-slate-700">
    <!-- Header Section -->
    <div class="px-6 py-4 border-b border-gray-200 dark:border-slate-700 bg-gradient-to-r from-blue-50 to-indigo-50 dark:from-slate-700 dark:to-slate-800">
        <div class="flex flex-col md:flex-row justify-between items-center gap-3">
            <div>
                <h3 class="text-xl font-semibold text-gray-800 dark:text-white">লেসন বিস্তারিত</h3>
                <p class="text-sm text-gray-600 dark:text-gray-300 mt-1">{{ $lesson->section->course->title }} - {{ $lesson->section->title }}</p>
            </div>
            <div class="flex gap-2">
                <a href="{{ route('admin.lessons.edit', $lesson) }}" 
                   class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-yellow-500 hover:bg-yellow-600 transition-colors">
                    <i class="fas fa-edit mr-2"></i> এডিট
                </a>
                <a href="{{ route('admin.lessons.index') }}" 
                   class="inline-flex items-center px-4 py-2 border border-gray-300 dark:border-slate-600 rounded-md shadow-sm text-sm font-medium text-gray-700 dark:text-gray-300 bg-white dark:bg-slate-700 hover:bg-gray-50 dark:hover:bg-slate-600 transition-colors">
                    <i class="fas fa-arrow-left mr-2"></i> পিছনে
                </a>
            </div>
        </div>
    </div>
    
    <!-- Main Content -->
    <div class="px-6 py-6 space-y-8">
        <!-- Lesson Title and Status Badge -->
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 p-6 bg-slate-50 dark:bg-slate-700/50 rounded-lg border border-gray-200 dark:border-slate-600">
            <div>
                <h2 class="text-2xl font-bold text-gray-800 dark:text-white">{{ $lesson->title }}</h2>
                <p class="text-gray-600 dark:text-gray-300 mt-2">স্লাগ: {{ $lesson->slug }}</p>
            </div>
            <div class="flex flex-wrap gap-2">
                <span class="px-3 py-1 rounded-full text-xs font-medium 
                    {{ $lesson->is_published 
                        ? 'bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-400' 
                        : 'bg-gray-100 text-gray-800 dark:bg-gray-900/30 dark:text-gray-400' }}">
                    {{ $lesson->is_published ? 'Published' : 'Draft' }}
                </span>
                @if($lesson->is_free)
                <span class="px-3 py-1 rounded-full text-xs font-medium bg-blue-100 text-blue-800 dark:bg-blue-900/30 dark:text-blue-400">
                    ফ্রি লেসন
                </span>
                @endif
                @if($lesson->preview)
                <span class="px-3 py-1 rounded-full text-xs font-medium bg-purple-100 text-purple-800 dark:bg-purple-900/30 dark:text-purple-400">
                    প্রিভিউ
                </span>
                @endif
                @if($lesson->hasQuiz())
                <span class="px-3 py-1 rounded-full text-xs font-medium bg-orange-100 text-orange-800 dark:bg-orange-900/30 dark:text-orange-400">
                    কুইজ আছে
                </span>
                @endif
            </div>
        </div>

        <!-- Basic Information Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <!-- Information Cards -->
            <div class="bg-gray-50 dark:bg-slate-700/50 p-4 rounded-lg border border-gray-200 dark:border-slate-600">
                <div class="flex items-center">
                    <div class="p-2 bg-blue-100 dark:bg-blue-900/30 rounded-lg">
                        <i class="fas fa-book text-blue-600 dark:text-blue-400"></i>
                    </div>
                    <div class="ml-3">
                        <h4 class="text-sm font-medium text-gray-500 dark:text-gray-400">কোর্স</h4>
                        <p class="text-sm font-semibold text-gray-900 dark:text-white">{{ $lesson->section->course->title }}</p>
                    </div>
                </div>
            </div>

            <div class="bg-gray-50 dark:bg-slate-700/50 p-4 rounded-lg border border-gray-200 dark:border-slate-600">
                <div class="flex items-center">
                    <div class="p-2 bg-green-100 dark:bg-green-900/30 rounded-lg">
                        <i class="fas fa-layer-group text-green-600 dark:text-green-400"></i>
                    </div>
                    <div class="ml-3">
                        <h4 class="text-sm font-medium text-gray-500 dark:text-gray-400">সেকশন</h4>
                        <p class="text-sm font-semibold text-gray-900 dark:text-white">{{ $lesson->section->title }}</p>
                    </div>
                </div>
            </div>

            <div class="bg-gray-50 dark:bg-slate-700/50 p-4 rounded-lg border border-gray-200 dark:border-slate-600">
                <div class="flex items-center">
                    <div class="p-2 bg-purple-100 dark:bg-purple-900/30 rounded-lg">
                        <i class="fas fa-sort-numeric-down text-purple-600 dark:text-purple-400"></i>
                    </div>
                    <div class="ml-3">
                        <h4 class="text-sm font-medium text-gray-500 dark:text-gray-400">অর্ডার</h4>
                        <p class="text-sm font-semibold text-gray-900 dark:text-white">{{ $lesson->order }}</p>
                    </div>
                </div>
            </div>

            <div class="bg-gray-50 dark:bg-slate-700/50 p-4 rounded-lg border border-gray-200 dark:border-slate-600">
                <div class="flex items-center">
                    <div class="p-2 bg-yellow-100 dark:bg-yellow-900/30 rounded-lg">
                        <i class="fas fa-video text-yellow-600 dark:text-yellow-400"></i>
                    </div>
                    <div class="ml-3">
                        <h4 class="text-sm font-medium text-gray-500 dark:text-gray-400">ভিডিও টাইপ</h4>
                        <p class="text-sm font-semibold text-gray-900 dark:text-white">
                            {{ $lesson->video_type ? ucfirst($lesson->video_type) : 'N/A' }}
                        </p>
                    </div>
                </div>
            </div>

            <div class="bg-gray-50 dark:bg-slate-700/50 p-4 rounded-lg border border-gray-200 dark:border-slate-600">
                <div class="flex items-center">
                    <div class="p-2 bg-red-100 dark:bg-red-900/30 rounded-lg">
                        <i class="fas fa-clock text-red-600 dark:text-red-400"></i>
                    </div>
                    <div class="ml-3">
                        <h4 class="text-sm font-medium text-gray-500 dark:text-gray-400">সময়কাল</h4>
                        <p class="text-sm font-semibold text-gray-900 dark:text-white">
                            @if($lesson->video_duration)
                                {{ $lesson->video_duration }} সেকেন্ড
                            @else
                                N/A
                            @endif
                        </p>
                    </div>
                </div>
            </div>

            <div class="bg-gray-50 dark:bg-slate-700/50 p-4 rounded-lg border border-gray-200 dark:border-slate-600">
                <div class="flex items-center">
                    <div class="p-2 bg-indigo-100 dark:bg-indigo-900/30 rounded-lg">
                        <i class="fas fa-question-circle text-indigo-600 dark:text-indigo-400"></i>
                    </div>
                    <div class="ml-3">
                        <h4 class="text-sm font-medium text-gray-500 dark:text-gray-400">কুইজ</h4>
                        <p class="text-sm font-semibold text-gray-900 dark:text-white">
                            {{ $lesson->hasQuiz() ? 'হ্যাঁ' : 'না' }}
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Video URL Section -->
        @if($lesson->video_url)
        <div class="bg-gray-50 dark:bg-slate-700/50 p-6 rounded-lg border border-gray-200 dark:border-slate-600">
            <h4 class="text-lg font-semibold text-gray-800 dark:text-white mb-4 flex items-center">
                <i class="fas fa-link mr-2 text-blue-500"></i> ভিডিও লিংক
            </h4>
            <div class="bg-white dark:bg-slate-800 p-4 rounded border border-gray-300 dark:border-slate-600">
                <a href="{{ $lesson->video_url }}" target="_blank" 
                   class="text-blue-600 dark:text-blue-400 hover:text-blue-800 dark:hover:text-blue-300 break-all font-mono text-sm">
                    <i class="fas fa-external-link-alt mr-2"></i>{{ $lesson->video_url }}
                </a>
            </div>
        </div>
        @endif

        <!-- Content Section -->
        <div class="bg-gray-50 dark:bg-slate-700/50 p-6 rounded-lg border border-gray-200 dark:border-slate-600">
            <h4 class="text-lg font-semibold text-gray-800 dark:text-white mb-4 flex items-center">
                <i class="fas fa-file-alt mr-2 text-green-500"></i> লেসন কন্টেন্ট
            </h4>
            <div class="bg-white dark:bg-slate-800 p-6 rounded border border-gray-300 dark:border-slate-600 prose dark:prose-invert max-w-none">
                @if($lesson->content)
                    {!! $lesson->content !!}
                @else
                    <p class="text-gray-500 dark:text-gray-400 text-center py-8">
                        <i class="fas fa-info-circle mr-2"></i>কোনো কন্টেন্ট যোগ করা হয়নি
                    </p>
                @endif
            </div>
        </div>

        <!-- Video Preview Section -->
        @if($lesson->video_url && in_array($lesson->video_type, ['youtube', 'vimeo']))
        <div class="bg-gray-50 dark:bg-slate-700/50 p-6 rounded-lg border border-gray-200 dark:border-slate-600">
            <h4 class="text-lg font-semibold text-gray-800 dark:text-white mb-4 flex items-center">
                <i class="fas fa-play-circle mr-2 text-red-500"></i> ভিডিও প্রিভিউ
            </h4>
            <div class="bg-black rounded-lg overflow-hidden shadow-lg">
                <div class="aspect-w-16 aspect-h-9">
                    <iframe 
                        src="{{ $lesson->video_embed_url }}" 
                        class="w-full h-64 md:h-96"
                        frameborder="0" 
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" 
                        allowfullscreen
                        loading="lazy">
                    </iframe>
                </div>
            </div>
        </div>
        @endif
    </div>
    
    <!-- Footer with Timestamps -->
    <div class="px-6 py-4 bg-gray-50 dark:bg-slate-800 border-t border-gray-200 dark:border-slate-700">
        <div class="flex flex-col sm:flex-row justify-between items-center gap-2 text-xs text-gray-500 dark:text-gray-400">
            <div class="flex items-center">
                <i class="fas fa-info-circle mr-2"></i>
                <span>লেসন আইডি: {{ $lesson->id }}</span>
            </div>
            <div class="flex flex-wrap gap-4">
                <span class="flex items-center">
                    <i class="fas fa-calendar-plus mr-1"></i>
                    তৈরি: {{ $lesson->created_at->format('d M, Y h:i A') }}
                </span>
                @if($lesson->updated_at->ne($lesson->created_at))
                <span class="flex items-center">
                    <i class="fas fa-edit mr-1"></i>
                    আপডেট: {{ $lesson->updated_at->format('d M, Y h:i A') }}
                </span>
                @endif
                @if($lesson->published_at)
                <span class="flex items-center">
                    <i class="fas fa-check-circle mr-1"></i>
                    পাবলিশ: {{ $lesson->published_at->format('d M, Y h:i A') }}
                </span>
                @endif
            </div>
        </div>
    </div>
</div>

<style>
.prose {
    max-width: none;
}
.prose h1, .prose h2, .prose h3, .prose h4 {
    color: #1f2937;
    font-weight: 600;
}
.dark .prose h1, .dark .prose h2, .dark .prose h3, .dark .prose h4 {
    color: #e5e7eb;
}
.prose p {
    margin-bottom: 1rem;
}
.prose ul, .prose ol {
    margin-bottom: 1rem;
    padding-left: 1.5rem;
}
</style>
@endsection