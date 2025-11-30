@extends('layouts.instructor')

@section('title', 'আমার কোর্সসমূহ')

@section('instructor-content')
    <div class="flex flex-col sm:flex-row items-center justify-between gap-4 mb-6">
        <h2 class="text-2xl font-bold text-gray-800 dark:text-white">আমার কোর্সসমূহ</h2>
        <a href="{{ route('instructor.courses.create') }}" class="inline-flex w-full sm:w-auto items-center justify-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
            <i class="fas fa-plus mr-2"></i> নতুন কোর্স
        </a>
    </div>

    <div class="bg-white dark:bg-slate-800 rounded-lg shadow overflow-hidden">
        
        <div class="px-4 py-4 md:px-6 border-b border-gray-200 dark:border-slate-700">
            <form action="{{ route('instructor.courses.index') }}" method="GET">
                <div class="relative max-w-sm">
                    <input type="text" name="search" value="{{ $search ?? '' }}"
                           class="w-full pl-10 pr-4 py-2 border border-gray-300 dark:border-slate-700 rounded-lg bg-white dark:bg-slate-800 text-gray-800 dark:text-gray-200 focus:outline-none focus:ring-2 focus:ring-blue-500"
                           placeholder="কোর্স খুঁজুন...">
                    <div class="absolute left-3 top-2.5 text-gray-400">
                        <i class="fas fa-search"></i>
                    </div>
                </div>
            </form>
        </div>

        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200 dark:divide-slate-700">
                <thead class="bg-gray-50 dark:bg-slate-700">
                    <tr>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">কোর্স</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">এনরোলমেন্ট</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">রেটিং</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">স্ট্যাটাস</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">আয়</th>
                        <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">অ্যাকশন</th>
                    </tr>
                </thead>
                <tbody class="bg-white dark:bg-slate-800 divide-y divide-gray-200 dark:divide-slate-700">
                    @forelse($courses as $course)
                    <tr class="hover:bg-gray-50 dark:hover:bg-slate-700/50">
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center">
                                <div class="flex-shrink-0 h-10 w-10">
                                    <img class="h-10 w-10 rounded" src="{{ $course->thumbnail_url }}" alt="{{ $course->title }}">
                                </div>
                                <div class="ml-4">
                                    <div class="text-sm font-medium text-gray-800 dark:text-white">{{ $course->title }}</div>
                                    <div class="text-sm text-gray-500 dark:text-gray-400">{{ $course->category }}</div>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-gray-800 dark:text-white">{{ $course->enrollments_count }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center">
                                <i class="fas fa-star text-yellow-400 mr-1"></i>
                                <div class="text-sm font-medium text-gray-800 dark:text-white">
                                    {{ round($course->reviews_avg_rating, 1) ?? 'N/A' }}
                                    <span class="text-gray-500 dark:text-gray-400">({{ $course->reviews_count }})</span>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            @php
                                $statusClasses = [
                                    'published' => 'bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-400',
                                    'draft' => 'bg-yellow-100 text-yellow-800 dark:bg-yellow-900/30 dark:text-yellow-400',
                                    'archived' => 'bg-red-100 text-red-800 dark:bg-red-900/30 dark:text-red-400',
                                ];
                                $statusText = [
                                    'published' => 'প্রকাশিত',
                                    'draft' => 'খসড়া',
                                    'archived' => 'আর্কাইভড'
                                ];
                            @endphp
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $statusClasses[$course->status] ?? '' }}">
                                {{ $statusText[$course->status] ?? $course->status }}
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-white">
                            ৳{{ number_format($course->earnings ?? 0) }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                            <a href="{{ route('instructor.courses.edit', $course) }}" class="inline-flex items-center justify-center px-3 py-1.5 text-blue-600 dark:text-blue-400 hover:text-blue-900 dark:hover:text-blue-300" title="এডিট">
                                <i class="fas fa-edit w-4"></i>
                                <span class="hidden sm:inline ml-1.5">এডিট</span>
                            </a>
                            <a href="{{ route('instructor.courses.show', $course) }}" class="inline-flex items-center justify-center px-3 py-1.5 text-green-600 dark:text-green-400 hover:text-green-900 dark:hover:text-green-300" title="দেখুন">
                                <i class="fas fa-eye w-4"></i>
                                <span class="hidden sm:inline ml-1.5">দেখুন</span>
                            </a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="px-6 py-12 text-center text-gray-500 dark:text-gray-400">
                            @if($search)
                                "{{ $search }}" এর জন্য কোনো কোর্স পাওয়া যায়নি।
                            @else
                                আপনি এখনো কোনো কোর্স তৈরি করেননি।
                            @endif
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        <div class="px-4 py-3 md:px-6 bg-gray-50 dark:bg-slate-800 border-t border-gray-200 dark:border-slate-700">
            {{ $courses->withQueryString()->links() }}
        </div>
    </div>
@endsection