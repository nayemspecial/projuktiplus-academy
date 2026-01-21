@extends('layouts.student')

@section('title', 'ড্যাশবোর্ড - ProjuktiPlus LMS')

@section('student-content')
<div x-data="studentDashboard()" x-init="init()">
    
    <!-- Tab Navigation -->
    <div class="mb-6 border-b border-gray-200 dark:border-slate-700 overflow-x-auto">
        <nav class="flex space-x-8">
            <button @click="activeTab = 'dashboard'" 
                    :class="activeTab === 'dashboard' ? 'border-blue-600 text-blue-600 dark:text-blue-400' : 'border-transparent text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-300'"
                    class="whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm transition-colors flex items-center gap-2">
                <i class="fas fa-columns"></i> ড্যাশবোর্ড
            </button>
            <button @click="activeTab = 'courses'" 
                    :class="activeTab === 'courses' ? 'border-blue-600 text-blue-600 dark:text-blue-400' : 'border-transparent text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-300'"
                    class="whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm transition-colors flex items-center gap-2">
                <i class="fas fa-book"></i> আমার কোর্স
            </button>
            <button @click="activeTab = 'certificates'" 
                    :class="activeTab === 'certificates' ? 'border-blue-600 text-blue-600 dark:text-blue-400' : 'border-transparent text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-300'"
                    class="whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm transition-colors flex items-center gap-2">
                <i class="fas fa-certificate"></i> সার্টিফিকেট
            </button>
        </nav>
    </div>

    <!-- Dashboard Tab -->
    <template x-if="activeTab === 'dashboard'">
        <div class="space-y-4">

            <!-- 1. Hero Section -->
            <div class="bg-gradient-to-r from-indigo-600 to-purple-600 dark:from-indigo-700 dark:to-purple-800 rounded-xl shadow-md p-5 text-white relative overflow-hidden flex items-center">
                <div class="absolute top-0 right-0 -mt-4 -mr-4 w-32 h-32 bg-white opacity-10 rounded-full blur-2xl"></div>
                <div class="absolute bottom-0 left-0 -mb-4 -ml-4 w-24 h-24 bg-white opacity-10 rounded-full blur-xl"></div>

                <div class="relative z-10 w-full flex flex-col md:flex-row items-center justify-between gap-4">
                    <div class="text-center md:text-left">
                        <h2 class="text-xl md:text-2xl font-bold mb-1">স্বাগতম, <span x-text="student.name"></span>! 👋</h2>
                        <p class="text-indigo-100 text-sm opacity-90">
                            @if($lastPlayedCourse)
                                আপনি সর্বশেষ <strong>{{ $lastPlayedCourse->course->title }}</strong> দেখছিলেন।
                            @else
                                আপনার লার্নিং জার্নি শুরু করতে নতুন কোর্স এক্সপ্লোর করুন।
                            @endif
                        </p>
                    </div>
                    <div class="flex-shrink-0">
                        @if($lastPlayedCourse)
                            <a href="{{ route('student.courses.content', $lastPlayedCourse->course_id) }}" class="inline-flex items-center px-5 py-2 bg-white/20 backdrop-blur-md border border-white/30 hover:bg-white hover:text-indigo-600 text-white rounded-lg text-sm font-bold transition shadow-sm">
                                <i class="fas fa-play mr-2 text-xs"></i> শেখা চালিয়ে যান
                            </a>
                        @else
                            <a href="{{ url('/courses') }}" class="inline-flex items-center px-5 py-2 bg-white/20 backdrop-blur-md border border-white/30 hover:bg-white hover:text-indigo-600 text-white rounded-lg text-sm font-bold transition shadow-sm">
                                নতুন কোর্স খুঁজুন
                            </a>
                        @endif
                    </div>
                </div>
            </div>

            <!-- 2. Stats Grid -->
            <div class="grid grid-cols-2 lg:grid-cols-4 gap-4">
                <div class="bg-white dark:bg-slate-800 p-4 rounded-xl shadow-sm border border-gray-100 dark:border-slate-700 flex items-center gap-3">
                    <div class="p-2.5 bg-blue-50 dark:bg-blue-900/20 text-blue-600 dark:text-blue-400 rounded-lg"><i class="fas fa-book-open text-lg"></i></div>
                    <div><p class="text-xs text-gray-500 dark:text-gray-400 font-medium">মোট কোর্স</p><h4 class="text-lg font-bold text-gray-800 dark:text-white">{{ $totalEnrolled }}</h4></div>
                </div>
                <div class="bg-white dark:bg-slate-800 p-4 rounded-xl shadow-sm border border-gray-100 dark:border-slate-700 flex items-center gap-3">
                    <div class="p-2.5 bg-green-50 dark:bg-green-900/20 text-green-600 dark:text-green-400 rounded-lg"><i class="fas fa-chart-pie text-lg"></i></div>
                    <div><p class="text-xs text-gray-500 dark:text-gray-400 font-medium">গড় অগ্রগতি</p><h4 class="text-lg font-bold text-gray-800 dark:text-white">{{ $averageProgress }}%</h4></div>
                </div>
                <div class="bg-white dark:bg-slate-800 p-4 rounded-xl shadow-sm border border-gray-100 dark:border-slate-700 flex items-center gap-3">
                    <div class="p-2.5 bg-yellow-50 dark:bg-yellow-900/20 text-yellow-600 dark:text-yellow-400 rounded-lg"><i class="fas fa-certificate text-lg"></i></div>
                    <div><p class="text-xs text-gray-500 dark:text-gray-400 font-medium">সার্টিফিকেট</p><h4 class="text-lg font-bold text-gray-800 dark:text-white">{{ $totalCertificates }}</h4></div>
                </div>
                <div class="bg-white dark:bg-slate-800 p-4 rounded-xl shadow-sm border border-gray-100 dark:border-slate-700 flex items-center gap-3">
                    <div class="p-2.5 bg-purple-50 dark:bg-purple-900/20 text-purple-600 dark:text-purple-400 rounded-lg"><i class="fas fa-bolt text-lg"></i></div>
                    <div><p class="text-xs text-gray-500 dark:text-gray-400 font-medium">XP অর্জন</p><h4 class="text-lg font-bold text-gray-800 dark:text-white">{{ $totalXP }}</h4></div>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-4">
                
                <!-- 3. Active Courses List (2/3) -->
                <div class="lg:col-span-2 bg-white dark:bg-slate-800 rounded-xl shadow-sm border border-gray-100 dark:border-slate-700 overflow-hidden flex flex-col">
                    <div class="px-5 py-3 border-b border-gray-100 dark:border-slate-700 flex justify-between items-center bg-gray-50/50 dark:bg-slate-800">
                        <h3 class="text-sm font-bold text-gray-800 dark:text-white flex items-center gap-2">
                            <span class="w-2 h-2 rounded-full bg-indigo-500 animate-pulse"></span> চলমান কোর্স
                        </h3>
                        <a href="#" @click.prevent="activeTab = 'courses'" class="text-xs font-bold text-blue-600 dark:text-blue-400 hover:underline">সব দেখুন</a>
                    </div>
                    
                    <div class="p-3 flex-1">
                        <template x-if="activeCourses.length > 0">
                            <div class="space-y-3">
                                <template x-for="course in activeCourses" :key="course.id">
                                    <div class="group p-3 rounded-lg border border-gray-100 dark:border-slate-700/50 hover:border-indigo-200 dark:hover:border-indigo-800/50 hover:bg-indigo-50/20 dark:hover:bg-slate-700/30 transition flex gap-4 items-center">
                                        <div class="relative w-14 h-14 sm:w-20 sm:h-14 rounded-lg overflow-hidden flex-shrink-0 bg-gray-200 dark:bg-slate-700">
                                            <img :src="course.image" class="w-full h-full object-cover" :alt="course.name">
                                        </div>
                                        <div class="flex-1 min-w-0">
                                            <h4 class="text-sm font-bold text-gray-800 dark:text-white truncate mb-1" x-text="course.name"></h4>
                                            <div class="flex items-center gap-3">
                                                <div class="flex-1 h-1.5 bg-gray-100 dark:bg-slate-700 rounded-full overflow-hidden">
                                                    <div class="h-full bg-indigo-500 rounded-full transition-all duration-500" :style="`width: ${course.progress}%`"></div>
                                                </div>
                                                <span class="text-xs font-bold text-indigo-600 dark:text-indigo-400" x-text="`${course.progress}%`"></span>
                                            </div>
                                        </div>
                                        <a :href="`/student/courses/${course.id}/content`" class="px-3 py-1.5 bg-white dark:bg-slate-700 text-gray-600 dark:text-gray-300 text-xs font-bold rounded-md border border-gray-200 dark:border-slate-600 hover:text-indigo-600 hover:border-indigo-200 dark:hover:border-indigo-500 transition shadow-sm whitespace-nowrap">
                                            কন্টিনিউ করুন
                                        </a>
                                    </div>
                                </template>
                            </div>
                        </template>
                        <template x-if="activeCourses.length === 0">
                            <div class="text-center py-8 text-gray-400">
                                <i class="far fa-folder-open text-2xl mb-2 opacity-50"></i>
                                <p class="text-sm">কোনো চলমান কোর্স নেই</p>
                                <a href="{{ route('courses.index') }}" class="text-xs text-indigo-600 hover:underline mt-1 inline-block">কোর্স এক্সপ্লোর করুন</a>
                            </div>
                        </template>
                    </div>
                </div>

                <!-- 4. Recommended Courses (1/3) -->
                @if(isset($recommendedCourses) && $recommendedCourses->count() > 0)
                <div class="bg-white dark:bg-slate-800 rounded-xl shadow-sm border border-gray-100 dark:border-slate-700 overflow-hidden">
                    <div class="px-5 py-3 border-b border-gray-100 dark:border-slate-700 bg-slate-50/50 dark:bg-slate-800/50">
                        <h3 class="text-sm font-bold text-gray-800 dark:text-white flex items-center gap-2">
                            <i class="fas fa-lightbulb text-yellow-500"></i> আপনার জন্য সুপারিশকৃত
                        </h3>
                    </div>
                    <div class="p-3 space-y-3">
                        @foreach($recommendedCourses as $course)
                        <!-- [FIXED] এখানে পাবলিক ডিটেইলস পেজের লিংক দেওয়া হয়েছে -->
                        <a href="{{ route('courses.show', $course->slug) }}" class="flex items-center gap-3 p-2 rounded-lg border border-gray-100 dark:border-slate-700 hover:border-blue-200 dark:hover:border-blue-800 hover:shadow-sm transition group bg-white dark:bg-slate-700/20">
                            <div class="w-16 h-12 rounded-md overflow-hidden flex-shrink-0 bg-slate-200">
                                <img src="{{ $course->thumbnail_url }}" class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                            </div>
                            <div class="flex-1 min-w-0">
                                <h4 class="text-xs font-bold text-gray-800 dark:text-white truncate group-hover:text-blue-600 transition mb-0.5">{{ $course->title }}</h4>
                                <div class="flex justify-between items-center">
                                    <span class="text-[10px] text-gray-500 dark:text-gray-400">{{ \Illuminate\Support\Str::limit($course->instructor->name ?? 'Instructor', 10) }}</span>
                                    <span class="text-[10px] font-bold bg-indigo-50 dark:bg-indigo-900/40 text-indigo-700 dark:text-indigo-300 px-1.5 py-0.5 rounded-sm">
                                        {{ $course->price > 0 ? '৳'.number_format($course->price) : 'ফ্রি' }}
                                    </span>
                                </div>
                            </div>
                        </a>
                        @endforeach
                    </div>
                </div>
                @endif

            </div>

            <!-- 5. Recent Activity & Progress -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-4">
                <!-- Overall Progress Pie -->
                <div class="bg-white dark:bg-slate-800 rounded-xl shadow-sm border border-gray-100 dark:border-slate-700 p-5 flex items-center gap-6 relative overflow-hidden">
                    <div class="relative w-24 h-24 flex-shrink-0">
                        <svg class="w-full h-full transform -rotate-90" viewBox="0 0 36 36">
                            <path class="text-gray-100 dark:text-slate-700" stroke-width="3" stroke="currentColor" fill="none" d="M18 2.0845 a 15.9155 15.9155 0 0 1 0 31.831 a 15.9155 15.9155 0 0 1 0 -31.831" />
                            <path class="text-indigo-600 transition-all duration-1000 ease-out" stroke-dasharray="{{ $averageProgress }}, 100" stroke-width="3" stroke-linecap="round" stroke="currentColor" fill="none" d="M18 2.0845 a 15.9155 15.9155 0 0 1 0 31.831 a 15.9155 15.9155 0 0 1 0 -31.831" />
                        </svg>
                        <div class="absolute inset-0 flex flex-col items-center justify-center">
                            <span class="text-xl font-bold text-gray-800 dark:text-white">{{ $averageProgress }}%</span>
                        </div>
                    </div>
                    <div>
                        <h3 class="text-sm font-bold text-gray-700 dark:text-gray-200 mb-1">সামগ্রিক অগ্রগতি</h3>
                        <p class="text-xs text-gray-500 dark:text-gray-400 leading-snug">
                            আপনি <span class="font-bold text-indigo-600">{{ $totalEnrolled }}</span> টি কোর্সের মধ্যে 
                            <span class="font-bold text-green-600">{{ $completedCourses }}</span> টি শেষ করেছেন।
                        </p>
                    </div>
                </div>

                <!-- Recent Activity Feed -->
                <div class="lg:col-span-2 bg-white dark:bg-slate-800 rounded-xl shadow-sm border border-gray-100 dark:border-slate-700 p-5">
                    <h3 class="text-sm font-bold text-gray-800 dark:text-white mb-4 flex items-center gap-2">
                        <i class="fas fa-history text-indigo-500 text-xs"></i> সাম্প্রতিক কার্যক্রম
                    </h3>
                    <div class="space-y-0">
                        <template x-if="recentActivities.length > 0">
                            <div class="relative border-l-2 border-gray-100 dark:border-slate-700 ml-1.5 space-y-4 pb-1">
                                <template x-for="activity in recentActivities" :key="activity.id">
                                    <div class="relative pl-4">
                                        <div class="absolute -left-[5px] top-1.5 w-2.5 h-2.5 rounded-full bg-white dark:bg-slate-800 border-2 border-green-500 z-10"></div>
                                        <div class="flex flex-col">
                                            <span class="text-[10px] font-bold text-gray-400 uppercase tracking-wide mb-0.5" x-text="activity.time"></span>
                                            <p class="text-xs text-gray-600 dark:text-gray-300 font-medium leading-snug line-clamp-1" x-text="activity.message"></p>
                                        </div>
                                    </div>
                                </template>
                            </div>
                        </template>
                        <template x-if="recentActivities.length === 0">
                            <p class="text-xs text-gray-400 text-center py-2">কোনো সাম্প্রতিক কার্যক্রম নেই</p>
                        </template>
                    </div>
                </div>
            </div>

        </div>
    </template>

    <!-- My Courses Tab -->
    <template x-if="activeTab === 'courses'">
         <div class="space-y-4">
            <div class="bg-white dark:bg-slate-800 rounded-xl shadow-sm border border-gray-100 dark:border-slate-700 overflow-hidden">
                <div class="px-5 py-3 border-b border-gray-100 dark:border-slate-700 flex flex-col sm:flex-row justify-between items-center gap-3 bg-gray-50/50 dark:bg-slate-800">
                    <h3 class="text-sm font-bold text-gray-800 dark:text-white">আমার সব কোর্স</h3>
                    <div class="flex gap-2 w-full sm:w-auto">
                        <input type="text" class="w-full sm:w-40 pl-3 pr-3 py-1.5 text-xs border border-gray-200 dark:border-slate-600 rounded-md bg-white dark:bg-slate-900 focus:ring-1 focus:ring-indigo-500 outline-none" placeholder="খুঁজুন..." x-model="courseSearchQuery">
                        <select x-model="courseFilter" class="px-2 py-1.5 text-xs border border-gray-200 dark:border-slate-600 rounded-md bg-white dark:bg-slate-900 focus:ring-1 focus:ring-indigo-500 outline-none">
                            <option value="all">সব</option>
                            <option value="active">চলমান</option>
                            <option value="completed">সম্পন্ন</option>
                        </select>
                    </div>
                </div>
                
                <div class="p-5">
                    <template x-if="filteredMyCourses.length === 0">
                        <div class="text-center py-10 text-gray-400">
                            <i class="far fa-sad-tear text-2xl mb-2"></i>
                            <p class="text-xs">কোনো কোর্স পাওয়া যায়নি।</p>
                        </div>
                    </template>
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4" x-show="filteredMyCourses.length > 0">
                        <template x-for="course in filteredMyCourses" :key="course.id">
                            <div class="group bg-white dark:bg-slate-800 border border-gray-200 dark:border-slate-700 rounded-lg overflow-hidden hover:shadow-lg transition flex flex-col h-full">
                                <div class="relative h-32 overflow-hidden">
                                    <img class="w-full h-full object-cover group-hover:scale-105 transition duration-500" :src="course.image" :alt="course.name">
                                    <div class="absolute inset-0 bg-black/50 opacity-0 group-hover:opacity-100 transition flex items-center justify-center gap-2">
                                        <button @click="continueCourse(course.id)" class="px-3 py-1 bg-white rounded-md text-xs font-bold text-gray-900 hover:bg-indigo-50 transition">
                                            চালিয়ে যান
                                        </button>
                                    </div>
                                    <div class="absolute top-2 right-2">
                                        <span class="px-2 py-0.5 text-[9px] font-bold text-white rounded shadow-sm uppercase"
                                              :class="course.status === 'completed' ? 'bg-green-500/90' : 'bg-blue-500/90'">
                                            <span x-text="course.status === 'completed' ? 'সম্পন্ন' : 'চলমান'"></span>
                                        </span>
                                    </div>
                                </div>
                                
                                <div class="p-3 flex-1 flex flex-col">
                                    <div class="flex justify-between items-start mb-1">
                                        <span class="text-[10px] bg-slate-100 dark:bg-slate-700 px-2 py-0.5 rounded text-slate-500 dark:text-slate-400 font-medium truncate max-w-[100px]" x-text="course.instructor"></span>
                                    </div>
                                    <h3 class="text-xs font-bold text-gray-800 dark:text-white line-clamp-2 mb-2" x-text="course.name"></h3>
                                    
                                    <div class="mt-auto pt-2 border-t border-slate-100 dark:border-slate-700/50">
                                        <div class="flex justify-between text-[10px] text-slate-500 mb-1">
                                            <span>অগ্রগতি</span>
                                            <span class="font-bold text-indigo-600" x-text="`${course.progress}%`"></span>
                                        </div>
                                        <div class="w-full bg-slate-100 dark:bg-slate-700 rounded-full h-1 mb-2">
                                            <div class="bg-indigo-600 h-1 rounded-full transition-all duration-500" :style="`width: ${course.progress}%`"></div>
                                        </div>
                                        <button @click="viewCourse(course.id)" class="w-full text-center text-[10px] font-bold text-indigo-600 hover:bg-indigo-50 dark:hover:bg-slate-700 py-1 rounded transition">
                                            বিস্তারিত দেখুন
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </template>
                    </div>
                </div>
            </div>
        </div>
    </template>
    
    <!-- Certificates Tab -->
    <template x-if="activeTab === 'certificates'">
        <div class="flex flex-col items-center justify-center py-20 text-gray-400 bg-white dark:bg-slate-800 rounded-xl border border-dashed border-gray-200 dark:border-slate-700">
            <i class="fas fa-certificate text-4xl mb-3 opacity-50 text-yellow-500"></i>
            <p class="text-sm font-medium">আপনার সব সার্টিফিকেট এখানে দেখা যাবে।</p>
            <a href="{{ route('student.certificates.index') }}" class="mt-3 px-4 py-2 bg-indigo-600 text-white text-xs font-bold rounded-md hover:bg-indigo-700 transition">সার্টিফিকেট পেজে যান</a>
        </div>
    </template>

