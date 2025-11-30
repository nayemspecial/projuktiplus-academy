@extends('layouts.student')

@section('title', 'আমার অগ্রগতি - ProjuktiPlus LMS')

@section('student-content')
<div class="max-w-7xl mx-auto">
    <div class="mb-8">
        <h1 class="text-2xl font-bold text-gray-800 dark:text-white">আমার অগ্রগতি (Progress)</h1>
        <p class="text-gray-600 dark:text-gray-400">আপনার শেখার সামগ্রিক পরিসংখ্যান দেখুন</p>
    </div>

    @if($stats)
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        
        <div class="bg-white dark:bg-slate-800 rounded-lg shadow-sm p-6 flex items-center gap-5">
            <div class="flex-shrink-0 w-16 h-16 rounded-full bg-blue-100 dark:bg-blue-900/30 flex items-center justify-center">
                <div class="relative w-12 h-12">
                    <svg class="w-full h-full" viewBox="0 0 36 36">
                        <path d="M18 2.0845 a 15.9155 15.9155 0 0 1 0 31.831 a 15.9155 15.9155 0 0 1 0 -31.831" fill="none" stroke="#e6e6e6" stroke-width="3"/>
                        <path d="M18 2.0845 a 15.9155 15.9155 0 0 1 0 31.831 a 15.9155 15.9155 0 0 1 0 -31.831" fill="none" stroke="#3b82f6" stroke-width="3" stroke-dasharray="{{ $stats['averageProgress'] }}, 100" class="progress-ring__circle"/>
                    </svg>
                    <span class="absolute inset-0 flex items-center justify-center text-xs font-bold text-blue-600 dark:text-blue-300">{{ $stats['averageProgress'] }}%</span>
                </div>
            </div>
            <div>
                <p class="text-sm text-gray-500 dark:text-gray-400">গড় অগ্রগতি</p>
                <p class="text-2xl font-bold text-gray-900 dark:text-white">{{ $stats['averageProgress'] }}%</p>
            </div>
        </div>

        <div class="bg-white dark:bg-slate-800 rounded-lg shadow-sm p-6 flex items-center gap-5">
            <div class="flex-shrink-0 w-16 h-16 rounded-full bg-green-100 dark:bg-green-900/30 flex items-center justify-center">
                <i class="fas fa-graduation-cap text-3xl text-green-600 dark:text-green-400"></i>
            </div>
            <div>
                <p class="text-sm text-gray-500 dark:text-gray-400">কোর্স সম্পন্ন</p>
                <p class="text-2xl font-bold text-gray-900 dark:text-white">{{ $stats['completedCourses'] }} / {{ $stats['totalCourses'] }}</p>
            </div>
        </div>

        <div class="bg-white dark:bg-slate-800 rounded-lg shadow-sm p-6 flex items-center gap-5">
            <div class="flex-shrink-0 w-16 h-16 rounded-full bg-indigo-100 dark:bg-indigo-900/30 flex items-center justify-center">
                <i class="fas fa-book-open text-3xl text-indigo-600 dark:text-indigo-400"></i>
            </div>
            <div>
                <p class="text-sm text-gray-500 dark:text-gray-400">লেসন সম্পন্ন</p>
                <p class="text-2xl font-bold text-gray-900 dark:text-white">{{ $stats['completedLessons'] }} / {{ $stats['totalLessons'] }}</p>
            </div>
        </div>

        <div class="bg-white dark:bg-slate-800 rounded-lg shadow-sm p-6 flex items-center gap-5">
            <div class="flex-shrink-0 w-16 h-16 rounded-full bg-yellow-100 dark:bg-yellow-900/30 flex items-center justify-center">
                <i class="fas fa-clock text-3xl text-yellow-600 dark:text-yellow-400"></i>
            </div>
            <div>
                <p class="text-sm text-gray-500 dark:text-gray-400">মোট সময় ব্যয়</p>
                <p class="text-2xl font-bold text-gray-900 dark:text-white">{{ $stats['totalHoursSpent'] }} ঘন্টা</p>
            </div>
        </div>
    </div>

    <div class="bg-white dark:bg-slate-800 rounded-lg shadow-sm overflow-hidden">
        <div class="p-6 border-b border-gray-200 dark:border-slate-700">
            <h3 class="text-lg font-semibold text-gray-900 dark:text-white">কোর্স অনুযায়ী অগ্রগতি</h3>
        </div>
        
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200 dark:divide-slate-700">
                <thead class="bg-gray-50 dark:bg-slate-700/50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">কোর্স</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">লেসন সম্পন্ন</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">স্ট্যাটাস</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">অগ্রগতি</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200 dark:divide-slate-700">
                    @foreach($coursesProgress as $enrollment)
                    <tr class="hover:bg-gray-50 dark:hover:bg-slate-700/50 transition">
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm font-medium text-gray-900 dark:text-white">{{ $enrollment->course->title }}</div>
                            <div class="text-xs text-gray-500 dark:text-gray-400">{{ $enrollment->course->instructor->name ?? 'N/A' }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="text-sm text-gray-900 dark:text-white">{{ $enrollment->completed_lessons }}</span>
                            <span class="text-sm text-gray-500 dark:text-gray-400">/ {{ $enrollment->total_lessons }}</span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            @if($enrollment->status == 'completed')
                                <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-400">
                                    সম্পন্ন
                                </span>
                            @else
                                <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800 dark:bg-blue-900/30 dark:text-blue-400">
                                    চলমান
                                </span>
                            @endif
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center gap-3">
                                <div class="w-full bg-gray-200 dark:bg-slate-700 rounded-full h-2">
                                    <div class="h-2 rounded-full {{ $enrollment->status == 'completed' ? 'bg-green-500' : 'bg-blue-600' }}" style="width: {{ $enrollment->progress }}%"></div>
                                </div>
                                <span class="text-sm font-medium text-gray-600 dark:text-gray-300">{{ $enrollment->progress }}%</span>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    @else
    <div class="text-center py-16 bg-white dark:bg-slate-800 rounded-lg shadow-sm">
        <div class="inline-flex items-center justify-center w-24 h-24 bg-blue-100 dark:bg-blue-900/30 rounded-full mb-6">
            <i class="fas fa-chart-line text-5xl text-blue-600 dark:text-blue-500"></i>
        </div>
        <h3 class="text-xl font-medium text-gray-900 dark:text-white mb-2">কোনো অগ্রগতির তথ্য নেই</h3>
        <p class="text-gray-500 dark:text-gray-400 max-w-md mx-auto mb-6">আপনি এখনো কোনো কোর্সে এনরোল করেননি। কোর্স শুরু করুন এবং আপনার অগ্রগতি এখানে দেখুন।</p>
        <a href="{{ route('student.courses.index') }}" class="inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 transition">
            আমার কোর্সসমূহ দেখুন
        </a>
    </div>
    @endif
</div>
@endsection