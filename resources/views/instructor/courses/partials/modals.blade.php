<!-- "নতুন সেকশন" Modal -->
<div x-show="showCreateSectionModal" @keydown.escape.window="showCreateSectionModal = false" class="fixed inset-0 z-50 overflow-y-auto" style="display: none;">
    <div class="flex items-center justify-center min-h-screen px-4">
        <div x-show="showCreateSectionModal" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" class="fixed inset-0 bg-gray-500 dark:bg-gray-900 bg-opacity-75 dark:bg-opacity-75 transition-opacity" @click="showCreateSectionModal = false"></div>
        <div x-show="showCreateSectionModal" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100" x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-95" 
             class="relative bg-white dark:bg-slate-800 rounded-lg shadow-xl overflow-hidden transform transition-all sm:my-8 sm:max-w-lg sm:w-full">
            <form action="{{ route('instructor.courses.sections.store', $course->id) }}" method="POST">
                @csrf
                <div class="px-4 pt-5 pb-4 sm:p-6">
                    <h3 class="text-lg font-medium leading-6 text-gray-900 dark:text-white mb-4">নতুন সেকশন তৈরি করুন</h3>
                    <div>
                        <label for="title" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">সেকশনের নাম</label>
                        <input type="text" name="title" id="title" required 
                               class="mt-1 block w-full px-4 py-2 border border-gray-300 dark:border-slate-700 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 dark:bg-slate-900">
                    </div>
                </div>
                <div class="bg-gray-50 dark:bg-slate-700/50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                    <button type="submit" class="inline-flex justify-center w-full rounded-md border border-transparent shadow-sm px-4 py-2 bg-blue-600 text-base font-medium text-white hover:bg-blue-700 sm:ml-3 sm:w-auto sm:text-sm">সেভ করুন</button>
                    <button type="button" @click="showCreateSectionModal = false" class="mt-3 inline-flex justify-center w-full rounded-md border border-gray-300 dark:border-slate-600 shadow-sm px-4 py-2 bg-white dark:bg-slate-800 text-base font-medium text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-slate-700 sm:mt-0 sm:w-auto sm:text-sm"> বাতিল করুন</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- "এডিট সেকশন" Modal -->
<div x-show="showEditSectionModal" @keydown.escape.window="showEditSectionModal = false" class="fixed inset-0 z-50 overflow-y-auto" style="display: none;">
    <div class="flex items-center justify-center min-h-screen px-4">
        <div x-show="showEditSectionModal" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" class="fixed inset-0 bg-gray-500 dark:bg-gray-900 bg-opacity-75 dark:bg-opacity-75 transition-opacity" @click="showEditSectionModal = false"></div>
        <div x-show="showEditSectionModal" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100" x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-95" 
             class="relative bg-white dark:bg-slate-800 rounded-lg shadow-xl overflow-hidden transform transition-all sm:my-8 sm:max-w-lg sm:w-full">
            <form :action="editSectionAction" method="POST">
                @csrf
                @method('PUT')
                <div class="px-4 pt-5 pb-4 sm:p-6">
                    <h3 class="text-lg font-medium leading-6 text-gray-900 dark:text-white mb-4">সেকশন এডিট করুন</h3>
                    <div>
                        <label for="edit_section_title" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">সেকশনের নাম</label>
                        <input type="text" name="title" id="edit_section_title" required 
                               x-model="editSectionTitle"
                               class="mt-1 block w-full px-4 py-2 border border-gray-300 dark:border-slate-700 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 dark:bg-slate-900">
                    </div>
                </div>
                <div class="bg-gray-50 dark:bg-slate-700/50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                    <button type="submit" class="inline-flex justify-center w-full rounded-md border border-transparent shadow-sm px-4 py-2 bg-blue-600 text-base font-medium text-white hover:bg-blue-700 sm:ml-3 sm:w-auto sm:text-sm">আপডেট করুন</button>
                    <button type="button" @click="showEditSectionModal = false" class="mt-3 inline-flex justify-center w-full rounded-md border border-gray-300 dark:border-slate-600 shadow-sm px-4 py-2 bg-white dark:bg-slate-800 text-base font-medium text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-slate-700 sm:mt-0 sm:w-auto sm:text-sm">বাতিল করুন</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- "নতুন লেসন" Modal -->
