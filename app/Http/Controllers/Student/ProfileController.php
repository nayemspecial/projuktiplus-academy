<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use App\Models\User;

class ProfileController extends Controller
{
    /**
     * প্রোফাইল পেজ ভিউ
     */
    public function index()
    {
        $user = Auth::user();
        return view('student.profile.index', compact('user'));
    }

    /**
     * প্রোফাইল আপডেট (ইমেজ সহ)
     */
    public function update(Request $request)
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();

        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'nullable|string|max:20',
            'bio' => 'nullable|string|max:1000',
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048', // ২MB ম্যাক্স
        ]);

        try {
            // নাম, ফোন, বায়ো আপডেট
            $user->name = $request->name;
            $user->phone = $request->phone;
            $user->bio = $request->bio;

            // [ইমেজ আপলোড লজিক]
            if ($request->hasFile('avatar')) {
                // ১. যদি আগে কোনো ছবি থাকে এবং সেটি ডিফল্ট না হয়, তবে ডিলিট করো
                if ($user->avatar && Storage::disk('public')->exists($user->avatar)) {
                    Storage::disk('public')->delete($user->avatar);
                }

                // ২. নতুন ছবি স্টোরেজে সেভ করো (avatars ফোল্ডারে)
                $path = $request->file('avatar')->store('avatars', 'public');
                
                // ৩. ডাটাবেসে পাথ আপডেট করো
                $user->avatar = $path;
            }

            $user->save();

            return back()->with('success', 'প্রোফাইল সফলভাবে আপডেট করা হয়েছে।');

        } catch (\Exception $e) {
            return back()->with('error', 'কিছু একটা ভুল হয়েছে: ' . $e->getMessage());
        }
    }

    /**
     * সিকিউরিটি পেজ ভিউ
     */
    public function security()
    {
        return view('student.profile.security');
    }

    /**
     * পাসওয়ার্ড আপডেট
     */
    public function updateSecurity(Request $request)
    {
        $request->validate([
            'current_password' => 'required|current_password',
            'password' => 'required|confirmed|min:8',
        ]);

        $user = Auth::user();
        $user->password = Hash::make($request->password);
        $user->save();

        return back()->with('success', 'পাসওয়ার্ড সফলভাবে পরিবর্তন করা হয়েছে।');
    }

    /**
     * নোটিফিকেশন পেজ ভিউ
     */
    public function notifications()
    {
        $user = Auth::user();
        // সেটিংস অ্যারে না থাকলে খালি অ্যারে দাও
        $settings = $user->settings ?? [];
        return view('student.profile.notifications', compact('settings'));
    }

    /**
     * নোটিফিকেশন সেটিংস আপডেট
     */
    public function updateNotifications(Request $request)
    {
        $user = Auth::user();
        
        // চেকবক্সের মানগুলো অ্যারে আকারে সেভ করা
        $settings = [
            'notify_on_enrollment' => $request->has('notify_on_enrollment'),
            'notify_on_quiz_result' => $request->has('notify_on_quiz_result'),
            'notify_on_announcement' => $request->has('notify_on_announcement'),
            'notify_promotions' => $request->has('notify_promotions'),
        ];

        $user->settings = $settings;
        $user->save();

        return back()->with('success', 'নোটিফিকেশন সেটিংস আপডেট করা হয়েছে।');
    }
}