@extends('frontend.layouts.master')

@section('title', 'সকল কোর্স')

@section('content')

<section class="relative w-full py-12 lg:py-16 overflow-hidden bg-slate-50 dark:bg-slate-900 transition-colors duration-300" x-data="{ mobileFilterOpen: false }">
    
    <!-- Modern Mesh Gradient Background -->
    <div class="absolute inset-0 pointer-events-none">
        <div class="absolute top-20 left-10 w-[500px] h-[500px] bg-blue-500/10 dark:bg-blue-600/10 rounded-full blur-[100px] -translate-x-1/2 -translate-y-1/2 animate-pulse"></div>
        <div class="absolute bottom-20 right-10 w-[500px] h-[500px] bg-purple-500/10 dark:bg-purple-600/10 rounded-full blur-[100px] translate-x-1/2 translate-y-1/2 animate-pulse delay-1000"></div>
        
        <!-- Grid Pattern -->
        <svg class="absolute inset-0 w-full h-full opacity-[0.03] dark:opacity-[0.05]" xmlns="http://www.w3.org/2000/svg">
            <defs>
                <pattern id="course-grid" width="40" height="40" patternUnits="userSpaceOnUse">
                    <path d="M 40 0 L 0 0 0 40" fill="none" stroke="currentColor" stroke-width="1"/>
                </pattern>
            </defs>
            <rect width="100%" height="100%" fill="url(#course-grid)" />
        </svg>
    </div>

    <div class="container mx-auto px-4 relative z-10">

                <!-- Header -->
        <div class="text-center mb-10">
            <h2 class="text-3xl md:text-4xl font-bold text-slate-900 dark:text-white mb-3 font-heading">
                <span class="bg-clip-text text-transparent bg-gradient-to-r from-blue-600 dark:from-gray-200 via-purple-600 dark:via-purple-300 to-pink-600 dark:to-pink-300">
                    আমাদের সকল কোর্স
                </span>
            </h2>
            <p class="text-sm md:text-base text-slate-600 dark:text-slate-400 max-w-2xl mx-auto">
                আপনার দক্ষতা উন্নত করতে আমাদের বিশেষায়িত কোর্সগুলো থেকে বেছে নিন সেরাটি
            </p>
        </div>

        <div class="flex flex-col lg:flex-row gap-8">
            
            <!-- Filter Sidebar (Desktop) -->
            <aside class="hidden lg:block w-64 flex-shrink-0">
                <div class="sticky top-24">
                    @include('frontend.courses.partials.filters')
                </div>
            </aside>

            <!-- Mobile Filter Toggle & Count -->
            <div class="lg:hidden flex justify-between items-center mb-4">
                <p class="text-sm text-slate-500 dark:text-slate-400 font-medium">{{ $courses->total() }} টি কোর্স পাওয়া গেছে</p>
                <button @click="mobileFilterOpen = true" class="flex items-center gap-2 px-4 py-2 bg-white dark:bg-slate-800/80 backdrop-blur-md text-slate-700 dark:text-slate-300 rounded-lg border border-slate-200 dark:border-slate-700 shadow-sm text-sm font-medium hover:bg-slate-50 dark:hover:bg-slate-700 transition">
                    <i class="fas fa-filter text-blue-500"></i> ফিল্টার
                </button>
            </div>

            <!-- Course Grid Area -->
            <div class="flex-1">
                
                <!-- Search Bar -->
                <div class="mb-6 bg-white/80 dark:bg-slate-800/60 backdrop-blur-md p-2 rounded-xl border border-slate-200 dark:border-slate-700/50 shadow-sm">
                    <form action="{{ route('courses.index') }}" method="GET" class="flex items-center w-full">
                        @if(request('category')) <input type="hidden" name="category" value="{{ request('category') }}"> @endif
                        @if(request('level')) <input type="hidden" name="level" value="{{ request('level') }}"> @endif
                        
                        <div class="relative flex-1">
                            <i class="fas fa-search absolute left-4 top-1/2 -translate-y-1/2 text-slate-400 text-sm"></i>
                            <input type="text" name="search" value="{{ request('search') }}" 
                                   placeholder="কোর্স খুঁজুন..." 
                                   class="w-full pl-10 pr-4 py-3 rounded-lg bg-transparent text-slate-800 dark:text-white placeholder-slate-400 dark:placeholder-slate-500 focus:outline-none text-sm">
                        </div>
                        <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2.5 rounded-lg text-sm font-bold transition-colors ml-2 shadow-md shadow-blue-500/20">
                            খুঁজুন
                        </button>
                    </form>
                </div>

                <!-- Grid -->
                <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-3 gap-6">
                    @forelse($courses as $course)
                        @include('frontend.courses.partials.course-card', ['course' => $course])
                    @empty
                        <div class="col-span-full py-16 text-center bg-white/50 dark:bg-slate-800/50 rounded-2xl border border-dashed border-slate-300 dark:border-slate-700 backdrop-blur-sm">
                            <div class="inline-flex items-center justify-center w-20 h-20 bg-slate-100 dark:bg-slate-700 rounded-full mb-4">
                                <i class="fas fa-search text-slate-400 text-3xl"></i>
                            </div>
                            <h3 class="text-lg font-bold text-slate-900 dark:text-white">কোনো কোর্স পাওয়া যায়নি</h3>
                            <p class="text-slate-500 dark:text-slate-400 mt-1 text-sm">অন্য কিওয়ার্ড দিয়ে চেষ্টা করুন অথবা ফিল্টার ক্লিয়ার করুন।</p>
                            <a href="{{ route('courses.index') }}" class="inline-block mt-5 px-6 py-2.5 bg-blue-600 text-white text-sm font-bold rounded-full hover:bg-blue-700 transition shadow-lg shadow-blue-500/30">
                                ফিল্টার রিসেট
                            </a>
                        </div>
                    @endforelse
                </div>

                <!-- Pagination -->
                @if($courses->hasPages())
                <div class="mt-12">
                    {{ $courses->links() }}
                </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Mobile Filter Drawer -->
    <div x-show="mobileFilterOpen" class="relative z-50 lg:hidden" role="dialog" aria-modal="true">
        <div x-show="mobileFilterOpen" 
             x-transition:enter="transition-opacity ease-linear duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" 
             x-transition:leave="transition-opacity ease-linear duration-300" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" 
             class="fixed inset-0 bg-slate-900/80 backdrop-blur-sm" @click="mobileFilterOpen = false"></div>

        <div x-show="mobileFilterOpen" 
             x-transition:enter="transition ease-in-out duration-300 transform" x-transition:enter-start="translate-x-full" x-transition:enter-end="translate-x-0" 
             x-transition:leave="transition ease-in-out duration-300 transform" x-transition:leave-start="translate-x-0" x-transition:leave-end="translate-x-full" 
             class="fixed inset-y-0 right-0 flex max-w-xs w-full flex-col overflow-y-auto bg-white dark:bg-slate-900 shadow-2xl border-l border-slate-200 dark:border-slate-700">
            
            <div class="flex items-center justify-between px-5 py-5 border-b border-slate-100 dark:border-slate-800">
                <h2 class="text-lg font-bold text-slate-900 dark:text-white">ফিল্টার</h2>
                <button type="button" class="-mr-2 p-2 text-slate-400 hover:text-slate-600 dark:hover:text-slate-200 transition" @click="mobileFilterOpen = false">
                    <i class="fas fa-times text-xl"></i>
                </button>
            </div>

            <div class="px-5 py-6">
                @include('frontend.courses.partials.filters')
            </div>
        </div>
    </div>
</section>
@endsection