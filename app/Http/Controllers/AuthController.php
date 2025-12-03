<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    /**
     * লগইন ফর্ম প্রদর্শন
     */
    public function showLoginForm()
    {
        if (Auth::check()) {
            return $this->redirectUser();
        }
        return view('auth.login');
    }

    /**
     * লগইন প্রসেস
     */
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        $remember = $request->boolean('remember');

        if (Auth::attempt($credentials, $remember)) {
            $request->session()->regenerate();
            
            // [FIXED] লগইনের পর রোল অনুযায়ী সঠিক ড্যাশবোর্ডে পাঠানো হচ্ছে
            return $this->redirectUser()->with('success', 'স্বাগতম! সফলভাবে লগইন হয়েছে।');
        }

        return back()->withErrors([
            'email' => 'ইমেইল বা পাসওয়ার্ড সঠিক নয়।',
        ])->onlyInput('email');
    }

    /**
     * রেজিস্ট্রেশন ফর্ম প্রদর্শন
     */
    public function showRegisterForm()
    {
        if (Auth::check()) {
            return $this->redirectUser();
        }
        return view('auth.register');
    }

    /**
     * রেজিস্ট্রেশন প্রসেস
     */
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'agreeTerms' => 'accepted',
        ]);

        // ইউজার তৈরি
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'student', // ডিফল্ট রোল স্টুডেন্ট
            'status' => 'active',
        ]);

        // অটো লগইন
        Auth::login($user);
        $request->session()->regenerate();

        // [FIXED] রেজিস্ট্রেশনের পর সরাসরি স্টুডেন্ট ড্যাশবোর্ডে রিডাইরেক্ট
        return $this->redirectUser()->with('success', 'অ্যাকাউন্ট সফলভাবে তৈরি হয়েছে! ড্যাশবোর্ডে স্বাগতম।');
    }

    /**
     * লগআউট
     */
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')->with('success', 'লগআউট সফল হয়েছে।');
    }

    public function showForgotPasswordForm()
    {
        return view('auth.forgot-password');
    }

    /**
     * [FIXED] ইউজার রোল অনুযায়ী সঠিক ড্যাশবোর্ডে রিডাইরেক্ট হেল্পার
     */
    protected function redirectUser()
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $role = Auth::user()->role;

        if ($role === 'admin') {
            return redirect()->route('admin.dashboard');
        } elseif ($role === 'instructor') {
            return redirect()->route('instructor.dashboard');
        } else {
            return redirect()->route('student.dashboard');
        }
    }
}