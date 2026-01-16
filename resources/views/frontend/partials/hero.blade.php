<section class="relative pt-16 pb-20 lg:pt-24 lg:pb-24 overflow-hidden bg-slate-50 dark:bg-slate-900 transition-colors duration-300">
    
    <div class="absolute top-0 left-1/2 w-full -translate-x-1/2 h-full z-0 pointer-events-none">
        <div class="absolute top-0 left-1/4 w-[500px] h-[500px] bg-purple-500/20 dark:bg-purple-900/20 rounded-full blur-[120px] mix-blend-multiply dark:mix-blend-screen animate-pulse"></div>
        <div class="absolute bottom-0 right-1/4 w-[500px] h-[500px] bg-blue-500/20 dark:bg-blue-900/20 rounded-full blur-[120px] mix-blend-multiply dark:mix-blend-screen"></div>
    </div>

    <div class="absolute inset-0 overflow-hidden pointer-events-none z-0 opacity-20 dark:opacity-10">
        <i class="fab fa-laravel absolute top-20 left-[10%] text-5xl text-red-500 animate-float"></i>
        <i class="fab fa-vuejs absolute bottom-32 right-[10%] text-4xl text-emerald-500 animate-float-delay"></i>
        <i class="fab fa-php absolute top-40 right-[20%] text-4xl text-indigo-500 animate-float"></i>
        <i class="fab fa-js absolute bottom-20 left-[15%] text-3xl text-yellow-400 animate-float-delay"></i>
    </div>

    <div class="container mx-auto px-4 relative z-10">
        <div class="flex flex-col lg:flex-row items-center gap-12 lg:gap-20">
            
            <div class="lg:w-1/2 text-center lg:text-left relative">
                
                <div class="inline-flex items-center gap-2 py-1.5 px-4 rounded-full bg-red-50 dark:bg-red-900/20 border border-red-100 dark:border-red-800 mb-8 hover:border-red-300 transition group cursor-default">
                    <span class="relative flex h-2.5 w-2.5">
                      <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-red-400 opacity-75"></span>
                      <span class="relative inline-flex rounded-full h-2.5 w-2.5 bg-red-500"></span>
                    </span>
                    <span class="text-xs font-bold text-red-600 dark:text-red-400 tracking-wide uppercase">
                        📢 প্রথম ব্যাচে অ্যাডমিশন চলছে
                    </span>
                </div>

                <h1 class="text-4xl sm:text-5xl lg:text-6xl font-bold text-slate-900 dark:text-white font-heading leading-[1.1] mb-6">
                    আপনার ক্যারিয়ারকে <br>
                    <span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-600 via-purple-600 to-pink-600 dark:from-blue-400 dark:via-purple-400 dark:to-pink-400 animate-gradient-x">
                        নেক্সট লেভেলে নিন
                    </span>
                </h1>

                <p class="text-lg text-slate-600 dark:text-slate-300 mb-8 max-w-xl mx-auto lg:mx-0 leading-relaxed">
                    প্রযুক্তি প্লাস একাডেমির সাথে শিখুন রিয়েল-ওয়ার্ল্ড স্কিল। ওয়েব ডেভেলপমেন্ট, অ্যাপ ডিজাইন এবং ফ্রিল্যান্সিং শিখে নিজেকে গ্লোবাল মার্কেটের জন্য প্রস্তুত করুন।
                </p>

                <div class="lg:hidden mb-10 bg-white/60 dark:bg-slate-800/60 backdrop-blur-md border border-slate-200 dark:border-slate-700 rounded-xl p-5 max-w-lg mx-auto text-left shadow-sm">
                    <h3 class="text-sm font-bold text-slate-900 dark:text-white mb-3 flex items-center gap-2 border-b border-slate-200 dark:border-slate-700 pb-2">
                        <i class="far fa-calendar-alt text-primary-500"></i> গুরুত্বপূর্ণ সময়সূচি
                    </h3>
                    <div class="space-y-2 text-sm">
                         <div class="flex items-center justify-between"><span class="text-slate-600 dark:text-slate-400 flex items-center gap-2"><i class="fas fa-check-circle text-green-500 text-xs"></i>রেজিস্ট্রেশন শুরু:</span><span class="font-bold text-slate-800 dark:text-slate-200">১৬ জানুয়ারি, ২০২৬</span></div>
                         <div class="flex items-center justify-between"><span class="text-slate-600 dark:text-slate-400 flex items-center gap-2"><i class="fas fa-hourglass-half text-red-500 text-xs"></i>রেজিস্ট্রেশন শেষ:</span><span class="font-bold text-red-500">১৬ ফেব্রুয়ারি, ২০২৬</span></div>
                         <div class="flex items-center justify-between"><span class="text-slate-600 dark:text-slate-400 flex items-center gap-2"><i class="fas fa-rocket text-purple-500 text-xs"></i>ওরিয়েন্টেশন ক্লাস:</span><span class="font-bold text-primary-600 dark:text-primary-400">২০ ফেব্রুয়ারি, ২০২৬</span></div>
                    </div>
                </div>

                <div class="flex flex-col sm:flex-row gap-4 justify-center lg:justify-start mb-10">
                    <a href="{{ url('/courses') }}" class="px-8 py-4 rounded-xl bg-primary-600 hover:bg-primary-700 text-white font-bold text-lg shadow-lg shadow-primary-600/30 hover:shadow-primary-600/50 transition-all transform hover:-translate-y-1 flex items-center justify-center gap-2">
                        <i class="fas fa-road"></i> লার্নিং পাথ দেখুন
                    </a>
                    <a href="{{ url('/enroll') }}" class="px-8 py-4 rounded-xl bg-white dark:bg-slate-800 border-2 border-primary-600 dark:border-primary-500 text-primary-700 dark:text-primary-400 font-bold text-lg hover:bg-primary-50 dark:hover:bg-primary-900/20 transition-all flex items-center justify-center gap-2 group">
                        এনরোল করুন <i class="fas fa-arrow-right group-hover:translate-x-1 transition-transform"></i>
                    </a>
                </div>

            </div>

            <div class="lg:w-1/2 relative">
                <div class="relative z-10 rounded-2xl overflow-hidden shadow-2xl border border-slate-200 dark:border-slate-700 group">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent opacity-60 group-hover:opacity-40 transition-opacity duration-500"></div>
                    
                    <img src="https://images.unsplash.com/photo-1605379399642-870262d3d051?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" 
                         alt="Coding Class" 
                         class="w-full h-auto object-cover transform group-hover:scale-105 transition duration-700 ease-out">
                    
                    <div class="absolute inset-0 flex items-center justify-center">
                         <button class="w-20 h-20 bg-white/20 backdrop-blur-md border border-white/40 rounded-full flex items-center justify-center text-white shadow-xl transition-transform transform hover:scale-110 group-hover:bg-white/30">
                            <i class="fas fa-play text-2xl ml-1"></i>
                         </button>
                    </div>
                </div>

                <div class="absolute -top-10 -right-10 w-40 h-40 bg-pink-500 rounded-full mix-blend-multiply filter blur-3xl opacity-30 animate-blob"></div>
                <div class="absolute -bottom-10 -left-10 w-40 h-40 bg-purple-500 rounded-full mix-blend-multiply filter blur-3xl opacity-30 animate-blob animation-delay-2000"></div>

                <div class="absolute -bottom-6 left-6 bg-white/80 dark:bg-slate-800/90 backdrop-blur-md p-4 rounded-xl shadow-xl border border-white/20 dark:border-slate-700 flex items-center gap-4 animate-float z-20 min-w-[180px]">
                    <div class="w-12 h-12 rounded-full bg-blue-100 dark:bg-blue-900/30 flex items-center justify-center text-blue-600">
                        <i class="fas fa-users text-xl"></i>
                    </div>
                    <div>
                        <p class="text-xs text-slate-500 dark:text-slate-400 font-bold uppercase tracking-wider">টোটাল সিট</p>
                        <p class="text-xl font-bold text-slate-900 dark:text-white">৩০ টি</p>
                    </div>
                </div>

                <div class="absolute -top-6 -right-6 bg-white/80 dark:bg-slate-800/90 backdrop-blur-md p-4 rounded-xl shadow-xl border border-white/20 dark:border-slate-700 flex items-center gap-4 animate-float-delay z-20 hidden sm:flex min-w-[180px]">
                    <div class="w-12 h-12 rounded-full bg-orange-100 dark:bg-orange-900/30 flex items-center justify-center text-orange-600">
                        <i class="fas fa-clock text-xl"></i>
                    </div>
                    <div>
                        <p class="text-xs text-slate-500 dark:text-slate-400 font-bold uppercase">কোর্স ডিউরেশন</p>
                        <p class="text-xl font-bold text-slate-900 dark:text-white">৬ মাস</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="hidden lg:block absolute right-10 bottom-10 z-50 w-80 animate-bounce-in">
         <div class="bg-white/90 dark:bg-slate-800/90 backdrop-blur-xl border border-slate-200 dark:border-slate-700 rounded-2xl p-6 shadow-2xl hover:shadow-primary-500/10 transition-all duration-300 border-t-4 border-t-primary-500 relative overflow-hidden group">
            
            <div class="absolute top-0 -left-[100%] w-full h-full bg-gradient-to-r from-transparent via-white/20 to-transparent transform skew-x-12 transition-all duration-1000 group-hover:left-[100%]"></div>
            
            <h3 class="text-base font-bold text-slate-900 dark:text-white mb-4 flex items-center justify-between border-b border-slate-200 dark:border-slate-700 pb-3">
                <span class="flex items-center gap-2"><i class="far fa-calendar-alt text-primary-500"></i> সময়সূচি</span>
                <span class="text-[10px] bg-red-100 dark:bg-red-900/30 text-red-600 dark:text-red-400 px-2 py-0.5 rounded-full uppercase font-extrabold tracking-wider animate-pulse">Live</span>
            </h3>
            
            <div class="space-y-3 text-sm">
                <div class="flex items-center justify-between group/item">
                    <span class="text-slate-600 dark:text-slate-400 flex items-center gap-2.5">
                        <div class="w-6 h-6 rounded-full bg-green-100 dark:bg-green-900/30 flex items-center justify-center text-green-600 text-xs group-hover/item:bg-green-600 group-hover/item:text-white transition-colors">
                            <i class="fas fa-check"></i>
                        </div>
                        রেজিস্ট্রেশন শুরু
                    </span>
                    <span class="font-bold text-slate-800 dark:text-slate-200">১৬ জানুয়ারী</span>
                </div>
                
                <div class="flex items-center justify-between group/item">
                    <span class="text-slate-600 dark:text-slate-400 flex items-center gap-2.5">
                        <div class="w-6 h-6 rounded-full bg-red-100 dark:bg-red-900/30 flex items-center justify-center text-red-600 text-xs group-hover/item:bg-red-600 group-hover/item:text-white transition-colors">
                            <i class="fas fa-hourglass-end"></i>
                        </div>
                        রেজিস্ট্রেশন শেষ
                    </span>
                    <span class="font-bold text-red-500">১৬ ফেব্রুয়ারি</span>
                </div>
                
                <div class="flex items-center justify-between group/item">
                    <span class="text-slate-600 dark:text-slate-400 flex items-center gap-2.5">
                        <div class="w-6 h-6 rounded-full bg-purple-100 dark:bg-purple-900/30 flex items-center justify-center text-purple-600 text-xs group-hover/item:bg-purple-600 group-hover/item:text-white transition-colors">
                            <i class="fas fa-rocket"></i>
                        </div>
                        ওরিয়েন্টেশন ক্লাস
                    </span>
                    <span class="font-bold text-primary-600 dark:text-primary-400">২০ ফেব্রুয়ারি</span>
                </div>
            </div>
            
            <div class="mt-4 pt-3 border-t border-slate-100 dark:border-slate-700/50 text-center">
                <p class="text-xs text-slate-400 dark:text-slate-500">সীমিত আসন! দ্রুত নিশ্চিত করুন।</p>
            </div>
        </div>
    </div>

