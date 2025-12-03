<div class="bg-white dark:bg-slate-800 rounded-xl shadow-sm hover:shadow-xl transition-all duration-300 border border-gray-100 dark:border-slate-700 overflow-hidden group flex flex-col h-full">
    <!-- Thumbnail -->
    <div class="relative overflow-hidden h-48 bg-gray-100 dark:bg-slate-700">
        <a href="{{ route('courses.show', $course->slug) }}" class="block h-full w-full">
            @if($course->thumbnail)
                <img src="{{ asset('storage/' . $course->thumbnail) }}" alt="{{ $course->title }}" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110">
            @else
                <div class="flex items-center justify-center h-full text-gray-400">
                    <i class="fas fa-image text-4xl"></i>
                </div>
            @endif
        </a>
        
        <!-- Badge (Level) -->
        <div class="absolute top-3 left-3">
            <span class="px-2.5 py-1 text-xs font-bold text-white bg-black/50 backdrop-blur-sm rounded-md uppercase tracking-wider">
                {{ $course->level }}
            </span>
        </div>
        
        <!-- Wishlist Button (Optional) -->
        <button class="absolute top-3 right-3 w-8 h-8 bg-white/90 dark:bg-slate-800/90 rounded-full flex items-center justify-center text-gray-500 hover:text-red-500 transition shadow-sm opacity-0 group-hover:opacity-100 translate-y-2 group-hover:translate-y-0 duration-300">
            <i class="far fa-heart"></i>
        </button>
    </div>

    <!-- Content -->
    <div class="p-5 flex flex-col flex-grow">
        <!-- Category & Rating -->
        <div class="flex justify-between items-center mb-2">
            <span class="text-xs font-medium text-blue-600 dark:text-blue-400 bg-blue-50 dark:bg-blue-900/20 px-2 py-0.5 rounded-full">
                {{ ucfirst($course->category) }}
            </span>
            <div class="flex items-center text-yellow-400 text-xs gap-1">
                <i class="fas fa-star"></i>
                <span class="text-gray-600 dark:text-gray-400 font-medium">{{ number_format($course->rating ?? 0, 1) }}</span>
                <span class="text-gray-400">({{ $course->total_reviews ?? 0 }})</span>
            </div>
        </div>

        <!-- Title -->
        <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-2 line-clamp-2 group-hover:text-blue-600 dark:group-hover:text-blue-400 transition-colors">
            <a href="{{ route('courses.show', $course->slug) }}">
                {{ $course->title }}
            </a>
        </h3>

        <!-- Instructor -->
        <div class="flex items-center gap-2 mb-4 mt-auto pt-2">
            <img src="{{ $course->instructor->avatar_url ?? 'https://ui-avatars.com/api/?name='.urlencode($course->instructor->name ?? 'Instructor') }}" alt="Instructor" class="w-6 h-6 rounded-full object-cover border border-gray-200 dark:border-slate-600">
            <span class="text-sm text-gray-600 dark:text-gray-400 truncate">{{ $course->instructor->name ?? 'Unknown Instructor' }}</span>
        </div>

        <!-- Footer (Price & Enroll) -->
        <div class="border-t border-gray-100 dark:border-slate-700 pt-4 mt-auto flex justify-between items-center">
            <div>
                @if($course->discount_price)
                    <span class="text-lg font-bold text-gray-900 dark:text-white">৳{{ number_format($course->discount_price) }}</span>
                    <span class="text-sm text-gray-400 line-through ml-1">৳{{ number_format($course->price) }}</span>
                @elseif($course->price == 0)
                    <span class="text-lg font-bold text-green-600 dark:text-green-400">ফ্রি</span>
                @else
                    <span class="text-lg font-bold text-gray-900 dark:text-white">৳{{ number_format($course->price) }}</span>
                @endif
            </div>
            
            <a href="{{ route('courses.show', $course->slug) }}" class="text-sm font-medium text-blue-600 dark:text-blue-400 hover:text-blue-800 dark:hover:text-blue-300 flex items-center gap-1 transition">
                বিস্তারিত <i class="fas fa-arrow-right"></i>
            </a>
        </div>
    </div>
</div>