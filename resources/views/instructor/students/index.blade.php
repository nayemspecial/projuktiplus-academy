@extends('layouts.instructor')

@section('title', 'আমার শিক্ষার্থীরা')

@section('instructor-content')
    <!-- Page title -->
    <div class="flex items-center justify-between mb-6">
        <h2 class="text-2xl font-bold text-gray-800 dark:text-white">আমার শিক্ষার্থীরা</h2>
    </div>

    <!-- Students List Table -->
    <div class="bg-white dark:bg-slate-800 rounded-lg shadow overflow-hidden">
        
        <!-- Search Bar -->
        <div class="px-6 py-4 border-b border-gray-200 dark:border-slate-700">
            <form action="{{ route('instructor.students.index') }}" method="GET">
                <div class="relative max-w-sm">
                    <input type="text" name="search" value="{{ $search ?? '' }}"
                           class="w-full pl-10 pr-4 py-2 border border-gray-300 dark:border-slate-700 rounded-lg bg-white dark:bg-slate-800 text-gray-800 dark:text-gray-200 focus:outline-none focus:ring-2 focus:ring-blue-500"
                           placeholder="শিক্ষার্থী খুঁজুন (নাম বা ইমেইল)...">
                    <div class="absolute left-3 top-2.5 text-gray-400">
                        <i class="fas fa-search"></i>
                    </div>
                </div>
            </form>
        </div>

        <!-- Table -->
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200 dark:divide-slate-700">
                <thead class="bg-gray-50 dark:bg-slate-700">
                    <tr>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">নাম</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">মোট কোর্স</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">গড় অগ্রগতি (Avg.)</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">যোগদান</th>
                        <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">অ্যাকশন</th>
                    </tr>
                </thead>
                <tbody class="bg-white dark:bg-slate-800 divide-y divide-gray-200 dark:divide-slate-700">
                    @forelse($students as $student)
                        @php
                            // কন্ট্রোলার থেকে আসা এনরোলমেন্টগুলো (শুধু এই ইন্সট্রাকটরের)
                            $enrollments = $student->enrollments;
                            $totalCourses = $enrollments->count();
                            $averageProgress = $enrollments->avg('progress');
                        @endphp
                        <tr class="hover:bg-gray-50 dark:hover:bg-slate-700/50">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0 h-10 w-10">
                                        <img class="h-10 w-10 rounded-full" src="{{ $student->avatar_url ?? 'https://ui-avatars.com/api/?name=' . urlencode($student->name) }}" alt="{{ $student->name }}">
                                    </div>
                                    <div class="ml-4">
                                        <div class="text-sm font-medium text-gray-800 dark:text-white">{{ $student->name }}</div>
                                        <div class="text-sm text-gray-500 dark:text-gray-400">{{ $student->email }}</div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-800 dark:text-white">{{ $totalCourses }} টি কোর্স</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center gap-3">
                                    <div class="w-24 bg-gray-200 dark:bg-slate-700 rounded-full h-2.5">
                                        <div class="bg-blue-600 dark:bg-blue-400 h-2.5 rounded-full" style="width: {{ $averageProgress }}%"></div>
                                    </div>
                                    <div class="text-xs text-gray-500 dark:text-gray-400">{{ round($averageProgress) }}%</div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">
                                {{ $student->created_at->format('d M, Y') }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <button class="inline-flex items-center justify-center px-3 py-1.5 text-blue-600 dark:text-blue-400 hover:text-blue-900 dark:hover:text-blue-300 disabled:opacity-50" 
                                        title="মেসেজ (শীঘ্রই আসছে)" disabled>
                                    <i class="fas fa-comment-dots w-4"></i>
                                    <span class="hidden sm:inline ml-1.5">মেসেজ</span>
                                </button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-12 text-center text-gray-500 dark:text-gray-400">
                                @if($search)
                                    "{{ $search }}" এর জন্য কোনো শিক্ষার্থী পাওয়া যায়নি।
                                @else
                                    আপনার কোর্সে এখনো কোনো শিক্ষার্থী এনরোল করেনি।
                                @endif
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        <!-- Pagination -->
        <div class="px-4 py-3 md:px-6 bg-gray-50 dark:bg-slate-800 border-t border-gray-200 dark:border-slate-700">
            {{ $students->withQueryString()->links() }}
        </div>
    </div>
@endsection