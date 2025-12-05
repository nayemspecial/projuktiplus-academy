<header class="bg-white dark:bg-slate-800 shadow-sm z-30 sticky top-0 transition-colors duration-300">
    <div class="flex items-center justify-between h-16 px-4 md:px-6">
        
        <!-- Mobile Menu Button -->
        <button @click="isMobileMenuOpen = !isMobileMenuOpen" class="xl:hidden text-gray-500 dark:text-gray-400 focus:outline-none hover:text-gray-700 dark:hover:text-white transition">
            <i class="fas fa-bars text-xl"></i>
        </button>
        
        <!-- Search Bar -->
        <div class="flex-1 max-w-xl mx-4 hidden md:block">
            <div class="relative">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <i class="fas fa-search text-gray-400"></i>
                </div>
                <input type="text" class="block w-full pl-10 pr-3 py-2 border border-gray-300 dark:border-slate-700 rounded-lg bg-white dark:bg-slate-800 text-gray-800 dark:text-gray-200 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-colors" placeholder="কোর্স, ছাত্র, ইত্যাদি খুঁজুন...">
            </div>
        </div>
        
        <div class="flex items-center space-x-4">
            
            <!-- Theme Toggle -->
            <button @click="isDark = !isDark" class="p-2 text-gray-500 dark:text-gray-400 focus:outline-none hover:bg-gray-100 dark:hover:bg-slate-700 rounded-full transition" title="থিম পরিবর্তন">
                <i x-show="!isDark" class="fas fa-moon text-xl"></i>
                <i x-show="isDark" class="fas fa-sun text-xl text-yellow-400" style="display: none;"></i>
            </button>
            
            <!-- Notifications -->
            <div x-data="{ open: false }" class="relative">
                <button @click="open = !open" class="p-2 text-gray-500 dark:text-gray-400 focus:outline-none relative hover:bg-gray-100 dark:hover:bg-slate-700 rounded-full transition" title="নোটিফিকেশন">
                    <i class="fas fa-bell text-xl"></i>
                    @if(isset($unreadNotificationsCount) && $unreadNotificationsCount > 0)
                        <span class="absolute -top-1 -right-1 h-4 w-4 rounded-full bg-red-500 text-white text-xs font-bold flex items-center justify-center border-2 border-white dark:border-slate-800">
                            {{ $unreadNotificationsCount > 9 ? '9+' : $unreadNotificationsCount }}
                        </span>
                    @endif
                </button>
                
                <div x-show="open" @click.away="open = false" 
                     x-transition
                     class="absolute right-0 mt-2 w-80 md:w-96 bg-white dark:bg-slate-800 rounded-lg shadow-lg overflow-hidden z-50 border border-gray-200 dark:border-slate-700" 
                     style="display: none;">
                    
                    <div class="px-4 py-3 border-b border-gray-200 dark:border-slate-700 flex justify-between items-center">
                        <h3 class="font-semibold text-gray-800 dark:text-white">নোটিফিকেশন</h3>
                    </div>
                    
                    <div class="divide-y divide-gray-200 dark:divide-slate-700 max-h-80 overflow-y-auto custom-scrollbar">
                        @if(isset($recentNotifications) && $recentNotifications->count() > 0)
                            @foreach($recentNotifications as $notification)
                            <a href="#" class="block p-4 hover:bg-gray-50 dark:hover:bg-slate-700/50 transition">
                                <div class="flex items-start">
                                    <div class="ml-3">
                                        <p class="text-sm font-medium text-gray-900 dark:text-white">{{ $notification->title }}</p>
                                        <p class="text-xs text-gray-600 dark:text-gray-300 mt-0.5">{{ Str::limit($notification->message, 80) }}</p>
                                        <p class="text-[10px] text-gray-400 mt-1">{{ $notification->created_at->diffForHumans() }}</p>
                                    </div>
                                </div>
                            </a>
                            @endforeach
                        @else
                            <div class="text-center p-8 text-gray-500">কোনো নতুন নোটিফিকেশন নেই</div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Profile Dropdown -->
            <div x-data="{ open: false }" class="relative">
                <button @click="open = !open" class="flex items-center space-x-2 focus:outline-none">
                    <img src="{{ Auth::user()->avatar_url }}" alt="{{ Auth::user()->name }}" class="h-9 w-9 rounded-full object-cover border-2 border-gray-200 dark:border-slate-600">
                    <span class="hidden md:block text-sm font-medium text-gray-700 dark:text-gray-300">{{ Auth::user()->name }}</span>
                    <i class="fas fa-chevron-down text-xs text-gray-400 hidden md:block transition-transform" :class="{'rotate-180': open}"></i>
                </button>
                
                <div x-show="open" @click.away="open = false" 
                     x-transition
                     class="absolute right-0 mt-2 w-48 bg-white dark:bg-slate-800 rounded-lg shadow-xl border border-gray-200 dark:border-slate-700 py-1 z-50" 
                     style="display: none;">
                    <div class="px-4 py-2 border-b border-gray-200 dark:border-slate-700 md:hidden">
                        <p class="text-sm font-bold text-gray-800 dark:text-white">{{ Auth::user()->name }}</p>
                    </div>
                    <a href="{{ route('instructor.settings.index') }}" class="block px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-slate-700">প্রোফাইল</a>
                    <a href="#" onclick="document.getElementById('logout-form').submit()" class="block px-4 py-2 text-sm text-red-600 hover:bg-red-50 dark:hover:bg-slate-700 border-t border-gray-100 dark:border-slate-700">লগ আউট</a>
                </div>
            </div>
        </div>
    </div>
</header>