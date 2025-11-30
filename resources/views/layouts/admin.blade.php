<!DOCTYPE html>
@php
    use App\Models\Setting;
    
    $siteName = Setting::get('site_name', 'ProjuktiPlus LMS');
    $siteFavicon = Setting::get('site_favicon');
    $primaryColor = Setting::get('primary_color', '#4F46E5');
    
    // SEO Meta Data
    $metaDesc = Setting::get('meta_description', 'LMS Admin Dashboard');
    $metaKeywords = Setting::get('meta_keywords', 'lms, admin, education');
    $metaAuthor = Setting::get('meta_author', 'ProjuktiPlus');
    $ogImage = Setting::get('og_image');
@endphp
<html lang="bn" x-data="adminApp()" :class="{'dark': isDark}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- SEO Meta Tags -->
    <meta name="description" content="{{ $metaDesc }}">
    <meta name="keywords" content="{{ $metaKeywords }}">
    <meta name="author" content="{{ $metaAuthor }}">
    
    <!-- Open Graph / Social Media -->
    <meta property="og:title" content="@yield('title', 'অ্যাডমিন ড্যাশবোর্ড') - {{ $siteName }}">
    <meta property="og:description" content="{{ $metaDesc }}">
    @if($ogImage)
        <meta property="og:image" content="{{ asset('storage/' . $ogImage) }}">
    @endif
    
    <title>@yield('title', 'অ্যাডমিন ড্যাশবোর্ড') - {{ $siteName }}</title>

    <!-- Favicon -->
    @if($siteFavicon)
        <link rel="icon" type="image/png" href="{{ asset('storage/' . $siteFavicon) }}">
    @else
        <link rel="icon" href="{{ asset('favicon.ico') }}">
    @endif
    
    <!-- Tailwind & FontAwesome -->
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Alpine.js Plugins -->
    <script src="https://cdn.jsdelivr.net/npm/@alpinejs/sort@3.13.3/dist/cdn.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@alpinejs/collapse@3.x.x/dist/cdn.min.js"></script> <!-- Collapse Plugin Added -->
    <!-- Alpine.js -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <link href="https://fonts.googleapis.com/css2?family=Hind+Siliguri:wght@400;500;600;700&family=Kohinoor+Bangla:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    colors: { slate: { 50: '#f8fafc', 800: '#1e293b', 900: '#0f172a' }, primary: { 600: '#4f46e5' } },
                    fontFamily: { 'heading': ['Hind Siliguri'], 'body': ['Kohinoor Bangla'] }
                }
            }
        }
    </script>
    <style>
        [x-cloak] { display: none !important; }
        body { font-family: 'Kohinoor Bangla', sans-serif; }
        .custom-scrollbar::-webkit-scrollbar { width: 5px; }
        .custom-scrollbar::-webkit-scrollbar-thumb { background-color: #cbd5e1; border-radius: 4px; }
        .dark .custom-scrollbar::-webkit-scrollbar-thumb { background-color: #475569; }
    </style>
    @stack('styles')
</head>
<body class="bg-gray-50 dark:bg-slate-900 text-gray-800 dark:text-slate-300 font-body">

    <div class="flex h-screen overflow-hidden" x-cloak>
        
        <!-- Sidebar -->
        @include('partials.admin.sidebar')

        <div class="flex-1 flex flex-col overflow-hidden ml-0 lg:ml-64 transition-all duration-300">
            
            <!-- Header -->
            @include('partials.admin.header')

            <!-- Mobile Sidebar -->
            @include('partials.admin.mobile-sidebar')

            <!-- Main Content -->
            <main class="flex-1 overflow-y-auto p-2 md:p-4 custom-scrollbar">
                
                <!-- Dynamic Page Header -->
                <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-6">
                    <h2 class="text-2xl font-bold text-gray-800 dark:text-white font-heading">
                        @yield('header', 'ড্যাশবোর্ড')
                    </h2>
                    <div class="flex space-x-2">
                        @yield('actions')
                    </div>
                </div>

                @yield('admin-content')
                
                <!-- Footer -->
                @include('partials.footer')
            </main>
        </div>
    </div>

    <!-- Logout Form -->
    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        @csrf
    </form>
    
    @stack('modals')

    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('adminApp', () => ({
                isDark: localStorage.getItem('darkMode') === 'true' || 
                        (!('darkMode' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches),
                isMobileMenuOpen: false,
                init() {
                    this.$watch('isDark', val => {
                        localStorage.setItem('darkMode', val);
                        val ? document.documentElement.classList.add('dark') : document.documentElement.classList.remove('dark');
                    });
                    if(this.isDark) document.documentElement.classList.add('dark');
                }
            }));
        });
    </script>

    @stack('scripts')
</body>
</html>