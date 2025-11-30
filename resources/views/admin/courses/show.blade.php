@extends('layouts.admin')

@section('title', 'কোর্স কন্টেন্ট - ' . $course->title)

@section('header', 'কোর্স ম্যানেজমেন্ট')

@section('actions')
    <a href="{{ route('admin.courses.index') }}" class="inline-flex items-center px-4 py-2 border border-gray-300 dark:border-slate-600 shadow-sm text-sm font-medium rounded-lg text-gray-700 dark:text-gray-200 bg-white dark:bg-slate-800 hover:bg-gray-50 dark:hover:bg-slate-700 focus:outline-none transition-colors mr-2">
        <i class="fas fa-arrow-left mr-2"></i> ফিরে যান
    </a>
    <a href="{{ route('admin.courses.edit', $course->id) }}" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-lg shadow-sm text-white bg-blue-600 hover:bg-blue-700 focus:outline-none transition-colors">
        <i class="fas fa-edit mr-2"></i> এডিট কোর্স
    </a>
@endsection

@section('admin-content')
<div x-data="courseBuilder()">
    
    <!-- Course Info Card -->
    <div class="bg-white dark:bg-slate-800 rounded-xl shadow-sm border border-gray-200 dark:border-slate-700 p-6 mb-6">
        <div class="flex flex-col md:flex-row gap-6">
            <div class="w-full md:w-1/4">
                <div class="aspect-video rounded-lg overflow-hidden bg-gray-100 dark:bg-slate-700 border border-gray-200 dark:border-slate-600">
                    @if($course->thumbnail)
                        <img src="{{ asset('storage/'.$course->thumbnail) }}" alt="{{ $course->title }}" class="w-full h-full object-cover">
                    @else
                        <div class="w-full h-full flex items-center justify-center text-gray-400">
                            <i class="fas fa-image text-3xl"></i>
                        </div>
                    @endif
                </div>
            </div>
            <div class="w-full md:w-3/4">
                <div class="flex justify-between items-start">
                    <div>
                        <h2 class="text-2xl font-bold text-gray-900 dark:text-white mb-2">{{ $course->title }}</h2>
                        <p class="text-sm text-gray-500 dark:text-gray-400 mb-4">
                            ইন্সট্রাক্টর: <span class="font-medium text-gray-900 dark:text-white">{{ $course->instructor->name }}</span> | 
                            ক্যাটাগরি: <span class="font-medium text-gray-900 dark:text-white">{{ ucfirst($course->category) }}</span>
                        </p>
                    </div>
                    <span class="px-3 py-1 rounded-full text-xs font-bold uppercase {{ $course->status == 'published' ? 'bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-400' : 'bg-yellow-100 text-yellow-800 dark:bg-yellow-900/30 dark:text-yellow-400' }}">
                        {{ $course->status }}
                    </span>
                </div>
                
                <div class="grid grid-cols-2 sm:grid-cols-4 gap-4 mt-4 border-t border-gray-100 dark:border-slate-700 pt-4">
                    <div><span class="block text-xs text-gray-500">এনরোলমেন্ট</span><span class="font-bold text-gray-800 dark:text-white">{{ $course->enrollments->count() }}</span></div>
                    <div><span class="block text-xs text-gray-500">লেসন</span><span class="font-bold text-gray-800 dark:text-white">{{ $course->lessons->count() }}</span></div>
                    <div><span class="block text-xs text-gray-500">রেটিং</span><span class="font-bold text-gray-800 dark:text-white">{{ $course->rating }}</span></div>
                    <div><span class="block text-xs text-gray-500">মূল্য</span><span class="font-bold text-gray-800 dark:text-white">{{ $course->price > 0 ? '৳'.$course->price : 'ফ্রি' }}</span></div>
                </div>
            </div>
        </div>
    </div>

    <!-- Curriculum Builder Header -->
    <div class="flex justify-between items-center mb-4">
        <h3 class="text-lg font-bold text-gray-800 dark:text-white">ক্যারিকুলাম বিল্ডার</h3>
        <button @click="openSectionModal()" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-lg text-blue-700 bg-blue-100 hover:bg-blue-200 dark:bg-blue-900/30 dark:text-blue-300 dark:hover:bg-blue-900/50 focus:outline-none transition-colors">
            <i class="fas fa-plus-circle mr-2"></i> নতুন সেকশন
        </button>
    </div>

    <!-- Sections List (Sortable) -->
    <div id="sections-list" class="space-y-6">
        @forelse($course->sections as $section)
        <div class="bg-white dark:bg-slate-800 rounded-xl border border-gray-200 dark:border-slate-700 shadow-sm overflow-hidden section-item" 
             data-id="{{ $section->id }}">
            
            <!-- Section Header -->
            <div class="bg-gray-50 dark:bg-slate-700/50 px-4 py-3 flex items-center justify-between border-b border-gray-200 dark:border-slate-700">
                <div class="flex items-center gap-3">
                    <div class="cursor-move section-handle text-gray-400 hover:text-gray-600 dark:hover:text-gray-300 p-1">
                        <i class="fas fa-grip-vertical"></i>
                    </div>
                    <h4 class="font-semibold text-gray-800 dark:text-white">{{ $section->title }}</h4>
                    @if(!$section->is_published)
                        <span class="text-[10px] bg-yellow-100 text-yellow-800 px-2 py-0.5 rounded-full ml-2">Draft</span>
                    @endif
                </div>
                <div class="flex items-center gap-2">
                    <button @click="openLessonModal({{ $section->id }})" class="p-1.5 text-blue-600 hover:bg-blue-50 dark:hover:bg-slate-600 rounded transition" title="লেসন যোগ করুন">
                        <i class="fas fa-plus"></i>
                    </button>
                    <button @click="editSection({{ $section->id }}, '{{ $section->title }}', {{ $section->is_published ? 'true' : 'false' }})" class="p-1.5 text-yellow-600 hover:bg-yellow-50 dark:hover:bg-slate-600 rounded transition" title="এডিট">
                        <i class="fas fa-pencil-alt"></i>
                    </button>
                    <form action="{{ route('admin.sections.destroy', $section->id) }}" method="POST" onsubmit="return confirm('আপনি কি নিশ্চিত? এর ভেতরের সব লেসন মুছে যাবে।')" class="inline">
                        @csrf @method('DELETE')
                        <button type="submit" class="p-1.5 text-red-600 hover:bg-red-50 dark:hover:bg-slate-600 rounded transition" title="ডিলিট">
                            <i class="fas fa-trash-alt"></i>
                        </button>
                    </form>
                </div>
            </div>

            <!-- Lessons List (Sortable) -->
            <div id="lessons-list-{{ $section->id }}" class="p-2 space-y-2 min-h-[50px] lessons-container" data-section-id="{{ $section->id }}">
                @foreach($section->lessons as $lesson)
                <div class="flex items-center justify-between p-3 bg-white dark:bg-slate-900 border border-gray-100 dark:border-slate-700 rounded-lg hover:shadow-sm transition lesson-item"
                     data-id="{{ $lesson->id }}">
                    <div class="flex items-center gap-3 overflow-hidden">
                        <div class="cursor-move lesson-handle text-gray-300 hover:text-gray-500 p-1">
                            <i class="fas fa-bars"></i>
                        </div>
                        <div class="flex-1 min-w-0">
                            <p class="text-sm font-medium text-gray-800 dark:text-gray-200 truncate">{{ $lesson->title }}</p>
                            <div class="flex items-center gap-2 mt-0.5">
                                <span class="text-xs text-gray-500 dark:text-gray-400 bg-gray-100 dark:bg-slate-800 px-1.5 py-0.5 rounded uppercase">
                                    {{ $lesson->video_type }}
                                </span>
                                @if($lesson->is_free) 
                                    <span class="text-xs text-green-600 bg-green-100 dark:bg-green-900/30 px-1.5 py-0.5 rounded">Free</span> 
                                @endif
                                @if(!$lesson->is_published) 
                                    <span class="text-xs text-yellow-600 bg-yellow-100 dark:bg-yellow-900/30 px-1.5 py-0.5 rounded">Draft</span> 
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="flex items-center gap-2">
                        <button @click="editLesson({{ json_encode($lesson) }})" class="text-gray-400 hover:text-blue-600 transition">
                            <i class="fas fa-edit"></i>
                        </button>
                        <form action="{{ route('admin.lessons.destroy', $lesson->id) }}" method="POST" onsubmit="return confirm('নিশ্চিত?')" class="inline">
                            @csrf @method('DELETE')
                            <button type="submit" class="text-gray-400 hover:text-red-600 transition">
                                <i class="fas fa-times"></i>
                            </button>
                        </form>
                    </div>
                </div>
                @endforeach
                
                @if($section->lessons->count() === 0)
                <div class="text-center py-4 text-sm text-gray-400 italic pointer-events-none">
                    কোনো লেসন নেই। '+' বাটনে ক্লিক করে লেসন যোগ করুন।
                </div>
                @endif
            </div>
        </div>
        @empty
        <div class="text-center py-12 bg-white dark:bg-slate-800 rounded-xl border-2 border-dashed border-gray-300 dark:border-slate-600">
            <i class="fas fa-layer-group text-4xl text-gray-300 mb-3"></i>
            <p class="text-gray-500 dark:text-gray-400">এখনো কোনো সেকশন তৈরি করা হয়নি।</p>
            <button @click="openSectionModal()" class="mt-4 px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded-lg hover:bg-blue-700 transition">
                প্রথম সেকশন তৈরি করুন
            </button>
        </div>
        @endforelse
    </div>

    <!-- Modals Include -->
    @include('admin.courses.partials.modals')

