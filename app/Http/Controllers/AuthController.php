<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\StoreUserRequest;
use App\Services\AuthService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AuthController extends Controller
{
    public function __construct(private readonly AuthService $authService) {

    }

    public function showLogin(): View
    {
        return $this->authService->showLogin();
    }

    public function login(LoginRequest $request): RedirectResponse
    {
        return $this->authService->login($request);
    }

    public function showRegister(): View
    {
        return $this->authService->showRegister();
    }

    public function register(StoreUserRequest $request): RedirectResponse
    {
        return $this->authService->register($request);
    }

    public function logout(Request $request): RedirectResponse
    {
        return $this->authService->logout($request);
    }
}
