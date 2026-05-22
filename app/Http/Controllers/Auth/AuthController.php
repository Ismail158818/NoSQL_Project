<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Fun_Services\Fun_Auth;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthController extends Controller
{
    public function showAuthForm(): View
    {
        return view('auth.auth');
    }

    // تسجيل الدخول
    public function login(Request $request): RedirectResponse
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user || !password_verify($request->password, $user->password)) {
            return back()->withErrors(['email' => 'The login information is incorrect']);
        }

        Auth::login($user);

        $request->session()->regenerate();

        return redirect()->route('home');
    }

    // إنشاء حساب جديد
    public function register(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed|min:6',
        ]);

        $auth = new Fun_Auth;
        $user = $auth->register_user_services($validated);

        Auth::login($user);

        return redirect()->route('home');
    }

    // تسجيل الخروج
    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}