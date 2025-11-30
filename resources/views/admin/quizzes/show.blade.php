@extends('layouts.admin')

@section('title', $quiz->title . ' - ProjuktiPlus LMS Admin')

@section('admin-content')

<div class="bg-white dark:bg-slate-800 rounded-lg shadow-lg overflow-hidden border border-gray-200 dark:border-slate-700">
    <!-- Header Section -->
    <div class="px-6 py-4 border-b border-gray-200 dark:border-slate-700 bg-gradient-to-r from-blue-50 to-indigo-50 dark:from-slate-700 dark:to-slate-800">
        <div class="flex flex-col md:flex-row justify-between items-center gap-3">
            <div>
                <h3 class="text-xl font-semibold text-gray-800 dark:text-white">কুইজ বিস্তারিত</h3>
                <p class="text-sm text-gray-600 dark:text-gray-300 mt-1">{{ $quiz->lesson->section->course->title }} - {{ $quiz->lesson->title }}</p>
            </div>
            <div class="flex gap-2">
                <a href="{{ route('admin.quizzes.edit', $quiz) }}" 
                   class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-yellow-500 hover:bg-yellow-600 transition-colors">
                    <i class="fas fa-edit mr-2"></i> এডিট
                </a>
                <a href="{{ route('admin.quizzes.index') }}" 
                   class="inline-flex items-center px-4 py-2 border border-gray-300 dark:border-slate-600 rounded-md shadow-sm text-sm font-medium text-gray-700 dark:text-gray-300 bg-white dark:bg-slate-700 hover:bg-gray-50 dark:hover:bg-slate-600 transition-colors">
                    <i class="fas fa-arrow-left mr-2"></i> পিছনে
                </a>
            </div>
        </div>
    </div>
    
    <!-- Main Content -->
    <div class="px-6 py-6 space-y-8">
        <!-- Quiz Title and Status Badge -->
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 p-6 bg-slate-50 dark:bg-slate-700/50 rounded-lg border border-gray-200 dark:border-slate-600">
            <div>
                <h2 class="text-2xl font-bold text-gray-800 dark:text-white">{{ $quiz->title }}</h2>
                <p class="text-gray-600 dark:text-gray-300 mt-2">{{ $quiz->lesson->section->course->title }} - {{ $quiz->lesson->title }}</p>
            </div>
            <div class="flex flex-wrap gap-2">
                <span class="px-3 py-1 rounded-full text-xs font-medium 
                    {{ $quiz->is_published 
                        ? 'bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-400' 
                        : 'bg-gray-100 text-gray-800 dark:bg-gray-900/30 dark:text-gray-400' }}">
                    {{ $quiz->is_published ? 'Published' : 'Draft' }}
                </span>
                <span class="px-3 py-1 rounded-full text-xs font-medium bg-blue-100 text-blue-800 dark:bg-blue-900/30 dark:text-blue-400">
                    {{ $quiz->total_questions }} টি প্রশ্ন
                </span>
                <span class="px-3 py-1 rounded-full text-xs font-medium bg-purple-100 text-purple-800 dark:bg-purple-900/30 dark:text-purple-400">
                    {{ $quiz->total_points }} পয়েন্ট
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
                        <p class="text-sm font-semibold text-gray-900 dark:text-white">{{ $quiz->lesson->section->course->title }}</p>
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
                        <p class="text-sm font-semibold text-gray-900 dark:text-white">{{ $quiz->lesson->title }}</p>
                    </div>
                </div>
            </div>

            <div class="bg-gray-50 dark:bg-slate-700/50 p-4 rounded-lg border border-gray-200 dark:border-slate-600">
                <div class="flex items-center">
                    <div class="p-2 bg-purple-100 dark:bg-purple-900/30 rounded-lg">
                        <i class="fas fa-question-circle text-purple-600 dark:text-purple-400"></i>
                    </div>
                    <div class="ml-3">
                        <h4 class="text-sm font-medium text-gray-500 dark:text-gray-400">মোট প্রশ্ন</h4>
                        <p class="text-sm font-semibold text-gray-900 dark:text-white">{{ $quiz->total_questions }} টি</p>
                    </div>
                </div>
            </div>

            <div class="bg-gray-50 dark:bg-slate-700/50 p-4 rounded-lg border border-gray-200 dark:border-slate-600">
                <div class="flex items-center">
                    <div class="p-2 bg-yellow-100 dark:bg-yellow-900/30 rounded-lg">
                        <i class="fas fa-trophy text-yellow-600 dark:text-yellow-400"></i>
                    </div>
                    <div class="ml-3">
                        <h4 class="text-sm font-medium text-gray-500 dark:text-gray-400">পাসিং স্কোর</h4>
                        <p class="text-sm font-semibold text-gray-900 dark:text-white">{{ $quiz->passing_score }}%</p>
                    </div>
                </div>
            </div>

            <div class="bg-gray-50 dark:bg-slate-700/50 p-4 rounded-lg border border-gray-200 dark:border-slate-600">
                <div class="flex items-center">
                    <div class="p-2 bg-red-100 dark:bg-red-900/30 rounded-lg">
                        <i class="fas fa-clock text-red-600 dark:text-red-400"></i>
                    </div>
                    <div class="ml-3">
                        <h4 class="text-sm font-medium text-gray-500 dark:text-gray-400">সময় সীমা</h4>
                        <p class="text-sm font-semibold text-gray-900 dark:text-white">
                            {{ $quiz->time_limit ? $quiz->time_limit . ' মিনিট' : 'সময় সীমা নেই' }}
                        </p>
                    </div>
                </div>
            </div>

            <div class="bg-gray-50 dark:bg-slate-700/50 p-4 rounded-lg border border-gray-200 dark:border-slate-600">
                <div class="flex items-center">
                    <div class="p-2 bg-indigo-100 dark:bg-indigo-900/30 rounded-lg">
                        <i class="fas fa-redo text-indigo-600 dark:text-indigo-400"></i>
                    </div>
                    <div class="ml-3">
                        <h4 class="text-sm font-medium text-gray-500 dark:text-gray-400">সর্বোচ্চ প্রচেষ্টা</h4>
                        <p class="text-sm font-semibold text-gray-900 dark:text-white">
                            {{ $quiz->max_attempts == 0 ? 'অসীম' : $quiz->max_attempts . ' বার' }}
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Quiz Settings -->
        <div class="bg-gray-50 dark:bg-slate-700/50 p-6 rounded-lg border border-gray-200 dark:border-slate-600">
            <h4 class="text-lg font-semibold text-gray-800 dark:text-white mb-4 flex items-center">
                <i class="fas fa-cog mr-2 text-blue-500"></i> কুইজ সেটিংস
            </h4>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                <div class="flex items-center">
                    <div class="p-2 rounded-lg {{ $quiz->shuffle_questions ? 'bg-green-100 dark:bg-green-900/30' : 'bg-gray-100 dark:bg-gray-900/30' }}">
                        <i class="fas fa-random {{ $quiz->shuffle_questions ? 'text-green-600 dark:text-green-400' : 'text-gray-400 dark:text-gray-500' }}"></i>
                    </div>
                    <div class="ml-3">
                        <p class="text-sm font-medium text-gray-700 dark:text-gray-300">প্রশ্ন শাফল</p>
                        <p class="text-sm text-gray-500 dark:text-gray-400">{{ $quiz->shuffle_questions ? 'সক্রিয়' : 'নিষ্ক্রিয়' }}</p>
                    </div>
                </div>

                <div class="flex items-center">
                    <div class="p-2 rounded-lg {{ $quiz->shuffle_answers ? 'bg-green-100 dark:bg-green-900/30' : 'bg-gray-100 dark:bg-gray-900/30' }}">
                        <i class="fas fa-shuffle {{ $quiz->shuffle_answers ? 'text-green-600 dark:text-green-400' : 'text-gray-400 dark:text-gray-500' }}"></i>
                    </div>
                    <div class="ml-3">
                        <p class="text-sm font-medium text-gray-700 dark:text-gray-300">উত্তর শাফল</p>
                        <p class="text-sm text-gray-500 dark:text-gray-400">{{ $quiz->shuffle_answers ? 'সক্রিয়' : 'নিষ্ক্রিয়' }}</p>
                    </div>
                </div>

                <div class="flex items-center">
                    <div class="p-2 rounded-lg {{ $quiz->show_correct_answers ? 'bg-green-100 dark:bg-green-900/30' : 'bg-gray-100 dark:bg-gray-900/30' }}">
                        <i class="fas fa-check-circle {{ $quiz->show_correct_answers ? 'text-green-600 dark:text-green-400' : 'text-gray-400 dark:text-gray-500' }}"></i>
                    </div>
                    <div class="ml-3">
                        <p class="text-sm font-medium text-gray-700 dark:text-gray-300">সঠিক উত্তর দেখান</p>
                        <p class="text-sm text-gray-500 dark:text-gray-400">{{ $quiz->show_correct_answers ? 'সক্রিয়' : 'নিষ্ক্রিয়' }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Description Section -->
        <div class="bg-gray-50 dark:bg-slate-700/50 p-6 rounded-lg border border-gray-200 dark:border-slate-600">
            <h4 class="text-lg font-semibold text-gray-800 dark:text-white mb-4 flex items-center">
                <i class="fas fa-align-left mr-2 text-green-500"></i> বিবরণ
            </h4>
            <div class="bg-white dark:bg-slate-800 p-6 rounded border border-gray-300 dark:border-slate-600">
                @if($quiz->description)
                    <p class="text-gray-800 dark:text-gray-200 leading-relaxed">{{ $quiz->description }}</p>
                @else
                    <p class="text-gray-500 dark:text-gray-400 text-center py-4">
                        <i class="fas fa-info-circle mr-2"></i>কোনো বিবরণ যোগ করা হয়নি
                    </p>
                @endif
            </div>
        </div>

        <!-- Questions Section -->
        <div class="bg-gray-50 dark:bg-slate-700/50 p-6 rounded-lg border border-gray-200 dark:border-slate-600">
            <div class="flex flex-col md:flex-row md:items-center justify-between mb-6">
                <h4 class="text-lg font-semibold text-gray-800 dark:text-white flex items-center">
                    <i class="fas fa-list-ol mr-2 text-blue-500"></i> প্রশ্ন সমূহ
                    <span class="ml-3 px-2 py-1 bg-blue-100 dark:bg-blue-900/30 text-blue-800 dark:text-blue-400 text-sm rounded-full">
                        {{ $quiz->questions->count() }} টি প্রশ্ন
                    </span>
                </h4>
                <a href="{{ route('admin.questions.create') }}?quiz_id={{ $quiz->id }}" 
                   class="inline-flex items-center px-3 py-2 mt-3 md:mt-0 text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 transition-colors">
                    <i class="fas fa-plus mr-2"></i> নতুন প্রশ্ন
                </a>
            </div>
            
            @if($quiz->questions->count() > 0)
            <div class="bg-white dark:bg-slate-800 rounded-lg border border-gray-300 dark:border-slate-600 overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-300 dark:divide-slate-600">
                        <thead class="bg-gray-100 dark:bg-slate-700">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-700 dark:text-gray-300 uppercase tracking-wider">
                                    প্রশ্ন
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-700 dark:text-gray-300 uppercase tracking-wider">
                                    টাইপ
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-700 dark:text-gray-300 uppercase tracking-wider">
                                    পয়েন্ট
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
                            @foreach($quiz->questions as $question)
                            <tr class="hover:bg-gray-50 dark:hover:bg-slate-700/50 transition-colors">
                                <td class="px-6 py-4">
                                    <div class="text-sm font-medium text-gray-900 dark:text-white">{{ $question->question_text }}</div>
                                    <div class="text-xs text-gray-500 dark:text-gray-400 mt-1">
                                        {{ $question->answers->count() }} টি উত্তর
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-white">
                                    {{ $question->type }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-white">
                                    {{ $question->points }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-white">
                                    {{ $question->order }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                    <div class="flex justify-end gap-3">
                                        <a href="{{ route('admin.questions.show', $question) }}" 
                                           class="text-blue-600 dark:text-blue-400 hover:text-blue-900 dark:hover:text-blue-300 transition-colors" 
                                           title="দেখুন">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="{{ route('admin.questions.edit', $question) }}" 
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
                <i class="fas fa-question-circle text-4xl text-gray-400 dark:text-gray-500 mb-4"></i>
                <p class="text-gray-500 dark:text-gray-400 text-lg">এই কুইজে কোনো প্রশ্ন নেই</p>
                <p class="text-gray-400 dark:text-gray-500 text-sm mt-2">নিচের বাটনে ক্লিক করে নতুন প্রশ্ন তৈরি করুন</p>
                <a href="{{ route('admin.questions.create') }}?quiz_id={{ $quiz->id }}" 
                   class="inline-flex items-center px-4 py-2 mt-4 text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 transition-colors">
                    <i class="fas fa-plus mr-2"></i> নতুন প্রশ্ন তৈরি করুন
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
                <span>কুইজ আইডি: {{ $quiz->id }}</span>
            </div>
            <div class="flex flex-wrap gap-4">
                <span class="flex items-center">
                    <i class="fas fa-calendar-plus mr-1"></i>
                    তৈরি: {{ $quiz->created_at->format('d M, Y h:i A') }}
                </span>
                @if($quiz->updated_at->ne($quiz->created_at))
                <span class="flex items-center">
                    <i class="fas fa-edit mr-1"></i>
                    আপডেট: {{ $quiz->updated_at->format('d M, Y h:i A') }}
                </span>
                @endif
                @if($quiz->published_at)
                <span class="flex items-center">
                    <i class="fas fa-check-circle mr-1"></i>
                    পাবলিশ: {{ $quiz->published_at->format('d M, Y h:i A') }}
                </span>
                @endif
            </div>
            <div class="flex items-center">
                <i class="fas fa-history mr-1"></i>
                <span>প্রচেষ্টা: {{ $quiz->attempts->count() }} বার</span>
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