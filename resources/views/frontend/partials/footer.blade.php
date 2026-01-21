<footer class="bg-slate-900 text-slate-300 border-t border-slate-800 relative overflow-hidden font-body print:hidden">
    
    <div class="absolute top-0 left-0 w-full h-0.5 bg-gradient-to-r from-transparent via-primary-600 to-transparent opacity-70"></div>

    <div class="container mx-auto px-4 pt-12 pb-8 lg:pt-16">
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8 lg:gap-10 mb-12 text-center md:text-left">
            
            <div class="col-span-1 md:col-span-2 lg:col-span-1 flex flex-col items-center md:items-start">
                <a href="{{ url('/') }}" class="inline-block mb-4 group">
                    @if(\App\Models\Setting::get('site_logo'))
                        <div class="flex flex-col items-center md:items-start">
                            <img src="{{ asset('storage/' . \App\Models\Setting::get('site_logo')) }}" alt="ProjuktiPlus Academy" class="h-12 w-auto mb-2 transition-transform group-hover:scale-105">
                            
                            <div class="text-center md:text-left">
                                <h1 class="text-xl md:text-2xl font-bold text-white font-heading tracking-tight leading-none mb-1">
                                    {{ \App\Models\Setting::get('site_name', 'ProjuktiPlus Academy') }}
                                </h1>
                                <span class="text-[10px] md:text-[11px] text-slate-400 font-medium tracking-wide block opacity-80">
                                    যেখানে প্রযুক্তির গল্প হয় সহজ ভাষায়
                                </span>
                            </div>
                        </div>
                    @else
                        <div class="flex flex-col items-center md:items-start">
                            <div class="flex items-center gap-2 text-2xl font-bold text-white font-heading">
                                <i class="fas fa-graduation-cap text-primary-500"></i>
                                <span>প্রযুক্তি<span class="text-primary-500">প্লাস</span></span>
                            </div>
                            <span class="text-[10px] md:text-[11px] text-slate-400 font-medium tracking-wide block mt-1 opacity-80">
                                যেখানে প্রযুক্তির গল্প হয় সহজ ভাষায়
                            </span>
                        </div>
                    @endif
                </a>
                
                <p class="text-sm text-slate-400 leading-relaxed mb-6 max-w-sm mx-auto md:mx-0 md:pr-4">
                    রিয়েল স্কিল ডেভেলপমেন্ট এবং ক্যারিয়ার গাইডলাইনের বিশ্বস্ত প্রতিষ্ঠান। মেন্টর <strong>মোঃ নাঈমুর রহমান</strong>-এর তত্ত্বাবধানে নিজেকে প্রস্তুত করুন গ্লোবাল মার্কেটের জন্য।
                </p>
                
                <div class="flex gap-3 justify-center md:justify-start">
                    <a href="https://facebook.com/groups/topit24" target="_blank" class="w-9 h-9 rounded-lg bg-slate-800 flex items-center justify-center text-slate-400 hover:bg-[#1877F2] hover:text-white transition-all duration-300 ring-1 ring-white/5 hover:scale-110">
                        <i class="fab fa-facebook-f text-sm"></i>
                    </a>
                    <a href="#" class="w-9 h-9 rounded-lg bg-slate-800 flex items-center justify-center text-slate-400 hover:bg-[#FF0000] hover:text-white transition-all duration-300 ring-1 ring-white/5 hover:scale-110">
                        <i class="fab fa-youtube text-sm"></i>
                    </a>
                    <a href="#" class="w-9 h-9 rounded-lg bg-slate-800 flex items-center justify-center text-slate-400 hover:bg-[#0077B5] hover:text-white transition-all duration-300 ring-1 ring-white/5 hover:scale-110">
                        <i class="fab fa-linkedin-in text-sm"></i>
                    </a>
                </div>
            </div>

            <div class="pl-4 md:pl-0 text-left md:text-left border-slate-800 md:border-0 ml-4 md:ml-0">
                <h4 class="text-white font-bold mb-5 font-heading text-base relative inline-block">
                    প্রয়োজনীয় লিঙ্ক
                    <span class="absolute -bottom-1 left-0 w-1/2 h-0.5 bg-primary-600 rounded-full md:hidden"></span>
                </h4>
                <ul class="space-y-3 text-sm">
                    <li>
                        <a href="https://academy.projuktiplus.com/courses/full-stack-bootcamp-universal" class="hover:text-primary-400 transition-colors flex items-center gap-2 group">
                            <i class="fas fa-chevron-right text-[10px] text-slate-600 group-hover:text-primary-500 transition-colors"></i> আপকামিং ব্যাচ
                        </a>
                    </li>
                    <li>
                        <a href="https://academy.projuktiplus.com/courses/web-design-html-css-masterclass" class="hover:text-primary-400 transition-colors flex items-center gap-2 group">
                            <i class="fas fa-chevron-right text-[10px] text-slate-600 group-hover:text-primary-500 transition-colors"></i> ফ্রি কোর্স 
                        </a>
                    </li>
                </ul>
            </div>

            <div class="pl-4 md:pl-0 text-left md:text-left border-slate-800 md:border-0 ml-4 md:ml-0">
                <h4 class="text-white font-bold mb-5 font-heading text-base relative inline-block">
                    পলিসি ও সাপোর্ট
                    <span class="absolute -bottom-1 left-0 w-1/2 h-0.5 bg-primary-600 rounded-full md:hidden"></span>
                </h4>
                <ul class="space-y-3 text-sm">
                    <li>
                        <a href="{{ url('/privacy-policy') }}" class="hover:text-primary-400 transition-colors flex items-center gap-2 group">
                            <i class="fas fa-shield-alt text-xs text-slate-500 w-4 group-hover:text-primary-400"></i> প্রাইভেসি পলিসি
                        </a>
                    </li>
                    <li>
                        <a href="{{ url('/terms-conditions') }}" class="hover:text-primary-400 transition-colors flex items-center gap-2 group">
                            <i class="fas fa-file-contract text-xs text-slate-500 w-4 group-hover:text-primary-400"></i> টার্মস এন্ড কন্ডিশন
                        </a>
                    </li>
                    <li>
                        <a href="{{ url('/refund-policy') }}" class="hover:text-primary-400 transition-colors flex items-center gap-2 group">
                            <i class="fas fa-undo text-xs text-slate-500 w-4 group-hover:text-primary-400"></i> রিফান্ড পলিসি
                        </a>
                    </li>
                </ul>
            </div>

            <div class="pl-4 md:pl-0 text-left md:text-left border-slate-800 md:border-0 ml-4 md:ml-0">
                <h4 class="text-white font-bold mb-5 font-heading text-base relative inline-block">
                    যোগাযোগ
                    <span class="absolute -bottom-1 left-0 w-1/2 h-0.5 bg-primary-600 rounded-full md:hidden"></span>
                </h4>
                <ul class="space-y-4 text-sm">
                    <li class="flex items-start gap-3 group">
                        <div class="w-8 h-8 rounded bg-slate-800 flex items-center justify-center text-primary-500 shrink-0 ring-1 ring-white/5 group-hover:ring-primary-500/30 transition-all">
                            <i class="fas fa-map-marker-alt text-xs"></i>
                        </div>
                        <span class="text-slate-400 mt-1 group-hover:text-white transition-colors"> খুলনা, বাংলাদেশ</span>
                    </li>
                    <li class="flex items-center gap-3 group">
                        <div class="w-8 h-8 rounded bg-slate-800 flex items-center justify-center text-primary-500 shrink-0 ring-1 ring-white/5 group-hover:ring-primary-500/30 transition-all">
                            <i class="fas fa-phone-alt text-xs"></i>
                        </div>
                        <a href="tel:01909605599" class="text-slate-400 hover:text-white font-mono transition-colors group-hover:text-primary-400">+8801909605599</a>
                    </li>
                    <li class="flex items-center gap-3 group">
                        <div class="w-8 h-8 rounded bg-slate-800 flex items-center justify-center text-primary-500 shrink-0 ring-1 ring-white/5 group-hover:ring-primary-500/30 transition-all">
                            <i class="fas fa-envelope text-xs"></i>
                        </div>
                        <a href="mailto:academy@projuktiplus.com" class="text-slate-400 hover:text-white font-mono transition-colors group-hover:text-primary-400">academy@projuktiplus.com</a>
                    </li>
                </ul>
            </div>

        </div>

        <div class="border-t border-slate-800 pt-8 mt-4">
            <div class="flex flex-col md:flex-row justify-between items-center gap-4 text-center md:text-left">
                
                <p class="text-xs text-slate-500">
                    &copy; {{ date('Y') }} <span class="text-slate-300 font-bold hover:text-primary-400 transition-colors">ProjuktiPlus Academy</span>. All rights reserved.
                </p>

                <div class="flex items-center gap-2">
                    <span class="text-[10px] uppercase tracking-wider text-slate-600 font-semibold">A Concern of</span>
                    <a href="https://projuktiplus.com" target="_blank" class="text-xs font-bold text-slate-400 hover:text-primary-400 transition-colors flex items-center gap-1 bg-slate-800 px-3 py-1.5 rounded-full border border-slate-700 hover:border-primary-500/30 group">
                        <i class="fas fa-globe text-[10px] text-slate-500 group-hover:text-primary-500 transition-colors"></i> projuktiplus.com
                    </a>
                </div>
            </div>
        </div>
    </div>
</footer>