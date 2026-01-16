@extends('frontend.layouts.master')

@section('title', 'আমাদের সম্পর্কে | প্রযুক্তিপ্লাস একাডেমি')

@section('content')

<section class="relative pt-32 pb-12 overflow-hidden bg-slate-50 dark:bg-slate-900 transition-colors duration-300">
    
    <div class="absolute inset-0 pointer-events-none">
        <div class="absolute top-0 left-0 w-full h-24 bg-gradient-to-b from-slate-50 dark:from-slate-900 to-transparent z-10"></div>
        <div class="absolute top-1/4 left-0 w-[600px] h-[600px] bg-blue-500/5 dark:bg-blue-600/10 rounded-full blur-[100px] -translate-x-1/2 animate-pulse"></div>
        <div class="absolute bottom-0 right-0 w-[600px] h-[600px] bg-purple-500/5 dark:bg-purple-600/10 rounded-full blur-[100px] translate-x-1/2 animate-pulse delay-1000"></div>
    </div>

    <div class="container mx-auto px-4 relative z-10 text-center">
        <h1 class="text-3xl md:text-5xl font-bold text-slate-900 dark:text-white mb-4 font-heading">
            আমাদের <span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-600 dark:from-gray-100 via-purple-600 dark:via-purple-300 to-pink-600 dark:to-pink-200">সম্পর্কে</span>
        </h1>
        
        <nav class="flex justify-center items-center gap-2 text-sm text-slate-500 dark:text-slate-400">
            <a href="{{ route('home') }}" class="hover:text-blue-600 transition-colors">হোম</a>
            <i class="fas fa-chevron-right text-[10px]"></i>
            <span class="text-slate-800 dark:text-slate-200 font-medium">পরিচিতি</span>
        </nav>
    </div>
</section>

<section class="py-16 md:py-24 relative bg-slate-50 dark:bg-slate-900">
    <div class="container mx-auto px-4 relative z-10">
        <div class="flex flex-col lg:flex-row items-center gap-12">
            
            <div class="lg:w-1/2 relative group">
                <div class="absolute inset-0 bg-gradient-to-r from-blue-600 to-purple-600 rounded-3xl rotate-3 opacity-20 blur-lg group-hover:opacity-30 transition-opacity duration-500"></div>
                <img src="https://images.unsplash.com/photo-1522071820081-009f0129c71c?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" 
                     alt="Our Mission" 
                     class="relative rounded-3xl shadow-2xl border border-white/20 w-full object-cover z-10 transform group-hover:scale-[1.02] transition-transform duration-500">
                
                <div class="absolute -bottom-6 -right-6 z-20 bg-white/80 dark:bg-slate-800/80 backdrop-blur-md p-6 rounded-2xl shadow-xl border border-slate-200 dark:border-slate-700 animate-bounce-slow hidden sm:block">
                    <p class="text-xs text-slate-500 dark:text-slate-400 font-bold uppercase mb-1">অভিজ্ঞতা</p>
                    <p class="text-3xl font-bold bg-clip-text text-transparent bg-gradient-to-r from-blue-600 to-purple-600">৭+ বছর</p>
                </div>
            </div>

            <div class="lg:w-1/2">
                <div class="text-left mb-8">
                    <h2 class="text-2xl md:text-3xl font-bold text-slate-900 dark:text-white mb-3 font-heading">
                        <span class="bg-clip-text text-transparent bg-gradient-to-r from-blue-600 dark:from-gray-100 via-purple-600 dark:via-purple-300 to-pink-600 dark:to-pink-200">
                            দক্ষতা গড়ার কারিগর
                        </span>
                    </h2>
                    <p class="text-sm md:text-base text-slate-600 dark:text-slate-400">
                        পুঁথিগত বিদ্যা নয়, আমরা বিশ্বাস করি হাতে-কলমে শিক্ষায়
                    </p>
                </div>

                <div class="prose dark:prose-invert text-slate-600 dark:text-slate-300 space-y-4 leading-relaxed">
                    <p>
                        ২০১৯ সালে আমাদের যাত্রা শুরু হয় একটি স্বপ্ন নিয়ে—বাংলাদেশের তরুণদের গ্লোবাল মার্কেটের জন্য তৈরি করা। আমরা লক্ষ্য করলাম, অনেকেই অনেক কোর্স করছেন কিন্তু দিনশেষে রিয়েল প্রজেক্ট করতে গিয়ে হিমশিম খাচ্ছেন।
                    </p>
                    <p>
                        সেই গ্যাপ পূরণ করতেই <strong>"প্রযুক্তিপ্লাস একাডেমি"</strong>-এর জন্ম। আমাদের উদ্দেশ্য গতানুগতিক টিউটোরিয়াল দেখা নয়, বরং আপনাকে একজন <strong>"প্রবলেম সলভার"</strong> হিসেবে গড়ে তোলা।
                    </p>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mt-8">
                    <div class="flex items-center gap-3 p-4 rounded-xl bg-white/50 dark:bg-slate-800/50 backdrop-blur-sm border border-slate-200 dark:border-slate-700 hover:border-blue-500/30 transition-all">
                        <div class="w-10 h-10 rounded-lg bg-blue-100 dark:bg-blue-900/30 flex items-center justify-center text-blue-600">
                            <i class="fas fa-code"></i>
                        </div>
                        <span class="font-bold text-slate-700 dark:text-slate-200 text-sm">প্রজেক্ট ভিত্তিক লার্নিং</span>
                    </div>
                    <div class="flex items-center gap-3 p-4 rounded-xl bg-white/50 dark:bg-slate-800/50 backdrop-blur-sm border border-slate-200 dark:border-slate-700 hover:border-purple-500/30 transition-all">
                        <div class="w-10 h-10 rounded-lg bg-purple-100 dark:bg-purple-900/30 flex items-center justify-center text-purple-600">
                            <i class="fas fa-infinity"></i>
                        </div>
                        <span class="font-bold text-slate-700 dark:text-slate-200 text-sm">লাইফটাইম এক্সেস</span>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>