</div>

@push('scripts')
<!-- SortableJS CDN (যদি লেআউটে না থাকে) -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/Sortable/1.15.0/Sortable.min.js"></script>

<script>
document.addEventListener('DOMContentLoaded', () => {
    if (typeof Sortable === 'undefined') return;

    // 1. Sections Reordering
    const sectionsList = document.getElementById('sections-list');
    if (sectionsList) {
        new Sortable(sectionsList, {
            handle: '.section-handle',
            animation: 150,
            ghostClass: 'sortable-ghost',
            onEnd: function (evt) {
                let orderedIds = Array.from(sectionsList.children).map(el => el.getAttribute('data-id'));
                
                fetch("{{ route('admin.sections.reorder') }}", {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: JSON.stringify({ sections: orderedIds })
                });
            }
        });
    }

    // 2. Lessons Reordering
    document.querySelectorAll('.lessons-container').forEach(container => {
        new Sortable(container, {
            group: 'lessons',
            handle: '.lesson-handle',
            animation: 150,
            ghostClass: 'sortable-ghost',
            onEnd: function (evt) {
                let sectionId = evt.to.getAttribute('data-section-id');
                let orderedIds = Array.from(evt.to.children).map(el => el.getAttribute('data-id')).filter(id => id);
                
                fetch("{{ route('admin.lessons.reorder') }}", {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: JSON.stringify({ 
                        lessons: orderedIds,
                        section_id: sectionId 
                    })
                });
            }
        });
    });
});

