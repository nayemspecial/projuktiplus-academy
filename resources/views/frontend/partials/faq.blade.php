<section class="py-20 bg-white dark:bg-slate-900 transition-colors duration-300 relative overflow-hidden">
    
    <div class="absolute -left-20 top-1/4 w-72 h-72 bg-blue-500/5 rounded-full blur-3xl pointer-events-none"></div>
    <div class="absolute -right-20 bottom-1/4 w-72 h-72 bg-purple-500/5 rounded-full blur-3xl pointer-events-none"></div>

    <div class="container mx-auto px-4 relative z-10">
        
        <div class="text-center max-w-3xl mx-auto mb-16">
            <span class="text-primary-600 dark:text-primary-400 font-bold tracking-wider uppercase text-xs mb-2 block font-heading">আপনার প্রশ্ন, আমাদের উত্তর</span>
            <h2 class="text-3xl md:text-4xl font-bold text-slate-900 dark:text-white mb-4 font-heading">
                সচরাচর জিজ্ঞাসিত <span class="text-transparent bg-clip-text bg-gradient-to-r from-primary-600 to-purple-600">প্রশ্নাবলী</span>
            </h2>
            <p class="text-slate-600 dark:text-slate-400 text-lg">
                ভর্তির আগে মনে কোনো প্রশ্ন আছে? নিচের কমন প্রশ্নগুলো দেখুন। এরপরও কিছু জানার থাকলে আমাদের সরাসরি কল করুন।
            </p>
        </div>

        <div class="mx-auto space-y-4" x-data="{ selected: 1 }">
            
            <div class="bg-slate-50 dark:bg-slate-800/50 rounded-2xl border border-slate-200 dark:border-slate-700 overflow-hidden transition-all duration-300 hover:shadow-md">
                <button @click="selected !== 1 ? selected = 1 : selected = null" 
                        class="w-full flex items-center justify-between p-5 text-left focus:outline-none">
                    <span class="text-lg font-bold text-slate-900 dark:text-white font-heading">১. এই কোর্সটি কি একদম নতুনদের জন্য?</span>
                    <span class="flex-shrink-0 ml-4 w-8 h-8 rounded-full bg-white dark:bg-slate-700 flex items-center justify-center text-primary-600 dark:text-primary-400 transition-transform duration-300"
                          :class="selected === 1 ? 'rotate-180 bg-primary-100' : ''">
                        <i class="fas fa-chevron-down text-sm"></i>
                    </span>
                </button>
                <div x-show="selected === 1" x-collapse x-cloak
                     class="px-5 pb-5 text-slate-600 dark:text-slate-300 text-sm leading-relaxed border-t border-slate-200/50 dark:border-slate-700/50 pt-3">
                    হ্যাঁ, অবশ্যই। আমরা একদম শূন্য (Zero) থেকে শুরু করব। এইচটিএমএল (HTML) এর বেসিক ট্যাগ থেকে শুরু করে ধাপে ধাপে অ্যাডভান্সড টপিক যেমন লারাভেল এবং ভিউ জেএস শেখানো হবে। আপনার শুধুমাত্র কম্পিউটার বেসিক জানা থাকলেই হবে।
                </div>
            </div>

            <div class="bg-slate-50 dark:bg-slate-800/50 rounded-2xl border border-slate-200 dark:border-slate-700 overflow-hidden transition-all duration-300 hover:shadow-md">
                <button @click="selected !== 2 ? selected = 2 : selected = null" 
                        class="w-full flex items-center justify-between p-5 text-left focus:outline-none">
                    <span class="text-lg font-bold text-slate-900 dark:text-white font-heading">২. ক্লাস মিস করলে কি রেকর্ডিং পাবো?</span>
                    <span class="flex-shrink-0 ml-4 w-8 h-8 rounded-full bg-white dark:bg-slate-700 flex items-center justify-center text-primary-600 dark:text-primary-400 transition-transform duration-300"
                          :class="selected === 2 ? 'rotate-180 bg-primary-100' : ''">
                        <i class="fas fa-chevron-down text-sm"></i>
                    </span>
                </button>
                <div x-show="selected === 2" x-collapse x-cloak
                     class="px-5 pb-5 text-slate-600 dark:text-slate-300 text-sm leading-relaxed border-t border-slate-200/50 dark:border-slate-700/50 pt-3">
                    অবশ্যই। প্রতিটি লাইভ ক্লাস শেষ হওয়ার ৬-১২ ঘন্টার মধ্যে আমাদের পোর্টালে হাই-কোয়ালিটি রেকর্ডিং আপলোড করা হয়। আপনি যেকোনো সময়, যতবার খুশি দেখে নিতে পারবেন এবং লাইফটাইম এক্সেস পাবেন।
                </div>
            </div>

            <div class="bg-slate-50 dark:bg-slate-800/50 rounded-2xl border border-slate-200 dark:border-slate-700 overflow-hidden transition-all duration-300 hover:shadow-md">
                <button @click="selected !== 3 ? selected = 3 : selected = null" 
                        class="w-full flex items-center justify-between p-5 text-left focus:outline-none">
                    <span class="text-lg font-bold text-slate-900 dark:text-white font-heading">৩. শেখার জন্য কেমন কনফিগারেশনের পিসি লাগবে?</span>
                    <span class="flex-shrink-0 ml-4 w-8 h-8 rounded-full bg-white dark:bg-slate-700 flex items-center justify-center text-primary-600 dark:text-primary-400 transition-transform duration-300"
                          :class="selected === 3 ? 'rotate-180 bg-primary-100' : ''">
                        <i class="fas fa-chevron-down text-sm"></i>
                    </span>
                </button>
                <div x-show="selected === 3" x-collapse x-cloak
                     class="px-5 pb-5 text-slate-600 dark:text-slate-300 text-sm leading-relaxed border-t border-slate-200/50 dark:border-slate-700/50 pt-3">
                    ওয়েব ডেভেলপমেন্টের জন্য খুব হাই-এন্ড পিসির প্রয়োজন নেই। ডুয়াল কোর প্রসেসর, ৪ জিবি র‍্যাম (৮ জিবি রিকমেন্ডেড) এবং একটি এসএসডি (SSD) থাকলেই আপনি স্বাচ্ছন্দ্যে কাজ করতে পারবেন। ল্যাপটপ বা ডেস্কটপ যেকোনোটিই চলবে।
                </div>
            </div>

            <div class="bg-slate-50 dark:bg-slate-800/50 rounded-2xl border border-slate-200 dark:border-slate-700 overflow-hidden transition-all duration-300 hover:shadow-md">
                <button @click="selected !== 4 ? selected = 4 : selected = null" 
                        class="w-full flex items-center justify-between p-5 text-left focus:outline-none">
                    <span class="text-lg font-bold text-slate-900 dark:text-white font-heading">৪. কোর্স শেষে কি জবের গ্যারান্টি আছে?</span>
                    <span class="flex-shrink-0 ml-4 w-8 h-8 rounded-full bg-white dark:bg-slate-700 flex items-center justify-center text-primary-600 dark:text-primary-400 transition-transform duration-300"
                          :class="selected === 4 ? 'rotate-180 bg-primary-100' : ''">
                        <i class="fas fa-chevron-down text-sm"></i>
                    </span>
                </button>
                <div x-show="selected === 4" x-collapse x-cloak
                     class="px-5 pb-5 text-slate-600 dark:text-slate-300 text-sm leading-relaxed border-t border-slate-200/50 dark:border-slate-700/50 pt-3">
                    আমরা স্কিল ডেভেলপমেন্টের গ্যারান্টি দিই, জবের নয়। তবে যারা আমাদের গাইডলাইন মেনে শেষ পর্যন্ত লেগে থাকবেন এবং প্রজেক্টগুলো সম্পন্ন করবেন, তাদের জন্য আমাদের ইন্টার্নশিপ প্লেসমেন্ট সাপোর্ট এবং সিভি ফরওয়ার্ডিং সুবিধা রয়েছে।
                </div>
            </div>

            <div class="bg-slate-50 dark:bg-slate-800/50 rounded-2xl border border-slate-200 dark:border-slate-700 overflow-hidden transition-all duration-300 hover:shadow-md">
                <button @click="selected !== 5 ? selected = 5 : selected = null" 
                        class="w-full flex items-center justify-between p-5 text-left focus:outline-none">
                    <span class="text-lg font-bold text-slate-900 dark:text-white font-heading">৫. প্রতিদিন কতটুকু সময় প্র্যাকটিস করতে হবে?</span>
                    <span class="flex-shrink-0 ml-4 w-8 h-8 rounded-full bg-white dark:bg-slate-700 flex items-center justify-center text-primary-600 dark:text-primary-400 transition-transform duration-300"
                          :class="selected === 5 ? 'rotate-180 bg-primary-100' : ''">
                        <i class="fas fa-chevron-down text-sm"></i>
                    </span>
                </button>
                <div x-show="selected === 5" x-collapse x-cloak
                     class="px-5 pb-5 text-slate-600 dark:text-slate-300 text-sm leading-relaxed border-t border-slate-200/50 dark:border-slate-700/50 pt-3">
                    এটা নির্ভর করে আপনার শেখার গতির ওপর। তবে আমরা রিকমেন্ড করি ক্লাস লেকচার দেখার পর অন্তত ২-৩ ঘণ্টা নিজে প্র্যাকটিস করার জন্য। ধারাবাহিকতা বজায় রাখাটা এখানে বেশি গুরুত্বপূর্ণ।
                </div>
            </div>

        </div>

        <div class="text-center mt-12">
            <p class="text-slate-600 dark:text-slate-400">
                আরও প্রশ্ন আছে? সরাসরি কথা বলুন মেন্টরের সাথে
                <a href="tel:01909605599" class="text-primary-600 dark:text-primary-400 font-bold hover:underline ml-1">
                    <i class="fas fa-phone-alt"></i> 01909605599
                </a>
            </p>
        </div>

    </div>
</section>