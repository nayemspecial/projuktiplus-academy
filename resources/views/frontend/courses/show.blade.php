@extends('frontend.layouts.master')

@section('title', $course->title)
@section('meta_description', Str::limit(strip_tags($course->description), 160))
@section('meta_image', $course->thumbnail ? asset('storage/' . $course->thumbnail) : asset('images/default-course.jpg'))

@section('content')

<div x-data="{ activeTab: 'overview' }">
    
    <!-- 1. Hero Section -->
    <section class="relative pt-10 pb-20 lg:pt-16 lg:pb-48 overflow-hidden bg-slate-50 dark:bg-slate-900">
        
        <!-- Animated Background -->
        <div class="absolute inset-0 overflow-hidden pointer-events-none">
            <div class="absolute top-0 left-1/4 w-96 h-96 bg-blue-500/10 dark:bg-blue-600/20 rounded-full blur-[100px] opacity-70 mix-blend-multiply dark:mix-blend-screen animate-blob"></div>
            <div class="absolute top-0 right-1/4 w-96 h-96 bg-purple-500/10 dark:bg-purple-600/20 rounded-full blur-[100px] opacity-70 mix-blend-multiply dark:mix-blend-screen animate-blob animation-delay-2000"></div>
            <div class="absolute -bottom-32 left-1/3 w-96 h-96 bg-pink-500/10 dark:bg-pink-600/20 rounded-full blur-[100px] opacity-70 mix-blend-multiply dark:mix-blend-screen animate-blob animation-delay-4000"></div>
            <svg class="absolute inset-0 w-full h-full opacity-[0.03] dark:opacity-[0.05]" xmlns="http://www.w3.org/2000/svg">
                <defs>
                    <pattern id="grid-pattern" width="40" height="40" patternUnits="userSpaceOnUse">
                        <path d="M 40 0 L 0 0 0 40" fill="none" stroke="currentColor" stroke-width="1"/>
                    </pattern>
                </defs>
                <rect width="100%" height="100%" fill="url(#grid-pattern)" />
            </svg>
        </div>

        <div class="container mx-auto px-4 relative z-10">
            <div class="flex flex-col lg:flex-row gap-8 lg:gap-12">
                <!-- Left Content -->
                <div class="lg:w-2/3">
                    <!-- Breadcrumb -->
                    <nav class="flex items-center text-xs text-slate-500 dark:text-slate-400 mb-4 space-x-2">
                        <a href="{{ route('home') }}" class="hover:text-blue-600 transition"><i class="fas fa-home"></i> হোম</a>
                        <i class="fas fa-chevron-right text-[10px] opacity-50"></i>
                        <a href="{{ route('courses.index') }}" class="hover:text-blue-600 transition">কোর্সসমূহ</a>
                        <i class="fas fa-chevron-right text-[10px] opacity-50"></i>
                        <span class="text-slate-800 dark:text-slate-200 font-medium truncate max-w-[150px]">{{ $course->title }}</span>
                    </nav>

                    <!-- Badges -->
                    <div class="flex flex-wrap gap-2 mb-4">
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-md text-xs font-bold bg-blue-100 text-blue-700 dark:bg-blue-500/20 dark:text-blue-300 border border-blue-200 dark:border-blue-800/50">
                            {{ ucfirst($course->category) }}
                        </span>
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-md text-xs font-bold bg-emerald-100 text-emerald-700 dark:bg-emerald-500/20 dark:text-emerald-300 border border-emerald-200 dark:border-emerald-800/50">
                            {{ ucfirst($course->level) }}
                        </span>
                    </div>

                    <!-- Title -->
                    <h1 class="text-3xl md:text-4xl lg:text-5xl font-bold font-heading leading-tight mb-4">
                        <span class="text-transparent bg-clip-text bg-gradient-to-r from-slate-900 to-slate-700 dark:from-white dark:to-slate-300">
                            {{ $course->title }}
                        </span>
                    </h1>

                    <!-- Description -->
                    <p class="text-base md:text-lg text-slate-600 dark:text-slate-300 mb-8 leading-relaxed max-w-2xl">
                        {{ $course->short_description ?? Str::limit(strip_tags($course->description), 150) }}
                    </p>

                    <!-- Instructor & Student Info -->
                    <div class="flex flex-wrap items-center gap-6 md:gap-10 pb-6 border-b border-slate-200 dark:border-slate-700/50">
                        
                        <!-- Instructor -->
                        <div class="flex items-center gap-3">
                            <img src="{{ $course->instructor->avatar_url }}" alt="{{ $course->instructor->name }}" 
                                 class="w-12 h-12 rounded-full object-cover border-2 border-white dark:border-slate-700 shadow-md">
                            <div>
                                <p class="text-xs text-slate-500 dark:text-slate-500 font-medium mb-0.5">ইনস্ট্রাক্টর</p>
                                <p class="text-sm font-bold text-slate-900 dark:text-white">{{ $course->instructor->name }}</p>
                            </div>
                        </div>

                        <div class="hidden md:block w-px h-8 bg-slate-200 dark:bg-slate-700"></div>

                        <!-- Rating -->
                        <div class="flex items-center gap-2">
                            <div class="flex text-amber-400 text-sm">
                                @for($i=1; $i<=5; $i++)
                                    <i class="fas fa-star {{ $i <= round($course->rating ?? 0) ? '' : 'text-slate-300 dark:text-slate-600' }}"></i>
                                @endfor
                            </div>
                            <div class="flex flex-col">
                                <span class="text-sm font-bold text-slate-800 dark:text-white leading-none">{{ number_format($course->rating ?? 0, 1) }}</span>
                                <span class="text-xs text-slate-500">({{ $course->total_reviews ?? 0 }} রিভিউ)</span>
                            </div>
                        </div>

                        <div class="hidden md:block w-px h-8 bg-slate-200 dark:bg-slate-700"></div>

                        <!-- Student Avatar Stack (Map View) -->
                        <div class="flex items-center gap-4">
                            <div class="flex flex-col">
                                {{-- [FIXED] এখন শুধু Active/Completed স্টুডেন্ট কাউন্ট দেখাবে --}}
                                <p class="text-xs text-slate-500 dark:text-slate-400 font-medium mb-1">
                                    {{ $course->student_count }} জন শিক্ষার্থী এনরোল করেছেন
                                </p>
                                
                                @if($course->student_count > 0)
                                    <div class="flex items-center -space-x-3 overflow-hidden p-1">
                                        {{-- [FIXED] লুপ করার সময় শুধু validEnrollments থেকে ডাটা আনা হচ্ছে --}}
                                        @foreach($course->validEnrollments->take(5) as $enrollment)
                                            @if($enrollment->user) 
                                                <img class="relative inline-block h-9 w-9 rounded-full ring-2 ring-white dark:ring-slate-900 object-cover shadow-sm hover:z-10 hover:scale-110 transition-transform duration-200 cursor-pointer bg-slate-200 dark:bg-slate-700" 
                                                    src="{{ $enrollment->user->avatar_url }}" 
                                                    alt="{{ $enrollment->user->name }}"
                                                    title="{{ $enrollment->user->name }}"/>
                                            @endif
                                        @endforeach

                                        {{-- [FIXED] বাকি সংখ্যা দেখানোর লজিক আপডেট করা হয়েছে --}}
                                        @if($course->student_count > 5)
                                            <div class="relative z-10 inline-flex items-center justify-center h-9 w-9 rounded-full ring-2 ring-white dark:ring-slate-900 bg-slate-100 dark:bg-slate-800 text-[10px] font-bold text-slate-600 dark:text-slate-300 shadow-sm">
                                                +{{ $course->student_count - 5 }}
                                            </div>
                                        @endif
                                    </div>
                                @else
                                    <span class="text-xs text-slate-400 italic">এখনো কেউ এনরোল করেনি, আপনিই হোন প্রথম!</span>
                                @endif
                            </div>
                        </div>
                    </div>
                    
                    <!-- Mobile Video Preview -->
                    <div class="lg:hidden mt-8 rounded-2xl overflow-hidden shadow-lg border border-slate-200 dark:border-slate-700 relative group aspect-video">
                        <img src="{{ $course->thumbnail ? asset('storage/' . $course->thumbnail) : asset('images/default-course.jpg') }}" 
                             class="w-full h-full object-cover opacity-90">
                        <div class="absolute inset-0 flex items-center justify-center bg-black/20">
                             <button class="w-16 h-16 bg-white/90 backdrop-blur rounded-full flex items-center justify-center shadow-xl text-blue-600 pl-1 pulse-animation">
                                <i class="fas fa-play text-2xl"></i>
                             </button>
                        </div>
                    </div>
                </div>
                
                <div class="hidden lg:block lg:w-1/3"></div>
            </div>
        </div>
    </section>

    <!-- 2. Main Content & Sticky Sidebar -->
    <div class="container mx-auto px-4 pb-16 relative z-20 -mt-0 lg:-mt-10">
        <div class="flex flex-col lg:flex-row gap-8">
            
            <!-- Left Column -->
            <div class="lg:w-2/3">
                <!-- Tab Navigation -->
                <div class="sticky top-[64px] z-30 bg-white/95 dark:bg-slate-900/95 backdrop-blur border-b border-slate-200 dark:border-slate-800 mb-8 rounded-t-xl lg:rounded-xl lg:border lg:shadow-sm">
                    <nav class="flex overflow-x-auto scrollbar-hide">
                        @foreach(['overview' => 'ওভারভিউ', 'curriculum' => 'কারিকুলাম', 'instructor' => 'ইনস্ট্রাক্টর', 'reviews' => 'রিভিউ'] as $key => $label)
                        <button @click="activeTab = '{{ $key }}'"
                                :class="activeTab === '{{ $key }}' ? 'text-blue-600 dark:text-blue-400 border-blue-600' : 'text-slate-500 dark:text-slate-400 border-transparent hover:text-slate-800 dark:hover:text-slate-200'"
                                class="px-6 py-4 text-sm font-bold border-b-2 whitespace-nowrap transition-colors flex items-center gap-2">
                            {{ $label }}
                        </button>
                        @endforeach
                    </nav>
                </div>

                <!-- Tab Content -->
                <div class="bg-white dark:bg-slate-800 rounded-xl border border-slate-200 dark:border-slate-700 p-6 md:p-8 shadow-sm min-h-[400px]">
                    
                    <!-- Overview -->
                    <div x-show="activeTab === 'overview'" x-transition.opacity.duration.300ms>
                        @if(!empty($course->what_you_will_learn))
                        <div class="border border-emerald-100 dark:border-emerald-900/30 rounded-xl p-6 mb-8 bg-emerald-50/50 dark:bg-emerald-900/10">
                            <h3 class="text-lg font-bold text-slate-900 dark:text-white mb-4 flex items-center gap-2">
                                <i class="fas fa-check-circle text-emerald-500"></i> যা যা শিখবেন
                            </h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                                @foreach($course->what_you_will_learn as $item)
                                    <div class="flex items-start gap-3">
                                        <i class="fas fa-check text-emerald-500 mt-1 text-xs flex-shrink-0"></i>
                                        <span class="text-slate-600 dark:text-slate-300 text-sm font-medium leading-snug">{{ $item }}</span>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        @endif

                        <h3 class="text-xl font-bold text-slate-900 dark:text-white mb-4">কোর্স সম্পর্কে বিস্তারিত</h3>
                        <div class="prose dark:prose-invert max-w-none text-slate-600 dark:text-slate-300 text-sm leading-relaxed mb-8">
                            {!! nl2br(e($course->description)) !!}
                        </div>

                        @if(!empty($course->requirements))
                        <div class="mt-8 pt-8 border-t border-slate-100 dark:border-slate-700">
                            <h3 class="text-lg font-bold text-slate-900 dark:text-white mb-3">পূর্বশর্ত</h3>
                            <ul class="space-y-2">
                                @foreach($course->requirements as $req)
                                    <li class="flex items-start gap-3 text-slate-600 dark:text-slate-300 text-sm">
                                        <span class="flex h-5 w-5 items-center justify-center rounded-full bg-blue-100 dark:bg-blue-900/30 text-blue-600 dark:text-blue-400 flex-shrink-0">
                                            <i class="fas fa-angle-right text-[10px]"></i>
                                        </span>
                                        {{ $req }}
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                        @endif
                    </div>

                    <!-- Curriculum -->
                    <div x-show="activeTab === 'curriculum'" x-transition.opacity x-cloak>
                        <div class="flex justify-between items-center mb-6">
                            <h3 class="text-lg font-bold text-slate-900 dark:text-white">কোর্স কারিকুলাম</h3>
                            <span class="text-xs font-bold text-slate-500 bg-slate-100 dark:bg-slate-700 px-2 py-1 rounded">{{ $course->lessons_count ?? 0 }} টি লেসন</span>
                        </div>
                        <div class="space-y-3" x-data="{ activeSection: 0 }">
                            @forelse($course->sections as $index => $section)
                                <div class="border border-slate-200 dark:border-slate-700 rounded-xl overflow-hidden bg-slate-50/30 dark:bg-slate-800/30">
                                    <button @click="activeSection === {{ $index }} ? activeSection = null : activeSection = {{ $index }}" 
                                            class="w-full flex justify-between items-center p-4 hover:bg-slate-50 dark:hover:bg-slate-800 transition text-left">
                                        <div class="flex items-center gap-4">
                                            <span class="flex h-8 w-8 items-center justify-center rounded-lg bg-white dark:bg-slate-700 text-slate-500 dark:text-slate-300 text-sm font-bold shadow-sm border border-slate-100 dark:border-slate-600">
                                                {{ $loop->iteration }}
                                            </span>
                                            <span class="font-bold text-slate-800 dark:text-slate-200 text-sm">{{ $section->title }}</span>
                                        </div>
                                        <div class="flex items-center gap-3">
                                            <span class="text-xs text-slate-500 dark:text-slate-400 hidden sm:block">{{ $section->lessons->count() }} লেসন</span>
                                            <i class="fas text-slate-400 text-xs transition-transform duration-300" :class="activeSection === {{ $index }} ? 'rotate-180' : ''"></i>
                                        </div>
                                    </button>
                                    
                                    <div x-show="activeSection === {{ $index }}" x-collapse class="border-t border-slate-200 dark:border-slate-700/50 bg-white dark:bg-slate-900">
                                        <ul class="divide-y divide-slate-100 dark:divide-slate-800">
                                            @foreach($section->lessons as $lesson)
                                                <li class="flex justify-between items-center py-3 px-5 hover:bg-slate-50 dark:hover:bg-slate-800/50 transition group cursor-pointer">
                                                    <div class="flex items-center gap-3 overflow-hidden">
                                                        <i class="far fa-play-circle text-slate-400 text-sm group-hover:text-blue-500 transition-colors"></i>
                                                        <span class="text-sm text-slate-600 dark:text-slate-300 font-medium truncate group-hover:text-blue-600 dark:group-hover:text-blue-400 transition-colors">{{ $lesson->title }}</span>
                                                    </div>
                                                    <div class="flex items-center gap-3">
                                                        @if($lesson->is_free)
                                                            <span class="text-[10px] font-bold text-blue-600 bg-blue-50 dark:bg-blue-900/30 px-2 py-0.5 rounded border border-blue-100 dark:border-blue-800">ফ্রি</span>
                                                        @endif
                                                        <span class="text-xs text-slate-400">{{ $lesson->duration ?? '10:00' }}</span>
                                                    </div>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            @empty
                                <div class="text-center py-10 bg-slate-50 dark:bg-slate-800/50 rounded-xl border border-dashed border-slate-200 dark:border-slate-700">
                                    <p class="text-slate-500">কারিকুলাম আপডেট করা হচ্ছে...</p>
                                </div>
                            @endforelse
                        </div>
                    </div>

                    <!-- Instructor Tab -->
                    <div x-show="activeTab === 'instructor'" x-transition.opacity x-cloak>
                        <div class="bg-slate-50 dark:bg-slate-800/50 rounded-xl p-6 border border-slate-200 dark:border-slate-700 flex flex-col md:flex-row gap-8 items-start">
                            <div class="flex-shrink-0 w-full md:w-auto flex justify-center">
                                <img src="{{ $course->instructor->avatar_url }}" alt="{{ $course->instructor->name }}" 
                                     class="w-32 h-32 rounded-full object-cover border-4 border-white dark:border-slate-600 shadow-lg">
                            </div>
                            <div class="flex-1 text-center md:text-left">
                                <h3 class="text-2xl font-bold text-slate-900 dark:text-white mb-1">{{ $course->instructor->name }}</h3>
                                <p class="text-blue-600 dark:text-blue-400 text-sm font-bold uppercase tracking-wide mb-4">{{ $course->instructor->bio_title ?? 'Instructor' }}</p>
                                
                                <div class="flex flex-wrap justify-center md:justify-start gap-4 mb-6">
                                    <div class="flex flex-col items-center md:items-start p-3 bg-white dark:bg-slate-900 rounded-lg border border-slate-100 dark:border-slate-700 min-w-[100px]">
                                        <span class="text-xs text-slate-500">রেটিং</span>
                                        <span class="text-lg font-bold text-slate-800 dark:text-white flex items-center gap-1">
                                            4.8 <i class="fas fa-star text-yellow-400 text-xs"></i>
                                        </span>
                                    </div>
                                    <div class="flex flex-col items-center md:items-start p-3 bg-white dark:bg-slate-900 rounded-lg border border-slate-100 dark:border-slate-700 min-w-[100px]">
                                        <span class="text-xs text-slate-500">কোর্স</span>
                                        <span class="text-lg font-bold text-slate-800 dark:text-white">
                                            {{ $course->instructor->courses->count() }} টি
                                        </span>
                                    </div>
                                    <div class="flex flex-col items-center md:items-start p-3 bg-white dark:bg-slate-900 rounded-lg border border-slate-100 dark:border-slate-700 min-w-[100px]">
                                        <span class="text-xs text-slate-500">শিক্ষার্থী</span>
                                        <span class="text-lg font-bold text-slate-800 dark:text-white">
                                            9 জন।
                                        </span>
                                    </div>
                                </div>
                                
                                <p class="text-sm text-slate-600 dark:text-slate-300 leading-relaxed">
                                    {{ $course->instructor->bio ?? 'এই ইনস্ট্রাক্টরের বিস্তারিত তথ্য শীঘ্রই যুক্ত করা হবে।' }}
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- Reviews Tab -->
                    <div x-show="activeTab === 'reviews'" x-transition.opacity x-cloak>
                        <div class="text-center py-12 bg-slate-50 dark:bg-slate-800/30 rounded-xl">
                            <div class="w-16 h-16 bg-slate-100 dark:bg-slate-700 rounded-full flex items-center justify-center mx-auto mb-3">
                                <i class="far fa-comment-alt text-2xl text-slate-400"></i>
                            </div>
                            <p class="text-slate-500 dark:text-slate-400 font-medium">এখনো কোনো রিভিউ নেই।</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Column: Sticky Sidebar -->
            <div class="lg:w-1/3 relative">
                <div class="lg:sticky lg:top-24 z-20 lg:-mt-[400px]"> 
                    
                    <!-- Enrollment Card -->
                    <div class="bg-white dark:bg-slate-800/80 backdrop-blur-xl rounded-2xl shadow-2xl border border-slate-200 dark:border-slate-700 overflow-hidden relative">
                        
                        <!-- Video Thumbnail -->
                        <div class="relative aspect-video bg-black group cursor-pointer overflow-hidden border-b border-slate-100 dark:border-slate-700 hidden lg:block">
                            <img src="{{ $course->thumbnail ? asset('storage/' . $course->thumbnail) : asset('images/default-course.jpg') }}" 
                                 class="w-full h-full object-cover opacity-90 group-hover:opacity-75 transition duration-500">
                            <div class="absolute inset-0 flex items-center justify-center">
                                <div class="w-16 h-16 bg-white/20 backdrop-blur-md rounded-full flex items-center justify-center shadow-lg group-hover:scale-110 transition transform border border-white/30">
                                    <i class="fas fa-play text-white text-xl pl-1"></i>
                                </div>
                            </div>
                        </div>

                        <div class="p-6">
                            <div class="flex items-end gap-2 mb-6">
                                @if($course->discount_price && $course->price > 0)
                                    <span class="text-4xl font-extrabold text-slate-900 dark:text-white">৳{{ number_format($course->discount_price) }}</span>
                                    <span class="text-lg text-slate-400 line-through mb-1">৳{{ number_format($course->price) }}</span>
                                    <span class="ml-auto text-[10px] font-bold text-white bg-red-500 px-2 py-1 rounded shadow-sm animate-pulse">
                                        {{ round((($course->price - $course->discount_price) / $course->price) * 100) }}% OFF
                                    </span>
                                @elseif($course->price == 0)
                                    <span class="text-4xl font-extrabold text-emerald-600 dark:text-emerald-400">ফ্রি</span>
                                @else
                                    <span class="text-4xl font-bold text-slate-900 dark:text-white">৳{{ number_format($course->price) }}</span>
                                @endif
                            </div>

                            <div class="space-y-3">
                                @auth
                                    @if(auth()->user()->enrollments->where('course_id', $course->id)->count() > 0)
                                        <a href="{{ route('student.courses.show', $course->id) }}" class="w-full flex items-center justify-center bg-emerald-600 hover:bg-emerald-700 text-white font-bold py-3.5 rounded-xl transition shadow-lg shadow-emerald-500/20 transform active:scale-95">
                                            <i class="fas fa-play-circle mr-2"></i> ক্লাস শুরু করুন
                                        </a>
                                    @else
                                        <a href="{{ route('courses.checkout', $course->slug) }}" class="w-full flex items-center justify-center bg-blue-600 hover:bg-blue-700 text-white font-bold py-3.5 rounded-xl transition shadow-lg shadow-blue-500/30 transform hover:-translate-y-0.5 active:scale-95">
                                            এখনই এনরোল করুন
                                        </a>
                                        <button class="w-full flex items-center justify-center border-2 border-slate-200 dark:border-slate-700 text-slate-700 dark:text-slate-300 font-bold py-3 rounded-xl transition hover:bg-slate-50 dark:hover:bg-slate-700/50">
                                            <i class="fas fa-cart-plus mr-2"></i> কার্টে যোগ করুন
                                        </button>
                                    @endif
                                @else
                                    <a href="{{ route('login') }}" class="w-full flex items-center justify-center bg-blue-600 hover:bg-blue-700 text-white font-bold py-3.5 rounded-xl transition shadow-lg shadow-blue-500/30">
                                        লগইন করে এনরোল করুন
                                    </a>
                                @endauth
                            </div>
                            
                            <!-- Money Back Guarantee -->
                            <div class="mt-4 text-center">
                                <p class="text-[11px] text-slate-500 dark:text-slate-400 flex items-center justify-center gap-1.5">
                                    <i class="fas fa-shield-alt text-green-500"></i> প্রজেক্ট ভিত্তিক লার্নিং
                                </p>
                            </div>
                            {{--
                            <!-- Course Includes -->
                            <div class="mt-6 pt-6 border-t border-slate-100 dark:border-slate-700">
                                <p class="text-xs font-bold text-slate-900 dark:text-white uppercase mb-3 tracking-wide">এই কোর্সে যা পাচ্ছেন:</p>
                                <ul class="space-y-2 text-sm text-slate-600 dark:text-slate-400">
                                    <li class="flex items-center gap-3">
                                        <i class="fas fa-video w-5 text-center text-blue-500"></i>
                                        <span>{{ $course->duration ?? '০০' }} ঘণ্টার ভিডিও</span>
                                    </li>
                                    <li class="flex items-center gap-3">
                                        <i class="fas fa-file-download w-5 text-center text-purple-500"></i>
                                        <span>{{ $course->sections->count() }}টি রিসোর্স ফাইল</span>
                                    </li>
                                    <li class="flex items-center gap-3">
                                        <i class="fas fa-infinity w-5 text-center text-green-500"></i>
                                        <span></span>
                                    </li>
                                    <li class="flex items-center gap-3">
                                        <i class="fas fa-mobile-alt w-5 text-center text-orange-500"></i>
                                        <span>ক্লাস শেষে প্রশ্ন উত্তর পর্ব </span>
                                    </li>
                                    @if($course->certificate_included)
                                    <li class="flex items-center gap-3">
                                        <i class="fas fa-certificate w-5 text-center text-yellow-500"></i>
                                        <span>কোর্স শেষে সার্টিফিকেট</span>
                                    </li>
                                    @endif
                                </ul>
                            </div>
                            --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Mobile Sticky Bottom Bar -->
<div class="fixed bottom-0 left-0 right-0 bg-white dark:bg-slate-900 border-t border-slate-200 dark:border-slate-800 p-4 lg:hidden z-50 shadow-[0_-4px_20px_rgba(0,0,0,0.1)] animate-slide-up">
    <div class="flex justify-between items-center gap-4 max-w-2xl mx-auto">
        <div class="flex flex-col">
            @if($course->discount_price)
                <span class="text-2xl font-bold text-slate-900 dark:text-white">৳{{ number_format($course->discount_price) }}</span>
                <span class="text-xs text-slate-500 line-through">৳{{ number_format($course->price) }}</span>
            @else
                <span class="text-2xl font-bold text-slate-900 dark:text-white">৳{{ number_format($course->price) }}</span>
            @endif
        </div>
        
        <div class="flex-1">
            @auth
                <a href="{{ route('courses.checkout', $course->slug) }}" class="block w-full bg-blue-600 hover:bg-blue-700 text-white text-center font-bold py-3 rounded-xl transition text-sm shadow-lg shadow-blue-600/20">
                    এনরোল করুন
                </a>
            @else
                <a href="{{ route('register') }}" class="block w-full bg-blue-600 hover:bg-blue-700 text-white text-center font-bold py-3 rounded-xl transition shadow-lg shadow-blue-600/20">
                    রেজিস্ট্রেশন করুন
                </a>
            @endauth
        </div>
    </div>
</div>
<div class="h-24 lg:hidden"></div>

@endsection