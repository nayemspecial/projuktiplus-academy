<header class="bg-white dark:bg-slate-800 shadow-sm z-30 sticky top-0">
    <div class="flex items-center justify-between h-16 px-4 md:px-6">
        
        <button @click="isMobileMenuOpen = !isMobileMenuOpen" class="md:hidden text-gray-500 dark:text-gray-400 focus:outline-none">
            <i class="fas fa-bars text-xl"></i>
        </button>
        
        <div class="hidden md:flex flex-1 max-w-xl mx-4">
            <div class="relative w-full">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <i class="fas fa-search text-gray-400"></i>
                </div>
                <input type="text" class="block w-full pl-10 pr-3 py-2 border border-gray-300 dark:border-slate-700 rounded-lg bg-white dark:bg-slate-800 text-gray-800 dark:text-gray-200 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent" placeholder="কোর্স, লেসন খুঁজুন...">
            </div>
        </div>

        <div class="flex-1 md:hidden"></div>
        
        <div class="flex items-center space-x-4">
            
            <button @click="isDark = !isDark" class="text-gray-500 dark:text-gray-400 focus:outline-none" title="থিম পরিবর্তন">
                <i x-show="!isDark" class="fas fa-moon text-xl"></i>
                <i x-show="isDark" class="fas fa-sun text-xl" style="display: none;"></i>
            </button>
            
            <div x-data="{ open: false }" class="relative">
                <button @click="open = !open" class="text-gray-500 dark:text-gray-400 focus:outline-none relative" title="নোটিফিকেশন">
                    <i class="fas fa-bell text-xl"></i>
                    
                    @if($unreadNotificationsCount > 0)
                        <span class="absolute -top-1 -right-1 h-4 w-4 rounded-full bg-red-500 text-white text-xs font-bold flex items-center justify-center border-2 border-white dark:border-slate-800">
                            {{ $unreadNotificationsCount > 9 ? '9+' : $unreadNotificationsCount }}
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
                     class="absolute right-0 mt-2 w-80 md:w-96 bg-white dark:bg-slate-800 rounded-lg shadow-lg overflow-hidden z-50 border border-gray-200 dark:border-slate-700" 
                     style="display: none;">
                    
                    <div class="px-4 py-3 border-b border-gray-200 dark:border-slate-700 flex justify-between items-center">
                        <h3 class="font-semibold text-gray-800 dark:text-white">নোটিফিকেশন</h3>
                        @if($unreadNotificationsCount > 0)
                        <form action="{{ route('student.notifications.mark-all-read') }}" method="POST" class="m-0">
                            @csrf
                            <button type="submit" class="text-xs text-blue-600 dark:text-blue-400 hover:underline">নতুন নোটিফিকেশন দেখুন</button>
                        </form>
                        @endif
                    </div>
                    
                    @if($recentNotifications->count() > 0)
                        <div class="divide-y divide-gray-200 dark:divide-slate-700 max-h-96 overflow-y-auto">
                            @foreach($recentNotifications as $notification)
                            <a href="{{ route('student.notifications.show', $notification->id) }}" class="block p-4 hover:bg-gray-50 dark:hover:bg-slate-700/50 transition">
                                <div class="flex items-start">
                                    <div class="flex-shrink-0 mt-1">
                                        @php $icon = 'fas fa-bell'; @endphp
                                        @if($notification->type == 'quiz_completed')
                                            @php $icon = 'fas fa-clipboard-check'; @endphp
                                        @elseif($notification->type == 'course_enrolled')
                                            @php $icon = 'fas fa-graduation-cap'; @endphp
                                        @elseif($notification->type == 'certificate_issued')
                                            @php $icon = 'fas fa-award'; @endphp
                                        @endif
                                        <i class="{{ $icon }} text-blue-500"></i>
                                    </div>
                                    <div class="ml-3">
                                        <p class="text-sm font-medium text-gray-900 dark:text-white" x-text="'{{ $notification->title }}'"></p>
                                        <p class="text-xs text-gray-600 dark:text-gray-300" x-text="'{{ Str::limit($notification->message, 100) }}'"></p>
                                        <p class="text-xs text-gray-500 dark:text-gray-400 mt-1" x-text="'{{ $notification->created_at->diffForHumans() }}'"></p>
                                    </div>
                                </div>
                            </a>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center p-8">
                            <i class="fas fa-check-circle text-4xl text-green-500 mb-4"></i>
                            <p class="text-sm text-gray-600 dark:text-gray-400">আপনার সব নোটিফিকেশন পড়া শেষ।</p>
                        </div>
                    @endif
                    
                    <a href="{{ route('student.notifications.index') }}" class="block bg-gray-50 dark:bg-slate-700/50 px-4 py-3 text-center text-sm font-medium text-blue-600 dark:text-blue-400 hover:underline">
                        সব নোটিফিকেশন দেখুন
                    </a>
                </div>
            </div>
            
            <div x-data="{ open: false }" class="relative">
                <button @click="open = !open" class="flex items-center space-x-2 focus:outline-none">
                    <img src="{{ Auth::user()->avatar ? asset('storage/' . Auth::user()->avatar) : 'https://ui-avatars.com/api/?name=' . urlencode(Auth::user()->name) . '&background=random&color=fff' }}" alt="User" class="h-8 w-8 rounded-full">
                    <span class="hidden md:block text-sm font-medium text-gray-800 dark:text-white">{{ Str::words(Auth::user()->name, 1, '') }}</span>
                </button>
                <div x-show="open" 
                     @click.away="open = false" 
                     x-transition
                     class="absolute right-0 mt-2 w-48 bg-white dark:bg-slate-800 rounded-lg shadow-lg py-1 z-50 border border-gray-200 dark:border-slate-700" 
                     style="display: none;">
                    
                    <div class="px-4 py-3 border-b border-gray-200 dark:border-slate-700">
                        <p class="text-sm font-medium text-gray-900 dark:text-white truncate">{{ Auth::user()->name }}</p>
                        <p class="text-xs text-gray-500 dark:text-gray-400 truncate">{{ Auth::user()->email }}</p>
                    </div>

                    <a href="{{ route('student.profile.index') }}" class="block px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-slate-700 transition">প্রোফাইল</a>
                    <a href="{{ route('student.progress.index') }}" class="block px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-slate-700 transition">অগ্রগতি</a>
                    <a href="{{ route('student.certificates.index') }}" class="block px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-slate-700 transition">সার্টিফিকেট</a>
                    
                    <form action="{{ route('logout') }}" method="POST" class="m-0 border-t border-gray-200 dark:border-slate-700">
                        @csrf
                        <button type="submit" class="w-full text-left px-4 py-2 text-sm text-red-600 dark:text-red-400 hover:bg-red-50 dark:hover:bg-red-900/20 transition">
                            লগ আউট
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</header>