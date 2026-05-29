<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', config('app.name', 'Ecommerce App'))</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700" rel="stylesheet">
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @endif
    <style>
        * { box-sizing: border-box; }
        body {
            margin: 0;
            min-height: 100vh;
            font-family: 'Instrument Sans', ui-sans-serif, system-ui, sans-serif;
            background: #f5f7fb;
            color: #172033;
        }

        a { color: inherit; }
        button, input { font: inherit; }

        .auth-shell {
            min-height: 100vh;
            display: grid;
            grid-template-columns: minmax(0, 1fr) 460px;
        }

        .auth-visual {
            padding: 48px;
            background:
                linear-gradient(135deg, rgba(15, 143, 131, .92), rgba(16, 24, 39, .96)),
                url('https://images.unsplash.com/photo-1556742049-0cfed4f6a45d?auto=format&fit=crop&w=1600&q=80');
            background-size: cover;
            background-position: center;
            color: white;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .brand {
            display: inline-flex;
            align-items: center;
            gap: 12px;
            font-weight: 800;
            text-decoration: none;
        }

        .brand-mark {
            width: 42px;
            height: 42px;
            border-radius: 8px;
            display: grid;
            place-items: center;
            background: white;
            color: #0f8f83;
        }

        .visual-copy {
            max-width: 620px;
        }

        .visual-copy h1 {
            margin: 0 0 14px;
            font-size: clamp(34px, 5vw, 58px);
            line-height: 1;
            letter-spacing: 0;
        }

        .visual-copy p {
            margin: 0;
            max-width: 540px;
            color: rgba(255, 255, 255, .84);
            font-size: 17px;
            line-height: 1.7;
        }

        .auth-panel {
            padding: 36px;
            background: white;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .form-wrap {
            width: 100%;
            max-width: 360px;
        }

        .form-head { margin-bottom: 24px; }
        .form-head h2 {
            margin: 0 0 8px;
            font-size: 28px;
            line-height: 1.2;
        }
        .form-head p {
            margin: 0;
            color: #697386;
            line-height: 1.5;
        }

        .field { margin-bottom: 16px; }
        .field label {
            display: block;
            margin-bottom: 7px;
            font-weight: 700;
            font-size: 14px;
        }
        .field input {
            width: 100%;
            min-height: 44px;
            border: 1px solid #d7dce5;
            border-radius: 8px;
            padding: 10px 12px;
            outline: none;
        }
        .field input:focus {
            border-color: #0f8f83;
            box-shadow: 0 0 0 3px rgba(15, 143, 131, .14);
        }

        .error {
            margin-top: 6px;
            color: #b4233c;
            font-size: 13px;
            font-weight: 600;
        }

        .alert {
            margin-bottom: 18px;
            padding: 12px 14px;
            border-radius: 8px;
            background: #e9fbf7;
            color: #075f57;
            border: 1px solid #bbefe5;
            font-weight: 600;
        }

        .check-row {
            display: flex;
            align-items: center;
            gap: 8px;
            margin: 4px 0 18px;
            color: #4b5565;
            font-size: 14px;
        }
        .check-row input { width: 16px; height: 16px; accent-color: #0f8f83; }

        .btn-primary {
            width: 100%;
            min-height: 46px;
            border: 0;
            border-radius: 8px;
            background: #0f8f83;
            color: white;
            font-weight: 800;
            cursor: pointer;
        }

        .switch {
            margin-top: 20px;
            color: #697386;
            text-align: center;
        }
        .switch a {
            color: #0a6f67;
            font-weight: 800;
            text-decoration: none;
        }

        @media (max-width: 860px) {
            .auth-shell { grid-template-columns: 1fr; }
            .auth-visual {
                min-height: 260px;
                padding: 28px;
            }
            .auth-panel { padding: 28px 18px; }
        }
    </style>
</head>
<body>
    <div class="auth-shell">
        <section class="auth-visual">
            <a class="brand" href="{{ route('login') }}">
                <span class="brand-mark">EC</span>
                <span>Ecommerce App</span>
            </a>
            <div class="visual-copy">
                <h1>@yield('hero_title', 'Manage your store with clarity.')</h1>
                <p>@yield('hero_text', 'Sign in to review orders, follow sales, and keep daily ecommerce work moving from one focused dashboard.')</p>
            </div>
        </section>

        <main class="auth-panel">
            <div class="form-wrap">
                @if (session('success'))
                    <div class="alert">{{ session('success') }}</div>
                @endif

                @yield('content')
            </div>
        </main>
    </div>
</body>
</html>
