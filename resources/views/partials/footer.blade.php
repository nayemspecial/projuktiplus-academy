<footer class="border-t border-gray-200 dark:border-slate-700 bg-white dark:bg-slate-800 py-6 px-6 md:px-8 mt-auto">
    <div class="flex flex-col md:flex-row justify-between items-center gap-4">
        <!-- Copyright -->
        <div class="text-sm text-gray-500 dark:text-gray-400 text-center md:text-left">
            &copy; {{ date('Y') }} <span class="font-bold text-indigo-600 dark:text-indigo-400">{{ \App\Models\Setting::get('site_name', 'ProjuktiPlus LMS') }}</span>. সর্বস্বত্ব সংরক্ষিত।
        </div>

        <!-- Links & Credits -->
        <div class="flex flex-col md:flex-row items-center gap-2 md:gap-6 text-sm text-gray-500 dark:text-gray-400">
            <div class="flex gap-4">
                <a href="#" class="hover:text-indigo-600 dark:hover:text-indigo-400 transition">প্রাইভেসি পলিসি</a>
                <a href="#" class="hover:text-indigo-600 dark:hover:text-indigo-400 transition">শর্তাবলী</a>
                <a href="#" class="hover:text-indigo-600 dark:hover:text-indigo-400 transition">সহায়তা</a>
            </div>
            <div class="hidden md:block text-gray-300 dark:text-gray-600">|</div>
            <div class="flex items-center gap-1">
                তৈরি করেছেন <i class="fas fa-heart text-red-500 animate-pulse"></i> <span class="font-semibold">Md. Nayemur Rahman</span>
            </div>
        </div>
    </div>
</footer>