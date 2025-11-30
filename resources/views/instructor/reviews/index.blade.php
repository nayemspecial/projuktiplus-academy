@extends('layouts.instructor')

@section('title', 'কোর্স রিভিউ')

@section('instructor-content')
    <!-- Page title -->
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-6">
        <div>
            <h2 class="text-2xl font-bold text-gray-800 dark:text-white">কোর্স রিভিউ</h2>
            <p class="text-sm text-gray-500 dark:text-gray-400">শিক্ষার্থীদের মতামত এবং রেটিং</p>
        </div>
        
        <!-- Rating Stats Badge -->
        <div class="flex items-center gap-4 bg-white dark:bg-slate-800 px-4 py-2 rounded-lg shadow-sm border border-gray-200 dark:border-slate-700">
            <div class="text-center border-r border-gray-200 dark:border-slate-700 pr-4">
                <div class="text-2xl font-bold text-yellow-500 flex items-center">
                    {{ number_format($stats['avg_rating'], 1) }} <i class="fas fa-star text-lg ml-1"></i>
                </div>
                <div class="text-xs text-gray-500 dark:text-gray-400">গড় রেটিং</div>
            </div>
            <div class="text-center pl-2">
                <div class="text-xl font-bold text-gray-800 dark:text-white">{{ $stats['total_reviews'] }}</div>
                <div class="text-xs text-gray-500 dark:text-gray-400">মোট রিভিউ</div>
            </div>
        </div>
    </div>

    <!-- Filter & Search -->
    <div class="bg-white dark:bg-slate-800 rounded-lg shadow mb-6 p-4">
        <form action="{{ route('instructor.reviews') }}" method="GET" class="flex flex-col md:flex-row gap-4 items-end">
            <div class="flex-1 relative w-full">
                <label for="search" class="sr-only">Search</label>
                <input type="text" name="search" id="search" value="{{ $search ?? '' }}"
                       class="w-full pl-10 pr-4 py-2 border border-gray-300 dark:border-slate-700 rounded-md bg-gray-50 dark:bg-slate-900 text-gray-800 dark:text-gray-200 focus:outline-none focus:ring-2 focus:ring-blue-500"
                       placeholder="কোর্স বা শিক্ষার্থী খুঁজুন...">
                <div class="absolute left-3 top-2.5 text-gray-400">
                    <i class="fas fa-search"></i>
                </div>
            </div>
            
            <div class="w-full md:w-48">
                <select name="rating" 
                        class="w-full px-3 py-2 border border-gray-300 dark:border-slate-700 rounded-md bg-gray-50 dark:bg-slate-900 text-gray-800 dark:text-gray-200 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <option value="all">সব রেটিং</option>
                    <option value="5" {{ request('rating') == '5' ? 'selected' : '' }}>৫ স্টার</option>
                    <option value="4" {{ request('rating') == '4' ? 'selected' : '' }}>৪ স্টার</option>
                    <option value="3" {{ request('rating') == '3' ? 'selected' : '' }}>৩ স্টার</option>
                    <option value="2" {{ request('rating') == '2' ? 'selected' : '' }}>২ স্টার</option>
                    <option value="1" {{ request('rating') == '1' ? 'selected' : '' }}>১ স্টার</option>
                </select>
            </div>

            <!-- [নতুন] ফিল্টার বাটন যোগ করা হয়েছে -->
            <button type="submit" class="w-full md:w-auto px-6 py-2 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition">
                খুঁজুন
            </button>
        </form>
    </div>

    <!-- Reviews List -->
    <div class="space-y-4">
        @forelse($reviews as $review)
        <div class="bg-white dark:bg-slate-800 rounded-lg shadow p-6 transition hover:shadow-md border border-gray-100 dark:border-slate-700">
            <div class="flex flex-col md:flex-row gap-4">
                <!-- User Avatar -->
                <div class="flex-shrink-0">
                    <img class="h-12 w-12 rounded-full object-cover border-2 border-gray-100 dark:border-slate-700" 
                         src="{{ $review->user->avatar_url ?? 'https://ui-avatars.com/api/?name=' . urlencode($review->user->name) }}" 
                         alt="{{ $review->user->name }}">
                </div>

                <!-- Review Content -->
                <div class="flex-1">
                    <div class="flex flex-col sm:flex-row sm:items-center justify-between mb-2">
                        <div>
                            <h4 class="text-base font-semibold text-gray-900 dark:text-white">{{ $review->user->name }}</h4>
                            <p class="text-xs text-gray-500 dark:text-gray-400">
                                কোর্স: <a href="{{ route('instructor.courses.show', $review->course_id) }}" class="text-blue-600 dark:text-blue-400 hover:underline font-medium">{{ $review->course->title }}</a>
                            </p>
                        </div>
                        <div class="text-sm text-gray-500 dark:text-gray-400 mt-1 sm:mt-0 flex items-center">
                            <i class="far fa-clock mr-1"></i> {{ $review->created_at->diffForHumans() }}
                        </div>
                    </div>

                    <!-- Stars -->
                    <div class="flex items-center mb-3">
                        @for($i = 1; $i <= 5; $i++)
                            <i class="fas fa-star text-sm {{ $i <= $review->rating ? 'text-yellow-400' : 'text-gray-300 dark:text-slate-600' }}"></i>
                        @endfor
                        <span class="ml-2 text-sm font-medium text-gray-600 dark:text-gray-300 badge bg-gray-100 dark:bg-slate-700 px-2 py-0.5 rounded">{{ $review->rating }}.0</span>
                    </div>

                    <!-- Comment -->
                    @if($review->comment)
                        <div class="relative">
                            <i class="fas fa-quote-left absolute -top-2 -left-2 text-gray-200 dark:text-slate-700 text-2xl opacity-50"></i>
                            <p class="text-gray-700 dark:text-gray-300 text-sm leading-relaxed bg-gray-50 dark:bg-slate-900/50 p-3 rounded-md border border-gray-100 dark:border-slate-700 relative z-10">
                                {{ $review->comment }}
                            </p>
                        </div>
                    @else
                        <p class="text-gray-400 dark:text-gray-500 text-sm italic">কোনো মন্তব্য নেই</p>
                    @endif

                    <!-- [নতুন] Action Buttons -->
                    <div class="mt-4 flex items-center gap-3 pt-3 border-t border-gray-100 dark:border-slate-700">
                        <button class="text-sm font-medium text-blue-600 dark:text-blue-400 hover:text-blue-800 dark:hover:text-blue-300 transition flex items-center">
                            <i class="fas fa-reply mr-1.5"></i> উত্তর দিন
                        </button>
                        <button class="text-sm font-medium text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-200 transition flex items-center ml-auto">
                            <i class="far fa-flag mr-1.5"></i> রিপোর্ট
                        </button>
                    </div>
                </div>
            </div>
        </div>
        @empty
        <div class="bg-white dark:bg-slate-800 rounded-lg shadow p-12 text-center border border-gray-200 dark:border-slate-700">
            <div class="inline-flex items-center justify-center w-16 h-16 bg-gray-100 dark:bg-slate-700 rounded-full mb-4">
                <i class="far fa-comment-dots text-3xl text-gray-400"></i>
            </div>
            <h3 class="text-lg font-medium text-gray-900 dark:text-white">কোনো রিভিউ পাওয়া যায়নি</h3>
            <p class="text-gray-500 dark:text-gray-400 mt-1">আপনার কোর্সে এখনো কোনো রিভিউ আসেনি অথবা ফিল্টার অনুযায়ী কিছু পাওয়া যায়নি।</p>
            <a href="{{ route('instructor.dashboard') }}" class="inline-block mt-4 text-blue-600 hover:underline">ড্যাশবোর্ডে ফিরে যান</a>
        </div>
        @endforelse
    </div>

    <!-- Pagination -->
    @if($reviews->hasPages())
    <div class="mt-6 px-4 py-3 bg-white dark:bg-slate-800 border-t border-gray-200 dark:border-slate-700 rounded-lg shadow-sm">
        {{ $reviews->withQueryString()->links() }}
    </div>
    @endif
@endsection