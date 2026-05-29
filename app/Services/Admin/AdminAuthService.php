<?php

namespace App\Services\Admin;

use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class AdminAuthService
{
    public function login(array $credentials, bool $remember = false): bool
    {
        if (Auth::guard('admin')->attempt($credentials, $remember)) {

            request()->session()->regenerate();

            return true;
        }

        throw ValidationException::withMessages([
            'email' => __('Invalid admin credentials.'),
        ]);
    }

    public function logout(): void
    {
        Auth::guard('admin')->logout();

        request()->session()->invalidate();

        request()->session()->regenerateToken();
    }

    public function user()
    {
        return Auth::guard('admin')->user();
    }

    public function check(): bool
    {
        return Auth::guard('admin')->check();
    }
}
