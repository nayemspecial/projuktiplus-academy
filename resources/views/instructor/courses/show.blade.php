@extends('layouts.instructor')

@section('title', 'কোর্স প্রিভিউ: ' . $course->title)

@push('styles')
    <!-- Alpine.js Sortable Plugin (Drag-and-Drop এর জন্য) -->
    <!-- এটি অবশ্যই মূল Alpine.js এর আগে লোড হতে হবে (আপনার লেআউটে মূল Alpine.js আছে, তাই এটি এখানে push করছি) -->
    <script src="https://cdn.jsdelivr.net/npm/@alpinejs/sort@3.x.x/dist/cdn.min.js"></script>
    
    <style>
        /* ড্র্যাগ করার সময় স্টাইল */
        .sortable-ghost { opacity: 0.4; background-color: #f3f4f6; border: 2px dashed #cbd5e1; }
        .sortable-drag { cursor: grabbing; }
        .cursor-move { cursor: grab; }
    </style>
@endpush

@section('instructor-content')
    <div x-data="{ 
            currentSection: null, 
            currentLesson: null,

            editSectionAction: '',
            editSectionTitle: '',

            editLessonAction: '',
            editLessonTitle: '',
            editLessonVideoUrl: '',
            editLessonContent: '',

            // --- Drag-and-Drop ফাংশন ---

            // ১. সেকশন রি-অর্ডার হ্যান্ডলার
            reorderSections(event) {
                // ড্রপ করার পর নতুন অর্ডারের আইডির লিস্ট তৈরি
                let orderedIds = Array.from(document.querySelectorAll('[x-sortable-item=\'section\']'))
                                      .map(el => el.dataset.id);

                fetch('{{ route('instructor.sections.reorder') }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name=\'csrf-token\']').getAttribute('content') // আপনার লেআউটে csrf মেটা ট্যাগ থাকতে হবে
                        // অথবা: 'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({ sections: orderedIds })
                })
                .then(response => {
                    if(response.ok) console.log('Sections reordered successfully');
                });
            },

            // ২. লেসন রি-অর্ডার হ্যান্ডলার
            reorderLessons(event, sectionId) {
                // যেই কন্টেইনারে ড্রপ করা হয়েছে, তার ভেতরের লেসনগুলোর আইডি নেওয়া
                let container = event.target; 
                let orderedIds = Array.from(container.children).map(el => el.dataset.id);

                fetch('{{ route('instructor.lessons.reorder') }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({ 
                        lessons: orderedIds,
                        section_id: sectionId 
                    })
                })
                .then(response => {
                    if(response.ok) console.log('Lessons reordered successfully');
                });
            }
         }">

        <div class="mb-6">
            <div class="flex flex-col md:flex-row justify-between items-start gap-4">
                <div>
                    <a href="{{ route('instructor.courses.index') }}" class="inline-flex items-center text-sm text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-200 mb-2">
                        <i class="fas fa-arrow-left mr-2"></i> সব কোর্সে ফিরে যান
                    </a>
                    <h2 class="text-2xl font-bold text-gray-800 dark:text-white">{{ $course->title }}</h2>
                    <p class="text-gray-600 dark:text-gray-400 mt-1">{{ $course->short_description ?? 'কোর্সের সংক্ষিপ্ত বিবরণ এখানে যোগ করুন।' }}</p>
                </div>
                <div class="flex-shrink-0 flex items-center gap-3">
                    <a href="{{ route('instructor.courses.edit', $course) }}" class="inline-flex items-center px-4 py-2 border border-gray-300 dark:border-slate-700 text-sm font-medium rounded-md text-gray-700 dark:text-gray-300 bg-white dark:bg-slate-800 hover:bg-gray-50 dark:hover:bg-slate-700">
                        <i class="fas fa-edit mr-2"></i> বেসিক এডিট করুন
                    </a>
                    <form action="{{ route('instructor.courses.publish', $course) }}" method="POST">
                        @csrf
                        <button type="submit" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white {{ $course->status == 'published' ? 'bg-yellow-500 hover:bg-yellow-600' : 'bg-green-600 hover:bg-green-700' }}">
                            @if($course->status == 'published')
                                <i class="fas fa-arrow-down mr-2"></i> ড্রাফট করুন
                            @else
                                <i class="fas fa-arrow-up mr-2"></i> পাবলিশ করুন
                            @endif
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <div class="mt-8 grid grid-cols-1 lg:grid-cols-3 gap-8">
            <div class="lg:col-span-2">
                <div class="bg-white dark:bg-slate-800 rounded-lg shadow">
                    <div class="p-6 border-b border-gray-200 dark:border-slate-700 flex justify-between items-center">
                        <h3 class="text-xl font-bold text-gray-800 dark:text-white">কোর্স কন্টেন্ট (ক্যারিকুলাম)</h3>
                        <button @click="$dispatch('open-modal', 'create-section-modal')" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700">
                            <i class="fas fa-plus mr-2"></i> নতুন সেকশন
                        </button>
                    </div>
                    
                    <!-- [ড্র্যাগ এরিয়া] সেকশন লিস্ট -->
                    <div class="p-6 space-y-6" x-sortable="reorderSections">
                        @if($course->sections->count() > 0)
                            @foreach($course->sections->sortBy('order') as $section)
                            
                            <!-- প্রতিটি সেকশন আইটেম -->
                            <div class="bg-gray-50 dark:bg-slate-900/50 border border-gray-200 dark:border-slate-700 rounded-lg"
                                 x-sortable-item="section"
                                 data-id="{{ $section->id }}">
                                
                                <div class="p-4 flex justify-between items-center">
                                    <h4 class="text-lg font-semibold text-gray-800 dark:text-white flex items-center">
                                        <!-- [হ্যান্ডেল] সেকশন মুভ করার আইকন -->
                                        <i class="fas fa-bars mr-3 text-gray-400 cursor-move" x-sortable-handle title="সেকশন সরাতে টানুন"></i> 
                                        {{ $section->title }}
                                    </h4>
                                    <div class="flex items-center gap-3">
                                        
                                        <button @click="currentSection = {{ $section->toJson() }}; $dispatch('open-modal', 'create-lesson-modal')" 
                                                class="text-blue-500 hover:text-blue-700" title="লেসন যোগ করুন">
                                            <i class="fas fa-plus-circle"></i>
                                        </button>
                                        
                                        <button @click="currentSection = {{ $section->toJson() }}; editSectionAction = '{{ route('instructor.sections.update', $section->id) }}'; editSectionTitle = '{{ e($section->title) }}'; $dispatch('open-modal', 'edit-section-modal')" 
                                                class="text-gray-500 hover:text-gray-700" title="সেকশন এডিট">
                                            <i class="fas fa-edit"></i>
                                        </button>

                                        <form action="{{ route('instructor.sections.destroy', $section->id) }}" method="POST" onsubmit="return confirm('আপনি কি এই সেকশনটি ডিলিট করতে চান? এর ভেতরের সব লেসন ডিলিট হয়ে যাবে।');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-500 hover:text-red-700" title="সেকশন ডিলিট">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                                
                                <!-- [ড্র্যাগ এরিয়া] লেসন লিস্ট -->
                                <div class="border-t border-gray-200 dark:border-slate-700 p-4 space-y-3"
                                     x-sortable="reorderLessons($event, {{ $section->id }})">
                                     
                                    @forelse($section->lessons->sortBy('order') as $lesson)
                                    
                                    <!-- প্রতিটি লেসন আইটেম -->
                                    <div class="flex justify-between items-center p-3 rounded-md bg-white dark:bg-slate-800 border border-gray-200 dark:border-slate-600"
                                         x-sortable-item="lesson"
                                         data-id="{{ $lesson->id }}">
                                         
                                        <span class="text-sm font-medium text-gray-700 dark:text-gray-300 flex items-center">
                                            <!-- [হ্যান্ডেল] লেসন মুভ করার আইকন -->
                                            <i class="fas fa-bars mr-3 text-gray-400 cursor-move" x-sortable-handle title="লেসন সরাতে টানুন"></i>
                                            
                                            <!-- স্ট্যাটাস আইকন -->
                                            <i class="fas fa-play-circle mr-3 {{ $lesson->is_published ? 'text-blue-500' : 'text-gray-400' }}"></i> 
                                            {{ $lesson->title }}
                                        </span>
                                        
                                        <div class="flex items-center gap-3">
                                            <!-- পাবলিশ টগল -->
                                            <form action="{{ route('instructor.lessons.status', $lesson->id) }}" method="POST" title="{{ $lesson->is_published ? 'আনপাবলিশ করুন' : 'পাবলিশ করুন' }}">
                                                @csrf
                                                <button type="submit" class="mt-1">
                                                    <div class="relative inline-flex items-center cursor-pointer">
                                                        <div class="w-9 h-5 bg-gray-200 dark:bg-slate-700 rounded-full peer {{ $lesson->is_published ? 'bg-blue-600' : '' }}">
                                                            <div class="absolute top-[2px] left-[2px] bg-white border-gray-300 border rounded-full h-4 w-4 transition-all {{ $lesson->is_published ? 'translate-x-full border-white' : '' }}"></div>
                                                        </div>
                                                    </div>
                                                </button>
                                            </form>

                                            <button @click="
                                                        currentLesson = {{ $lesson->toJson() }}; 
                                                        editLessonAction = '{{ route('instructor.lessons.update', $lesson->id) }}';
                                                        editLessonTitle = '{{ e($lesson->title) }}';
                                                        editLessonVideoUrl = '{{ e($lesson->video_url) }}';
                                                        editLessonContent = '{{ e(str_replace(["\r", "\n"], ' ', $lesson->content)) }}';
                                                        $dispatch('open-modal', 'edit-lesson-modal');
                                                    "
                                                    class="text-sm text-gray-500 hover:text-gray-700" title="লেসন এডিট">
                                                <i class="fas fa-edit"></i>
                                            </button>

                                            <form action="{{ route('instructor.lessons.destroy', $lesson->id) }}" method="POST" onsubmit="return confirm('আপনি কি এই লেসনটি ডিলিট করতে চান?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-sm text-red-500 hover:text-red-700" title="লেসন ডিলিট">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                    @empty
                                    <p class="text-sm text-center text-gray-400 py-4">এই সেকশনে কোনো লেসন নেই।</p>
                                    @endforelse
                                </div>
                            </div>
                            @endforeach
                        @else
                        <div class="text-center py-10">
                            <i class="fas fa-folder-open text-5xl text-gray-300 dark:text-slate-600 mb-4"></i>
                            <h3 class="text-lg font-medium text-gray-900 dark:text-white">এখনো কোনো সেকশন নেই</h3>
                            <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">শুরু করতে "নতুন সেকশন" বাটনে ক্লিক করুন।</p>
                        </div>
                        @endif
                    </div>
                </div>
            </div>

            <div class="lg:col-span-1">
                {{-- ... আপনার সাইডবার (অপরিবর্তিত) ... --}}
                <div class="space-y-6">
                    <div class="bg-white dark:bg-slate-800 rounded-lg shadow overflow-hidden">
                        <div class="p-5 border-b border-gray-200 dark:border-slate-700"><h4 class="text-lg font-semibold text-gray-800 dark:text-white">কোর্স থাম্বনেইল</h4></div>
                        <div class="p-5"><img src="{{ $course->thumbnail_url }}" alt="{{ $course->title }}" class="w-full h-auto rounded-md object-cover"></div>
                    </div>
                    <div class="bg-white dark:bg-slate-800 rounded-lg shadow overflow-hidden">
                        <div class="p-5 border-b border-gray-200 dark:border-slate-700"><h4 class="text-lg font-semibold text-gray-800 dark:text-white">কোর্স পরিসংখ্যান</h4></div>
                        <div class="p-5 divide-y divide-gray-200 dark:divide-slate-700">
                            <div class="flex justify-between items-center py-3"><span class="text-sm font-medium text-gray-600 dark:text-gray-300">এনরোলমেন্ট</span><span class="text-sm font-bold text-gray-800 dark:text-white">{{ $course->enrollments_count ?? $course->enrollments->count() }}</span></div>
                            <div class="flex justify-between items-center py-3"><span class="text-sm font-medium text-gray-600 dark:text-gray-300">লেসন</span><span class="text-sm font-bold text-gray-800 dark:text-white">{{ $course->lessons->count() }}</span></div>
                            <div class="flex justify-between items-center py-3"><span class="text-sm font-medium text-gray-600 dark:text-gray-300">রেটিং</span><span class="text-sm font-bold text-gray-800 dark:text-white">{{ round($course->reviews_avg_rating, 1) ?? 'N/A' }}</span></div>
                            <div class="flex justify-between items-center py-3"><span class="text-sm font-medium text-gray-600 dark:text-gray-300">মূল্য</span><span class="text-sm font-bold text-gray-800 dark:text-white">৳{{ number_format($course->price) }}</span></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Create Section Modal --}}
        <div x-data="{ open: false }" @open-modal.window="if ($event.detail === 'create-section-modal') open = true" x-show="open" class="fixed inset-0 z-50 overflow-y-auto" style="display: none;">
            <div class="flex items-center justify-center min-h-screen px-4">
                <div x-show="open" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" class="fixed inset-0 bg-gray-500 dark:bg-gray-900 bg-opacity-75 dark:bg-opacity-75 transition-opacity" @click="open = false"></div>
                <div x-show="open" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100" x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-95" 
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
                            <button type="button" @click="open = false" class="mt-3 inline-flex justify-center w-full rounded-md border border-gray-300 dark:border-slate-600 shadow-sm px-4 py-2 bg-white dark:bg-slate-800 text-base font-medium text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-slate-700 sm:mt-0 sm:w-auto sm:text-sm">বাতিল করুন</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        {{-- Edit Section Modal --}}
        <div x-data="{ open: false }" @open-modal.window="if ($event.detail === 'edit-section-modal') open = true" x-show="open" class="fixed inset-0 z-50 overflow-y-auto" style="display: none;">
            <div class="flex items-center justify-center min-h-screen px-4">
                <div x-show="open" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" class="fixed inset-0 bg-gray-500 dark:bg-gray-900 bg-opacity-75 dark:bg-opacity-75 transition-opacity" @click="open = false"></div>
                <div x-show="open" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100" x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-95" 
                     class="relative bg-white dark:bg-slate-800 rounded-lg shadow-xl overflow-hidden transform transition-all sm:my-8 sm:max-w-lg sm:w-full">
                    <form :action="editSectionAction" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="px-4 pt-5 pb-4 sm:p-6">
                            <h3 class="text-lg font-medium leading-6 text-gray-900 dark:text-white mb-4">সেকশন এডিট করুন</h3>
                            <div>
                                <label for="edit_title" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">সেকশনের নাম</label>
                                <input type="text" name="title" id="edit_title" required 
                                       :value="editSectionTitle"
                                       class="mt-1 block w-full px-4 py-2 border border-gray-300 dark:border-slate-700 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 dark:bg-slate-900">
                            </div>
                        </div>
                        <div class="bg-gray-50 dark:bg-slate-700/50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                            <button type="submit" class="inline-flex justify-center w-full rounded-md border border-transparent shadow-sm px-4 py-2 bg-blue-600 text-base font-medium text-white hover:bg-blue-700 sm:ml-3 sm:w-auto sm:text-sm">আপডেট করুন</button>
                            <button type="button" @click="open = false" class="mt-3 inline-flex justify-center w-full rounded-md border border-gray-300 dark:border-slate-600 shadow-sm px-4 py-2 bg-white dark:bg-slate-800 text-base font-medium text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-slate-700 sm:mt-0 sm:w-auto sm:text-sm">বাতিল করুন</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        {{-- Create Lesson Modal --}}
        <div x-data="{ open: false }" @open-modal.window="if ($event.detail === 'create-lesson-modal') open = true" x-show="open" class="fixed inset-0 z-50 overflow-y-auto" style="display: none;">
            <div class="flex items-center justify-center min-h-screen px-4">
                <div x-show="open" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" class="fixed inset-0 bg-gray-500 dark:bg-gray-900 bg-opacity-75 dark:bg-opacity-75 transition-opacity" @click="open = false"></div>
                <div x-show="open" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100" x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-95" 
                     class="relative bg-white dark:bg-slate-800 rounded-lg shadow-xl overflow-hidden transform transition-all sm:my-8 sm:max-w-lg sm:w-full">
                    
                    <form :action="currentSection ? `/instructor/courses/${currentSection.course_id}/sections/${currentSection.id}/lessons` : '#'" method="POST">
                        @csrf
                        <div class="px-4 pt-5 pb-4 sm:p-6">
                            <h3 class="text-lg font-medium leading-6 text-gray-900 dark:text-white mb-1">নতুন লেসন যোগ করুন</h3>
                            <p class="text-sm text-gray-500 dark:text-gray-400 mb-4">সেকশন: <span x-text="currentSection ? currentSection.title : ''"></span></p>
                            
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
                            <button type="button" @click="open = false" class="mt-3 inline-flex justify-center w-full rounded-md border border-gray-300 dark:border-slate-600 shadow-sm px-4 py-2 bg-white dark:bg-slate-800 text-base font-medium text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-slate-700 sm:mt-0 sm:w-auto sm:text-sm">বাতিল করুন</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        {{-- Edit Lesson Modal --}}
        <div x-data="{ open: false }" @open-modal.window="if ($event.detail === 'edit-lesson-modal') open = true" x-show="open" class="fixed inset-0 z-50 overflow-y-auto" style="display: none;">
            <div class="flex items-center justify-center min-h-screen px-4">
                <div x-show="open" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" class="fixed inset-0 bg-gray-500 dark:bg-gray-900 bg-opacity-75 dark:bg-opacity-75 transition-opacity" @click="open = false"></div>
                <div x-show="open" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100" x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-95" 
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
                            <button type="button" @click="open = false" class="mt-3 inline-flex justify-center w-full rounded-md border border-gray-300 dark:border-slate-600 shadow-sm px-4 py-2 bg-white dark:bg-slate-800 text-base font-medium text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-slate-700 sm:mt-0 sm:w-auto sm:text-sm">বাতিল করুন</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        
    </div>
@endsection