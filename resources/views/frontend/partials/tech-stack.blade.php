<section class="relative py-20 overflow-hidden bg-slate-50 dark:bg-slate-900 transition-colors duration-300" x-data="techStack">
    
    <!-- Seamless Background Integration (Hero Style) -->
    <div class="absolute inset-0 pointer-events-none">
        <!-- Top Gradient to blend with previous section -->
        <div class="absolute top-0 left-0 w-full h-24 bg-gradient-to-b from-slate-50 dark:from-slate-900 to-transparent z-10"></div>
        
        <!-- Mesh Gradients -->
        <div class="absolute top-1/4 left-0 w-[600px] h-[600px] bg-blue-500/5 dark:bg-blue-600/10 rounded-full blur-[100px] -translate-x-1/2 animate-pulse"></div>
        <div class="absolute bottom-0 right-0 w-[600px] h-[600px] bg-purple-500/5 dark:bg-purple-600/10 rounded-full blur-[100px] translate-x-1/2 animate-pulse delay-1000"></div>
        
        <!-- Grid Pattern -->
        <svg class="absolute inset-0 w-full h-full opacity-[0.02] dark:opacity-[0.03]" xmlns="http://www.w3.org/2000/svg">
            <defs>
                <pattern id="tech-grid" width="40" height="40" patternUnits="userSpaceOnUse">
                    <path d="M 40 0 L 0 0 0 40" fill="none" stroke="currentColor" stroke-width="1"/>
                </pattern>
            </defs>
            <rect width="100%" height="100%" fill="url(#tech-grid)" />
        </svg>
    </div>

    <div class="container mx-auto px-4 relative z-10">
        
        <!--Section Header -->
        <div class="text-center mb-10">
            <h2 class="text-2xl md:text-3xl font-bold text-slate-900 dark:text-white mb-3 font-heading">
                <span class="bg-clip-text text-transparent bg-gradient-to-r from-blue-600 dark:from-gray-100 via-purple-600 dark:via-purple-300 to-pink-600 dark:to-pink-200">
                    সম্পূর্ণ টেক স্ট্যাক
                </span>
            </h2>
            <p class="text-sm md:text-base text-slate-600 dark:text-slate-400 max-w-2xl mx-auto">
                এই কোর্সে আপনি শিখবেন শূন্য থেকে এডভান্সড লেভেল পর্যন্ত ইন্ডাস্ট্রির সেরা টুলস এবং টেকনোলজি
            </p>
        </div>

        <!-- Modern Tab Navigation -->
        <div class="flex flex-wrap justify-center gap-3 mb-12">
            <template x-for="tab in tabs" :key="tab.id">
                <button @click="activeTab = tab.id"
                        :class="activeTab === tab.id 
                            ? 'bg-blue-600 text-white shadow-lg shadow-blue-500/30 ring-2 ring-blue-600 ring-offset-2 ring-offset-slate-50 dark:ring-offset-slate-900' 
                            : 'bg-white dark:bg-slate-800 text-slate-600 dark:text-slate-300 hover:bg-slate-50 dark:hover:bg-slate-700 border border-slate-200 dark:border-slate-700'"
                        class="px-6 py-2.5 rounded-full font-bold text-sm transition-all duration-300 transform active:scale-95 flex items-center gap-2">
                    <span x-text="tab.label"></span>
                </button>
            </template>
        </div>

        <!-- Tech Cards Grid (Course Card Style) -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            <template x-for="item in filteredItems" :key="item.id">
                <div class="group relative bg-white/80 dark:bg-slate-800/60 backdrop-blur-xl rounded-2xl p-6 border border-slate-200 dark:border-slate-700 hover:border-blue-500/50 dark:hover:border-blue-500/50 shadow-sm hover:shadow-xl transition-all duration-500 hover:-translate-y-2 flex flex-col h-full overflow-hidden">
                    
                    <!-- Gradient Glow Effect on Hover -->
                    <div class="absolute inset-0 bg-gradient-to-br from-blue-500/5 to-purple-500/5 opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                    
                    <!-- Icon Box -->
                    <div class="relative w-16 h-16 rounded-2xl flex items-center justify-center mb-6 transition-transform duration-500 group-hover:scale-110 group-hover:rotate-3 shadow-inner"
                         :class="item.bgColor">
                        <i :class="[item.icon, item.color]" class="text-3xl drop-shadow-sm"></i>
                    </div>

                    <!-- Content -->
                    <div class="relative flex-1 flex flex-col">
                        <h3 class="text-xl font-bold text-slate-900 dark:text-white mb-3 font-heading group-hover:text-blue-600 dark:group-hover:text-blue-400 transition-colors" 
                            x-text="item.title"></h3>
                        
                        <p class="text-sm text-slate-600 dark:text-slate-400 leading-relaxed mb-4 line-clamp-3" 
                           x-text="item.description"></p>
                        
                        <!-- Category Tag -->
                        <div class="mt-auto pt-4 border-t border-slate-100 dark:border-slate-700/50 flex items-center justify-between">
                            <span class="text-[10px] font-bold uppercase tracking-wider text-slate-400 dark:text-slate-500" x-text="item.category"></span>
                            <div class="w-6 h-6 rounded-full bg-slate-100 dark:bg-slate-700 flex items-center justify-center text-slate-400 group-hover:bg-blue-600 group-hover:text-white transition-colors duration-300">
                                <i class="fas fa-arrow-right text-[10px] transform group-hover:translate-x-0.5 transition-transform"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </template>
        </div>

    </div>

    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('techStack', () => ({
                activeTab: 'all',
                tabs: [
                    { id: 'all', label: 'সবকিছু' },
                    { id: 'frontend', label: 'ফ্রন্টএন্ড' },
                    { id: 'backend', label: 'ব্যাকএন্ড' },
                    { id: 'frameworks', label: 'ফ্রেমওয়ার্ক' }
                ],
                techItems: [
                    // Frontend
                    { id: 1, title: 'HTML5 & Semantic', icon: 'fab fa-html5', color: 'text-orange-500', bgColor: 'bg-orange-100 dark:bg-orange-900/30', category: 'frontend', description: 'মডার্ন ওয়েব স্ট্রাকচার, সেমান্টিক ট্যাগ এবং এক্সেসিবিলিটি স্ট্যান্ডার্ড।' },
                    { id: 2, title: 'CSS3 & Animation', icon: 'fab fa-css3-alt', color: 'text-blue-500', bgColor: 'bg-blue-100 dark:bg-blue-900/30', category: 'frontend', description: 'ফ্লেক্সবক্স, গ্রিড লেআউট, কি-ফ্রেম এনিমেশন এবং রেস্পন্সিভ ডিজাইন।' },
                    { id: 3, title: 'JavaScript (ES6+)', icon: 'fab fa-js', color: 'text-yellow-500', bgColor: 'bg-yellow-100 dark:bg-yellow-900/30', category: 'frontend', description: 'মডার্ন জাভাস্ক্রিপ্ট, DOM ম্যানিপুলেশন, Fetch API এবং Async/Await।' },
                    { id: 4, title: 'Tailwind CSS', icon: 'fas fa-wind', color: 'text-cyan-500', bgColor: 'bg-cyan-100 dark:bg-cyan-900/30', category: 'frontend', description: 'ইউটিলিটি-ফার্স্ট ফ্রেমওয়ার্ক দিয়ে দ্রুত এবং রেস্পন্সিভ ইউজার ইন্টারফেস ডিজাইন।' },
                    
                    // Backend
                    { id: 5, title: 'PHP 8.x', icon: 'fab fa-php', color: 'text-indigo-500', bgColor: 'bg-indigo-100 dark:bg-indigo-900/30', category: 'backend', description: 'স্ট্রং টাইপিং, OOP কনসেপ্ট এবং মডার্ন সার্ভার সাইড প্রোগ্রামিং।' },
                    { id: 6, title: 'MySQL Database', icon: 'fas fa-database', color: 'text-blue-600', bgColor: 'bg-blue-100 dark:bg-blue-900/30', category: 'backend', description: 'কমপ্লেক্স কুয়েরি, রিলেশনশিপ ডিজাইন এবং ডেটাবেস অপ্টিমাইজেশন।' },
                    
                    // Frameworks
                    { id: 7, title: 'Laravel 10/11', icon: 'fab fa-laravel', color: 'text-red-600', bgColor: 'bg-red-100 dark:bg-red-900/30', category: 'frameworks', description: 'পাওয়ারফুল ব্যাকএন্ড ফ্রেমওয়ার্ক, সিকিউরিটি এবং রেস্টফুল API ডেভেলপমেন্ট।' },
                    { id: 8, title: 'Vue.js 3', icon: 'fab fa-vuejs', color: 'text-emerald-500', bgColor: 'bg-emerald-100 dark:bg-emerald-900/30', category: 'frameworks', description: 'কম্পোজিশন API এবং পিনিয়া স্টেট ম্যানেজমেন্ট সহ রিয়েক্টিভ ফ্রন্টএন্ড।' },
                ],
                get filteredItems() {
                    if (this.activeTab === 'all') return this.techItems;
                    return this.techItems.filter(item => item.category === this.activeTab);
                }
            }));
        });
    </script>
</section>