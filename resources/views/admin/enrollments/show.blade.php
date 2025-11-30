@extends('layouts.admin')

@section('title', 'এনরোলমেন্ট বিস্তারিত - ProjuktiPlus LMS Admin')

@section('admin-content')

<div class="bg-white dark:bg-slate-800 rounded-lg shadow-lg overflow-hidden border border-gray-200 dark:border-slate-700">
    <!-- Header Section -->
    <div class="px-6 py-4 border-b border-gray-200 dark:border-slate-700 bg-gradient-to-r from-blue-50 to-indigo-50 dark:from-slate-700 dark:to-slate-800">
        <div class="flex flex-col md:flex-row justify-between items-center gap-3">
            <div>
                <h3 class="text-xl font-semibold text-gray-800 dark:text-white">এনরোলমেন্ট বিস্তারিত</h3>
                <p class="text-sm text-gray-600 dark:text-gray-300 mt-1">ID: {{ $enrollment->id }}</p>
            </div>
            <div class="flex gap-2">
                <a href="{{ route('admin.enrollments.edit', $enrollment) }}" 
                   class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-yellow-500 hover:bg-yellow-600 transition-colors">
                    <i class="fas fa-edit mr-2"></i> এডিট
                </a>
                <a href="{{ route('admin.enrollments.index') }}" 
                   class="inline-flex items-center px-4 py-2 border border-gray-300 dark:border-slate-600 rounded-md shadow-sm text-sm font-medium text-gray-700 dark:text-gray-300 bg-white dark:bg-slate-700 hover:bg-gray-50 dark:hover:bg-slate-600 transition-colors">
                    <i class="fas fa-arrow-left mr-2"></i> পিছনে
                </a>
            </div>
        </div>
    </div>
    
    <!-- Main Content -->
    <div class="px-6 py-6 space-y-8">
        <!-- Enrollment Header -->
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 p-6 bg-slate-50 dark:bg-slate-700/50 rounded-lg border border-gray-200 dark:border-slate-600">
            <div class="flex-1">
                <h2 class="text-2xl font-bold text-gray-800 dark:text-white">{{ $enrollment->user->name }}</h2>
                <p class="text-gray-600 dark:text-gray-300 mt-2">{{ $enrollment->course->title }}</p>
            </div>
            <div class="flex flex-wrap gap-2">
                <span class="px-3 py-1 rounded-full text-xs font-medium 
                    {{ $enrollment->status === 'active' 
                        ? 'bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-400' : 
                       ($enrollment->status === 'completed' 
                        ? 'bg-blue-100 text-blue-800 dark:bg-blue-900/30 dark:text-blue-400' :
                       ($enrollment->status === 'cancelled' 
                        ? 'bg-red-100 text-red-800 dark:bg-red-900/30 dark:text-red-400' :
                        'bg-yellow-100 text-yellow-800 dark:bg-yellow-900/30 dark:text-yellow-400')) }}">
                    {{ $enrollment->status }}
                </span>
                <span class="px-3 py-1 rounded-full text-xs font-medium bg-purple-100 text-purple-800 dark:bg-purple-900/30 dark:text-purple-400">
                    ৳{{ number_format($enrollment->price_paid, 2) }}
                </span>
                <span class="px-3 py-1 rounded-full text-xs font-medium bg-indigo-100 text-indigo-800 dark:bg-indigo-900/30 dark:text-indigo-400">
                    {{ $enrollment->progress }}% Complete
                </span>
            </div>
        </div>

        <!-- Basic Information Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <!-- Information Cards -->
            <div class="bg-gray-50 dark:bg-slate-700/50 p-4 rounded-lg border border-gray-200 dark:border-slate-600">
                <div class="flex items-center">
                    <div class="p-2 bg-blue-100 dark:bg-blue-900/30 rounded-lg">
                        <i class="fas fa-user text-blue-600 dark:text-blue-400"></i>
                    </div>
                    <div class="ml-3">
                        <h4 class="text-sm font-medium text-gray-500 dark:text-gray-400">ছাত্র</h4>
                        <p class="text-sm font-semibold text-gray-900 dark:text-white">{{ $enrollment->user->name }}</p>
                        <p class="text-xs text-gray-500 dark:text-gray-400">{{ $enrollment->user->email }}</p>
                    </div>
                </div>
            </div>

            <div class="bg-gray-50 dark:bg-slate-700/50 p-4 rounded-lg border border-gray-200 dark:border-slate-600">
                <div class="flex items-center">
                    <div class="p-2 bg-green-100 dark:bg-green-900/30 rounded-lg">
                        <i class="fas fa-book text-green-600 dark:text-green-400"></i>
                    </div>
                    <div class="ml-3">
                        <h4 class="text-sm font-medium text-gray-500 dark:text-gray-400">কোর্স</h4>
                        <p class="text-sm font-semibold text-gray-900 dark:text-white">{{ $enrollment->course->title }}</p>
                        <p class="text-xs text-gray-500 dark:text-gray-400">{{ $enrollment->course->instructor->name }}</p>
                    </div>
                </div>
            </div>

            <div class="bg-gray-50 dark:bg-slate-700/50 p-4 rounded-lg border border-gray-200 dark:border-slate-600">
                <div class="flex items-center">
                    <div class="p-2 bg-yellow-100 dark:bg-yellow-900/30 rounded-lg">
                        <i class="fas fa-money-bill-wave text-yellow-600 dark:text-yellow-400"></i>
                    </div>
                    <div class="ml-3">
                        <h4 class="text-sm font-medium text-gray-500 dark:text-gray-400">প্রদত্ত মূল্য</h4>
                        <p class="text-sm font-semibold text-gray-900 dark:text-white">৳{{ number_format($enrollment->price_paid, 2) }}</p>
                        <p class="text-xs text-gray-500 dark:text-gray-400">কোর্স মূল্য: ৳{{ number_format($enrollment->course->price, 2) }}</p>
                    </div>
                </div>
            </div>

            <div class="bg-gray-50 dark:bg-slate-700/50 p-4 rounded-lg border border-gray-200 dark:border-slate-600">
                <div class="flex items-center">
                    <div class="p-2 bg-purple-100 dark:bg-purple-900/30 rounded-lg">
                        <i class="fas fa-tasks text-purple-600 dark:text-purple-400"></i>
                    </div>
                    <div class="ml-3">
                        <h4 class="text-sm font-medium text-gray-500 dark:text-gray-400">প্রোগ্রেস</h4>
                        <p class="text-sm font-semibold text-gray-900 dark:text-white">{{ $enrollment->progress }}%</p>
                        <p class="text-xs text-gray-500 dark:text-gray-400">
                            {{ $enrollment->completed_lessons }}/{{ $enrollment->total_lessons }} লেসন
                        </p>
                    </div>
                </div>
            </div>

            <div class="bg-gray-50 dark:bg-slate-700/50 p-4 rounded-lg border border-gray-200 dark:border-slate-600">
                <div class="flex items-center">
                    <div class="p-2 bg-red-100 dark:bg-red-900/30 rounded-lg">
                        <i class="fas fa-certificate text-red-600 dark:text-red-400"></i>
                    </div>
                    <div class="ml-3">
                        <h4 class="text-sm font-medium text-gray-500 dark:text-gray-400">সার্টিফিকেট</h4>
                        <p class="text-sm font-semibold text-gray-900 dark:text-white">
                            {{ $enrollment->certificates->count() }} টি
                        </p>
                        <p class="text-xs text-gray-500 dark:text-gray-400">
                            {{ $enrollment->isCompleted() ? 'সম্পূর্ণ' : 'অসম্পূর্ণ' }}
                        </p>
                    </div>
                </div>
            </div>

            <div class="bg-gray-50 dark:bg-slate-700/50 p-4 rounded-lg border border-gray-200 dark:border-slate-600">
                <div class="flex items-center">
                    <div class="p-2 bg-indigo-100 dark:bg-indigo-900/30 rounded-lg">
                        <i class="fas fa-history text-indigo-600 dark:text-indigo-400"></i>
                    </div>
                    <div class="ml-3">
                        <h4 class="text-sm font-medium text-gray-500 dark:text-gray-400">কুইজ প্রচেষ্টা</h4>
                        <p class="text-sm font-semibold text-gray-900 dark:text-white">
                            {{ $enrollment->quizAttempts->count() }} বার
                        </p>
                        <p class="text-xs text-gray-500 dark:text-gray-400">
                            শেষ অ্যাক্সেস: {{ $enrollment->last_accessed_at?->format('d M, Y') ?? 'N/A' }}
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Progress Section -->
        <div class="bg-gray-50 dark:bg-slate-700/50 p-6 rounded-lg border border-gray-200 dark:border-slate-600">
            <h4 class="text-lg font-semibold text-gray-800 dark:text-white mb-4 flex items-center">
                <i class="fas fa-chart-line mr-2 text-blue-500"></i> অগ্রগতি বিবরণ
            </h4>
            <div class="bg-white dark:bg-slate-800 p-6 rounded border border-gray-300 dark:border-slate-600">
                <div class="mb-4">
                    <div class="flex justify-between items-center mb-2">
                        <span class="text-sm font-medium text-gray-700 dark:text-gray-300">কোর্স অগ্রগতি</span>
                        <span class="text-sm font-medium text-gray-700 dark:text-gray-300">{{ $enrollment->progress }}%</span>
                    </div>
                    <div class="w-full bg-gray-200 dark:bg-slate-600 rounded-full h-3">
                        <div class="bg-blue-600 h-2 rounded-full" :style="'width: ' + {{ $enrollment->progress }} + '%'"></div>
                    </div>
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-6">
                    <div class="text-center p-4 bg-blue-50 dark:bg-blue-900/20 rounded-lg">
                        <div class="text-2xl font-bold text-blue-600 dark:text-blue-400">{{ $enrollment->completed_lessons }}</div>
                        <div class="text-sm text-gray-600 dark:text-gray-300">সম্পূর্ণ লেসন</div>
                    </div>
                    <div class="text-center p-4 bg-green-50 dark:bg-green-900/20 rounded-lg">
                        <div class="text-2xl font-bold text-green-600 dark:text-green-400">{{ $enrollment->total_lessons }}</div>
                        <div class="text-sm text-gray-600 dark:text-gray-300">মোট লেসন</div>
                    </div>
                    <div class="text-center p-4 bg-purple-50 dark:bg-purple-900/20 rounded-lg">
                        <div class="text-2xl font-bold text-purple-600 dark:text-purple-400">{{ $enrollment->quizAttempts->count() }}</div>
                        <div class="text-sm text-gray-600 dark:text-gray-300">কুইজ প্রচেষ্টা</div>
                    </div>
                    <div class="text-center p-4 bg-yellow-50 dark:bg-yellow-900/20 rounded-lg">
                        <div class="text-2xl font-bold text-yellow-600 dark:text-yellow-400">{{ $enrollment->certificates->count() }}</div>
                        <div class="text-sm text-gray-600 dark:text-gray-300">সার্টিফিকেট</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Completed Lessons Section -->
        @if($enrollment->completedLessons->count() > 0)
        <div class="bg-gray-50 dark:bg-slate-700/50 p-6 rounded-lg border border-gray-200 dark:border-slate-600">
            <h4 class="text-lg font-semibold text-gray-800 dark:text-white mb-4 flex items-center">
                <i class="fas fa-check-circle mr-2 text-green-500"></i> সম্পূর্ণ লেসন সমূহ
                <span class="ml-3 px-2 py-1 bg-green-100 dark:bg-green-900/30 text-green-800 dark:text-green-400 text-sm rounded-full">
                    {{ $enrollment->completedLessons->count() }} টি
                </span>
            </h4>
            <div class="bg-white dark:bg-slate-800 rounded-lg border border-gray-300 dark:border-slate-600 overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-300 dark:divide-slate-600">
                        <thead class="bg-gray-100 dark:bg-slate-700">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 dark:text-gray-300 uppercase tracking-wider">
                                    লেসন
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 dark:text-gray-300 uppercase tracking-wider">
                                    সেকশন
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 dark:text-gray-300 uppercase tracking-wider">
                                    সম্পূর্ণ তারিখ
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white dark:bg-slate-800 divide-y divide-gray-200 dark:divide-slate-700">
                            @foreach($enrollment->completedLessons as $completedLesson)
                            <tr class="hover:bg-gray-50 dark:hover:bg-slate-700/50 transition-colors">
                                <td class="px-6 py-4">
                                    <div class="text-sm font-medium text-gray-900 dark:text-white">{{ $completedLesson->lesson->title }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-white">
                                    {{ $completedLesson->lesson->section->title }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">
                                    {{ $completedLesson->created_at->format('d M, Y h:i A') }}
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        @endif

        <!-- Quiz Attempts Section -->
        @if($enrollment->quizAttempts->count() > 0)
        <div class="bg-gray-50 dark:bg-slate-700/50 p-6 rounded-lg border border-gray-200 dark:border-slate-600">
            <h4 class="text-lg font-semibold text-gray-800 dark:text-white mb-4 flex items-center">
                <i class="fas fa-clipboard-list mr-2 text-blue-500"></i> কুইজ প্রচেষ্টা
                <span class="ml-3 px-2 py-1 bg-blue-100 dark:bg-blue-900/30 text-blue-800 dark:text-blue-400 text-sm rounded-full">
                    {{ $enrollment->quizAttempts->count() }} টি
                </span>
            </h4>
            <div class="bg-white dark:bg-slate-800 rounded-lg border border-gray-300 dark:border-slate-600 overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-300 dark:divide-slate-600">
                        <thead class="bg-gray-100 dark:bg-slate-700">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 dark:text-gray-300 uppercase tracking-wider">
                                    কুইজ
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 dark:text-gray-300 uppercase tracking-wider">
                                    স্কোর
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 dark:text-gray-300 uppercase tracking-wider">
                                    স্ট্যাটাস
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 dark:text-gray-300 uppercase tracking-wider">
                                    তারিখ
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white dark:bg-slate-800 divide-y divide-gray-200 dark:divide-slate-700">
                            @foreach($enrollment->quizAttempts as $attempt)
                            <tr class="hover:bg-gray-50 dark:hover:bg-slate-700/50 transition-colors">
                                <td class="px-6 py-4">
                                    <div class="text-sm font-medium text-gray-900 dark:text-white">{{ $attempt->quiz->title }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-white">
                                    {{ $attempt->score }}%
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="px-2 py-1 rounded-full text-xs font-medium 
                                        {{ $attempt->quiz->isPassed($attempt->score) 
                                            ? 'bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-400' 
                                            : 'bg-red-100 text-red-800 dark:bg-red-900/30 dark:text-red-400' }}">
                                        {{ $attempt->quiz->isPassed($attempt->score) ? 'পাস' : 'ফেল' }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">
                                    {{ $attempt->created_at->format('d M, Y h:i A') }}
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        @endif

        <!-- Cancellation Reason Section -->
        @if($enrollment->cancellation_reason)
        <div class="bg-gray-50 dark:bg-slate-700/50 p-6 rounded-lg border border-gray-200 dark:border-slate-600">
            <h4 class="text-lg font-semibold text-gray-800 dark:text-white mb-4 flex items-center">
                <i class="fas fa-times-circle mr-2 text-red-500"></i> বাতিলের কারণ
            </h4>
            <div class="bg-white dark:bg-slate-800 p-6 rounded border border-gray-300 dark:border-slate-600">
                <p class="text-gray-800 dark:text-gray-200 leading-relaxed">{{ $enrollment->cancellation_reason }}</p>
            </div>
        </div>
        @endif
    </div>
    
    <!-- Footer with Timestamps -->
    <div class="px-6 py-4 bg-gray-50 dark:bg-slate-800 border-t border-gray-200 dark:border-slate-700">
        <div class="flex flex-col sm:flex-row justify-between items-center gap-2 text-xs text-gray-500 dark:text-gray-400">
            <div class="flex items-center">
                <i class="fas fa-info-circle mr-2"></i>
                <span>এনরোলমেন্ট আইডি: {{ $enrollment->id }}</span>
            </div>
            <div class="flex flex-wrap gap-4">
                <span class="flex items-center">
                    <i class="fas fa-calendar-plus mr-1"></i>
                    এনরোল: {{ $enrollment->created_at->format('d M, Y h:i A') }}
                </span>
                @if($enrollment->updated_at->ne($enrollment->created_at))
                <span class="flex items-center">
                    <i class="fas fa-edit mr-1"></i>
                    আপডেট: {{ $enrollment->updated_at->format('d M, Y h:i A') }}
                </span>
                @endif
                @if($enrollment->completed_at)
                <span class="flex items-center">
                    <i class="fas fa-check-circle mr-1"></i>
                    সম্পূর্ণ: {{ $enrollment->completed_at->format('d M, Y h:i A') }}
                </span>
                @endif
                @if($enrollment->last_accessed_at)
                <span class="flex items-center">
                    <i class="fas fa-history mr-1"></i>
                    শেষ অ্যাক্সেস: {{ $enrollment->last_accessed_at->format('d M, Y h:i A') }}
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