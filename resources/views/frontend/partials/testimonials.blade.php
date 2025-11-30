<section class="py-16 bg-gray-50 dark:bg-slate-900 border-t border-slate-200 dark:border-slate-800">
    <div class="container mx-auto px-4" x-data="testimonials">
        <div class="text-center mb-12">
            <h2 class="text-3xl font-bold text-gray-900 dark:text-white mb-3 font-heading">শিক্ষার্থীদের মতামত</h2>
            <p class="text-gray-600 dark:text-gray-400">আমাদের কোর্স থেকে যারা সফল হয়েছেন তাদের অভিজ্ঞতা</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <template x-for="item in items" :key="item.name">
                <div class="bg-white dark:bg-slate-800 p-6 rounded-xl shadow-sm border border-gray-100 dark:border-slate-700">
                    <div class="flex items-center gap-3 mb-4">
                        <div class="w-10 h-10 rounded-full bg-blue-100 dark:bg-blue-900/50 flex items-center justify-center text-blue-600 dark:text-blue-400 font-bold" x-text="item.name.charAt(0)"></div>
                        <div>
                            <h4 class="font-bold text-gray-900 dark:text-white text-sm" x-text="item.name"></h4>
                            <p class="text-xs text-gray-500 dark:text-gray-400" x-text="item.course"></p>
                        </div>
                    </div>
                    <p class="text-gray-600 dark:text-gray-300 text-sm leading-relaxed" x-text="item.review"></p>
                    <div class="flex text-yellow-400 text-xs mt-3">
                        <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i>
                    </div>
                </div>
            </template>
        </div>
    </div>

    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('testimonials', () => ({
                items: [
                    { name: 'Faisal Azam', course: 'MERN Stack Batch 1', review: 'ProjuktiPlus এর সাপোর্ট টিম অসাধারণ। যেকোনো সমস্যায় দ্রুত সমাধান পাওয়া যায় যা নতুনদের জন্য খুব জরুরি।' },
                    { name: 'Jahid Hossain', course: 'Laravel Batch 2', review: 'এত সুন্দর গুছানো কারিকুলাম অন্য কোথাও দেখিনি। প্রতিটি টপিক প্র্যাকটিক্যালি দেখানো হয়েছে।' },
                    { name: 'Sadia Islam', course: 'UI/UX Design', review: 'ডিজাইন প্রিন্সিপালগুলো খুব সহজেই বুঝতে পেরেছি। এখন আমি মার্কেটপ্লেসে কাজ করছি।' }
                ]
            }));
        });
    </script>
</section>