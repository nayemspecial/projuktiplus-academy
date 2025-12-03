<!-- Sidebar (Desktop) -->
<div class="hidden md:flex md:flex-shrink-0 fixed h-full z-40">
    <div class="flex flex-col w-64 bg-white dark:bg-slate-800 border-r border-gray-200 dark:border-slate-700 h-full transition-colors duration-300">
        
        <!-- Logo Area -->
        <div class="flex items-center justify-center h-16 px-4 border-b border-gray-200 dark:border-slate-700 bg-white dark:bg-slate-800">
            <a href="{{ route('student.dashboard') }}" class="flex items-center gap-2 group">
                <!-- লোগো লোকাল থেকে লোড হবে -->
                @if(\App\Models\Setting::get('site_logo'))
                    <img src="{{ asset('storage/' . \App\Models\Setting::get('site_logo')) }}" alt="Logo" class="h-8 w-auto transition-transform group-hover:scale-105"> <h2 class="text-lg font-semibold">প্রযুক্তি প্লাস</h2>
                @else
                    <div class="w-8 h-8 bg-blue-600 rounded-lg flex items-center justify-center text-white font-bold shadow-md group-hover:scale-105 transition-transform">
                        P
                    </div>
                    <span class="ml-2 text-xl font-bold text-blue-600 dark:text-blue-400 font-heading">
                        {{ \App\Models\Setting::get('site_name', 'প্রযুক্তি প্লাস') }}
                    </span>
                @endif
            </a>
        </div>
        
        <!-- Sidebar Menu -->
        <nav class="flex-1 overflow-y-auto py-4 custom-scrollbar bg-gray-50/50 dark:bg-slate-800">
            <div class="space-y-1 px-3">
                
                <!-- Dashboard -->
                <a href="{{ route('student.dashboard') }}" 
                   class="flex items-center px-4 py-3 text-sm font-medium rounded-lg transition-all duration-200 group 
                   {{ request()->routeIs('student.dashboard') 
                       ? 'bg-blue-50 text-blue-600 dark:bg-blue-900/20 dark:text-blue-400 shadow-sm' 
                       : 'text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-slate-700' }}">
                    <i class="fas fa-tachometer-alt text-lg w-6 text-center transition-transform group-hover:scale-110"></i>
                    <span class="ml-3">ড্যাশবোর্ড</span>
                </a>
                
                <!-- My Courses -->
                <a href="{{ route('student.courses.index') }}" 
                   class="flex items-center px-4 py-3 text-sm font-medium rounded-lg transition-all duration-200 group
                   {{ request()->routeIs('student.courses.*') 
                       ? 'bg-blue-50 text-blue-600 dark:bg-blue-900/20 dark:text-blue-400 shadow-sm' 
                       : 'text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-slate-700' }}">
                    <i class="fas fa-book text-lg w-6 text-center transition-transform group-hover:scale-110"></i>
                    <span class="ml-3">আমার কোর্সসমূহ</span>
                </a>
                
                <!-- My Quizzes -->
                <a href="{{ route('student.quizzes.index') }}" 
                   class="flex items-center px-4 py-3 text-sm font-medium rounded-lg transition-all duration-200 group
                   {{ request()->routeIs('student.quizzes.*') 
                       ? 'bg-blue-50 text-blue-600 dark:bg-blue-900/20 dark:text-blue-400 shadow-sm' 
                       : 'text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-slate-700' }}">
                    <i class="fas fa-clipboard-list text-lg w-6 text-center transition-transform group-hover:scale-110"></i>
                    <span class="ml-3">আমার কুইজসমূহ</span>
                </a>
                
                <!-- Progress -->
                <a href="{{ route('student.progress.index') }}" 
                   class="flex items-center px-4 py-3 text-sm font-medium rounded-lg transition-all duration-200 group
                   {{ request()->routeIs('student.progress.*') 
                       ? 'bg-blue-50 text-blue-600 dark:bg-blue-900/20 dark:text-blue-400 shadow-sm' 
                       : 'text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-slate-700' }}">
                    <i class="fas fa-chart-line text-lg w-6 text-center transition-transform group-hover:scale-110"></i>
                    <span class="ml-3">প্রোগ্রেস</span>
                </a>
                
                <!-- Certificates -->
                <a href="{{ route('student.certificates.index') }}" 
                   class="flex items-center px-4 py-3 text-sm font-medium rounded-lg transition-all duration-200 group
                   {{ request()->routeIs('student.certificates.*') 
                       ? 'bg-blue-50 text-blue-600 dark:bg-blue-900/20 dark:text-blue-400 shadow-sm' 
                       : 'text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-slate-700' }}">
                    <i class="fas fa-certificate text-lg w-6 text-center transition-transform group-hover:scale-110"></i>
                    <span class="ml-3">সার্টিফিকেট</span>
                </a>
                
                <!-- Resources -->
                <a href="{{ route('student.resources.index') }}" 
                   class="flex items-center px-4 py-3 text-sm font-medium rounded-lg transition-all duration-200 group
                   {{ request()->routeIs('student.resources.*') 
                       ? 'bg-blue-50 text-blue-600 dark:bg-blue-900/20 dark:text-blue-400 shadow-sm' 
                       : 'text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-slate-700' }}">
                    <i class="fas fa-file-download text-lg w-6 text-center transition-transform group-hover:scale-110"></i>
                    <span class="ml-3">রিসোর্সেস</span>
                </a>
                
                <!-- Notifications -->
                <a href="{{ route('student.notifications.index') }}" 
                   class="flex items-center px-4 py-3 text-sm font-medium rounded-lg transition-all duration-200 group
                   {{ request()->routeIs('student.notifications.*') 
                       ? 'bg-blue-50 text-blue-600 dark:bg-blue-900/20 dark:text-blue-400 shadow-sm' 
                       : 'text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-slate-700' }}">
                    <i class="fas fa-bell text-lg w-6 text-center transition-transform group-hover:scale-110"></i>
                    <span class="ml-3">নোটিফিকেশন</span>
                </a>
            </div>
        </nav>
        
        <!-- User Profile & Logout -->
        <div class="p-4 border-t border-gray-200 dark:border-slate-700 bg-white dark:bg-slate-800">
            <div class="flex items-center mb-3">
                <!-- [FIXED] Avatar Logic from Model Accessor -->
                <img src="{{ Auth::user()->avatar_url }}" 
                     alt="{{ Auth::user()->name }}" 
                     class="h-10 w-10 rounded-full object-cover border-2 border-gray-100 dark:border-slate-600">
                     
                <div class="ml-3 overflow-hidden">
                    <p class="text-sm font-bold text-gray-800 dark:text-white truncate">{{ Auth::user()->name }}</p>
                    <p class="text-xs text-gray-500 dark:text-gray-400 truncate">শিক্ষার্থী</p>
                </div>
            </div>
            
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="flex items-center justify-center w-full px-4 py-2 text-sm font-medium text-red-600 bg-red-50 dark:bg-red-900/10 hover:bg-red-100 dark:hover:bg-red-900/30 rounded-lg transition-colors duration-200">
                    <i class="fas fa-sign-out-alt mr-2"></i>
                    <span>লগ আউট</span>
                </button>
            </form>
        </div>
    </div>
</div>