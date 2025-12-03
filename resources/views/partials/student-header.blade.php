@php
    // নোটিফিকেশন ডাটা সরাসরি ভিউতে লোড করা হচ্ছে যাতে সব পেজে কাজ করে
    $unreadCount = \App\Models\Notification::where('user_id', Auth::id())->where('is_read', false)->count();
    $recentNotifications = \App\Models\Notification::where('user_id', Auth::id())->latest()->take(5)->get();
@endphp

<header class="bg-white dark:bg-slate-800 shadow-sm z-30 sticky top-0 transition-colors duration-300">
    <div class="flex items-center justify-between h-16 px-4 md:px-6">
        
        <!-- Mobile Menu Button -->
        <button @click="isMobileMenuOpen = !isMobileMenuOpen" class="md:hidden text-gray-500 dark:text-gray-400 focus:outline-none hover:text-gray-700 dark:hover:text-gray-200 transition">
            <i class="fas fa-bars text-xl"></i>
        </button>
        
        <!-- Search Bar (Previous Design Restored) -->
        <div class="hidden md:flex flex-1 max-w-xl mx-4">
            <div class="relative w-full">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <i class="fas fa-search text-gray-400"></i>
                </div>
                <input type="text" class="block w-full pl-10 pr-3 py-2 border border-gray-300 dark:border-slate-700 rounded-lg bg-white dark:bg-slate-800 text-gray-800 dark:text-gray-200 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-colors placeholder-gray-500 dark:placeholder-gray-400 sm:text-sm" placeholder="কোর্স, লেসন খুঁজুন...">
            </div>
        </div>

        <div class="flex-1 md:hidden"></div>
        
        <!-- Right Actions -->
        <div class="flex items-center space-x-4">
            
            <!-- Dark Mode Toggle -->
            <button @click="isDark = !isDark; localStorage.setItem('darkMode', isDark); document.documentElement.classList.toggle('dark')" 
                    class="p-2 text-gray-500 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-slate-700 rounded-full focus:outline-none transition-colors" 
                    title="থিম পরিবর্তন">
                <i x-show="!isDark" class="fas fa-moon text-xl"></i>
                <i x-show="isDark" class="fas fa-sun text-xl" style="display: none;"></i>
            </button>
            
            <!-- Notifications Dropdown -->
            <div x-data="{ open: false }" class="relative">
                <button @click="open = !open" class="p-2 text-gray-500 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-slate-700 rounded-full focus:outline-none relative transition-colors" title="নোটিফিকেশন">
                    <i class="fas fa-bell text-xl"></i>
                    
                    @if($unreadCount > 0)
                        <span class="absolute top-1 right-1 h-4 w-4 rounded-full bg-red-500 text-white text-[10px] font-bold flex items-center justify-center border-2 border-white dark:border-slate-800 animate-pulse">
                            {{ $unreadCount > 9 ? '9+' : $unreadCount }}
                        </span>
                    @endif
                </button>
                
                <div x-show="open" 
                     @click.away="open = false" 
                     x-transition:enter="transition ease-out duration-200"
                     x-transition:enter-start="opacity-0 transform scale-95"
                     x-transition:enter-end="opacity-100 transform scale-100"
                     x-transition:leave="transition ease-in duration-75"
                     x-transition:leave-start="opacity-100 transform scale-100"
                     x-transition:leave-end="opacity-0 transform scale-95"
                     class="absolute right-0 mt-2 w-80 md:w-96 bg-white dark:bg-slate-800 rounded-lg shadow-xl ring-1 ring-black ring-opacity-5 z-50 border border-gray-200 dark:border-slate-700 overflow-hidden" 
                     style="display: none;">
                    
                    <div class="px-4 py-3 border-b border-gray-200 dark:border-slate-700 flex justify-between items-center bg-gray-50 dark:bg-slate-700/50">
                        <h3 class="font-semibold text-gray-800 dark:text-white text-sm">নোটিফিকেশন</h3>
                        @if($unreadCount > 0)
                        <form action="{{ route('student.notifications.mark-all-read') }}" method="POST" class="m-0">
                            @csrf
                            <button type="submit" class="text-xs text-blue-600 dark:text-blue-400 hover:underline font-medium">সব রিড মার্ক করুন</button>
                        </form>
                        @endif
                    </div>
                    
                    <div class="max-h-80 overflow-y-auto custom-scrollbar">
                        @forelse($recentNotifications as $notification)
                        <a href="{{ route('student.notifications.show', $notification->id) }}" class="block p-4 hover:bg-gray-50 dark:hover:bg-slate-700/50 transition border-b border-gray-100 dark:border-slate-700/50 last:border-0 {{ !$notification->is_read ? 'bg-blue-50/30 dark:bg-blue-900/10' : '' }}">
                            <div class="flex items-start">
                                <div class="flex-shrink-0 mt-1">
                                    @if($notification->type == 'quiz_completed')
                                        <i class="fas fa-clipboard-check text-green-500 bg-green-100 dark:bg-green-900/30 p-2 rounded-full text-xs"></i>
                                    @elseif($notification->type == 'course_enrolled')
                                        <i class="fas fa-graduation-cap text-blue-500 bg-blue-100 dark:bg-blue-900/30 p-2 rounded-full text-xs"></i>
                                    @elseif($notification->type == 'certificate_issued')
                                        <i class="fas fa-award text-purple-500 bg-purple-100 dark:bg-purple-900/30 p-2 rounded-full text-xs"></i>
                                    @else
                                        <i class="fas fa-bell text-gray-500 bg-gray-100 dark:bg-slate-700 p-2 rounded-full text-xs"></i>
                                    @endif
                                </div>
                                <div class="ml-3 w-0 flex-1">
                                    <p class="text-sm font-medium text-gray-900 dark:text-white truncate">{{ $notification->title }}</p>
                                    <p class="text-xs text-gray-600 dark:text-gray-400 mt-0.5 line-clamp-2">{{ $notification->message }}</p>
                                    <p class="text-[10px] text-gray-400 mt-1">{{ $notification->created_at->diffForHumans() }}</p>
                                </div>
                                @if(!$notification->is_read)
                                    <span class="h-2 w-2 bg-blue-600 rounded-full mt-2"></span>
                                @endif
                            </div>
                        </a>
                        @empty
                        <div class="text-center py-8 px-4">
                            <div class="inline-flex items-center justify-center w-12 h-12 rounded-full bg-gray-100 dark:bg-slate-700 mb-3">
                                <i class="far fa-bell-slash text-gray-400 text-xl"></i>
                            </div>
                            <p class="text-sm text-gray-500 dark:text-gray-400">কোনো নতুন নোটিফিকেশন নেই</p>
                        </div>
                        @endforelse
                    </div>
                    
                    <a href="{{ route('student.notifications.index') }}" class="block bg-gray-50 dark:bg-slate-700/50 px-4 py-3 text-center text-xs font-medium text-blue-600 dark:text-blue-400 hover:text-blue-800 dark:hover:text-blue-300 border-t border-gray-200 dark:border-slate-700 transition">
                        সব নোটিফিকেশন দেখুন <i class="fas fa-arrow-right ml-1"></i>
                    </a>
                </div>
            </div>
            
            <!-- Profile Dropdown -->
            <div x-data="{ open: false }" class="relative">
                <button @click="open = !open" class="flex items-center space-x-2 focus:outline-none group">
                    <img src="{{ Auth::user()->avatar_url }}" 
                         alt="{{ Auth::user()->name }}" 
                         class="h-9 w-9 rounded-full object-cover border-2 border-gray-200 dark:border-slate-600 group-hover:border-blue-500 transition">
                    <div class="hidden md:block text-left">
                        <p class="text-sm font-medium text-gray-700 dark:text-gray-200 group-hover:text-blue-600 dark:group-hover:text-blue-400 transition">{{ Str::words(Auth::user()->name, 2, '') }}</p>
                        <p class="text-[10px] text-gray-500 dark:text-gray-400">Student</p>
                    </div>
                    <i class="fas fa-chevron-down text-xs text-gray-400 ml-1 transition-transform duration-200" :class="{'rotate-180': open}"></i>
                </button>
                
                <div x-show="open" 
                     @click.away="open = false" 
                     x-transition:enter="transition ease-out duration-200"
                     x-transition:enter-start="opacity-0 transform scale-95"
                     x-transition:enter-end="opacity-100 transform scale-100"
                     x-transition:leave="transition ease-in duration-75"
                     x-transition:leave-start="opacity-100 transform scale-100"
                     x-transition:leave-end="opacity-0 transform scale-95"
                     class="absolute right-0 mt-2 w-56 bg-white dark:bg-slate-800 rounded-lg shadow-xl border border-gray-200 dark:border-slate-700 py-1 z-50" 
                     style="display: none;">
                    
                    <div class="px-4 py-3 border-b border-gray-200 dark:border-slate-700 md:hidden">
                        <p class="text-sm font-medium text-gray-900 dark:text-white truncate">{{ Auth::user()->name }}</p>
                        <p class="text-xs text-gray-500 dark:text-gray-400 truncate">{{ Auth::user()->email }}</p>
                    </div>

                    <div class="py-1">
                        <a href="{{ route('student.profile.index') }}" class="block px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-slate-700 transition flex items-center">
                            <i class="fas fa-user-circle w-5 text-gray-400 mr-2"></i> প্রোফাইল
                        </a>
                        <a href="{{ route('student.progress.index') }}" class="block px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-slate-700 transition flex items-center">
                            <i class="fas fa-chart-line w-5 text-gray-400 mr-2"></i> অগ্রগতি
                        </a>
                        <a href="{{ route('student.certificates.index') }}" class="block px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-slate-700 transition flex items-center">
                            <i class="fas fa-certificate w-5 text-gray-400 mr-2"></i> সার্টিফিকেট
                        </a>
                    </div>
                    
                    <div class="border-t border-gray-200 dark:border-slate-700 py-1">
                        <form action="{{ route('logout') }}" method="POST" class="m-0">
                            @csrf
                            <button type="submit" class="w-full text-left px-4 py-2 text-sm text-red-600 dark:text-red-400 hover:bg-red-50 dark:hover:bg-red-900/20 transition flex items-center">
                                <i class="fas fa-sign-out-alt w-5 mr-2"></i> লগ আউট
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>