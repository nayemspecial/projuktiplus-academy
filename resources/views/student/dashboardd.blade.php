@extends('layouts.student')

@section('title', 'ড্যাশবোর্ড - ProjuktiPlus LMS')

@section('student-content')
<div x-data="studentDashboard()" x-init="init()">
    <!-- Welcome Banner -->
    <div class="bg-gradient-to-r from-blue-500 to-blue-600 dark:from-blue-600 dark:to-blue-700 rounded-lg shadow-md p-6 mb-6 text-white">
        <div class="flex flex-col md:flex-row items-center justify-between">
            <div>
                <h2 class="text-2xl font-bold mb-2">স্বাগতম, <span x-text="student.name"></span>!</h2>
                <p class="opacity-90">আপনার লার্নিং জার্নি ট্র্যাক করুন এবং নতুন কোর্স এক্সপ্লোর করুন</p>
            </div>
            <div class="mt-4 md:mt-0">
                <button class="px-4 py-2 bg-white text-blue-600 rounded-md font-medium hover:bg-opacity-90 transition">
                    নতুন কোর্স এক্সপ্লোর করুন
                </button>
            </div>
        </div>
    </div>

    <!-- Progress Overview -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
        <!-- Overall Progress -->
        <div class="bg-white dark:bg-slate-800 rounded-lg shadow p-6">
            <h3 class="text-lg font-medium text-gray-800 dark:text-white mb-4">সামগ্রিক প্রোগ্রেস</h3>
            <div class="flex items-center justify-center">
                <div class="relative w-32 h-32">
                    <svg class="w-full h-full" viewBox="0 0 36 36">
                        <!-- Background circle -->
                        <path
                            d="M18 2.0845
                                a 15.9155 15.9155 0 0 1 0 31.831
                                a 15.9155 15.9155 0 0 1 0 -31.831"
                            fill="none"
                            stroke="#e6e6e6"
                            stroke-width="3"
                        />
                        <!-- Progress circle -->
                        <path
                            d="M18 2.0845
                                a 15.9155 15.9155 0 0 1 0 31.831
                                a 15.9155 15.9155 0 0 1 0 -31.831"
                            fill="none"
                            stroke="#3b82f6"
                            stroke-width="3"
                            stroke-dasharray="70, 100"
                            class="progress-ring__circle"
                        />
                        <!-- Center text -->
                        <text x="18" y="20" text-anchor="middle" fill="#3b82f6" font-size="8" font-weight="bold" class="dark:fill-blue-400">70%</text>
                        <text x="18" y="25" text-anchor="middle" fill="#6b7280" font-size="4" class="dark:fill-gray-400">সম্পন্ন</text>
                    </svg>
                </div>
            </div>
            <div class="mt-4 text-center">
                <p class="text-sm text-gray-600 dark:text-gray-400">আপনি <span class="font-medium text-blue-600 dark:text-blue-400">12</span> টি কোর্সের মধ্যে <span class="font-medium text-blue-600 dark:text-blue-400">8</span> টি সম্পন্ন করেছেন</p>
            </div>
        </div>
        
        <!-- Active Courses -->
        <div class="bg-white dark:bg-slate-800 rounded-lg shadow p-6">
            <h3 class="text-lg font-medium text-gray-800 dark:text-white mb-4">সক্রিয় কোর্স</h3>
            <div class="space-y-4">
                <template x-for="course in activeCourses" :key="course.id">
                    <div class="flex items-center p-3 hover:bg-gray-50 dark:hover:bg-slate-700 rounded-lg transition">
                        <img :src="course.image" :alt="course.name" class="h-12 w-12 rounded-md object-cover">
                        <div class="ml-3 flex-1">
                            <h4 class="text-sm font-medium text-gray-800 dark:text-white" x-text="course.name"></h4>
                            <div class="mt-1 w-full bg-gray-200 dark:bg-slate-700 rounded-full h-1.5">
                                <div class="bg-blue-600 dark:bg-blue-400 h-1.5 rounded-full" :style="`width: ${course.progress}%`"></div>
                            </div>
                            <p class="text-xs text-gray-500 dark:text-gray-400 mt-1" x-text="`${course.progress}% সম্পন্ন`"></p>
                        </div>
                        <button @click="continueCourse(course.id)" class="ml-2 px-3 py-1 bg-blue-600 text-white text-xs rounded-md hover:bg-blue-700 transition">
                            চালিয়ে যান
                        </button>
                    </div>
                </template>
            </div>
            <div class="mt-4 text-center">
                <a href="{{ route('student.courses.index') }}" class="text-sm text-blue-600 dark:text-blue-400 hover:underline">সব দেখুন</a>
            </div>
        </div>
        
        <!-- Recent Activities -->
        <div class="bg-white dark:bg-slate-800 rounded-lg shadow p-6">
            <h3 class="text-lg font-medium text-gray-800 dark:text-white mb-4">সাম্প্রতিক অ্যাক্টিভিটি</h3>
            <div class="space-y-4">
                <template x-for="activity in recentActivities" :key="activity.id">
                    <div class="flex items-start">
                        <div class="flex-shrink-0 mt-1">
                            <div :class="`h-8 w-8 rounded-full flex items-center justify-center ${activity.type === 'lesson' ? 'bg-green-100 text-green-600 dark:bg-green-900/30 dark:text-green-400' : 'bg-purple-100 text-purple-600 dark:bg-purple-900/30 dark:text-purple-400'}`">
                                <i :class="activity.type === 'lesson' ? 'fas fa-play' : 'fas fa-question'"></i>
                            </div>
                        </div>
                        <div class="ml-3">
                            <p class="text-sm text-gray-800 dark:text-white" x-text="activity.message"></p>
                            <p class="text-xs text-gray-500 dark:text-gray-400 mt-1" x-text="activity.time"></p>
                        </div>
                    </div>
                </template>
            </div>
        </div>
    </div>
    
    <!-- My Courses Section -->
    <div class="bg-white dark:bg-slate-800 rounded-lg shadow overflow-hidden mb-6">
        <div class="px-6 py-4 border-b border-gray-200 dark:border-slate-700 flex justify-between items-center">
            <h3 class="text-lg font-medium text-gray-800 dark:text-white">আমার কোর্সসমূহ</h3>
            <a href="{{ route('student.courses.index') }}" class="text-blue-600 dark:text-blue-400 hover:text-blue-500 text-sm font-medium">সব দেখুন</a>
        </div>
        <div class="p-6">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <template x-for="course in myCourses" :key="course.id">
                    <div class="course-card bg-white dark:bg-slate-800 border border-gray-200 dark:border-slate-700 rounded-lg shadow-sm overflow-hidden hover:shadow-md transition">
                        <img class="w-full h-40 object-cover" :src="course.image" :alt="course.name">
                        <div class="p-4">
                            <div class="flex justify-between items-start">
                                <div>
                                    <h3 class="text-lg font-medium text-gray-800 dark:text-white mb-1" x-text="course.name"></h3>
                                    <p class="text-sm text-gray-500 dark:text-gray-400" x-text="course.instructor"></p>
                                </div>
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium" :class="course.status === 'completed' ? 'bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-400' : 'bg-blue-100 text-blue-800 dark:bg-blue-900/30 dark:text-blue-400'" x-text="course.status === 'completed' ? 'সম্পন্ন' : 'চলমান'"></span>
                            </div>
                            <div class="mt-4">
                                <div class="flex justify-between text-sm text-gray-600 dark:text-gray-400 mb-1">
                                    <span>প্রোগ্রেস</span>
                                    <span x-text="`${course.progress}%`"></span>
                                </div>
                                <div class="w-full bg-gray-200 dark:bg-slate-700 rounded-full h-2">
                                    <div class="bg-blue-600 dark:bg-blue-400 h-2 rounded-full" :style="`width: ${course.progress}%`"></div>
                                </div>
                            </div>
                            <div class="mt-4 flex justify-between items-center">
                                <div class="flex items-center text-sm text-gray-500 dark:text-gray-400">
                                    <i class="fas fa-book-open mr-1"></i>
                                    <span x-text="`${course.completedLessons}/${course.totalLessons} লেসন`"></span>
                                </div>
                                <button @click="viewCourse(course.id)" class="text-sm text-blue-600 dark:text-blue-400 hover:text-blue-500 dark:hover:text-blue-300 font-medium">
                                    বিস্তারিত দেখুন
                                </button>
                            </div>
                        </div>
                    </div>
                </template>
            </div>
        </div>
    </div>
    
    <!-- Quiz & Assignments Status -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
        <!-- Pending Quizzes -->
        <div class="bg-white dark:bg-slate-800 rounded-lg shadow overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-200 dark:border-slate-700">
                <h3 class="text-lg font-medium text-gray-800 dark:text-white">পেন্ডিং কুইজ</h3>
            </div>
            <div class="divide-y divide-gray-200 dark:divide-slate-700">
                <template x-for="quiz in pendingQuizzes" :key="quiz.id">
                    <div class="px-6 py-4 hover:bg-gray-50 dark:hover:bg-slate-700 transition">
                        <div class="flex items-center justify-between">
                            <div>
                                <h4 class="text-sm font-medium text-gray-800 dark:text-white" x-text="quiz.title"></h4>
                                <p class="text-xs text-gray-500 dark:text-gray-400 mt-1" x-text="`${quiz.course} • ডিউ ডেট: ${quiz.dueDate}`"></p>
                            </div>
                            <button @click="startQuiz(quiz.id)" class="px-3 py-1 bg-blue-600 text-white text-xs rounded-md hover:bg-blue-700 transition">
                                শুরু করুন
                            </button>
                        </div>
                    </div>
                </template>
            </div>
        </div>
        
        <!-- Completed Assignments -->
        <div class="bg-white dark:bg-slate-800 rounded-lg shadow overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-200 dark:border-slate-700">
                <h3 class="text-lg font-medium text-gray-800 dark:text-white">সম্পন্ন অ্যাসাইনমেন্ট</h3>
            </div>
            <div class="divide-y divide-gray-200 dark:divide-slate-700">
                <template x-for="assignment in completedAssignments" :key="assignment.id">
                    <div class="px-6 py-4 hover:bg-gray-50 dark:hover:bg-slate-700 transition">
                        <div class="flex items-center justify-between">
                            <div>
                                <h4 class="text-sm font-medium text-gray-800 dark:text-white" x-text="assignment.title"></h4>
                                <p class="text-xs text-gray-500 dark:text-gray-400 mt-1" x-text="`${assignment.course} • স্কোর: ${assignment.score}`"></p>
                            </div>
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-400">
                                সম্পন্ন
                            </span>
                        </div>
                    </div>
                </template>
            </div>
        </div>
    </div>
    
    <!-- Certificates -->
    <div class="bg-white dark:bg-slate-800 rounded-lg shadow overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-200 dark:border-slate-700 flex justify-between items-center">
            <h3 class="text-lg font-medium text-gray-800 dark:text-white">আমার সার্টিফিকেট</h3>
            <a href="{{ route('student.certificates.index') }}" class="text-blue-600 dark:text-blue-400 hover:text-blue-500 text-sm font-medium">সব দেখুন</a>
        </div>
        <div class="p-6">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <template x-for="certificate in certificates" :key="certificate.id">
                    <div class="border border-gray-200 dark:border-slate-700 rounded-lg overflow-hidden hover:shadow-md transition">
                        <div class="p-4 bg-gray-50 dark:bg-slate-800 border-b border-gray-200 dark:border-slate-700">
                            <h4 class="text-md font-medium text-gray-800 dark:text-white text-center" x-text="certificate.course"></h4>
                        </div>
                        <div class="p-4 flex flex-col items-center">
                            <img src="{{ asset('images/logo.png') }}" alt="Certificate" class="h-24 w-24 opacity-50 mb-3">
                            <p class="text-sm text-gray-600 dark:text-gray-400 mb-3" x-text="`ইস্যুর তারিখ: ${certificate.issueDate}`"></p>
                            <button @click="viewCertificate(certificate.id)" class="w-full py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 transition">
                                ডাউনলোড করুন
                            </button>
                        </div>
                    </div>
                </template>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('alpine:init', () => {
    Alpine.data('studentDashboard', () => ({
        // Student data
        student: {
            name: "{{ Auth::user()->name }}",
            email: "{{ Auth::user()->email }}"
        },
        
        // Active courses (for dashboard)
        activeCourses: [
            {
                id: 1,
                name: "লারাভেল অ্যান্ড ভিউ",
                image: "{{ asset('images/courses/laravel-vue.jpeg') }}",
                progress: 65,
                lastAccessed: "২ ঘন্টা আগে"
            },
            {
                id: 2,
                name: "রিয়েক্ট জেএস",
                image: "{{ asset('https://images.unsplash.com/photo-1633356122544-f134324a6cee') }}",
                progress: 30,
                lastAccessed: "১ দিন আগে"
            }
        ],
        
        // My courses (for courses tab)
        myCourses: [
            {
                id: 1,
                name: "লারাভেল অ্যান্ড ভিউ",
                image: "{{ asset('images/courses/laravel-vue.jpeg') }}",
                instructor: "নাঈম হোসেন",
                progress: 65,
                status: "active",
                completedLessons: 13,
                totalLessons: 20,
                lastAccessed: "২ ঘন্টা আগে"
            },
            {
                id: 2,
                name: "রিয়েক্ট জেএস",
                image: "{{ asset('images/courses/react-js.jpg') }}",
                instructor: "শাফায়েত রানা",
                progress: 30,
                status: "active",
                completedLessons: 6,
                totalLessons: 20,
                lastAccessed: "১ দিন আগে"
            },
            {
                id: 3,
                name: "MERN স্ট্যাক ডেভেলপমেন্ট",
                image: "{{ asset('images/courses/mern-stack.jpg') }}",
                instructor: "মো. গালিব হাসান",
                progress: 100,
                status: "completed",
                completedLessons: 15,
                totalLessons: 15,
                lastAccessed: "২ সপ্তাহ আগে"
            }
        ],
        
        // Recent activities
        recentActivities: [
            {
                id: 1,
                type: "lesson",
                message: "লারাভেল অ্যান্ড ভিউ কোর্সের লেসন ৫ সম্পন্ন করেছেন",
                time: "২ ঘন্টা আগে"
            },
            {
                id: 2,
                type: "quiz",
                message: "রিয়েক্ট জেএস কোর্সের কুইজ ২ সম্পন্ন করেছেন",
                time: "১ দিন আগে"
            },
            {
                id: 3,
                type: "lesson",
                message: "ডাটা সায়েন্স কোর্সের লেসন ৮ সম্পন্ন করেছেন",
                time: "৩ দিন আগে"
            }
        ],
        
        // Pending quizzes
        pendingQuizzes: [
            {
                id: 1,
                title: "কুইজ ৩: লারাভেল বেসিক",
                course: "লারাভেল অ্যান্ড ভিউ",
                dueDate: "১০ জুন, ২০২৩"
            },
            {
                id: 2,
                title: "মিড টার্ম কুইজ",
                course: "রিয়েক্ট জেএস",
                dueDate: "১৫ জুন, ২০২৩"
            }
        ],
        
        // Completed assignments
        completedAssignments: [
            {
                id: 1,
                title: "অ্যাসাইনমেন্ট ১: CRUD অপারেশন",
                course: "লারাভেল অ্যান্ড ভিউ",
                score: "৯৫/১০০"
            },
            {
                id: 2,
                title: "প্রজেক্ট ১: টুডু অ্যাপ",
                course: "রিয়েক্ট জেএস",
                score: "৮৮/১০০"
            }
        ],
        
        // Certificates
        certificates: [
            {
                id: 1,
                course: "MERN স্ট্যাক ডেভেলপমেন্ট",
                issueDate: "১৫ মে, ২০২৩"
            },
            {
                id: 2,
                course: "ইউআই/ইউএক্স ডিজাইন",
                issueDate: "২৮ মার্চ, ২০২৩"
            }
        ],
        
        // Methods
        init() {
            // Load initial data if needed
            this.loadDashboardData();
        },
        
        loadDashboardData() {
            // You can add API calls here to load real data
            console.log('Loading dashboard data...');
        },
        
        viewCourse(courseId) {
            window.location.href = `/student/courses/${courseId}`;
        },
        
        continueCourse(courseId) {
            window.location.href = `/student/courses/${courseId}/continue`;
        },
        
        startQuiz(quizId) {
            window.location.href = `/student/quizzes/${quizId}/start`;
        },
        
        viewCertificate(certificateId) {
            window.location.href = `/student/certificates/${certificateId}/download`;
        }
    }));
});
</script>
@endsection