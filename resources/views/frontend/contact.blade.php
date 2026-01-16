@extends('frontend.layouts.master')

@section('title', 'যোগাযোগ | প্রযুক্তিপ্লাস একাডেমি')

@section('content')

<section class="relative pt-32 pb-12 overflow-hidden bg-slate-50 dark:bg-slate-900 transition-colors duration-300">
    
    <div class="absolute inset-0 pointer-events-none">
        <div class="absolute top-0 left-0 w-full h-24 bg-gradient-to-b from-slate-50 dark:from-slate-900 to-transparent z-10"></div>
        <div class="absolute top-1/4 left-0 w-[600px] h-[600px] bg-blue-500/5 dark:bg-blue-600/10 rounded-full blur-[100px] -translate-x-1/2 animate-pulse"></div>
        <div class="absolute bottom-0 right-0 w-[600px] h-[600px] bg-purple-500/5 dark:bg-purple-600/10 rounded-full blur-[100px] translate-x-1/2 animate-pulse delay-1000"></div>
    </div>

    <div class="container mx-auto px-4 relative z-10 text-center">
        <h1 class="text-3xl md:text-5xl font-bold text-slate-900 dark:text-white mb-4 font-heading">
            প্রয়োজনে আমাদের সাথে <span class="bg-clip-text text-transparent bg-gradient-to-r from-blue-600 dark:from-gray-100 via-purple-600 dark:via-purple-300 to-pink-600 dark:to-pink-200">যোগাযোগ করতে পারেন।</span>
        </h1>
        
        <nav class="flex justify-center items-center gap-2 text-sm text-slate-500 dark:text-slate-400">
            <a href="{{ route('home') }}" class="hover:text-blue-600 transition-colors">হোম</a>
            <i class="fas fa-chevron-right text-[10px]"></i>
            <span class="text-slate-800 dark:text-slate-200 font-medium">যোগাযোগ</span>
        </nav>
    </div>
</section>

<section class="py-12 relative bg-slate-50 dark:bg-slate-900">
    <div class="container mx-auto px-4 relative z-10">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            
            <div class="group p-8 rounded-2xl bg-white/60 dark:bg-slate-800/60 backdrop-blur-md border border-slate-200 dark:border-slate-700 hover:border-green-500/30 shadow-sm hover:shadow-xl transition-all duration-300 hover:-translate-y-1 text-center">
                <div class="w-14 h-14 mx-auto rounded-xl bg-green-100 dark:bg-green-900/20 flex items-center justify-center text-2xl text-green-600 mb-4 group-hover:scale-110 transition-transform shadow-inner">
                    <i class="fab fa-whatsapp"></i>
                </div>
                <h3 class="text-lg font-bold text-slate-900 dark:text-white mb-2 font-heading">হোয়াটস অ্যাপ</h3>
                <p class="text-xs text-slate-500 mb-3">সরাসরি চ্যাট করতে ক্লিক করুন</p>
                <a href="https://wa.me/8801909605599" target="_blank" class="text-lg font-bold text-slate-700 dark:text-slate-200 hover:text-green-600 font-mono flex items-center justify-center gap-2">
                    <span>+8801909605599</span>
                    <i class="fas fa-external-link-alt text-xs opacity-50"></i>
                </a>
            </div>

            <div class="group p-8 rounded-2xl bg-white/60 dark:bg-slate-800/60 backdrop-blur-md border border-slate-200 dark:border-slate-700 hover:border-purple-500/30 shadow-sm hover:shadow-xl transition-all duration-300 hover:-translate-y-1 text-center">
                <div class="w-14 h-14 mx-auto rounded-xl bg-purple-100 dark:bg-purple-900/20 flex items-center justify-center text-2xl text-purple-600 mb-4 group-hover:scale-110 transition-transform shadow-inner">
                    <i class="fas fa-envelope"></i>
                </div>
                <h3 class="text-lg font-bold text-slate-900 dark:text-white mb-2 font-heading">ইমেইল করুন</h3>
                <p class="text-xs text-slate-500 mb-3">২৪ ঘণ্টার মধ্যে রিপ্লাই পাবেন</p>
                <a href="mailto:support@topit24.com" class="text-base font-bold text-slate-700 dark:text-slate-200 hover:text-purple-600 font-mono">
                    support@projuktiplus.com
                </a>
            </div>

            <div class="group p-8 rounded-2xl bg-white/60 dark:bg-slate-800/60 backdrop-blur-md border border-slate-200 dark:border-slate-700 hover:border-pink-500/30 shadow-sm hover:shadow-xl transition-all duration-300 hover:-translate-y-1 text-center">
                <div class="w-14 h-14 mx-auto rounded-xl bg-pink-100 dark:bg-pink-900/20 flex items-center justify-center text-2xl text-pink-600 mb-4 group-hover:scale-110 transition-transform shadow-inner">
                    <i class="fas fa-map-marker-alt"></i>
                </div>
                <h3 class="text-lg font-bold text-slate-900 dark:text-white mb-2 font-heading">অফিস</h3>
                <p class="text-xs text-slate-500 mb-3">সোনাডাঙ্গা, খুলনা</p>
                <span class="text-base font-bold text-slate-700 dark:text-slate-200">
                    খুলনা, বাংলাদেশ
                </span>
            </div>

        </div>
    </div>
