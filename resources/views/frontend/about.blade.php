@extends('frontend.layouts.master')

@section('content')

<div class="bg-slate-50 dark:bg-slate-900 border-b border-slate-200 dark:border-slate-800 pt-32 pb-16 transition-colors duration-300 relative overflow-hidden">
    
    <div class="absolute top-0 right-0 w-96 h-96 bg-primary-500/5 rounded-full blur-3xl -translate-y-1/2 translate-x-1/2"></div>
    <div class="absolute bottom-0 left-0 w-64 h-64 bg-purple-500/5 rounded-full blur-3xl translate-y-1/2 -translate-x-1/2"></div>

    <div class="container mx-auto px-4 relative z-10 text-center">
        <nav class="flex justify-center text-sm text-slate-500 dark:text-slate-400 mb-4">
            <a href="/" class="hover:text-primary-600 transition-colors">হোম</a>
            <span class="mx-2">/</span>
            <span class="text-slate-800 dark:text-slate-200">আমাদের সম্পর্কে</span>
        </nav>
        <h1 class="text-4xl md:text-5xl font-bold text-slate-900 dark:text-white mb-6 font-heading">
            দক্ষতা গড়ুন, <span class="text-transparent bg-clip-text bg-gradient-to-r from-primary-600 to-purple-600">ভবিষ্যৎ গড়ুন</span>
        </h1>
        <p class="text-lg text-slate-600 dark:text-slate-400 max-w-2xl mx-auto leading-relaxed">
            প্রযুক্তিপ্লাস একাডেমি শুধুমাত্র একটি লার্নিং প্ল্যাটফর্ম নয়, এটি আগামীর টেক লিডার এবং দক্ষ ফ্রিল্যান্সার তৈরির একটি মিশন।
        </p>
    </div>
</div>

<section class="py-20 bg-white dark:bg-slate-950 transition-colors duration-300">
    <div class="container mx-auto px-4">
        <div class="flex flex-col lg:flex-row items-center gap-12 lg:gap-20">
            
            <div class="lg:w-1/2 relative">
                <div class="absolute inset-0 bg-primary-600 rounded-3xl rotate-3 opacity-10"></div>
                <img src="https://images.unsplash.com/photo-1522071820081-009f0129c71c?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" 
                     alt="Team Working" 
                     class="relative rounded-3xl shadow-2xl border border-slate-100 dark:border-slate-800 w-full object-cover">
                
                <div class="absolute -bottom-6 -right-6 bg-white dark:bg-slate-800 p-6 rounded-2xl shadow-xl border border-slate-100 dark:border-slate-700 animate-bounce-slow hidden sm:block">
                    <p class="text-sm text-slate-500 dark:text-slate-400 font-bold uppercase mb-1">অভিজ্ঞতা</p>
                    <p class="text-3xl font-bold text-primary-600">৭+ বছর</p>
                </div>
            </div>

            <div class="lg:w-1/2">
                <h2 class="text-3xl font-bold text-slate-900 dark:text-white mb-6 font-heading border-l-4 border-primary-600 pl-4">
                    আমাদের যাত্রার গল্প
                </h2>
                <div class="prose dark:prose-invert text-slate-600 dark:text-slate-300 space-y-4">
                    <p>
                        ২০১৯ সালে আমাদের যাত্রা শুরু হয় একটি ছোট সফটওয়্যার ফার্ম হিসেবে। কাজ করতে গিয়ে আমরা লক্ষ্য করি, ইন্ডাস্ট্রিতে প্রচুর কাজের সুযোগ থাকলেও দক্ষ জনবলের অভাব। পুঁথিগত বিদ্যা আর বাস্তব কাজের মধ্যে বিশাল এক ব্যবধান রয়ে গেছে।
                    </p>
                    <p>
                        সেই গ্যাপ পূরণ করতেই <strong>"প্রযুক্তিপ্লাস একাডেমি"</strong>-এর জন্ম। আমাদের লক্ষ্য গতানুগতিক ভিডিও কোর্স বিক্রি করা নয়, বরং হাতে-কলমে কাজ শিখিয়ে শিক্ষার্থীদের জব মার্কেটের জন্য প্রস্তুত করা।
                    </p>
                    <p>
                        আমরা বিশ্বাস করি—প্রোগ্রামিং কারো পৈতৃক সম্পত্তি নয়। সঠিক গাইডলাইন, অধ্যবসায় এবং প্র্যাকটিস থাকলে যেকোনো ব্যাকগ্রাউন্ডের মানুষ একজন সফল ডেভেলপার হতে পারেন।
                    </p>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mt-8">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-full bg-green-100 dark:bg-green-900/30 flex items-center justify-center text-green-600">
                            <i class="fas fa-check"></i>
                        </div>
                        <span class="font-bold text-slate-700 dark:text-slate-200">প্রজেক্ট ভিত্তিক শিক্ষা</span>
                    </div>
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-full bg-blue-100 dark:bg-blue-900/30 flex items-center justify-center text-blue-600">
                            <i class="fas fa-headset"></i>
                        </div>
                        <span class="font-bold text-slate-700 dark:text-slate-200">লাইফটাইম সাপোর্ট</span>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>

