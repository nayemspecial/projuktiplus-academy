<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Section;
use App\Models\Course;
use Illuminate\Http\Request;

class SectionController extends Controller
{
    /**
     * নতুন সেকশন স্টোর করা
     */
    public function store(Request $request)
    {
        $request->validate([
            'course_id' => 'required|exists:courses,id',
            'title' => 'required|string|max:255',
            'is_published' => 'nullable|boolean', // চেক না করা থাকলে null আসতে পারে, তাই nullable
        ]);

        // অটোমেটিক অর্ডার: সবার শেষে যোগ হবে
        $lastOrder = Section::where('course_id', $request->course_id)->max('order');
        
        Section::create([
            'course_id' => $request->course_id,
            'title' => $request->title,
            'order' => $lastOrder ? $lastOrder + 1 : 1,
            'is_published' => $request->boolean('is_published'), // boolean helper ব্যবহার নিরাপদ
        ]);

        return back()->with('success', 'সেকশন সফলভাবে তৈরি করা হয়েছে।');
    }

    /**
     * সেকশন আপডেট করা
     */
    public function update(Request $request, Section $section)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'is_published' => 'nullable|boolean',
        ]);

        $section->update([
            'title' => $request->title,
            'is_published' => $request->boolean('is_published'),
        ]);

        return back()->with('success', 'সেকশন আপডেট করা হয়েছে।');
    }

    /**
     * সেকশন ডিলিট করা
     */
    public function destroy(Section $section)
    {
        // ক্যাস্কেড ডিলিট না থাকলে ম্যানুয়ালি লেসন মুছতে হবে
        $section->lessons()->delete();
        $section->delete();

        return back()->with('success', 'সেকশন এবং এর লেসনসমূহ ডিলিট করা হয়েছে।');
    }

    /**
     * [Drag & Drop] সেকশন রি-অর্ডার
     */
    public function reorder(Request $request)
    {
        $request->validate([
            'sections' => 'required|array',
            'sections.*' => 'integer|exists:sections,id'
        ]);

        foreach ($request->sections as $index => $id) {
            Section::where('id', $id)->update(['order' => $index + 1]);
        }

        return response()->json(['success' => true, 'message' => 'সেকশন সাজানো হয়েছে।']);
    }
}