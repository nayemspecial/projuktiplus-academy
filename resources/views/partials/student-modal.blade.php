<!-- Student Modal -->
<div x-show="isStudentModalOpen" class="fixed inset-0 overflow-y-auto z-50" x-cloak>
    <div class="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
        <div class="fixed inset-0 transition-opacity" @click="isStudentModalOpen = false">
            <div class="absolute inset-0 bg-gray-500 dark:bg-slate-900 opacity-75"></div>
        </div>
        <span class="hidden sm:inline-block sm:align-middle sm:h-screen">&#8203;</span>
        <div class="inline-block align-bottom bg-white dark:bg-slate-800 rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-2xl sm:w-full" role="dialog" aria-modal="true" aria-labelledby="modal-headline">
            <div class="px-6 py-4 border-b border-gray-200 dark:border-slate-700">
                <h3 class="text-lg font-medium text-gray-800 dark:text-white" id="modal-headline">
                    <span x-text="editingStudent ? 'শিক্ষার্থী এডিট করুন' : 'নতুন শিক্ষার্থী যোগ করুন'"></span>
                </h3>
            </div>
            <div class="px-6 py-4">
                <div class="space-y-4">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label for="student-name" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">পূর্ণ নাম</label>
                            <input type="text" id="student-name" x-model="currentStudent.name" class="w-full px-3 py-2 border border-gray-300 dark:border-slate-700 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 dark:bg-slate-800">
                        </div>
                        <div>
                            <label for="student-email" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">ইমেইল</label>
                            <input type="email" id="student-email" x-model="currentStudent.email" class="w-full px-3 py-2 border border-gray-300 dark:border-slate-700 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 dark:bg-slate-800">
                        </div>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label for="student-phone" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">ফোন নম্বর</label>
                            <input type="tel" id="student-phone" x-model="currentStudent.phone" class="w-full px-3 py-2 border border-gray-300 dark:border-slate-700 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 dark:bg-slate-800">
                        </div>
                        <div>
                            <label for="student-status" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">স্ট্যাটাস</label>
                            <select id="student-status" x-model="currentStudent.status" class="w-full px-3 py-2 border border-gray-300 dark:border-slate-700 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 dark:bg-slate-800">
                                <option value="active">Active</option>
                                <option value="inactive">Inactive</option>
                                <option value="banned">Banned</option>
                            </select>
                        </div>
                    </div>
                    <div>
                        <label for="student-address" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">ঠিকানা</label>
                        <textarea id="student-address" x-model="currentStudent.address" rows="2" class="w-full px-3 py-2 border border-gray-300 dark:border-slate-700 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 dark:bg-slate-800"></textarea>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">প্রোফাইল ছবি</label>
                        <div class="mt-1 flex items-center">
                            <span class="inline-block h-12 w-12 rounded-full overflow-hidden bg-gray-100 dark:bg-slate-700">
                                <template x-if="currentStudent.image">
                                    <img :src="currentStudent.image" alt="Student" class="h-full w-full object-cover">
                                </template>
                                <template x-if="!currentStudent.image">
                                    <svg class="h-full w-full text-gray-300 dark:text-slate-500" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M24 20.993V24H0v-2.996A14.977 14.977 0 0112.004 15c4.904 0 9.26 2.354 11.996 5.993zM16.002 8.999a4 4 0 11-8 0 4 4 0 018 0z" />
                                    </svg>
                                </template>
                            </span>
                            <button type="button" class="ml-5 bg-white dark:bg-slate-800 py-2 px-3 border border-gray-300 dark:border-slate-700 rounded-md shadow-sm text-sm leading-4 font-medium text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-slate-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                পরিবর্তন
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="px-6 py-4 border-t border-gray-200 dark:border-slate-700 flex justify-end space-x-3">
                <button @click="isStudentModalOpen = false" type="button" class="inline-flex items-center px-4 py-2 border border-gray-300 dark:border-slate-700 rounded-md shadow-sm text-sm font-medium text-gray-700 dark:text-gray-300 bg-white dark:bg-slate-800 hover:bg-gray-50 dark:hover:bg-slate-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                    বাতিল
                </button>
                <button @click="saveStudent" type="button" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                    <span x-text="editingStudent ? 'আপডেট করুন' : 'সেভ করুন'"></span>
                </button>
            </div>
        </div>
    </div>
</div>