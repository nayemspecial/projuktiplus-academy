<!DOCTYPE html>
<html lang="bn" x-data="instructorApp()" x-init="init()" :class="{'dark': isDark}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'ইন্সট্রাক্টর ড্যাশবোর্ড') - ProjuktiPlus LMS</title>
    
    {{-- Vite Assets --}}
    @vite(['resources/css/tailwind.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <link href="https://fonts.googleapis.com/css2?family=Hind+Siliguri:wght@400;500;600;700&family=Kohinoor+Bangla:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    colors: {
                        slate: {
                            50: '#f8fafc', 100: '#f1f5f9', 200: '#e2e8f0',
                            800: '#1e293b', 900: '#0f172a', 950: '#020617'
                        },
                        primary: { 500: '#6366f1', 600: '#4f46e5' }
                    },
                    fontFamily: {
                        'heading': ['Hind Siliguri', 'sans-serif'],
                        'body': ['Kohinoor Bangla', 'sans-serif']
                    }
                }
            }
        }
    </script>

    <style>
        body { font-family: 'Kohinoor Bangla', sans-serif; letter-spacing: .5px; }
        h1, h2, h3, h4, h5, h6 { font-family: 'Hind Siliguri', sans-serif; }
        [x-cloak] { display: none !important; }
        
        /* Sidebar Styles (অ্যাডভান্সড হোভারের জন্য) */
        .sidebar { transition: width 0.3s ease-in-out; }
        .xl\:sidebar-hover:hover { width: 256px; } /* 256px = w-64 */
        .xl\:sidebar-hover:hover .sidebar-text { display: block; }
        .xl\:sidebar-hover:hover .sidebar-icon-only { display: none; }
        
        .sidebar-link.active {
            background-color: rgba(59, 130, 246, 0.1);
            color: #3b82f6;
            border-left: 3px solid #3b82f6;
        }
        .sidebar-link.active:hover { background-color: rgba(59, 130, 246, 0.2); }
        .course-card:hover { transform: translateY(-5px); }
    </style>
    
    @stack('styles') 
