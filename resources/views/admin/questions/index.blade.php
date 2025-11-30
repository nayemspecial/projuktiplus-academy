@extends('layouts.admin')

@section('title', 'সকল প্রশ্ন - ProjuktiPlus LMS Admin')

@section('admin-content')

<div class="bg-white dark:bg-slate-800 rounded-lg shadow-lg overflow-hidden border border-gray-200 dark:border-slate-700">
    <!-- Header Section -->
    <div class="px-6 py-4 border-b border-gray-200 dark:border-slate-700 bg-gradient-to-r from-blue-50 to-indigo-50 dark:from-slate-700 dark:to-slate-800">
        <div class="flex flex-col md:flex-row justify-between items-center gap-3">
            <h3 class="text-xl font-semibold text-gray-800 dark:text-white">সকল প্রশ্ন</h3>
            <div class="relative">
                <a href="{{ route('admin.questions.create') }}" 
                class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-blue-600 hover:bg-blue-700 transition-colors">
                    <i class="fas fa-plus mr-2"></i> নতুন প্রশ্ন
                </a>
            </div>
        </div>
    </div>
    
    <!-- Table -->
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200 dark:divide-slate-700">
            <thead class="bg-gray-50 dark:bg-slate-700">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">প্রশ্ন</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">কুইজ</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">টাইপ</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">পয়েন্ট</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">অর্ডার</th>
                    <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">অ্যাকশন</th>
                </tr>
            </thead>
            <tbody class="bg-white dark:bg-slate-800 divide-y divide-gray-200 dark:divide-slate-700">
                @foreach($questions as $question)
                <tr class="hover:bg-gray-50 dark:hover:bg-slate-700/50 transition-colors">
                    <!-- প্রশ্ন -->
                    <td class="px-6 py-4">
                        <div class="flex items-center">
                            <div class="flex-shrink-0 h-10 w-10 bg-blue-100 dark:bg-blue-900/30 rounded-lg flex items-center justify-center">
                                <i class="fas fa-question text-blue-600 dark:text-blue-400"></i>
                            </div>
                            <div class="ml-4">
                                <div class="text-sm font-medium text-gray-900 dark:text-white line-clamp-2">{{ Str::limit($question->question, 70) }}</div>
                                <div class="text-xs text-gray-500 dark:text-gray-400 mt-1">
                                    {{ $question->answers->count() }} টি উত্তর
                                </div>
                            </div>
                        </div>
                    </td>
                    
                    <!-- কুইজ -->
                    <td class="px-6 py-4">
                        <div class="text-sm text-gray-900 dark:text-white">{{ $question->quiz->title }}</div>
                        <div class="text-xs text-gray-500 dark:text-gray-400">{{ $question->quiz->lesson->section->course->title }}</div>
                    </td>
                    
                    <!-- টাইপ -->
                    <td class="px-6 py-4 whitespace-nowrap">
                        <span class="px-2 py-1 rounded-full text-xs font-medium 
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
                    </td>
                    
                    <!-- পয়েন্ট -->
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-white">
                        {{ $question->points }}
                    </td>
                    
                    <!-- অর্ডার -->
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-white">
                        {{ $question->order }}
                    </td>
                    
                    <!-- অ্যাকশন -->
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
                            <form action="{{ route('admin.questions.destroy', $question) }}" method="POST" class="inline-block" 
                                  onsubmit="return confirm('আপনি কি নিশ্চিত এই প্রশ্ন ডিলিট করতে চান?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" 
                                        class="text-red-600 dark:text-red-400 hover:text-red-900 dark:hover:text-red-300 transition-colors" 
                                        title="ডিলিট">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    
    <!-- Pagination -->
    <div class="px-6 py-4 bg-gray-50 dark:bg-slate-800 border-t border-gray-200 dark:border-slate-700">
        {{ $questions->links() }}
    </div>
</div>

<style>
.line-clamp-2 {
    display: -webkit-box;
    line-clamp: 2;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
}
</style>
@endsection