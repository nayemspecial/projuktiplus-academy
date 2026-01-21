<footer class="bg-slate-900 text-slate-300 border-t border-slate-800 relative overflow-hidden font-body print:hidden">
    
    <div class="absolute top-0 left-0 w-full h-0.5 bg-gradient-to-r from-transparent via-primary-600 to-transparent opacity-70"></div>

    <div class="container mx-auto px-4 pt-16 pb-8">
        
        <div class="grid grid-cols-2 lg:grid-cols-4 gap-6 lg:gap-10 mb-12">
            
            <div class="col-span-2 sm:col-span-1">
                <a href="{{ url('/') }}" class="inline-block mb-5">
                    @if(\App\Models\Setting::get('site_logo'))
                        <img src="{{ asset('storage/' . \App\Models\Setting::get('site_logo')) }}" alt="ProjuktiPlus Academy" class="h-10 w-auto">
                        <h1 class="text-xl md:text-2xl font-semibold text-slate-800 dark:text-white font-heading tracking-tight leading-none">
                        {{ \App\Models\Setting::get('site_name', 'ProjuktiPlus') }}
                        </h1>
                        <span class="text-[11px] text-slate-500 dark:text-slate-400 font-medium tracking-wider hidden lg:block mt-1">যেখানে প্রযুক্তির গল্প হয় সহজ ভাষায়</span>
                    @else
                        <div class="flex items-center gap-2 text-2xl font-bold text-white font-heading">
                            <i class="fas fa-graduation-cap text-primary-500"></i>
                            <span>প্রযুক্তি<span class="text-primary-500">প্লাস</span></span>
                        </div>
                    @endif
                </a>
                
                <p class="text-sm text-slate-400 leading-relaxed mb-6 pr-4">
                    রিয়েল স্কিল ডেভেলপমেন্ট এবং ক্যারিয়ার গাইডলাইনের বিশ্বস্ত প্রতিষ্ঠান। মেন্টর <strong>মোঃ নাঈমুর রহমান</strong>-এর তত্ত্বাবধানে নিজেকে প্রস্তুত করুন গ্লোবাল মার্কেটের জন্য।
                </p>
                
                <div class="flex gap-3">
                    <a href="https://facebook.com/groups/topit24" target="_blank" class="w-9 h-9 rounded-lg bg-slate-800 flex items-center justify-center text-slate-400 hover:bg-[#1877F2] hover:text-white transition-all duration-300 ring-1 ring-white/5">
                        <i class="fab fa-facebook-f text-sm"></i>
                    </a>
                    <a href="#" class="w-9 h-9 rounded-lg bg-slate-800 flex items-center justify-center text-slate-400 hover:bg-[#FF0000] hover:text-white transition-all duration-300 ring-1 ring-white/5">
                        <i class="fab fa-youtube text-sm"></i>
                    </a>
                    <a href="#" class="w-9 h-9 rounded-lg bg-slate-800 flex items-center justify-center text-slate-400 hover:bg-[#0077B5] hover:text-white transition-all duration-300 ring-1 ring-white/5">
                        <i class="fab fa-linkedin-in text-sm"></i>
                    </a>
                </div>
            </div>

            <div>
                <h4 class="text-white font-bold mb-5 font-heading text-base">প্রয়োজনীয় লিঙ্ক</h4>
                <ul class="space-y-3 text-sm">
                    <li>
                        <a href="https://academy.projuktiplus.com/courses/full-stack-bootcamp-universal" class="hover:text-primary-400 transition-colors flex items-center gap-2 group">
                            <i class="fas fa-chevron-right text-[10px] opacity-30 group-hover:opacity-100 transition-opacity"></i> আপকামিং ব্যাচ
                        </a>
                    </li>
                    <li>
                        <a href="https://academy.projuktiplus.com/courses/web-design-html-css-masterclass" class="hover:text-primary-400 transition-colors flex items-center gap-2 group">
                            <i class="fas fa-chevron-right text-[10px] opacity-30 group-hover:opacity-100 transition-opacity"></i> ফ্রি কোর্স 
                        </a>
                    </li>
                </ul>
            </div>

            <div>
                <h4 class="text-white font-bold mb-5 font-heading text-base">পলিসি ও সাপোর্ট</h4>
                <ul class="space-y-3 text-sm">
                    <li>
                        <a href="{{ url('/privacy-policy') }}" class="hover:text-primary-400 transition-colors flex items-center gap-2 group">
                            <i class="fas fa-shield-alt text-xs opacity-50 w-4 group-hover:text-primary-400"></i> প্রাইভেসি পলিসি
                        </a>
                    </li>
                    <li>
                        <a href="{{ url('/terms-conditions') }}" class="hover:text-primary-400 transition-colors flex items-center gap-2 group">
                            <i class="fas fa-file-contract text-xs opacity-50 w-4 group-hover:text-primary-400"></i> টার্মস এন্ড কন্ডিশন
                        </a>
                    </li>
                    <li>
                        <a href="{{ url('/refund-policy') }}" class="hover:text-primary-400 transition-colors flex items-center gap-2 group">
                            <i class="fas fa-undo text-xs opacity-50 w-4 group-hover:text-primary-400"></i> রিফান্ড পলিসি
                        </a>
                    </li>
                    <li>
                        <a href="{{ url('/faq') }}" class="hover:text-primary-400 transition-colors flex items-center gap-2 group">
                            <i class="fas fa-question-circle text-xs opacity-50 w-4 group-hover:text-primary-400"></i> সচরাচর প্রশ্ন (FAQ)
                        </a>
                    </li>
                </ul>
            </div>

            <div>
                <h4 class="text-white font-bold mb-5 font-heading text-base">যোগাযোগ</h4>
                <ul class="space-y-4 text-sm">
                    <li class="flex items-start gap-3">
                        <div class="w-8 h-8 rounded bg-slate-800 flex items-center justify-center text-primary-500 shrink-0 ring-1 ring-white/5">
                            <i class="fas fa-map-marker-alt text-xs"></i>
                        </div>
                        <span class="text-slate-400 mt-1">খুলনা, বাংলাদেশ</span>
                    </li>
                    <li class="flex items-center gap-3">
                        <div class="w-8 h-8 rounded bg-slate-800 flex items-center justify-center text-primary-500 shrink-0 ring-1 ring-white/5">
                            <i class="fas fa-phone-alt text-xs"></i>
                        </div>
                        <a href="tel:01909605599" class="text-slate-400 hover:text-white font-mono transition-colors">01909605599</a>
                    </li>
                    <li class="flex items-center gap-3">
                        <div class="w-8 h-8 rounded bg-slate-800 flex items-center justify-center text-primary-500 shrink-0 ring-1 ring-white/5">
                            <i class="fas fa-envelope text-xs"></i>
                        </div>
                        <a href="mailto:support@topit24.com" class="text-slate-400 hover:text-white font-mono transition-colors">support@projuktiplus.com</a>
                    </li>
                </ul>
            </div>

        </div>

        <div class="border-t border-slate-800 pt-8 mt-4">
            <div class="flex flex-col md:flex-row justify-between items-center gap-4 text-center md:text-left">
                
                <p class="text-xs text-slate-500">
                    &copy; {{ date('Y') }} <span class="text-slate-300 font-bold">ProjuktiPlus Academy</span>. All rights reserved.
                </p>

                <div class="flex items-center gap-2">
                    <span class="text-xs text-slate-600">A Concern of</span>
                    <a href="https://topit24.com" target="_blank" class="text-xs font-bold text-slate-400 hover:text-primary-400 transition-colors flex items-center gap-1 bg-slate-800 px-2 py-1 rounded border border-slate-700">
                        projuktiplus.com
                    </a>
                </div>
            </div>
        </div>
    </div>
</footer>