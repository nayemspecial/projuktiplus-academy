<section class="relative w-full py-16 lg:py-20 overflow-hidden bg-slate-50 dark:bg-slate-900 transition-colors duration-300" x-data="coursesSection">
    
    <!-- Modern Mesh Gradient Background -->
    <div class="absolute top-0 left-1/2 -translate-x-1/2 w-full h-full z-0 pointer-events-none">
        <div class="absolute top-20 left-10 w-72 h-72 bg-blue-500/10 rounded-full blur-[80px] mix-blend-multiply dark:mix-blend-screen animate-blob"></div>
        <div class="absolute bottom-20 right-10 w-72 h-72 bg-purple-500/10 rounded-full blur-[80px] mix-blend-multiply dark:mix-blend-screen animate-blob animation-delay-2000"></div>
    </div>

    <div class="container mx-auto px-4 relative z-10">
        
        <!-- Header -->
        <div class="text-center mb-12">
            <h2 class="text-3xl md:text-4xl font-bold text-slate-900 dark:text-white mb-3 font-heading">
                <span class="bg-clip-text text-transparent bg-gradient-to-r from-blue-600 via-purple-600 to-pink-600">
                    প্রযুক্তি প্লাস কোর্সসমূহ
                </span>
            </h2>
            <p class="text-base md:text-lg text-slate-600 dark:text-slate-400 max-w-2xl mx-auto">
                আপনার দক্ষতা উন্নত করতে আমাদের বিশেষায়িত কোর্সগুলো থেকে বেছে নিন সেরাটি
            </p>
        </div>

        <!-- Modern Tab Navigation (Style Copied from Tech Stack) -->
        <div class="flex flex-wrap justify-center gap-3 mb-12">
            <button @click="activeTab = 'web-design'" 
                    :class="activeTab === 'web-design' 
                        ? 'bg-blue-600 text-white shadow-lg shadow-blue-500/30 ring-2 ring-blue-600 ring-offset-2 ring-offset-slate-50 dark:ring-offset-slate-900' 
                        : 'bg-white dark:bg-slate-800 text-slate-600 dark:text-slate-300 hover:bg-slate-50 dark:hover:bg-slate-700 border border-slate-200 dark:border-slate-700'"
                    class="px-6 py-2.5 rounded-full font-bold text-sm transition-all duration-300 transform active:scale-95 flex items-center gap-2">
                ওয়েব ডিজাইন
            </button>
            <button @click="activeTab = 'web-development'" 
                    :class="activeTab === 'web-development' 
                        ? 'bg-blue-600 text-white shadow-lg shadow-blue-500/30 ring-2 ring-blue-600 ring-offset-2 ring-offset-slate-50 dark:ring-offset-slate-900' 
                        : 'bg-white dark:bg-slate-800 text-slate-600 dark:text-slate-300 hover:bg-slate-50 dark:hover:bg-slate-700 border border-slate-200 dark:border-slate-700'"
                    class="px-6 py-2.5 rounded-full font-bold text-sm transition-all duration-300 transform active:scale-95 flex items-center gap-2">
                ওয়েব ডেভেলপমেন্ট
            </button>
        </div>

        <!-- Course Grid -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            <template x-for="course in filteredCourses" :key="course.id">
                <div class="group bg-white dark:bg-slate-800/60 backdrop-blur-sm rounded-2xl border border-slate-200 dark:border-slate-700 hover:border-blue-500/50 dark:hover:border-blue-500/50 shadow-sm hover:shadow-xl transition-all duration-300 flex flex-col h-full overflow-hidden hover:-translate-y-1">
                    
                    <!-- Thumbnail Area -->
                    <div class="relative h-48 overflow-hidden">
                        <img :src="course.image" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110" alt="Thumbnail">
                        
                        <!-- Overlay -->
                        <div class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-center justify-center backdrop-blur-[2px]">
                            <button class="w-12 h-12 bg-white/90 rounded-full flex items-center justify-center text-blue-600 shadow-lg transform translate-y-4 group-hover:translate-y-0 transition-all duration-300">
                                <i class="fas fa-play ml-1 text-lg"></i>
                            </button>
                        </div>

                        <!-- Top Badges -->
                        <div class="absolute top-3 left-3 flex flex-col gap-1">
                            <!-- Level Badge -->
                            <span class="px-2.5 py-1 text-[10px] font-bold text-white rounded-md backdrop-blur-md shadow-sm uppercase tracking-wider border border-white/20"
                                  :class="course.level === 'বিগিনার' ? 'bg-emerald-500/90' : (course.level === 'এডভান্সড' ? 'bg-red-500/90' : 'bg-blue-500/90')">
                                <span x-text="course.level"></span>
                            </span>
                        </div>
                    </div>

                    <!-- Content -->
                    <div class="p-5 flex flex-col flex-grow">
                        
                        <!-- Info Tags (New Addition) -->
                        <div class="flex flex-wrap gap-2 mb-3">
                            <span class="bg-slate-100 dark:bg-slate-700/50 text-slate-600 dark:text-slate-300 text-[10px] font-semibold px-2 py-0.5 rounded border border-slate-200 dark:border-slate-700">
                                <i class="fas fa-layer-group mr-1 text-blue-500"></i> <span x-text="course.category === 'web-design' ? 'Design' : 'Dev'"></span>
                            </span>
                            <span class="bg-slate-100 dark:bg-slate-700/50 text-slate-600 dark:text-slate-300 text-[10px] font-semibold px-2 py-0.5 rounded border border-slate-200 dark:border-slate-700">
                                <i class="far fa-file-video mr-1 text-purple-500"></i> <span x-text="course.lessons + ' লেসন'"></span>
                            </span>
                        </div>

                        <!-- Title -->
                        <h3 class="text-base md:text-lg font-bold text-slate-900 dark:text-white mb-2 line-clamp-2 leading-snug group-hover:text-blue-600 dark:group-hover:text-blue-400 transition-colors font-heading" x-text="course.title"></h3>
                        
                        <!-- Rating Row -->
                        <div class="flex items-center gap-1 mb-4 text-xs font-medium">
                            <div class="flex text-amber-400">
                                <i class="fas fa-star"></i>
                            </div>
                            <span class="text-slate-700 dark:text-slate-200 font-bold" x-text="course.rating"></span>
                            <span class="text-slate-400">reviews (<span x-text="course.reviews"></span>)</span>
                        </div>

                        <!-- Instructor (Compact) -->
                        <div class="flex items-center gap-2.5 mb-4 pt-3 border-t border-slate-100 dark:border-slate-700/50">
                            <div class="w-7 h-7 rounded-full bg-slate-200 dark:bg-slate-700 overflow-hidden border border-slate-100 dark:border-slate-600">
                                <img :src="`https://ui-avatars.com/api/?name=${course.instructor}&background=random&color=fff`" class="w-full h-full object-cover">
                            </div>
                            <span class="text-xs text-slate-600 dark:text-slate-400 truncate font-medium flex-1" x-text="course.instructor"></span>
                            
                            <div class="flex items-center text-[10px] text-slate-400 gap-1" title="Students">
                                <i class="fas fa-user-graduate"></i> <span x-text="course.students"></span>
                            </div>
                        </div>

                        <!-- Footer: Price & Button -->
                        <div class="mt-auto flex justify-between items-center">
                            <div>
                                <template x-if="course.discount_price">
                                    <div class="flex flex-col leading-none">
                                        <span class="text-lg font-bold text-slate-900 dark:text-white">৳<span x-text="course.discount_price"></span></span>
                                        <span class="text-[10px] text-slate-400 line-through decoration-slate-400/50">৳<span x-text="course.price"></span></span>
                                    </div>
                                </template>
                                <template x-if="!course.discount_price">
                                    <span class="text-lg font-bold text-slate-900 dark:text-white">৳<span x-text="course.price"></span></span>
                                </template>
                            </div>
                            
                            <button class="inline-flex items-center justify-center w-9 h-9 rounded-full bg-blue-50 dark:bg-blue-900/20 text-blue-600 dark:text-blue-400 hover:bg-blue-600 hover:text-white dark:hover:bg-blue-500 dark:hover:text-white transition-all duration-300 shadow-sm">
                                <i class="fas fa-arrow-right text-xs"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </template>
        </div>

        <div class="text-center mt-12">
            <a href="/courses" class="inline-flex items-center px-8 py-3 bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 text-slate-700 dark:text-white rounded-full font-bold text-sm hover:bg-slate-50 dark:hover:bg-slate-700 hover:shadow-lg transition-all duration-300 group">
                সব কোর্স দেখুন <i class="fas fa-arrow-right ml-2 group-hover:translate-x-1 transition-transform"></i>
            </a>
        </div>
    </div>

    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('coursesSection', () => ({
                activeTab: 'web-development',
                courses: [
                    { 
                        id: 1, 
                        title: 'HTML5 & CSS3 মডার্ন রেসপনসিভ ডিজাইন', 
                        image: 'https://images.unsplash.com/photo-1587620962725-abab7fe55159?w=500&q=80', 
                        level: 'বিগিনার', 
                        category: 'web-design',
                        instructor: 'আরিফুর রহমান',
                        price: '২০০০',
                        discount_price: '১০০০',
                        rating: '4.8',
                        reviews: '120',
                        lessons: '45',
                        students: '1.2k'
                    },
                    { 
                        id: 2, 
                        title: 'জাভাস্ক্রিপ্ট ES6+ ডমিনেশন কোর্স', 
                        image: 'https://images.unsplash.com/photo-1627398242450-274ec32af286?w=500&q=80', 
                        level: 'ইন্টারমিডিয়েট', 
                        category: 'web-development',
                        instructor: 'শাফায়েত রানা',
                        price: '৩৫০০',
                        discount_price: '২৫০০',
                        rating: '4.9',
                        reviews: '250',
                        lessons: '60',
                        students: '980'
                    },
                    { 
                        id: 3, 
                        title: 'লারাভেল ১০ দিয়ে ই-কমার্স ওয়েবসাইট', 
                        image: 'https://images.unsplash.com/photo-1607799275518-d58665d099db?w=500&q=80', 
                        level: 'এডভান্সড', 
                        category: 'web-development',
                        instructor: 'মোঃ নাঈমুর রহমান',
                        price: '৫০০০',
                        discount_price: '৩০০০',
                        rating: '5.0',
                        reviews: '500',
                        lessons: '120',
                        students: '1.5k'
                    },
                    { 
                        id: 4, 
                        title: 'ভিউ জেএস ৩ এবং পিনিয়া মাস্টারক্লাস', 
                        image: 'https://images.unsplash.com/photo-1618477388954-7852f32655ec?w=500&q=80', 
                        level: 'ইন্টারমিডিয়েট', 
                        category: 'web-development',
                        instructor: 'জামাল উদ্দিন',
                        price: '৪০০০',
                        discount_price: null,
                        rating: '4.7',
                        reviews: '80',
                        lessons: '55',
                        students: '850'
                    },
                    { 
                        id: 5, 
                        title: 'Tailwind CSS দিয়ে মডার্ন UI ডিজাইন', 
                        image: 'https://images.unsplash.com/photo-1613490963510-85f3398c5e9f?w=500&q=80', 
                        level: 'বিগিনার', 
                        category: 'web-design',
                        instructor: 'সাদিয়া আফরিন',
                        price: '১৫০০',
                        discount_price: '৯৯৯',
                        rating: '4.9',
                        reviews: '300',
                        lessons: '30',
                        students: '2.1k'
                    }
                ],
                get filteredCourses() {
                    return this.courses.filter(c => c.category === this.activeTab);
                }
            }));
        });
    </script>
    
    <style>
        @keyframes blob {
            0% { transform: translate(0px, 0px) scale(1); }
            33% { transform: translate(30px, -50px) scale(1.1); }
            66% { transform: translate(-20px, 20px) scale(0.9); }
            100% { transform: translate(0px, 0px) scale(1); }
        }
        .animate-blob {
            animation: blob 7s infinite;
        }
        .animation-delay-2000 {
            animation-delay: 2s;
        }
    </style>
</section>