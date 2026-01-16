<section class="relative py-20 overflow-hidden bg-slate-50 dark:bg-slate-900 transition-colors duration-300" x-data="techStack">
    
    <div class="absolute inset-0 pointer-events-none">
        <div class="absolute top-0 left-0 w-full h-24 bg-gradient-to-b from-slate-50 dark:from-slate-900 to-transparent z-10"></div>
        <div class="absolute top-1/4 left-0 w-[600px] h-[600px] bg-blue-500/5 dark:bg-blue-600/10 rounded-full blur-[100px] -translate-x-1/2 animate-pulse"></div>
        <div class="absolute bottom-0 right-0 w-[600px] h-[600px] bg-purple-500/5 dark:bg-purple-600/10 rounded-full blur-[100px] translate-x-1/2 animate-pulse delay-1000"></div>
    </div>

    <div class="container mx-auto px-4 relative z-10">
        
        <div class="text-center mb-10">
            <span class="text-primary-600 dark:text-primary-400 font-bold tracking-wider uppercase text-xs mb-2 block font-heading">টেকনোলজি স্ট্যাক</span>
            <h2 class="text-2xl md:text-3xl font-bold text-slate-900 dark:text-white mb-3 font-heading">
                যা যা <span class="bg-clip-text text-transparent bg-gradient-to-r from-blue-600 to-purple-600">শিখবেন</span>
            </h2>
            <p class="text-sm md:text-base text-slate-600 dark:text-slate-400 max-w-2xl mx-auto">
                এই কোর্সে আপনি শিখবেন শূন্য থেকে এডভান্সড লেভেল পর্যন্ত ইন্ডাস্ট্রির সেরা টুলস এবং টেকনোলজি।
            </p>
        </div>

        <div class="flex flex-wrap justify-center gap-3 mb-10">
            <template x-for="tab in tabs" :key="tab.id">
                <button @click="activeTab = tab.id"
                        :class="activeTab === tab.id 
                            ? 'bg-primary-600 text-white shadow-lg shadow-primary-600/30 ring-2 ring-primary-600 ring-offset-2 ring-offset-slate-50 dark:ring-offset-slate-900' 
                            : 'bg-white dark:bg-slate-800 text-slate-600 dark:text-slate-300 hover:bg-slate-50 dark:hover:bg-slate-700 border border-slate-200 dark:border-slate-700'"
                        class="px-5 py-2 rounded-full font-bold text-xs sm:text-sm transition-all duration-300 transform active:scale-95 flex items-center gap-2">
                    <span x-text="tab.label"></span>
                </button>
            </template>
        </div>

        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4 md:gap-6">
            <template x-for="item in filteredItems" :key="item.id">
                <div class="group relative bg-white/60 dark:bg-slate-800/60 backdrop-blur-md rounded-xl p-4 md:p-5 border border-slate-200/60 dark:border-slate-700/60 hover:border-primary-500/30 dark:hover:border-primary-500/30 shadow-sm hover:shadow-lg transition-all duration-300 hover:-translate-y-1 flex items-start gap-4 overflow-hidden h-full">
                    
                    <div class="absolute inset-0 bg-gradient-to-br from-white/0 via-white/0 to-primary-500/5 opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                    
                    <div class="relative w-10 h-10 md:w-12 md:h-12 rounded-lg flex-shrink-0 flex items-center justify-center transition-transform duration-300 group-hover:scale-110 shadow-inner"
                         :class="item.bgColor">
                        <i :class="[item.icon, item.color]" class="text-xl md:text-2xl drop-shadow-sm"></i>
                    </div>

                    <div class="relative flex-1">
                        <h3 class="text-sm md:text-base font-bold text-slate-900 dark:text-white mb-1 font-heading group-hover:text-primary-600 dark:group-hover:text-primary-400 transition-colors" 
                            x-text="item.title"></h3>
                        <p class="text-[10px] md:text-xs text-slate-500 dark:text-slate-400 leading-relaxed line-clamp-2" 
                           x-text="item.description"></p>
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
                    { id: 'tools', label: 'টুলস & ডেভঅপস' }
                ],
                techItems: [
                    // Frontend
                    { id: 1, title: 'HTML5', icon: 'fab fa-html5', color: 'text-orange-500', bgColor: 'bg-orange-100 dark:bg-orange-900/30', category: 'frontend', description: 'মডার্ন ওয়েব স্ট্রাকচার ও সেমান্টিক ট্যাগ।' },
                    { id: 2, title: 'CSS3', icon: 'fab fa-css3-alt', color: 'text-blue-500', bgColor: 'bg-blue-100 dark:bg-blue-900/30', category: 'frontend', description: 'ফ্লেক্সবক্স, গ্রিড লেআউট ও এনিমেশন।' },
                    { id: 3, title: 'JavaScript', icon: 'fab fa-js', color: 'text-yellow-500', bgColor: 'bg-yellow-100 dark:bg-yellow-900/30', category: 'frontend', description: 'ES6+, DOM ও এসিঙ্ক্রোনাস প্রোগ্রামিং।' },
                    { id: 4, title: 'Tailwind CSS', icon: 'fas fa-wind', color: 'text-cyan-500', bgColor: 'bg-cyan-100 dark:bg-cyan-900/30', category: 'frontend', description: 'দ্রুত এবং রেস্পন্সিভ ডিজাইন ফ্রেমওয়ার্ক।' },
                    { id: 5, title: 'Vue.js 3', icon: 'fab fa-vuejs', color: 'text-emerald-500', bgColor: 'bg-emerald-100 dark:bg-emerald-900/30', category: 'frontend', description: 'কম্পোজিশন API ও সিঙ্গেল পেজ অ্যাপ।' },
                    { id: 6, title: 'Pinia', icon: 'fas fa-pineapple', color: 'text-yellow-600', bgColor: 'bg-yellow-50 dark:bg-yellow-900/20', category: 'frontend', description: 'মডার্ন স্টেট ম্যানেজমেন্ট লাইব্রেরি।' },

                    // Backend
                    { id: 7, title: 'PHP 8.x', icon: 'fab fa-php', color: 'text-indigo-500', bgColor: 'bg-indigo-100 dark:bg-indigo-900/30', category: 'backend', description: 'OOP, টাইপ সেফটি ও মডার্ন সিনট্যাক্স।' },
                    { id: 8, title: 'Laravel 11', icon: 'fab fa-laravel', color: 'text-red-600', bgColor: 'bg-red-100 dark:bg-red-900/30', category: 'backend', description: 'পাওয়ারফুল MVC ফ্রেমওয়ার্ক ও সিকিউরিটি।' },
                    { id: 9, title: 'MySQL', icon: 'fas fa-database', color: 'text-blue-600', bgColor: 'bg-blue-100 dark:bg-blue-900/30', category: 'backend', description: 'রিলেশনাল ডাটাবেস ডিজাইন ও কুয়েরি।' },
                    { id: 10, title: 'API Dev', icon: 'fas fa-exchange-alt', color: 'text-purple-500', bgColor: 'bg-purple-100 dark:bg-purple-900/30', category: 'backend', description: 'RESTful API তৈরি ও অথেনটিকেশন।' },

                    // Tools
                    { id: 11, title: 'Git & GitHub', icon: 'fab fa-git-alt', color: 'text-orange-600', bgColor: 'bg-orange-50 dark:bg-orange-900/20', category: 'tools', description: 'ভার্সন কন্ট্রোল ও কোড কোলাবরেশন।' },
                    { id: 12, title: 'VS Code', icon: 'fas fa-code', color: 'text-blue-500', bgColor: 'bg-blue-50 dark:bg-blue-900/20', category: 'tools', description: 'প্রফেশনাল কোড এডিটর সেটআপ।' },
                    { id: 13, title: 'Postman', icon: 'fas fa-rocket', color: 'text-orange-500', bgColor: 'bg-orange-50 dark:bg-orange-900/20', category: 'tools', description: 'API টেস্টিং এবং ডকুমেন্টেশন।' },
                    { id: 14, title: 'cPanel', icon: 'fas fa-server', color: 'text-orange-600', bgColor: 'bg-orange-100 dark:bg-orange-900/30', category: 'tools', description: 'লাইভ সার্ভার ডিপ্লয়মেন্ট ও ম্যানেজমেন্ট।' },
                    { id: 15, title: 'Laragon', icon: 'fas fa-cube', color: 'text-cyan-600', bgColor: 'bg-cyan-50 dark:bg-cyan-900/20', category: 'tools', description: 'ফাস্ট লোকাল ডেভেলপমেন্ট সার্ভার।' },
                    { id: 16, title: 'Vite', icon: 'fas fa-bolt', color: 'text-purple-500', bgColor: 'bg-purple-50 dark:bg-purple-900/20', category: 'tools', description: 'নেক্সট জেনারেশন বিল্ড টুল।' },
                ],
                get filteredItems() {
                    if (this.activeTab === 'all') return this.techItems;
                    return this.techItems.filter(item => item.category === this.activeTab);
                }
            }));
        });
    </script>
</section>