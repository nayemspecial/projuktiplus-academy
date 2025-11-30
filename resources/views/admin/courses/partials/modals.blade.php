<!-- Section Modal -->
<div x-show="isSectionModalOpen" class="fixed inset-0 z-50 overflow-y-auto" style="display: none;">
    <div class="flex items-center justify-center min-h-screen px-4">
        <div class="fixed inset-0 bg-gray-900/50 backdrop-blur-sm transition-opacity" @click="isSectionModalOpen = false"></div>
        <div class="relative bg-white dark:bg-slate-800 rounded-lg w-full max-w-md p-6 shadow-xl transform transition-all">
            <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-4" x-text="sectionMode === 'create' ? 'নতুন সেকশন তৈরি করুন' : 'সেকশন এডিট করুন'"></h3>
            <form :action="sectionAction" method="POST">
                @csrf
                <input type="hidden" name="_method" :value="sectionMode === 'edit' ? 'PUT' : 'POST'">
                <input type="hidden" name="course_id" value="{{ $course->id }}">

                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">শিরোনাম</label>
                    <input type="text" name="title" x-model="sectionForm.title" required class="w-full px-3 py-2 border border-gray-300 dark:border-slate-600 rounded-lg focus:ring-2 focus:ring-blue-500 dark:bg-slate-900 dark:text-white sm:text-sm">
                </div>
                <div class="flex items-center mb-4">
                    <input id="sec_is_published" name="is_published" type="checkbox" value="1" x-model="sectionForm.is_published" class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                    <label for="sec_is_published" class="ml-2 block text-sm text-gray-900 dark:text-gray-300">পাবলিশড?</label>
                </div>
                <div class="flex justify-end gap-3">
                    <button type="button" @click="isSectionModalOpen = false" class="px-4 py-2 text-gray-700 bg-gray-100 rounded-lg hover:bg-gray-200 dark:bg-slate-700 dark:text-gray-300 transition">বাতিল</button>
                    <button type="submit" class="px-4 py-2 text-white bg-blue-600 rounded-lg hover:bg-blue-700 transition">সেভ করুন</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Lesson Modal -->
<div x-show="isLessonModalOpen" class="fixed inset-0 z-50 overflow-y-auto" style="display: none;">
    <div class="flex items-center justify-center min-h-screen px-4">
        <div class="fixed inset-0 bg-gray-900/50 backdrop-blur-sm transition-opacity" @click="isLessonModalOpen = false"></div>
        <div class="relative bg-white dark:bg-slate-800 rounded-lg w-full max-w-lg p-6 shadow-xl transform transition-all">
            <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-4" x-text="lessonMode === 'create' ? 'নতুন লেসন তৈরি করুন' : 'লেসন এডিট করুন'"></h3>
            <form :action="lessonAction" method="POST">
                @csrf
                <input type="hidden" name="_method" :value="lessonMode === 'edit' ? 'PUT' : 'POST'">
                <input type="hidden" name="course_id" value="{{ $course->id }}">
                <input type="hidden" name="section_id" x-model="lessonForm.section_id">
                
                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">লেসনের নাম</label>
                        <input type="text" name="title" x-model="lessonForm.title" required class="block w-full px-3 py-2 border border-gray-300 dark:border-slate-600 rounded-lg focus:ring-2 focus:ring-blue-500 dark:bg-slate-900 dark:text-white sm:text-sm">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">ভিডিও URL</label>
                        <input type="url" name="video_url" x-model="lessonForm.video_url" class="block w-full px-3 py-2 border border-gray-300 dark:border-slate-600 rounded-lg focus:ring-2 focus:ring-blue-500 dark:bg-slate-900 dark:text-white sm:text-sm" placeholder="https://youtube.com/...">
                    </div>
                    <div class="flex gap-4">
                        <div class="flex-1">
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">সময়কাল</label>
                            <input type="text" name="duration" x-model="lessonForm.duration" class="block w-full px-3 py-2 border border-gray-300 dark:border-slate-600 rounded-lg focus:ring-2 focus:ring-blue-500 dark:bg-slate-900 dark:text-white sm:text-sm" placeholder="10:30">
                        </div>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">বিবরণ / কন্টেন্ট</label>
                        <textarea name="content" x-model="lessonForm.content" rows="3" class="block w-full px-3 py-2 border border-gray-300 dark:border-slate-600 rounded-lg focus:ring-2 focus:ring-blue-500 dark:bg-slate-900 dark:text-white sm:text-sm"></textarea>
                    </div>
                    <div class="flex items-center gap-6 pt-2">
                        <label class="inline-flex items-center cursor-pointer">
                            <input type="checkbox" name="is_free" value="1" x-model="lessonForm.is_free" class="form-checkbox h-4 w-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500">
                            <span class="ms-2 text-sm text-gray-700 dark:text-gray-300 font-medium">ফ্রি প্রিভিউ?</span>
                        </label>
                        
                        <label class="inline-flex items-center cursor-pointer">
                            <input type="checkbox" name="is_published" value="1" x-model="lessonForm.is_published" class="form-checkbox h-4 w-4 text-green-600 border-gray-300 rounded focus:ring-green-500">
                            <span class="ms-2 text-sm text-gray-700 dark:text-gray-300 font-medium">পাবলিশড?</span>
                        </label>
                    </div>
                </div>

                <div class="mt-6 flex justify-end gap-3">
                    <button type="button" @click="isLessonModalOpen = false" class="px-4 py-2 text-gray-700 bg-gray-100 rounded-lg hover:bg-gray-200 dark:bg-slate-700 dark:text-gray-300 transition">বাতিল</button>
                    <button type="submit" class="px-4 py-2 text-white bg-blue-600 rounded-lg hover:bg-blue-700 transition">সেভ করুন</button>
                </div>
            </form>
        </div>
    </div>
</div>