<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\Admin\AdminAuthController;
use Illuminate\Support\Facades\Route;

// Guest Routes
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])
        ->name('login');
    Route::post('/login', [AuthController::class, 'login'])
        ->name('login.store');

    Route::get('/register', [AuthController::class, 'showRegister'])
        ->name('register');
    Route::post('/register', [AuthController::class, 'register'])
        ->name('register.store');
});

// Admin Routes
Route::prefix('admin')->name('admin.')->group(function () {
    Route::middleware('guest:admin')->group(function () {
        Route::get('/login', [AdminAuthController::class, 'showLoginForm'])
            ->name('login');
        Route::post('/login', [AdminAuthController::class, 'login'])
            ->name('login.store');
    });

    Route::middleware(['auth:admin', 'superadmin'])->group(function () {
        Route::post('/logout', [AdminAuthController::class, 'logout'])
            ->name('logout');

        Route::get('/dashboard', function () {
            return view('dashboard');
        })->name('dashboard');
    });
});

// Auth Routes
Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])
        ->name('logout');

    Route::get('/', function () {
        return view('home');
    })->name('welcome');
});
