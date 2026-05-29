<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', config('app.name', 'Ecommerce App'))</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700,800" rel="stylesheet">
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @endif
    <style>
        :root {
            color-scheme: light;
            --ink: #18202f;
            --muted: #687386;
            --line: #dfe6ee;
            --panel: #ffffff;
            --page: #f4f7fa;
            --side: #111827;
            --accent: #0f766e;
            --accent-strong: #0b5f59;
        }

        * { box-sizing: border-box; }

        body {
            margin: 0;
            min-height: 100vh;
            font-family: 'Instrument Sans', ui-sans-serif, system-ui, sans-serif;
            background: var(--page);
            color: var(--ink);
        }

        a { color: inherit; text-decoration: none; }
        button, input { font: inherit; }

        .shell {
            display: grid;
            grid-template-columns: 270px minmax(0, 1fr);
            min-height: 100vh;
        }

        .sidebar {
            position: sticky;
            top: 0;
            height: 100vh;
            padding: 22px 16px;
            background: var(--side);
            color: #f8fafc;
            display: flex;
            flex-direction: column;
            gap: 22px;
        }

        .brand {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 0 8px;
        }

        .brand-mark {
            width: 42px;
            height: 42px;
            border-radius: 8px;
            display: grid;
            place-items: center;
            background: var(--accent);
            color: white;
            font-weight: 900;
        }

        .brand strong { display: block; font-size: 16px; }
        .brand span span { color: #9aa7bd; font-size: 13px; }

        .nav {
            display: grid;
            gap: 6px;
        }

        .nav a {
            display: flex;
            align-items: center;
            gap: 10px;
            min-height: 42px;
            padding: 10px 12px;
            border-radius: 8px;
            color: #cbd5e1;
            font-weight: 700;
        }

        .nav a.is-active,
        .nav a:hover {
            background: rgba(255, 255, 255, .1);
            color: white;
        }

        .nav-icon {
            width: 28px;
            height: 28px;
            border-radius: 7px;
            display: grid;
            place-items: center;
            background: rgba(255, 255, 255, .08);
            font-size: 13px;
            font-weight: 900;
        }

        .sidebar-footer {
            margin-top: auto;
            padding: 14px;
            border: 1px solid rgba(255, 255, 255, .12);
            border-radius: 8px;
            background: rgba(255, 255, 255, .05);
        }

        .sidebar-footer span {
            display: block;
            color: #9aa7bd;
            font-size: 12px;
            margin-bottom: 4px;
        }

        .sidebar-footer strong {
            display: block;
            overflow-wrap: anywhere;
            font-size: 14px;
        }

        .main {
            min-width: 0;
            display: flex;
            flex-direction: column;
        }

        .topbar {
            position: sticky;
            top: 0;
            z-index: 10;
            min-height: 76px;
            padding: 16px 28px;
            background: rgba(244, 247, 250, .94);
            backdrop-filter: blur(16px);
            border-bottom: 1px solid var(--line);
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 16px;
        }

        .page-title h1 {
            margin: 0;
            font-size: 25px;
            line-height: 1.2;
        }

        .page-title p {
            margin: 4px 0 0;
            color: var(--muted);
            font-size: 14px;
        }

        .actions {
            display: flex;
            align-items: center;
            gap: 10px;
            flex-wrap: wrap;
            justify-content: flex-end;
        }

        .btn {
            min-height: 40px;
            border-radius: 8px;
            border: 1px solid var(--line);
            background: var(--panel);
            color: var(--ink);
            padding: 0 14px;
            font-weight: 800;
            cursor: pointer;
        }

        .btn-primary {
            border-color: var(--accent);
            background: var(--accent);
            color: white;
        }

        .content {
            width: 100%;
            max-width: 1220px;
            margin: 0 auto;
            padding: 28px;
        }

        .alert {
            margin-bottom: 18px;
            padding: 14px 16px;
            border-radius: 8px;
            background: #e7f6f2;
            color: var(--accent-strong);
            border: 1px solid #bfe5dc;
            font-weight: 700;
        }

        @media (max-width: 880px) {
            .shell { grid-template-columns: 1fr; }

            .sidebar {
                position: relative;
                height: auto;
                padding: 16px;
            }

            .nav {
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }

            .sidebar-footer { display: none; }

            .topbar {
                position: relative;
                padding: 16px;
                align-items: flex-start;
                flex-direction: column;
            }

            .actions { justify-content: flex-start; }
            .content { padding: 18px 16px 28px; }
        }
    </style>
    @stack('styles')
</head>
@php
    $dashboardGuard = trim($__env->yieldContent('auth_guard', 'web'));
    $dashboardRoute = trim($__env->yieldContent('dashboard_route', 'welcome'));
    $logoutRoute = trim($__env->yieldContent('logout_route', 'logout'));
    $signedInUser = auth()->guard($dashboardGuard)->user();
@endphp
<body>
    <div class="shell">
        <aside class="sidebar" aria-label="Dashboard navigation">
            <a class="brand" href="{{ route($dashboardRoute) }}">
                <span class="brand-mark">EC</span>
                <span>
                    <strong>Ecommerce App</strong>
                    <span>Admin workspace</span>
                </span>
            </a>

            <nav class="nav">
                <a class="is-active" href="{{ route($dashboardRoute) }}"><span class="nav-icon">D</span> Dashboard</a>
                <a href="{{ route($dashboardRoute) }}"><span class="nav-icon">P</span> Products</a>
                <a href="{{ route($dashboardRoute) }}"><span class="nav-icon">O</span> Orders</a>
                <a href="{{ route($dashboardRoute) }}"><span class="nav-icon">$</span> Sales</a>
                <a href="{{ route($dashboardRoute) }}"><span class="nav-icon">C</span> Customers</a>
                <a href="{{ route($dashboardRoute) }}"><span class="nav-icon">S</span> Settings</a>
            </nav>

            <div class="sidebar-footer">
                <span>Signed in as</span>
                <strong>{{ $signedInUser?->name ?? 'Admin' }}</strong>
            </div>
        </aside>

        <main class="main">
            <header class="topbar">
                <div class="page-title">
                    <h1>@yield('page_title', 'Dashboard')</h1>
                    <p>@yield('page_description', 'Track store performance and daily operations.')</p>
                </div>
                <div class="actions">
                    @yield('actions')
                    <form method="POST" action="{{ route($logoutRoute) }}">
                        @csrf
                        <button class="btn" type="submit">Logout</button>
                    </form>
                </div>
            </header>

            <section class="content">
                @if (session('success'))
                    <div class="alert">{{ session('success') }}</div>
                @endif

                @yield('content')
            </section>
        </main>
    </div>
</body>
</html>
