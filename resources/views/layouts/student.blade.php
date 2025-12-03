<!DOCTYPE html>
<html lang="bn">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Student Dashboard') - ProjuktiPlus LMS</title>
    
    {{-- [FIX] ডার্ক মোড প্রি-লোডার --}}
    <script>
        if (localStorage.getItem('darkMode') === 'true' || (!('darkMode' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark');
        } else {
            document.documentElement.classList.remove('dark');
        }
    </script>
    
    {{-- Vite Assets --}}
    @vite(['resources/css/tailwind.css', 'resources/js/app.js'])
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        body { font-family: 'Kohinoor Bangla', sans-serif; letter-spacing: .5px; }
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
<body class="bg-gray-50 dark:bg-slate-900 text-gray-800 dark:text-slate-300 min-h-screen font-body"
      x-data="{ 
          isDark: localStorage.getItem('darkMode') === 'true' || (!('darkMode' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches),
          isMobileMenuOpen: false 
      }"
      x-init="$watch('isDark', val => {
          localStorage.setItem('darkMode', val);
          val ? document.documentElement.classList.add('dark') : document.documentElement.classList.remove('dark');
      })"
>
    <!-- Mobile Sidebar Overlay -->
    <div x-show="isMobileMenuOpen" class="relative z-50 md:hidden" role="dialog" aria-modal="true">
        <div x-show="isMobileMenuOpen" 
             x-transition:enter="transition-opacity ease-linear duration-300" 
             x-transition:enter-start="opacity-0" 
             x-transition:enter-end="opacity-100" 
             x-transition:leave="transition-opacity ease-linear duration-300" 
             x-transition:leave-start="opacity-100" 
             x-transition:leave-end="opacity-0" 
             class="fixed inset-0 bg-gray-900/80 backdrop-blur-sm" 
             @click="isMobileMenuOpen = false"></div>

        <div class="fixed inset-0 flex">
            <div x-show="isMobileMenuOpen" 
                 x-transition:enter="transition ease-in-out duration-300 transform" 
                 x-transition:enter-start="-translate-x-full" 
                 x-transition:enter-end="translate-x-0" 
                 x-transition:leave="transition ease-in-out duration-300 transform" 
                 x-transition:leave-start="translate-x-0" 
                 x-transition:leave-end="-translate-x-full" 
                 class="relative mr-16 flex w-full max-w-xs flex-1">
                
                <div class="absolute left-full top-0 flex w-16 justify-center pt-5">
                    <button type="button" class="-m-2.5 p-2.5 text-white" @click="isMobileMenuOpen = false">
                        <span class="sr-only">Close sidebar</span>
                        <i class="fas fa-times text-2xl"></i>
                    </button>
                </div>

                <!-- Mobile Sidebar Content -->
                <div class="flex grow flex-col gap-y-5 overflow-y-auto bg-white dark:bg-slate-800 px-6 pb-4 ring-1 ring-white/10">
                    <div class="flex h-16 shrink-0 items-center border-b border-gray-200 dark:border-slate-700">
                         <a href="{{ route('student.dashboard') }}" class="flex items-center gap-2">
                            <div class="w-8 h-8 bg-blue-600 rounded flex items-center justify-center text-white font-bold">P</div>
                            <span class="text-lg font-bold text-blue-600 dark:text-blue-400">প্রযুক্তি প্লাস</span>
                        </a>
                    </div>
                    <nav class="flex flex-1 flex-col">
                        <ul role="list" class="flex flex-1 flex-col gap-y-4">
                            <li>
                                <a href="{{ route('student.dashboard') }}" class="group flex gap-x-3 rounded-md p-2 text-sm font-semibold leading-6 {{ request()->routeIs('student.dashboard') ? 'bg-blue-50 dark:bg-slate-700 text-blue-600 dark:text-blue-400' : 'text-gray-700 dark:text-gray-300 hover:text-blue-600 hover:bg-gray-50 dark:hover:bg-slate-700' }}">
                                    <i class="fas fa-tachometer-alt w-6 text-center text-lg"></i>
                                    ড্যাশবোর্ড
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('student.courses.index') }}" class="group flex gap-x-3 rounded-md p-2 text-sm font-semibold leading-6 {{ request()->routeIs('student.courses.*') ? 'bg-blue-50 dark:bg-slate-700 text-blue-600 dark:text-blue-400' : 'text-gray-700 dark:text-gray-300 hover:text-blue-600 hover:bg-gray-50 dark:hover:bg-slate-700' }}">
                                    <i class="fas fa-book w-6 text-center text-lg"></i>
                                    আমার কোর্সসমূহ
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('student.quizzes.index') }}" class="group flex gap-x-3 rounded-md p-2 text-sm font-semibold leading-6 {{ request()->routeIs('student.quizzes.*') ? 'bg-blue-50 dark:bg-slate-700 text-blue-600 dark:text-blue-400' : 'text-gray-700 dark:text-gray-300 hover:text-blue-600 hover:bg-gray-50 dark:hover:bg-slate-700' }}">
                                    <i class="fas fa-clipboard-list w-6 text-center text-lg"></i>
                                    আমার কুইজসমূহ
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('student.progress.index') }}" class="group flex gap-x-3 rounded-md p-2 text-sm font-semibold leading-6 {{ request()->routeIs('student.progress.*') ? 'bg-blue-50 dark:bg-slate-700 text-blue-600 dark:text-blue-400' : 'text-gray-700 dark:text-gray-300 hover:text-blue-600 hover:bg-gray-50 dark:hover:bg-slate-700' }}">
                                    <i class="fas fa-chart-line w-6 text-center text-lg"></i>
                                    প্রোগ্রেস
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('student.certificates.index') }}" class="group flex gap-x-3 rounded-md p-2 text-sm font-semibold leading-6 {{ request()->routeIs('student.certificates.*') ? 'bg-blue-50 dark:bg-slate-700 text-blue-600 dark:text-blue-400' : 'text-gray-700 dark:text-gray-300 hover:text-blue-600 hover:bg-gray-50 dark:hover:bg-slate-700' }}">
                                    <i class="fas fa-certificate w-6 text-center text-lg"></i>
                                    সার্টিফিকেট
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('student.resources.index') }}" class="group flex gap-x-3 rounded-md p-2 text-sm font-semibold leading-6 {{ request()->routeIs('student.resources.*') ? 'bg-blue-50 dark:bg-slate-700 text-blue-600 dark:text-blue-400' : 'text-gray-700 dark:text-gray-300 hover:text-blue-600 hover:bg-gray-50 dark:hover:bg-slate-700' }}">
                                    <i class="fas fa-file-download w-6 text-center text-lg"></i>
                                    রিসোর্সেস
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('student.notifications.index') }}" class="group flex gap-x-3 rounded-md p-2 text-sm font-semibold leading-6 {{ request()->routeIs('student.notifications.*') ? 'bg-blue-50 dark:bg-slate-700 text-blue-600 dark:text-blue-400' : 'text-gray-700 dark:text-gray-300 hover:text-blue-600 hover:bg-gray-50 dark:hover:bg-slate-700' }}">
                                    <i class="fas fa-bell w-6 text-center text-lg"></i>
                                    নোটিফিকেশন
                                </a>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>

    <!-- Sidebar (Desktop) -->
    @include('partials.student-sidebar')
    
    <div class="flex-1 flex flex-col overflow-hidden ml-0 md:ml-64 transition-all duration-300 h-screen">
        <!-- Header -->
        @include('partials.student-header')
        
        <!-- Main Content Area -->
        <!-- flex flex-col এবং min-h-0 দেওয়া হয়েছে যাতে ফুটার নিচে থাকে -->
        <main class="flex-1 overflow-y-auto bg-gray-50 dark:bg-slate-900 flex flex-col custom-scrollbar relative">
            
            <!-- Page Content -->
            <!-- flex-1 দেওয়া হয়েছে যাতে এটি অবশিষ্ট সব জায়গা নিয়ে নেয় এবং ফুটারকে নিচে ঠেলে দেয় -->
            <div class="flex-1 p-4 md:p-6">
                @yield('student-content')
            </div>
            
            <!-- Footer (Sticky behavior via Flexbox) -->
            @include('partials.footer')
        </main>
    </div>

    <!-- Logout Form -->
    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        @csrf
    </form>

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