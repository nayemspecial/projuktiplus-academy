<!-- Delete Confirmation Modal -->
<div x-show="isDeleteModalOpen" class="fixed inset-0 overflow-y-auto z-50" x-cloak>
    <div class="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
        <div class="fixed inset-0 transition-opacity" @click="isDeleteModalOpen = false">
            <div class="absolute inset-0 bg-gray-500 dark:bg-slate-900 opacity-75"></div>
        </div>
        <span class="hidden sm:inline-block sm:align-middle sm:h-screen">&#8203;</span>
        <div class="inline-block align-bottom bg-white dark:bg-slate-800 rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full" role="dialog" aria-modal="true" aria-labelledby="modal-headline">
            <div class="px-6 py-4 border-b border-gray-200 dark:border-slate-700">
                <h3 class="text-lg font-medium text-gray-800 dark:text-white" id="modal-headline">
                    <span x-text="`আপনি কি নিশ্চিত ${deleteType === 'course' ? 'কোর্স' : 'শিক্ষার্থী'} ডিলিট করতে চান?`"></span>
                </h3>
            </div>
            <div class="px-6 py-4">
                <p class="text-gray-600 dark:text-gray-400">
                    <span x-text="`এই ${deleteType === 'course' ? 'কোর্স' : 'শিক্ষার্থী'} ডিলিট করলে এটি পুনরুদ্ধার করা যাবে না।`"></span>
                </p>
            </div>
            <div class="px-6 py-4 border-t border-gray-200 dark:border-slate-700 flex justify-end space-x-3">
                <button @click="isDeleteModalOpen = false" type="button" class="inline-flex items-center px-4 py-2 border border-gray-300 dark:border-slate-700 rounded-md shadow-sm text-sm font-medium text-gray-700 dark:text-gray-300 bg-white dark:bg-slate-800 hover:bg-gray-50 dark:hover:bg-slate-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                    বাতিল
                </button>
                <button @click="confirmDelete" type="button" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                    ডিলিট করুন
                </button>
            </div>
        </div>
    </div>
</div>