<section class="relative w-full py-12 lg:py-16 overflow-hidden bg-slate-50 dark:bg-slate-900 transition-colors duration-300" x-data="coursesSection">
    
    <div class="absolute top-0 left-1/2 -translate-x-1/2 w-full h-full z-0 pointer-events-none">
        <div class="absolute top-20 left-10 w-72 h-72 bg-blue-500/10 rounded-full blur-[80px] mix-blend-multiply dark:mix-blend-screen animate-blob"></div>
        <div class="absolute bottom-20 right-10 w-72 h-72 bg-purple-500/10 rounded-full blur-[80px] mix-blend-multiply dark:mix-blend-screen animate-blob animation-delay-2000"></div>
    </div>

    <div class="container mx-auto px-4 relative z-10">
        
        <div class="text-center mb-10">
            <h2 class="text-2xl md:text-3xl font-bold text-slate-900 dark:text-white mb-3 font-heading">
                <span class="bg-clip-text text-transparent bg-gradient-to-r from-blue-600 dark:from-gray-100 via-purple-600 dark:via-purple-300 to-pink-600 dark:to-pink-200">
                    জনপ্রিয় কোর্সসমূহ
                </span>
            </h2>
            <p class="text-sm md:text-base text-slate-600 dark:text-slate-400 max-w-2xl mx-auto">
                স্কিল ডেভেলপমেন্টের জন্য বেছে নিন আপনার পছন্দের সেরা কোর্সটি
            </p>
        </div>

        <div class="flex flex-wrap justify-center gap-3 mb-12">
            <button @click="activeTab = 'web-development'" 
                    :class="activeTab === 'web-development' 
                        ? 'bg-blue-600 text-white shadow-lg shadow-blue-500/30 ring-2 ring-blue-600 ring-offset-2 ring-offset-slate-50 dark:ring-offset-slate-900' 
                        : 'bg-white dark:bg-slate-800 text-slate-600 dark:text-slate-300 hover:bg-slate-50 dark:hover:bg-slate-700 border border-slate-200 dark:border-slate-700'"
                    class="px-6 py-2.5 rounded-full font-bold text-sm transition-all duration-300 transform active:scale-95 flex items-center gap-2">
                ওয়েব ডেভেলপমেন্ট
            </button>
            <button @click="activeTab = 'web-design'" 
                    :class="activeTab === 'web-design' 
                        ? 'bg-blue-600 text-white shadow-lg shadow-blue-500/30 ring-2 ring-blue-600 ring-offset-2 ring-offset-slate-50 dark:ring-offset-slate-900' 
                        : 'bg-white dark:bg-slate-800 text-slate-600 dark:text-slate-300 hover:bg-slate-50 dark:hover:bg-slate-700 border border-slate-200 dark:border-slate-700'"
                    class="px-6 py-2.5 rounded-full font-bold text-sm transition-all duration-300 transform active:scale-95 flex items-center gap-2">
                ওয়েব ডিজাইন
            </button>
        </div>

        <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-3 md:gap-5">
            <template x-for="course in filteredCourses" :key="course.id">
                <div class="group bg-white dark:bg-slate-800/50 backdrop-blur-sm rounded-xl border border-slate-200 dark:border-slate-700 hover:border-blue-500/50 dark:hover:border-blue-500/50 shadow-sm hover:shadow-xl transition-all duration-300 flex flex-col h-full overflow-hidden">
                    
                    <div class="relative h-40 overflow-hidden">
                        <img :src="course.image" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110" alt="Thumbnail">
                        <div class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-center justify-center backdrop-blur-[2px]">
                            <a :href="`/courses/${course.id}`" class="w-10 h-10 bg-white/90 rounded-full flex items-center justify-center text-blue-600 shadow-lg transform translate-y-4 group-hover:translate-y-0 transition-all duration-300">
                                <i class="fas fa-play ml-1 text-sm"></i>
                            </a>
                        </div>
                        <div class="absolute top-3 left-3">
                            <span class="px-2 py-1 text-[10px] font-bold text-white rounded-md backdrop-blur-md shadow-sm"
                                  :class="course.level === 'বিগিনার' ? 'bg-green-500/80' : (course.level === 'এডভান্সড' ? 'bg-red-500/80' : 'bg-blue-500/80')">
                                <span x-text="course.level"></span>
                            </span>
                        </div>
                    </div>

                    <div class="p-4 flex flex-col flex-grow">
                        <div class="flex justify-between items-center mb-2 text-[11px] font-medium text-slate-500 dark:text-slate-400">
                            <div class="flex items-center text-[10px] bg-slate-100 dark:bg-slate-700/50 text-slate-600 dark:text-slate-300 font-semibold px-2 py-0.5 rounded border border-slate-200 dark:border-slate-700 gap-1">
                                <i class="fas fa-user-graduate"></i> <span x-text="course.students"></span>
                            </div>
                            <div class="flex items-center gap-1 bg-slate-100 dark:bg-slate-700/50 text-slate-600 dark:text-slate-300 text-[10px] font-semibold px-2 py-0.5 rounded border border-slate-200 dark:border-slate-700">
                                <i class="far fa-file-video"></i> <span x-text="course.lessons + ' লেসন'"></span>
                            </div>
                        </div>

                        <h3 class="text-base font-bold text-slate-900 dark:text-white mb-2 line-clamp-2 leading-snug group-hover:text-blue-600 dark:group-hover:text-blue-400 transition-colors" x-text="course.title"></h3>
                        
                        <div class="flex items-center gap-2 mb-4">
                            <div class="w-6 h-6 rounded-full bg-slate-200 dark:bg-slate-700 overflow-hidden">
                                <img :src="`https://ui-avatars.com/api/?name=${course.instructor}&background=random&color=fff`" class="w-full h-full object-cover">
                            </div>
                            <span class="text-xs text-slate-600 dark:text-slate-400 truncate" x-text="course.instructor"></span>
                        </div>

                        <div class="mt-auto pt-3 border-t border-slate-100 dark:border-slate-700/50 flex justify-between items-center">
                            <div>
                                <template x-if="course.discount_price">
                                    <div class="flex flex-col leading-none">
                                        <span class="text-lg font-bold text-slate-900 dark:text-white">৳<span x-text="course.discount_price"></span></span>
                                        <span class="text-[10px] text-slate-400 line-through">৳<span x-text="course.price"></span></span>
                                    </div>
                                </template>
                                <template x-if="!course.discount_price">
                                    <span class="text-lg font-bold text-slate-900 dark:text-white">৳<span x-text="course.price"></span></span>
                                </template>
                            </div>
                            <a :href="`/courses/${course.id}`" class="text-sm font-bold text-blue-600 dark:text-blue-400 hover:text-blue-700 dark:hover:text-blue-300 transition flex items-center gap-1">
                                বিস্তারিত <i class="fas fa-arrow-right text-xs"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </template>
        </div>

        <div class="text-center mt-10">
            <a href="/courses" class="inline-flex items-center px-8 py-3 bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 text-slate-700 dark:text-white rounded-full font-medium text-sm hover:bg-slate-50 dark:hover:bg-slate-700 hover:shadow-lg transition-all duration-300 group">
                সব কোর্স দেখুন <i class="fas fa-arrow-right ml-2 group-hover:translate-x-1 transition-transform"></i>
            </a>
        </div>
    </div>

    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('coursesSection', () => ({
                activeTab: 'web-development',
                // কন্ট্রোলার থেকে আসা $courses ভ্যারিয়েবল এখানে ব্যবহার করা হচ্ছে
                courses: @json($courses), 
                get filteredCourses() {
                    return this.courses.filter(c => c.category === this.activeTab);
                }
            }));
        });
    </script>
    
    <style>
        .animate-blob { animation: blob 7s infinite; }
        .animation-delay-2000 { animation-delay: 2s; }
        @keyframes blob {
            0% { transform: translate(0px, 0px) scale(1); }
            33% { transform: translate(30px, -50px) scale(1.1); }
            66% { transform: translate(-20px, 20px) scale(0.9); }
            100% { transform: translate(0px, 0px) scale(1); }
        }
    </style>
</section>