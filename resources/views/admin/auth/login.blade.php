@extends('layouts.auth')

@section('title', 'Admin Login | ' . config('app.name', 'Ecommerce App'))
@section('hero_title', 'Control the store from one focused place.')
@section('hero_text', 'Sign in as an admin to review orders, products, customers, and daily store activity.')

@section('content')
    <div class="form-head">
        <h2>Admin sign in</h2>
        <p>Use your admin email and password to continue.</p>
    </div>

    <form method="POST" action="{{ route('admin.login.store') }}" novalidate>
        @csrf

        <div class="field">
            <label for="email">Email address</label>
            <input id="email" name="email" type="email" value="{{ old('email') }}" autocomplete="email" required autofocus>
            @error('email')
                <div class="error">{{ $message }}</div>
            @enderror
        </div>

        <div class="field">
            <label for="password">Password</label>
            <input id="password" name="password" type="password" autocomplete="current-password" required>
            @error('password')
                <div class="error">{{ $message }}</div>
            @enderror
        </div>

        <label class="check-row" for="remember">
            <input id="remember" name="remember" type="checkbox" value="1" @checked(old('remember'))>
            <span>Remember me</span>
        </label>

        <button class="btn-primary" type="submit">Sign in</button>
    </form>

    <p class="switch">
        User account?
        <a href="{{ route('login') }}">Go to user sign in</a>
    </p>
@endsection
