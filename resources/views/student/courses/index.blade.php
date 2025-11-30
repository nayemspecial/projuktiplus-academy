@extends('layouts.student')

@section('title', 'আমার কোর্সসমূহ - ProjuktiPlus LMS')

@section('student-content')
<div x-data="courseIndex()" x-init="init()">
    <div class="bg-white dark:bg-slate-800 rounded-lg shadow overflow-hidden mb-6">
        <div class="px-6 py-4 border-b border-gray-200 dark:border-slate-700 flex flex-col md:flex-row justify-between items-center gap-4">
            <h3 class="text-lg font-medium text-gray-800 dark:text-white">আমার কোর্সসমূহ</h3>
            <div class="flex flex-col sm:flex-row space-y-3 sm:space-y-0 sm:space-x-3 w-full md:w-auto">
                <div class="relative flex-1 md:flex-none">
                    <input type="text" 
                           class="w-full pl-8 pr-4 py-2 border border-gray-300 dark:border-slate-700 rounded-lg bg-white dark:bg-slate-800 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent" 
                           placeholder="কোর্স খুঁজুন..." 
                           x-model="searchQuery"
                           @input.debounce.500ms="performSearch()">
                    <div class="absolute left-3 top-2.5 text-gray-400">
                        <i class="fas fa-search"></i>
                    </div>
                </div>
                <select x-model="filter" 
                        @change="applyFilter()"
                        class="px-3 py-2 border border-gray-300 dark:border-slate-700 rounded-lg bg-white dark:bg-slate-800 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    <option value="all">সব কোর্স</option>
                    <option value="active">সক্রিয়</option>
                    <option value="completed">সম্পন্ন</option>
                </select>
            </div>
        </div>
        <div class="p-6">
            @if($courses->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($courses as $course)
                @php
                    // ইউজার এনরোলমেন্ট নিশ্চিত করা
                    $enrollment = $course->enrollments->where('user_id', auth()->id())->first();
                    $progress = $enrollment ? $enrollment->progress : 0;
                    // স্ট্যাটাস সরাসরি এনরোলমেন্ট থেকে নেওয়া ভালো
                    $isCompleted = $enrollment && $enrollment->status === 'completed';
                    $totalLessons = $course->total_lessons ?? $course->lessons()->count(); // যদি total_lessons কলাম থাকে
                    $completedLessons = $enrollment ? $enrollment->completed_lessons : 0;
                @endphp
                
                <div class="course-card bg-white dark:bg-slate-800 border border-gray-200 dark:border-slate-700 rounded-lg shadow-sm overflow-hidden hover:shadow-md transition flex flex-col">
                    <a href="{{ route('student.courses.show', $course->id) }}" class="block relative">
                        <img class="w-full h-48 object-cover" src="{{ $course->thumbnail_url }}" alt="{{ $course->title }}">
                         @if($isCompleted)
                            <div class="absolute top-3 right-3 bg-green-500 text-white text-xs px-2 py-1 rounded-full font-medium flex items-center">
                                <i class="fas fa-check-circle mr-1"></i> সম্পন্ন
                            </div>
                        @endif
                    </a>
                    <div class="p-4 flex-1 flex flex-col">
                        <div class="flex-1">
                             <div class="flex items-center mb-2">
                                <span class="inline-block px-2 py-1 text-xs font-semibold text-blue-600 bg-blue-100 dark:bg-blue-900/30 dark:text-blue-400 rounded-md">
                                    {{ ucfirst($course->category) }}
                                </span>
                            </div>
                            <h3 class="text-lg font-medium text-gray-800 dark:text-white mb-1 line-clamp-2">
                                <a href="{{ route('student.courses.show', $course->id) }}" class="hover:text-blue-600 dark:hover:text-blue-400 transition">
                                    {{ $course->title }}
                                </a>
                            </h3>
                            <p class="text-sm text-gray-500 dark:text-gray-400 mb-4">
                                <i class="fas fa-chalkboard-teacher mr-1"></i> {{ $course->instructor->name ?? 'Unknown' }}
                            </p>
                        </div>

                        <div class="mt-auto pt-4 border-t border-gray-100 dark:border-slate-700">
                            <div class="flex justify-between text-sm mb-1">
                                <span class="text-gray-600 dark:text-gray-400">প্রোগ্রেস</span>
                                <span class="font-medium {{ $isCompleted ? 'text-green-600' : 'text-blue-600' }}">{{ $progress }}%</span>
                            </div>
                            <div class="w-full bg-gray-200 dark:bg-slate-700 rounded-full h-2 mb-4">
                                <div class="{{ $isCompleted ? 'bg-green-500' : 'bg-blue-600' }} h-2 rounded-full transition-all duration-500" style="width: {{ $progress }}%"></div>
                            </div>
                            
                            <div class="flex justify-between items-center">
                                <div class="flex items-center text-sm text-gray-500 dark:text-gray-400">
                                    <i class="fas fa-book-open mr-1"></i>
                                    <span>{{ $completedLessons }}/{{ $totalLessons }} লেসন</span>
                                </div>
                                
                                <a href="{{ route('student.courses.content', $course->id) }}" 
                                   class="inline-flex items-center px-3 py-1.5 text-sm font-medium text-white rounded-md transition focus:outline-none focus:ring-2 focus:ring-offset-2 {{ $isCompleted ? 'bg-green-600 hover:bg-green-700 focus:ring-green-500' : 'bg-blue-600 hover:bg-blue-700 focus:ring-blue-500' }}">
                                    <i class="fas fa-play mr-1.5 text-xs"></i>
                                    {{ $progress > 0 ? ($isCompleted ? 'আবার দেখুন' : 'চালিয়ে যান') : 'শুরু করুন' }}
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            @else
            <div class="text-center py-12">
                <i class="fas fa-book-open text-5xl text-gray-300 dark:text-slate-600 mb-4"></i>
                <h4 class="text-xl font-medium text-gray-600 dark:text-gray-400 mb-2">কোনো কোর্স পাওয়া যায়নি</h4>
                <p class="text-gray-500 dark:text-gray-500 mb-6">
                    @if($search || $filter !== 'all')
                        আপনার সার্চ বা ফিল্টারের সাথে কোনো কোর্স মিলছে না।
                    @else
                        আপনি এখনও কোনো কোর্সে এনরোল করেননি।
                    @endif
                </p>
                <a href="{{ url('/courses') }}" class="inline-flex items-center px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 transition">
                    <i class="fas fa-search mr-2"></i> নতুন কোর্স খুঁজুন
                </a>
            </div>
            @endif
        </div>
        
        @if($courses->hasPages())
        <div class="px-6 py-4 border-t border-gray-200 dark:border-slate-700">
            {{ $courses->withQueryString()->links() }} 
            </div>
        @endif
    </div>
</div>

<script>
document.addEventListener('alpine:init', () => {
    Alpine.data('courseIndex', () => ({
        // নাল ভ্যালু হ্যান্ডেল করার জন্য ডিফল্ট ভ্যালু যোগ করা হয়েছে
        searchQuery: '{{ $search ?? '' }}',
        filter: '{{ $filter ?? 'all' }}',
        
        init() {
            // ওয়াচার যোগ করা যেতে পারে যদি রিয়েল-টাইম আপডেট চান
        },
        
        performSearch() {
            this.submitForm();
        },
        
        applyFilter() {
            this.submitForm();
        },
        
        submitForm() {
            const params = new URLSearchParams(window.location.search);
            
            if (this.searchQuery) {
                params.set('search', this.searchQuery);
            } else {
                params.delete('search');
            }
            
            if (this.filter !== 'all') {
                params.set('filter', this.filter);
            } else {
                params.delete('filter');
            }
            
            // ফিল্টার বা সার্চ পাল্টালে পেজ ১ এ রিসেট করা উচিত
            params.delete('page');
            
            window.location.href = '{{ route('student.courses.index') }}?' + params.toString();
        }
    }));
});
</script>
@endsection