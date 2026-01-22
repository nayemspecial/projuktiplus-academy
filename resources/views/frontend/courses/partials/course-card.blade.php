<div class="group bg-white dark:bg-slate-800/50 backdrop-blur-sm rounded-xl border border-slate-200 dark:border-slate-700 hover:border-blue-500/50 dark:hover:border-blue-500/50 shadow-sm hover:shadow-xl transition-all duration-300 flex flex-col h-full overflow-hidden">
    
    <!-- Thumbnail Area -->
    <div class="relative h-40 overflow-hidden">
        <img src="{{ $course->thumbnail ? asset('storage/' . $course->thumbnail) : asset('images/default-course.jpg') }}" 
             alt="{{ $course->title }}" 
             class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110">
        
        <!-- Overlay -->
        <div class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-center justify-center backdrop-blur-[2px]">
            <a href="{{ route('courses.show', $course->slug) }}" class="w-10 h-10 bg-white/90 rounded-full flex items-center justify-center text-blue-600 shadow-lg transform translate-y-4 group-hover:translate-y-0 transition-all duration-300">
                <i class="fas fa-play ml-1 text-sm"></i>
            </a>
        </div>

        <!-- Badge -->
        <div class="absolute top-3 left-3">
            <span class="px-2 py-1 text-[10px] font-bold text-white rounded-md backdrop-blur-md shadow-sm uppercase tracking-wider
                  {{ $course->level === 'beginner' ? 'bg-green-500/80' : ($course->level === 'advanced' ? 'bg-red-500/80' : 'bg-blue-500/80') }}">
                {{ ucfirst($course->level) }}
            </span>
        </div>
    </div>

    <!-- Content -->
    <div class="p-4 flex flex-col flex-grow">
        
        <!-- Rating & Lessons -->
        <div class="flex justify-between items-center mb-2 text-[11px] font-medium text-slate-500 dark:text-slate-400">
            <div class="flex items-center text-[10px] bg-slate-100 dark:bg-slate-700/50 text-slate-600 dark:text-slate-300 font-semibold px-2 py-0.5 rounded border border-slate-200 dark:border-slate-700 gap-1" title="Students">
                <i class="fas fa-user-graduate"></i> <span>{{ $course->student_count ?? 0 }}</span>
            </div>
            <div class="flex items-center gap-1 bg-slate-100 dark:bg-slate-700/50 text-slate-600 dark:text-slate-300 text-[10px] font-semibold px-2 py-0.5 rounded border border-slate-200 dark:border-slate-700">
                <i class="far fa-file-video"></i>
                <span>{{ $course->lessons_count ?? 0 }} লেসন</span>
            </div>
        </div>

        <h3 class="text-base font-bold text-slate-900 dark:text-white mb-2 line-clamp-2 leading-snug group-hover:text-blue-600 dark:group-hover:text-blue-400 transition-colors font-heading">
            <a href="{{ route('courses.show', $course->slug) }}">{{ $course->title }}</a>
        </h3>
        
        <!-- Instructor -->
        <div class="flex items-center gap-2 mb-4">
            <div class="w-6 h-6 rounded-full bg-slate-200 dark:bg-slate-700 overflow-hidden">
                <img src="{{ $course->instructor->avatar_url ?? 'https://ui-avatars.com/api/?name='.urlencode($course->instructor->name ?? 'Instructor') }}" 
                     class="w-full h-full object-cover">
            </div>
            <span class="text-xs text-slate-600 dark:text-slate-400 truncate font-medium">{{ $course->instructor->name ?? 'Unknown' }}</span>
        </div>

        <!-- Footer: Price & Button -->
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