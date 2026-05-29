@extends('layouts.auth')

@section('title', 'Login | ' . config('app.name', 'Ecommerce App'))
@section('hero_title', 'Welcome back to your store.')
@section('hero_text', 'Open the dashboard, check what changed today, and keep every order moving.')

@section('content')
    <div class="form-head">
        <h2>Sign in</h2>
        <p>Use your account email and password to continue.</p>
    </div>

    <form method="POST" action="{{ route('login.store') }}" novalidate>
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
        New here?
        <a href="{{ route('register') }}">Create an account</a>
    </p>
@endsection
