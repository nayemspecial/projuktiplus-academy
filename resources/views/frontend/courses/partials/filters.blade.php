<div class="bg-white dark:bg-slate-800/50 backdrop-blur-sm rounded-xl shadow-sm border border-slate-200 dark:border-slate-700 p-6">
    <h3 class="font-bold text-lg text-slate-900 dark:text-white mb-5 pb-3 border-b border-slate-100 dark:border-slate-700/50 flex items-center justify-between">
        <span>ফিল্টার</span>
        <i class="fas fa-sliders-h text-slate-400 text-sm"></i>
    </h3>

    <form action="{{ route('courses.index') }}" method="GET">
        @if(request('search'))
            <input type="hidden" name="search" value="{{ request('search') }}">
        @endif

        <!-- Category Filter -->
        <div class="mb-8">
            <h4 class="font-bold text-slate-800 dark:text-slate-200 mb-4 text-sm uppercase tracking-wide flex items-center gap-2">
                <span class="w-1 h-4 bg-blue-500 rounded-full"></span> ক্যাটাগরি
            </h4>
            <div class="space-y-3">
                <label class="flex items-center cursor-pointer group">
                    <div class="relative flex items-center">
                        <input type="radio" name="category" value="all" class="peer sr-only" 
                               {{ request('category') == 'all' || !request('category') ? 'checked' : '' }}
                               onchange="this.form.submit()">
                        <div class="w-4 h-4 border-2 border-slate-300 dark:border-slate-600 rounded-full peer-checked:border-blue-500 peer-checked:bg-blue-500 transition-all"></div>
                        <div class="absolute w-2 h-2 bg-white rounded-full left-1 top-1 opacity-0 peer-checked:opacity-100 transition-opacity"></div>
                    </div>
                    <span class="ml-3 text-sm text-slate-600 dark:text-slate-400 group-hover:text-blue-600 dark:group-hover:text-blue-400 transition font-medium">সব ক্যাটাগরি</span>
                </label>
                
                @foreach($categories as $cat)
                <label class="flex items-center cursor-pointer group">
                    <div class="relative flex items-center">
                        <input type="radio" name="category" value="{{ $cat }}" class="peer sr-only"
                               {{ request('category') == $cat ? 'checked' : '' }}
                               onchange="this.form.submit()">
                        <div class="w-4 h-4 border-2 border-slate-300 dark:border-slate-600 rounded-full peer-checked:border-blue-500 peer-checked:bg-blue-500 transition-all"></div>
                        <div class="absolute w-2 h-2 bg-white rounded-full left-1 top-1 opacity-0 peer-checked:opacity-100 transition-opacity"></div>
                    </div>
                    <span class="ml-3 text-sm text-slate-600 dark:text-slate-400 group-hover:text-blue-600 dark:group-hover:text-blue-400 transition font-medium">{{ ucfirst(str_replace('-', ' ', $cat)) }}</span>
                </label>
                @endforeach
            </div>
        </div>

        <!-- Level Filter -->
        <div class="mb-8">
            <h4 class="font-bold text-slate-800 dark:text-slate-200 mb-4 text-sm uppercase tracking-wide flex items-center gap-2">
                <span class="w-1 h-4 bg-purple-500 rounded-full"></span> লেভেল
            </h4>
            <div class="space-y-3">
                @foreach(['all' => 'সব লেভেল', 'beginner' => 'Beginner', 'intermediate' => 'Intermediate', 'advanced' => 'Advanced'] as $val => $label)
                <label class="flex items-center cursor-pointer group">
                    <div class="relative flex items-center">
                        <input type="radio" name="level" value="{{ $val }}" class="peer sr-only"
                               {{ request('level') == $val || ($val == 'all' && !request('level')) ? 'checked' : '' }}
                               onchange="this.form.submit()">
                        <div class="w-4 h-4 border-2 border-slate-300 dark:border-slate-600 rounded-full peer-checked:border-purple-500 peer-checked:bg-purple-500 transition-all"></div>
                        <div class="absolute w-2 h-2 bg-white rounded-full left-1 top-1 opacity-0 peer-checked:opacity-100 transition-opacity"></div>
                    </div>
                    <span class="ml-3 text-sm text-slate-600 dark:text-slate-400 group-hover:text-purple-600 dark:group-hover:text-purple-400 transition font-medium">{{ $label }}</span>
                </label>
                @endforeach
            </div>
        </div>

        <!-- Reset Button -->
        <a href="{{ route('courses.index') }}" class="flex items-center justify-center w-full py-2.5 border-2 border-slate-200 dark:border-slate-700 rounded-xl text-sm font-bold text-slate-600 dark:text-slate-300 hover:bg-slate-50 dark:hover:bg-slate-800 hover:border-slate-300 dark:hover:border-slate-600 transition-all group">
            <i class="fas fa-undo-alt mr-2 text-slate-400 group-hover:rotate-180 transition-transform duration-500"></i> ফিল্টার রিসেট
        </a>
    </form>
</div>