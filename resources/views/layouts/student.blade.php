<!DOCTYPE html>
<html lang="en" x-data="studentApp()" x-init="init()" :class="{'dark': isDark}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'ProjuktiPlus LMS - Student Dashboard')</title>
    
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Alpine.js -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <!-- বাংলা ফন্ট ইম্পোর্ট -->
    <link href="https://fonts.googleapis.com/css2?family=Hind+Siliguri:wght@400;500;600;700&family=Kohinoor+Bangla:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    colors: {
                        slate: {
                            50: '#f8fafc',
                            100: '#f1f5f9',
                            200: '#e2e8f0',
                            800: '#1e293b',
                            900: '#0f172a',
                            950: '#020617'
                        },
                        primary: {
                            500: '#6366f1',
                            600: '#4f46e5'
                        }
                    },
                    fontFamily: {
                        'heading': ['Hind Siliguri', 'sans-serif'],
                        'body': ['Kohinoor Bangla', 'sans-serif']
                    }
                }
            }
        }
    </script>

    <style>
        body {
            font-family: 'Kohinoor Bangla', sans-serif;
            letter-spacing: .5px;
        }
        h1, h2, h3, h4, h5, h6 {
            font-family: 'Hind Siliguri', sans-serif;
        }
        [x-cloak] { display: none !important; }
        .sidebar-link.active {
            background-color: rgba(59, 130, 246, 0.1);
            color: #3b82f6;
            border-left: 3px solid #3b82f6;
        }
        .sidebar-link.active:hover {
            background-color: rgba(59, 130, 246, 0.2);
        }
        .course-card {
            transition: all 0.3s ease;
        }
        .course-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1);
        }
        .progress-ring__circle {
            transition: stroke-dashoffset 0.5s ease;
            transform: rotate(-90deg);
            transform-origin: 50% 50%;
        }
    </style>
    
    @stack('styles')
