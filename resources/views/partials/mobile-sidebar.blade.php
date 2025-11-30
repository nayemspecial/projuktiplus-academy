<!-- Mobile sidebar -->
<div x-show="isMobileMenuOpen" @click.away="isMobileMenuOpen = false" class="xl:hidden fixed inset-0 z-40">
    <div class="fixed inset-0 bg-gray-600 bg-opacity-75" @click="isMobileMenuOpen = false"></div>
    <div class="relative flex flex-col w-72 max-w-xs h-full bg-white dark:bg-slate-800">
        <div class="flex items-center justify-between h-16 px-4 border-b border-gray-200 dark:border-slate-700">
            <img src="{{ asset('images/logo.png') }}" alt="Logo" class="h-10">
            <button @click="isMobileMenuOpen = false" class="text-gray-500 dark:text-gray-400 focus:outline-none">
                <i class="fas fa-times text-xl"></i>
            </button>
        </div>
        <div class="flex-1 overflow-y-auto py-4 px-2">
            <!-- Same sidebar content as main sidebar -->
            <!-- ... -->
        </div>
    </div>
</div>