@php
    use App\Models\Setting;
@endphp

<div class="sidebar bg-white dark:bg-slate-800 shadow-md w-20 fixed h-full z-50 xl:w-64 hidden xl:flex flex-col group/sidebar border-r border-gray-200 dark:border-slate-700 transition-all duration-300">
    <div class="flex flex-col h-full">
        <!-- Logo -->
        <div class="flex items-center justify-center xl:justify-start h-16 px-4 border-b border-gray-200 dark:border-slate-700 flex-shrink-0">
            <div class="flex items-center gap-2 overflow-hidden">
                @if(Setting::get('site_logo'))
                    <img src="{{ asset('storage/' . Setting::get('site_logo')) }}" alt="Logo" class="h-8 w-auto object-contain">
                @else
                    <div class="w-8 h-8 bg-blue-600 rounded-lg flex-shrink-0 flex items-center justify-center text-white font-bold shadow-sm">P</div>
                    <span class="sidebar-text hidden xl:block ml-2 text-xl font-bold text-blue-600 dark:text-blue-400 font-heading whitespace-nowrap">
                        {{ Setting::get('site_name', 'ProjuktiPlus') }}
                    </span>
                @endif
            </div>
        </div>
        
        <!-- Menu -->
        <nav class="flex-1 overflow-y-auto py-4 space-y-1 px-2 custom-scrollbar">
            <a href="{{ route('instructor.dashboard') }}" class="sidebar-link flex items-center px-2 xl:px-4 py-3 text-sm font-medium rounded-lg text-gray-700 dark:text-gray-300 hover:bg-blue-50 dark:hover:bg-slate-700 transition group {{ request()->routeIs('instructor.dashboard') ? 'active' : '' }}" title="ড্যাশবোর্ড">
                <i class="fas fa-tachometer-alt text-lg w-6 text-center flex-shrink-0 group-hover:scale-110 transition-transform"></i>
                <span class="sidebar-text hidden xl:block ml-3 truncate">ড্যাশবোর্ড</span>
            </a>
            
            <a href="{{ route('instructor.courses.index') }}" class="sidebar-link flex items-center px-2 xl:px-4 py-3 text-sm font-medium rounded-lg text-gray-700 dark:text-gray-300 hover:bg-blue-50 dark:hover:bg-slate-700 transition group {{ request()->routeIs('instructor.courses.*') ? 'active' : '' }}" title="আমার কোর্সসমূহ">
                <i class="fas fa-book text-lg w-6 text-center flex-shrink-0 group-hover:scale-110 transition-transform"></i>
                <span class="sidebar-text hidden xl:block ml-3 truncate">আমার কোর্সসমূহ</span>
            </a>
            
            <a href="{{ route('instructor.courses.create') }}" class="sidebar-link flex items-center px-2 xl:px-4 py-3 text-sm font-medium rounded-lg text-gray-700 dark:text-gray-300 hover:bg-blue-50 dark:hover:bg-slate-700 transition group {{ request()->routeIs('instructor.courses.create') ? 'active' : '' }}" title="কোর্স তৈরি করুন">
                <i class="fas fa-plus-circle text-lg w-6 text-center flex-shrink-0 group-hover:scale-110 transition-transform"></i>
                <span class="sidebar-text hidden xl:block ml-3 truncate">কোর্স তৈরি করুন</span>
            </a>
            
            <a href="{{ route('instructor.students.index') }}" class="sidebar-link flex items-center px-2 xl:px-4 py-3 text-sm font-medium rounded-lg text-gray-700 dark:text-gray-300 hover:bg-blue-50 dark:hover:bg-slate-700 transition group {{ request()->routeIs('instructor.students.*') ? 'active' : '' }}" title="শিক্ষার্থীরা">
                <i class="fas fa-user-graduate text-lg w-6 text-center flex-shrink-0 group-hover:scale-110 transition-transform"></i>
                <span class="sidebar-text hidden xl:block ml-3 truncate">শিক্ষার্থীরা</span>
            </a>
            
            <a href="{{ route('instructor.earnings') }}" class="sidebar-link flex items-center px-2 xl:px-4 py-3 text-sm font-medium rounded-lg text-gray-700 dark:text-gray-300 hover:bg-blue-50 dark:hover:bg-slate-700 transition group {{ request()->routeIs('instructor.earnings') ? 'active' : '' }}" title="আয় ও পেমেন্ট">
                <i class="fas fa-money-bill-wave text-lg w-6 text-center flex-shrink-0 group-hover:scale-110 transition-transform"></i>
                <span class="sidebar-text hidden xl:block ml-3 truncate">আয় ও পেমেন্ট</span>
            </a>
            
            <a href="{{ route('instructor.reviews') }}" class="sidebar-link flex items-center px-2 xl:px-4 py-3 text-sm font-medium rounded-lg text-gray-700 dark:text-gray-300 hover:bg-blue-50 dark:hover:bg-slate-700 transition group {{ request()->routeIs('instructor.reviews') ? 'active' : '' }}" title="রিভিউ">
                <i class="fas fa-star text-lg w-6 text-center flex-shrink-0 group-hover:scale-110 transition-transform"></i>
                <span class="sidebar-text hidden xl:block ml-3 truncate">রিভিউ</span>
            </a>
            
            <a href="{{ route('instructor.settings.index') }}" class="sidebar-link flex items-center px-2 xl:px-4 py-3 text-sm font-medium rounded-lg text-gray-700 dark:text-gray-300 hover:bg-blue-50 dark:hover:bg-slate-700 transition group {{ request()->routeIs('instructor.settings.*') ? 'active' : '' }}" title="সেটিংস">
                <i class="fas fa-cog text-lg w-6 text-center flex-shrink-0 group-hover:scale-110 transition-transform"></i>
                <span class="sidebar-text hidden xl:block ml-3 truncate">সেটিংস</span>
            </a>
        </nav>
        
        <!-- User Profile -->
        <div class="p-4 border-t border-gray-200 dark:border-slate-700 bg-white dark:bg-slate-800">
            <div class="flex items-center justify-center xl:justify-start mb-3">
                <img src="{{ Auth::user()->avatar_url }}" alt="{{ Auth::user()->name }}" class="h-9 w-9 rounded-full object-cover border-2 border-gray-100 dark:border-slate-600 flex-shrink-0">
                <div class="ml-3 overflow-hidden hidden xl:block">
                    <p class="text-sm font-bold text-gray-800 dark:text-white truncate">{{ Auth::user()->name }}</p>
                    <p class="text-xs text-gray-500 dark:text-gray-400 truncate">ইন্সট্রাক্টর</p>
                </div>
            </div>
            <a href="#" @click.prevent="logout" class="flex items-center justify-center w-full px-2 xl:px-4 py-2 text-sm font-medium text-red-600 bg-red-50 dark:bg-red-900/10 hover:bg-red-100 dark:hover:bg-red-900/30 rounded-lg transition-colors duration-200 group" title="লগ আউট">
                <i class="fas fa-sign-out-alt text-lg xl:mr-2 group-hover:-translate-x-1 transition-transform"></i>
                <span class="hidden xl:inline">লগ আউট</span>
            </a>
        </div>
    </div>
</div>