</section>

<section class="py-16 bg-slate-50 dark:bg-slate-900 relative">
    <div class="container mx-auto px-4 relative z-10">
        <div class="mx-auto bg-white dark:bg-slate-800 rounded-3xl shadow-2xl border border-slate-200 dark:border-slate-700 overflow-hidden">
            <div class="grid grid-cols-1 lg:grid-cols-5">
                
                <div class="lg:col-span-2 bg-slate-100 dark:bg-slate-800/50 p-8 flex flex-col justify-center items-center text-center border-r border-slate-200 dark:border-slate-700">
                    <div class="w-20 h-20 bg-white dark:bg-slate-700 rounded-full flex items-center justify-center text-4xl text-blue-600 mb-6 shadow-md">
                        <i class="fas fa-paper-plane"></i>
                    </div>
                    <h3 class="text-xl font-bold text-slate-900 dark:text-white mb-2">মেসেজ পাঠান</h3>
                    <p class="text-sm text-slate-600 dark:text-slate-400">
                        কোর্স, কারিকুলাম বা ভর্তি বিষয়ক যেকোনো তথ্যের জন্য নিচের ফর্মটি পূরণ করুন।
                    </p>
                </div>

                <div class="lg:col-span-3 p-8 md:p-10">
                    <form action="#" method="POST" class="space-y-5">
                        @csrf
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                            <div>
                                <label class="block text-xs font-bold text-slate-500 dark:text-slate-400 mb-1 uppercase">আপনার নাম</label>
                                <input type="text" name="name" placeholder="নাম লিখুন" class="w-full bg-slate-50 dark:bg-slate-900 border border-slate-200 dark:border-slate-700 rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500 transition-all dark:text-white">
                            </div>
                            <div>
                                <label class="block text-xs font-bold text-slate-500 dark:text-slate-400 mb-1 uppercase">ফোন নাম্বার</label>
                                <input type="tel" name="phone" placeholder="017xxxxxxxx" class="w-full bg-slate-50 dark:bg-slate-900 border border-slate-200 dark:border-slate-700 rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500 transition-all dark:text-white">
                            </div>
                        </div>

                        <div>
                            <label class="block text-xs font-bold text-slate-500 dark:text-slate-400 mb-1 uppercase">ইমেইল</label>
                            <input type="email" name="email" placeholder="example@mail.com" class="w-full bg-slate-50 dark:bg-slate-900 border border-slate-200 dark:border-slate-700 rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500 transition-all dark:text-white">
                        </div>

                        <div>
                            <label class="block text-xs font-bold text-slate-500 dark:text-slate-400 mb-1 uppercase">বিষয়</label>
                            <select name="subject" class="w-full bg-slate-50 dark:bg-slate-900 border border-slate-200 dark:border-slate-700 rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500 transition-all dark:text-white">
                                <option value="admission">ভর্তি সংক্রান্ত তথ্য</option>
                                <option value="support">টেকনিক্যাল সাপোর্ট</option>
                                <option value="other">অন্যান্য</option>
                            </select>
                        </div>

                        <div>
                            <label class="block text-xs font-bold text-slate-500 dark:text-slate-400 mb-1 uppercase">আপনার বার্তা</label>
                            <textarea name="message" rows="4" placeholder="বিস্তারিত লিখুন..." class="w-full bg-slate-50 dark:bg-slate-900 border border-slate-200 dark:border-slate-700 rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500 transition-all resize-none dark:text-white"></textarea>
                        </div>

                        <button type="submit" class="w-full bg-gradient-to-r from-blue-600 to-purple-600 hover:from-blue-700 hover:to-purple-700 text-white font-bold py-3.5 rounded-xl shadow-lg shadow-blue-500/30 transition-all transform hover:-translate-y-1 flex items-center justify-center gap-2">
                            <span>মেসেজ পাঠান</span>
                            <i class="fas fa-paper-plane text-xs"></i>
                        </button>
                    </form>
                </div>

            </div>
        </div>
    </div>
</section>

@endsection