<div x-show="isMobileMenuOpen" 
     @click.away="isMobileMenuOpen = false" 
     class="xl:hidden fixed inset-0 z-50" 
     x-transition:enter="transition ease-out duration-300"
     x-transition:enter-start="opacity-0"
     x-transition:enter-end="opacity-100"
     x-transition:leave="transition ease-in duration-300"
     x-transition:leave-start="opacity-100"
     x-transition:leave-end="opacity-0"
     style="display: none;">
     
    <div class="fixed inset-0 bg-gray-600 bg-opacity-75" @click="isMobileMenuOpen = false"></div>
    
    <div class="relative flex flex-col w-72 max-w-xs h-full bg-white dark:bg-slate-800"
         x-transition:enter="transition ease-in-out duration-300"
         x-transition:enter-start="-translate-x-full"
         x-transition:enter-end="translate-x-0"
         x-transition:leave="transition ease-in-out duration-300"
         x-transition:leave-start="translate-x-0"
         x-transition:leave-end="-translate-x-full">
         
        <div class="flex items-center justify-between h-16 px-4 border-b border-gray-200 dark:border-slate-700">
            <img src="https://cdn.ostad.app/public/upload/2023-06-12T06-26-02.391Z-projuktiplus-logo.svg" alt="Logo" class="h-10">
            <button @click="isMobileMenuOpen = false" class="text-gray-500 dark:text-gray-400 focus:outline-none">
                <i class="fas fa-times text-xl"></i>
            </button>
        </div>
        
        <div class="flex-1 overflow-y-auto py-4 px-2">
            <div class="space-y-1">
                <a href="{{ route('instructor.dashboard') }}" @click="isMobileMenuOpen = false" class="sidebar-link flex items-center px-4 py-3 text-sm font-medium rounded-lg mx-2 group {{ request()->routeIs('instructor.dashboard') ? 'active' : '' }}">
                    <i class="fas fa-tachometer-alt text-lg w-6 text-center"></i>
                    <span class="ml-3">ড্যাশবোর্ড</span>
                </a>
                
                <a href="{{ route('instructor.courses.index') }}" @click="isMobileMenuOpen = false" class="sidebar-link flex items-center px-4 py-3 text-sm font-medium rounded-lg mx-2 group {{ request()->routeIs('instructor.courses.*') ? 'active' : '' }}">
                    <i class="fas fa-book text-lg w-6 text-center"></i>
                    <span class="ml-3">আমার কোর্সসমূহ</span>
                </a>
                
                <a href="{{ route('instructor.courses.create') }}" @click="isMobileMenuOpen = false" class="sidebar-link flex items-center px-4 py-3 text-sm font-medium rounded-lg mx-2 group {{ request()->routeIs('instructor.courses.create') ? 'active' : '' }}">
                    <i class="fas fa-plus-circle text-lg w-6 text-center"></i>
                    <span class="ml-3">কোর্স তৈরি করুন</span>
                </a>
                
                <a href="{{ route('instructor.students.index') }}" @click="isMobileMenuOpen = false" class="sidebar-link flex items-center px-4 py-3 text-sm font-medium rounded-lg mx-2 group {{ request()->routeIs('instructor.students.*') ? 'active' : '' }}">
                    <i class="fas fa-user-graduate text-lg w-6 text-center"></i>
                    <span class="ml-3">শিক্ষার্থীরা</span>
                </a>
                
                <a href="{{ route('instructor.earnings') }}" @click="isMobileMenuOpen = false" class="sidebar-link flex items-center px-4 py-3 text-sm font-medium rounded-lg mx-2 group {{ request()->routeIs('instructor.earnings') ? 'active' : '' }}">
                    <i class="fas fa-money-bill-wave text-lg w-6 text-center"></i>
                    <span class="ml-3">আয়</span>
                </a>
                
                <a href="{{ route('instructor.reviews') }}" @click="isMobileMenuOpen = false" class="sidebar-link flex items-center px-4 py-3 text-sm font-medium rounded-lg mx-2 group {{ request()->routeIs('instructor.reviews') ? 'active' : '' }}">
                    <i class="fas fa-money-bill-wave text-lg w-6 text-center"></i>
                    <span class="ml-3">রিভিউ</span>
                </a>
                
                <a href="#" @click="isMobileMenuOpen = false" class="sidebar-link flex items-center px-4 py-3 text-sm font-medium rounded-lg mx-2 group">
                    <i class="fas fa-cog text-lg w-6 text-center"></i>
                    <span class="ml-3">সেটিংস</span>
                </a>
            </div>
        </div>
        
        <div class="p-4 border-t border-gray-200 dark:border-slate-700">
            <div class="flex items-center">
                <img src="{{ Auth::user()->avatar ? asset('storage/' . Auth::user()->avatar) : 'https://ui-avatars.com/api/?name=' . urlencode(Auth::user()->name) . '&background=random&color=fff' }}" alt="User" class="h-10 w-10 rounded-full">
                <div class="ml-3">
                    <p class="text-sm font-medium text-gray-900 dark:text-white">{{ Auth::user()->name }}</p>
                    <p class="text-xs text-gray-500 dark:text-gray-400">ইন্সট্রাক্টর</p>
                </div>
            </div>
            <a href="#" @click.prevent="logout" class="sidebar-link flex items-center px-2 py-2 mt-3 text-sm font-medium rounded-lg">
                <i class="fas fa-sign-out-alt text-lg w-6 text-center"></i>
                <span class="ml-3">লগ আউট</span>
            </a>
        </div>
    </div>
</div>