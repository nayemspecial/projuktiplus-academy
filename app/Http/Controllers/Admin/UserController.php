<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    /**
     * সকল ব্যবহারকারীর তালিকা
     */
    public function index(Request $request)
    {
        $search = $request->input('search');
        $role = $request->input('role');

        $query = User::query();

        if ($search) {
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('phone', 'like', "%{$search}%");
            });
        }

        if ($role && $role !== 'all') {
            $query->where('role', $role);
        }

        $users = $query->latest()->paginate(10)->withQueryString();

        return view('admin.users.index', compact('users', 'search', 'role'));
    }

    /**
     * শিক্ষার্থীদের তালিকা
     */
    public function students(Request $request)
    {
        $request->merge(['role' => 'student']);
        return $this->index($request);
    }

    /**
     * ইন্সট্রাকটরদের তালিকা
     */
    public function instructors(Request $request)
    {
        $request->merge(['role' => 'instructor']);
        return $this->index($request);
    }

    /**
     * নতুন ইউজার তৈরির ফর্ম
     */
    public function create()
    {
        $roles = ['student', 'instructor'];
        return view('admin.users.create', compact('roles'));
    }

    /**
     * নতুন ইউজার সেভ করা
     */
    public function store(Request $request)
    {
        // ভ্যালিডেশন
        $validated = $request->validate([
            'name'          => 'required|string|max:255',
            'email'         => 'required|email|unique:users,email',
            'phone'         => 'nullable|string|max:15',
            'password'      => 'required|string|min:8|confirmed',
            'role'          => 'required|in:student,instructor,admin',
            'status'        => 'required|in:active,inactive,banned',
            // 'address' বাদ দেওয়া হয়েছে কারণ টেবিলে এই কলাম নেই
            'bio'           => 'nullable|string|max:1000',
            'profile_photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $user = new User();
        $user->name = $validated['name'];
        $user->email = $validated['email'];
        $user->phone = $validated['phone'];
        $user->password = Hash::make($validated['password']);
        $user->role = $validated['role'];
        $user->status = $validated['status'];
        // $user->address = $validated['address'] ?? null; // বাদ দেওয়া হয়েছে
        $user->bio = $validated['bio'] ?? null;

        if ($request->hasFile('profile_photo')) {
            $path = $request->file('profile_photo')->store('avatars', 'public');
            $user->avatar = $path;
        }

        $user->save();

        return redirect()->route('admin.users.index')
            ->with('success', 'ব্যবহারকারী সফলভাবে তৈরি করা হয়েছে।');
    }

    /**
     * ইউজার বিস্তারিত
     */
    public function show(User $user)
    {
        // এনরোলমেন্ট রিলেশন থাকলে লোড করবে, না থাকলে স্কিপ করবে
        if (method_exists($user, 'enrollments')) {
            $user->load('enrollments.course');
        }
        return view('admin.users.show', compact('user'));
    }

    /**
     * ইউজার এডিট ফর্ম
     */
    public function edit(User $user)
    {
        if ($user->role === 'admin' && Auth::id() !== $user->id) {
            // সুপার অ্যাডমিন লজিক থাকলে এখানে চেক করতে পারেন
            // abort(403, 'Admin users cannot be edited.');
        }

        $roles = ['student', 'instructor', 'admin'];
        return view('admin.users.edit', compact('user', 'roles'));
    }

    /**
     * ইউজার আপডেট করা
     */
    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            'name'          => 'required|string|max:255',
            'email'         => ['required', 'email', Rule::unique('users')->ignore($user->id)],
            'phone'         => 'nullable|string|max:15',
            'password'      => 'nullable|string|min:8|confirmed',
            'role'          => 'required|in:student,instructor,admin',
            'status'        => 'required|in:active,inactive,banned',
            // 'address' বাদ দেওয়া হয়েছে
            'bio'           => 'nullable|string|max:1000',
            'profile_photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $user->name = $validated['name'];
        $user->email = $validated['email'];
        $user->phone = $validated['phone'];
        $user->role = $validated['role'];
        $user->status = $validated['status'];
        // $user->address = $validated['address'] ?? $user->address; // বাদ দেওয়া হয়েছে
        $user->bio = $validated['bio'] ?? $user->bio;

        if (!empty($validated['password'])) {
            $user->password = Hash::make($validated['password']);
        }

        if ($request->hasFile('profile_photo')) {
            if ($user->avatar && Storage::disk('public')->exists($user->avatar)) {
                Storage::disk('public')->delete($user->avatar);
            }
            $path = $request->file('profile_photo')->store('avatars', 'public');
            $user->avatar = $path;
        }

        $user->save();

        return redirect()->route('admin.users.index')
            ->with('success', 'ব্যবহারকারী সফলভাবে আপডেট করা হয়েছে।');
    }

    /**
     * ইউজার ডিলিট করা
     */
    public function destroy(User $user)
    {
        if ($user->id === Auth::id()) {
            return back()->with('error', 'আপনি নিজেকে ডিলিট করতে পারবেন না।');
        }

        if ($user->avatar && Storage::disk('public')->exists($user->avatar)) {
            Storage::disk('public')->delete($user->avatar);
        }

        $user->delete();

        return redirect()->route('admin.users.index')
            ->with('success', 'ব্যবহারকারী সফলভাবে ডিলিট করা হয়েছে।');
    }

    /**
     * স্ট্যাটাস আপডেট (AJAX)
     */
    public function updateStatus(Request $request, User $user)
    {
        $request->validate([
            'status' => 'required|in:active,inactive,banned'
        ]);

        if ($user->id === Auth::id()) {
            return response()->json(['success' => false, 'message' => 'নিজের স্ট্যাটাস পরিবর্তন করা যাবে না।'], 403);
        }

        $user->update(['status' => $request->status]);

        return back()->with('success', 'স্ট্যাটাস পরিবর্তন করা হয়েছে।');
    }
}