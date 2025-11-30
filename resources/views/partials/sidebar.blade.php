<!-- Sidebar -->
<div class="sidebar bg-white dark:bg-slate-800 shadow-md w-20 md:w-20 lg:w-20 xl:w-64 fixed h-full transition-all duration-300 z-50">
    <div class="flex flex-col h-full">
        <!-- Logo -->
        <div class="flex items-center justify-center lg:justify-start h-16 px-4 border-b border-gray-200 dark:border-slate-700">
            <div class="flex items-center">
                <img src="{{ asset('images/logo.jpg') }}" alt="Logo" class="h-10 w-10">
                <span class="sidebar-text hidden xl:block ml-3 text-xl font-bold text-blue-600 dark:text-blue-400">প্রযুক্তি প্লাস</span>
            </div>
        </div>
        
        <!-- Sidebar Menu -->
        <nav class="flex-1 overflow-y-auto py-4">
            <div class="space-y-1 px-2">
                <!-- Dashboard -->
                <a href="#" @click="activeTab = 'dashboard'" class="sidebar-link flex items-center px-4 py-3 text-sm font-medium rounded-lg mx-2 group" :class="{'active': activeTab === 'dashboard'}">
                    <i class="fas fa-tachometer-alt text-lg w-6 text-center"></i>
                    <span class="sidebar-text hidden xl:block ml-3">ড্যাশবোর্ড</span>
                </a>
                
                <!-- Course Management -->
                <div x-data="{ open: activeTab === 'courses' || activeTab === 'sections' || activeTab === 'lessons' || activeTab === 'quizzes' }">
                    <button @click="open = !open" class="sidebar-link flex items-center justify-between w-full px-4 py-3 text-sm font-medium rounded-lg mx-2 group" :class="{'active': activeTab === 'courses' || activeTab === 'sections' || activeTab === 'lessons' || activeTab === 'quizzes'}">
                        <div class="flex items-center">
                            <i class="fas fa-book text-lg w-6 text-center"></i>
                            <span class="sidebar-text hidden xl:block ml-3">কোর্স ম্যানেজমেন্ট</span>
                        </div>
                        <i class="fas fa-chevron-down text-xs sidebar-text hidden xl:block transition-transform duration-200" :class="{'transform rotate-180': open}"></i>
                    </button>
                    
                    <div x-show="open" x-collapse class="pl-4 mt-1 space-y-1">
                        <a href="{{ route('admin.courses.index') }}" @click="activeTab = 'courses'" class="flex items-center px-4 py-2 text-sm font-medium rounded-lg group" :class="{'text-blue-600 dark:text-blue-400': activeTab === 'courses', 'text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-white': activeTab !== 'courses'}">
                            <i class="fas fa-list-ul text-sm w-6 text-center"></i>
                            <span class="sidebar-text hidden xl:block ml-3">সকল কোর্স</span>
                        </a>
                        <a href="{{ route('admin.sections.index') }}" @click="activeTab = 'sections'" class="flex items-center px-4 py-2 text-sm font-medium rounded-lg group" :class="{'text-blue-600 dark:text-blue-400': activeTab === 'sections', 'text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-white': activeTab !== 'sections'}">
                            <i class="fas fa-layer-group text-sm w-6 text-center"></i>
                            <span class="sidebar-text hidden xl:block ml-3">সেকশনসমূহ</span>
                        </a>
                        <a href="{{ route('admin.lessons.index') }}" @click="activeTab = 'lessons'" class="flex items-center px-4 py-2 text-sm font-medium rounded-lg group" :class="{'text-blue-600 dark:text-blue-400': activeTab === 'lessons', 'text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-white': activeTab !== 'lessons'}">
                            <i class="fas fa-play-circle text-sm w-6 text-center"></i>
                            <span class="sidebar-text hidden xl:block ml-3">লেসনসমূহ</span>
                        </a>
                        <a href="{{ route('admin.quizzes.index') }}" @click="activeTab = 'quizzes'" class="flex items-center px-4 py-2 text-sm font-medium rounded-lg group" :class="{'text-blue-600 dark:text-blue-400': activeTab === 'quizzes', 'text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-white': activeTab !== 'quizzes'}">
                            <i class="fas fa-question-circle text-sm w-6 text-center"></i>
                            <span class="sidebar-text hidden xl:block ml-3">কুইজ</span>
                        </a>
                        <a href="{{ route('admin.questions.index') }}" @click="activeTab = 'quizzes'" class="flex items-center px-4 py-2 text-sm font-medium rounded-lg group" :class="{'text-blue-600 dark:text-blue-400': activeTab === 'quizzes', 'text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-white': activeTab !== 'quizzes'}">
                            <i class="fas fa-question-circle text-sm w-6 text-center"></i>
                            <span class="sidebar-text hidden xl:block ml-3">প্রশ্ন</span>
                        </a>
                        <a href="{{ route('admin.answers.index') }}" @click="activeTab = 'quizzes'" class="flex items-center px-4 py-2 text-sm font-medium rounded-lg group" :class="{'text-blue-600 dark:text-blue-400': activeTab === 'quizzes', 'text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-white': activeTab !== 'quizzes'}">
                            <i class="fas fa-question-circle text-sm w-6 text-center"></i>
                            <span class="sidebar-text hidden xl:block ml-3">উত্তর</span>
                        </a>
                        <a href="#" @click="activeTab = 'quizzes'" class="flex items-center px-4 py-2 text-sm font-medium rounded-lg group" :class="{'text-blue-600 dark:text-blue-400': activeTab === 'quizzes', 'text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-white': activeTab !== 'quizzes'}">
                            <i class="fas fa-question-circle text-sm w-6 text-center"></i>
                            <span class="sidebar-text hidden xl:block ml-3">অ্যাসাইনমেন্ট</span>
                        </a>
                    </div>
                </div>
                
                <!-- User Management -->
                <div x-data="{ open: activeTab === 'students' || activeTab === 'instructors' || activeTab === 'enrollments' }">
                    <button @click="open = !open" class="sidebar-link flex items-center justify-between w-full px-4 py-3 text-sm font-medium rounded-lg mx-2 group" :class="{'active': activeTab === 'students' || activeTab === 'instructors' || activeTab === 'enrollments'}">
                        <div class="flex items-center">
                            <i class="fas fa-users text-lg w-6 text-center"></i>
                            <span class="sidebar-text hidden xl:block ml-3">ইউজার ম্যানেজমেন্ট</span>
                        </div>
                        <i class="fas fa-chevron-down text-xs sidebar-text hidden xl:block transition-transform duration-200" :class="{'transform rotate-180': open}"></i>
                    </button>
                    
                    <div x-show="open" x-collapse class="pl-4 mt-1 space-y-1">
                        <!-- শিক্ষার্থীরা -->
                        <a href="{{ route('admin.users.students') }}"
                        class="flex items-center px-4 py-2 text-sm font-medium rounded-lg group
                        {{ request()->routeIs('admin.users.students') ? 'text-blue-600 dark:text-blue-400' : 'text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-white' }}">
                            <i class="fas fa-user-graduate text-sm w-6 text-center"></i>
                            <span class="sidebar-text hidden xl:block ml-3">সকল শিক্ষার্থী</span>
                        </a>

                        <!-- ইন্সট্রাক্টররা -->
                        <a href="{{ route('admin.users.instructors') }}"
                        class="flex items-center px-4 py-2 text-sm font-medium rounded-lg group
                        {{ request()->routeIs('admin.users.instructors') ? 'text-blue-600 dark:text-blue-400' : 'text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-white' }}">
                            <i class="fas fa-chalkboard-teacher text-sm w-6 text-center"></i>
                            <span class="sidebar-text hidden xl:block ml-3">সকল ইন্সট্রাক্টর</span>
                        </a>
                        <a href="{{ route('admin.enrollments.index') }}" @click="activeTab = 'enrollments'" class="flex items-center px-4 py-2 text-sm font-medium rounded-lg group" :class="{'text-blue-600 dark:text-blue-400': activeTab === 'enrollments', 'text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-white': activeTab !== 'enrollments'}">
                            <i class="fas fa-clipboard-list text-sm w-6 text-center"></i>
                            <span class="sidebar-text hidden xl:block ml-3">এনরোলমেন্ট</span>
                        </a>
                    </div>
                </div>
                
                <!-- Settings -->
                <div x-data="{ open: activeTab === 'payment' || activeTab === 'certificate' || activeTab === 'email' }">
                    <button @click="open = !open" class="sidebar-link flex items-center justify-between w-full px-4 py-3 text-sm font-medium rounded-lg mx-2 group" :class="{'active': activeTab === 'payment' || activeTab === 'certificate' || activeTab === 'email'}">
                        <div class="flex items-center">
                            <i class="fas fa-cog text-lg w-6 text-center"></i>
                            <span class="sidebar-text hidden xl:block ml-3">সেটিংস</span>
                        </div>
                        <i class="fas fa-chevron-down text-xs sidebar-text hidden xl:block transition-transform duration-200" :class="{'transform rotate-180': open}"></i>
                    </button>
                    
                    <div x-show="open" x-collapse class="pl-4 mt-1 space-y-1">
                        <a href="{{ route('admin.payments.index') }}" @click="activeTab = 'payment'" class="flex items-center px-4 py-2 text-sm font-medium rounded-lg group" :class="{'text-blue-600 dark:text-blue-400': activeTab === 'payment', 'text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-white': activeTab !== 'payment'}">
                            <i class="fas fa-credit-card text-sm w-6 text-center"></i>
                            <span class="sidebar-text hidden xl:block ml-3">পেমেন্ট গেটওয়ে</span>
                        </a>
                        <a href="#" @click="activeTab = 'certificate'" class="flex items-center px-4 py-2 text-sm font-medium rounded-lg group" :class="{'text-blue-600 dark:text-blue-400': activeTab === 'certificate', 'text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-white': activeTab !== 'certificate'}">
                            <i class="fas fa-certificate text-sm w-6 text-center"></i>
                            <span class="sidebar-text hidden xl:block ml-3">সার্টিফিকেট</span>
                        </a>
                        <a href="#" @click="activeTab = 'email'" class="flex items-center px-4 py-2 text-sm font-medium rounded-lg group" :class="{'text-blue-600 dark:text-blue-400': activeTab === 'email', 'text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-white': activeTab !== 'email'}">
                            <i class="fas fa-envelope text-sm w-6 text-center"></i>
                            <span class="sidebar-text hidden xl:block ml-3">ইমেইল টেমপ্লেট</span>
                        </a>
                    </div>
                </div>
            </div>
        </nav>
        
        <!-- User Profile & Logout -->
        <div class="p-4 border-t border-gray-200 dark:border-slate-700">
            <div class="flex items-center">
                <img src="https://cdn.ostad.app/public/upload/2023-08-06T10-43-26.987Z-2023-02-18T16-19-36.508Z-331049670_5912973425465146_8220712743907257929_n.jpg" alt="User" class="h-10 w-10 rounded-full">
                <div class="sidebar-text hidden xl:block ml-3">
                    <p class="text-sm font-medium">Admin User</p>
                    <p class="text-xs text-gray-500 dark:text-gray-400">Super Admin</p>
                </div>
            </div>
            <a href="#" class="sidebar-link flex items-center px-2 py-2 mt-3 text-sm font-medium rounded-lg" @click="logout">
                <i class="fas fa-sign-out-alt text-lg w-6 text-center"></i>
                <span class="sidebar-text hidden xl:block ml-3">লগ আউট</span>
            </a>
        </div>
    </div>
</div>