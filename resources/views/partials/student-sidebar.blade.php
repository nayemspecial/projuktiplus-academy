<!-- Sidebar -->
<div class="hidden md:flex md:flex-shrink-0 fixed h-full z-40">
    <div class="flex flex-col w-64 bg-white dark:bg-slate-800 border-r border-gray-200 dark:border-slate-700 h-full">
        <!-- Logo -->
        <div class="flex items-center justify-center h-16 px-4 border-b border-gray-200 dark:border-slate-700">
            <div class="flex items-center">
                <img src="{{ asset('images/logo.png') }}" alt="Logo" class="h-10 w-10">
                <span class="ml-3 text-xl font-bold text-blue-600 dark:text-blue-400">প্রযুক্তি প্লাস</span>
            </div>
        </div>
        
        <!-- Sidebar Menu -->
        <nav class="flex-1 overflow-y-auto py-4">
            <div class="space-y-1 px-2">
                <!-- Dashboard -->
                <a href="{{ route('student.dashboard') }}" class="sidebar-link flex items-center px-4 py-3 text-sm font-medium rounded-lg mx-2 {{ request()->routeIs('student.dashboard') ? 'active' : '' }}">
                    <i class="fas fa-tachometer-alt text-lg w-6 text-center"></i>
                    <span class="ml-3">ড্যাশবোর্ড</span>
                </a>
                
                <!-- My Courses -->
                <a href="{{ route('student.courses.index') }}" class="sidebar-link flex items-center px-4 py-3 text-sm font-medium rounded-lg mx-2 {{ request()->routeIs('student.courses.*') ? 'active' : '' }}">
                    <i class="fas fa-book text-lg w-6 text-center"></i>
                    <span class="ml-3">আমার কোর্সসমূহ</span>
                </a>
                
                <!-- My Quizzes -->
                <a href="{{ route('student.quizzes.index') }}" class="sidebar-link flex items-center px-4 py-3 text-sm font-medium rounded-lg mx-2 {{ request()->routeIs('student.quizzes.*') ? 'active' : '' }}">
                    <i class="fas fa-clipboard-list text-lg w-6 text-center"></i>
                    <span class="ml-3">আমার কুইজসমূহ</span>
                </a>
                
                <!-- Progress -->
                <a href="{{ route('student.progress.index') }}" class="sidebar-link flex items-center px-4 py-3 text-sm font-medium rounded-lg mx-2 {{ request()->routeIs('student.progress.*') ? 'active' : '' }}">
                    <i class="fas fa-chart-line text-lg w-6 text-center"></i>
                    <span class="ml-3">প্রোগ্রেস</span>
                </a>
                
                <!-- Certificates -->
                <a href="{{ route('student.certificates.index') }}" class="sidebar-link flex items-center px-4 py-3 text-sm font-medium rounded-lg mx-2 {{ request()->routeIs('student.certificates.*') ? 'active' : '' }}">
                    <i class="fas fa-certificate text-lg w-6 text-center"></i>
                    <span class="ml-3">সার্টিফিকেট</span>
                </a>
                
                <!-- Resources -->
                <a href="{{ route('student.resources.index') }}" class="sidebar-link flex items-center px-4 py-3 text-sm font-medium rounded-lg mx-2 {{ request()->routeIs('student.resources.*') ? 'active' : '' }}">
                    <i class="fas fa-file-download text-lg w-6 text-center"></i>
                    <span class="ml-3">রিসোর্সেস</span>
                </a>
                
                <!-- Notifications -->
                <a href="{{ route('student.notifications.index') }}" class="sidebar-link flex items-center px-4 py-3 text-sm font-medium rounded-lg mx-2 {{ request()->routeIs('student.notifications.*') ? 'active' : '' }}">
                    <i class="fas fa-bell text-lg w-6 text-center"></i>
                    <span class="ml-3">নোটিফিকেশন</span>
                </a>
            </div>
        </nav>
        
        <!-- User Profile & Logout -->
        <div class="p-4 border-t border-gray-200 dark:border-slate-700">
            <div class="flex items-center">
                <img src="{{ Auth::user()->avatar ?? 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=774&q=80' }}" alt="User" class="h-10 w-10 rounded-full">
                <div class="ml-3">
                    <p class="text-sm font-medium">{{ Auth::user()->name }}</p>
                    <p class="text-xs text-gray-500 dark:text-gray-400">শিক্ষার্থী</p>
                </div>
            </div>
            <form method="POST" action="{{ route('logout') }}" class="mt-3">
                @csrf
                <button type="submit" class="sidebar-link flex items-center px-2 py-2 text-sm font-medium rounded-lg w-full">
                    <i class="fas fa-sign-out-alt text-lg w-6 text-center"></i>
                    <span class="ml-3">লগ আউট</span>
                </button>
            </form>
        </div>
    </div>
</div>