document.addEventListener('alpine:init', () => {
    Alpine.data('courseBuilder', () => ({
        isSectionModalOpen: false,
        isLessonModalOpen: false,
        sectionMode: 'create',
        lessonMode: 'create',
        sectionAction: '',
        lessonAction: '',
        
        sectionForm: { title: '', is_published: true },
        lessonForm: { section_id: '', title: '', video_url: '', duration: '', content: '', is_free: false, is_published: true },

        openSectionModal() {
            this.sectionMode = 'create';
            this.sectionForm.title = '';
            this.sectionForm.is_published = true;
            this.sectionAction = "{{ route('admin.sections.store') }}";
            this.isSectionModalOpen = true;
        },
        editSection(id, title, isPublished) {
            this.sectionMode = 'edit';
            this.sectionForm.title = title;
            this.sectionForm.is_published = isPublished;
            this.sectionAction = `/admin/sections/${id}`;
            this.isSectionModalOpen = true;
        },
        openLessonModal(sectionId) {
            this.lessonMode = 'create';
            this.lessonForm = { section_id: sectionId, title: '', video_url: '', duration: '', content: '', is_free: false, is_published: true };
            this.lessonAction = "{{ route('admin.lessons.store') }}";
            this.isLessonModalOpen = true;
        },
        editLesson(lesson) {
            this.lessonMode = 'edit';
            this.lessonForm = { 
                ...lesson, 
                is_free: !!lesson.is_free, 
                is_published: !!lesson.is_published 
            };
            this.lessonAction = `/admin/lessons/${lesson.id}`;
            this.isLessonModalOpen = true;
        }
    }));
});
</script>
@endpush
@endsection