<section class="py-20 bg-slate-50 dark:bg-slate-900 transition-colors duration-300">
    <div class="container mx-auto px-4">
        <div class="max-w-4xl mx-auto bg-white dark:bg-slate-800 rounded-3xl p-8 md:p-12 shadow-xl border border-slate-200 dark:border-slate-700 relative overflow-hidden">
            
            <div class="absolute top-4 right-8 text-9xl text-slate-100 dark:text-slate-700 font-serif opacity-50 pointer-events-none">”</div>

            <div class="flex flex-col md:flex-row gap-8 items-center md:items-start relative z-10">
                
                <div class="flex-shrink-0 text-center md:text-left">
                    <div class="relative inline-block">
                        <div class="absolute inset-0 bg-primary-600 rounded-full blur-md opacity-50"></div>
                        <img src="{{ asset('images/instructor.jpg') }}" alt="Md Naimur Rahman" class="relative w-32 h-32 md:w-40 md:h-40 rounded-full object-cover border-4 border-white dark:border-slate-700 shadow-lg">
                    </div>
                    <div class="mt-4">
                        <h3 class="text-xl font-bold text-slate-900 dark:text-white font-heading">মোঃ নাঈমুর রহমান</h3>
                        <p class="text-sm text-primary-600 font-bold">ফাউন্ডার ও মেন্টর</p>
                    </div>
                    <div class="flex justify-center md:justify-start gap-3 mt-3">
                        <a href="#" class="text-slate-400 hover:text-blue-600 transition"><i class="fab fa-facebook-f"></i></a>
                        <a href="#" class="text-slate-400 hover:text-blue-500 transition"><i class="fab fa-linkedin-in"></i></a>
                        <a href="#" class="text-slate-400 hover:text-slate-900 dark:hover:text-white transition"><i class="fab fa-github"></i></a>
                    </div>
                </div>

                <div class="flex-1 text-center md:text-left">
                    <h4 class="text-lg font-bold text-slate-500 dark:text-slate-400 mb-4 uppercase tracking-wider text-xs">ফাউন্ডারের বার্তা</h4>
                    <p class="text-slate-600 dark:text-slate-300 text-lg leading-relaxed italic mb-6">
                        "আমি যখন প্রোগ্রামিং শুরু করি, তখন রিসোর্সের অভাব ছিল না, কিন্তু অভাব ছিল 'সঠিক নির্দেশনার'। আমি চাই না আমার ছাত্ররা সেই একই রাস্তায় হাঁটুক। আমার উদ্দেশ্য শুধু কোড শেখানো নয়, বরং কীভাবে একজন প্রবলেম সলভার হওয়া যায় এবং গ্লোবাল মার্কেটে নিজের জায়গা করে নেওয়া যায়—সেটাই আমার মূল লক্ষ্য।"
                    </p>
                    <div class="flex flex-wrap gap-4 justify-center md:justify-start">
                        <div class="px-4 py-2 bg-slate-100 dark:bg-slate-700 rounded-lg text-sm font-bold text-slate-600 dark:text-slate-300">
                            💻 ৫০+ প্রজেক্ট
                        </div>
                        <div class="px-4 py-2 bg-slate-100 dark:bg-slate-700 rounded-lg text-sm font-bold text-slate-600 dark:text-slate-300">
                            🎓 ২০০+ স্টুডেন্ট
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</section>