</head>
<body class="bg-gray-50 dark:bg-slate-900 text-gray-800 dark:text-slate-300 min-h-screen">
    @include('partials.student-sidebar')
    
    <!-- Main Content -->
    <div class="flex-1 flex flex-col overflow-hidden ml-0 md:ml-64">
        @include('partials.student-header')
        
        <main class="flex-1 overflow-y-auto p-2 md:p-4 bg-gray-50 dark:bg-slate-900 flex flex-col">
            <div class="flex-1 mb-4">
                @yield('student-content')
            </div>
            
            <!-- ফুটার এখানে যুক্ত করতে পারেন যদি চান -->
            @includeIf('partials.footer')
        </main>
    </div>

    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('studentApp', () => ({
                // App state
                isDark: false,
                isMobileMenuOpen: false,
                activeTab: 'dashboard',
                courseSearchQuery: '',
                courseFilter: 'all',
                
                // Student data
                student: {
                    name: "নাঈমুর রহমান",
                    email: "arif@example.com",
                    phone: "01712345678",
                    joinDate: "১৫ জানুয়ারি, ২০২৩"
                },
                
                // Active courses (for dashboard)
                activeCourses: [
                    {
                        id: 1,
                        name: "লারাভেল অ্যান্ড ভিউ",
                        image: "https://cdn.ostad.app/public/upload/2023-06-12T06-26-02.391Z-projuktiplus-logo.svg",
                        progress: 65,
                        lastAccessed: "২ ঘন্টা আগে"
                    },
                    {
                        id: 2,
                        name: "রিয়েক্ট জেএস",
                        image: "https://cdn.ostad.app/public/upload/2023-06-12T06-26-02.391Z-projuktiplus-logo.svg",
                        progress: 30,
                        lastAccessed: "১ দিন আগে"
                    }
                ],
                
                // My courses (for courses tab)
                myCourses: [
                    {
                        id: 1,
                        name: "লারাভেল অ্যান্ড ভিউ",
                        image: "https://cdn.ostad.app/public/upload/2023-06-12T06-26-02.391Z-projuktiplus-logo.svg",
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
                        image: "https://cdn.ostad.app/public/upload/2023-06-12T06-26-02.391Z-projuktiplus-logo.svg",
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
                        image: "https://cdn.ostad.app/public/upload/2023-06-12T06-26-02.391Z-projuktiplus-logo.svg",
                        instructor: "মো. গালিব হাসান",
                        progress: 100,
                        status: "completed",
                        completedLessons: 15,
                        totalLessons: 15,
                        lastAccessed: "২ সপ্তাহ আগে"
                    },
                    {
                        id: 4,
                        name: "ইউআই/ইউএক্স ডিজাইন",
                        image: "https://cdn.ostad.app/public/upload/2023-06-12T06-26-02.391Z-projuktiplus-logo.svg",
                        instructor: "ফয়সাল আজম সিদ্দিকী",
                        progress: 100,
                        status: "completed",
                        completedLessons: 12,
                        totalLessons: 12,
                        lastAccessed: "১ মাস আগে"
                    },
                    {
                        id: 5,
                        name: "ডাটা সায়েন্স",
                        image: "https://cdn.ostad.app/public/upload/2023-06-12T06-26-02.391Z-projuktiplus-logo.svg",
                        instructor: "নায়েম ইসলাম",
                        progress: 80,
                        status: "active",
                        completedLessons: 8,
                        totalLessons: 10,
                        lastAccessed: "৩ দিন আগে"
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
                
                // Resources
                resources: [
                    {
                        id: 1,
                        name: "লারাভেল চিটশিট",
                        course: "লারাভেল অ্যান্ড ভিউ",
                        type: "pdf",
                        size: "2.4 MB"
                    },
                    {
                        id: 2,
                        name: "রিয়েক্ট কম্পোনেন্ট লাইব্রেরি",
                        course: "রিয়েক্ট জেএস",
                        type: "zip",
                        size: "5.1 MB"
                    },
                    {
                        id: 3,
                        name: "ডাটা ভিজ্যুয়ালাইজেশন টেমপ্লেট",
                        course: "ডাটা সায়েন্স",
                        type: "pdf",
                        size: "3.7 MB"
                    }
                ],
                
                // Progress courses
                progressCourses: [
                    {
                        id: 1,
                        name: "লারাভেল অ্যান্ড ভিউ",
                        progress: 65,
                        completedLessons: 13,
                        remainingLessons: 7
                    },
                    {
                        id: 2,
                        name: "রিয়েক্ট জেএস",
                        progress: 30,
                        completedLessons: 6,
                        remainingLessons: 14
                    },
                    {
                        id: 3,
                        name: "ডাটা সায়েন্স",
                        progress: 80,
                        completedLessons: 8,
                        remainingLessons: 2
                    },
                    {
                        id: 4,
                        name: "MERN স্ট্যাক ডেভেলপমেন্ট",
                        progress: 100,
                        completedLessons: 15,
                        remainingLessons: 0
                    },
                    {
                        id: 5,
                        name: "ইউআই/ইউএক্স ডিজাইন",
                        progress: 100,
                        completedLessons: 12,
                        remainingLessons: 0
                    }
                ],
                
                // Computed properties
                get filteredMyCourses() {
                    let courses = this.myCourses;
                    
                    // Filter by search query
                    if (this.courseSearchQuery) {
                        courses = courses.filter(course => 
                            course.name.toLowerCase().includes(this.courseSearchQuery.toLowerCase()) ||
                            course.instructor.toLowerCase().includes(this.courseSearchQuery.toLowerCase())
                        );
                    }
                    
                    // Filter by status
                    if (this.courseFilter !== 'all') {
                        courses = courses.filter(course => course.status === this.courseFilter);
                    }
                    
                    return courses;
                },
                
                // Methods
                init() {
                    // Check for dark mode preference
                    this.isDark = localStorage.getItem('darkMode') === 'true' || 
                                 (!('darkMode' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches);
                    
                    // Set active tab from URL hash if present
                    const hash = window.location.hash.substring(1);
                    if (hash && ['dashboard', 'courses', 'progress', 'certificates', 'resources'].includes(hash)) {
                        this.activeTab = hash;
                    }
                },
                
                viewCourse(courseId) {
                    // In a real app, this would navigate to the course detail page
                    alert(`Viewing course with ID: ${courseId}`);
                },
                
                continueCourse(courseId) {
                    // In a real app, this would continue the last accessed lesson
                    alert(`Continuing course with ID: ${courseId}`);
                },
                
                startQuiz(quizId) {
                    // In a real app, this would start the quiz
                    alert(`Starting quiz with ID: ${quizId}`);
                },
                
                viewCertificate(certificateId) {
                    // In a real app, this would download the certificate
                    alert(`Downloading certificate with ID: ${certificateId}`);
                },
                
                shareCertificate(certificateId) {
                    // In a real app, this would share the certificate
                    alert(`Sharing certificate with ID: ${certificateId}`);
                },
                
                downloadResource(resourceId) {
                    // In a real app, this would download the resource
                    alert(`Downloading resource with ID: ${resourceId}`);
                },
                
                logout() {
                    // In a real app, this would clear the session and redirect to login
                    alert('Logging out...');
                    window.location.href = '/login';
                }
            }));
        });
    </script>
    
    @stack('scripts')
</body>
</html>