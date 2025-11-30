@extends('layouts.admin')

@section('title', 'উত্তর বিস্তারিত - ProjuktiPlus LMS Admin')

@section('admin-content')

<div class="bg-white dark:bg-slate-800 rounded-lg shadow-lg overflow-hidden border border-gray-200 dark:border-slate-700">
    <!-- Header Section -->
    <div class="px-6 py-4 border-b border-gray-200 dark:border-slate-700 bg-gradient-to-r from-blue-50 to-indigo-50 dark:from-slate-700 dark:to-slate-800">
        <div class="flex flex-col md:flex-row justify-between items-center gap-3">
            <div>
                <h3 class="text-xl font-semibold text-gray-800 dark:text-white">উত্তর বিস্তারিত</h3>
                <p class="text-sm text-gray-600 dark:text-gray-300 mt-1">{{ $answer->question->quiz->lesson->section->course->title }} - {{ $answer->question->quiz->title }}</p>
            </div>
            <div class="flex gap-2">
                <a href="{{ route('admin.answers.edit', $answer) }}" 
                   class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-yellow-500 hover:bg-yellow-600 transition-colors">
                    <i class="fas fa-edit mr-2"></i> এডিট
                </a>
                <a href="{{ route('admin.answers.index') }}" 
                   class="inline-flex items-center px-4 py-2 border border-gray-300 dark:border-slate-600 rounded-md shadow-sm text-sm font-medium text-gray-700 dark:text-gray-300 bg-white dark:bg-slate-700 hover:bg-gray-50 dark:hover:bg-slate-600 transition-colors">
                    <i class="fas fa-arrow-left mr-2"></i> পিছনে
                </a>
            </div>
        </div>
    </div>
    
    <!-- Main Content -->
    <div class="px-6 py-6 space-y-8">
        <!-- Answer Title and Status Badge -->
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 p-6 bg-slate-50 dark:bg-slate-700/50 rounded-lg border border-gray-200 dark:border-slate-600">
            <div class="flex-1">
                <h2 class="text-2xl font-bold text-gray-800 dark:text-white">উত্তর #{{ $answer->order }}</h2>
                <p class="text-gray-600 dark:text-gray-300 mt-2">{{ $answer->question->quiz->title }}</p>
            </div>
            <div class="flex flex-wrap gap-2">
                <span class="px-3 py-1 rounded-full text-xs font-medium 
                    {{ $answer->is_correct 
                        ? 'bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-400' 
                        : 'bg-gray-100 text-gray-800 dark:bg-gray-900/30 dark:text-gray-400' }}">
                    {{ $answer->is_correct ? 'সঠিক উত্তর' : 'ভুল উত্তর' }}
                </span>
                <span class="px-3 py-1 rounded-full text-xs font-medium bg-blue-100 text-blue-800 dark:bg-blue-900/30 dark:text-blue-400">
                    অর্ডার: {{ $answer->order }}
                </span>
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
                        <p class="text-sm font-semibold text-gray-900 dark:text-white">{{ $answer->question->quiz->lesson->section->course->title }}</p>
                    </div>
                </div>
            </div>

            <div class="bg-gray-50 dark:bg-slate-700/50 p-4 rounded-lg border border-gray-200 dark:border-slate-600">
                <div class="flex items-center">
                    <div class="p-2 bg-green-100 dark:bg-green-900/30 rounded-lg">
                        <i class="fas fa-play text-green-600 dark:text-green-400"></i>
                    </div>
                    <div class="ml-3">
                        <h4 class="text-sm font-medium text-gray-500 dark:text-gray-400">লেসন</h4>
                        <p class="text-sm font-semibold text-gray-900 dark:text-white">{{ $answer->question->quiz->lesson->title }}</p>
                    </div>
                </div>
            </div>

            <div class="bg-gray-50 dark:bg-slate-700/50 p-4 rounded-lg border border-gray-200 dark:border-slate-600">
                <div class="flex items-center">
                    <div class="p-2 bg-purple-100 dark:bg-purple-900/30 rounded-lg">
                        <i class="fas fa-question-circle text-purple-600 dark:text-purple-400"></i>
                    </div>
                    <div class="ml-3">
                        <h4 class="text-sm font-medium text-gray-500 dark:text-gray-400">কুইজ</h4>
                        <p class="text-sm font-semibold text-gray-900 dark:text-white">{{ $answer->question->quiz->title }}</p>
                    </div>
                </div>
            </div>

            <div class="bg-gray-50 dark:bg-slate-700/50 p-4 rounded-lg border border-gray-200 dark:border-slate-600">
                <div class="flex items-center">
                    <div class="p-2 bg-yellow-100 dark:bg-yellow-900/30 rounded-lg">
                        <i class="fas fa-sort-numeric-down text-yellow-600 dark:text-yellow-400"></i>
                    </div>
                    <div class="ml-3">
                        <h4 class="text-sm font-medium text-gray-500 dark:text-gray-400">অর্ডার</h4>
                        <p class="text-sm font-semibold text-gray-900 dark:text-white">{{ $answer->order }}</p>
                    </div>
                </div>
            </div>

            <div class="bg-gray-50 dark:bg-slate-700/50 p-4 rounded-lg border border-gray-200 dark:border-slate-600">
                <div class="flex items-center">
                    <div class="p-2 bg-red-100 dark:bg-red-900/30 rounded-lg">
                        <i class="fas fa-check-circle text-red-600 dark:text-red-400"></i>
                    </div>
                    <div class="ml-3">
                        <h4 class="text-sm font-medium text-gray-500 dark:text-gray-400">স্ট্যাটাস</h4>
                        <p class="text-sm font-semibold text-gray-900 dark:text-white">
                            {{ $answer->is_correct ? 'সঠিক উত্তর' : 'ভুল উত্তর' }}
                        </p>
                    </div>
                </div>
            </div>

            <div class="bg-gray-50 dark:bg-slate-700/50 p-4 rounded-lg border border-gray-200 dark:border-slate-600">
                <div class="flex items-center">
                    <div class="p-2 bg-indigo-100 dark:bg-indigo-900/30 rounded-lg">
                        <i class="fas fa-question text-indigo-600 dark:text-indigo-400"></i>
                    </div>
                    <div class="ml-3">
                        <h4 class="text-sm font-medium text-gray-500 dark:text-gray-400">প্রশ্নের ধরন</h4>
                        <p class="text-sm font-semibold text-gray-900 dark:text-white">
                            @if($answer->question->type === 'multiple_choice')
                                Multiple Choice
                            @elseif($answer->question->type === 'true_false')
                                True/False
                            @elseif($answer->question->type === 'short_answer')
                                Short Answer
                            @else
                                Essay
                            @endif
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Question Text Section -->
        <div class="bg-gray-50 dark:bg-slate-700/50 p-6 rounded-lg border border-gray-200 dark:border-slate-600">
            <h4 class="text-lg font-semibold text-gray-800 dark:text-white mb-4 flex items-center">
                <i class="fas fa-question mr-2 text-blue-500"></i> প্রশ্ন
            </h4>
            <div class="bg-white dark:bg-slate-800 p-6 rounded border border-gray-300 dark:border-slate-600">
                <p class="text-gray-800 dark:text-gray-200 text-lg leading-relaxed">{{ $answer->question->question }}</p>
            </div>
        </div>

        <!-- Answer Text Section -->
        <div class="bg-gray-50 dark:bg-slate-700/50 p-6 rounded-lg border border-gray-200 dark:border-slate-600">
            <h4 class="text-lg font-semibold text-gray-800 dark:text-white mb-4 flex items-center">
                <i class="fas fa-check-circle mr-2 text-green-500"></i> উত্তর
            </h4>
            <div class="bg-white dark:bg-slate-800 p-6 rounded border border-gray-300 dark:border-slate-600">
                <p class="text-gray-800 dark:text-gray-200 text-lg leading-relaxed">{{ $answer->answer }}</p>
            </div>
        </div>

        <!-- Explanation Section -->
        @if($answer->question->explanation)
        <div class="bg-gray-50 dark:bg-slate-700/50 p-6 rounded-lg border border-gray-200 dark:border-slate-600">
            <h4 class="text-lg font-semibold text-gray-800 dark:text-white mb-4 flex items-center">
                <i class="fas fa-lightbulb mr-2 text-yellow-500"></i> ব্যাখ্যা
            </h4>
            <div class="bg-white dark:bg-slate-800 p-6 rounded border border-gray-300 dark:border-slate-600">
                <p class="text-gray-800 dark:text-gray-200 leading-relaxed">{{ $answer->question->explanation }}</p>
            </div>
        </div>
        @endif
    </div>
    
    <!-- Footer with Timestamps -->
    <div class="px-6 py-4 bg-gray-50 dark:bg-slate-800 border-t border-gray-200 dark:border-slate-700">
        <div class="flex flex-col sm:flex-row justify-between items-center gap-2 text-xs text-gray-500 dark:text-gray-400">
            <div class="flex items-center">
                <i class="fas fa-info-circle mr-2"></i>
                <span>উত্তর আইডি: {{ $answer->id }}</span>
            </div>
            <div class="flex flex-wrap gap-4">
                <span class="flex items-center">
                    <i class="fas fa-calendar-plus mr-1"></i>
                    তৈরি: {{ $answer->created_at->format('d M, Y h:i A') }}
                </span>
                @if($answer->updated_at->ne($answer->created_at))
                <span class="flex items-center">
                    <i class="fas fa-edit mr-1"></i>
                    আপডেট: {{ $answer->updated_at->format('d M, Y h:i A') }}
                </span>
                @endif
            </div>
        </div>
    </div>
</div>

<style>
.table-responsive {
    overflow-x: auto;
}
</style>
@endsection