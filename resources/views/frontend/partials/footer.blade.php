<footer class="bg-slate-900 text-slate-300 pt-16 pb-8 mt-auto border-t border-slate-800">
    <div class="container mx-auto px-4">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-12 mb-12">
            <!-- Brand Info -->
            <div>
                <div class="flex items-center mb-5">
                    @if(\App\Models\Setting::get('site_logo'))
                         <!-- সাদা লোগো বা ব্রাইটনেস ফিল্টার ব্যবহার করা যেতে পারে ডার্ক ফুটারের জন্য -->
                         <img src="{{ asset('storage/' . \App\Models\Setting::get('site_logo')) }}" alt="Logo" class="h-10 w-auto">
                    @else
                        <div class="w-10 h-10 bg-primary-600 rounded-lg flex items-center justify-center text-white mr-3">
                            <i class="fas fa-graduation-cap text-xl"></i>
                        </div>
                        <span class="text-2xl font-bold text-white font-heading">{{ \App\Models\Setting::get('site_name', 'ProjuktiPlus') }}</span>
                    @endif
                </div>
                <p class="text-slate-400 leading-relaxed mb-6 text-sm">
                    {{ \App\Models\Setting::get('footer_text', 'শূন্য থেকে প্রফেশনাল ওয়েব ডেভেলপমেন্ট শিখুন আমাদের বিশেষজ্ঞ গাইডলাইনে।') }}
                </p>
                <div class="flex space-x-4">
                    <a href="#" class="w-10 h-10 rounded-full bg-slate-800 flex items-center justify-center hover:bg-blue-600 hover:text-white transition-all duration-300"><i class="fab fa-facebook-f"></i></a>
                    <a href="#" class="w-10 h-10 rounded-full bg-slate-800 flex items-center justify-center hover:bg-red-600 hover:text-white transition-all duration-300"><i class="fab fa-youtube"></i></a>
                    <a href="#" class="w-10 h-10 rounded-full bg-slate-800 flex items-center justify-center hover:bg-blue-500 hover:text-white transition-all duration-300"><i class="fab fa-linkedin-in"></i></a>
                </div>
            </div>

            <!-- Quick Links -->
            <div>
                <h3 class="text-lg font-bold text-white mb-6 font-heading">কুইক লিংক</h3>
                <ul class="space-y-3 text-sm">
                    <li><a href="{{ url('/') }}" class="hover:text-primary-400 transition flex items-center gap-2"><i class="fas fa-angle-right text-xs"></i> হোম</a></li>
                    <li><a href="{{ url('/courses') }}" class="hover:text-primary-400 transition flex items-center gap-2"><i class="fas fa-angle-right text-xs"></i> কোর্সসমূহ</a></li>
                    <li><a href="{{ url('/instructors') }}" class="hover:text-primary-400 transition flex items-center gap-2"><i class="fas fa-angle-right text-xs"></i> ইনস্ট্রাক্টর</a></li>
                    <li><a href="{{ url('/about') }}" class="hover:text-primary-400 transition flex items-center gap-2"><i class="fas fa-angle-right text-xs"></i> আমাদের সম্পর্কে</a></li>
                    <li><a href="{{ url('/contact') }}" class="hover:text-primary-400 transition flex items-center gap-2"><i class="fas fa-angle-right text-xs"></i> যোগাযোগ</a></li>
                </ul>
            </div>

            <!-- Contact Info -->
            <div>
                <h3 class="text-lg font-bold text-white mb-6 font-heading">যোগাযোগ</h3>
                <ul class="space-y-4 text-sm">
                    <li class="flex items-start gap-3">
                        <i class="fas fa-map-marker-alt mt-1 text-primary-500"></i>
                        <span>{{ \App\Models\Setting::get('site_address', 'Dhaka, Bangladesh') }}</span>
                    </li>
                    <li class="flex items-center gap-3">
                        <i class="fas fa-envelope text-primary-500"></i>
                        <span>{{ \App\Models\Setting::get('site_email', 'info@example.com') }}</span>
                    </li>
                    <li class="flex items-center gap-3">
                        <i class="fas fa-phone-alt text-primary-500"></i>
                        <span>{{ \App\Models\Setting::get('site_phone', '+880 123456789') }}</span>
                    </li>
                </ul>
            </div>

            <!-- Newsletter -->
            <div>
                <h3 class="text-lg font-bold text-white mb-6 font-heading">নিউজলেটার</h3>
                <p class="text-sm text-slate-400 mb-4">নতুন কোর্স এবং অফার সম্পর্কে জানতে সাবস্ক্রাইব করুন।</p>
                <form class="relative">
                    <input type="email" placeholder="আপনার ইমেইল" class="w-full bg-slate-800 text-white border border-slate-700 rounded-lg py-3 pl-4 pr-12 focus:outline-none focus:border-primary-500 text-sm">
                    <button type="submit" class="absolute right-1 top-1 bottom-1 bg-primary-600 hover:bg-primary-700 text-white rounded-md px-3 transition">
                        <i class="fas fa-paper-plane"></i>
                    </button>
                </form>
            </div>
        </div>

        <div class="border-t border-slate-800 pt-8 flex flex-col md:flex-row justify-between items-center gap-4">
            <p class="text-sm text-slate-500 text-center md:text-left">
                &copy; {{ date('Y') }} <strong>{{ \App\Models\Setting::get('site_name', 'ProjuktiPlus') }}</strong> | সকল স্বত্ব সংরক্ষিত।
            </p>
            <div class="flex gap-6 text-sm text-slate-500">
                <a href="#" class="hover:text-white transition">গোপনীয়তা নীতি</a>
                <a href="#" class="hover:text-white transition">শর্তাবলী</a>
            </div>
        </div>
    </div>
</footer>