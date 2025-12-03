<div class="bg-white dark:bg-slate-800 rounded-xl shadow-sm border border-gray-100 dark:border-slate-700 p-6">
    <h3 class="font-bold text-lg text-gray-800 dark:text-white mb-4 border-b border-gray-100 dark:border-slate-700 pb-2">ফিল্টার</h3>

    <form action="{{ route('courses.index') }}" method="GET">
        <!-- সার্চ কুয়েরি ধরে রাখার জন্য -->
        @if(request('search'))
            <input type="hidden" name="search" value="{{ request('search') }}">
        @endif

        <!-- ক্যাটাগরি ফিল্টার -->
        <div class="mb-6">
            <h4 class="font-medium text-gray-700 dark:text-gray-300 mb-3 text-sm uppercase tracking-wide">ক্যাটাগরি</h4>
            <div class="space-y-2">
                <label class="flex items-center cursor-pointer group">
                    <input type="radio" name="category" value="all" class="w-4 h-4 text-blue-600 border-gray-300 focus:ring-blue-500 dark:bg-slate-700 dark:border-slate-600" 
                           {{ request('category') == 'all' || !request('category') ? 'checked' : '' }}
                           onchange="this.form.submit()">
                    <span class="ml-2 text-sm text-gray-600 dark:text-gray-400 group-hover:text-blue-600 dark:group-hover:text-blue-400 transition">সব ক্যাটাগরি</span>
                </label>
                
                @foreach($categories as $cat)
                <label class="flex items-center cursor-pointer group">
                    <input type="radio" name="category" value="{{ $cat }}" class="w-4 h-4 text-blue-600 border-gray-300 focus:ring-blue-500 dark:bg-slate-700 dark:border-slate-600"
                           {{ request('category') == $cat ? 'checked' : '' }}
                           onchange="this.form.submit()">
                    <span class="ml-2 text-sm text-gray-600 dark:text-gray-400 group-hover:text-blue-600 dark:group-hover:text-blue-400 transition">{{ ucfirst(str_replace('-', ' ', $cat)) }}</span>
                </label>
                @endforeach
            </div>
        </div>

        <!-- লেভেল ফিল্টার -->
        <div class="mb-6">
            <h4 class="font-medium text-gray-700 dark:text-gray-300 mb-3 text-sm uppercase tracking-wide">লেভেল</h4>
            <div class="space-y-2">
                <label class="flex items-center cursor-pointer group">
                    <input type="radio" name="level" value="all" class="w-4 h-4 text-blue-600 border-gray-300 focus:ring-blue-500 dark:bg-slate-700 dark:border-slate-600"
                           {{ request('level') == 'all' || !request('level') ? 'checked' : '' }}
                           onchange="this.form.submit()">
                    <span class="ml-2 text-sm text-gray-600 dark:text-gray-400 group-hover:text-blue-600 dark:group-hover:text-blue-400 transition">সব লেভেল</span>
                </label>

                <label class="flex items-center cursor-pointer group">
                    <input type="radio" name="level" value="beginner" class="w-4 h-4 text-blue-600 border-gray-300 focus:ring-blue-500 dark:bg-slate-700 dark:border-slate-600"
                           {{ request('level') == 'beginner' ? 'checked' : '' }}
                           onchange="this.form.submit()">
                    <span class="ml-2 text-sm text-gray-600 dark:text-gray-400 group-hover:text-blue-600 dark:group-hover:text-blue-400 transition">Beginner</span>
                </label>

                <label class="flex items-center cursor-pointer group">
                    <input type="radio" name="level" value="intermediate" class="w-4 h-4 text-blue-600 border-gray-300 focus:ring-blue-500 dark:bg-slate-700 dark:border-slate-600"
                           {{ request('level') == 'intermediate' ? 'checked' : '' }}
                           onchange="this.form.submit()">
                    <span class="ml-2 text-sm text-gray-600 dark:text-gray-400 group-hover:text-blue-600 dark:group-hover:text-blue-400 transition">Intermediate</span>
                </label>

                <label class="flex items-center cursor-pointer group">
                    <input type="radio" name="level" value="advanced" class="w-4 h-4 text-blue-600 border-gray-300 focus:ring-blue-500 dark:bg-slate-700 dark:border-slate-600"
                           {{ request('level') == 'advanced' ? 'checked' : '' }}
                           onchange="this.form.submit()">
                    <span class="ml-2 text-sm text-gray-600 dark:text-gray-400 group-hover:text-blue-600 dark:group-hover:text-blue-400 transition">Advanced</span>
                </label>
            </div>
        </div>

        <!-- রিসেট বাটন -->
        <a href="{{ route('courses.index') }}" class="block w-full text-center py-2 border border-gray-300 dark:border-slate-600 rounded-lg text-sm text-gray-600 dark:text-gray-400 hover:bg-gray-50 dark:hover:bg-slate-700 transition">
            ফিল্টার রিসেট করুন
        </a>
    </form>
</div>