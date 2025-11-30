<header class="bg-white dark:bg-slate-800 shadow-sm z-40">
    <div class="flex items-center justify-between h-16 px-4">
        <!-- Mobile menu button -->
        <button @click="isMobileMenuOpen = !isMobileMenuOpen" class="xl:hidden text-gray-500 dark:text-gray-400 focus:outline-none">
            <i class="fas fa-bars text-xl"></i>
        </button>
        
        <!-- Search bar -->
        <div class="flex-1 max-w-xl mx-4">
            <div class="relative">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <i class="fas fa-search text-gray-400"></i>
                </div>
                <input type="text" class="block w-full pl-10 pr-3 py-2 border border-gray-300 dark:border-slate-700 rounded-lg bg-white dark:bg-slate-800 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent" placeholder="খুঁজুন...">
            </div>
        </div>
        
        <!-- Right side icons -->
        <div class="flex items-center space-x-4">
            <!-- Dark mode toggle -->
            <button @click="isDark = !isDark" class="text-gray-500 dark:text-gray-400 focus:outline-none">
                <i x-show="!isDark" class="fas fa-moon text-xl"></i>
                <i x-show="isDark" class="fas fa-sun text-xl" style="display: none;"></i>
            </button>
            
            <!-- Notifications -->
            <div x-data="{ open: false }" class="relative">
                <button @click="open = !open" class="text-gray-500 dark:text-gray-400 focus:outline-none relative">
                    <i class="fas fa-bell text-xl"></i>
                    <span class="absolute top-0 right-0 h-2 w-2 rounded-full bg-red-500"></span>
                </button>
                <div x-show="open" @click.away="open = false" class="absolute right-0 mt-2 w-80 bg-white dark:bg-slate-800 rounded-lg shadow-lg overflow-hidden z-50" style="display: none;">
                    <div class="px-4 py-3 border-b border-gray-200 dark:border-slate-700 flex justify-between items-center">
                        <h3 class="font-medium">নোটিফিকেশন</h3>
                        <span class="text-xs text-blue-600 dark:text-blue-400">সব দেখুন</span>
                    </div>
                    <div class="divide-y divide-gray-200 dark:divide-slate-700 max-h-96 overflow-y-auto">
                        <template x-for="notification in notifications" :key="notification.id">
                            <a href="#" class="block px-4 py-3 hover:bg-gray-50 dark:hover:bg-slate-700">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0">
                                        <img class="h-10 w-10 rounded-full" :src="notification.image" alt="">
                                    </div>
                                    <div class="ml-3">
                                        <p class="text-sm font-medium" x-text="notification.title"></p>
                                        <p class="text-xs text-gray-500 dark:text-gray-400" x-text="notification.message"></p>
                                        <p class="text-xs text-gray-400 dark:text-gray-500 mt-1" x-text="notification.time"></p>
                                    </div>
                                </div>
                            </a>
                        </template>
                    </div>
                </div>
            </div>
            
            <!-- User dropdown -->
            <div x-data="{ open: false }" class="relative">
                <button @click="open = !open" class="flex items-center space-x-2 focus:outline-none">
                    <img src="https://cdn.ostad.app/public/upload/2023-08-06T10-43-26.987Z-2023-02-18T16-19-36.508Z-331049670_5912973425465146_8220712743907257929_n.jpg" alt="User" class="h-8 w-8 rounded-full">
                    <span class="hidden md:block text-sm font-medium">Admin</span>
                </button>
                <div x-show="open" @click.away="open = false" class="absolute right-0 mt-2 w-48 bg-white dark:bg-slate-800 rounded-lg shadow-lg py-1 z-50" style="display: none;">
                    <a href="#" class="block px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-slate-700">প্রোফাইল</a>
                    <a href="#" class="block px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-slate-700">সেটিংস</a>
                    <a href="#" class="block px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-slate-700" @click="logout">লগ আউট</a>
                </div>
            </div>
        </div>
    </div>
</header>