</div>

<script>
document.addEventListener('alpine:init', () => {
    Alpine.data('studentDashboard', () => ({
        student: {
            name: "{{ $user->name }}",
            email: "{{ $user->email }}",
        },
        totalXP: {{ $totalXP ?? 0 }},
        overallProgress: {
            total: {{ $totalEnrolled }},
            completed: {{ $completedCourses }},
            percentage: {{ $averageProgress }}
        },
        activeCourses: @json($activeCoursesData),
        myCourses: @json($myCoursesData),
        recentActivities: @json($recentActivitiesData),
        
        courseSearchQuery: '',
        courseFilter: 'all',
        activeTab: 'dashboard',

        get filteredMyCourses() {
            let courses = this.myCourses;
            if (this.courseSearchQuery) {
                const query = this.courseSearchQuery.toLowerCase();
                courses = courses.filter(course => 
                    course.name.toLowerCase().includes(query) ||
                    course.instructor.toLowerCase().includes(query)
                );
            }
            if (this.courseFilter !== 'all') {
                courses = courses.filter(course => course.status === this.courseFilter);
            }
            return courses;
        },

        viewCourse(courseId) {
            window.location.href = `/student/courses/${courseId}`;
        },

        continueCourse(courseId) {
            window.location.href = `/student/courses/${courseId}/content`; 
        },
        
        init() {
            const hash = window.location.hash.replace('#', '');
            if (['dashboard', 'courses', 'certificates'].includes(hash)) {
                this.activeTab = hash;
            }
        }
    }));
});
</script>
@endsection