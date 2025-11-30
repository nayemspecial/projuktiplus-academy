<header class="flex items-center justify-between h-16 px-6 bg-white dark:bg-slate-800 border-b border-gray-200 dark:border-slate-700">
    
    <!-- Left: Mobile Menu & Search -->
    <div class="flex items-center">
        <button @click="isMobileMenuOpen = !isMobileMenuOpen" class="p-1 mr-4 text-gray-500 rounded-md lg:hidden focus:outline-none hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-200">
            <i class="fas fa-bars text-xl"></i>
        </button>
        
        <!-- Search Bar (Optional) -->
        <div class="relative hidden md:block">
            <span class="absolute inset-y-0 left-0 flex items-center pl-3">
                <i class="fas fa-search text-gray-400"></i>
            </span>
            <input type="text" class="w-full py-2 pl-10 pr-4 text-sm text-gray-700 bg-gray-100 border-none rounded-md dark:bg-slate-700 dark:text-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="অনুসন্ধান করুন...">
        </div>
    </div>

    <!-- Right: Notifications & Profile -->
    <div class="flex items-center gap-4">
        
        <!-- Dark Mode Toggle -->
        <button @click="isDark = !isDark" class="p-2 text-gray-500 rounded-full hover:bg-gray-100 dark:hover:bg-slate-700 focus:outline-none transition-colors">
            <i class="fas" :class="isDark ? 'fa-sun text-yellow-400' : 'fa-moon text-gray-600'"></i>
        </button>

        <!-- Notifications Dropdown -->
        <div x-data="{ open: false }" class="relative">
            <button @click="open = !open" class="relative p-2 text-gray-500 rounded-full hover:bg-gray-100 dark:hover:bg-slate-700 focus:outline-none transition-colors">
                <i class="fas fa-bell text-lg"></i>
                
                <!-- Unread Indicator -->
                @php
                    $unreadCount = \App\Models\Notification::where('user_id', Auth::id())->where('is_read', false)->count();
                @endphp
                
                @if($unreadCount > 0)
                    <span class="absolute top-1 right-1 flex h-3 w-3">
                        <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-red-400 opacity-75"></span>
                        <span class="relative inline-flex rounded-full h-3 w-3 bg-red-500"></span>
                    </span>
                @endif
            </button>

            <!-- Dropdown Menu -->
            <div x-show="open" @click.away="open = false" 
                 x-transition:enter="transition ease-out duration-200"
                 x-transition:enter-start="opacity-0 scale-95"
                 x-transition:enter-end="opacity-100 scale-100"
                 x-transition:leave="transition ease-in duration-75"
                 x-transition:leave-start="opacity-100 scale-100"
                 x-transition:leave-end="opacity-0 scale-95"
                 class="absolute right-0 mt-2 w-80 bg-white dark:bg-slate-800 rounded-lg shadow-xl border border-gray-200 dark:border-slate-700 z-50 overflow-hidden"
                 style="display: none;">
                
                <div class="px-4 py-3 border-b border-gray-200 dark:border-slate-700 flex justify-between items-center bg-gray-50 dark:bg-slate-700/50">
                    <h3 class="text-sm font-semibold text-gray-800 dark:text-white">নোটিফিকেশন ({{ $unreadCount }})</h3>
                    @if($unreadCount > 0)
                        <form action="{{ route('admin.notifications.mark-all-read') }}" method="POST">
                            @csrf
                            <button type="submit" class="text-xs text-blue-600 dark:text-blue-400 hover:underline">সব মার্ক করুন</button>
                        </form>
                    @endif
                </div>

                <div class="max-h-80 overflow-y-auto custom-scrollbar">
                    @php
                        $latestNotifications = \App\Models\Notification::where('user_id', Auth::id())->latest()->take(5)->get();
                    @endphp

                    @forelse($latestNotifications as $notification)
                        <a href="{{ route('admin.notifications.show', $notification->id) }}" class="block px-4 py-3 hover:bg-gray-50 dark:hover:bg-slate-700 transition-colors border-b border-gray-100 dark:border-slate-700/50 {{ !$notification->is_read ? 'bg-blue-50/50 dark:bg-blue-900/10' : '' }}">
                            <div class="flex items-start">
                                <div class="flex-shrink-0 pt-0.5">
                                    @if($notification->type == 'order')
                                        <i class="fas fa-shopping-cart text-green-500"></i>
                                    @elseif($notification->type == 'user')
                                        <i class="fas fa-user-plus text-blue-500"></i>
                                    @else
                                        <i class="fas fa-info-circle text-gray-500"></i>
                                    @endif
                                </div>
                                <div class="ml-3 w-0 flex-1">
                                    <p class="text-sm font-medium text-gray-900 dark:text-white truncate">{{ $notification->title }}</p>
                                    <p class="text-xs text-gray-500 dark:text-gray-400 mt-0.5 line-clamp-2">{{ $notification->message }}</p>
                                    <p class="text-[10px] text-gray-400 mt-1">{{ $notification->created_at->diffForHumans() }}</p>
                                </div>
                                @if(!$notification->is_read)
                                    <div class="ml-2 flex-shrink-0 flex">
                                        <span class="inline-block h-2 w-2 rounded-full bg-blue-600"></span>
                                    </div>
                                @endif
                            </div>
                        </a>
                    @empty
                        <div class="px-4 py-6 text-center text-sm text-gray-500 dark:text-gray-400">
                            কোনো নতুন নোটিফিকেশন নেই
                        </div>
                    @endforelse
                </div>

                <div class="block bg-gray-50 dark:bg-slate-700/50 text-center px-4 py-2 border-t border-gray-200 dark:border-slate-700">
                    <a href="{{ route('admin.notifications.index') }}" class="text-xs font-medium text-blue-600 dark:text-blue-400 hover:underline">
                        সব নোটিফিকেশন দেখুন
                    </a>
                </div>
            </div>
        </div>

        <!-- Profile Dropdown -->
        <div x-data="{ open: false }" class="relative">
            <button @click="open = !open" class="flex items-center gap-2 focus:outline-none">
                <img src="{{ Auth::user()->avatar_url ?? 'https://ui-avatars.com/api/?name='.urlencode(Auth::user()->name) }}" alt="User" class="h-9 w-9 rounded-full object-cover border-2 border-gray-200 dark:border-slate-600">
                <div class="hidden md:block text-left">
                    <p class="text-sm font-medium text-gray-700 dark:text-gray-200">{{ Auth::user()->name }}</p>
                    <p class="text-xs text-gray-500 dark:text-gray-400 capitalize">{{ Auth::user()->role }}</p>
                </div>
                <i class="fas fa-chevron-down text-xs text-gray-400 hidden md:block ml-1"></i>
            </button>

            <!-- Dropdown Menu -->
            <div x-show="open" @click.away="open = false" 
                 x-transition:enter="transition ease-out duration-200"
                 x-transition:enter-start="opacity-0 scale-95"
                 x-transition:enter-end="opacity-100 scale-100"
                 x-transition:leave="transition ease-in duration-75"
                 x-transition:leave-start="opacity-100 scale-100"
                 x-transition:leave-end="opacity-0 scale-95"
                 class="absolute right-0 mt-2 w-48 bg-white dark:bg-slate-800 rounded-lg shadow-lg border border-gray-200 dark:border-slate-700 py-1 z-50"
                 style="display: none;">
                
                <a href="{{ route('admin.profile.index') }}" class="block px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-slate-700 transition-colors">
                    <i class="fas fa-user-circle mr-2 w-4 text-center"></i> প্রোফাইল
                </a>
                <a href="{{ route('admin.settings.general') }}" class="block px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-slate-700 transition-colors">
                    <i class="fas fa-cog mr-2 w-4 text-center"></i> সেটিংস
                </a>
                <div class="border-t border-gray-200 dark:border-slate-700 my-1"></div>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="w-full text-left px-4 py-2 text-sm text-red-600 dark:text-red-400 hover:bg-red-50 dark:hover:bg-red-900/20 transition-colors">
                        <i class="fas fa-sign-out-alt mr-2 w-4 text-center"></i> লগ আউট
                    </button>
                </form>
            </div>
        </div>

    </div>
</header>