@extends('layouts.student')

@section('title', 'ড্যাশবোর্ড - ProjuktiPlus LMS')

@section('student-content')
<div x-data="studentDashboard()">
    
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
        <div class="space-y-6"> 
            
            <!-- 1. Modern Hero Section -->
            <div class="relative rounded-2xl overflow-hidden bg-slate-900 text-white shadow-xl">
                <!-- Mesh Gradient Background -->
                <div class="absolute inset-0 pointer-events-none">
                    <div class="absolute top-0 left-0 w-[300px] h-[300px] bg-blue-600/30 rounded-full blur-[80px] -translate-x-1/2 -translate-y-1/2"></div>
                    <div class="absolute bottom-0 right-0 w-[300px] h-[300px] bg-purple-600/30 rounded-full blur-[80px] translate-x-1/2 translate-y-1/2"></div>
                    <svg class="absolute inset-0 w-full h-full opacity-10" xmlns="http://www.w3.org/2000/svg">
                        <defs><pattern id="hero-grid" width="20" height="20" patternUnits="userSpaceOnUse"><path d="M 20 0 L 0 0 0 20" fill="none" stroke="currentColor" stroke-width="0.5"/></pattern></defs>
                        <rect width="100%" height="100%" fill="url(#hero-grid)" />
                    </svg>
                </div>

                <div class="relative z-10 p-6 md:p-10 flex flex-col md:flex-row items-center justify-between gap-6">
                    <div class="text-center md:text-left">
                        <h2 class="text-2xl md:text-3xl font-bold mb-2 font-heading">স্বাগতম, <span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-300 to-purple-300">{{ $user->name }}</span>! 👋</h2>
                        <p class="text-slate-300 text-sm md:text-base max-w-xl">
                            @if($lastPlayedCourse)
                                আপনি সর্বশেষ <span class="text-white font-semibold">"{{ $lastPlayedCourse->course->title }}"</span> দেখছিলেন। শেখা চালিয়ে যেতে চান?
                            @else
                                আপনার লার্নিং জার্নি শুরু করতে নতুন কোর্স এক্সপ্লোর করুন এবং নিজের দক্ষতা বৃদ্ধি করুন।
                            @endif
                        </p>
                    </div>
                    
                    <div class="flex-shrink-0">
                        @if($lastPlayedCourse)
                            <a href="{{ route('student.courses.content', $lastPlayedCourse->course_id) }}" 
                               class="inline-flex items-center px-6 py-3 bg-white text-slate-900 rounded-xl font-bold text-sm hover:bg-blue-50 transition shadow-lg transform hover:-translate-y-1">
                                <i class="fas fa-play mr-2"></i> শেখা চালিয়ে যান
                            </a>
                        @else
                            <a href="{{ route('student.courses.index') }}" 
                               class="inline-flex items-center px-6 py-3 bg-white/10 backdrop-blur-md border border-white/20 text-white rounded-xl font-bold text-sm hover:bg-white/20 transition shadow-lg">
                                <i class="fas fa-search mr-2"></i> কোর্স খুঁজুন
                            </a>
                        @endif
                    </div>
                </div>
            </div>

            <!-- 2. Stats Grid -->
            <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 md:gap-6">
                <!-- Total Courses -->
                <div class="bg-white dark:bg-slate-800 p-5 rounded-2xl shadow-sm border border-slate-100 dark:border-slate-700 flex items-center gap-4 group hover:border-blue-200 dark:hover:border-blue-800 transition-colors">
                    <div class="p-3 bg-blue-50 dark:bg-blue-900/20 text-blue-600 dark:text-blue-400 rounded-xl group-hover:scale-110 transition-transform">
                        <i class="fas fa-book-open text-xl"></i>
                    </div>
                    <div>
                        <p class="text-xs text-slate-500 dark:text-slate-400 font-bold uppercase tracking-wider">মোট কোর্স</p>
                        <h4 class="text-2xl font-bold text-slate-800 dark:text-white">{{ $totalEnrolled }}</h4>
                    </div>
                </div>

                <!-- Average Progress -->
                <div class="bg-white dark:bg-slate-800 p-5 rounded-2xl shadow-sm border border-slate-100 dark:border-slate-700 flex items-center gap-4 group hover:border-green-200 dark:hover:border-green-800 transition-colors">
                    <div class="p-3 bg-green-50 dark:bg-green-900/20 text-green-600 dark:text-green-400 rounded-xl group-hover:scale-110 transition-transform">
                        <i class="fas fa-chart-pie text-xl"></i>
                    </div>
                    <div>
                        <p class="text-xs text-slate-500 dark:text-slate-400 font-bold uppercase tracking-wider">গড় অগ্রগতি</p>
                        <h4 class="text-2xl font-bold text-slate-800 dark:text-white">{{ $averageProgress }}%</h4>
                    </div>
                </div>

                <!-- Certificates -->
                <div class="bg-white dark:bg-slate-800 p-5 rounded-2xl shadow-sm border border-slate-100 dark:border-slate-700 flex items-center gap-4 group hover:border-amber-200 dark:hover:border-amber-800 transition-colors">
                    <div class="p-3 bg-amber-50 dark:bg-amber-900/20 text-amber-600 dark:text-amber-400 rounded-xl group-hover:scale-110 transition-transform">
                        <i class="fas fa-award text-xl"></i>
                    </div>
                    <div>
                        <p class="text-xs text-slate-500 dark:text-slate-400 font-bold uppercase tracking-wider">সার্টিফিকেট</p>
                        <h4 class="text-2xl font-bold text-slate-800 dark:text-white">{{ $totalCertificates }}</h4>
                    </div>
                </div>

                <!-- XP Points -->
                <div class="bg-white dark:bg-slate-800 p-5 rounded-2xl shadow-sm border border-slate-100 dark:border-slate-700 flex items-center gap-4 group hover:border-purple-200 dark:hover:border-purple-800 transition-colors">
                    <div class="p-3 bg-purple-50 dark:bg-purple-900/20 text-purple-600 dark:text-purple-400 rounded-xl group-hover:scale-110 transition-transform">
                        <i class="fas fa-bolt text-xl"></i>
                    </div>
                    <div>
                        <p class="text-xs text-slate-500 dark:text-slate-400 font-bold uppercase tracking-wider">XP অর্জন</p>
                        <h4 class="text-2xl font-bold text-slate-800 dark:text-white">{{ $totalXP }}</h4>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <!-- 3. Active Courses List (2/3) -->
                <div class="lg:col-span-2 bg-white dark:bg-slate-800 rounded-2xl shadow-sm border border-slate-100 dark:border-slate-700 overflow-hidden flex flex-col">
                    <div class="px-6 py-4 border-b border-slate-100 dark:border-slate-700 bg-slate-50/50 dark:bg-slate-800 flex justify-between items-center">
                        <h3 class="text-sm font-bold text-slate-800 dark:text-white flex items-center gap-2">
                            <span class="relative flex h-2 w-2">
                              <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-blue-400 opacity-75"></span>
                              <span class="relative inline-flex rounded-full h-2 w-2 bg-blue-500"></span>
                            </span>
                            চলমান কোর্স
                        </h3>
                        <a href="#" @click.prevent="activeTab = 'courses'" class="text-xs font-bold text-blue-600 dark:text-blue-400 hover:underline">সব দেখুন</a>
                    </div>
                    
                    <div class="p-4 flex-1">
                        <div class="space-y-3">
                            <template x-for="course in activeCourses" :key="course.id">
                                <div class="group p-3 rounded-xl border border-slate-100 dark:border-slate-700/60 hover:border-blue-200 dark:hover:border-blue-800 hover:bg-blue-50/30 dark:hover:bg-slate-700/30 transition-all duration-200 flex flex-col sm:flex-row gap-4 items-center">
                                    <!-- Thumbnail -->
                                    <div class="relative w-full sm:w-20 h-32 sm:h-14 rounded-lg overflow-hidden flex-shrink-0 bg-slate-200 dark:bg-slate-700">
                                        <img :src="course.image" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110" :alt="course.name">
                                    </div>
                                    
                                    <!-- Info -->
                                    <div class="flex-1 min-w-0 w-full text-center sm:text-left">
                                        <h4 class="text-sm font-bold text-slate-800 dark:text-white truncate mb-1" x-text="course.name"></h4>
                                        <div class="flex items-center justify-center sm:justify-start gap-3 mt-1.5">
                                            <div class="flex-1 h-1.5 bg-slate-200 dark:bg-slate-600 rounded-full overflow-hidden max-w-[200px]">
                                                <div class="h-full bg-blue-600 rounded-full transition-all duration-500" :style="`width: ${course.progress}%`"></div>
                                            </div>
                                            <span class="text-[10px] font-bold text-blue-600 dark:text-blue-400" x-text="`${course.progress}%`"></span>
                                        </div>
                                    </div>
                                    
                                    <!-- Action -->
                                    <a :href="`/student/courses/${course.id}/content`" class="px-4 py-2 bg-white dark:bg-slate-700 text-slate-600 dark:text-slate-300 text-xs font-bold rounded-lg border border-slate-200 dark:border-slate-600 hover:text-blue-600 hover:border-blue-200 dark:hover:border-blue-500 transition shadow-sm whitespace-nowrap w-full sm:w-auto text-center">
                                        চালিয়ে যান
                                    </a>
                                </div>
                            </template>
                            
                            <template x-if="activeCourses.length === 0">
                                <div class="text-center py-8 flex flex-col items-center justify-center text-slate-400">
                                    <i class="far fa-folder-open text-3xl mb-2 opacity-50"></i>
                                    <p class="text-sm">কোনো চলমান কোর্স নেই</p>
                                </div>
                            </template>
                        </div>
                    </div>
                </div>

                <!-- 4. Recommended Courses -->
                @if($recommendedCourses->count() > 0)
                <div class="bg-white dark:bg-slate-800 rounded-xl shadow-sm border border-slate-100 dark:border-slate-700 overflow-hidden">
                    <div class="px-6 py-4 border-b border-slate-100 dark:border-slate-700 bg-slate-50/50 dark:bg-slate-800/50">
                        <h3 class="text-sm font-bold text-slate-800 dark:text-white flex items-center gap-2">
                            <i class="fas fa-star text-amber-500"></i> আপনার জন্য সুপারিশকৃত
                        </h3>
                    </div>
                    <div class="p-4 grid grid-cols-1 sm:grid-cols-2 gap-4">
                        @foreach($recommendedCourses as $course)
                        <a href="{{ route('student.courses.show', $course->id) }}" class="flex items-center gap-3 p-3 rounded-xl border border-slate-100 dark:border-slate-700 hover:border-blue-200 dark:hover:border-blue-800 hover:shadow-md transition group bg-white dark:bg-slate-700/20">
                            <div class="w-16 h-16 rounded-lg overflow-hidden flex-shrink-0 bg-slate-200">
                                <img src="{{ $course->thumbnail_url }}" class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                            </div>
                            <div class="flex-1 min-w-0">
                                <h4 class="text-xs font-bold text-slate-800 dark:text-white truncate group-hover:text-blue-600 transition mb-1">{{ $course->title }}</h4>
                                <p class="text-[10px] text-slate-500 dark:text-slate-400 truncate mb-2">{{ $course->instructor->name ?? 'Instructor' }}</p>
                                <span class="text-[10px] font-bold bg-blue-50 dark:bg-blue-900/30 text-blue-600 dark:text-blue-300 px-2 py-0.5 rounded">
                                    {{ $course->price > 0 ? '৳'.number_format($course->price) : 'ফ্রি' }}
                                </span>
                            </div>
                        </a>
                        @endforeach
                    </div>
                </div>
                @endif
            </div>

            <!-- Right Column: Activity & Progress (1/3) -->
            <div class="space-y-6">
                
                <!-- Overall Progress -->
                <div class="bg-white dark:bg-slate-800 rounded-2xl shadow-sm border border-slate-100 dark:border-slate-700 p-6 flex flex-col items-center relative overflow-hidden">
                    <h3 class="text-sm font-bold text-slate-700 dark:text-slate-200 mb-4 w-full text-left">সামগ্রিক অগ্রগতি</h3>
                    
                    <div class="relative w-40 h-40">
                        <svg class="w-full h-full transform -rotate-90" viewBox="0 0 36 36">
                            <path class="text-slate-100 dark:text-slate-700" stroke-width="3" stroke="currentColor" fill="none" d="M18 2.0845 a 15.9155 15.9155 0 0 1 0 31.831 a 15.9155 15.9155 0 0 1 0 -31.831" />
                            <path class="text-blue-600 transition-all duration-1000 ease-out" stroke-dasharray="{{ $averageProgress }}, 100" stroke-width="3" stroke-linecap="round" stroke="currentColor" fill="none" d="M18 2.0845 a 15.9155 15.9155 0 0 1 0 31.831 a 15.9155 15.9155 0 0 1 0 -31.831" />
                        </svg>
                        <div class="absolute inset-0 flex flex-col items-center justify-center">
                            <span class="text-3xl font-extrabold text-slate-800 dark:text-white">{{ $averageProgress }}<span class="text-sm">%</span></span>
                            <span class="text-[10px] text-slate-400 font-bold uppercase tracking-wider mt-1">সম্পন্ন</span>
                        </div>
                    </div>
                    
                    <div class="mt-4 text-center w-full pt-4 border-t border-slate-100 dark:border-slate-700">
                        <div class="flex justify-between text-xs">
                            <span class="text-slate-500">মোট কোর্স: <strong class="text-slate-800 dark:text-white">{{ $totalEnrolled }}</strong></span>
                            <span class="text-slate-500">শেষ হয়েছে: <strong class="text-green-600">{{ $completedCourses }}</strong></span>
                        </div>
                    </div>
                </div>

                <!-- Recent Activity -->
                <div class="bg-white dark:bg-slate-800 rounded-2xl shadow-sm border border-slate-100 dark:border-slate-700 p-5">
                    <h3 class="text-sm font-bold text-slate-800 dark:text-white mb-5 flex items-center gap-2">
                        <i class="fas fa-history text-blue-500"></i> সাম্প্রতিক কার্যক্রম
                    </h3>
                    
                    <div class="space-y-0">
                        @if(count($recentActivitiesData) > 0)
                            <div class="relative border-l-2 border-slate-100 dark:border-slate-700 ml-2 space-y-6 pb-2">
                                @foreach($recentActivitiesData as $activity)
                                    <div class="relative pl-6 group">
                                        <div class="absolute -left-[5px] top-1.5 w-2.5 h-2.5 rounded-full bg-white dark:bg-slate-800 border-2 border-blue-500 z-10 group-hover:border-green-500 transition-colors"></div>
                                        <div class="flex flex-col">
                                            <span class="text-[10px] font-bold text-slate-400 uppercase tracking-wide mb-1">{{ $activity['time'] }}</span>
                                            <p class="text-xs text-slate-600 dark:text-slate-300 font-medium leading-snug">
                                                {{ $activity['message'] }}
                                            </p>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <div class="text-center py-6 text-slate-400">
                                <p class="text-xs">কোনো সাম্প্রতিক কার্যক্রম নেই</p>
                            </div>
                        @endif
                    </div>
                </div>

            </div>
        </div>
    </template>

    <!-- My Courses Tab (Filterable) -->
    <template x-if="activeTab === 'courses'">
         <div class="space-y-6">
            <div class="bg-white dark:bg-slate-800 rounded-2xl shadow-sm border border-slate-100 dark:border-slate-700 overflow-hidden p-5">
                <div class="flex flex-col sm:flex-row justify-between items-center gap-4">
                    <h3 class="text-lg font-bold text-slate-800 dark:text-white">আমার সকল কোর্স</h3>
                    <div class="flex gap-3 w-full sm:w-auto">
                        <div class="relative flex-1 sm:flex-none">
                            <i class="fas fa-search absolute left-3 top-1/2 -translate-y-1/2 text-slate-400 text-xs"></i>
                            <input type="text" class="w-full sm:w-48 pl-8 pr-3 py-2 text-xs border border-slate-200 dark:border-slate-600 rounded-lg bg-slate-50 dark:bg-slate-900 focus:ring-2 focus:ring-blue-500 focus:outline-none" placeholder="খুঁজুন..." x-model="courseSearchQuery">
                        </div>
                        <select x-model="courseFilter" class="px-3 py-2 text-xs border border-slate-200 dark:border-slate-600 rounded-lg bg-slate-50 dark:bg-slate-900 focus:ring-2 focus:ring-blue-500 focus:outline-none">
                            <option value="all">সব</option>
                            <option value="active">চলমান</option>
                            <option value="completed">সম্পন্ন</option>
                        </select>
                    </div>
                </div>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-5">
                <template x-for="course in filteredMyCourses" :key="course.id">
                    <div class="group bg-white dark:bg-slate-800 border border-slate-100 dark:border-slate-700 rounded-xl overflow-hidden hover:shadow-lg transition hover:-translate-y-1 flex flex-col h-full">
                        <div class="relative h-40 overflow-hidden">
                            <img class="w-full h-full object-cover group-hover:scale-105 transition duration-500" :src="course.image" :alt="course.name">
                            <div class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition flex items-center justify-center backdrop-blur-[1px]">
                                <button @click="continueCourse(course.id)" class="px-4 py-2 bg-white rounded-lg text-xs font-bold text-blue-600 hover:scale-105 transition shadow-lg">
                                    <i class="fas fa-play mr-1"></i> চালিয়ে যান
                                </button>
                            </div>
                            <div class="absolute top-3 right-3">
                                <span class="px-2 py-1 text-[10px] font-bold text-white rounded backdrop-blur-md shadow-sm uppercase"
                                      :class="course.status === 'completed' ? 'bg-green-500/90' : 'bg-blue-500/90'">
                                    <span x-text="course.status === 'completed' ? 'সম্পন্ন' : 'চলমান'"></span>
                                </span>
                            </div>
                        </div>
                        
                        <div class="p-4 flex-1 flex flex-col">
                            <div class="flex justify-between items-start mb-2">
                                <span class="text-[10px] bg-slate-100 dark:bg-slate-700 px-2 py-0.5 rounded text-slate-500 dark:text-slate-400 font-medium" x-text="course.instructor"></span>
                            </div>
                            <h3 class="text-sm font-bold text-slate-800 dark:text-white line-clamp-2 mb-3" x-text="course.name"></h3>
                            
                            <div class="mt-auto pt-3 border-t border-slate-100 dark:border-slate-700/50">
                                <div class="flex justify-between text-[10px] text-slate-500 mb-1.5">
                                    <span>অগ্রগতি</span>
                                    <span class="font-bold text-blue-600" x-text="`${course.progress}%`"></span>
                                </div>
                                <div class="w-full bg-slate-100 dark:bg-slate-700 rounded-full h-1.5 overflow-hidden">
                                    <div class="bg-blue-600 h-full rounded-full transition-all duration-500" :style="`width: ${course.progress}%`"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </template>
                
                <template x-if="filteredMyCourses.length === 0">
                    <div class="col-span-full text-center py-16 bg-white dark:bg-slate-800 rounded-xl border border-dashed border-slate-200 dark:border-slate-700">
                        <i class="far fa-sad-tear text-3xl text-slate-300 mb-3"></i>
                        <p class="text-sm text-slate-500">কোনো কোর্স পাওয়া যায়নি।</p>
                    </div>
                </template>
            </div>
        </div>
    </template>
    
    <!-- Certificates Tab Placeholder -->
    <template x-if="activeTab === 'certificates'">
        <div class="flex flex-col items-center justify-center py-20 text-slate-400 bg-white dark:bg-slate-800 rounded-2xl border border-dashed border-slate-200 dark:border-slate-700">
            <i class="fas fa-certificate text-4xl mb-3 opacity-50 text-yellow-500"></i>
            <p class="text-sm font-medium">আপনার সব সার্টিফিকেট এখানে দেখা যাবে।</p>
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
            // Optional: Handle URL hash for tabs
            const hash = window.location.hash.replace('#', '');
            if (['dashboard', 'courses', 'certificates'].includes(hash)) {
                this.activeTab = hash;
            }
        }
    }));
});
</script>
@endsection