<section class="py-16 md:py-24 relative bg-slate-50 dark:bg-slate-900">
    <div class="container mx-auto px-4 relative z-10">
        
        <div class="text-center mb-12">
            <h2 class="text-2xl md:text-3xl font-bold text-slate-900 dark:text-white mb-3 font-heading">
                <span class="bg-clip-text text-transparent bg-gradient-to-r from-blue-600 dark:from-gray-100 via-purple-600 dark:via-purple-300 to-pink-600 dark:to-pink-200">
                    মেন্টর পরিচিতি
                </span>
            </h2>
            <p class="text-sm md:text-base text-slate-600 dark:text-slate-400 max-w-2xl mx-auto">
                যার হাত ধরে আপনার প্রোগ্রামিং যাত্রা শুরু হবে
            </p>
        </div>

        <div class="max-w-4xl mx-auto bg-white/60 dark:bg-slate-800/60 backdrop-blur-xl rounded-3xl p-8 md:p-12 shadow-xl border border-slate-200 dark:border-slate-700 relative overflow-hidden group hover:shadow-2xl transition-all duration-500">
            
            <div class="flex flex-col md:flex-row gap-8 items-center md:items-start relative z-10">
                
                <div class="flex-shrink-0 text-center relative">
                    <div class="relative w-40 h-40 mx-auto group-hover:scale-105 transition-transform duration-500">
                        <div class="absolute inset-0 bg-gradient-to-br from-blue-600 to-purple-600 rounded-full animate-pulse opacity-20"></div>
                        <img src="{{ asset('assets/images/instructor.jpg') }}" alt="Md Naimur Rahman" class="relative w-full h-full rounded-full object-cover border-4 border-white/50 dark:border-slate-700/50 shadow-lg p-1">
                    </div>
                    <div class="mt-5">
                        <h3 class="text-xl font-bold text-slate-900 dark:text-white font-heading">মোঃ নাঈমুর রহমান</h3>
                        <span class="inline-block mt-1 px-3 py-1 bg-blue-50 dark:bg-blue-900/20 text-blue-600 dark:text-blue-400 border border-blue-100 dark:border-blue-900/30 rounded-full text-xs font-bold">
                            ফাউন্ডার ও লিড মেন্টর
                        </span>
                    </div>
                    <div class="flex justify-center gap-4 mt-4">
                        <a href="#" class="w-8 h-8 rounded-full bg-slate-100 dark:bg-slate-700 flex items-center justify-center text-slate-500 hover:bg-blue-600 hover:text-white transition-all"><i class="fab fa-facebook-f text-sm"></i></a>
                        <a href="#" class="w-8 h-8 rounded-full bg-slate-100 dark:bg-slate-700 flex items-center justify-center text-slate-500 hover:bg-blue-500 hover:text-white transition-all"><i class="fab fa-linkedin-in text-sm"></i></a>
                        <a href="#" class="w-8 h-8 rounded-full bg-slate-100 dark:bg-slate-700 flex items-center justify-center text-slate-500 hover:bg-slate-800 hover:text-white transition-all"><i class="fab fa-github text-sm"></i></a>
                    </div>
                </div>

                <div class="flex-1 text-center md:text-left">
                    <div class="relative">
                        <i class="fas fa-quote-left text-4xl text-slate-200 dark:text-slate-700/50 absolute -top-6 -left-6"></i>
                        <p class="text-slate-600 dark:text-slate-300 text-lg leading-relaxed italic relative z-10 pl-4 md:pl-0">
                            "আমি বিশ্বাস করি প্রোগ্রামিং কোনো রকেট সায়েন্স নয়। সঠিক গাইডলাইন পেলে একজন নন-সিএসই স্টুডেন্টও দারুণ কোড করতে পারে। আমার লক্ষ্য আপনাকে শুধু সিনট্যাক্স শেখানো নয়, বরং ইন্ডাস্ট্রি স্ট্যন্ডার্ড আর্কিটেকচার এবং বেস্ট প্র্যাকটিসগুলো শিখিয়ে একজন কমপ্লিট ইঞ্জিনিয়ার হিসেবে তৈরি করা।"
                        </p>
                    </div>
                    
                    <div class="grid grid-cols-3 gap-4 mt-8 pt-8 border-t border-slate-200/50 dark:border-slate-700/50">
                        <div class="text-center">
                            <h4 class="text-2xl font-bold bg-clip-text text-transparent bg-gradient-to-r from-blue-600 to-cyan-600">৫০+</h4>
                            <p class="text-[10px] font-bold uppercase tracking-wider text-slate-500">লাইভ প্রজেক্ট</p>
                        </div>
                        <div class="text-center border-l border-r border-slate-200/50 dark:border-slate-700/50">
                            <h4 class="text-2xl font-bold bg-clip-text text-transparent bg-gradient-to-r from-purple-600 to-pink-600">৫০০+</h4>
                            <p class="text-[10px] font-bold uppercase tracking-wider text-slate-500">হ্যাপি স্টুডেন্ট</p>
                        </div>
                        <div class="text-center">
                            <h4 class="text-2xl font-bold bg-clip-text text-transparent bg-gradient-to-r from-orange-600 to-red-600">৭+</h4>
                            <p class="text-[10px] font-bold uppercase tracking-wider text-slate-500">বছরের অভিজ্ঞতা</p>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</section>