<div x-show="showCreateLessonModal" @keydown.escape.window="showCreateLessonModal = false" class="fixed inset-0 z-50 overflow-y-auto" style="display: none;">
    <div class="flex items-center justify-center min-h-screen px-4">
        <div x-show="showCreateLessonModal" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" class="fixed inset-0 bg-gray-500 dark:bg-gray-900 bg-opacity-75 dark:bg-opacity-75 transition-opacity" @click="showCreateLessonModal = false"></div>
        <div x-show="showCreateLessonModal" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100" x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-95" 
             class="relative bg-white dark:bg-slate-800 rounded-lg shadow-xl overflow-hidden transform transition-all sm:my-8 sm:max-w-lg sm:w-full">
            <form :action="createLessonAction" method="POST">
                @csrf
                <div class="px-4 pt-5 pb-4 sm:p-6">
                    <h3 class="text-lg font-medium leading-6 text-gray-900 dark:text-white mb-1">নতুন লেসন যোগ করুন</h3>
                    <p class="text-sm text-gray-500 dark:text-gray-400 mb-4">সেকশন: <span x-text="createLessonTitle"></span></p>
                    
                    <div class="space-y-4">
                        <div>
                            <label for="lesson_title" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">লেসনের নাম</label>
                            <input type="text" name="title" id="lesson_title" required 
                                   class="mt-1 block w-full px-4 py-2 border border-gray-300 dark:border-slate-700 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 dark:bg-slate-900">
                        </div>
                        <div>
                            <label for="lesson_video_url" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">ভিডিও URL (YouTube/Vimeo)</label>
                            <input type="url" name="video_url" id="lesson_video_url" 
                                   class="mt-1 block w-full px-4 py-2 border border-gray-300 dark:border-slate-700 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 dark:bg-slate-900">
                        </div>
                        <div>
                            <label for="lesson_content" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">লেসন কন্টেন্ট (ঐচ্ছিক)</label>
                            <textarea name="content" id="lesson_content" rows="4"
                                      class="mt-1 block w-full px-4 py-2 border border-gray-300 dark:border-slate-700 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 dark:bg-slate-900"></textarea>
                        </div>
                    </div>
                </div>
                <div class="bg-gray-50 dark:bg-slate-700/50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                    <button type="submit" class="inline-flex justify-center w-full rounded-md border border-transparent shadow-sm px-4 py-2 bg-blue-600 text-base font-medium text-white hover:bg-blue-700 sm:ml-3 sm:w-auto sm:text-sm">লেসন সেভ করুন</button>
                    <button type="button" @click="showCreateLessonModal = false" class="mt-3 inline-flex justify-center w-full rounded-md border border-gray-300 dark:border-slate-600 shadow-sm px-4 py-2 bg-white dark:bg-slate-800 text-base font-medium text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-slate-700 sm:mt-0 sm:w-auto sm:text-sm">বাতিল করুন</button>
                </div>
            </form>
        </div>
    </div>
</div>
    
<!-- "এডিট লেসন" Modal -->
<div x-show="showEditLessonModal" @keydown.escape.window="showEditLessonModal = false" class="fixed inset-0 z-50 overflow-y-auto" style="display: none;">
    <div class="flex items-center justify-center min-h-screen px-4">
        <div x-show="showEditLessonModal" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" class="fixed inset-0 bg-gray-500 dark:bg-gray-900 bg-opacity-75 dark:bg-opacity-75 transition-opacity" @click="showEditLessonModal = false"></div>
        <div x-show="showEditLessonModal" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100" x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-95" 
             class="relative bg-white dark:bg-slate-800 rounded-lg shadow-xl overflow-hidden transform transition-all sm:my-8 sm:max-w-lg sm:w-full">
            <form :action="editLessonAction" method="POST">
                @csrf
                @method('PUT')
                <div class="px-4 pt-5 pb-4 sm:p-6">
                    <h3 class="text-lg font-medium leading-6 text-gray-900 dark:text-white mb-4">লেসন এডিট করুন</h3>
                    
                    <div class="space-y-4">
                        <div>
                            <label for="edit_lesson_title" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">লেসনের নাম</label>
                            <input type="text" name="title" id="edit_lesson_title" required x-model="editLessonTitle"
                                   class="mt-1 block w-full px-4 py-2 border border-gray-300 dark:border-slate-700 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 dark:bg-slate-900">
                        </div>
                        <div>
                            <label for="edit_lesson_video_url" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">ভিডিও URL</label>
                            <input type="url" name="video_url" id="edit_lesson_video_url" x-model="editLessonVideoUrl"
                                   class="mt-1 block w-full px-4 py-2 border border-gray-300 dark:border-slate-700 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 dark:bg-slate-900">
                        </div>
                        <div>
                            <label for="edit_lesson_content" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">লেসন কন্টেন্ট (ঐচ্ছিক)</label>
                            <textarea name="content" id="edit_lesson_content" rows="4" x-model="editLessonContent"
                                      class="mt-1 block w-full px-4 py-2 border border-gray-300 dark:border-slate-700 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 dark:bg-slate-900"></textarea>
                        </div>
                    </div>
                </div>
                <div class="bg-gray-50 dark:bg-slate-700/50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                    <button type="submit" class="inline-flex justify-center w-full rounded-md border border-transparent shadow-sm px-4 py-2 bg-blue-600 text-base font-medium text-white hover:bg-blue-700 sm:ml-3 sm:w-auto sm:text-sm">লেসন আপডেট করুন</button>
                    <button type="button" @click="showEditLessonModal = false" class="mt-3 inline-flex justify-center w-full rounded-md border border-gray-300 dark:border-slate-600 shadow-sm px-4 py-2 bg-white dark:bg-slate-800 text-base font-medium text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-slate-700 sm:mt-0 sm:w-auto sm:text-sm">বাতিল করুন</button>
                </div>
            </form>
        </div>
    </div>
</div>