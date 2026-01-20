<!DOCTYPE html>
@php
    use App\Models\Setting;
    
    // ডাইনামিক সেটিংস লোড
    $siteName = Setting::get('site_name', 'ProjuktiPlus LMS');
    $siteFavicon = Setting::get('site_favicon');
    $primaryColor = Setting::get('primary_color', '#4F46E5');
@endphp
<html lang="bn" x-data="instructorApp()" x-init="init()" :class="{'dark': isDark}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <title>@yield('title', 'Instructor Dashboard') - {{ $siteName }}</title>
    
    @if($siteFavicon)
        <link rel="icon" type="image/png" href="{{ asset('storage/' . $siteFavicon) }}">
    @else
        <link rel="icon" href="{{ asset('favicon.ico') }}">
    @endif
    
    {{-- [FIX] FOUC (সাদা ঝলকানি) প্রতিরোধক --}}
    <script>
        const isDark = localStorage.getItem('darkMode') !== 'false';
        if (isDark) {
            document.documentElement.classList.add('dark');
        } else {
            document.documentElement.classList.remove('dark');
        }
    </script>
    
    {{-- Vite Assets --}}
    @vite(['resources/css/tailwind.css', 'resources/js/app.js'])
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <link href="https://fonts.googleapis.com/css2?family=Hind+Siliguri:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <style>
        /* [UPDATED] Dynamic Primary Color */
        :root { --color-primary-600: {{ $primaryColor }}; }

        body { font-family: 'Kohinoor Bangla', 'Hind Siliguri', sans-serif; letter-spacing: .5px; }
        h1, h2, h3, h4, h5, h6 { font-family: 'Hind Siliguri', sans-serif; }
        [x-cloak] { display: none !important; }
        
        .sidebar-link.active {
            background-color: rgba(59, 130, 246, 0.1);
            color: var(--color-primary-600);
            border-left: 3px solid var(--color-primary-600);
        }
        .dark .sidebar-link.active {
            background-color: rgba(59, 130, 246, 0.2);
            color: #60a5fa;
        }
        .sidebar-link:hover { background-color: rgba(59, 130, 246, 0.05); }
        .dark .sidebar-link:hover { background-color: rgba(59, 130, 246, 0.1); }

        .dark .swal2-popup { background: #1e293b; color: #e2e8f0; }
        .dark .swal2-title { color: #fff !important; }
    </style>
    
    @stack('styles') 
</head>
<body class="bg-gray-50 dark:bg-slate-900 text-gray-800 dark:text-slate-300 font-body h-screen overflow-hidden">
    
    <div class="flex h-full">
        
        @include('partials.instructor-sidebar')

        @include('partials.instructor-mobile-sidebar')

        <div class="flex-1 flex flex-col overflow-hidden ml-0 xl:ml-64 transition-all duration-300 h-full">
            
            @include('partials.instructor-header')

            <main class="flex-1 overflow-y-auto bg-gray-50 dark:bg-slate-900 custom-scrollbar">
                <div class="flex flex-col min-h-full">
                    
                    <div class="flex-1 p-3 md:p-4">
                        @yield('instructor-content')
                    </div>

                    <div class="mt-auto">
                        @include('partials.footer')
                    </div>
                </div>
            </main>
        </div>
    </div>

    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        @csrf
    </form>
    
    @stack('modals')

    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('instructorApp', () => ({
                isDark: localStorage.getItem('darkMode') !== 'false',
                isMobileMenuOpen: false,
                
                init() {
                    this.$watch('isDark', val => {
                        localStorage.setItem('darkMode', val);
                        if(val) {
                            document.documentElement.classList.add('dark');
                        } else {
                            document.documentElement.classList.remove('dark');
                        }
                    });
                    if(this.isDark) document.documentElement.classList.add('dark');
                },
                
                logout() {
                    document.getElementById('logout-form').submit();
                }
            }));
        });

        // Toast Notification
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