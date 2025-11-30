@extends('layouts.student')

@section('title', 'ড্যাশবোর্ড - ProjuktiPlus LMS')

@section('student-content')
<div x-data="studentDashboard()" x-init="init()">
    <template x-if="activeTab === 'dashboard'">
        <div class="space-y-4"> <!-- Global Gap 4 -->

            <!-- 1. Smart Hero Section (Compact & Lighter) -->
            <div class="bg-gradient-to-r from-indigo-500 to-purple-600 dark:from-indigo-700 dark:to-purple-800 rounded-xl shadow-md p-5 text-white relative overflow-hidden flex items-center">
                
                <!-- Glass/Background Decoration -->
                <div class="absolute top-0 right-0 -mt-4 -mr-4 w-32 h-32 bg-white opacity-10 rounded-full blur-2xl"></div>
                <div class="absolute bottom-0 left-0 -mb-4 -ml-4 w-24 h-24 bg-white opacity-10 rounded-full blur-xl"></div>

                <div class="relative z-10 w-full flex flex-col md:flex-row items-center justify-between gap-4">
                    <!-- Text Left -->
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

                    <!-- Button Right -->
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
                <!-- Total Courses -->
                <div class="bg-white dark:bg-slate-800 p-4 rounded-xl shadow-sm border border-gray-100 dark:border-slate-700 flex items-center gap-3">
                    <div class="p-2.5 bg-blue-50 dark:bg-blue-900/20 text-blue-600 dark:text-blue-400 rounded-lg">
                        <i class="fas fa-book-open text-lg"></i>
                    </div>
                    <div>
                        <p class="text-xs text-gray-500 dark:text-gray-400 font-medium">মোট কোর্স</p>
                        <h4 class="text-lg font-bold text-gray-800 dark:text-white">{{ $totalEnrolled }}</h4>
                    </div>
                </div>

                <!-- Average Progress -->
                <div class="bg-white dark:bg-slate-800 p-4 rounded-xl shadow-sm border border-gray-100 dark:border-slate-700 flex items-center gap-3">
                    <div class="p-2.5 bg-green-50 dark:bg-green-900/20 text-green-600 dark:text-green-400 rounded-lg">
                        <i class="fas fa-chart-pie text-lg"></i>
                    </div>
                    <div>
                        <p class="text-xs text-gray-500 dark:text-gray-400 font-medium">গড় অগ্রগতি</p>
                        <h4 class="text-lg font-bold text-gray-800 dark:text-white">{{ $averageProgress }}%</h4>
                    </div>
                </div>

                <!-- Certificates -->
                <div class="bg-white dark:bg-slate-800 p-4 rounded-xl shadow-sm border border-gray-100 dark:border-slate-700 flex items-center gap-3">
                    <div class="p-2.5 bg-yellow-50 dark:bg-yellow-900/20 text-yellow-600 dark:text-yellow-400 rounded-lg">
                        <i class="fas fa-certificate text-lg"></i>
                    </div>
                    <div>
                        <p class="text-xs text-gray-500 dark:text-gray-400 font-medium">সার্টিফিকেট</p>
                        <h4 class="text-lg font-bold text-gray-800 dark:text-white">{{ $totalCertificates }}</h4>
                    </div>
                </div>

                <!-- XP Points -->
                <div class="bg-white dark:bg-slate-800 p-4 rounded-xl shadow-sm border border-gray-100 dark:border-slate-700 flex items-center gap-3">
                    <div class="p-2.5 bg-purple-50 dark:bg-purple-900/20 text-purple-600 dark:text-purple-400 rounded-lg">
                        <i class="fas fa-bolt text-lg"></i>
                    </div>
                    <div>
                        <p class="text-xs text-gray-500 dark:text-gray-400 font-medium">XP অর্জন</p>
                        <h4 class="text-lg font-bold text-gray-800 dark:text-white">{{ $totalXP }}</h4>
                    </div>
                </div>
            </div>

            <!-- 3. Progress Pie & Active Courses Row -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-4">
                
                <!-- Left: Overall Progress Pie Chart (1/3) -->
                <div class="bg-white dark:bg-slate-800 rounded-xl shadow-sm border border-gray-100 dark:border-slate-700 p-6 flex flex-col items-center justify-center relative overflow-hidden">
                    <h3 class="text-sm font-bold text-gray-700 dark:text-gray-200 mb-4 absolute top-4 left-4">সামগ্রিক অগ্রগতি</h3>
                    
                    <div class="relative w-40 h-40">
                        <svg class="w-full h-full transform -rotate-90" viewBox="0 0 36 36">
                            <!-- Background Circle -->
                            <path class="text-gray-100 dark:text-slate-700" stroke-width="2.5" stroke="currentColor" fill="none" d="M18 2.0845 a 15.9155 15.9155 0 0 1 0 31.831 a 15.9155 15.9155 0 0 1 0 -31.831" />
                            <!-- Progress Circle -->
                            <path class="text-indigo-600 transition-all duration-1000 ease-out" stroke-dasharray="{{ $averageProgress }}, 100" stroke-width="2.5" stroke-linecap="round" stroke="currentColor" fill="none" d="M18 2.0845 a 15.9155 15.9155 0 0 1 0 31.831 a 15.9155 15.9155 0 0 1 0 -31.831" />
                        </svg>
                        <div class="absolute inset-0 flex flex-col items-center justify-center">
                            <span class="text-3xl font-bold text-gray-800 dark:text-white">{{ $averageProgress }}%</span>
                            <span class="text-[10px] text-gray-500 uppercase mt-1">সম্পন্ন</span>
                        </div>
                    </div>
                    <div class="mt-6 text-center">
                        <p class="text-xs text-gray-500 dark:text-gray-400">
                            আপনি <span class="font-bold text-indigo-600">{{ $totalEnrolled }}</span> টি কোর্সের মধ্যে 
                            <span class="font-bold text-green-600">{{ $completedCourses }}</span> টি শেষ করেছেন।
                        </p>
                    </div>
                </div>

                <!-- Right: Active Courses List (2/3) -->
                <div class="lg:col-span-2 bg-white dark:bg-slate-800 rounded-xl shadow-sm border border-gray-100 dark:border-slate-700 overflow-hidden flex flex-col">
                    <div class="px-5 py-3 border-b border-gray-100 dark:border-slate-700 flex justify-between items-center bg-gray-50/50 dark:bg-slate-800">
                        <h3 class="text-sm font-bold text-gray-800 dark:text-white flex items-center gap-2">
                            <span class="w-2 h-2 rounded-full bg-indigo-500 animate-pulse"></span> চলমান কোর্স
                        </h3>
                        <a href="#" @click.prevent="activeTab = 'courses'" class="text-xs font-medium text-indigo-600 dark:text-indigo-400 hover:underline">সব দেখুন</a>
                    </div>
                    
                    <div class="p-3 flex-1">
                        <template x-if="activeCourses.length > 0">
                            <div class="space-y-3">
                                <template x-for="course in activeCourses" :key="course.id">
                                    <div class="group p-3 rounded-lg border border-gray-100 dark:border-slate-700/50 hover:border-indigo-200 dark:hover:border-indigo-800/50 hover:bg-indigo-50/20 dark:hover:bg-slate-700/30 transition flex gap-4 items-center">
                                        <div class="relative flex-shrink-0">
                                            <img :src="course.image" class="w-14 h-14 rounded-lg object-cover shadow-sm" alt="">
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
                                        
                                        <a :href="`/student/courses/${course.id}/content`" class="px-3 py-1.5 bg-white dark:bg-slate-700 text-gray-600 dark:text-gray-300 text-xs font-bold rounded-md border border-gray-200 dark:border-slate-600 hover:text-indigo-600 hover:border-indigo-200 transition shadow-sm">
                                            চালান
                                        </a>
                                    </div>
                                </template>
                            </div>
                        </template>
                        <template x-if="activeCourses.length === 0">
                             <div class="h-full flex flex-col items-center justify-center text-gray-400 text-xs py-8">
                                <i class="far fa-folder-open text-2xl mb-2 opacity-50"></i>
                                <p>কোনো সক্রিয় কোর্স নেই।</p>
                            </div>
                        </template>
                    </div>
                </div>
            </div>

            <!-- 4. Bottom Row: Recommended & Activity -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-4">
                
                <!-- Left: Recommended (2/3) -->
                <div class="lg:col-span-2">
                    @if($recommendedCourses->count() > 0)
                    <div class="bg-white dark:bg-slate-800 rounded-xl shadow-sm border border-gray-100 dark:border-slate-700 overflow-hidden">
                         <div class="px-5 py-3 border-b border-gray-100 dark:border-slate-700">
                            <h3 class="text-sm font-bold text-gray-800 dark:text-white">আপনার জন্য সুপারিশকৃত</h3>
                        </div>
                        <div class="p-4 grid grid-cols-1 sm:grid-cols-2 gap-4">
                            @foreach($recommendedCourses as $course)
                            <a href="{{ route('student.courses.show', $course->id) }}" class="flex bg-gray-50 dark:bg-slate-700/30 rounded-lg border border-gray-100 dark:border-slate-700 overflow-hidden hover:shadow-md hover:border-indigo-200 transition group h-20">
                                <div class="w-20 h-full flex-shrink-0 relative">
                                    <img src="{{ $course->thumbnail_url }}" class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                                </div>
                                <div class="p-2.5 flex flex-col justify-center flex-1 min-w-0">
                                    <h4 class="text-xs font-bold text-gray-800 dark:text-white truncate group-hover:text-indigo-600 transition mb-1">{{ $course->title }}</h4>
                                    <div class="flex justify-between items-center">
                                        <span class="text-[10px] text-gray-500 dark:text-gray-400">{{ \Illuminate\Support\Str::limit($course->instructor->name, 12) }}</span>
                                        <span class="text-[10px] font-bold bg-indigo-100 dark:bg-indigo-900/40 text-indigo-700 dark:text-indigo-300 px-2 py-0.5 rounded-sm">
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

                <!-- Right: Recent Activity (1/3) -->
                <div class="bg-white dark:bg-slate-800 rounded-xl shadow-sm border border-gray-100 dark:border-slate-700 p-4 h-full">
                    <h3 class="text-sm font-bold text-gray-800 dark:text-white mb-4 flex items-center gap-2">
                        <i class="fas fa-history text-indigo-500 text-xs"></i> অ্যাক্টিভিটি
                    </h3>
                    
                    <div class="space-y-0">
                        <template x-if="recentActivities.length > 0">
                            <div class="relative border-l border-gray-200 dark:border-slate-700 ml-1.5 space-y-4 pb-1">
                                <template x-for="activity in recentActivities" :key="activity.id">
                                    <div class="relative pl-4">
                                        <!-- Dot -->
                                        <div class="absolute -left-[4px] top-1.5 w-2 h-2 rounded-full bg-white dark:bg-slate-800 border-2 border-green-500 z-10"></div>
                                        
                                        <p class="text-[10px] font-bold text-gray-400 uppercase tracking-wide mb-0.5" x-text="activity.time"></p>
                                        <p class="text-xs text-gray-600 dark:text-gray-300 font-medium leading-snug line-clamp-2" x-text="activity.message"></p>
                                    </div>
                                </template>
                            </div>
                        </template>
                        <template x-if="recentActivities.length === 0">
                            <div class="text-center py-4">
                                <p class="text-xs text-gray-400">কোনো অ্যাক্টিভিটি নেই</p>
                            </div>
                        </template>
                    </div>
                </div>
            </div>

        </div>
    </template>

    <!-- My Courses Tab (Existing) -->
    <template x-if="activeTab === 'courses'">
         <div class="space-y-4">
            <div class="bg-white dark:bg-slate-800 rounded-xl shadow-sm border border-gray-100 dark:border-slate-700 overflow-hidden">
                <div class="px-5 py-3 border-b border-gray-100 dark:border-slate-700 flex flex-col sm:flex-row justify-between items-center gap-3 bg-gray-50/50 dark:bg-slate-800">
                    <h3 class="text-sm font-bold text-gray-800 dark:text-white">আমার সব কোর্স</h3>
                    <div class="flex gap-2 w-full sm:w-auto">
                        <input type="text" class="w-full sm:w-40 pl-7 pr-3 py-1.5 text-xs border border-gray-200 dark:border-slate-600 rounded-md bg-white dark:bg-slate-900 focus:ring-1 focus:ring-indigo-500" placeholder="খুঁজুন..." x-model="courseSearchQuery">
                        <select x-model="courseFilter" class="px-2 py-1.5 text-xs border border-gray-200 dark:border-slate-600 rounded-md bg-white dark:bg-slate-900 focus:ring-1 focus:ring-indigo-500">
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
                            <p class="text-xs">কোনো কোর্স পাওয়া যায়নি।</p>
                        </div>
                    </template>
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4" x-show="filteredMyCourses.length > 0">
                        <template x-for="course in filteredMyCourses" :key="course.id">
                            <div class="group bg-white dark:bg-slate-800 border border-gray-200 dark:border-slate-700 rounded-lg overflow-hidden hover:shadow-lg transition flex flex-col">
                                <div class="relative h-32 overflow-hidden">
                                    <img class="w-full h-full object-cover group-hover:scale-105 transition duration-500" :src="course.image" :alt="course.name">
                                    <div class="absolute inset-0 bg-black/50 opacity-0 group-hover:opacity-100 transition flex items-center justify-center gap-2">
                                        <button @click="continueCourse(course.id)" class="px-3 py-1 bg-white rounded-md text-xs font-bold text-gray-900 hover:bg-indigo-50 transition">
                                            চালিয়ে যান
                                        </button>
                                    </div>
                                </div>
                                <div class="p-3 flex-1 flex flex-col">
                                    <h3 class="text-xs font-bold text-gray-800 dark:text-white line-clamp-2 mb-2" x-text="course.name"></h3>
                                    <div class="mt-auto">
                                        <div class="w-full bg-gray-100 dark:bg-slate-700 rounded-full h-1 mb-2">
                                            <div class="bg-indigo-600 h-1 rounded-full transition-all duration-500" :style="`width: ${course.progress}%`"></div>
                                        </div>
                                        <div class="flex justify-between items-center">
                                            <span class="text-[10px] text-gray-500" x-text="`${course.completedLessons}/${course.totalLessons} লেসন`"></span>
                                            <button @click="viewCourse(course.id)" class="text-[10px] font-bold text-indigo-600 hover:underline">
                                                বিবরণ
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </template>
                    </div>
                </div>
            </div>
        </div>
    </template>
    
    <template x-if="['progress', 'certificates', 'resources'].includes(activeTab)">
        <div class="flex flex-col items-center justify-center py-12 text-gray-400 bg-white dark:bg-slate-800 rounded-2xl border border-dashed border-gray-200 dark:border-slate-700">
            <i class="fas fa-tools text-2xl mb-2 opacity-50"></i>
            <p class="text-xs">এই সেকশনটি শীঘ্রই আসছে...</p>
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
            // Handle hash navigation if needed
        }
    }));
});
</script>
@endsection