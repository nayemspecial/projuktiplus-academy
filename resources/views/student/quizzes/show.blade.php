@extends('layouts.student')

@section('title', $quiz->title . ' - ProjuktiPlus LMS')

@section('student-content')
<div class="mx-auto">
    <nav class="flex mb-6" aria-label="Breadcrumb">
        <ol class="inline-flex items-center space-x-1 md:space-x-3">
            <li class="inline-flex items-center">
                <a href="{{ route('student.quizzes.index') }}" class="text-gray-700 hover:text-blue-600 dark:text-gray-400 dark:hover:text-white">
                    কুইজসমূহ
                </a>
            </li>
            <li aria-current="page">
                <div class="flex items-center">
                    <i class="fas fa-chevron-right text-gray-400 mx-2 text-xs"></i>
                    <span class="text-gray-500 dark:text-gray-400">{{ $quiz->title }}</span>
                </div>
            </li>
        </ol>
    </nav>

    <div class="bg-white dark:bg-slate-800 rounded-lg shadow-lg overflow-hidden">
        <div class="p-6 md:p-8 border-b border-gray-200 dark:border-slate-700">
            <h1 class="text-2xl md:text-3xl font-bold text-gray-900 dark:text-white mb-4">{{ $quiz->title }}</h1>
            <p class="text-gray-600 dark:text-gray-300 mb-6">{{ $quiz->description ?? 'এই কুইজে অংশগ্রহণ করে আপনার দক্ষতা যাচাই করুন।' }}</p>
            
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4 text-center">
                <div class="p-4 bg-gray-50 dark:bg-slate-700/50 rounded-lg">
                    <i class="fas fa-question-circle text-blue-500 text-xl mb-2"></i>
                    <p class="text-sm text-gray-500 dark:text-gray-400">মোট প্রশ্ন</p>
                    <p class="text-lg font-semibold text-gray-900 dark:text-white">{{ $quiz->total_questions }}</p>
                </div>
                <div class="p-4 bg-gray-50 dark:bg-slate-700/50 rounded-lg">
                    <i class="fas fa-clock text-blue-500 text-xl mb-2"></i>
                    <p class="text-sm text-gray-500 dark:text-gray-400">সময়সীমা</p>
                    <p class="text-lg font-semibold text-gray-900 dark:text-white">{{ $quiz->time_limit ? $quiz->time_limit . ' মি.' : 'অসীম' }}</p>
                </div>
                <div class="p-4 bg-gray-50 dark:bg-slate-700/50 rounded-lg">
                    <i class="fas fa-check-circle text-blue-500 text-xl mb-2"></i>
                    <p class="text-sm text-gray-500 dark:text-gray-400">পাস মার্ক</p>
                    <p class="text-lg font-semibold text-gray-900 dark:text-white">{{ $quiz->passing_score }}%</p>
                </div>
                <div class="p-4 bg-gray-50 dark:bg-slate-700/50 rounded-lg">
                    <i class="fas fa-redo text-blue-500 text-xl mb-2"></i>
                    <p class="text-sm text-gray-500 dark:text-gray-400">অ্যাটেম্পট বাকি</p>
                    <p class="text-lg font-semibold text-gray-900 dark:text-white">
                        {{ $quiz->max_attempts == 0 ? 'অসীম' : ($quiz->max_attempts - $previousAttempts->count()) }}
                    </p>
                </div>
            </div>
        </div>

        @if($previousAttempts->count() > 0)
        <div class="p-6 md:p-8 border-b border-gray-200 dark:border-slate-700">
            <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">পূর্ববর্তী ফলাফল</h3>
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200 dark:divide-slate-700">
                    <thead class="bg-gray-50 dark:bg-slate-700/50">
                        <tr>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">তারিখ</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">স্কোর</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">ফলাফল</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200 dark:divide-slate-700">
                        @foreach($previousAttempts as $attempt)
                        <tr>
                            <td class="px-4 py-3 text-sm text-gray-900 dark:text-white">
                                {{ $attempt->completed_at ? $attempt->completed_at->format('d M, Y h:i A') : 'অসম্পূর্ণ' }}
                            </td>
                            <td class="px-4 py-3 text-sm text-gray-900 dark:text-white">
                                {{ $attempt->score }}%
                            </td>
                            <td class="px-4 py-3 text-sm">
                                @if($attempt->passed)
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-400">উত্তীর্ণ</span>
                                @else
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800 dark:bg-red-900/30 dark:text-red-400">অকৃতকার্য</span>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        @endif

        <div class="p-6 md:p-8 text-center">
            @if($canRetake)
                <form action="{{ route('student.quizzes.start', $quiz->id) }}" method="POST">
                    @csrf
                    <button type="submit" class="inline-flex items-center px-8 py-3 border border-transparent text-base font-medium rounded-md shadow-sm text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition w-full md:w-auto justify-center">
                        <i class="fas fa-play-circle mr-2"></i> কুইজ শুরু করুন
                    </button>
                </form>
                <p class="text-sm text-gray-500 dark:text-gray-400 mt-4">
                    <i class="fas fa-info-circle mr-1"></i> কুইজ শুরু করার পর মাঝপথে বন্ধ করলে সেটি একটি অ্যাটেম্পট হিসেবে গণ্য হবে।
                </p>
            @else
                <div class="bg-yellow-50 dark:bg-yellow-900/20 border-l-4 border-yellow-400 p-4">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <i class="fas fa-exclamation-triangle text-yellow-400"></i>
                        </div>
                        <div class="ml-3">
                            <p class="text-sm text-yellow-700 dark:text-yellow-400">
                                আপনি সর্বোচ্চ সংখ্যকবার চেষ্টা করেছেন। আর নতুন করে কুইজ দেওয়া সম্ভব নয়।
                            </p>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection