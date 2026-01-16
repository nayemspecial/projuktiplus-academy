@extends('frontend.layouts.master')

@section('title', 'সচরাচর জিজ্ঞাসিত প্রশ্ন | প্রযুক্তিপ্লাস একাডেমি')

@section('content')

<section class="relative pt-32 pb-12 overflow-hidden bg-slate-50 dark:bg-slate-900 transition-colors duration-300">
    <div class="absolute inset-0 pointer-events-none">
        <div class="absolute top-0 left-0 w-full h-24 bg-gradient-to-b from-slate-50 dark:from-slate-900 to-transparent z-10"></div>
        <div class="absolute top-1/4 left-0 w-[600px] h-[600px] bg-blue-500/5 dark:bg-blue-600/10 rounded-full blur-[100px] -translate-x-1/2 animate-pulse"></div>
        <div class="absolute bottom-0 right-0 w-[600px] h-[600px] bg-purple-500/5 dark:bg-purple-600/10 rounded-full blur-[100px] translate-x-1/2 animate-pulse delay-1000"></div>
    </div>

    <div class="container mx-auto px-4 relative z-10 text-center">
        <h1 class="text-3xl md:text-5xl font-bold text-slate-900 dark:text-white mb-4 font-heading">
            সচরাচর জিজ্ঞাসিত <span class="bg-clip-text text-transparent bg-gradient-to-r from-blue-600 dark:from-gray-100 via-purple-600 dark:via-purple-300 to-pink-600 dark:to-pink-200">প্রশ্নাবলী</span>
        </h1>
        <p class="text-slate-600 dark:text-slate-400 max-w-2xl mx-auto text-sm md:text-base">
            আপনার মনে থাকা সকল প্রশ্নের উত্তর এখানে দেওয়ার চেষ্টা করা হয়েছে।
        </p>
    </div>
</section>

<section class="py-12 relative bg-slate-50 dark:bg-slate-900 min-h-[600px]" x-data="{ activeTab: 'general', activeQuestion: null }">
    <div class="container mx-auto px-4 relative z-10 max-w-4xl">
        
        <div class="flex flex-wrap md:justify-center gap-3 mb-10 overflow-x-auto pb-4 md:pb-0 scrollbar-hide">
            
            <button @click="activeTab = 'general'; activeQuestion = null" 
                :class="activeTab === 'general' ? 'bg-blue-600 text-white shadow-lg shadow-blue-500/30' : 'bg-white dark:bg-slate-800 text-slate-600 dark:text-slate-400 hover:bg-slate-100 dark:hover:bg-slate-700'"
                class="px-5 py-2.5 rounded-full text-sm font-bold transition-all whitespace-nowrap border border-transparent dark:border-slate-700">
                সাধারণ জিজ্ঞাসা
            </button>

            <button @click="activeTab = 'admission'; activeQuestion = null" 
                :class="activeTab === 'admission' ? 'bg-purple-600 text-white shadow-lg shadow-purple-500/30' : 'bg-white dark:bg-slate-800 text-slate-600 dark:text-slate-400 hover:bg-slate-100 dark:hover:bg-slate-700'"
                class="px-5 py-2.5 rounded-full text-sm font-bold transition-all whitespace-nowrap border border-transparent dark:border-slate-700">
                ভর্তি ও পেমেন্ট
            </button>

            <button @click="activeTab = 'class'; activeQuestion = null" 
                :class="activeTab === 'class' ? 'bg-pink-600 text-white shadow-lg shadow-pink-500/30' : 'bg-white dark:bg-slate-800 text-slate-600 dark:text-slate-400 hover:bg-slate-100 dark:hover:bg-slate-700'"
                class="px-5 py-2.5 rounded-full text-sm font-bold transition-all whitespace-nowrap border border-transparent dark:border-slate-700">
                ক্লাস ও মডিউল
            </button>

            <button @click="activeTab = 'support'; activeQuestion = null" 
                :class="activeTab === 'support' ? 'bg-orange-600 text-white shadow-lg shadow-orange-500/30' : 'bg-white dark:bg-slate-800 text-slate-600 dark:text-slate-400 hover:bg-slate-100 dark:hover:bg-slate-700'"
                class="px-5 py-2.5 rounded-full text-sm font-bold transition-all whitespace-nowrap border border-transparent dark:border-slate-700">
                সাপোর্ট ও ক্যারিয়ার
            </button>

        </div>

        <div class="space-y-4">

            <div x-show="activeTab === 'general'" x-transition.opacity.duration.300ms class="space-y-4">
                
                <div class="group bg-white/60 dark:bg-slate-800/60 backdrop-blur-md border border-white/50 dark:border-slate-700/50 rounded-2xl overflow-hidden transition-all hover:shadow-md">
                    <button @click="activeQuestion === 1 ? activeQuestion = null : activeQuestion = 1" class="w-full flex items-center justify-between p-5 text-left focus:outline-none">
                        <span class="font-bold text-slate-900 dark:text-white text-base md:text-lg">প্রযুক্তিপ্লাস একাডেমি আসলে কী?</span>
                        <span class="w-8 h-8 rounded-full bg-slate-100 dark:bg-slate-700 flex items-center justify-center transition-transform duration-300" 
                              :class="activeQuestion === 1 ? 'rotate-180 bg-blue-100 text-blue-600' : 'text-slate-500'">
                            <i class="fas fa-chevron-down text-sm"></i>
                        </span>
                    </button>
                    <div x-show="activeQuestion === 1" x-collapse class="border-t border-slate-100 dark:border-slate-700/50">
                        <div class="p-5 text-slate-600 dark:text-slate-300 text-sm md:text-base leading-relaxed">
                            প্রযুক্তিপ্লাস একাডেমি একটি অনলাইন লার্নিং প্ল্যাটফর্ম যেখানে আমরা হাতে-কলমে (Project Based) ওয়েব ডেভেলপমেন্ট এবং সফটওয়্যার ইঞ্জিনিয়ারিং শেখাই। আমাদের মূল লক্ষ্য হলো শিক্ষার্থীদের গ্লোবাল মার্কেটের জন্য দক্ষ করে গড়ে তোলা।
                        </div>
                    </div>
                </div>

                <div class="group bg-white/60 dark:bg-slate-800/60 backdrop-blur-md border border-white/50 dark:border-slate-700/50 rounded-2xl overflow-hidden transition-all hover:shadow-md">
                    <button @click="activeQuestion === 2 ? activeQuestion = null : activeQuestion = 2" class="w-full flex items-center justify-between p-5 text-left focus:outline-none">
                        <span class="font-bold text-slate-900 dark:text-white text-base md:text-lg">কোর্স শেষে কি সার্টিফিকেট পাবো?</span>
                        <span class="w-8 h-8 rounded-full bg-slate-100 dark:bg-slate-700 flex items-center justify-center transition-transform duration-300" 
                              :class="activeQuestion === 2 ? 'rotate-180 bg-blue-100 text-blue-600' : 'text-slate-500'">
                            <i class="fas fa-chevron-down text-sm"></i>
                        </span>
                    </button>
                    <div x-show="activeQuestion === 2" x-collapse class="border-t border-slate-100 dark:border-slate-700/50">
                        <div class="p-5 text-slate-600 dark:text-slate-300 text-sm md:text-base leading-relaxed">
                            হ্যাঁ, অবশ্যই। প্রতিটি কোর্স সফলভাবে সম্পন্ন করার পর এবং প্রজেক্ট সাবমিট করার পর আপনাকে একটি ভেরিফাইড ডিজিটাল সার্টিফিকেট দেওয়া হবে যা আপনি আপনার সিভি বা লিঙ্কডইনে শেয়ার করতে পারবেন।
                        </div>
                    </div>
                </div>

                <div class="group bg-white/60 dark:bg-slate-800/60 backdrop-blur-md border border-white/50 dark:border-slate-700/50 rounded-2xl overflow-hidden transition-all hover:shadow-md">
                    <button @click="activeQuestion === 3 ? activeQuestion = null : activeQuestion = 3" class="w-full flex items-center justify-between p-5 text-left focus:outline-none">
                        <span class="font-bold text-slate-900 dark:text-white text-base md:text-lg">আমি নন-সিএসই স্টুডেন্ট, আমি কি পারব?</span>
                        <span class="w-8 h-8 rounded-full bg-slate-100 dark:bg-slate-700 flex items-center justify-center transition-transform duration-300" 
                              :class="activeQuestion === 3 ? 'rotate-180 bg-blue-100 text-blue-600' : 'text-slate-500'">
                            <i class="fas fa-chevron-down text-sm"></i>
                        </span>
                    </button>
                    <div x-show="activeQuestion === 3" x-collapse class="border-t border-slate-100 dark:border-slate-700/50">
                        <div class="p-5 text-slate-600 dark:text-slate-300 text-sm md:text-base leading-relaxed">
                            অবশ্যই পারবেন। আমাদের কোর্সগুলো এমনভাবে ডিজাইন করা হয়েছে যাতে একদম শূন্য (Zero) থেকে শুরু করা যায়। আপনার শুধুমাত্র বেসিক কম্পিউটার চালনা এবং ইন্টারনেট ব্যবহারের জ্ঞান থাকলেই হবে। বাকিটা আমরা ধাপে ধাপে শিখিয়ে দিব।
                        </div>
                    </div>
                </div>
            </div>

            <div x-show="activeTab === 'admission'" style="display: none;" x-transition.opacity.duration.300ms class="space-y-4">
                
                <div class="group bg-white/60 dark:bg-slate-800/60 backdrop-blur-md border border-white/50 dark:border-slate-700/50 rounded-2xl overflow-hidden transition-all hover:shadow-md">
                    <button @click="activeQuestion === 4 ? activeQuestion = null : activeQuestion = 4" class="w-full flex items-center justify-between p-5 text-left focus:outline-none">
                        <span class="font-bold text-slate-900 dark:text-white text-base md:text-lg">ভর্তি হওয়ার প্রক্রিয়া কী?</span>
                        <span class="w-8 h-8 rounded-full bg-slate-100 dark:bg-slate-700 flex items-center justify-center transition-transform duration-300" 
                              :class="activeQuestion === 4 ? 'rotate-180 bg-purple-100 text-purple-600' : 'text-slate-500'">
                            <i class="fas fa-chevron-down text-sm"></i>
                        </span>
                    </button>
                    <div x-show="activeQuestion === 4" x-collapse class="border-t border-slate-100 dark:border-slate-700/50">
                        <div class="p-5 text-slate-600 dark:text-slate-300 text-sm md:text-base leading-relaxed">
                            খুব সহজ! আমাদের ওয়েবসাইটে অ্যাকাউন্ট খুলে আপনার পছন্দের কোর্সে "Enroll Now" বাটনে ক্লিক করুন। এরপর পেমেন্ট সম্পন্ন করলেই আপনি সাথে সাথে কোর্সে এক্সেস পেয়ে যাবেন।
                        </div>
                    </div>
                </div>

                <div class="group bg-white/60 dark:bg-slate-800/60 backdrop-blur-md border border-white/50 dark:border-slate-700/50 rounded-2xl overflow-hidden transition-all hover:shadow-md">
                    <button @click="activeQuestion === 5 ? activeQuestion = null : activeQuestion = 5" class="w-full flex items-center justify-between p-5 text-left focus:outline-none">
                        <span class="font-bold text-slate-900 dark:text-white text-base md:text-lg">কি কি মাধ্যমে পেমেন্ট করা যাবে?</span>
                        <span class="w-8 h-8 rounded-full bg-slate-100 dark:bg-slate-700 flex items-center justify-center transition-transform duration-300" 
                              :class="activeQuestion === 5 ? 'rotate-180 bg-purple-100 text-purple-600' : 'text-slate-500'">
                            <i class="fas fa-chevron-down text-sm"></i>
                        </span>
                    </button>
                    <div x-show="activeQuestion === 5" x-collapse class="border-t border-slate-100 dark:border-slate-700/50">
                        <div class="p-5 text-slate-600 dark:text-slate-300 text-sm md:text-base leading-relaxed">
                            আমরা বিকাশ (bKash), নগদ (Nagad) এবং রকেট (Rocket) এর মাধ্যমে পেমেন্ট গ্রহণ করি। আপনি পার্সোনাল অ্যাকাউন্ট থেকে সেন্ড মানি করে ট্রানজেকশন আইডি সাবমিট করলেই হবে।
                        </div>
                    </div>
                </div>

                <div class="group bg-white/60 dark:bg-slate-800/60 backdrop-blur-md border border-white/50 dark:border-slate-700/50 rounded-2xl overflow-hidden transition-all hover:shadow-md">
                    <button @click="activeQuestion === 6 ? activeQuestion = null : activeQuestion = 6" class="w-full flex items-center justify-between p-5 text-left focus:outline-none">
                        <span class="font-bold text-slate-900 dark:text-white text-base md:text-lg">কোনো রিফান্ড পলিসি আছে কি?</span>
                        <span class="w-8 h-8 rounded-full bg-slate-100 dark:bg-slate-700 flex items-center justify-center transition-transform duration-300" 
                              :class="activeQuestion === 6 ? 'rotate-180 bg-purple-100 text-purple-600' : 'text-slate-500'">
                            <i class="fas fa-chevron-down text-sm"></i>
                        </span>
                    </button>
                    <div x-show="activeQuestion === 6" x-collapse class="border-t border-slate-100 dark:border-slate-700/50">
                        <div class="p-5 text-slate-600 dark:text-slate-300 text-sm md:text-base leading-relaxed">
                            হ্যাঁ, আমাদের ৪৮ ঘণ্টার মানি-ব্যাক গ্যারান্টি আছে। কোর্স কেনার পর যদি মনে হয় এটি আপনার জন্য উপযুক্ত নয়, তবে ৪৮ ঘণ্টার মধ্যে জানালে আমরা আপনার টাকা ফেরত দিব (শর্ত প্রযোজ্য)। বিস্তারিত জানতে আমাদের রিফান্ড পলিসি পেজ দেখুন।
                        </div>
                    </div>
                </div>
            </div>

            <div x-show="activeTab === 'class'" style="display: none;" x-transition.opacity.duration.300ms class="space-y-4">
                
                <div class="group bg-white/60 dark:bg-slate-800/60 backdrop-blur-md border border-white/50 dark:border-slate-700/50 rounded-2xl overflow-hidden transition-all hover:shadow-md">
                    <button @click="activeQuestion === 7 ? activeQuestion = null : activeQuestion = 7" class="w-full flex items-center justify-between p-5 text-left focus:outline-none">
                        <span class="font-bold text-slate-900 dark:text-white text-base md:text-lg">ক্লাসগুলো কি লাইভ হবে নাকি রেকর্ডেড?</span>
                        <span class="w-8 h-8 rounded-full bg-slate-100 dark:bg-slate-700 flex items-center justify-center transition-transform duration-300" 
                              :class="activeQuestion === 7 ? 'rotate-180 bg-pink-100 text-pink-600' : 'text-slate-500'">
                            <i class="fas fa-chevron-down text-sm"></i>
                        </span>
                    </button>
                    <div x-show="activeQuestion === 7" x-collapse class="border-t border-slate-100 dark:border-slate-700/50">
                        <div class="p-5 text-slate-600 dark:text-slate-300 text-sm md:text-base leading-relaxed">
                            আমাদের প্রিমিয়াম বুটক্যাম্পগুলো সাধারণত লাইভ (Live) হয় এবং প্রতিটি লাইভ ক্লাসের রেকর্ডিং পরবর্তীতে পোর্টালে আপলোড করে দেওয়া হয়। কিছু নির্দিষ্ট স্কিল-বেসড কোর্স প্রি-রেকর্ডেড হতে পারে।
                        </div>
                    </div>
                </div>

                <div class="group bg-white/60 dark:bg-slate-800/60 backdrop-blur-md border border-white/50 dark:border-slate-700/50 rounded-2xl overflow-hidden transition-all hover:shadow-md">
                    <button @click="activeQuestion === 8 ? activeQuestion = null : activeQuestion = 8" class="w-full flex items-center justify-between p-5 text-left focus:outline-none">
                        <span class="font-bold text-slate-900 dark:text-white text-base md:text-lg">আমি কি মোবাইল দিয়ে কোর্স করতে পারব?</span>
                        <span class="w-8 h-8 rounded-full bg-slate-100 dark:bg-slate-700 flex items-center justify-center transition-transform duration-300" 
                              :class="activeQuestion === 8 ? 'rotate-180 bg-pink-100 text-pink-600' : 'text-slate-500'">
                            <i class="fas fa-chevron-down text-sm"></i>
                        </span>
                    </button>
                    <div x-show="activeQuestion === 8" x-collapse class="border-t border-slate-100 dark:border-slate-700/50">
                        <div class="p-5 text-slate-600 dark:text-slate-300 text-sm md:text-base leading-relaxed">
                            আপনি মোবাইল দিয়ে ভিডিও লেকচার দেখতে পারবেন, কিন্তু প্রোগ্রামিং বা কোডিং প্র্যাকটিস করার জন্য একটি ল্যাপটপ বা ডেস্কটপ কম্পিউটার থাকা আবশ্যক।
                        </div>
                    </div>
                </div>

                <div class="group bg-white/60 dark:bg-slate-800/60 backdrop-blur-md border border-white/50 dark:border-slate-700/50 rounded-2xl overflow-hidden transition-all hover:shadow-md">
                    <button @click="activeQuestion === 9 ? activeQuestion = null : activeQuestion = 9" class="w-full flex items-center justify-between p-5 text-left focus:outline-none">
                        <span class="font-bold text-slate-900 dark:text-white text-base md:text-lg">কোর্সের এক্সেস কতদিন থাকবে?</span>
                        <span class="w-8 h-8 rounded-full bg-slate-100 dark:bg-slate-700 flex items-center justify-center transition-transform duration-300" 
                              :class="activeQuestion === 9 ? 'rotate-180 bg-pink-100 text-pink-600' : 'text-slate-500'">
                            <i class="fas fa-chevron-down text-sm"></i>
                        </span>
                    </button>
                    <div x-show="activeQuestion === 9" x-collapse class="border-t border-slate-100 dark:border-slate-700/50">
                        <div class="p-5 text-slate-600 dark:text-slate-300 text-sm md:text-base leading-relaxed">
                            একবার এনরোল করলে আপনি কোর্সের **লাইফটাইম এক্সেস** পাবেন। অর্থাৎ, আপনি আপনার সুবিধামতো যেকোনো সময় লগিন করে ভিডিও দেখতে পারবেন।
                        </div>
                    </div>
                </div>
            </div>

            <div x-show="activeTab === 'support'" style="display: none;" x-transition.opacity.duration.300ms class="space-y-4">
                
                <div class="group bg-white/60 dark:bg-slate-800/60 backdrop-blur-md border border-white/50 dark:border-slate-700/50 rounded-2xl overflow-hidden transition-all hover:shadow-md">
                    <button @click="activeQuestion === 10 ? activeQuestion = null : activeQuestion = 10" class="w-full flex items-center justify-between p-5 text-left focus:outline-none">
                        <span class="font-bold text-slate-900 dark:text-white text-base md:text-lg">কোডিং করতে গিয়ে আটকে গেলে সাপোর্ট পাবো?</span>
                        <span class="w-8 h-8 rounded-full bg-slate-100 dark:bg-slate-700 flex items-center justify-center transition-transform duration-300" 
                              :class="activeQuestion === 10 ? 'rotate-180 bg-orange-100 text-orange-600' : 'text-slate-500'">
                            <i class="fas fa-chevron-down text-sm"></i>
                        </span>
                    </button>
                    <div x-show="activeQuestion === 10" x-collapse class="border-t border-slate-100 dark:border-slate-700/50">
                        <div class="p-5 text-slate-600 dark:text-slate-300 text-sm md:text-base leading-relaxed">
                            অবশ্যই! আমাদের একটি ডেডিকেটেড প্রাইভেট সাপোর্ট গ্রুপ (Facebook/Discord) আছে। সেখানে পোস্ট করলে মেন্টর বা সাপোর্ট টিম মেম্বাররা আপনাকে সাহায্য করবে। এছাড়াও সপ্তাহে নির্দিষ্ট সময়ে লাইভ সাপোর্ট সেশন থাকে।
                        </div>
                    </div>
                </div>

                <div class="group bg-white/60 dark:bg-slate-800/60 backdrop-blur-md border border-white/50 dark:border-slate-700/50 rounded-2xl overflow-hidden transition-all hover:shadow-md">
                    <button @click="activeQuestion === 11 ? activeQuestion = null : activeQuestion = 11" class="w-full flex items-center justify-between p-5 text-left focus:outline-none">
                        <span class="font-bold text-slate-900 dark:text-white text-base md:text-lg">চাকরি বা ইন্টার্নশিপের ব্যবস্থা আছে কি?</span>
                        <span class="w-8 h-8 rounded-full bg-slate-100 dark:bg-slate-700 flex items-center justify-center transition-transform duration-300" 
                              :class="activeQuestion === 11 ? 'rotate-180 bg-orange-100 text-orange-600' : 'text-slate-500'">
                            <i class="fas fa-chevron-down text-sm"></i>
                        </span>
                    </button>
                    <div x-show="activeQuestion === 11" x-collapse class="border-t border-slate-100 dark:border-slate-700/50">
                        <div class="p-5 text-slate-600 dark:text-slate-300 text-sm md:text-base leading-relaxed">
                            আমরা চাকরির গ্যারান্টি দিই না, কিন্তু স্কিল ডেভেলপমেন্টের গ্যারান্টি দিই। তবে যারা কোর্সে ভালো পারফর্ম করেন এবং প্রজেক্ট জমা দেন, তাদের সিভি আমরা বিভিন্ন কোম্পানিতে রেফার করি এবং আমাদের নিজস্ব সফটওয়্যার ফার্মেও ইন্টার্নশিপের সুযোগ দিয়ে থাকি।
                        </div>
                    </div>
                </div>

                <div class="group bg-white/60 dark:bg-slate-800/60 backdrop-blur-md border border-white/50 dark:border-slate-700/50 rounded-2xl overflow-hidden transition-all hover:shadow-md">
                    <button @click="activeQuestion === 12 ? activeQuestion = null : activeQuestion = 12" class="w-full flex items-center justify-between p-5 text-left focus:outline-none">
                        <span class="font-bold text-slate-900 dark:text-white text-base md:text-lg">ফ্রিল্যান্সিং গাইডলাইন পাবো কি?</span>
                        <span class="w-8 h-8 rounded-full bg-slate-100 dark:bg-slate-700 flex items-center justify-center transition-transform duration-300" 
                              :class="activeQuestion === 12 ? 'rotate-180 bg-orange-100 text-orange-600' : 'text-slate-500'">
                            <i class="fas fa-chevron-down text-sm"></i>
                        </span>
                    </button>
                    <div x-show="activeQuestion === 12" x-collapse class="border-t border-slate-100 dark:border-slate-700/50">
                        <div class="p-5 text-slate-600 dark:text-slate-300 text-sm md:text-base leading-relaxed">
                            হ্যাঁ, কোর্সের শেষের দিকে আমরা Fiverr এবং Upwork মার্কেটপ্লেস নিয়ে বিস্তারিত গাইডলাইন ক্লাস নিই, যাতে আপনি আপনার অর্জিত স্কিল দিয়ে আন্তর্জাতিক মার্কেটপ্লেসে কাজ করতে পারেন।
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <div class="mt-16 text-center bg-white/40 dark:bg-slate-800/40 backdrop-blur-xl border border-white/50 dark:border-slate-700/50 rounded-3xl p-10 shadow-lg">
            <h3 class="text-xl md:text-2xl font-bold text-slate-900 dark:text-white mb-3 font-heading">
                আপনার প্রশ্নের উত্তর খুঁজে পাননি?
            </h3>
            <p class="text-slate-600 dark:text-slate-400 mb-6 max-w-xl mx-auto">
                চিন্তার কিছু নেই! আমাদের সাপোর্ট টিম সর্বদা প্রস্তুত আপনাকে সাহায্য করার জন্য। সরাসরি কল করুন অথবা মেসেজ পাঠান।
            </p>
            <div class="flex flex-wrap justify-center gap-4">
                <a href="{{ route('contact') }}" class="px-8 py-3 bg-blue-600 hover:bg-blue-700 text-white font-bold rounded-full transition-all shadow-lg shadow-blue-500/30">
                    যোগাযোগ করুন
                </a>
                <a href="https://wa.me/8801909605599" target="_blank" class="px-8 py-3 bg-white dark:bg-slate-700 text-slate-700 dark:text-white hover:bg-green-50 dark:hover:bg-green-900/30 border border-slate-200 dark:border-slate-600 font-bold rounded-full transition-all flex items-center gap-2">
                    <i class="fab fa-whatsapp text-green-600"></i> হোয়াটসঅ্যাপ
                </a>
            </div>
        </div>

    </div>
</section>

@endsection