</section>

<style>
    /* Custom Animations */
    @keyframes blob {
        0% { transform: translate(0px, 0px) scale(1); }
        33% { transform: translate(30px, -50px) scale(1.1); }
        66% { transform: translate(-20px, 20px) scale(0.9); }
        100% { transform: translate(0px, 0px) scale(1); }
    }
    .animate-blob { animation: blob 7s infinite; }
    .animation-delay-2000 { animation-delay: 2s; }
    
    .animate-gradient-x {
        background-size: 200% auto;
        animation: gradient-x 4s linear infinite;
    }
    @keyframes gradient-x {
        0% { background-position: 0% 50%; }
        100% { background-position: 200% 50%; }
    }

    /* Floating Icons Animation */
    @keyframes float {
        0% { transform: translateY(0px); }
        50% { transform: translateY(-20px); }
        100% { transform: translateY(0px); }
    }
    .animate-float { animation: float 6s ease-in-out infinite; }
    .animate-float-delay { animation: float 6s ease-in-out 3s infinite; }
    
    /* Bounce In Entrance */
    @keyframes bounceIn {
        0% { opacity: 0; transform: scale(0.3) translateY(20px); }
        50% { opacity: 1; transform: scale(1.05) translateY(-5px); }
        70% { transform: scale(0.9) translateY(0px); }
        100% { transform: scale(1) translateY(0); }
    }
    .animate-bounce-in {
        animation: bounceIn 0.8s cubic-bezier(0.215, 0.610, 0.355, 1.000) both;
        animation-delay: 0.5s; /* Delays appearance */
    }
</style>