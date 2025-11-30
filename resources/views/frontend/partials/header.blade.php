<header class="sticky top-0 z-50 dark:bg-slate-800/80 bg-white/80 backdrop-blur-md border-b border-slate-200 dark:border-slate-700 shadow-sm transition-colors duration-300">
    <div class="container mx-auto py-3 px-4 flex justify-between items-center">
        <!-- Logo -->
        <div class="flex items-center space-x-4">
            <button @click="mobileMenuOpen = !mobileMenuOpen" class="md:hidden text-slate-700 dark:text-slate-300 focus:outline-none">
                <i class="fas fa-bars text-xl"></i>
            </button>
            <a href="{{ url('/') }}" class="flex items-center gap-2 group no-underline">
                @if(\App\Models\Setting::get('site_logo'))
                    <img src="{{ asset('storage/' . \App\Models\Setting::get('site_logo')) }}" alt="Logo" class="h-9 w-auto object-contain group-hover:scale-105 transition-transform">
                @else
                    <div class="w-10 h-10 bg-primary-500 rounded-lg flex items-center justify-center text-white shadow-md group-hover:scale-105 transition-transform">
                        <i class="fas fa-graduation-cap text-xl"></i>
                    </div>
                    <h1 class="text-2xl font-bold ml-2 text-slate-800 dark:text-white font-heading tracking-tight">
                        {{ \App\Models\Setting::get('site_name', 'ProjuktiPlus') }}
                    </h1>
                @endif
            </a>
        </div>
        
        <!-- Desktop Nav -->
        <nav class="hidden md:flex md:items-center space-x-6 font-heading text-sm font-medium">
            <a href="{{ url('/') }}" class="hover:text-primary-600 dark:hover:text-primary-400 {{ request()->is('/') ? 'text-primary-600 dark:text-primary-400' : '' }} transition">হোম</a>
            <a href="{{ url('/courses') }}" class="hover:text-primary-600 dark:hover:text-primary-400 transition">কোর্সসমূহ</a>
            <a href="{{ url('/instructors') }}" class="hover:text-primary-600 dark:hover:text-primary-400 transition">ইন্সট্রাক্টর</a>
            <a href="{{ url('/about') }}" class="hover:text-primary-600 dark:hover:text-primary-400 transition">আমাদের সম্পর্কে</a>
            <a href="{{ url('/contact') }}" class="hover:text-primary-600 dark:hover:text-primary-400 transition">যোগাযোগ</a>
        </nav>
        
        <!-- Right Actions -->
        <div class="flex items-center space-x-3">
            <button class="hidden md:flex p-2 rounded-full hover:bg-slate-100 dark:hover:bg-slate-700 text-slate-600 dark:text-slate-300 transition">
                <i class="fas fa-search"></i>
            </button>
            
            <button @click="darkMode = !darkMode" class="p-2 rounded-full hover:bg-slate-100 dark:hover:bg-slate-700 transition text-slate-600 dark:text-slate-300">
                <i class="fas" :class="darkMode ? 'fa-sun' : 'fa-moon'"></i>
            </button>
            
            @auth
                <div x-data="{ open: false }" class="relative">
                    <button @click="open = !open" class="flex items-center space-x-2 focus:outline-none">
                        <img src="{{ Auth::user()->avatar_url ?? 'https://ui-avatars.com/api/?name='.urlencode(Auth::user()->name) }}" class="w-9 h-9 rounded-full border-2 border-primary-500 object-cover">
                    </button>
                    
                    <div x-show="open" @click.away="open = false" x-cloak
                         class="absolute right-0 mt-2 w-48 bg-white dark:bg-slate-800 rounded-xl shadow-lg py-1 z-50 border border-slate-200 dark:border-slate-700 text-sm font-medium">
                        @if(Auth::user()->role == 'admin')
                            <a href="{{ route('admin.dashboard') }}" class="block px-4 py-2 text-slate-700 dark:text-slate-300 hover:bg-slate-100 dark:hover:bg-slate-700">অ্যাডমিন প্যানেল</a>
                        @elseif(Auth::user()->role == 'instructor')
                            <a href="{{ route('instructor.dashboard') }}" class="block px-4 py-2 text-slate-700 dark:text-slate-300 hover:bg-slate-100 dark:hover:bg-slate-700">ড্যাশবোর্ড</a>
                        @else
                            <a href="{{ route('student.dashboard') }}" class="block px-4 py-2 text-slate-700 dark:text-slate-300 hover:bg-slate-100 dark:hover:bg-slate-700">আমার ড্যাশবোর্ড</a>
                        @endif
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="block w-full text-left px-4 py-2 text-red-600 hover:bg-red-50 dark:hover:bg-red-900/20">লগআউট</button>
                        </form>
                    </div>
                </div>
            @else
                <div class="hidden md:flex items-center space-x-3">
                    <a href="{{ route('login') }}" class="px-4 py-2 text-sm font-bold text-primary-600 dark:text-primary-400 hover:bg-primary-50 dark:hover:bg-primary-900/20 rounded-lg transition">লগইন</a>
                    <a href="{{ route('register') }}" class="px-4 py-2 text-sm font-bold bg-primary-600 hover:bg-primary-700 text-white rounded-lg shadow-md hover:shadow-lg transition transform hover:-translate-y-0.5">রেজিস্টার</a>
                </div>
            @endauth
        </div>
    </div>
    
    <!-- Mobile Menu -->
    <div x-show="mobileMenuOpen" x-collapse @click.away="mobileMenuOpen = false" x-cloak
         class="md:hidden absolute top-full left-0 w-full bg-white dark:bg-slate-800 shadow-xl border-t border-slate-200 dark:border-slate-700">
        <div class="container mx-auto px-4 py-4 flex flex-col space-y-2 font-heading">
            <a href="{{ url('/') }}" class="block py-2 px-4 hover:bg-slate-50 dark:hover:bg-slate-700 rounded-lg transition">হোম</a>
            <a href="{{ url('/courses') }}" class="block py-2 px-4 hover:bg-slate-50 dark:hover:bg-slate-700 rounded-lg transition">কোর্সসমূহ</a>
            <a href="{{ url('/instructors') }}" class="block py-2 px-4 hover:bg-slate-50 dark:hover:bg-slate-700 rounded-lg transition">ইন্সট্রাক্টর</a>
            <a href="{{ url('/about') }}" class="block py-2 px-4 hover:bg-slate-50 dark:hover:bg-slate-700 rounded-lg transition">আমাদের সম্পর্কে</a>
            @guest
            <div class="pt-4 mt-2 border-t border-slate-100 dark:border-slate-700 flex flex-col gap-3">
                <a href="{{ route('login') }}" class="block w-full text-center py-2.5 border border-slate-300 dark:border-slate-600 rounded-lg font-bold text-slate-700 dark:text-slate-300">লগইন</a>
                <a href="{{ route('register') }}" class="block w-full text-center py-2.5 bg-primary-600 text-white rounded-lg font-bold">রেজিস্টার</a>
            </div>
            @endguest
        </div>
    </div>
</header>