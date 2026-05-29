<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Home | {{ config('app.name', 'Ecommerce App') }}</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700,800" rel="stylesheet">
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @endif
    <style>
        :root {
            color-scheme: light;
            --ink: #18202f;
            --muted: #667085;
            --line: #dce4ee;
            --paper: #ffffff;
            --page: #f6f8fb;
            --teal: #0f766e;
            --teal-soft: #e7f6f2;
            --blue: #3157d5;
            --rose: #c0265c;
            --amber: #c27803;
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
        button { font: inherit; }

        .site {
            min-height: 100vh;
        }

        .home-nav {
            position: sticky;
            top: 0;
            z-index: 20;
            border-bottom: 1px solid rgba(220, 228, 238, .9);
            background: rgba(246, 248, 251, .94);
            backdrop-filter: blur(14px);
        }

        .nav-inner {
            width: min(1180px, calc(100% - 32px));
            min-height: 74px;
            margin: 0 auto;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 18px;
        }

        .logo {
            display: inline-flex;
            align-items: center;
            gap: 12px;
            font-weight: 800;
        }

        .logo-mark {
            width: 42px;
            height: 42px;
            border-radius: 8px;
            display: grid;
            place-items: center;
            background: var(--ink);
            color: white;
            letter-spacing: 0;
        }

        .nav-actions,
        .hero-actions,
        .category-row {
            display: flex;
            align-items: center;
            gap: 10px;
            flex-wrap: wrap;
        }

        .nav-actions { justify-content: flex-end; }

        .home-btn {
            min-height: 42px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border-radius: 8px;
            border: 1px solid var(--line);
            background: var(--paper);
            padding: 0 15px;
            font-weight: 800;
            cursor: pointer;
            transition: transform .18s ease, border-color .18s ease, background .18s ease;
        }

        .home-btn:hover {
            border-color: #b7c4d4;
            transform: translateY(-1px);
        }

        .home-btn.primary {
            border-color: var(--teal);
            background: var(--teal);
            color: white;
        }

        .home-btn.dark {
            border-color: var(--ink);
            background: var(--ink);
            color: white;
        }

        .hero-band {
            background: var(--paper);
            border-bottom: 1px solid var(--line);
        }

        .hero {
            width: min(1180px, calc(100% - 32px));
            min-height: calc(100vh - 180px);
            margin: 0 auto;
            padding: 42px 0;
            display: grid;
            grid-template-columns: minmax(0, 1.02fr) minmax(360px, .98fr);
            gap: 42px;
            align-items: center;
        }

        .hero-copy {
            max-width: 640px;
        }

        .eyebrow {
            display: inline-flex;
            align-items: center;
            min-height: 32px;
            padding: 0 12px;
            border-radius: 999px;
            background: var(--teal-soft);
            color: #0c615b;
            font-size: 13px;
            font-weight: 800;
        }

        h1 {
            margin: 18px 0 16px;
            font-size: clamp(42px, 7vw, 78px);
            line-height: .98;
            letter-spacing: 0;
        }

        .lead {
            margin: 0;
            max-width: 560px;
            color: var(--muted);
            font-size: 18px;
            line-height: 1.65;
        }

        .hero-actions {
            margin-top: 28px;
        }

        .hero-media {
            min-height: 560px;
            border-radius: 8px;
            overflow: hidden;
            position: relative;
            background:
                linear-gradient(180deg, rgba(24, 32, 47, .04), rgba(24, 32, 47, .68)),
                url('https://images.unsplash.com/photo-1523275335684-37898b6baf30?auto=format&fit=crop&w=1300&q=82');
            background-size: cover;
            background-position: center;
            box-shadow: 0 24px 60px rgba(24, 32, 47, .14);
        }

        .hero-product {
            position: absolute;
            left: 22px;
            right: 22px;
            bottom: 22px;
            display: grid;
            grid-template-columns: minmax(0, 1fr) auto;
            gap: 14px;
            align-items: end;
            color: white;
        }

        .hero-product span {
            display: block;
            color: rgba(255, 255, 255, .78);
            font-weight: 800;
            margin-bottom: 5px;
        }

        .hero-product strong {
            display: block;
            font-size: 34px;
            line-height: 1.05;
        }

        .hero-price {
            min-width: 104px;
            min-height: 62px;
            border-radius: 8px;
            display: grid;
            place-items: center;
            background: rgba(255, 255, 255, .94);
            color: var(--ink);
            font-size: 24px;
            font-weight: 900;
        }

        .section {
            width: min(1180px, calc(100% - 32px));
            margin: 0 auto;
            padding: 34px 0;
        }

        .section-head {
            display: flex;
            align-items: end;
            justify-content: space-between;
            gap: 16px;
            margin-bottom: 18px;
        }

        .section-head h2 {
            margin: 0;
            font-size: 28px;
            line-height: 1.15;
        }

        .section-head p {
            margin: 6px 0 0;
            color: var(--muted);
        }

        .category-row {
            align-items: stretch;
            margin-bottom: 22px;
        }

        .category {
            min-height: 46px;
            display: inline-flex;
            align-items: center;
            gap: 9px;
            padding: 0 14px;
            border-radius: 8px;
            border: 1px solid var(--line);
            background: var(--paper);
            font-weight: 800;
        }

        .dot {
            width: 10px;
            height: 10px;
            border-radius: 50%;
            background: var(--teal);
        }

        .dot.blue { background: var(--blue); }
        .dot.rose { background: var(--rose); }
        .dot.amber { background: var(--amber); }

        .product-grid {
            display: grid;
            grid-template-columns: repeat(4, minmax(0, 1fr));
            gap: 16px;
        }

        .product-card {
            min-height: 360px;
            display: flex;
            flex-direction: column;
            border-radius: 8px;
            border: 1px solid var(--line);
            background: var(--paper);
            overflow: hidden;
        }

        .product-photo {
            min-height: 220px;
            background-size: cover;
            background-position: center;
        }

        .product-body {
            flex: 1;
            display: flex;
            flex-direction: column;
            gap: 8px;
            padding: 16px;
        }

        .product-body strong {
            font-size: 17px;
            line-height: 1.25;
        }

        .product-body span {
            color: var(--muted);
            font-size: 14px;
            line-height: 1.45;
        }

        .product-foot {
            margin-top: auto;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 10px;
            font-weight: 900;
        }

        .mini-btn {
            min-height: 34px;
            border-radius: 8px;
            border: 1px solid var(--ink);
            background: var(--ink);
            color: white;
            padding: 0 11px;
            font-weight: 800;
        }

        .trust-strip {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 14px;
            padding-bottom: 42px;
        }

        .trust-item {
            min-height: 112px;
            padding: 18px;
            border-radius: 8px;
            border: 1px solid var(--line);
            background: var(--paper);
        }

        .trust-item strong {
            display: block;
            margin-bottom: 7px;
            font-size: 16px;
        }

        .trust-item span {
            color: var(--muted);
            line-height: 1.55;
        }

        @media (max-width: 980px) {
            .hero {
                grid-template-columns: 1fr;
                min-height: auto;
            }

            .hero-media {
                min-height: 440px;
            }

            .product-grid {
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }
        }

        @media (max-width: 640px) {
            .nav-inner {
                align-items: flex-start;
                flex-direction: column;
                padding: 16px 0;
            }

            .nav-actions,
            .hero-actions {
                width: 100%;
            }

            .nav-actions .home-btn,
            .hero-actions .home-btn {
                flex: 1;
            }

            .hero,
            .section {
                width: min(100% - 24px, 1180px);
            }

            .hero {
                padding: 28px 0;
            }

            .hero-media {
                min-height: 360px;
            }

            .hero-product {
                grid-template-columns: 1fr;
            }

            .hero-product strong {
                font-size: 28px;
            }

            .hero-price {
                width: fit-content;
                min-height: 48px;
                padding: 0 16px;
            }

            .section-head {
                align-items: flex-start;
                flex-direction: column;
            }

            .product-grid,
            .trust-strip {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>
    <div class="site">
        <nav class="home-nav" aria-label="Main navigation">
            <div class="nav-inner">
                <a class="logo" href="{{ route('welcome') }}">
                    <span class="logo-mark">EC</span>
                    <span>{{ config('app.name', 'Ecommerce App') }}</span>
                </a>

                <div class="nav-actions">
                    <a class="home-btn" href="{{ route('welcome') }}">Home</a>
                    <a class="home-btn" href="#">Items</a>
                    <a class="home-btn" href="#">Category</a>

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button class="home-btn dark" type="submit">Logout</button>
                    </form>
                </div>
            </div>
        </nav>

        <main>
            <section class="hero-band">
                <div class="hero">
                    <div class="hero-copy">
                        <span class="eyebrow">New collection is live</span>
                        <h1>Fresh picks for everyday shopping.</h1>
                        <p class="lead">
                            Discover clean essentials, useful tech, and smart accessories selected for fast checkout and simple daily use.
                        </p>
                        <div class="hero-actions">
                            <a class="home-btn primary" href="#">Shop products</a>
                            <a class="home-btn" href="#">Explore categories</a>
                        </div>
                    </div>

                    <aside class="hero-media" aria-label="Featured product">
                        <div class="hero-product">
                            <div>
                                <span>Featured today</span>
                                <strong>Minimal smart watch with all-day comfort</strong>
                            </div>
                            <div class="hero-price">$129</div>
                        </div>
                    </aside>
                </div>
            </section>

            <section id="categories" class="section" aria-label="Product categories">
                <div class="section-head">
                    <div>
                        <h2>Shop by category</h2>
                        <p>Quick routes into the items customers ask for most.</p>
                    </div>
                </div>

                <div class="category-row">
                    <a class="category" href="#"><span class="dot"></span> Bags</a>

                </div>
            </section>

            <section id="products" class="section" aria-label="Featured products">
                <div class="section-head">
                    <div>
                        <h2>Featured items</h2>
                        <p>Ready-to-buy products with a cleaner storefront feel.</p>
                    </div>
                    <a class="home-btn" href="{{ route('welcome') }}">View all</a>
                </div>

                <div class="product-grid">
                    <article class="product-card">
                        <div class="product-photo" style="background-image:url('https://images.unsplash.com/photo-1553062407-98eeb64c6a62?auto=format&fit=crop&w=900&q=80')"></div>
                        <div class="product-body">
                            <strong>Everyday backpack</strong>
                            <span>Lightweight storage with tidy compartments for work and travel.</span>
                            <div class="product-foot">
                                <span>$68</span>
                                <button class="mini-btn" type="button">Add</button>
                            </div>
                        </div>
                    </article>

                </div>
            </section>

            <section class="section trust-strip" aria-label="Store highlights">
                <article class="trust-item">
                    <strong>Fast checkout</strong>
                    <span>Clear product cards and direct actions keep shopping simple.</span>
                </article>
                <article class="trust-item">
                    <strong>Curated catalog</strong>
                    <span>Category blocks and featured items make the page feel like a real shop.</span>
                </article>
                <article class="trust-item">
                    <strong>Admin ready</strong>
                    <span>The storefront stays separate from the dashboard workflow.</span>
                </article>
            </section>
        </main>
    </div>
</body>
</html>
