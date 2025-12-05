@php
    use App\Models\Setting;
@endphp

<div x-show="isMobileMenuOpen" class="relative z-50 xl:hidden" role="dialog" aria-modal="true" style="display: none;">
    <!-- Backdrop -->
    <div x-show="isMobileMenuOpen" 
         x-transition:enter="transition-opacity ease-linear duration-300" 
         x-transition:enter-start="opacity-0" 
         x-transition:enter-end="opacity-100" 
         x-transition:leave="transition-opacity ease-linear duration-300" 
         x-transition:leave-start="opacity-100" 
         x-transition:leave-end="opacity-0" 
         class="fixed inset-0 bg-slate-900/80 backdrop-blur-sm" 
         @click="isMobileMenuOpen = false"></div>

    <!-- Menu Panel -->
    <div class="fixed inset-0 flex">
        <div x-show="isMobileMenuOpen" 
             x-transition:enter="transition ease-in-out duration-300 transform" 
             x-transition:enter-start="-translate-x-full" 
             x-transition:enter-end="translate-x-0" 
             x-transition:leave="transition ease-in-out duration-300 transform" 
             x-transition:leave-start="translate-x-0" 
             x-transition:leave-end="-translate-x-full" 
             class="relative mr-16 flex w-full max-w-xs flex-1 bg-white dark:bg-slate-800 shadow-xl flex-col">
            
            <div class="absolute left-full top-0 flex w-16 justify-center pt-5">
                <button type="button" class="-m-2.5 p-2.5 text-white" @click="isMobileMenuOpen = false">
                    <i class="fas fa-times text-2xl"></i>
                </button>
            </div>

            <!-- Mobile Content -->
            <div class="flex grow flex-col gap-y-5 overflow-y-auto px-6 pb-4">
                <div class="flex h-16 shrink-0 items-center border-b border-gray-200 dark:border-slate-700">
                    <div class="flex items-center gap-2">
                        @if(Setting::get('site_logo'))
                            <img src="{{ asset('storage/' . Setting::get('site_logo')) }}" alt="Logo" class="h-8 w-auto">
                        @else
                            <div class="w-8 h-8 bg-blue-600 rounded-lg flex items-center justify-center text-white font-bold">P</div>
                            <span class="text-xl font-bold text-blue-600 dark:text-blue-400 font-heading">{{ Setting::get('site_name', 'ProjuktiPlus') }}</span>
                        @endif
                    </div>
                </div>
                
                <nav class="flex flex-1 flex-col">
                    <ul role="list" class="flex flex-1 flex-col gap-y-4">
                        <li><a href="{{ route('instructor.dashboard') }}" @click="isMobileMenuOpen = false" class="group flex gap-x-3 rounded-md p-2 text-sm font-semibold leading-6 {{ request()->routeIs('instructor.dashboard') ? 'bg-blue-50 text-blue-600 dark:bg-slate-700 dark:text-blue-400' : 'text-gray-700 dark:text-gray-300' }}"><i class="fas fa-tachometer-alt w-6 text-center text-lg"></i> ড্যাশবোর্ড</a></li>
                        <li><a href="{{ route('instructor.courses.index') }}" @click="isMobileMenuOpen = false" class="group flex gap-x-3 rounded-md p-2 text-sm font-semibold leading-6 {{ request()->routeIs('instructor.courses.*') ? 'bg-blue-50 text-blue-600 dark:bg-slate-700 dark:text-blue-400' : 'text-gray-700 dark:text-gray-300' }}"><i class="fas fa-book w-6 text-center text-lg"></i> আমার কোর্সসমূহ</a></li>
                        <li><a href="{{ route('instructor.courses.create') }}" @click="isMobileMenuOpen = false" class="group flex gap-x-3 rounded-md p-2 text-sm font-semibold leading-6 {{ request()->routeIs('instructor.courses.create') ? 'bg-blue-50 text-blue-600 dark:bg-slate-700 dark:text-blue-400' : 'text-gray-700 dark:text-gray-300' }}"><i class="fas fa-plus-circle w-6 text-center text-lg"></i> কোর্স তৈরি করুন</a></li>
                        <li><a href="{{ route('instructor.students.index') }}" @click="isMobileMenuOpen = false" class="group flex gap-x-3 rounded-md p-2 text-sm font-semibold leading-6 {{ request()->routeIs('instructor.students.*') ? 'bg-blue-50 text-blue-600 dark:bg-slate-700 dark:text-blue-400' : 'text-gray-700 dark:text-gray-300' }}"><i class="fas fa-user-graduate w-6 text-center text-lg"></i> শিক্ষার্থীরা</a></li>
                        <li><a href="{{ route('instructor.earnings') }}" @click="isMobileMenuOpen = false" class="group flex gap-x-3 rounded-md p-2 text-sm font-semibold leading-6 {{ request()->routeIs('instructor.earnings') ? 'bg-blue-50 text-blue-600 dark:bg-slate-700 dark:text-blue-400' : 'text-gray-700 dark:text-gray-300' }}"><i class="fas fa-money-bill-wave w-6 text-center text-lg"></i> আয়</a></li>
                        <li><a href="{{ route('instructor.reviews') }}" @click="isMobileMenuOpen = false" class="group flex gap-x-3 rounded-md p-2 text-sm font-semibold leading-6 {{ request()->routeIs('instructor.reviews') ? 'bg-blue-50 text-blue-600 dark:bg-slate-700 dark:text-blue-400' : 'text-gray-700 dark:text-gray-300' }}"><i class="fas fa-star w-6 text-center text-lg"></i> রিভিউ</a></li>
                        <li><a href="{{ route('instructor.settings.index') }}" @click="isMobileMenuOpen = false" class="group flex gap-x-3 rounded-md p-2 text-sm font-semibold leading-6 {{ request()->routeIs('instructor.settings.*') ? 'bg-blue-50 text-blue-600 dark:bg-slate-700 dark:text-blue-400' : 'text-gray-700 dark:text-gray-300' }}"><i class="fas fa-cog w-6 text-center text-lg"></i> সেটিংস</a></li>
                    </ul>
                </nav>
                
                <!-- Mobile User Profile -->
                <div class="mt-auto border-t border-gray-200 dark:border-slate-700 pt-4">
                    <div class="flex items-center mb-3">
                        <img src="{{ Auth::user()->avatar_url }}" alt="{{ Auth::user()->name }}" class="h-10 w-10 rounded-full object-cover">
                        <div class="ml-3">
                            <p class="text-sm font-bold text-gray-800 dark:text-white">{{ Auth::user()->name }}</p>
                            <p class="text-xs text-gray-500 dark:text-gray-400">ইন্সট্রাক্টর</p>
                        </div>
                    </div>
                    <a href="#" @click.prevent="logout" class="flex items-center justify-center w-full px-4 py-2 text-sm font-medium text-red-600 bg-red-50 dark:bg-red-900/10 hover:bg-red-100 rounded-lg transition-colors">
                        <i class="fas fa-sign-out-alt mr-2"></i> লগ আউট
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>