<?php

namespace App\Http\Controllers\Instructor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rules\Password;
use App\Models\User; // <-- এই লাইনটি নিশ্চিত করুন

class ProfileController extends Controller
{
    /**
     * সেটিংস পেজ (সাধারণ তথ্য - General Info)
     * Route: instructor.settings.index
     */
    public function index()
    {
        $instructor = Auth::user();
        return view('instructor.settings.index', compact('instructor'));
    }

    /**
     * প্রোফাইল তথ্য আপডেট করুন
     * Route: instructor.settings.profile.update
     */
    public function updateProfile(Request $request)
    {
        /** @var \App\Models\User $user */ // <-- [ফিক্স] এই লাইনটি এডিটরকে বলে দিবে $user আসলে User মডেল
        $user = Auth::user();

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'phone' => ['nullable', 'string', 'max:20'],
            'bio' => ['nullable', 'string', 'max:1000'],
            'expertise' => ['nullable', 'string', 'max:255'],
            'avatar' => ['nullable', 'image', 'max:2048'], // Max 2MB
        ]);

        // ছবি আপলোড হ্যান্ডলিং
        if ($request->hasFile('avatar')) {
            // আগের ছবি ডিলিট করা (যদি থাকে)
            if ($user->avatar && Storage::disk('public')->exists($user->avatar)) {
                Storage::disk('public')->delete($user->avatar);
            }

            $path = $request->file('avatar')->store('avatars', 'public');
            $validated['avatar'] = $path;
        }

        // ইউজার আপডেট
        $user->update($validated); // এখন আর এডিটর এরর দেখাবে না

        return back()->with('success', 'প্রোফাইল সফলভাবে আপডেট করা হয়েছে!');
    }

    /**
     * সিকিউরিটি পেজ (পাসওয়ার্ড পরিবর্তন)
     * Route: instructor.settings.security
     */
    public function security()
    {
        return view('instructor.settings.security');
    }

    /**
     * পাসওয়ার্ড পরিবর্তন করুন
     * Route: instructor.settings.password.update
     */
    public function updatePassword(Request $request)
    {
        $validated = $request->validate([
            'current_password' => ['required', 'current_password'],
            'password' => ['required', 'confirmed', Password::defaults()],
        ]);

        /** @var \App\Models\User $user */
        $user = Auth::user();

        $user->update([
            'password' => Hash::make($validated['password']),
        ]);

        return back()->with('success', 'পাসওয়ার্ড সফলভাবে পরিবর্তন করা হয়েছে!');
    }

    /**
     * নোটিফিকেশন সেটিংস পেজ
     * Route: instructor.settings.notifications
     */
    public function notifications()
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();
        
        // ডিফল্ট সেটিংস লোড করা (যদি ডাটাবেসে না থাকে)
        $settings = array_merge([
            'notify_on_enrollment' => true,
            'notify_on_review' => true,
            'notify_on_comment' => true,
            'weekly_report' => false,
        ], $user->settings ?? []);

        return view('instructor.settings.notifications', compact('settings'));
    }

    /**
     * নোটিফিকেশন সেটিংস আপডেট করুন
     * Route: instructor.settings.notifications.update
     */
    public function updateNotifications(Request $request)
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();

        // চেকবক্স থেকে ডেটা প্রসেস করা (চেক করা থাকলে 'on', না থাকলে null)
        $settings = [
            'notify_on_enrollment' => $request->has('notify_on_enrollment'),
            'notify_on_review' => $request->has('notify_on_review'),
            'notify_on_comment' => $request->has('notify_on_comment'),
            'weekly_report' => $request->has('weekly_report'),
        ];

        // সেটিংস সেভ করা
        $user->settings = array_merge($user->settings ?? [], $settings);
        $user->save();

        return back()->with('success', 'নোটিফিকেশন সেটিংস আপডেট করা হয়েছে!');
    }
}