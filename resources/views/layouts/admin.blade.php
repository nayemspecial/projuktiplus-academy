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
<html lang="bn">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    {{-- [FIX] ডার্ক মোড প্রি-লোডার (FOUC ফিক্স) --}}
    <script>
        if (localStorage.getItem('darkMode') === 'true' || (!('darkMode' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark');
        } else {
            document.documentElement.classList.remove('dark');
        }
    </script>

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
    
    {{-- Vite Assets --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Hind+Siliguri:wght@300;400;500;600;700&family=Kohinoor+Bangla:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <style>
        :root { --color-primary-600: {{ $primaryColor }}; }
        body { font-family: 'Kohinoor Bangla', sans-serif; letter-spacing: .5px; }
        h1, h2, h3, h4, h5, h6 { font-family: 'Hind Siliguri', sans-serif; }
        
        [x-cloak] { display: none !important; }
        
        .sidebar-link.active {
            background-color: rgba(59, 130, 246, 0.1);
            color: #3b82f6;
            border-left: 3px solid #3b82f6;
        }
        .dark .sidebar-link.active {
            background-color: rgba(59, 130, 246, 0.2);
            color: #60a5fa;
        }
        .sidebar-link:hover { background-color: rgba(59, 130, 246, 0.05); }
        .dark .sidebar-link:hover { background-color: rgba(59, 130, 246, 0.1); }

        /* SweetAlert Dark Mode Fix */
        .dark .swal2-popup { background: #1e293b; color: #e2e8f0; }
        .dark .swal2-title, .dark .swal2-content, .dark .swal2-html-container { color: #e2e8f0 !important; }
    </style>
    
    @stack('styles')
</head>
<body class="bg-gray-50 dark:bg-slate-900 text-gray-800 dark:text-slate-300 font-body min-h-screen"
      x-data="{ 
          isDark: localStorage.getItem('darkMode') === 'true' || (!('darkMode' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches),
          isMobileMenuOpen: false 
      }"
      x-init="$watch('isDark', val => {
          localStorage.setItem('darkMode', val);
          val ? document.documentElement.classList.add('dark') : document.documentElement.classList.remove('dark');
      })"
>

    <div class="flex h-screen overflow-hidden" x-cloak>
        
        <!-- Sidebar -->
        @include('partials.admin.sidebar')

        <div class="flex-1 flex flex-col overflow-hidden ml-0 lg:ml-64 transition-all duration-300">
            
            <!-- Header -->
            @include('partials.admin.header')

            <!-- Mobile Sidebar -->
            @include('partials.admin.mobile-sidebar')

            <!-- Main Content -->
            <main class="flex-1 overflow-y-auto p-2 md:p-4 custom-scrollbar flex flex-col">
                
                <!-- Dynamic Page Header -->
                <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-6">
                    <h2 class="text-2xl font-bold text-gray-800 dark:text-white font-heading">
                        @yield('header', 'ড্যাশবোর্ড')
                    </h2>
                    <div class="flex space-x-2">
                        @yield('actions')
                    </div>
                </div>

                <div class="flex-1">
                    @yield('admin-content')
                </div>
                
                <!-- Footer -->
                <div class="mt-auto pt-6">
                    @include('partials.footer')
                </div>
            </main>
        </div>
    </div>

    <!-- Logout Form -->
    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        @csrf
    </form>
    
    @stack('modals')

    {{-- Toast Notification Script --}}
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const Toast = window.Swal ? window.Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.onmouseenter = window.Swal.stopTimer;
                    toast.onmouseleave = window.Swal.resumeTimer;
                }
            }) : null;

            if (Toast) {
                @if(session('success')) Toast.fire({ icon: 'success', title: "{{ session('success') }}" }); @endif
                @if(session('error')) Toast.fire({ icon: 'error', title: "{{ session('error') }}" }); @endif
                @if(session('warning')) Toast.fire({ icon: 'warning', title: "{{ session('warning') }}" }); @endif
                @if(session('info')) Toast.fire({ icon: 'info', title: "{{ session('info') }}" }); @endif
                @if($errors->any()) Toast.fire({ icon: 'error', title: 'ফর্মের তথ্যগুলো চেক করুন।' }); @endif
            }
        });
    </script>

    @stack('scripts')
</body>
</html>