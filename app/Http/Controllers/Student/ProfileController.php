<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rules\Password;

class ProfileController extends Controller
{
    /**
     * প্রোফাইল ওভারভিউ এবং এডিট পেজ
     */
    public function index()
    {
        $user = Auth::user();
        return view('student.profile.index', compact('user'));
    }

    /**
     * সাধারণ তথ্য আপডেট (নাম, ফোন, বায়ো, ছবি)
     */
    public function update(Request $request)
    {
        $user = Auth::user();

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'phone' => ['nullable', 'string', 'max:20'],
            'bio' => ['nullable', 'string', 'max:500'],
            'avatar' => ['nullable', 'image', 'max:1024'], // Max 1MB
        ]);

        // ছবি আপলোড হ্যান্ডলিং
        if ($request->hasFile('avatar')) {
            // আগের ছবি ডিলিট করা (যদি থাকে এবং ডিফল্ট না হয়)
            if ($user->avatar && Storage::disk('public')->exists($user->avatar)) {
                Storage::disk('public')->delete($user->avatar);
            }

            $path = $request->file('avatar')->store('avatars', 'public');
            $validated['avatar'] = $path;
        }

        $user->update($validated);

        return back()->with('success', 'প্রোফাইল সফলভাবে আপডেট করা হয়েছে!');
    }

    /**
     * সিকিউরিটি / পাসওয়ার্ড পরিবর্তন পেজ
     */
    public function security()
    {
        $user = Auth::user();
        return view('student.profile.security', compact('user'));
    }

    /**
     * পাসওয়ার্ড আপডেট
     */
    public function updateSecurity(Request $request)
    {
        $validated = $request->validate([
            'current_password' => ['required', 'current_password'],
            'password' => ['required', 'confirmed', Password::defaults()],
        ]);

        $request->user()->update([
            'password' => Hash::make($validated['password']),
        ]);

        return back()->with('success', 'পাসওয়ার্ড সফলভাবে পরিবর্তন করা হয়েছে!');
    }

    /**
     * নোটিফিকেশন সেটিংস পেজ দেখান
     */
    public function notifications()
    {
        $user = Auth::user();
        
        // ইউজারের সেটিংসগুলো ডিফল্ট ভ্যালু সহ লোড করুন
        $settings = array_merge([
            'notify_on_enrollment' => true,
            'notify_on_quiz_result' => true,
            'notify_on_announcement' => true,
            'notify_promotions' => false,
        ], $user->settings ?? []); // $user->settings যদি null হয় তবে ডিফল্ট অ্যারে ব্যবহার করুন

        return view('student.profile.notifications', compact('user', 'settings'));
    }

    /**
     * নোটিফিকেশন সেটিংস আপডেট করুন
     */
    public function updateNotifications(Request $request)
    {
        $user = Auth::user();

        // ভ্যালিডেশন (সবগুলো বুলিয়ান বা 'on'/'off' হতে পারে)
        $validatedSettings = $request->validate([
            'notify_on_enrollment' => 'sometimes|boolean',
            'notify_on_quiz_result' => 'sometimes|boolean',
            'notify_on_announcement' => 'sometimes|boolean',
            'notify_promotions' => 'sometimes|boolean',
        ]);
        
        // HTML ফর্ম থেকে checkbox গুলো 'on' বা null হিসেবে আসে, সেগুলোকে true/false তে রূপান্তর
        $settings = [
            'notify_on_enrollment' => $request->has('notify_on_enrollment'),
            'notify_on_quiz_result' => $request->has('notify_on_quiz_result'),
            'notify_on_announcement' => $request->has('notify_on_announcement'),
            'notify_promotions' => $request->has('notify_promotions'),
        ];

        // ইউজারের 'settings' কলামে আপডেট করুন
        $user->update(['settings' => $settings]);

        return back()->with('success', 'নোটিফিকেশন সেটিংস সফলভাবে সেভ করা হয়েছে!');
    }
}