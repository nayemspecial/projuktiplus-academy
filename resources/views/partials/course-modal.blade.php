<!-- Course Modal -->
<div x-show="isCourseModalOpen" class="fixed inset-0 overflow-y-auto z-50" x-cloak>
    <div class="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
        <div class="fixed inset-0 transition-opacity" @click="isCourseModalOpen = false">
            <div class="absolute inset-0 bg-gray-500 dark:bg-slate-900 opacity-75"></div>
        </div>
        <span class="hidden sm:inline-block sm:align-middle sm:h-screen">&#8203;</span>
        <div class="inline-block align-bottom bg-white dark:bg-slate-800 rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-2xl sm:w-full" role="dialog" aria-modal="true" aria-labelledby="modal-headline">
            <div class="px-6 py-4 border-b border-gray-200 dark:border-slate-700">
                <h3 class="text-lg font-medium text-gray-800 dark:text-white" id="modal-headline">
                    <span x-text="editingCourse ? 'কোর্স এডিট করুন' : 'নতুন কোর্স তৈরি করুন'"></span>
                </h3>
            </div>
            <div class="px-6 py-4">
                <div class="space-y-4">
                    <div>
                        <label for="course-name" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">কোর্স নাম</label>
                        <input type="text" id="course-name" x-model="currentCourse.name" class="w-full px-3 py-2 border border-gray-300 dark:border-slate-700 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 dark:bg-slate-800">
                    </div>
                    <div>
                        <label for="course-category" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">ক্যাটাগরি</label>
                        <select id="course-category" x-model="currentCourse.category" class="w-full px-3 py-2 border border-gray-300 dark:border-slate-700 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 dark:bg-slate-800">
                            <option value="web-development">ওয়েব ডেভেলপমেন্ট</option>
                            <option value="mobile-development">মোবাইল ডেভেলপমেন্ট</option>
                            <option value="data-science">ডাটা সায়েন্স</option>
                            <option value="design">ডিজাইন</option>
                            <option value="marketing">মার্কেটিং</option>
                        </select>
                    </div>
                    <div>
                        <label for="course-description" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">বর্ণনা</label>
                        <textarea id="course-description" x-model="currentCourse.description" rows="3" class="w-full px-3 py-2 border border-gray-300 dark:border-slate-700 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 dark:bg-slate-800"></textarea>
                    </div>
                    <div>
                        <label for="course-instructor" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">ইন্সট্রাক্টর</label>
                        <select id="course-instructor" x-model="currentCourse.instructor" class="w-full px-3 py-2 border border-gray-300 dark:border-slate-700 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 dark:bg-slate-800">
                            <template x-for="instructor in instructors" :key="instructor.id">
                                <option :value="instructor.id" x-text="instructor.name"></option>
                            </template>
                        </select>
                    </div>
                    <div>
                        <label for="course-price" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">মূল্য (৳)</label>
                        <input type="number" id="course-price" x-model="currentCourse.price" class="w-full px-3 py-2 border border-gray-300 dark:border-slate-700 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 dark:bg-slate-800">
                    </div>
                    <div>
                        <label for="course-status" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">স্ট্যাটাস</label>
                        <select id="course-status" x-model="currentCourse.status" class="w-full px-3 py-2 border border-gray-300 dark:border-slate-700 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 dark:bg-slate-800">
                            <option value="active">Active</option>
                            <option value="draft">Draft</option>
                            <option value="archived">Archived</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">কোর্স ইমেজ</label>
                        <div class="mt-1 flex items-center">
                            <span class="inline-block h-12 w-12 rounded-md overflow-hidden bg-gray-100 dark:bg-slate-700">
                                <template x-if="currentCourse.image">
                                    <img :src="currentCourse.image" alt="Course" class="h-full w-full object-cover">
                                </template>
                                <template x-if="!currentCourse.image">
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
                <button @click="isCourseModalOpen = false" type="button" class="inline-flex items-center px-4 py-2 border border-gray-300 dark:border-slate-700 rounded-md shadow-sm text-sm font-medium text-gray-700 dark:text-gray-300 bg-white dark:bg-slate-800 hover:bg-gray-50 dark:hover:bg-slate-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                    বাতিল
                </button>
                <button @click="saveCourse" type="button" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                    <span x-text="editingCourse ? 'আপডেট করুন' : 'সেভ করুন'"></span>
                </button>
            </div>
        </div>
    </div>
</div>