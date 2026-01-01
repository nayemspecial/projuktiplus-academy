<!DOCTYPE html>
<html lang="bn" x-data="auth()" :class="{'dark': isDark}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - {{ \App\Models\Setting::get('site_name', 'ProjuktiPlus Academy') }}</title>

    {{-- Favicon --}}
    @if(\App\Models\Setting::get('site_favicon'))
        <link rel="icon" type="image/png" href="{{ asset('storage/' . \App\Models\Setting::get('site_favicon')) }}">
    @else
        <link rel="icon" href="{{ asset('favicon.ico') }}">
    @endif

    {{-- Vite Assets --}}
    @vite(['resources/css/tailwind.css', 'resources/js/app.js'])
    
    {{-- Font Awesome --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-gray-50 dark:bg-slate-900 text-gray-800 dark:text-slate-300 min-h-screen font-body">
    <div class="flex min-h-screen">
        <div class="hidden lg:flex lg:w-1/2 bg-gradient-to-br from-blue-600 to-blue-800 dark:from-blue-800 dark:to-blue-900 text-white p-12 relative overflow-hidden">
            <div class="absolute top-0 left-0 w-full h-full opacity-10 pointer-events-none">
                <i class="fas fa-code absolute top-10 left-10 text-6xl"></i>
                <i class="fas fa-layer-group absolute bottom-20 right-20 text-8xl"></i>
            </div>

            <div class="max-w-md mx-auto flex flex-col justify-center relative z-10">
                <a href="{{ url('/') }}" class="mb-8">
                    @if(\App\Models\Setting::get('site_logo'))
                        <img src="{{ asset('storage/' . \App\Models\Setting::get('site_logo')) }}" alt="Logo" class="h-20 w-auto bg-white/10 p-2 rounded-lg backdrop-blur-sm">
                    @else
                        <div class="h-20 w-20 bg-white/20 rounded-lg flex items-center justify-center text-4xl font-bold">
                            <i class="fas fa-graduation-cap"></i>
                        </div>
                    @endif
                </a>
                
                <h1 class="text-4xl font-bold mb-4 font-heading">
                    {{ \App\Models\Setting::get('site_name', 'ProjuktiPlus Academy') }}
                </h1>
                
                <p class="text-lg mb-8 text-blue-100">
                    {{ \App\Models\Setting::get('site_description', 'আমাদের প্ল্যাটফর্মে আপনার লার্নিং জার্নি শুরু করুন। দক্ষতা অর্জন করুন এবং আপনার ক্যারিয়ারকে এগিয়ে নিন।') }}
                </p>
                
                <div class="space-y-5">
                    <div class="flex items-center">
                        <div class="flex-shrink-0 bg-white/20 backdrop-blur-md rounded-full p-3">
                            <i class="fas fa-book-open text-white"></i>
                        </div>
                        <p class="ml-4 font-medium">সমৃদ্ধ কারিকুলাম ও লেসন</p>
                    </div>
                    <div class="flex items-center">
                        <div class="flex-shrink-0 bg-white/20 backdrop-blur-md rounded-full p-3">
                            <i class="fas fa-chalkboard-teacher text-white"></i>
                        </div>
                        <p class="ml-4 font-medium">ইন্ডাস্ট্রি এক্সপার্ট মেন্টর</p>
                    </div>
                    <div class="flex items-center">
                        <div class="flex-shrink-0 bg-white/20 backdrop-blur-md rounded-full p-3">
                            <i class="fas fa-certificate text-white"></i>
                        </div>
                        <p class="ml-4 font-medium">কোর্স শেষে ভেরিফাইড সার্টিফিকেট</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="w-full lg:w-1/2 auth-container flex items-center justify-center p-6 relative">
            
            <div class="absolute top-6 right-6">
                <button @click="toggleDarkMode()" class="p-2 rounded-full text-gray-600 dark:text-gray-400 hover:bg-gray-200 dark:hover:bg-slate-700 transition">
                    <i x-show="!isDark" class="fas fa-moon text-xl"></i>
                    <i x-show="isDark" class="fas fa-sun text-xl text-yellow-400"></i>
                </button>
            </div>

            <div class="w-full max-w-md">
                <div class="flex justify-center lg:hidden mb-8">
                    @if(\App\Models\Setting::get('site_logo'))
                        <img src="{{ asset('storage/' . \App\Models\Setting::get('site_logo')) }}" alt="Logo" class="h-12 w-auto">
                    @else
                        <h2 class="text-2xl font-bold text-blue-600">{{ \App\Models\Setting::get('site_name') }}</h2>
                    @endif
                </div>

                @if(session('status'))
                    <div class="mb-4 p-4 rounded-lg bg-green-50 dark:bg-green-900/30 text-green-600 dark:text-green-400 border border-green-200 dark:border-green-800 flex items-center gap-2">
                        <i class="fas fa-check-circle"></i> {{ session('status') }}
                    </div>
                @endif

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
                    this.applyTheme();
                },
                
                toggleDarkMode() {
                    this.isDark = !this.isDark;
                    localStorage.setItem('darkMode', this.isDark);
                    this.applyTheme();
                },

                applyTheme() {
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