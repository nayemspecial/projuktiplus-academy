<aside class="hidden lg:flex flex-col w-64 h-full fixed inset-y-0 left-0 z-30 bg-white dark:bg-slate-800 border-r border-gray-200 dark:border-slate-700 transition-all duration-300">
    <!-- Logo -->
    <div class="flex items-center justify-center h-16 px-6 border-b border-gray-200 dark:border-slate-700 shrink-0">
        <span class="text-xl font-bold text-blue-600 dark:text-blue-400 flex items-center gap-2">
            <i class="fas fa-shield-alt"></i> অ্যাডমিন প্যানেল
        </span>
    </div>

    <!-- Navigation Links -->
    <nav class="flex-1 overflow-y-auto py-4 px-3 space-y-1 custom-scrollbar">
        
        <!-- Dashboard -->
        <a href="{{ route('admin.dashboard') }}" class="flex items-center px-4 py-3 text-sm font-medium rounded-lg transition-colors {{ request()->routeIs('admin.dashboard') ? 'bg-blue-50 text-blue-600 dark:bg-blue-900/20 dark:text-blue-400' : 'text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-slate-700' }}">
            <i class="fas fa-tachometer-alt w-5 text-center"></i>
            <span class="ml-3">ড্যাশবোর্ড</span>
        </a>

        <!-- User Management -->
        <div x-data="{ open: {{ request()->routeIs('admin.users.*') ? 'true' : 'false' }} }">
            <button @click="open = !open" class="flex items-center justify-between w-full px-4 py-3 text-sm font-medium rounded-lg transition-colors hover:bg-gray-100 dark:hover:bg-slate-700 {{ request()->routeIs('admin.users.*') ? 'text-blue-600 dark:text-blue-400' : 'text-gray-700 dark:text-gray-300' }}">
                <div class="flex items-center">
                    <i class="fas fa-users w-5 text-center"></i>
                    <span class="ml-3">ব্যবহারকারী</span>
                </div>
                <i class="fas fa-chevron-down text-xs transition-transform duration-200" :class="{'rotate-180': open}"></i>
            </button>
            <div x-show="open" x-collapse class="pl-11 space-y-1 mt-1">
                <a href="{{ route('admin.users.index') }}" class="block px-4 py-2 text-sm rounded-lg {{ request()->routeIs('admin.users.index') ? 'text-blue-600 dark:text-blue-400 bg-blue-50 dark:bg-slate-700/50' : 'text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-200' }}">সকল ব্যবহারকারী</a>
                <a href="{{ route('admin.users.students') }}" class="block px-4 py-2 text-sm rounded-lg {{ request()->routeIs('admin.users.students') ? 'text-blue-600 dark:text-blue-400 bg-blue-50 dark:bg-slate-700/50' : 'text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-200' }}">শিক্ষার্থী</a>
                <a href="{{ route('admin.users.instructors') }}" class="block px-4 py-2 text-sm rounded-lg {{ request()->routeIs('admin.users.instructors') ? 'text-blue-600 dark:text-blue-400 bg-blue-50 dark:bg-slate-700/50' : 'text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-200' }}">ইন্সট্রাক্টর</a>
                <a href="{{ route('admin.users.create') }}" class="block px-4 py-2 text-sm rounded-lg {{ request()->routeIs('admin.users.create') ? 'text-blue-600 dark:text-blue-400 bg-blue-50 dark:bg-slate-700/50' : 'text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-200' }}">নতুন যোগ করুন</a>
            </div>
        </div>

        <!-- Course Management -->
        <div x-data="{ open: {{ request()->routeIs('admin.courses.*') ? 'true' : 'false' }} }">
            <button @click="open = !open" class="flex items-center justify-between w-full px-4 py-3 text-sm font-medium rounded-lg transition-colors hover:bg-gray-100 dark:hover:bg-slate-700 {{ request()->routeIs('admin.courses.*') ? 'text-blue-600 dark:text-blue-400' : 'text-gray-700 dark:text-gray-300' }}">
                <div class="flex items-center">
                    <i class="fas fa-book w-5 text-center"></i>
                    <span class="ml-3">কোর্স ম্যানেজমেন্ট</span>
                </div>
                <i class="fas fa-chevron-down text-xs transition-transform duration-200" :class="{'rotate-180': open}"></i>
            </button>
            <div x-show="open" x-collapse class="pl-11 space-y-1 mt-1">
                <a href="{{ route('admin.courses.index') }}" class="block px-4 py-2 text-sm rounded-lg {{ request()->routeIs('admin.courses.index') ? 'text-blue-600 dark:text-blue-400 bg-blue-50 dark:bg-slate-700/50' : 'text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-200' }}">কোর্স তালিকা</a>
                <a href="{{ route('admin.courses.create') }}" class="block px-4 py-2 text-sm rounded-lg {{ request()->routeIs('admin.courses.create') ? 'text-blue-600 dark:text-blue-400 bg-blue-50 dark:bg-slate-700/50' : 'text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-200' }}">নতুন কোর্স</a>
            </div>
        </div>

        <!-- Quizzes & Questions -->
        <div x-data="{ open: {{ request()->routeIs('admin.quizzes.*') || request()->routeIs('admin.questions.*') ? 'true' : 'false' }} }">
            <button @click="open = !open" class="flex items-center justify-between w-full px-4 py-3 text-sm font-medium rounded-lg transition-colors hover:bg-gray-100 dark:hover:bg-slate-700 {{ request()->routeIs('admin.quizzes.*') || request()->routeIs('admin.questions.*') ? 'text-blue-600 dark:text-blue-400' : 'text-gray-700 dark:text-gray-300' }}">
                <div class="flex items-center">
                    <i class="fas fa-clipboard-question w-5 text-center"></i>
                    <span class="ml-3">কুইজ ও প্রশ্ন</span>
                </div>
                <i class="fas fa-chevron-down text-xs transition-transform duration-200" :class="{'rotate-180': open}"></i>
            </button>
            <div x-show="open" x-collapse class="pl-11 space-y-1 mt-1">
                <a href="{{ route('admin.quizzes.index') }}" class="block px-4 py-2 text-sm rounded-lg {{ request()->routeIs('admin.quizzes.*') ? 'text-blue-600 dark:text-blue-400 bg-blue-50 dark:bg-slate-700/50' : 'text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-200' }}">কুইজ তালিকা</a>
                <a href="{{ route('admin.questions.index') }}" class="block px-4 py-2 text-sm rounded-lg {{ request()->routeIs('admin.questions.*') ? 'text-blue-600 dark:text-blue-400 bg-blue-50 dark:bg-slate-700/50' : 'text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-200' }}">প্রশ্ন ব্যাংক</a>
            </div>
        </div>

        <!-- Enrollments -->
        <a href="{{ route('admin.enrollments.index') }}" class="flex items-center px-4 py-3 text-sm font-medium rounded-lg transition-colors {{ request()->routeIs('admin.enrollments.*') ? 'bg-blue-50 text-blue-600 dark:bg-blue-900/20 dark:text-blue-400' : 'text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-slate-700' }}">
            <i class="fas fa-id-card w-5 text-center"></i>
            <span class="ml-3">এনরোলমেন্ট</span>
        </a>

        <!-- Financials (Payments) -->
        <div x-data="{ open: {{ request()->routeIs('admin.payments.*') ? 'true' : 'false' }} }">
            <button @click="open = !open" class="flex items-center justify-between w-full px-4 py-3 text-sm font-medium rounded-lg transition-colors hover:bg-gray-100 dark:hover:bg-slate-700 {{ request()->routeIs('admin.payments.*') ? 'text-blue-600 dark:text-blue-400' : 'text-gray-700 dark:text-gray-300' }}">
                <div class="flex items-center">
                    <i class="fas fa-money-bill-wave w-5 text-center"></i>
                    <span class="ml-3">পেমেন্ট ও লেনদেন</span>
                </div>
                <i class="fas fa-chevron-down text-xs transition-transform duration-200" :class="{'rotate-180': open}"></i>
            </button>
            <div x-show="open" x-collapse class="pl-11 space-y-1 mt-1">
                <a href="{{ route('admin.payments.index') }}" class="block px-4 py-2 text-sm rounded-lg {{ request()->routeIs('admin.payments.index') ? 'text-blue-600 dark:text-blue-400 bg-blue-50 dark:bg-slate-700/50' : 'text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-200' }}">লেনদেন ইতিহাস</a>
                <a href="{{ route('admin.payments.gateways') }}" class="block px-4 py-2 text-sm rounded-lg {{ request()->routeIs('admin.payments.gateways') ? 'text-blue-600 dark:text-blue-400 bg-blue-50 dark:bg-slate-700/50' : 'text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-200' }}">পেমেন্ট গেটওয়ে</a>
            </div>
        </div>

        <!-- Certificates -->
        <div x-data="{ open: {{ request()->routeIs('admin.certificates.*') ? 'true' : 'false' }} }">
            <button @click="open = !open" class="flex items-center justify-between w-full px-4 py-3 text-sm font-medium rounded-lg transition-colors hover:bg-gray-100 dark:hover:bg-slate-700 {{ request()->routeIs('admin.certificates.*') ? 'text-blue-600 dark:text-blue-400' : 'text-gray-700 dark:text-gray-300' }}">
                <div class="flex items-center">
                    <i class="fas fa-certificate w-5 text-center"></i>
                    <span class="ml-3">সার্টিফিকেট</span>
                </div>
                <i class="fas fa-chevron-down text-xs transition-transform duration-200" :class="{'rotate-180': open}"></i>
            </button>
            <div x-show="open" x-collapse class="pl-11 space-y-1 mt-1">
                <a href="{{ route('admin.certificates.index') }}" class="block px-4 py-2 text-sm rounded-lg {{ request()->routeIs('admin.certificates.index') ? 'text-blue-600 dark:text-blue-400 bg-blue-50 dark:bg-slate-700/50' : 'text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-200' }}">ইস্যুকৃত সার্টিফিকেট</a>
                <a href="{{ route('admin.certificates.templates') }}" class="block px-4 py-2 text-sm rounded-lg {{ request()->routeIs('admin.certificates.templates') ? 'text-blue-600 dark:text-blue-400 bg-blue-50 dark:bg-slate-700/50' : 'text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-200' }}">টেমপ্লেট</a>
            </div>
        </div>

        <!-- Communication (Email Templates) -->
        <a href="{{ route('admin.email-templates.index') }}" class="flex items-center px-4 py-3 text-sm font-medium rounded-lg transition-colors {{ request()->routeIs('admin.email-templates.*') ? 'bg-blue-50 text-blue-600 dark:bg-blue-900/20 dark:text-blue-400' : 'text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-slate-700' }}">
            <i class="fas fa-envelope-open-text w-5 text-center"></i>
            <span class="ml-3">ইমেইল টেমপ্লেট</span>
        </a>

        <!-- Reports & Analytics -->
        <div x-data="{ open: {{ request()->routeIs('admin.analytics') || request()->routeIs('admin.reports.*') ? 'true' : 'false' }} }">
            <button @click="open = !open" class="flex items-center justify-between w-full px-4 py-3 text-sm font-medium rounded-lg transition-colors hover:bg-gray-100 dark:hover:bg-slate-700 {{ request()->routeIs('admin.analytics') || request()->routeIs('admin.reports.*') ? 'text-blue-600 dark:text-blue-400' : 'text-gray-700 dark:text-gray-300' }}">
                <div class="flex items-center">
                    <i class="fas fa-chart-line w-5 text-center"></i>
                    <span class="ml-3">রিপোর্ট ও অ্যানালিটিক্স</span>
                </div>
                <i class="fas fa-chevron-down text-xs transition-transform duration-200" :class="{'rotate-180': open}"></i>
            </button>
            <div x-show="open" x-collapse class="pl-11 space-y-1 mt-1">
                <a href="{{ route('admin.analytics') }}" class="block px-4 py-2 text-sm rounded-lg {{ request()->routeIs('admin.analytics') ? 'text-blue-600 dark:text-blue-400 bg-blue-50 dark:bg-slate-700/50' : 'text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-200' }}">ওভারভিউ</a>
                <a href="{{ route('admin.reports.revenue') }}" class="block px-4 py-2 text-sm rounded-lg {{ request()->routeIs('admin.reports.revenue') ? 'text-blue-600 dark:text-blue-400 bg-blue-50 dark:bg-slate-700/50' : 'text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-200' }}">রেভিনিউ রিপোর্ট</a>
                <a href="{{ route('admin.reports.courses') }}" class="block px-4 py-2 text-sm rounded-lg {{ request()->routeIs('admin.reports.courses') ? 'text-blue-600 dark:text-blue-400 bg-blue-50 dark:bg-slate-700/50' : 'text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-200' }}">কোর্স রিপোর্ট</a>
            </div>
        </div>
        
        <!-- Settings [UPDATED WITH SEO] -->
        <div x-data="{ open: {{ request()->routeIs('admin.settings.*') ? 'true' : 'false' }} }">
            <button @click="open = !open" class="flex items-center justify-between w-full px-4 py-3 text-sm font-medium rounded-lg transition-colors hover:bg-gray-100 dark:hover:bg-slate-700 {{ request()->routeIs('admin.settings.*') ? 'text-blue-600 dark:text-blue-400' : 'text-gray-700 dark:text-gray-300' }}">
                <div class="flex items-center">
                    <i class="fas fa-cog w-5 text-center"></i>
                    <span class="ml-3">সেটিংস</span>
                </div>
                <i class="fas fa-chevron-down text-xs transition-transform duration-200" :class="{'rotate-180': open}"></i>
            </button>
            <div x-show="open" x-collapse class="pl-11 space-y-1 mt-1">
                <a href="{{ route('admin.settings.general') }}" class="block px-4 py-2 text-sm rounded-lg {{ request()->routeIs('admin.settings.general') ? 'text-blue-600 dark:text-blue-400 bg-blue-50 dark:bg-slate-700/50' : 'text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-200' }}">সাধারণ সেটিংস</a>
                
                <!-- SEO Link Added -->
                <a href="{{ route('admin.settings.seo') }}" class="block px-4 py-2 text-sm rounded-lg {{ request()->routeIs('admin.settings.seo') ? 'text-blue-600 dark:text-blue-400 bg-blue-50 dark:bg-slate-700/50' : 'text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-200' }}">এসইও (SEO)</a>
                
                <a href="{{ route('admin.settings.appearance') }}" class="block px-4 py-2 text-sm rounded-lg {{ request()->routeIs('admin.settings.appearance') ? 'text-blue-600 dark:text-blue-400 bg-blue-50 dark:bg-slate-700/50' : 'text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-200' }}">থিম ও ডিজাইন</a>
            </div>
        </div>

    </nav>

    <!-- User Info & Logout -->
    <div class="p-4 border-t border-gray-200 dark:border-slate-700 shrink-0">
        <div class="flex items-center mb-3">
            <img src="{{ Auth::user()->avatar_url ?? 'https://ui-avatars.com/api/?name='.urlencode(Auth::user()->name).'&background=random' }}" class="h-10 w-10 rounded-full bg-gray-200 object-cover">
            <div class="ml-3 overflow-hidden">
                <p class="text-sm font-medium text-gray-800 dark:text-white truncate">{{ Auth::user()->name }}</p>
                <p class="text-xs text-gray-500 dark:text-gray-400 truncate">{{ Auth::user()->email }}</p>
            </div>
        </div>
        <button @click="document.getElementById('logout-form').submit()" class="w-full flex items-center justify-center px-4 py-2 text-sm text-red-600 hover:bg-red-50 dark:hover:bg-red-900/20 rounded-lg transition-colors">
            <i class="fas fa-sign-out-alt mr-2"></i> লগ আউট
        </button>
    </div>
</aside>