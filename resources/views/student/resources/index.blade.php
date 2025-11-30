@extends('layouts.student')

@section('title', 'রিসোর্স সেন্টার - ProjuktiPlus LMS')

@section('student-content')
<div class="max-w-7xl mx-auto">
    <div class="mb-8">
        <h1 class="text-2xl font-bold text-gray-800 dark:text-white">রিসোর্স সেন্টার</h1>
        <p class="text-gray-600 dark:text-gray-400">আপনার সব কোর্সের ডাউনলোডযোগ্য ফাইলসমূহ</p>
    </div>

    <div class="mb-6 p-4 bg-white dark:bg-slate-800 rounded-lg shadow-sm">
        <form action="{{ route('student.resources.index') }}" method="GET">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div>
                    <label for="search" class="block text-sm font-medium text-gray-700 dark:text-gray-300">কীওয়ার্ড</label>
                    <div class="relative mt-1">
                        <input type="text" name="search" id="search"
                               class="w-full pl-10 pr-4 py-2 border border-gray-300 dark:border-slate-700 rounded-md bg-white dark:bg-slate-900 text-gray-900 dark:text-white focus:ring-blue-500 focus:border-blue-500"
                               placeholder="ফাইলের নাম বা কোর্স খুঁজুন..."
                               value="{{ $search ?? '' }}">
                        <div class="absolute left-3 top-2.5 text-gray-400">
                            <i class="fas fa-search"></i>
                        </div>
                    </div>
                </div>
                
                <div>
                    <label for="course" class="block text-sm font-medium text-gray-700 dark:text-gray-300">কোর্স</label>
                    <select name="course" id="course"
                            class="w-full mt-1 px-3 py-2 border border-gray-300 dark:border-slate-700 rounded-md bg-white dark:bg-slate-900 text-gray-900 dark:text-white focus:ring-blue-500 focus:border-blue-500">
                        <option value="">সব কোর্স</option>
                        @foreach($courses as $course)
                            <option value="{{ $course->id }}" {{ ($courseFilter ?? '') == $course->id ? 'selected' : '' }}>
                                {{ $course->title }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="self-end">
                    <button type="submit" class="w-full md:w-auto mt-1 inline-flex items-center justify-center px-6 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition">
                        <i class="fas fa-filter mr-2"></i> ফিল্টার
                    </button>
                </div>
            </div>
        </form>
    </div>

    <div class="bg-white dark:bg-slate-800 rounded-lg shadow-sm overflow-hidden">
        <div class="divide-y divide-gray-200 dark:divide-slate-700">
            @forelse($lessonsWithResources as $lesson)
                @if(is_array($lesson->attachments))
                    @foreach($lesson->attachments as $attachment)
                        <div class="p-4 md:p-6 flex flex-col md:flex-row items-start md:items-center justify-between gap-4 hover:bg-gray-50 dark:hover:bg-slate-700/50 transition">
                            <div class="flex items-center gap-4 flex-1">
                                <div class="flex-shrink-0 w-12 h-12 rounded-lg bg-blue-100 dark:bg-blue-900/30 text-blue-600 dark:text-blue-400 flex items-center justify-center">
                                    <i class="far fa-file-alt text-2xl"></i>
                                </div>
                                <div class="overflow-hidden">
                                    <h4 class="text-base font-medium text-gray-900 dark:text-white truncate" title="{{ $attachment['name'] ?? 'Untitled Resource' }}">
                                        {{ $attachment['name'] ?? 'Untitled Resource' }}
                                    </h4>
                                    <p class="text-sm text-gray-500 dark:text-gray-400">
                                        কোর্স: <a href="{{ route('student.courses.show', $lesson->section->course->id) }}" class="hover:underline">{{ $lesson->section->course->title }}</a>
                                    </p>
                                    <p class="text-xs text-gray-400 dark:text-gray-500 mt-1">
                                        লেসন: {{ $lesson->title }}
                                    </p>
                                </div>
                            </div>
                            <div class="flex-shrink-0 w-full md:w-auto">
                                <a href="{{ asset('storage/' . ($attachment['path'] ?? '#')) }}" target="_blank"
                                   class="inline-flex w-full md:w-auto items-center justify-center px-4 py-2 border border-gray-300 dark:border-slate-600 rounded-md text-sm font-medium text-gray-700 dark:text-gray-300 bg-white dark:bg-slate-700 hover:bg-gray-50 dark:hover:bg-slate-600 transition">
                                    <i class="fas fa-download mr-2"></i> ডাউনলোড ({{ $attachment['size'] ?? 'N/A' }})
                                </a>
                            </div>
                        </div>
                    @endforeach
                @endif
            @empty
            <div class="text-center py-16 p-6">
                <div class="inline-flex items-center justify-center w-24 h-24 bg-blue-100 dark:bg-blue-900/30 rounded-full mb-6">
                    <i class="fas fa-folder-open text-5xl text-blue-600 dark:text-blue-500"></i>
                </div>
                <h3 class="text-xl font-medium text-gray-900 dark:text-white mb-2">কোনো রিসোর্স পাওয়া যায়নি</h3>
                <p class="text-gray-500 dark:text-gray-400 max-w-md mx-auto">
                    @if($search || $courseFilter)
                        আপনার সার্চ বা ফিল্টারের সাথে কোনো রিসোর্স মিলছে না।
                    @else
                        আপনার এনরোল করা কোর্সগুলোতে এখনো কোনো রিসোর্স আপলোড করা হয়নি।
                    @endif
                </p>
            </div>
            @endforelse
        </div>
        
        @if($lessonsWithResources->hasPages())
            <div class="px-6 py-4 border-t border-gray-200 dark:border-slate-700">
                {{ $lessonsWithResources->withQueryString()->links() }}
            </div>
        @endif
    </div>
</div>
@endsection