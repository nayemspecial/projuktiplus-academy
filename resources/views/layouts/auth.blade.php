<!DOCTYPE html>
<html lang="en" x-data="auth()" :class="{'dark': isDark}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'ProjuktiPlus Academy')</title>

    {{-- Vite Assets (CSS & JS) --}}
    @vite(['resources/css/tailwind.css', 'resources/js/app.js'])
    
</head>
<body class="bg-gray-50 dark:bg-slate-900 text-gray-800 dark:text-slate-300 min-h-screen">
    <div class="flex min-h-screen">
        <!-- Left Side (Branding) -->
        <div class="hidden lg:flex lg:w-1/2 bg-gradient-to-br from-blue-600 to-blue-800 dark:from-blue-800 dark:to-blue-900 text-white p-12">
            <div class="max-w-md mx-auto flex flex-col justify-center">
                <img src="{{ asset('images/logo.png') }}" alt="Logo" class="h-16 w-16 mb-6">
                <h1 class="text-4xl font-bold mb-4">ProjuktiPlus Academy</h1>
                <p class="text-lg mb-8">আমাদের প্ল্যাটফর্মে আপনার লার্নিং জার্নি শুরু করুন। দক্ষতা অর্জন করুন এবং আপনার ক্যারিয়ারকে এগিয়ে নিন।</p>
                <div class="space-y-4">
                    <div class="flex items-center">
                        <div class="flex-shrink-0 bg-blue-500 rounded-full p-2">
                            <i class="fas fa-book-open text-white"></i>
                        </div>
                        <p class="ml-3">১০০+ কোর্স</p>
                    </div>
                    <div class="flex items-center">
                        <div class="flex-shrink-0 bg-blue-500 rounded-full p-2">
                            <i class="fas fa-chalkboard-teacher text-white"></i>
                        </div>
                        <p class="ml-3">বিশেষজ্ঞ ইন্সট্রাক্টর</p>
                    </div>
                    <div class="flex items-center">
                        <div class="flex-shrink-0 bg-blue-500 rounded-full p-2">
                            <i class="fas fa-certificate text-white"></i>
                        </div>
                        <p class="ml-3">সার্টিফিকেট</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Right Side (Authentication Forms) -->
        <div class="w-full lg:w-1/2 auth-container flex items-center justify-center p-6">
            <div class="w-full max-w-md">
                <!-- Dark Mode Toggle -->
                <div class="flex justify-end mb-4">
                    <button @click="isDark = !isDark" class="p-2 rounded-full text-gray-600 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-slate-800">
                        <i x-show="!isDark" class="fas fa-moon"></i>
                        <i x-show="isDark" class="fas fa-sun"></i>
                    </button>
                </div>

                <!-- Logo for Mobile -->
                <div class="flex justify-center lg:hidden mb-8">
                    <img src="{{ asset('images/logo.png') }}" alt="Logo" class="h-12">
                </div>

                @yield('auth-content')
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('auth', () => ({
                isDark: localStorage.getItem('darkMode') === 'true' || 
                        (!('darkMode' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches),
                
                init() {
                    // Update dark mode class on body
                    if (this.isDark) {
                        document.documentElement.classList.add('dark');
                    } else {
                        document.documentElement.classList.remove('dark');
                    }
                },
                
                toggleDarkMode() {
                    this.isDark = !this.isDark;
                    localStorage.setItem('darkMode', this.isDark);
                    
                    if (this.isDark) {
                        document.documentElement.classList.add('dark');
                    } else {
                        document.documentElement.classList.remove('dark');
                    }
                }
            }));
        });
    </script>
</body>
</html>