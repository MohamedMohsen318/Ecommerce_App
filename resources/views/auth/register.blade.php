@extends('layouts.auth')

@section('title', 'Register | ' . config('app.name', 'Ecommerce App'))
@section('hero_title', 'Start with a clean dashboard.')
@section('hero_text', 'Create your admin account and move straight into a stable workspace for the store.')

@section('content')
    <div class="form-head">
        <h2>Create account</h2>
        <p>Enter your details to prepare your dashboard access.</p>
    </div>

    <form method="POST" action="{{ route('register.store') }}" novalidate>
        @csrf

        <div class="field">
            <label for="name">Name</label>
            <input id="name" name="name" type="text" value="{{ old('name') }}" autocomplete="name" required autofocus>
            @error('name')
                <div class="error">{{ $message }}</div>
            @enderror
        </div>

        <div class="field">
            <label for="email">Email address</label>
            <input id="email" name="email" type="email" value="{{ old('email') }}" autocomplete="email" required>
            @error('email')
                <div class="error">{{ $message }}</div>
            @enderror
        </div>

        <div class="field">
            <label for="password">Password</label>
            <input id="password" name="password" type="password" autocomplete="new-password" required>
            @error('password')
                <div class="error">{{ $message }}</div>
            @enderror
        </div>

        <div class="field">
            <label for="password_confirmation">Confirm password</label>
            <input id="password_confirmation" name="password_confirmation" type="password" autocomplete="new-password" required>
        </div>

        <button class="btn-primary" type="submit">Create account</button>
    </form>

    <p class="switch">
        Already registered?
        <a href="{{ route('login') }}">Sign in</a>
    </p>
@endsection
