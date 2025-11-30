<div x-show="isMobileMenuOpen" class="fixed inset-0 z-50 lg:hidden" style="display: none;">
    <!-- Overlay -->
    <div x-show="isMobileMenuOpen" 
         x-transition:enter="transition-opacity ease-linear duration-300"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition-opacity ease-linear duration-300"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"
         class="fixed inset-0 bg-gray-900/80 backdrop-blur-sm"
         @click="isMobileMenuOpen = false">
    </div>

    <!-- Sidebar Panel -->
    <div x-show="isMobileMenuOpen"
         x-transition:enter="transition ease-in-out duration-300 transform"
         x-transition:enter-start="-translate-x-full"
         x-transition:enter-end="translate-x-0"
         x-transition:leave="transition ease-in-out duration-300 transform"
         x-transition:leave-start="translate-x-0"
         x-transition:leave-end="-translate-x-full"
         class="relative w-72 h-full max-w-xs bg-white dark:bg-slate-800 shadow-xl flex flex-col">
         
         <!-- Close Button -->
         <div class="absolute top-0 right-0 -mr-12 pt-2">
            <button @click="isMobileMenuOpen = false" class="ml-1 flex items-center justify-center h-10 w-10 rounded-full focus:outline-none focus:ring-2 focus:ring-inset focus:ring-white">
                <i class="fas fa-times text-white text-xl"></i>
            </button>
         </div>

         <!-- Logo -->
         <div class="flex items-center justify-center h-16 px-6 border-b border-gray-200 dark:border-slate-700 shrink-0">
            <span class="text-xl font-bold text-blue-600 dark:text-blue-400 flex items-center gap-2">
                <i class="fas fa-shield-alt"></i> অ্যাডমিন প্যানেল
            </span>
        </div>

         <!-- Mobile Menu Content -->
         <nav class="flex-1 overflow-y-auto py-4 px-3 space-y-1 custom-scrollbar">
            
            <!-- Dashboard -->
            <a href="{{ route('admin.dashboard') }}" class="flex items-center px-4 py-3 text-sm font-medium rounded-lg transition-colors {{ request()->routeIs('admin.dashboard') ? 'bg-blue-50 text-blue-600 dark:bg-blue-900/20 dark:text-blue-400' : 'text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-slate-700' }}">
                <i class="fas fa-tachometer-alt w-5 text-center"></i>
                <span class="ml-3">ড্যাশবোর্ড</span>
            </a>

            <!-- User Management -->
            <div x-data="{ open: {{ request()->routeIs('admin.users.*') ? 'true' : 'false' }} }">
                <button @click="open = !open" class="flex items-center justify-between w-full px-4 py-3 text-sm font-medium rounded-lg transition-colors hover:bg-gray-100 dark:hover:bg-slate-700 {{ request()->routeIs('admin.users.*') ? 'text-blue-600 dark:text-blue-400' : 'text-gray-700 dark:text-gray-300' }}">
                    <div class="flex items-center">
                        <i class="fas fa-users w-5 text-center"></i>
                        <span class="ml-3">ব্যবহারকারী</span>
                    </div>
                    <i class="fas fa-chevron-down text-xs transition-transform duration-200" :class="{'rotate-180': open}"></i>
                </button>
                <div x-show="open" x-collapse class="pl-11 space-y-1 mt-1">
                    <a href="{{ route('admin.users.index') }}" class="block px-4 py-2 text-sm rounded-lg {{ request()->routeIs('admin.users.index') ? 'text-blue-600 dark:text-blue-400 bg-blue-50 dark:bg-slate-700/50' : 'text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-200' }}">সকল ব্যবহারকারী</a>
                    <a href="{{ route('admin.users.students') }}" class="block px-4 py-2 text-sm rounded-lg {{ request()->routeIs('admin.users.students') ? 'text-blue-600 dark:text-blue-400 bg-blue-50 dark:bg-slate-700/50' : 'text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-200' }}">শিক্ষার্থী</a>
                    <a href="{{ route('admin.users.instructors') }}" class="block px-4 py-2 text-sm rounded-lg {{ request()->routeIs('admin.users.instructors') ? 'text-blue-600 dark:text-blue-400 bg-blue-50 dark:bg-slate-700/50' : 'text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-200' }}">ইন্সট্রাক্টর</a>
                </div>
            </div>

            <!-- Course Management -->
            <a href="{{ route('admin.courses.index') }}" class="flex items-center px-4 py-3 text-sm font-medium rounded-lg transition-colors {{ request()->routeIs('admin.courses.*') ? 'bg-blue-50 text-blue-600 dark:bg-blue-900/20 dark:text-blue-400' : 'text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-slate-700' }}">
                <i class="fas fa-book w-5 text-center"></i>
                <span class="ml-3">কোর্স ম্যানেজমেন্ট</span>
            </a>

            <!-- Quizzes -->
            <a href="{{ route('admin.quizzes.index') }}" class="flex items-center px-4 py-3 text-sm font-medium rounded-lg transition-colors {{ request()->routeIs('admin.quizzes.*') ? 'bg-blue-50 text-blue-600 dark:bg-blue-900/20 dark:text-blue-400' : 'text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-slate-700' }}">
                <i class="fas fa-clipboard-question w-5 text-center"></i>
                <span class="ml-3">কুইজ তালিকা</span>
            </a>

            <!-- Enrollments -->
            <a href="{{ route('admin.enrollments.index') }}" class="flex items-center px-4 py-3 text-sm font-medium rounded-lg transition-colors {{ request()->routeIs('admin.enrollments.*') ? 'bg-blue-50 text-blue-600 dark:bg-blue-900/20 dark:text-blue-400' : 'text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-slate-700' }}">
                <i class="fas fa-id-card w-5 text-center"></i>
                <span class="ml-3">এনরোলমেন্ট</span>
            </a>

            <!-- Payments -->
            <a href="{{ route('admin.payments.index') }}" class="flex items-center px-4 py-3 text-sm font-medium rounded-lg transition-colors {{ request()->routeIs('admin.payments.*') ? 'bg-blue-50 text-blue-600 dark:bg-blue-900/20 dark:text-blue-400' : 'text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-slate-700' }}">
                <i class="fas fa-money-bill-wave w-5 text-center"></i>
                <span class="ml-3">পেমেন্ট</span>
            </a>

            <!-- Certificates -->
            <a href="{{ route('admin.certificates.index') }}" class="flex items-center px-4 py-3 text-sm font-medium rounded-lg transition-colors {{ request()->routeIs('admin.certificates.*') ? 'bg-blue-50 text-blue-600 dark:bg-blue-900/20 dark:text-blue-400' : 'text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-slate-700' }}">
                <i class="fas fa-certificate w-5 text-center"></i>
                <span class="ml-3">সার্টিফিকেট</span>
            </a>
            
            <!-- Analytics -->
            <a href="{{ route('admin.analytics') }}" class="flex items-center px-4 py-3 text-sm font-medium rounded-lg transition-colors {{ request()->routeIs('admin.analytics') ? 'bg-blue-50 text-blue-600 dark:bg-blue-900/20 dark:text-blue-400' : 'text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-slate-700' }}">
                <i class="fas fa-chart-line w-5 text-center"></i>
                <span class="ml-3">অ্যানালিটিক্স</span>
            </a>

            <!-- Settings -->
            <a href="{{ route('admin.settings.general') }}" class="flex items-center px-4 py-3 text-sm font-medium rounded-lg transition-colors {{ request()->is('admin/settings*') ? 'bg-blue-50 text-blue-600 dark:bg-blue-900/20 dark:text-blue-400' : 'text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-slate-700' }}">
                <i class="fas fa-cog w-5 text-center"></i>
                <span class="ml-3">সেটিংস</span>
            </a>

        </nav>
    </div>
</div>