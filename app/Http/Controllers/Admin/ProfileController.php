<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class ProfileController extends Controller
{
    /**
     * প্রোফাইল এডিট পেজ
     */
    public function index()
    {
        $user = Auth::user();
        return view('admin.profile.index', compact('user'));
    }

    /**
     * প্রোফাইল আপডেট লজিক
     */
    public function update(Request $request)
    {
        // Auth::user() এর পরিবর্তে সরাসরি মডেল থেকে ইউজার আনা হচ্ছে যাতে save() মেথড নিশ্চিতভাবে কাজ করে
        $user = User::findOrFail(Auth::id());

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => ['required', 'email', Rule::unique('users')->ignore($user->id)],
            'phone' => 'nullable|string|max:20',
            'bio' => 'nullable|string|max:500',
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        // অ্যাভাটার আপলোড
        if ($request->hasFile('avatar')) {
            // আগের ছবি ডিলিট করা (যদি থাকে এবং ডিফল্ট না হয়)
            if ($user->avatar && Storage::disk('public')->exists($user->avatar)) {
                Storage::disk('public')->delete($user->avatar);
            }
            
            $path = $request->file('avatar')->store('avatars', 'public');
            $user->avatar = $path;
        }

        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->bio = $request->bio;
        $user->save(); // এখন এটি কাজ করবে

        return back()->with('success', 'প্রোফাইল তথ্য সফলভাবে আপডেট করা হয়েছে।');
    }

    /**
     * পাসওয়ার্ড পরিবর্তন পেজ
     */
    public function security()
    {
        return view('admin.profile.security');
    }

    /**
     * পাসওয়ার্ড আপডেট লজিক
     */
    public function updateSecurity(Request $request)
    {
        $request->validate([
            'current_password' => 'required|current_password',
            'password' => 'required|confirmed|min:8',
        ]);

        // মডেল থেকে ইউজার রিট্রিভ করা
        $user = User::findOrFail(Auth::id());
        
        $user->password = Hash::make($request->password);
        $user->save();

        return back()->with('success', 'পাসওয়ার্ড সফলভাবে পরিবর্তন করা হয়েছে।');
    }
}