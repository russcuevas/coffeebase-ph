<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use App\Models\User;

class AuthController extends Controller
{
    public function showLogin()
    {
        if (Auth::check()) {
            return Auth::user()->isAdmin() ? redirect()->route('admin.dashboard') : redirect()->route('home');
        }
        return view('frontend.auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        $remember = $request->has('remember');

        if (Auth::attempt($credentials, $remember)) {
            $request->session()->regenerate();
            
            if (Auth::user()->isAdmin()) {
                return redirect()->intended(route('admin.dashboard'))->with('success', 'Welcome back, Admin!');
            }

            return redirect()->intended(route('home'))->with('success', 'Welcome back to Coffee Base, ' . Auth::user()->first_name . '!');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }

    public function showForgotPassword()
    {
        if (Auth::check()) {
            return redirect()->route('home');
        }
        return view('frontend.auth.forgot-password');
    }

    public function sendResetLinkEmail(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
        ]);

        $user = User::where('email', $request->email)->first();

        if ($user) {
            $token = Str::random(64);

            DB::table('password_reset_tokens')->updateOrInsert(
                ['email' => $request->email],
                [
                    'token' => $token,
                    'created_at' => now(),
                ]
            );

            $resetUrl = route('password.reset', ['token' => $token, 'email' => $request->email]);

            try {
                Mail::send('emails.password-reset', [
                    'resetUrl' => $resetUrl,
                    'userName' => $user->first_name ?? $user->name,
                ], function ($message) use ($request) {
                    $message->to($request->email)
                            ->subject('Reset Your Password | Coffee Base Philippines');
                });
            } catch (\Throwable $e) {
                Log::error('Password reset email error: ' . $e->getMessage());
                return back()->withErrors(['email' => 'Unable to send password reset email at this moment. Please try again.']);
            }
        }

        return back()->with('status', 'If your email is registered in our records, a secure password reset link has been sent to your inbox.');
    }

    public function showResetPassword($token, Request $request)
    {
        if (Auth::check()) {
            return redirect()->route('home');
        }

        $email = $request->query('email');
        if (!$email) {
            return redirect()->route('password.request')->withErrors(['email' => 'Invalid password reset link.']);
        }

        $record = DB::table('password_reset_tokens')
            ->where('email', $email)
            ->where('token', $token)
            ->first();

        if (!$record) {
            return redirect()->route('password.request')->withErrors(['email' => 'This password reset link is invalid or has already been used.']);
        }

        // Check 60 minutes expiry
        if (now()->diffInMinutes($record->created_at) > 60) {
            DB::table('password_reset_tokens')->where('email', $email)->delete();
            return redirect()->route('password.request')->withErrors(['email' => 'This password reset link has expired. Please request a new one.']);
        }

        return view('frontend.auth.reset-password', [
            'token' => $token,
            'email' => $email,
        ]);
    }

    public function resetPassword(Request $request)
    {
        $request->validate([
            'token' => 'required|string',
            'email' => 'required|email|exists:users,email',
            'password' => 'required|string|min:6|confirmed',
        ]);

        $record = DB::table('password_reset_tokens')
            ->where('email', $request->email)
            ->where('token', $request->token)
            ->first();

        if (!$record) {
            return back()->withErrors(['email' => 'Invalid or expired password reset token. Please request a new link.']);
        }

        if (now()->diffInMinutes($record->created_at) > 60) {
            DB::table('password_reset_tokens')->where('email', $request->email)->delete();
            return redirect()->route('password.request')->withErrors(['email' => 'This password reset link has expired. Please request a new one.']);
        }

        $user = User::where('email', $request->email)->first();
        if ($user) {
            $user->password = Hash::make($request->password);
            $user->save();
        }

        DB::table('password_reset_tokens')->where('email', $request->email)->delete();

        return redirect()->route('login')->with('status', 'Your password has been successfully updated! You can now sign in.');
    }

    public function showRegister()
    {
        if (Auth::check()) {
            return redirect()->route('home');
        }
        return view('frontend.auth.register');
    }

    public function register(Request $request)
    {
        $validated = $request->validate([
            'first_name' => 'required|string|max:100',
            'last_name' => 'required|string|max:100',
            'email' => 'required|email|max:150|unique:users,email',
            'phone' => 'nullable|string|max:50',
            'password' => 'required|string|min:6|confirmed',
            'company' => 'nullable|string|max:150',
            'country' => 'nullable|string|max:50',
            'address' => 'nullable|string|max:300',
            'apartment' => 'nullable|string|max:100',
            'barangay' => 'nullable|string|max:100',
            'city' => 'nullable|string|max:100',
            'postal_code' => 'nullable|string|max:20',
            'region' => 'nullable|string|max:100',
        ]);

        $fullName = trim($validated['first_name'] . ' ' . $validated['last_name']);

        $user = User::create([
            'role' => 'customer',
            'name' => $fullName,
            'first_name' => $validated['first_name'],
            'last_name' => $validated['last_name'],
            'email' => $validated['email'],
            'phone' => $validated['phone'] ?? null,
            'password' => Hash::make($validated['password']),
            'company' => $validated['company'] ?? null,
            'country' => $validated['country'] ?? 'Philippines',
            'address' => $validated['address'] ?? null,
            'apartment' => $validated['apartment'] ?? null,
            'barangay' => $validated['barangay'] ?? null,
            'city' => $validated['city'] ?? null,
            'postal_code' => $validated['postal_code'] ?? null,
            'region' => $validated['region'] ?? null,
        ]);

        Auth::login($user);

        return redirect()->intended(route('home'))->with('success', 'Registration successful! Welcome to Coffee Base Philippines.');
    }

    public function updateProfile(Request $request)
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();

        $validated = $request->validate([
            'first_name' => 'required|string|max:100',
            'last_name' => 'required|string|max:100',
            'email' => "required|email|max:150|unique:users,email,{$user->id}",
            'phone' => 'nullable|string|max:50',
            'company' => 'nullable|string|max:150',
            'address' => 'nullable|string|max:300',
            'apartment' => 'nullable|string|max:100',
            'barangay' => 'nullable|string|max:100',
            'city' => 'nullable|string|max:100',
            'region' => 'nullable|string|max:100',
            'postal_code' => 'nullable|string|max:20',
            'current_password' => 'nullable|required_with:password|string',
            'password' => 'nullable|string|min:6|confirmed',
        ]);

        if (!empty($validated['password'])) {
            if (!Hash::check($request->current_password, $user->password)) {
                return back()->with('error', 'Current password does not match.');
            }
            $user->password = Hash::make($validated['password']);
        }

        $fullName = trim($validated['first_name'] . ' ' . $validated['last_name']);
        $user->name = $fullName;
        $user->first_name = $validated['first_name'];
        $user->last_name = $validated['last_name'];
        $user->email = $validated['email'];
        $user->phone = $validated['phone'] ?? null;
        $user->company = $validated['company'] ?? null;
        $user->address = $validated['address'] ?? null;
        $user->apartment = $validated['apartment'] ?? null;
        $user->barangay = $validated['barangay'] ?? null;
        $user->city = $validated['city'] ?? null;
        $user->region = $validated['region'] ?? null;
        $user->postal_code = $validated['postal_code'] ?? null;
        $user->save();

        return back()->with('success', 'Your account details have been updated successfully!');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('home')->with('success', 'You have been logged out.');
    }
}

