<section class="w-full px-4 mx-auto py-16 bg-white dark:bg-slate-800" x-data="coursesSection">
  <div class="container mx-auto px-4">
    <div class="text-center mb-12">
      <h2 class="text-3xl font-bold text-gray-900 dark:text-white mb-4 font-heading">
        <span class="bg-clip-text text-transparent bg-gradient-to-r from-blue-600 to-indigo-600 dark:from-blue-400 dark:to-indigo-400">
          প্রযুক্তি প্লাস কোর্সসমূহ
        </span>
      </h2>
      <p class="text-lg text-gray-600 dark:text-gray-400 max-w-3xl mx-auto">
        আপনার দক্ষতা উন্নত করতে আমাদের বিশেষায়িত কোর্সগুলো
      </p>
    </div>

    <div class="flex justify-center gap-4 mb-8">
      <button @click="activeTab = 'web-design'" :class="activeTab === 'web-design' ? 'bg-blue-600 text-white' : 'bg-gray-100 dark:bg-slate-700 text-gray-700 dark:text-gray-300'" class="px-6 py-2 rounded-full font-medium transition">
        ওয়েব ডিজাইন
      </button>
      <button @click="activeTab = 'web-development'" :class="activeTab === 'web-development' ? 'bg-blue-600 text-white' : 'bg-gray-100 dark:bg-slate-700 text-gray-700 dark:text-gray-300'" class="px-6 py-2 rounded-full font-medium transition">
        ওয়েব ডেভেলপমেন্ট
      </button>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
      <template x-for="course in filteredCourses" :key="course.id">
        <div class="bg-white dark:bg-slate-900 rounded-xl shadow-sm hover:shadow-lg transition-all border border-gray-100 dark:border-slate-700 overflow-hidden flex flex-col h-full">
          <div class="relative overflow-hidden group">
            <img :src="course.image" class="w-full h-48 object-cover transition-transform duration-500 group-hover:scale-110" alt="Thumbnail">
            <div class="absolute inset-0 bg-black/40 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity">
              <button class="bg-white text-blue-600 rounded-full p-3 shadow-lg"><i class="fas fa-play"></i></button>
            </div>
          </div>
          <div class="p-5 flex flex-col flex-grow">
            <div class="mb-2">
                <span class="text-xs font-bold px-2 py-1 bg-blue-100 dark:bg-blue-900/30 text-blue-600 dark:text-blue-400 rounded-md" x-text="course.type"></span>
            </div>
            <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-2 line-clamp-2" x-text="course.title"></h3>
            <p class="text-sm text-gray-500 dark:text-gray-400 mb-4 line-clamp-2" x-text="course.description"></p>
            <div class="mt-auto flex items-center justify-between border-t border-gray-100 dark:border-slate-800 pt-4">
                <div class="flex items-center gap-1 text-gray-500 dark:text-gray-400 text-sm">
                    <i class="fas fa-users"></i> <span x-text="course.students"></span>
                </div>
                <button class="text-blue-600 dark:text-blue-400 font-medium text-sm hover:underline">বিস্তারিত <i class="fas fa-arrow-right ml-1"></i></button>
            </div>
          </div>
        </div>
      </template>
    </div>

    <div class="text-center mt-10">
      <a href="/courses" class="inline-flex items-center px-8 py-3 bg-slate-900 dark:bg-slate-700 text-white rounded-full font-medium hover:bg-slate-800 transition">
        সব কোর্স দেখুন <i class="fas fa-arrow-right ml-2"></i>
      </a>
    </div>
  </div>

  <script>
    document.addEventListener('alpine:init', () => {
      Alpine.data('coursesSection', () => ({
        activeTab: 'web-development',
        courses: [
          { id: 1, title: 'HTML5 & CSS3 ক্র্যাশ কোর্স', description: 'শূন্য থেকে HTML5 এবং CSS3 শিখুন', image: 'https://images.unsplash.com/photo-1555066931-4365d14bab8c?w=500&q=80', type: 'বিগিনার', students: '1.2k', category: 'web-design' },
          { id: 2, title: 'জাভাস্ক্রিপ্ট ফান্ডামেন্টালস', description: 'মডার্ন জাভাস্ক্রিপ্ট (ES6+) শিখুন', image: 'https://images.unsplash.com/photo-1626785774573-4b799315345d?w=500&q=80', type: 'ইন্টারমিডিয়েট', students: '980', category: 'web-development' },
          { id: 3, title: 'লারাভেল ই-কমার্স প্রজেক্ট', description: 'লারাভেল দিয়ে পূর্ণাঙ্গ ই-কমার্স সাইট', image: 'https://images.unsplash.com/photo-1624953587687-daf255b6b80a?w=500&q=80', type: 'এডভান্সড', students: '1.5k', category: 'web-development' },
          { id: 4, title: 'ভিউ জেএস ৩ মাস্টারক্লাস', description: 'ফ্রন্টএন্ড ডেভেলপমেন্টের জন্য ভিউ জেএস', image: 'https://images.unsplash.com/photo-1547658719-da2b51169166?w=500&q=80', type: 'ইন্টারমিডিয়েট', students: '850', category: 'web-development' }
        ],
        get filteredCourses() {
          return this.courses.filter(c => c.category === this.activeTab);
        }
      }));
    });
  </script>
</section>