@extends('layouts.admin')

@section('title', 'প্রশ্ন বিস্তারিত - ProjuktiPlus LMS Admin')

@section('admin-content')

<div class="bg-white dark:bg-slate-800 rounded-lg shadow-lg overflow-hidden border border-gray-200 dark:border-slate-700">
    <!-- Header Section -->
    <div class="px-6 py-4 border-b border-gray-200 dark:border-slate-700 bg-gradient-to-r from-blue-50 to-indigo-50 dark:from-slate-700 dark:to-slate-800">
        <div class="flex flex-col md:flex-row justify-between items-center gap-3">
            <div>
                <h3 class="text-xl font-semibold text-gray-800 dark:text-white">প্রশ্ন বিস্তারিত</h3>
                <p class="text-sm text-gray-600 dark:text-gray-300 mt-1">{{ $question->quiz->lesson->section->course->title }} - {{ $question->quiz->title }}</p>
            </div>
            <div class="flex gap-2">
                <a href="{{ route('admin.questions.edit', $question) }}" 
                   class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-yellow-500 hover:bg-yellow-600 transition-colors">
                    <i class="fas fa-edit mr-2"></i> এডিট
                </a>
                <a href="{{ route('admin.questions.index') }}" 
                   class="inline-flex items-center px-4 py-2 border border-gray-300 dark:border-slate-600 rounded-md shadow-sm text-sm font-medium text-gray-700 dark:text-gray-300 bg-white dark:bg-slate-700 hover:bg-gray-50 dark:hover:bg-slate-600 transition-colors">
                    <i class="fas fa-arrow-left mr-2"></i> পিছনে
                </a>
            </div>
        </div>
    </div>
    
    <!-- Main Content -->
    <div class="px-6 py-6 space-y-8">
        <!-- Question Title and Type Badge -->
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 p-6 bg-slate-50 dark:bg-slate-700/50 rounded-lg border border-gray-200 dark:border-slate-600">
            <div class="flex-1">
                <h2 class="text-2xl font-bold text-gray-800 dark:text-white">প্রশ্ন #{{ $question->order }}</h2>
                <p class="text-gray-600 dark:text-gray-300 mt-2">{{ $question->quiz->title }}</p>
            </div>
            <div class="flex flex-wrap gap-2">
                <span class="px-3 py-1 rounded-full text-xs font-medium 
                    {{ $question->type === 'multiple_choice' ? 'bg-blue-100 text-blue-800 dark:bg-blue-900/30 dark:text-blue-400' : 
                       ($question->type === 'true_false' ? 'bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-400' : 
                       ($question->type === 'short_answer' ? 'bg-yellow-100 text-yellow-800 dark:bg-yellow-900/30 dark:text-yellow-400' : 
                       'bg-purple-100 text-purple-800 dark:bg-purple-900/30 dark:text-purple-400')) }}">
                    @if($question->type === 'multiple_choice')
                        Multiple Choice
                    @elseif($question->type === 'true_false')
                        True/False
                    @elseif($question->type === 'short_answer')
                        Short Answer
                    @else
                        Essay
                    @endif
                </span>
                <span class="px-3 py-1 rounded-full text-xs font-medium bg-indigo-100 text-indigo-800 dark:bg-indigo-900/30 dark:text-indigo-400">
                    {{ $question->points }} পয়েন্ট
                </span>
                <span class="px-3 py-1 rounded-full text-xs font-medium bg-purple-100 text-purple-800 dark:bg-purple-900/30 dark:text-purple-400">
                    {{ $question->answers->count() }} টি উত্তর
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
                        <p class="text-sm font-semibold text-gray-900 dark:text-white">{{ $question->quiz->lesson->section->course->title }}</p>
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
                        <p class="text-sm font-semibold text-gray-900 dark:text-white">{{ $question->quiz->lesson->title }}</p>
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
                        <p class="text-sm font-semibold text-gray-900 dark:text-white">{{ $question->quiz->title }}</p>
                    </div>
                </div>
            </div>

            <div class="bg-gray-50 dark:bg-slate-700/50 p-4 rounded-lg border border-gray-200 dark:border-slate-600">
                <div class="flex items-center">
                    <div class="p-2 bg-yellow-100 dark:bg-yellow-900/30 rounded-lg">
                        <i class="fas fa-star text-yellow-600 dark:text-yellow-400"></i>
                    </div>
                    <div class="ml-3">
                        <h4 class="text-sm font-medium text-gray-500 dark:text-gray-400">পয়েন্ট</h4>
                        <p class="text-sm font-semibold text-gray-900 dark:text-white">{{ $question->points }}</p>
                    </div>
                </div>
            </div>

            <div class="bg-gray-50 dark:bg-slate-700/50 p-4 rounded-lg border border-gray-200 dark:border-slate-600">
                <div class="flex items-center">
                    <div class="p-2 bg-red-100 dark:bg-red-900/30 rounded-lg">
                        <i class="fas fa-sort-numeric-down text-red-600 dark:text-red-400"></i>
                    </div>
                    <div class="ml-3">
                        <h4 class="text-sm font-medium text-gray-500 dark:text-gray-400">অর্ডার</h4>
                        <p class="text-sm font-semibold text-gray-900 dark:text-white">{{ $question->order }}</p>
                    </div>
                </div>
            </div>

            <div class="bg-gray-50 dark:bg-slate-700/50 p-4 rounded-lg border border-gray-200 dark:border-slate-600">
                <div class="flex items-center">
                    <div class="p-2 bg-indigo-100 dark:bg-indigo-900/30 rounded-lg">
                        <i class="fas fa-check-circle text-indigo-600 dark:text-indigo-400"></i>
                    </div>
                    <div class="ml-3">
                        <h4 class="text-sm font-medium text-gray-500 dark:text-gray-400">সঠিক উত্তর</h4>
                        <p class="text-sm font-semibold text-gray-900 dark:text-white">
                            {{ $question->correctAnswers->count() }} টি
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
                <p class="text-gray-800 dark:text-gray-200 text-lg leading-relaxed">{{ $question->question }}</p>
            </div>
        </div>

        <!-- Explanation Section -->
        @if($question->explanation)
        <div class="bg-gray-50 dark:bg-slate-700/50 p-6 rounded-lg border border-gray-200 dark:border-slate-600">
            <h4 class="text-lg font-semibold text-gray-800 dark:text-white mb-4 flex items-center">
                <i class="fas fa-lightbulb mr-2 text-yellow-500"></i> ব্যাখ্যা
            </h4>
            <div class="bg-white dark:bg-slate-800 p-6 rounded border border-gray-300 dark:border-slate-600">
                <p class="text-gray-800 dark:text-gray-200 leading-relaxed">{{ $question->explanation }}</p>
            </div>
        </div>
        @endif

        <!-- Answers Section -->
        <div class="bg-gray-50 dark:bg-slate-700/50 p-6 rounded-lg border border-gray-200 dark:border-slate-600">
            <div class="flex flex-col md:flex-row md:items-center justify-between mb-6">
                <h4 class="text-lg font-semibold text-gray-800 dark:text-white flex items-center">
                    <i class="fas fa-list-ol mr-2 text-green-500"></i> উত্তর সমূহ
                    <span class="ml-3 px-2 py-1 bg-green-100 dark:bg-green-900/30 text-green-800 dark:text-green-400 text-sm rounded-full">
                        {{ $question->answers->count() }} টি উত্তর
                    </span>
                </h4>
                <a href="{{ route('admin.answers.create') }}?question_id={{ $question->id }}" 
                   class="inline-flex items-center px-3 py-2 mt-3 md:mt-0 text-sm font-medium rounded-md text-white bg-green-600 hover:bg-green-700 transition-colors">
                    <i class="fas fa-plus mr-2"></i> নতুন উত্তর
                </a>
            </div>
            
            @if($question->answers->count() > 0)
            <div class="bg-white dark:bg-slate-800 rounded-lg border border-gray-300 dark:border-slate-600 overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-300 dark:divide-slate-600">
                        <thead class="bg-gray-100 dark:bg-slate-700">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-700 dark:text-gray-300 uppercase tracking-wider">
                                    উত্তর
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-700 dark:text-gray-300 uppercase tracking-wider">
                                    সঠিক উত্তর
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-700 dark:text-gray-300 uppercase tracking-wider">
                                    অর্ডার
                                </th>
                                <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-700 dark:text-gray-300 uppercase tracking-wider">
                                    অ্যাকশন
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white dark:bg-slate-800 divide-y divide-gray-200 dark:divide-slate-700">
                            @foreach($question->answers as $answer)
                            <tr class="hover:bg-gray-50 dark:hover:bg-slate-700/50 transition-colors">
                                <td class="px-6 py-4">
                                    <div class="text-sm font-medium text-gray-900 dark:text-white">{{ $answer->answer }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="px-2 py-1 rounded-full text-xs font-medium 
                                        {{ $answer->is_correct 
                                            ? 'bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-400' 
                                            : 'bg-gray-100 text-gray-800 dark:bg-gray-900/30 dark:text-gray-400' }}">
                                        {{ $answer->is_correct ? 'সঠিক' : 'ভুল' }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-white">
                                    {{ $answer->order }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                    <div class="flex justify-end gap-3">
                                        <a href="{{ route('admin.answers.edit', $answer) }}" 
                                           class="text-yellow-600 dark:text-yellow-400 hover:text-yellow-900 dark:hover:text-yellow-300 transition-colors" 
                                           title="এডিট">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            @else
            <div class="bg-white dark:bg-slate-800 p-8 rounded-lg border border-gray-300 dark:border-slate-600 text-center">
                <i class="fas fa-exclamation-circle text-4xl text-gray-400 dark:text-gray-500 mb-4"></i>
                <p class="text-gray-500 dark:text-gray-400 text-lg">এই প্রশ্নের কোনো উত্তর নেই</p>
                <p class="text-gray-400 dark:text-gray-500 text-sm mt-2">নিচের বাটনে ক্লিক করে নতুন উত্তর তৈরি করুন</p>
                <a href="{{ route('admin.answers.create') }}?question_id={{ $question->id }}" 
                   class="inline-flex items-center px-4 py-2 mt-4 text-sm font-medium rounded-md text-white bg-green-600 hover:bg-green-700 transition-colors">
                    <i class="fas fa-plus mr-2"></i> নতুন উত্তর তৈরি করুন
                </a>
            </div>
            @endif
        </div>
    </div>
    
    <!-- Footer with Timestamps -->
    <div class="px-6 py-4 bg-gray-50 dark:bg-slate-800 border-t border-gray-200 dark:border-slate-700">
        <div class="flex flex-col sm:flex-row justify-between items-center gap-2 text-xs text-gray-500 dark:text-gray-400">
            <div class="flex items-center">
                <i class="fas fa-info-circle mr-2"></i>
                <span>প্রশ্ন আইডি: {{ $question->id }}</span>
            </div>
            <div class="flex flex-wrap gap-4">
                <span class="flex items-center">
                    <i class="fas fa-calendar-plus mr-1"></i>
                    তৈরি: {{ $question->created_at->format('d M, Y h:i A') }}
                </span>
                @if($question->updated_at->ne($question->created_at))
                <span class="flex items-center">
                    <i class="fas fa-edit mr-1"></i>
                    আপডেট: {{ $question->updated_at->format('d M, Y h:i A') }}
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