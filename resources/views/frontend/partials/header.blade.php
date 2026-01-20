<header class="sticky top-0 z-40 dark:bg-slate-900/90 bg-white/90 backdrop-blur-md border-b border-slate-200 dark:border-slate-800 shadow-sm transition-colors duration-300" 
        x-data="{ mobileMenuOpen: false }">
    
    <div class="container mx-auto py-3 px-4 flex justify-between items-center">
        
        <div class="flex items-center space-x-4">
            <button @click="mobileMenuOpen = !mobileMenuOpen" class="md:hidden text-slate-700 dark:text-slate-300 focus:outline-none hover:text-primary-600 dark:hover:text-primary-400 transition">
                <i class="fas" :class="mobileMenuOpen ? 'fa-times' : 'fa-bars'"></i>
            </button>

            <a href="{{ url('/') }}" class="flex items-center gap-2 group no-underline">
                @if(\App\Models\Setting::get('site_logo'))
                    <img src="{{ asset('storage/' . \App\Models\Setting::get('site_logo')) }}" alt="Logo" class="h-9 md:h-10 w-auto object-contain group-hover:scale-105 transition-transform">
                @else
                    <div class="w-9 h-9 md:w-10 md:h-10 bg-primary-600 rounded-lg flex items-center justify-center text-white shadow-md group-hover:scale-105 transition-transform">
                        <i class="fas fa-graduation-cap text-lg md:text-xl"></i>
                    </div>
                @endif
                
                <div class="flex flex-col">
                    <h1 class="text-xl md:text-2xl font-semibold text-slate-800 dark:text-white font-heading tracking-tight leading-none">
                        {{ \App\Models\Setting::get('site_name', 'ProjuktiPlus') }}
                    </h1>
                    <span class="text-[11px] text-slate-500 dark:text-slate-400 font-medium tracking-wider hidden lg:block mt-1">যেখানে প্রযুক্তির গল্প হয় সহজ ভাষায়</span>
                </div>
            </a>
        </div>
        
        <nav class="hidden md:flex md:items-center space-x-8 font-heading text-[15px] font-medium">
            <a href="{{ url('/') }}" 
               class="{{ request()->is('/') ? 'text-primary-600 dark:text-primary-400 font-bold' : 'text-slate-600 dark:text-slate-300' }} hover:text-primary-600 dark:hover:text-primary-400 transition relative group">
               হোম
               <span class="absolute -bottom-1 left-0 w-0 h-0.5 bg-primary-600 transition-all group-hover:w-full"></span>
            </a>

            <a href="{{ url('/courses') }}" 
               class="{{ request()->is('courses*') ? 'text-primary-600 dark:text-primary-400 font-bold' : 'text-slate-600 dark:text-slate-300' }} hover:text-primary-600 dark:hover:text-primary-400 transition relative group">
               কোর্সসমূহ
               <span class="absolute -bottom-1 left-0 w-0 h-0.5 bg-primary-600 transition-all group-hover:w-full"></span>
            </a>

            <a href="{{ url('/about') }}" 
               class="{{ request()->is('about') ? 'text-primary-600 dark:text-primary-400 font-bold' : 'text-slate-600 dark:text-slate-300' }} hover:text-primary-600 dark:hover:text-primary-400 transition relative group">
               আমাদের সম্পর্কে
               <span class="absolute -bottom-1 left-0 w-0 h-0.5 bg-primary-600 transition-all group-hover:w-full"></span>
            </a>

            <a href="{{ url('/contact') }}" 
               class="{{ request()->is('contact') ? 'text-primary-600 dark:text-primary-400 font-bold' : 'text-slate-600 dark:text-slate-300' }} hover:text-primary-600 dark:hover:text-primary-400 transition relative group">
               যোগাযোগ
               <span class="absolute -bottom-1 left-0 w-0 h-0.5 bg-primary-600 transition-all group-hover:w-full"></span>
            </a>
        </nav>
        
        <div class="flex items-center space-x-2 md:space-x-4">
            
            <button class="hidden lg:flex p-2 rounded-full hover:bg-slate-100 dark:hover:bg-slate-800 text-slate-500 dark:text-slate-400 transition">
                <i class="fas fa-search"></i>
            </button>
            
            <button @click="darkMode = !darkMode" class="p-2 rounded-full hover:bg-slate-100 dark:hover:bg-slate-800 text-slate-600 dark:text-slate-300 transition focus:outline-none" title="Toggle Theme">
                <i class="fas" :class="darkMode ? 'fa-sun text-amber-400' : 'fa-moon text-slate-500'"></i>
            </button>
            
            @auth
                <div x-data="{ open: false }" class="relative">
                    <button @click="open = !open" class="flex items-center gap-2 focus:outline-none group">
                        <img src="{{ Auth::user()->avatar_url ?? 'https://ui-avatars.com/api/?name='.urlencode(Auth::user()->name).'&background=random' }}" 
                             class="w-9 h-9 rounded-full border-2 border-slate-200 dark:border-slate-700 group-hover:border-primary-500 transition object-cover">
                        <i class="fas fa-chevron-down text-xs text-slate-500 dark:text-slate-400 hidden sm:block"></i>
                    </button>
                    
                    <div x-show="open" @click.away="open = false" x-transition.origin.top.right x-cloak
                         class="absolute right-0 mt-3 w-56 bg-white dark:bg-slate-800 rounded-xl shadow-2xl py-2 z-50 border border-slate-100 dark:border-slate-700">
                        
                        <div class="px-4 py-3 border-b border-slate-100 dark:border-slate-700 mb-2">
                            <p class="text-sm font-bold text-slate-800 dark:text-white truncate">{{ Auth::user()->name }}</p>
                            <p class="text-xs text-slate-500 dark:text-slate-400 truncate">{{ Auth::user()->email }}</p>
                        </div>

                        @php
                            $dashboardRoute = 'student.dashboard';
                            if(Auth::user()->role == 'admin') $dashboardRoute = 'admin.dashboard';
                            elseif(Auth::user()->role == 'instructor') $dashboardRoute = 'instructor.dashboard';
                        @endphp

                        <a href="{{ Route::has($dashboardRoute) ? route($dashboardRoute) : url('/dashboard') }}" 
                           class="block px-4 py-2 text-sm text-slate-700 dark:text-slate-300 hover:bg-slate-50 dark:hover:bg-slate-700 hover:text-primary-600 dark:hover:text-primary-400 transition">
                            <i class="fas fa-th-large w-5 text-center mr-2"></i> ড্যাশবোর্ড
                        </a>

                        <a href="{{ url('/profile') }}" class="block px-4 py-2 text-sm text-slate-700 dark:text-slate-300 hover:bg-slate-50 dark:hover:bg-slate-700 hover:text-primary-600 dark:hover:text-primary-400 transition">
                            <i class="fas fa-user w-5 text-center mr-2"></i> প্রোফাইল
                        </a>

                        <div class="border-t border-slate-100 dark:border-slate-700 my-2"></div>

                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="block w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-red-50 dark:hover:bg-red-900/20 transition rounded-b-lg">
                                <i class="fas fa-sign-out-alt w-5 text-center mr-2"></i> লগআউট
                            </button>
                        </form>
                    </div>
                </div>
            @else
                <div class="hidden md:flex items-center gap-3">
                    <a href="{{ route('login') }}" class="px-5 py-2 text-sm font-bold text-slate-700 dark:text-slate-300 hover:text-primary-600 dark:hover:text-primary-400 transition">
                        লগইন
                    </a>
                    <a href="{{ route('register') }}" class="px-6 py-2.5 text-sm font-bold bg-primary-600 hover:bg-primary-700 text-white rounded-lg shadow-lg shadow-primary-500/30 hover:shadow-primary-600/40 transition transform hover:-translate-y-0.5">
                        রেজিস্ট্রেশন
                    </a>
                </div>
            @endauth
        </div>
    </div>
    
    <div x-show="mobileMenuOpen" x-collapse @click.away="mobileMenuOpen = false" x-cloak
         class="md:hidden absolute top-full left-0 w-full bg-white dark:bg-slate-900 shadow-xl border-t border-slate-200 dark:border-slate-800">
        
        <div class="flex flex-col p-4 space-y-1">
            <a href="{{ url('/') }}" class="flex items-center gap-3 px-4 py-3 rounded-lg text-slate-700 dark:text-slate-300 hover:bg-slate-50 dark:hover:bg-slate-800 hover:text-primary-600 dark:hover:text-primary-400 transition {{ request()->is('/') ? 'bg-slate-50 dark:bg-slate-800 text-primary-600 font-bold' : '' }}">
                <i class="fas fa-home w-5 text-center"></i> হোম
            </a>
            <a href="{{ url('/courses') }}" class="flex items-center gap-3 px-4 py-3 rounded-lg text-slate-700 dark:text-slate-300 hover:bg-slate-50 dark:hover:bg-slate-800 hover:text-primary-600 dark:hover:text-primary-400 transition {{ request()->is('courses*') ? 'bg-slate-50 dark:bg-slate-800 text-primary-600 font-bold' : '' }}">
                <i class="fas fa-book-open w-5 text-center"></i> কোর্সসমূহ
            </a>
            <a href="{{ url('/about') }}" class="flex items-center gap-3 px-4 py-3 rounded-lg text-slate-700 dark:text-slate-300 hover:bg-slate-50 dark:hover:bg-slate-800 hover:text-primary-600 dark:hover:text-primary-400 transition {{ request()->is('about') ? 'bg-slate-50 dark:bg-slate-800 text-primary-600 font-bold' : '' }}">
                <i class="fas fa-info-circle w-5 text-center"></i> আমাদের সম্পর্কে
            </a>
            <a href="{{ url('/contact') }}" class="flex items-center gap-3 px-4 py-3 rounded-lg text-slate-700 dark:text-slate-300 hover:bg-slate-50 dark:hover:bg-slate-800 hover:text-primary-600 dark:hover:text-primary-400 transition {{ request()->is('contact') ? 'bg-slate-50 dark:bg-slate-800 text-primary-600 font-bold' : '' }}">
                <i class="fas fa-envelope w-5 text-center"></i> যোগাযোগ
            </a>

            @guest
                <div class="border-t border-slate-100 dark:border-slate-800 my-2 pt-3 flex flex-col gap-3">
                    <a href="{{ route('login') }}" class="w-full text-center py-3 border border-slate-200 dark:border-slate-700 rounded-lg font-bold text-slate-700 dark:text-slate-300 hover:bg-slate-50 dark:hover:bg-slate-800 transition">
                        লগইন
                    </a>
                    <a href="{{ route('register') }}" class="w-full text-center py-3 bg-primary-600 text-white rounded-lg font-bold hover:bg-primary-700 shadow-lg shadow-primary-500/20 transition">
                        রেজিস্ট্রেশন করুন
                    </a>
                </div>
            @endguest
        </div>
    </div>
</header>