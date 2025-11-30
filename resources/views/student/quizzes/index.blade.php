@extends('layouts.student')

@section('title', 'আমার কুইজসমূহ - ProjuktiPlus LMS')

@section('student-content')
<div class="mx-auto">
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-800 dark:text-white">আমার কুইজসমূহ</h1>
        <p class="text-gray-600 dark:text-gray-400">আপনার এনরোল করা কোর্সের সব কুইজ</p>
    </div>

    <div class="bg-white dark:bg-slate-800 rounded-lg shadow overflow-hidden">
        @if($quizzes->count() > 0)
            <div class="divide-y divide-gray-200 dark:divide-slate-700">
                @foreach($quizzes as $quiz)
                    @php
                        $lastAttempt = $quiz->attempts->first();
                        $status = 'pending';
                        $statusLabel = 'দেওয়া হয়নি';
                        $statusColor = 'bg-gray-100 text-gray-800 dark:bg-slate-700 dark:text-gray-300';

                        if ($lastAttempt) {
                            if ($lastAttempt->completed_at) {
                                if ($lastAttempt->passed) {
                                    $status = 'passed';
                                    $statusLabel = 'উত্তীর্ণ (' . $lastAttempt->score . '%)';
                                    $statusColor = 'bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-400';
                                } else {
                                    $status = 'failed';
                                    $statusLabel = 'অকৃতকার্য (' . $lastAttempt->score . '%)';
                                    $statusColor = 'bg-red-100 text-red-800 dark:bg-red-900/30 dark:text-red-400';
                                }
                            } else {
                                $status = 'in_progress';
                                $statusLabel = 'চলমান';
                                $statusColor = 'bg-yellow-100 text-yellow-800 dark:bg-yellow-900/30 dark:text-yellow-400';
                            }
                        }
                    @endphp
                    <div class="p-6 hover:bg-gray-50 dark:hover:bg-slate-700/50 transition">
                        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
                            <div class="flex-1">
                                <div class="flex items-center gap-3 mb-2">
                                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                                        <a href="{{ route('student.quizzes.show', $quiz->id) }}" class="hover:text-blue-600 dark:hover:text-blue-400 transition">
                                            {{ $quiz->title }}
                                        </a>
                                    </h3>
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $statusColor }}">
                                        {{ $statusLabel }}
                                    </span>
                                </div>
                                <p class="text-sm text-gray-500 dark:text-gray-400">
                                    <span class="font-medium">{{ $quiz->lesson->section->course->title }}</span> • 
                                    {{ $quiz->total_questions }} টি প্রশ্ন • 
                                    {{ $quiz->time_limit ? $quiz->time_limit . ' মিনিট' : 'কোনো সময়সীমা নেই' }}
                                </p>
                            </div>
                            <div class="flex items-center gap-4">
                                @if($lastAttempt && $lastAttempt->passed)
                                     <a href="{{ route('student.quizzes.result', $quiz->id) }}" class="text-sm font-medium text-blue-600 dark:text-blue-400 hover:underline">
                                        ফলাফল দেখুন
                                    </a>
                                @else
                                    <a href="{{ route('student.quizzes.show', $quiz->id) }}" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition">
                                        {{ $lastAttempt ? 'আবার চেষ্টা করুন' : 'কুইজ শুরু করুন' }}
                                    </a>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            
            @if($quizzes->hasPages())
                <div class="px-6 py-4 border-t border-gray-200 dark:border-slate-700">
                    {{ $quizzes->links() }}
                </div>
            @endif

        @else
            <div class="text-center py-12 p-6">
                <i class="fas fa-clipboard-list text-5xl text-gray-300 dark:text-slate-600 mb-4"></i>
                <h3 class="text-xl font-medium text-gray-900 dark:text-white mb-2">কোনো কুইজ পাওয়া যায়নি</h3>
                <p class="text-gray-500 dark:text-gray-400">আপনার এনরোল করা কোর্সগুলোতে বর্তমানে কোনো কুইজ নেই।</p>
            </div>
        @endif
    </div>
</div>
@endsection