@extends('frontend.layouts.master')

@section('title', 'সকল কোর্স')

@section('content')

<!-- Header Section -->
<!-- <section class="bg-gray-50 dark:bg-slate-900 py-12 border-b border-gray-200 dark:border-slate-800">
    <div class="container mx-auto px-4 text-center">
        <h1 class="text-3xl md:text-4xl font-bold text-gray-900 dark:text-white font-heading mb-4">আমাদের কোর্সসমূহ</h1>
        <p class="text-gray-600 dark:text-gray-400 max-w-2xl mx-auto">
            আপনার ক্যারিয়ার গড়ার জন্য প্রয়োজনীয় সব স্কিল শিখুন আমাদের প্রজেক্ট-ভিত্তিক কোর্সগুলো থেকে।
        </p>
    </div>
</section> -->

<!-- Main Content -->
<section class="py-16 bg-white dark:bg-slate-900" x-data="{ mobileFilterOpen: false }">
    <div class="container mx-auto px-4">
        <div class="flex flex-col lg:flex-row gap-8">
            
            <!-- Sidebar Filter (Desktop) -->
            <aside class="hidden lg:block w-64 flex-shrink-0">
                <div class="sticky top-24 space-y-8">
                    @include('frontend.courses.partials.filters')
                </div>
            </aside>

            <!-- Mobile Filter Button -->
            <div class="lg:hidden mb-4 flex justify-between items-center">
                <p class="text-gray-600 dark:text-gray-400">{{ $courses->total() }} টি কোর্স পাওয়া গেছে</p>
                <button @click="mobileFilterOpen = true" class="flex items-center gap-2 px-4 py-2 bg-gray-100 dark:bg-slate-800 text-gray-700 dark:text-gray-300 rounded-lg border border-gray-200 dark:border-slate-700">
                    <i class="fas fa-filter"></i> ফিল্টার
                </button>
            </div>

            <!-- Course Grid -->
            <div class="flex-1">
                <!-- Search & Sort (Top Bar) -->
                <div class="flex flex-col sm:flex-row justify-between items-center gap-4 mb-8 bg-gray-50 dark:bg-slate-800 p-4 rounded-xl border border-gray-100 dark:border-slate-700">
                    <form action="{{ route('courses.index') }}" method="GET" class="w-full sm:w-auto relative flex-1 max-w-md">
                        <!-- বর্তমান ফিল্টারগুলো ধরে রাখার জন্য হিডেন ইনপুট -->
                        @if(request('category')) <input type="hidden" name="category" value="{{ request('category') }}"> @endif
                        @if(request('level')) <input type="hidden" name="level" value="{{ request('level') }}"> @endif
                        
                        <i class="fas fa-search absolute left-3 top-1/2 -translate-y-1/2 text-gray-400"></i>
                        <input type="text" name="search" value="{{ request('search') }}" 
                               placeholder="কোর্স খুঁজুন..." 
                               class="w-full pl-10 pr-4 py-2 rounded-lg border border-gray-200 dark:border-slate-600 bg-white dark:bg-slate-900 text-gray-800 dark:text-gray-200 focus:ring-2 focus:ring-blue-500 focus:border-transparent outline-none transition">
                    </form>
                    
                    <div class="hidden lg:block text-sm text-gray-500 dark:text-gray-400">
                        {{ $courses->firstItem() ?? 0 }} - {{ $courses->lastItem() ?? 0 }} / {{ $courses->total() }} টি ফলাফল
                    </div>
                </div>

                <!-- Grid -->
                <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6">
                    @forelse($courses as $course)
                        @include('frontend.courses.partials.course-card', ['course' => $course])
                    @empty
                        <div class="col-span-full py-12 text-center">
                            <div class="inline-flex items-center justify-center w-20 h-20 bg-gray-100 dark:bg-slate-800 rounded-full mb-4">
                                <i class="fas fa-search text-gray-400 text-3xl"></i>
                            </div>
                            <h3 class="text-lg font-bold text-gray-800 dark:text-white">কোনো কোর্স পাওয়া যায়নি</h3>
                            <p class="text-gray-500 dark:text-gray-400 mt-1">অন্য কিওয়ার্ড দিয়ে চেষ্টা করুন অথবা ফিল্টার ক্লিয়ার করুন।</p>
                            <a href="{{ route('courses.index') }}" class="inline-block mt-4 px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">ফিল্টার রিসেট</a>
                        </div>
                    @endforelse
                </div>

                <!-- Pagination -->
                <div class="mt-12">
                    {{ $courses->links() }}
                </div>
            </div>
        </div>
    </div>

    <!-- Mobile Filter Drawer -->
    <div x-show="mobileFilterOpen" class="relative z-50 lg:hidden" role="dialog" aria-modal="true">
        <div x-show="mobileFilterOpen" 
             x-transition:enter="transition-opacity ease-linear duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" 
             x-transition:leave="transition-opacity ease-linear duration-300" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" 
             class="fixed inset-0 bg-gray-900/80 backdrop-blur-sm" @click="mobileFilterOpen = false"></div>

        <div x-show="mobileFilterOpen" 
             x-transition:enter="transition ease-in-out duration-300 transform" x-transition:enter-start="translate-x-full" x-transition:enter-end="translate-x-0" 
             x-transition:leave="transition ease-in-out duration-300 transform" x-transition:leave-start="translate-x-0" x-transition:leave-end="translate-x-full" 
             class="fixed inset-y-0 right-0 flex max-w-xs w-full flex-col overflow-y-auto bg-white dark:bg-slate-900 py-4 pb-6 shadow-xl">
            
            <div class="flex items-center justify-between px-4 mb-6">
                <h2 class="text-lg font-bold text-gray-900 dark:text-white">ফিল্টার</h2>
                <button type="button" class="-mr-2 flex h-10 w-10 items-center justify-center rounded-md bg-white dark:bg-slate-800 p-2 text-gray-400" @click="mobileFilterOpen = false">
                    <i class="fas fa-times text-xl"></i>
                </button>
            </div>

            <div class="px-4">
                @include('frontend.courses.partials.filters')
            </div>
        </div>
    </div>
</section>

@endsection