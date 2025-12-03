@extends('frontend.layouts.master')

@section('title', $course->title)
@section('meta_description', Str::limit(strip_tags($course->description), 160))
@section('meta_image', $course->thumbnail ? asset('storage/' . $course->thumbnail) : asset('images/default-course.jpg'))

@section('content')

<!-- Course Details Page -->
<section class="relative bg-white dark:bg-slate-900 transition-colors duration-300">
    <!-- Mesh Gradient Background -->
    <div class="absolute inset-0 -z-10 opacity-5 pointer-events-none">
        <svg class="w-full h-full" viewBox="0 0 1200 800" preserveAspectRatio="none" xmlns="http://www.w3.org/2000/svg">
            <defs>
                <pattern id="grid" width="40" height="40" patternUnits="userSpaceOnUse">
                    <path d="M 40 0 L 0 0 0 40" fill="none" stroke="rgba(99, 102, 241, 0.3)" stroke-width="0.5"/>
                </pattern>
            </defs>
            <rect width="100%" height="100%" fill="url(#grid)" />
        </svg>
    </div>

    <div class="container mx-auto px-4 py-8 lg:py-10">
        <!-- Breadcrumb and Heading -->
        <div class="mb-6">
            <nav class="flex mb-3 text-sm" aria-label="Breadcrumb">
                <ol class="inline-flex items-center space-x-2">
                    <li>
                        <a href="{{ route('home') }}" class="font-medium text-gray-500 hover:text-blue-600 dark:text-gray-400 dark:hover:text-white transition">
                            <i class="fas fa-home mr-1"></i> হোম
                        </a>
                    </li>
                    <li>
                        <i class="fas fa-chevron-right text-gray-400 text-xs mx-1"></i>
                        <a href="{{ route('courses.index') }}" class="font-medium text-gray-500 hover:text-blue-600 dark:text-gray-400 dark:hover:text-white transition">কোর্সসমূহ</a>
                    </li>
                    <li>
                        <i class="fas fa-chevron-right text-gray-400 text-xs mx-1"></i>
                        <span class="font-medium text-blue-600 dark:text-blue-400 truncate max-w-[150px] md:max-w-none">{{ $course->title }}</span>
                    </li>
                </ol>
            </nav>
            
            <h1 class="text-2xl md:text-3xl lg:text-4xl font-bold text-gray-900 dark:text-white mb-3 font-heading leading-tight">
                {{ $course->title }}
            </h1>
            <p class="text-base md:text-lg text-gray-600 dark:text-gray-300 max-w-3xl">
                {{ $course->short_description ?? Str::limit(strip_tags($course->description), 150) }}
            </p>
            
            <!-- Optional Meta Info Row -->
            <div class="flex flex-wrap items-center gap-4 mt-4 text-sm">
                <div class="flex items-center gap-1 text-yellow-500">
                    <span class="font-bold text-gray-900 dark:text-white">{{ number_format($course->rating ?? 0, 1) }}</span>
                    <i class="fas fa-star"></i>
                    <span class="text-gray-500 dark:text-gray-400">({{ $course->total_reviews ?? 0 }} রিভিউ)</span>
                </div>
                <div class="flex items-center gap-1 text-gray-600 dark:text-gray-400">
                    <i class="fas fa-user-graduate"></i>
                    <span>{{ $course->total_students ?? 0 }} জন শিক্ষার্থী</span>
                </div>
            </div>
        </div>

        <div class="flex flex-col lg:flex-row gap-8 relative">
            <!-- Main Content -->
            <div class="lg:w-2/3">
                <!-- Video Trailer -->
                <div class="bg-black rounded-xl shadow-lg overflow-hidden mb-8 border border-gray-200 dark:border-slate-700 relative group">
                    <div class="aspect-video relative">
                        @if($course->thumbnail)
                            <img src="{{ asset('storage/' . $course->thumbnail) }}" class="w-full h-full object-cover opacity-90 group-hover:opacity-75 transition duration-300" alt="Course Thumbnail">
                        @endif
                        <div class="absolute inset-0 flex items-center justify-center">
                            <button class="w-16 h-16 bg-white/90 dark:bg-white/80 hover:bg-white text-blue-600 rounded-full flex items-center justify-center shadow-xl transition-transform transform group-hover:scale-110 pl-1">
                                <i class="fas fa-play text-xl"></i>
                            </button>
                        </div>
                    </div>
                    <div class="p-4 md:p-6 bg-gray-50 dark:bg-slate-800 border-t border-gray-200 dark:border-slate-700">
                        <div class="flex flex-wrap gap-2 mb-3">
                            <span class="bg-blue-100 dark:bg-blue-900/30 text-blue-800 dark:text-blue-300 px-3 py-1 rounded-full text-xs font-semibold border border-blue-200 dark:border-blue-800">{{ ucfirst($course->category) }}</span>
                            <span class="bg-green-100 dark:bg-green-900/30 text-green-800 dark:text-green-300 px-3 py-1 rounded-full text-xs font-semibold border border-green-200 dark:border-green-800">{{ ucfirst($course->level) }}</span>
                            @if($course->certificate_included)
                            <span class="bg-purple-100 dark:bg-purple-900/30 text-purple-800 dark:text-purple-300 px-3 py-1 rounded-full text-xs font-semibold border border-purple-200 dark:border-purple-800">সার্টিফিকেট</span>
                            @endif
                        </div>
                        <h2 class="text-lg font-bold text-gray-900 dark:text-white mb-1">কোর্স প্রিভিউ</h2>
                        <p class="text-sm text-gray-600 dark:text-gray-400">দেখুন কিভাবে এই কোর্স আপনাকে প্রফেশনাল হিসেবে গড়ে তুলবে।</p>
                    </div>
                </div>

                <!-- Tab System -->
                <div class="bg-white dark:bg-slate-800 rounded-xl shadow-sm overflow-hidden mb-8 border border-gray-200 dark:border-slate-700"
                     x-data="{ activeTab: 'overview' }">
                    
                    <!-- Tab Header -->
                    <div class="border-b border-gray-200 dark:border-slate-700 overflow-x-auto scrollbar-hide">
                        <nav class="flex">
                            <button @click="activeTab = 'overview'"
                                    :class="activeTab === 'overview' ? 'border-blue-600 text-blue-600 dark:text-blue-400 bg-blue-50 dark:bg-slate-700/50' : 'border-transparent text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-200'"
                                    class="px-6 py-4 text-sm font-medium border-b-2 whitespace-nowrap focus:outline-none transition-colors flex items-center gap-2">
                                <i class="fas fa-info-circle"></i> ওভারভিউ
                            </button>
                            <button @click="activeTab = 'curriculum'"
                                    :class="activeTab === 'curriculum' ? 'border-blue-600 text-blue-600 dark:text-blue-400 bg-blue-50 dark:bg-slate-700/50' : 'border-transparent text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-200'"
                                    class="px-6 py-4 text-sm font-medium border-b-2 whitespace-nowrap focus:outline-none transition-colors flex items-center gap-2">
                                <i class="fas fa-book"></i> কারিকুলাম
                            </button>
                            <button @click="activeTab = 'instructor'"
                                    :class="activeTab === 'instructor' ? 'border-blue-600 text-blue-600 dark:text-blue-400 bg-blue-50 dark:bg-slate-700/50' : 'border-transparent text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-200'"
                                    class="px-6 py-4 text-sm font-medium border-b-2 whitespace-nowrap focus:outline-none transition-colors flex items-center gap-2">
                                <i class="fas fa-user-tie"></i> ইনস্ট্রাক্টর
                            </button>
                            @if(!empty($course->requirements))
                            <button @click="activeTab = 'requirements'"
                                    :class="activeTab === 'requirements' ? 'border-blue-600 text-blue-600 dark:text-blue-400 bg-blue-50 dark:bg-slate-700/50' : 'border-transparent text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-200'"
                                    class="px-6 py-4 text-sm font-medium border-b-2 whitespace-nowrap focus:outline-none transition-colors flex items-center gap-2">
                                <i class="fas fa-tasks"></i> প্রয়োজনীয়তা
                            </button>
                            @endif
                        </nav>
                    </div>

                    <!-- Tab Content -->
                    <div class="p-6">
                        
                        <!-- Overview Tab -->
                        <div x-show="activeTab === 'overview'" x-transition.opacity.duration.300ms>
                            
                            @if(!empty($course->what_you_will_learn))
                            <div class="mb-6">
                                <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-3">যা যা শিখবেন</h3>
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                                    @foreach($course->what_you_will_learn as $item)
                                        <div class="flex items-start gap-2">
                                            <i class="fas fa-check text-green-500 mt-1 flex-shrink-0 text-sm"></i>
                                            <span class="text-gray-600 dark:text-gray-300 text-sm">{{ $item }}</span>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                            @endif

                            <div class="prose dark:prose-invert max-w-none text-sm text-gray-600 dark:text-gray-300 leading-relaxed">
                                {!! nl2br(e($course->description)) !!}
                            </div>
                        </div>

                        <!-- Curriculum Tab -->
                        <div x-show="activeTab === 'curriculum'" x-transition.opacity.duration.300ms x-cloak>
                             <!-- Existing Curriculum Code -->
                             <div class="space-y-3" x-data="{ activeSection: 0 }">
                                @forelse($course->sections as $index => $section)
                                    <div class="border border-gray-200 dark:border-slate-700 rounded-lg overflow-hidden">
                                        <button @click="activeSection === {{ $index }} ? activeSection = null : activeSection = {{ $index }}" 
                                                class="w-full flex justify-between items-center p-4 bg-gray-50 dark:bg-slate-700/30 hover:bg-gray-100 dark:hover:bg-slate-700 transition text-left">
                                            <div class="flex items-center gap-3">
                                                <i class="fas text-gray-400 text-xs transition-transform duration-200" :class="activeSection === {{ $index }} ? 'rotate-180' : ''"></i>
                                                <span class="font-semibold text-gray-800 dark:text-gray-200 text-sm">{{ $section->title }}</span>
                                            </div>
                                            <span class="text-xs text-gray-500 dark:text-gray-400">{{ $section->lessons->count() }} লেসন</span>
                                        </button>
                                        
                                        <div x-show="activeSection === {{ $index }}" x-collapse class="bg-white dark:bg-slate-800 border-t border-gray-100 dark:border-slate-700">
                                            <ul class="divide-y divide-gray-100 dark:divide-slate-700">
                                                @foreach($section->lessons as $lesson)
                                                    <li class="flex justify-between items-center py-3 px-4 hover:bg-gray-50 dark:hover:bg-slate-700/50 transition">
                                                        <div class="flex items-center gap-3">
                                                            <i class="far fa-play-circle text-gray-400 text-xs"></i>
                                                            <span class="text-sm text-gray-600 dark:text-gray-300">{{ $lesson->title }}</span>
                                                        </div>
                                                        <div class="flex items-center gap-2">
                                                            @if($lesson->is_free)
                                                                <span class="text-[10px] text-green-600 dark:text-green-400 bg-green-50 dark:bg-green-900/20 px-2 py-0.5 rounded">ফ্রি</span>
                                                            @endif
                                                            <span class="text-xs text-gray-400">{{ $lesson->duration ?? '00:00' }}</span>
                                                        </div>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    </div>
                                @empty
                                    <p class="text-center text-gray-500 py-4">কারিকুলাম আপডেট করা হচ্ছে...</p>
                                @endforelse
                            </div>
                        </div>

                        <!-- Instructor Tab -->
                        <div x-show="activeTab === 'instructor'" x-transition.opacity.duration.300ms x-cloak>
                            <div class="flex flex-col sm:flex-row gap-6 items-start">
                                <div class="flex-shrink-0">
                                     <img src="{{ $course->instructor->avatar_url ?? 'https://ui-avatars.com/api/?name='.urlencode($course->instructor->name) }}" 
                                          alt="{{ $course->instructor->name }}" 
                                          class="w-20 h-20 rounded-full object-cover border-2 border-gray-200 dark:border-slate-600">
                                </div>
                                <div>
                                    <h3 class="text-lg font-bold text-gray-900 dark:text-white">{{ $course->instructor->name }}</h3>
                                    <p class="text-sm text-blue-600 dark:text-blue-400 font-medium mb-2">{{ $course->instructor->bio_title ?? 'Instructor' }}</p>
                                    <p class="text-sm text-gray-600 dark:text-gray-300 leading-relaxed">
                                        {{ $course->instructor->bio ?? 'বিস্তারিত তথ্য শীঘ্রই আসছে...' }}
                                    </p>
                                </div>
                            </div>
                        </div>

                        <!-- Requirements Tab -->
                        @if(!empty($course->requirements))
                        <div x-show="activeTab === 'requirements'" x-transition.opacity.duration.300ms x-cloak>
                             <ul class="space-y-2">
                                @foreach($course->requirements as $req)
                                    <li class="flex items-start gap-2.5 text-sm text-gray-700 dark:text-gray-300">
                                        <span class="w-1.5 h-1.5 bg-gray-400 rounded-full mt-1.5 flex-shrink-0"></span>
                                        {{ $req }}
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                        @endif

                    </div>
                </div>
            </div>

            <!-- Sidebar (Sticky) -->
            <div class="lg:w-1/3 relative">
                <div class="lg:sticky lg:top-24 z-20 space-y-6">
                    <!-- Enrollment Card -->
                    <div class="bg-white dark:bg-slate-800 rounded-xl shadow-lg border border-gray-200 dark:border-slate-700 overflow-hidden p-6">
                        
                        <div class="flex flex-col gap-1 mb-6">
                            <p class="text-sm text-gray-500 dark:text-gray-400 font-medium">কোর্স ফি</p>
                            <div class="flex items-end gap-2">
                                @if($course->discount_price)
                                    <span class="text-3xl font-bold text-gray-900 dark:text-white">৳{{ number_format($course->discount_price) }}</span>
                                    <span class="text-lg text-gray-400 line-through mb-1">৳{{ number_format($course->price) }}</span>
                                    <span class="text-xs font-bold text-red-600 bg-red-50 dark:bg-red-900/20 px-2 py-1 rounded">
                                        {{ round((($course->price - $course->discount_price) / $course->price) * 100) }}% OFF
                                    </span>
                                @else
                                    <span class="text-3xl font-bold text-gray-900 dark:text-white">৳{{ number_format($course->price) }}</span>
                                @endif
                            </div>
                        </div>

                        <!-- Buttons -->
                        <div class="space-y-3">
                            @auth
                                <form action="#" method="POST"> @csrf
                                    <button class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 rounded-lg transition shadow-md flex items-center justify-center gap-2">
                                        <i class="fas fa-shopping-cart"></i> এনরোল করুন
                                    </button>
                                </form>
                            @else
                                <a href="{{ route('login') }}" class="block w-full bg-blue-600 hover:bg-blue-700 text-white text-center font-bold py-3 rounded-lg transition shadow-md">
                                    লগইন করে এনরোল করুন
                                </a>
                            @endauth
                            
                            <p class="text-center text-xs text-gray-400 mt-2">৩০ দিনের মানিব্যাক গ্যারান্টি</p>
                        </div>

                        <!-- Includes List -->
                        <div class="mt-6 pt-6 border-t border-gray-100 dark:border-slate-700">
                            <h4 class="text-sm font-bold text-gray-900 dark:text-white mb-3">এই কোর্সে যা পাচ্ছেন:</h4>
                            <ul class="space-y-3 text-sm text-gray-600 dark:text-gray-300">
                                <li class="flex items-center gap-3">
                                    <i class="fas fa-video w-5 text-center text-gray-400"></i>
                                    <span>{{ $course->duration ?? '০০' }} ঘণ্টার ভিডিও</span>
                                </li>
                                <li class="flex items-center gap-3">
                                    <i class="fas fa-file-download w-5 text-center text-gray-400"></i>
                                    <span>{{ $course->sections->count() }}টি রিসোর্স ফাইল</span>
                                </li>
                                <li class="flex items-center gap-3">
                                    <i class="fas fa-infinity w-5 text-center text-gray-400"></i>
                                    <span>আজীবন এক্সেস</span>
                                </li>
                                <li class="flex items-center gap-3">
                                    <i class="fas fa-mobile-alt w-5 text-center text-gray-400"></i>
                                    <span>মোবাইল ও টিভিতে এক্সেস</span>
                                </li>
                                @if($course->certificate_included)
                                <li class="flex items-center gap-3">
                                    <i class="fas fa-certificate w-5 text-center text-gray-400"></i>
                                    <span>কোর্স শেষে সার্টিফিকেট</span>
                                </li>
                                @endif
                            </ul>
                        </div>
                    </div>

                    <!-- Social Share -->
                    <div class="bg-white dark:bg-slate-800 rounded-xl shadow-sm border border-gray-200 dark:border-slate-700 p-4 text-center">
                        <p class="text-xs font-semibold text-gray-500 dark:text-gray-400 mb-3 uppercase tracking-wide">শেয়ার করুন</p>
                        <div class="flex justify-center gap-3">
                            <button class="w-9 h-9 rounded-full bg-blue-50 dark:bg-slate-700 text-blue-600 dark:text-blue-400 hover:bg-blue-600 hover:text-white transition flex items-center justify-center"><i class="fab fa-facebook-f"></i></button>
                            <button class="w-9 h-9 rounded-full bg-sky-50 dark:bg-slate-700 text-sky-500 dark:text-sky-400 hover:bg-sky-500 hover:text-white transition flex items-center justify-center"><i class="fab fa-twitter"></i></button>
                            <button class="w-9 h-9 rounded-full bg-green-50 dark:bg-slate-700 text-green-600 dark:text-green-400 hover:bg-green-600 hover:text-white transition flex items-center justify-center"><i class="fab fa-whatsapp"></i></button>
                            <button class="w-9 h-9 rounded-full bg-gray-100 dark:bg-slate-700 text-gray-600 dark:text-gray-300 hover:bg-gray-600 hover:text-white transition flex items-center justify-center"><i class="fas fa-link"></i></button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Mobile Sticky Bottom Bar (For Enrollment) -->
    <div class="fixed bottom-0 left-0 right-0 bg-white dark:bg-slate-900 border-t border-gray-200 dark:border-slate-800 p-4 lg:hidden z-50 shadow-[0_-5px_15px_rgba(0,0,0,0.1)]">
        <div class="flex justify-between items-center gap-4">
            <div class="flex flex-col">
                @if($course->discount_price)
                    <span class="text-xl font-bold text-gray-900 dark:text-white">৳{{ number_format($course->discount_price) }}</span>
                    <span class="text-xs text-gray-500 line-through">৳{{ number_format($course->price) }}</span>
                @else
                    <span class="text-xl font-bold text-gray-900 dark:text-white">৳{{ number_format($course->price) }}</span>
                @endif
            </div>
            
            <div class="flex-1 max-w-[180px]">
                @auth
                    <button class="block w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-2.5 rounded-lg transition text-sm shadow-md">
                        এনরোল করুন
                    </button>
                @else
                    <a href="{{ route('login') }}" class="block w-full bg-blue-600 hover:bg-blue-700 text-white text-center font-bold py-2.5 rounded-lg transition text-sm shadow-md">
                        লগইন করুন
                    </a>
                @endauth
            </div>
        </div>
    </div>
    
    <!-- Space for Mobile Bottom Bar -->
    <div class="h-20 lg:hidden"></div>

@endsection