<section class="py-16 md:py-24 relative bg-slate-50 dark:bg-slate-900">
    <div class="container mx-auto px-4 relative z-10">
        
        <div class="text-center mb-12">
            <h2 class="text-2xl md:text-3xl font-bold text-slate-900 dark:text-white mb-3 font-heading">
                <span class="bg-clip-text text-transparent bg-gradient-to-r from-blue-600 dark:from-gray-100 via-purple-600 dark:via-purple-300 to-pink-600 dark:to-pink-200">
                    কেন আমরা আলাদা?
                </span>
            </h2>
            <p class="text-sm md:text-base text-slate-600 dark:text-slate-400 max-w-2xl mx-auto">
                আমাদের প্রতিটি পদক্ষেপ নেওয়া হয় আপনার ক্যারিয়ারের কথা চিন্তা করে
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="group p-8 rounded-2xl bg-white/60 dark:bg-slate-800/60 backdrop-blur-md border border-slate-200 dark:border-slate-700 hover:border-blue-500/30 shadow-sm hover:shadow-xl transition-all duration-300 hover:-translate-y-1">
                <div class="w-14 h-14 rounded-xl bg-blue-50 dark:bg-blue-900/20 flex items-center justify-center text-2xl text-blue-600 mb-6 group-hover:scale-110 transition-transform shadow-inner">
                    <i class="fas fa-hand-holding-heart"></i>
                </div>
                <h3 class="text-lg font-bold text-slate-900 dark:text-white mb-3 font-heading">সততা ও স্বচ্ছতা</h3>
                <p class="text-sm text-slate-600 dark:text-slate-400 leading-relaxed">
                    আমরা যা শেখাবো বলে কথা দিই, ঠিক তাই শেখাই। কোনো হিডেন চার্জ বা মিথ্যা প্রলোভন দিয়ে আমরা ভর্তি করাই না।
                </p>
            </div>

            <div class="group p-8 rounded-2xl bg-white/60 dark:bg-slate-800/60 backdrop-blur-md border border-slate-200 dark:border-slate-700 hover:border-purple-500/30 shadow-sm hover:shadow-xl transition-all duration-300 hover:-translate-y-1">
                <div class="w-14 h-14 rounded-xl bg-purple-50 dark:bg-purple-900/20 flex items-center justify-center text-2xl text-purple-600 mb-6 group-hover:scale-110 transition-transform shadow-inner">
                    <i class="fas fa-rocket"></i>
                </div>
                <h3 class="text-lg font-bold text-slate-900 dark:text-white mb-3 font-heading">আপডেটেড কারিকুলাম</h3>
                <p class="text-sm text-slate-600 dark:text-slate-400 leading-relaxed">
                    প্রযুক্তি প্রতিদিন বদলায়। আমরা ২০২৬ সালের লেটেস্ট স্ট্যাক (Laravel 12, Vue 3, Tailwind 4) ব্যবহার করে শেখাই।
                </p>
            </div>

            <div class="group p-8 rounded-2xl bg-white/60 dark:bg-slate-800/60 backdrop-blur-md border border-slate-200 dark:border-slate-700 hover:border-pink-500/30 shadow-sm hover:shadow-xl transition-all duration-300 hover:-translate-y-1">
                <div class="w-14 h-14 rounded-xl bg-pink-50 dark:bg-pink-900/20 flex items-center justify-center text-2xl text-pink-600 mb-6 group-hover:scale-110 transition-transform shadow-inner">
                    <i class="fas fa-users"></i>
                </div>
                <h3 class="text-lg font-bold text-slate-900 dark:text-white mb-3 font-heading">কমিউনিটি সাপোর্ট</h3>
                <p class="text-sm text-slate-600 dark:text-slate-400 leading-relaxed">
                    কোর্স শেষ হলেও সম্পর্ক শেষ নয়। আমাদের প্রাইভেট কমিউনিটিতে আপনি মেন্টরের কাছ থেকে আজীবন সাপোর্ট পাবেন।
                </p>
            </div>
        </div>

    </div>
