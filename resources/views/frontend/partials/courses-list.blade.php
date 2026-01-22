<section class="relative w-full py-12 lg:py-16 overflow-hidden bg-slate-50 dark:bg-slate-900 transition-colors duration-300">
    
    <div class="absolute top-0 left-1/2 -translate-x-1/2 w-full h-full z-0 pointer-events-none">
        <div class="absolute top-20 left-10 w-72 h-72 bg-blue-500/10 rounded-full blur-[80px] mix-blend-multiply dark:mix-blend-screen animate-blob"></div>
        <div class="absolute bottom-20 right-10 w-72 h-72 bg-purple-500/10 rounded-full blur-[80px] mix-blend-multiply dark:mix-blend-screen animate-blob animation-delay-2000"></div>
    </div>

    <div class="container mx-auto px-4 relative z-10">
        
        <div class="text-center mb-10">
            <h2 class="text-2xl md:text-3xl font-bold text-slate-900 dark:text-white mb-3 font-heading">
                <span class="bg-clip-text text-transparent bg-gradient-to-r from-blue-600 dark:from-gray-100 via-purple-600 dark:via-purple-300 to-pink-600 dark:to-pink-200">
                    জনপ্রিয় কোর্সসমূহ
                </span>
            </h2>
            <p class="text-sm md:text-base text-slate-600 dark:text-slate-400 max-w-2xl mx-auto">
                স্কিল ডেভেলপমেন্টের জন্য বেছে নিন আপনার পছন্দের সেরা কোর্সটি
            </p>
        </div>

        <div class="grid grid-cols-2 sm:grid-cols-2 lg:grid-cols-4 gap-4 md:gap-6">
            
            @forelse($courses as $course)
                <div class="group bg-white dark:bg-slate-800/50 backdrop-blur-sm rounded-xl border border-slate-200 dark:border-slate-700 hover:border-blue-500/50 dark:hover:border-blue-500/50 shadow-sm hover:shadow-xl transition-all duration-300 flex flex-col h-full overflow-hidden">
                    
                    <div class="relative h-32 md:h-48 overflow-hidden">
                        <img src="{{ $course->thumbnail ? asset('storage/' . $course->thumbnail) : asset('images/default-course.png') }}" 
                             alt="{{ $course->title }}" 
                             class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110">
                        
                        <div class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-center justify-center backdrop-blur-[2px]">
                            <a href="{{ route('courses.show', $course->slug) }}" class="w-10 h-10 bg-white/90 rounded-full flex items-center justify-center text-blue-600 shadow-lg transform translate-y-4 group-hover:translate-y-0 transition-all duration-300">
                                <i class="fas fa-play ml-1 text-sm"></i>
                            </a>
                        </div>

                        <div class="absolute top-3 left-3">
                            <span class="px-2 py-1 text-[10px] font-bold text-white rounded-md backdrop-blur-md shadow-sm uppercase tracking-wider
                                  {{ $course->level === 'beginner' ? 'bg-green-500/80' : ($course->level === 'advanced' ? 'bg-red-500/80' : 'bg-blue-500/80') }}">
                                {{ ucfirst($course->level) }}
                            </span>
                        </div>
                    </div>

                    <div class="p-3 sm:p-4 flex flex-col flex-grow">
                        
                        <div class="flex justify-between items-center mb-2 text-[11px] font-medium text-slate-500 dark:text-slate-400">
                            <div class="flex items-center text-[10px] bg-slate-100 dark:bg-slate-700/50 text-slate-600 dark:text-slate-300 font-semibold px-2 py-0.5 rounded border border-slate-200 dark:border-slate-700 gap-1" title="Students">
                                <i class="fas fa-user-graduate"></i> 
                                <span>{{ $course->student_count ?? 0 }}</span>
                            </div>
                            <div class="flex items-center gap-1 bg-slate-100 dark:bg-slate-700/50 text-slate-600 dark:text-slate-300 text-[10px] font-semibold px-2 py-0.5 rounded border border-slate-200 dark:border-slate-700">
                                <i class="far fa-file-video"></i>
                                <span>{{ $course->lessons_count ?? 0 }} লেসন</span>
                            </div>
                        </div>

                        <h3 class="text-sm sm:text-base font-bold text-slate-900 dark:text-white mb-2 line-clamp-2 leading-snug group-hover:text-blue-600 dark:group-hover:text-blue-400 transition-colors font-heading">
                            <a href="{{ route('courses.show', $course->slug) }}">{{ $course->title }}</a>
                        </h3>
                        
                        <div class="flex items-center gap-2 mb-4">
                            <div class="w-6 h-6 rounded-full bg-slate-200 dark:bg-slate-700 overflow-hidden">
                                <img src="{{ $course->instructor->avatar ? asset('storage/'.$course->instructor->avatar) : 'https://ui-avatars.com/api/?name='.urlencode($course->instructor->name ?? 'Admin') }}" 
                                     class="w-full h-full object-cover">
                            </div>
                            <span class="text-xs text-slate-600 dark:text-slate-400 truncate font-medium">
                                {{ $course->instructor->name ?? 'Instructor' }}
                            </span>
                        </div>

                        <div class="mt-auto pt-3 border-t border-slate-100 dark:border-slate-700/50 flex justify-between items-center">
                            <div>
                                @if($course->discount_price)
                                    <div class="flex flex-col leading-none">
                                        <span class="text-lg font-bold text-slate-900 dark:text-white">৳{{ number_format($course->discount_price) }}</span>
                                        <span class="text-[10px] text-slate-400 line-through decoration-red-400/60 font-medium mt-0.5">৳{{ number_format($course->price) }}</span>
                                    </div>
                                @elseif($course->price == 0)
                                    <span class="text-lg font-bold text-emerald-600 dark:text-emerald-400">ফ্রি</span>
                                @else
                                    <span class="text-lg font-bold text-slate-900 dark:text-white">৳{{ number_format($course->price) }}</span>
                                @endif
                            </div>
                            
                            <a href="{{ route('courses.show', $course->slug) }}" class="text-sm font-bold text-blue-600 dark:text-blue-400 hover:text-blue-700 dark:hover:text-blue-300 transition flex items-center gap-1">
                                বিস্তারিত <i class="fas fa-arrow-right text-xs"></i>
                            </a>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-full text-center py-10">
                    <p class="text-slate-500 dark:text-slate-400">এখনো কোনো কোর্স পাবলিশ করা হয়নি।</p>
                </div>
            @endforelse

        </div>

        <div class="text-center mt-10">
            <a href="{{ route('courses.index') }}" class="inline-flex items-center px-8 py-3 bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 text-slate-700 dark:text-white rounded-full font-medium text-sm hover:bg-slate-50 dark:hover:bg-slate-700 hover:shadow-lg transition-all duration-300 group">
                সব কোর্স দেখুন <i class="fas fa-arrow-right ml-2 group-hover:translate-x-1 transition-transform"></i>
            </a>
        </div>
    </div>
    
    <style>
        .animate-blob { animation: blob 7s infinite; }
        .animation-delay-2000 { animation-delay: 2s; }
        @keyframes blob {
            0% { transform: translate(0px, 0px) scale(1); }
            33% { transform: translate(30px, -50px) scale(1.1); }
            66% { transform: translate(-20px, 20px) scale(0.9); }
            100% { transform: translate(0px, 0px) scale(1); }
        }
    </style>
</section>