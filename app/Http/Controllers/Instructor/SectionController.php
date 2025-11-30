<?php

namespace App\Http\Controllers\Instructor;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Section;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SectionController extends Controller
{
    /**
     * নতুন সেকশন তৈরি করুন
     */
    public function store(Request $request, Course $course)
    {
        // এই ইন্সট্রাকটর কোর্সের মালিক কিনা তা চেক করুন
        $this->authorizeOwnership($course);

        $request->validate([
            'title' => 'required|string|max:255',
        ]);

        // অর্ডারের জন্য শেষ সেকশনের পরের নম্বরটি নিন
        $order = $course->sections()->max('order') + 1;

        $course->sections()->create([
            'title' => $request->title,
            'order' => $order,
            'is_published' => false, // ডিফল্ট ড্রাফট
        ]);

        return redirect()->back()->with('success', 'নতুন সেকশন সফলভাবে যোগ করা হয়েছে!');
    }

    /**
     * সেকশন আপডেট করুন
     */
    public function update(Request $request, Section $section)
    {
        // এই ইন্সট্রাকটর সেকশনের মালিক কিনা তা চেক করুন
        $this->authorizeOwnership($section->course);

        $request->validate([
            'title' => 'required|string|max:255',
        ]);

        $section->update([
            'title' => $request->title,
        ]);

        return redirect()->back()->with('success', 'সেকশনের নাম সফলভাবে আপডেট করা হয়েছে!');
    }

    /**
     * সেকশন ডিলিট করুন
     */
    public function destroy(Section $section)
    {
        $this->authorizeOwnership($section->course);
        
        // ডিলিট করার আগে এর ভেতরের সব লেসন ডিলিট হবে (মডেল ইভেন্ট দিয়ে করা ভালো, তবে এখানে সরাসরি করছি)
        $section->lessons()->delete();
        $section->delete();

        return redirect()->back()->with('success', 'সেকশন (এবং এর লেসনসমূহ) সফলভাবে ডিলিট করা হয়েছে!');
    }

    /**
     * [নতুন] সেকশন রি-অর্ডার (Drag-and-Drop)
     */
    public function reorder(Request $request)
    {
        $request->validate([
            'sections' => 'required|array',
            'sections.*' => 'integer' // সেকশন আইডিগুলোর একটি অ্যারে
        ]);

        // মালিকানা যাচাই (নিশ্চিত করুন প্রথম সেকশনটি এই ইন্সট্রাকটরের)
        $firstSection = Section::find($request->sections[0]);
        if (!$firstSection || $firstSection->course->instructor_id !== Auth::id()) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        // লুপ চালিয়ে প্রতিটি সেকশনের 'order' আপডেট করুন
        foreach ($request->sections as $index => $sectionId) {
            Section::where('id', $sectionId)
                ->update(['order' => $index + 1]);
        }

        return response()->json(['message' => 'সেকশন সফলভাবে সাজানো হয়েছে!']);
    }


    /**
     * হেল্পার মেথড: এই ইন্সট্রাকটর কোর্সের মালিক কিনা তা চেক করে
     */
    private function authorizeOwnership(Course $course)
    {
        if ($course->instructor_id !== Auth::id()) {
            abort(403, 'আপনি এই কোর্সের মালিক নন।');
        }
    }
}