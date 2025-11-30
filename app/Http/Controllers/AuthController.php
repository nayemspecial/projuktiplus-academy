<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Auth\Events\PasswordReset;
use App\Models\User;

class AuthController extends Controller
{
    // Show Login Form
    public function showLoginForm()
    {
        return view('auth.login');
    }

    // Show Registration Form
    public function showRegisterForm()
    {
        return view('auth.register');
    }

    // Show Forgot Password Form
    public function showForgotPasswordForm()
    {
        return view('auth.forgot-password');
    }

    // Show Reset Password Form
    public function showResetForm(Request $request, $token = null)
    {
        return view('auth.reset-password')->with(
            ['token' => $token, 'email' => $request->email]
        );
    }

    // Process Login
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if (Auth::attempt($credentials, $request->remember)) {
            $request->session()->regenerate();
            
            // Redirect based on user role
            $user = Auth::user();
            
            // Get the intended URL or use role-based default
            $intended = session()->pull('url.intended');
            
            if ($intended) {
                return redirect($intended);
            }
            
            // Role-based redirection
            return match($user->role) {
                'admin' => redirect()->route('admin.dashboard'),
                'instructor' => redirect()->route('instructor.dashboard'),
                default => redirect()->route('student.dashboard')
            };
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }

    // Process Registration
    public function register(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8|confirmed',
            'role' => 'required|in:student,instructor' // Only allow student or instructor registration
        ]);

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'role' => $validated['role']
        ]);

        Auth::login($user);

        // Redirect based on user role after registration
        if ($user->isInstructor()) {
            return redirect('/instructor/dashboard');
        } else {
            return redirect('/student/dashboard');
        }
    }

    // Send Password Reset Link
    public function sendResetLink(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        $status = Password::sendResetLink(
            $request->only('email')
        );

        return $status === Password::RESET_LINK_SENT
            ? back()->with(['status' => __($status)])
            : back()->withErrors(['email' => __($status)]);
    }

    // Reset Password
    public function resetPassword(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:8|confirmed',
        ]);

        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) {
                $user->forceFill([
                    'password' => Hash::make($password)
                ])->save();

                event(new PasswordReset($user));
            }
        );

        return $status == Password::PASSWORD_RESET
            ? redirect()->route('login')->with('status', __($status))
            : back()->withErrors(['email' => [__($status)]]);
    }

    // Logout
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}