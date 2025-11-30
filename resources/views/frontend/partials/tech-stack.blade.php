<section class="py-16 bg-gray-50 dark:bg-slate-900 border-t border-slate-200 dark:border-slate-800" x-data="techStack">
  <div class="container mx-auto px-4">
    <div class="text-center mb-12">
      <h2 class="text-3xl font-bold text-gray-900 dark:text-white mb-4 font-heading">
        <span class="bg-clip-text text-transparent bg-gradient-to-r from-blue-600 to-indigo-600 dark:from-blue-400 dark:to-indigo-400">
          সম্পূর্ণ টেক স্ট্যাক কভারেজ
        </span>
      </h2>
      <p class="text-lg text-gray-600 dark:text-gray-400 max-w-3xl mx-auto">
        এই কোর্সে আপনি শিখবেন শূন্য থেকে এডভান্সড লেভেল পর্যন্ত নিচের সমস্ত টেকনোলজি
      </p>
    </div>

    <div class="flex flex-wrap justify-center gap-3 mb-8">
      <template x-for="(tab, index) in tabs" :key="index">
        <button
          @click="activeTab = tab.id"
          :class="activeTab === tab.id ? 
                 'bg-blue-600 text-white shadow-md transform scale-105' : 
                 'bg-white dark:bg-slate-800 text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-slate-700 border border-gray-200 dark:border-slate-700'"
          class="px-6 py-2 rounded-full font-medium transition-all duration-300"
        >
          <span x-text="tab.label"></span>
        </button>
      </template>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5">
      <template x-for="item in filteredItems" :key="item.id">
        <div
          class="bg-white dark:bg-slate-800 rounded-xl p-5 shadow-sm hover:shadow-lg transition-all duration-300 border border-gray-200 dark:border-slate-700 hover:-translate-y-1 group"
        >
            <div class="flex items-start space-x-4">
                <div :class="item.bgColor" class="p-3 rounded-lg transition-transform duration-300 group-hover:scale-110 shrink-0">
                    <i :class="[item.icon, item.color, 'text-2xl']"></i>
                </div>
                <div>
                    <h3 class="text-lg font-bold text-gray-800 dark:text-gray-200 mb-1 font-heading" x-text="item.title"></h3>
                    <p class="text-sm text-gray-500 dark:text-gray-400 leading-relaxed" x-text="item.description"></p>
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
          { id: 1, title: 'HTML5 & Semantic', icon: 'fab fa-html5', color: 'text-orange-500', bgColor: 'bg-orange-100 dark:bg-orange-900/20', category: 'frontend', description: 'HTML5, সেমান্টিক ট্যাগ, টেবিল, ফর্ম' },
          { id: 2, title: 'CSS3 & Responsive', icon: 'fab fa-css3-alt', color: 'text-blue-500', bgColor: 'bg-blue-100 dark:bg-blue-900/20', category: 'frontend', description: 'ফ্লেক্সবক্স, গ্রিড, এনিমেশন, মিডিয়া কোয়েরি' },
          { id: 3, title: 'JavaScript (ES6+)', icon: 'fab fa-js-square', color: 'text-yellow-500', bgColor: 'bg-yellow-100 dark:bg-yellow-900/20', category: 'frontend', description: 'DOM, Fetch API, ES6+ ফিচারস' },
          { id: 5, title: 'Tailwind CSS', icon: 'fas fa-paint-brush', color: 'text-cyan-500', bgColor: 'bg-cyan-100 dark:bg-cyan-900/20', category: 'frontend', description: 'মডার্ন ইউটিলিটি-ফার্স্ট CSS ফ্রেমওয়ার্ক' },
          { id: 8, title: 'PHP & OOP', icon: 'fab fa-php', color: 'text-indigo-500', bgColor: 'bg-indigo-100 dark:bg-indigo-900/20', category: 'backend', description: 'বেসিক সিনট্যাক্স, OOP, নেমস্পেস' },
          { id: 9, title: 'MySQL Database', icon: 'fas fa-database', color: 'text-blue-500', bgColor: 'bg-blue-100 dark:bg-blue-900/20', category: 'backend', description: 'ডাটাবেজ ডিজাইন, কুয়েরি অপ্টিমাইজেশন' },
          { id: 10, title: 'Laravel Framework', icon: 'fab fa-laravel', color: 'text-red-600', bgColor: 'bg-red-100 dark:bg-red-900/20', category: 'frameworks', description: 'মডেল, ভিউ, কন্ট্রোলার, সিকিউরিটি' },
          { id: 12, title: 'Vue.js 3', icon: 'fab fa-vuejs', color: 'text-green-500', bgColor: 'bg-green-100 dark:bg-green-900/20', category: 'frameworks', description: 'কম্পোজিশন API, পিনিয়া স্টেট' }
        ],
        get filteredItems() {
          if (this.activeTab === 'all') return this.techItems;
          return this.techItems.filter(item => item.category === this.activeTab);
        }
      }));
    });
  </script>
</section>