</head>
<body class="bg-gray-50 dark:bg-slate-900 text-gray-800 dark:text-slate-300 min-h-screen">
    <div class="flex h-screen overflow-hidden" x-cloak>
        
        <div class="sidebar bg-white dark:bg-slate-800 shadow-md w-20 fixed h-full z-50 xl:w-64">
            <div class="flex flex-col h-full">
                <div class="flex items-center justify-center xl:justify-start h-16 px-4 border-b border-gray-200 dark:border-slate-700 flex-shrink-0">
                    <div class="flex items-center">
                        <img src="https://cdn.ostad.app/public/upload/2023-06-12T06-26-02.391Z-projuktiplus-logo.svg" alt="Logo" class="h-10 w-10">
                        <span class="sidebar-text hidden xl:block ml-3 text-xl font-bold text-blue-600 dark:text-blue-400">প্রযুক্তি প্লাস</span>
                    </div>
                </div>
                
                <nav class="flex-1 overflow-y-auto py-4">
                    <div class="space-y-1 px-2">
                        <a href="{{ route('instructor.dashboard') }}" title="ড্যাশবোর্ড" class="sidebar-link flex items-center px-4 py-3 text-sm font-medium rounded-lg mx-2 group {{ request()->routeIs('instructor.dashboard') ? 'active' : '' }}">
                            <i class="fas fa-tachometer-alt text-lg w-6 text-center"></i>
                            <span class="sidebar-text hidden xl:block ml-3">ড্যাশবোর্ড</span>
                        </a>
                        
                        <a href="{{ route('instructor.courses.index') }}" title="আমার কোর্সসমূহ" class="sidebar-link flex items-center px-4 py-3 text-sm font-medium rounded-lg mx-2 group {{ request()->routeIs('instructor.courses.*') ? 'active' : '' }}">
                            <i class="fas fa-book text-lg w-6 text-center"></i>
                            <span class="sidebar-text hidden xl:block ml-3">আমার কোর্সসমূহ</span>
                        </a>
                        
                        <a href="{{ route('instructor.courses.create') }}" title="কোর্স তৈরি করুন" class="sidebar-link flex items-center px-4 py-3 text-sm font-medium rounded-lg mx-2 group {{ request()->routeIs('instructor.courses.create') ? 'active' : '' }}">
                            <i class="fas fa-plus-circle text-lg w-6 text-center"></i>
                            <span class="sidebar-text hidden xl:block ml-3">কোর্স তৈরি করুন</span>
                        </a>
                        
                        <a href="{{ route('instructor.students.index') }}" title="শিক্ষার্থীরা" class="sidebar-link flex items-center px-4 py-3 text-sm font-medium rounded-lg mx-2 group {{ request()->routeIs('instructor.students.*') ? 'active' : '' }}">
                            <i class="fas fa-user-graduate text-lg w-6 text-center"></i>
                            <span class="sidebar-text hidden xl:block ml-3">শিক্ষার্থীরা</span>
                        </a>
                        
                        <a href="{{ route('instructor.earnings') }}" title="আয়" class="sidebar-link flex items-center px-4 py-3 text-sm font-medium rounded-lg mx-2 group {{ request()->routeIs('instructor.earnings') ? 'active' : '' }}">
                            <i class="fas fa-money-bill-wave text-lg w-6 text-center"></i>
                            <span class="sidebar-text hidden xl:block ml-3">আয়</span>
                        </a>
                        
                        <a href="{{ route('instructor.reviews') }}" title="রিভিউ" class="sidebar-link flex items-center px-4 py-3 text-sm font-medium rounded-lg mx-2 group {{ request()->routeIs('instructor.reviews') ? 'active' : '' }}">
                            <i class="fas fa-star text-lg w-6 text-center"></i>
                            <span class="sidebar-text hidden xl:block ml-3">রিভিউ</span>
                        </a>
                        
                        <a href="{{ route('instructor.settings.index') }}" title="সেটিংস" class="sidebar-link flex items-center px-4 py-3 text-sm font-medium rounded-lg mx-2 group">
                            <i class="fas fa-cog text-lg w-6 text-center"></i>
                            <span class="sidebar-text hidden xl:block ml-3">সেটিংস</span>
                        </a>
                    </div>
                </nav>
                
                <div class="p-4 border-t border-gray-200 dark:border-slate-700">
                    <div class="flex items-center">
                        <img src="{{ Auth::user()->avatar ? asset('storage/'. Auth::user()->avatar) : 'https://ui-avatars.com/api/?name=' . urlencode(Auth::user()->name) . '&background=random&color=fff' }}" alt="User" class="h-10 w-10 rounded-full">
                        <div class="sidebar-text hidden xl:block ml-3">
                            <p class="text-sm font-medium">{{ Auth::user()->name }}</p>
                            <p class="text-xs text-gray-500 dark:text-gray-400">ইন্সট্রাক্টর</p>
                        </div>
                    </div>
                    <a href="#" @click.prevent="logout" class="sidebar-link flex items-center px-2 py-2 mt-3 text-sm font-medium rounded-lg">
                        <i class="fas fa-sign-out-alt text-lg w-6 text-center"></i>
                        <span class="sidebar-text hidden xl:block ml-3">লগ আউট</span>
                    </a>
                </div>
            </div>
        </div>

        <div class="flex-1 flex flex-col overflow-hidden ml-20 xl:ml-64 transition-all duration-300">
            @include('partials.instructor-header') 
            @include('partials.instructor-mobile-sidebar') <div 
                x-data="{ show: true }"
                x-init="() => {
                    @if(session('success') || session('error'))
                        setTimeout(() => show = false, 4000); // ৪ সেকেন্ড পর হাইড হবে
                    @else
                        show = false; // যদি কোনো সেশন না থাকে তবে দেখাবে না
                    @endif
                }"
                x-show="show"
                x-transition:enter="transition ease-out duration-300"
                x-transition:enter-start="opacity-0 transform translate-y-4"
                x-transition:enter-end="opacity-100 transform translate-y-0"
                x-transition:leave="transition ease-in duration-300"
                x-transition:leave-start="opacity-100 transform translate-y-0"
                x-transition:leave-end="opacity-0 transform translate-y-4"
                class="fixed top-20 right-6 z-50"
                style="display: none;"
            >
                @if(session('success'))
                    <div class="max-w-sm rounded-md bg-green-100 dark:bg-green-900/30 p-4 shadow-lg border border-green-200 dark:border-green-700">
                        <div class="flex items-start">
                            <div class="flex-shrink-0">
                                <i class="fas fa-check-circle text-green-500 text-xl"></i>
                            </div>
                            <div class="ml-3">
                                <h3 class="text-sm font-medium text-green-800 dark:text-green-300">সফল!</h3>
                                <p class="text-sm text-green-700 dark:text-green-400 mt-1">
                                    {{ session('success') }}
                                </p>
                            </div>
                        </div>
                    </div>
                @endif

                @if(session('error'))
                    <div class="max-w-sm rounded-md bg-red-100 dark:bg-red-900/30 p-4 shadow-lg border border-red-200 dark:border-red-700">
                        <div class="flex items-start">
                            <div class="flex-shrink-0">
                                <i class="fas fa-times-circle text-red-500 text-xl"></i>
                            </div>
                            <div class="ml-3">
                                <h3 class="text-sm font-medium text-red-800 dark:text-red-300">ত্রুটি!</h3>
                                <p class="text-sm text-red-700 dark:text-red-400 mt-1">
                                    {{ session('error') }}
                                </p>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
            <main class="flex-1 overflow-y-auto p-4 md:p-6 bg-gray-50 dark:bg-slate-900 flex flex-col">
                <div class="flex-1">
                    @yield('instructor-content')
                </div>
                
                <!-- ফুটার এখানে যুক্ত করতে পারেন যদি চান -->
                @includeIf('partials.footer')
            </main>
        </div>
    </div>

    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        @csrf
    </form>

    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('instructorApp', () => ({
                // App state
                isDark: false,
                isMobileMenuOpen: false,
                
                init() {
                    // Dark mode চেক করা
                    this.isDark = localStorage.getItem('darkMode') === 'true' || 
                                  (!('darkMode' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches);
                    
                    // AlpineJS চালু হলে HTML-এ ক্লাস সেট করা
                    this.updateTheme();

                    // ডার্ক মোড পরিবর্তনের জন্য figyelés
                    this.$watch('isDark', (value) => {
                        localStorage.setItem('darkMode', value);
                        this.updateTheme();
                    });
                },

                updateTheme() {
                    if (this.isDark) {
                        document.documentElement.classList.add('dark');
                    } else {
                        document.documentElement.classList.remove('dark');
                    }
                },

                logout() {
                    document.getElementById('logout-form').submit();
                }
            }));
        });
    </script>


    @stack('scripts') 

</body>
</html>