<section class="py-20 bg-white dark:bg-slate-950 transition-colors duration-300">
    <div class="container mx-auto px-4 text-center">
        
        <h2 class="text-3xl font-bold text-slate-900 dark:text-white mb-12 font-heading">
            আমাদের <span class="text-primary-600">কোর ভ্যালু</span>
        </h2>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <div class="p-8 rounded-2xl bg-slate-50 dark:bg-slate-900 border border-slate-100 dark:border-slate-800 hover:border-primary-200 transition duration-300 group">
                <div class="w-16 h-16 mx-auto bg-white dark:bg-slate-800 rounded-full flex items-center justify-center text-3xl shadow-sm mb-6 text-primary-600 group-hover:scale-110 transition-transform">
                    <i class="fas fa-hand-holding-heart"></i>
                </div>
                <h3 class="text-xl font-bold text-slate-900 dark:text-white mb-3">সততা ও স্বচ্ছতা</h3>
                <p class="text-slate-600 dark:text-slate-400 text-sm">
                    আমরা যা শেখাবো বলে কথা দিই, তাই শেখাই। কোনো হিডেন চার্জ বা মিথ্যা প্রলোভন আমরা দিই না।
                </p>
            </div>

            <div class="p-8 rounded-2xl bg-slate-50 dark:bg-slate-900 border border-slate-100 dark:border-slate-800 hover:border-purple-200 transition duration-300 group">
                <div class="w-16 h-16 mx-auto bg-white dark:bg-slate-800 rounded-full flex items-center justify-center text-3xl shadow-sm mb-6 text-purple-600 group-hover:scale-110 transition-transform">
                    <i class="fas fa-rocket"></i>
                </div>
                <h3 class="text-xl font-bold text-slate-900 dark:text-white mb-3">আপডেটেড কারিকুলাম</h3>
                <p class="text-slate-600 dark:text-slate-400 text-sm">
                    টেকনোলজি প্রতিদিন বদলায়। আমরা ২০২৬ সালের লেটেস্ট স্ট্যাক (Laravel 12, Vue 3) ব্যবহার করে শেখাই।
                </p>
            </div>

            <div class="p-8 rounded-2xl bg-slate-50 dark:bg-slate-900 border border-slate-100 dark:border-slate-800 hover:border-emerald-200 transition duration-300 group">
                <div class="w-16 h-16 mx-auto bg-white dark:bg-slate-800 rounded-full flex items-center justify-center text-3xl shadow-sm mb-6 text-emerald-600 group-hover:scale-110 transition-transform">
                    <i class="fas fa-users"></i>
                </div>
                <h3 class="text-xl font-bold text-slate-900 dark:text-white mb-3">কমিউনিটি সাপোর্ট</h3>
                <p class="text-slate-600 dark:text-slate-400 text-sm">
                    কোর্স শেষ হলেও সম্পর্ক শেষ নয়। আমাদের প্রাইভেট কমিউনিটিতে আপনি আজীবন সাপোর্ট পাবেন।
                </p>
            </div>
        </div>

    </div>
</section>

<section class="py-16 bg-primary-600 relative overflow-hidden">
    <div class="absolute inset-0 opacity-10 pattern-dots"></div> <div class="container mx-auto px-4 text-center relative z-10">
        <h2 class="text-3xl font-bold text-white mb-6 font-heading">ক্যারিয়ার গড়ার এখনই সময়</h2>
        <p class="text-primary-100 mb-8 max-w-2xl mx-auto">
            দেরি না করে আজই যুক্ত হোন আমাদের পরবর্তী ব্যাচে। আপনার সফলতার গল্প লেখার অপেক্ষায় আমরা।
        </p>
        <a href="{{ url('/courses') }}" class="inline-block bg-white text-primary-600 font-bold py-3 px-8 rounded-full shadow-lg hover:bg-slate-100 transition transform hover:-translate-y-1">
            কোর্সগুলো দেখুন
        </a>
    </div>
</section>

@endsection