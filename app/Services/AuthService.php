<?php

namespace App\Services;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\StoreUserRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\View\View;

class AuthService
{
    private const MAX_ATTEMPTS = 5;
    private const DECAY_SECONDS = 60;

    public function showLogin(): View
    {
        return view('auth.login');
    }

    public function login(LoginRequest $loginRequest): RedirectResponse
    {
        $key = 'login:' . $loginRequest->ip();

        if (RateLimiter::tooManyAttempts($key, self::MAX_ATTEMPTS)) {
            $seconds = RateLimiter::availableIn($key);
            return back()->withErrors([
                'email' => "Too many login attempts. Please try again in {$seconds} seconds.",
            ]);
        }

        $credentials = $loginRequest->only(['email', 'password']);

        if (! Auth::attempt($credentials, $loginRequest->boolean('remember'))) {
            RateLimiter::hit($key, self::DECAY_SECONDS);

            return back()
                ->withErrors(['email' => 'The provided credentials do not match our records.'])
                ->onlyInput('email');
        }

        RateLimiter::clear($key);
        $loginRequest->session()->regenerate();

        return redirect()
            ->route('welcome')
            ->with('success', 'Signed in successfully.');
    }

    public function showRegister(): View
    {
        return view('auth.register');
    }

    public function register(StoreUserRequest $request): RedirectResponse
    {
        User::create($request->validated());

        return redirect()
            ->route('login')
            ->with('success', 'Account created successfully. You can sign in now.');
    }

    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()
            ->route('login')
            ->with('success', 'Signed out successfully.');
    }
}
