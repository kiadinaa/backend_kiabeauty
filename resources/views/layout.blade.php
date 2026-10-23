<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'KiaBeauty - Beauty, Made Simple')</title>

    <!-- Google Fonts: DM Sans & Playfair Display from ReactBasic -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,opsz,wght@0,9..40,400..800;1,9..40,400..800&family=Playfair+Display:ital,wght@0,500..800;1,500..800&display=swap" rel="stylesheet">

    <style>
        :root {
            --pink: #d96c91;
            --pink-dark: #A84D70;
            --pink-darker: #8F3E5E;
            --pink-light: #FCE8EF;
            --pink-subtle: #FFF8FA;
            --pink-gradient-start: #F8D7E2;
            --pink-gradient-mid: #FCE7EF;
            --pink-gradient-end: #FFF5F8;
            --text-dark: #2B2024;
            --text-main: #34252C;
            --text-muted: #82747B;
            --text-sub: #6B555D;
            --border-color: #F0E4E9;
            --border-pink: #fecdd3;
            --radius-xl: 24px;
            --radius-lg: 16px;
            --radius-md: 12px;
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: "DM Sans", -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif;
            background-color: #fffafc;
            color: var(--text-main);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            line-height: 1.5;
            -webkit-font-smoothing: antialiased;
        }

        h1, h2, h3, .font-serif {
            font-family: "Playfair Display", Georgia, serif;
        }

        a {
            color: inherit;
            text-decoration: none;
            transition: 0.2s ease;
        }

        img {
            max-width: 100%;
            display: block;
        }

        /* Top Header */
        header.site-header {
            position: sticky;
            top: 0;
            z-index: 50;
            background-color: #ffffff;
            border-bottom: 1px solid var(--border-color);
            box-shadow: 0 1px 3px rgba(0,0,0,0.04);
        }

        .header-top {
            background-color: var(--pink-dark);
        }

        .header-container {
            max-width: 1280px;
            margin: 0 auto;
            padding: 12px 16px;
            display: flex;
            align-items: center;
            gap: 16px;
        }

        .brand-block {
            flex-shrink: 0;
        }

        .brand-title {
            font-family: "DM Sans", sans-serif;
            font-size: 22px;
            font-weight: 700;
            letter-spacing: -0.02em;
            color: #ffffff;
            line-height: 1.1;
        }

        .brand-tagline {
            font-size: 9px;
            letter-spacing: 0.15em;
            color: #fce7ef;
            font-weight: 600;
            text-transform: uppercase;
        }

        .search-form-wrap {
            flex: 1;
            min-width: 0;
            display: flex;
            align-items: center;
            background: #ffffff;
            border-radius: 12px;
            padding: 4px;
        }

        .search-icon {
            padding: 0 10px;
            font-size: 18px;
            color: var(--pink-dark);
            user-select: none;
        }

        .search-input {
            flex: 1;
            min-width: 0;
            background: transparent;
            border: none;
            outline: none;
            padding: 6px 4px;
            font-size: 13px;
            font-family: inherit;
            color: var(--text-dark);
        }

        .search-input::placeholder {
            color: #9ca3af;
        }

        .search-btn {
            background-color: var(--pink-dark);
            color: #ffffff;
            border: none;
            border-radius: 8px;
            padding: 8px 18px;
            font-size: 13px;
            font-weight: 600;
            cursor: pointer;
            transition: background-color 0.2s;
        }

        .search-btn:hover {
            background-color: var(--pink-darker);
        }

        .header-actions {
            display: flex;
            align-items: center;
            gap: 16px;
            flex-shrink: 0;
        }

        .cart-icon-btn, .user-icon-btn {
            position: relative;
            color: #ffffff;
            font-size: 24px;
            line-height: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 4px;
            transition: color 0.2s;
        }

        .cart-icon-btn:hover, .user-icon-btn:hover {
            color: #fce7ef;
        }

        .cart-badge-pill {
            position: absolute;
            top: -4px;
            right: -6px;
            background-color: #ffffff;
            color: var(--pink-dark);
            border-radius: 999px;
            font-size: 10px;
            font-weight: 800;
            height: 18px;
            min-width: 18px;
            padding: 0 4px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        /* Sub Navigation Menu */
        .sub-nav {
            background: #ffffff;
            border-bottom: 1px solid #fce7ef;
            overflow-x: auto;
            white-space: nowrap;
        }

        .sub-nav-container {
            max-width: 1280px;
            margin: 0 auto;
            padding: 8px 16px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .nav-chip {
            padding: 6px 14px;
            border-radius: 999px;
            font-size: 13px;
            font-weight: 600;
            color: var(--text-sub);
            border: 1px solid transparent;
            transition: all 0.2s;
        }

        .nav-chip:hover, .nav-chip.active {
            background-color: var(--pink-light);
            color: var(--pink-dark);
            border-color: #f5c5d6;
        }

        .nav-chip.promo {
            color: var(--pink-dark);
            font-weight: 700;
            background: #fff5f8;
            border-color: #fce7ef;
        }

        .nav-chip.promo:hover, .nav-chip.promo.active {
            background: var(--pink-dark);
            color: #ffffff;
        }

        /* Main Content Container */
        main.main-body {
            flex: 1;
            max-width: 1280px;
            width: 100%;
            margin: 0 auto;
            padding: 24px 16px 48px;
        }

        /* Flash Alerts */
        .alert {
            padding: 12px 18px;
            border-radius: 12px;
            font-size: 13px;
            font-weight: 600;
            margin-bottom: 24px;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .alert-success {
            background-color: #ecfdf5;
            color: #065f46;
            border: 1px solid #a7f3d0;
        }

        .alert-error {
            background-color: #fef2f2;
            color: #991b1b;
            border: 1px solid #fecaca;
        }

        /* Buttons matching ReactBasic */
        .btn-pink {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            background-color: var(--pink-dark);
            color: #ffffff;
            font-size: 14px;
            font-weight: 600;
            padding: 10px 20px;
            border-radius: 12px;
            border: 1px solid var(--pink-dark);
            cursor: pointer;
            transition: all 0.2s;
        }

        .btn-pink:hover {
            background-color: var(--pink-darker);
            border-color: var(--pink-darker);
            transform: translateY(-1px);
        }

        .btn-pink-outline {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            background-color: #ffffff;
            color: var(--pink-dark);
            font-size: 14px;
            font-weight: 600;
            padding: 10px 18px;
            border-radius: 12px;
            border: 1px solid #D98FA7;
            cursor: pointer;
            transition: all 0.2s;
        }

        .btn-pink-outline:hover {
            background-color: var(--pink-light);
            border-color: var(--pink-dark);
        }

        /* Footer matching ReactBasic */
        footer.site-footer {
            background-color: #2B2024;
            color: #ffffff;
            border-top: 1px solid #fce7ef;
            padding: 32px 24px;
            text-align: center;
            margin-top: auto;
        }

        footer .footer-text {
            font-size: 14px;
            color: #ffffff;
            margin-bottom: 4px;
        }

        footer .footer-sub {
            font-size: 11px;
            letter-spacing: 0.15em;
            color: #fbcfe8;
            text-transform: uppercase;
        }

        @media (max-width: 640px) {
            .header-container {
                flex-wrap: wrap;
            }
            .search-form-wrap {
                order: 3;
                width: 100%;
            }
        }
    </style>
    @yield('styles')
</head>
<body>

    <!-- Header Navigation -->
    <header class="site-header">
        <div class="header-top">
            <div class="header-container">
                <!-- Brand -->
                <a href="{{ route('home') }}" class="brand-block">
                    <div class="brand-title">KiaBeauty</div>
                    <div class="brand-tagline">BEAUTY, MADE SIMPLE</div>
                </a>

                <!-- Search Input -->
                <form action="{{ route('shop.index') }}" method="GET" class="search-form-wrap">
                    <span class="search-icon">⌕</span>
                    <input type="search" name="q" value="{{ request('q', request('search')) }}" placeholder="Cari makeup, skincare, atau brand..." class="search-input" aria-label="Cari produk">
                    <button type="submit" class="search-btn">Cari</button>
                </form>

                <!-- Actions -->
                <div class="header-actions">
                    @php
                        $cartCount = array_sum(array_column(session('cart', []), 'quantity'));
                    @endphp
                    <!-- Cart Icon -->
                    <a href="{{ route('cart.index') }}" class="cart-icon-btn" title="Keranjang Belanja">
                        🛒
                        @if($cartCount > 0)
                            <span class="cart-badge-pill">{{ $cartCount }}</span>
                        @endif
                    </a>

                    <!-- User Account / Orders -->
                    @auth
                        <div style="display: flex; align-items: center; gap: 8px;">
                            <a href="{{ route('orders.index') }}" title="Daftar Belanja" class="user-icon-btn" style="font-size: 18px; background: rgba(255,255,255,0.15); padding: 4px 10px; border-radius: 999px; font-size: 12px; font-weight: 700;">
                                📦 Pesanan
                            </a>
                            <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                                @csrf
                                <button type="submit" style="background: transparent; border: 1px solid rgba(255,255,255,0.4); color: white; border-radius: 999px; padding: 4px 10px; font-size: 11px; font-weight: 700; cursor: pointer;">
                                    Keluar
                                </button>
                            </form>
                        </div>
                    @else
                        <a href="{{ route('login') }}" class="user-icon-btn" title="Masuk Akun">
                            👤
                        </a>
                    @endauth
                </div>
            </div>
        </div>

        <!-- Sub Navbar Categories -->
        <nav class="sub-nav">
            <div class="sub-nav-container">
                <a href="{{ route('home') }}" class="nav-chip {{ request()->routeIs('home') ? 'active' : '' }}">
                    Beranda
                </a>
                <a href="{{ route('shop.index') }}" class="nav-chip {{ request()->routeIs('shop.index') && !request('category') && !request('discount_only') ? 'active' : '' }}">
                    Semua Produk
                </a>
                <a href="{{ route('shop.index', ['category' => 'Makeup']) }}" class="nav-chip {{ request('category') === 'Makeup' ? 'active' : '' }}">
                    ✨ Makeup
                </a>
                <a href="{{ route('shop.index', ['category' => 'Skincare']) }}" class="nav-chip {{ request('category') === 'Skincare' ? 'active' : '' }}">
                    💧 Skincare
                </a>
                <a href="{{ route('shop.index', ['discount_only' => 1]) }}" class="nav-chip promo {{ request('discount_only') ? 'active' : '' }}">
                    🏷️ Promo Diskon
                </a>
                <a href="{{ route('orders.index') }}" class="nav-chip {{ request()->routeIs('orders.*') ? 'active' : '' }}">
                    📦 Daftar Belanja
                </a>
                <span style="border-left: 1px solid #fecdd3; height: 16px; margin: 0 4px;"></span>
                <a href="{{ route('about') }}" class="nav-chip {{ request()->routeIs('about') ? 'active' : '' }}">
                    Tentang Kami
                </a>
                <a href="{{ route('contact') }}" class="nav-chip {{ request()->routeIs('contact') ? 'active' : '' }}">
                    Bantuan
                </a>
            </div>
        </nav>
    </header>

    <!-- Main Content -->
    <main class="main-body">
        @if(session('success'))
            <div class="alert alert-success">
                <span>✓ {{ session('success') }}</span>
                <span style="cursor: pointer;" onclick="this.parentElement.remove()">✕</span>
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-error">
                <span>⚠ {{ session('error') }}</span>
                <span style="cursor: pointer;" onclick="this.parentElement.remove()">✕</span>
            </div>
        @endif

        @yield('content')
    </main>

    <!-- Footer matching ReactBasic -->
    <footer class="site-footer">
        <p class="footer-text">
            &copy; 2026 KiaBeauty. All rights reserved.
        </p>
        <p class="footer-sub">
            BEAUTY, MADE SIMPLE
        </p>
    </footer>

    @yield('scripts')
</body>
</html>
