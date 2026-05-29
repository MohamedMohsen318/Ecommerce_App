<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdminLoginRequest;
use  App\Services\Admin\AdminAuthService;

class AdminAuthController extends Controller
{
    protected AdminAuthService $authService;

    public function __construct(AdminAuthService $authService)
    {
        $this->authService = $authService;
    }

    public function showLoginForm()
    {
        return view('admin.auth.login');
    }

    public function login(AdminLoginRequest $request)
    {
        $this->authService->login(
            $request->only(['email', 'password']),
            $request->boolean('remember')
        );

        return redirect()->intended(
            route('admin.dashboard')
        );
    }

    public function logout()
    {
        $this->authService->logout();

        return redirect()->route('admin.login');
    }
}