</section>

<section class="py-16 bg-slate-50 dark:bg-slate-900">
    <div class="container mx-auto px-4">
        <div class="relative rounded-3xl p-10 md:p-16 text-center overflow-hidden group">
            
            <div class="absolute inset-0 bg-gradient-to-r from-blue-600 to-purple-600 opacity-90"></div>
            <div class="absolute inset-0 bg-[url('https://www.transparenttextures.com/patterns/cubes.png')] opacity-10"></div>
            
            <div class="relative z-10">
                <h2 class="text-2xl md:text-4xl font-bold text-white mb-6 font-heading">
                    ক্যারিয়ার গড়ার এখনই সেরা সময়
                </h2>
                <p class="text-blue-100 mb-8 max-w-xl mx-auto text-lg">
                    দেরি না করে আজই যুক্ত হোন আমাদের পরবর্তী ব্যাচে। আপনার সফলতার গল্প লেখার অপেক্ষায় আমরা।
                </p>
                <a href="{{ route('courses.index') }}" class="inline-flex items-center gap-2 bg-white text-blue-600 font-bold py-3.5 px-8 rounded-full shadow-lg hover:shadow-xl hover:scale-105 transition-all duration-300">
                    কোর্সগুলো দেখুন <i class="fas fa-arrow-right"></i>
                </a>
            </div>
        </div>
    </div>
</section>

@endsection