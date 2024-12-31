<!doctype html>
<html lang="tr" data-bs-theme="light">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'HawkMarkt')</title>
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        :root {
            /* Light Theme */
            --hawk-primary-light: #ffffff;
            --hawk-secondary-light: #6200ea;
            --hawk-accent-light: #b388ff;
            --hawk-text-light: #2c3e50;
            --hawk-text-secondary-light: #606060;
            --hawk-bg-light: #ffffff;
            --hawk-card-bg-light: #ffffff;
            --hawk-border-light: #e0e0e0;
            --hawk-hover-light: #f6f3ff;

            /* Dark Theme */
            --hawk-primary-dark: #121212;
            --hawk-secondary-dark: #b388ff;
            --hawk-accent-dark: #7c4dff;
            --hawk-text-dark: #ffffff;
            --hawk-text-secondary-dark: #b0b0b0;
            --hawk-bg-dark: #121212;
            --hawk-card-bg-dark: #1e1e1e;
            --hawk-border-dark: #2d2d2d;
            --hawk-hover-dark: #2d2d2d;
        }

        [data-bs-theme="light"] {
            --hawk-primary: var(--hawk-primary-light);
            --hawk-secondary: var(--hawk-secondary-light);
            --hawk-accent: var(--hawk-accent-light);
            --hawk-text: var(--hawk-text-light);
            --hawk-text-secondary: var(--hawk-text-secondary-light);
            --hawk-bg: var(--hawk-bg-light);
            --hawk-card-bg: var(--hawk-card-bg-light);
            --hawk-border: var(--hawk-border-light);
            --hawk-hover: var(--hawk-hover-light);
        }

        [data-bs-theme="dark"] {
            --hawk-primary: var(--hawk-primary-dark);
            --hawk-secondary: var(--hawk-secondary-dark);
            --hawk-accent: var(--hawk-accent-dark);
            --hawk-text: var(--hawk-text-dark);
            --hawk-text-secondary: var(--hawk-text-secondary-dark);
            --hawk-bg: var(--hawk-bg-dark);
            --hawk-card-bg: var(--hawk-card-bg-dark);
            --hawk-border: var(--hawk-border-dark);
            --hawk-hover: var(--hawk-hover-dark);
        }

        body {
            background-color: var(--hawk-bg);
            color: var(--hawk-text);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            transition: all 0.3s ease;
        }

        .content-wrapper {
            flex: 1 0 auto;
        }

        .navbar {
            background-color: var(--hawk-primary) !important;
            border-bottom: 1px solid var(--hawk-border);
            transition: all 0.3s ease;
        }

        .navbar-brand {
            font-size: 1.8rem;
            font-weight: 800;
            background: linear-gradient(45deg, #6200ea, #b388ff);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            text-transform: uppercase;
            letter-spacing: 1px;
            display: flex;
            align-items: center;
        }

        .hawk-logo {
            height: 40px;
            margin-right: 10px;
            transition: all 0.3s ease;
        }

        .nav-link {
            color: var(--hawk-text) !important;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .nav-link:hover {
            color: var(--hawk-accent) !important;
        }

        /* Animasyonlu Theme Switch */
        .theme-switch-wrapper {
            position: relative;
            width: 60px;
            height: 30px;
            margin: 0 15px;
        }

        .theme-switch {
            opacity: 0;
            width: 0;
            height: 0;
        }

        .theme-switch-label {
            position: absolute;
            top: 0;
            left: 0;
            width: 60px;
            height: 30px;
            background: linear-gradient(145deg, #6200ea, #b388ff);
            border-radius: 15px;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .theme-switch-label:after {
            content: '';
            position: absolute;
            top: 3px;
            left: 3px;
            width: 24px;
            height: 24px;
            background-color: white;
            border-radius: 50%;
            transition: all 0.3s ease;
            box-shadow: 0 2px 4px rgba(0,0,0,0.2);
        }

        .theme-switch:checked + .theme-switch-label {
            background: linear-gradient(145deg, #7c4dff, #b388ff);
        }

        .theme-switch:checked + .theme-switch-label:after {
            transform: translateX(30px);
        }

        .theme-switch-icons {
            position: absolute;
            width: 100%;
            height: 100%;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0 8px;
            color: white;
            z-index: 1;
            pointer-events: none;
        }

        .theme-switch-icons i {
            font-size: 14px;
        }

        /* Card Styles */
        .card {
            background-color: var(--hawk-card-bg);
            border: 1px solid var(--hawk-border);
            transition: all 0.3s ease;
        }

        .card:hover {
            transform: translateY(-5px);
            border-color: var(--hawk-accent);
            box-shadow: 0 8px 15px rgba(98, 0, 234, 0.1);
        }

        .card-title {
            color: var(--hawk-text);
            font-weight: 600;
        }

        /* Button Styles */
        .btn-primary {
            background: linear-gradient(145deg, #6200ea, #7c4dff);
            border: none;
            transition: all 0.3s ease;
        }

        .btn-primary:hover {
            background: linear-gradient(145deg, #7c4dff, #6200ea);
            transform: translateY(-2px);
            box-shadow: 0 4px 10px rgba(98, 0, 234, 0.2);
        }

        /* Badge Styles */
        .badge.bg-accent {
            background: linear-gradient(145deg, #6200ea, #7c4dff) !important;
            color: white;
        }

        /* Footer Styles */
        footer {
            background-color: var(--hawk-primary);
            border-top: 1px solid var(--hawk-border);
            color: var(--hawk-text);
            padding: 2rem 0;
            margin-top: auto;
            transition: all 0.3s ease;
        }

        footer a {
            color: var(--hawk-accent) !important;
            text-decoration: none;
            transition: all 0.3s ease;
        }

        footer a:hover {
            color: var(--hawk-text) !important;
        }

        .text-accent {
            color: var(--hawk-accent) !important;
        }

        /* Page Transition Animation */
        .page-transition {
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .page-transition.visible {
            opacity: 1;
        }

        /* Product Card Specific Styles */
        .product-card {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .product-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 15px rgba(98, 0, 234, 0.1);
        }

        /* Price Tag Styles */
        .price-tag {
            color: var(--hawk-accent);
            font-weight: bold;
            font-size: 1.2rem;
        }

        /* Category Sidebar Styles */
        .category-sidebar {
            background: var(--hawk-card-bg);
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.05);
            transition: all 0.3s ease;
        }

        .category-sidebar .list-group-item {
            background: transparent;
            border-color: var(--hawk-border);
            color: var(--hawk-text);
            transition: all 0.3s ease;
        }

        .category-sidebar .list-group-item:hover {
            background: var(--hawk-hover);
            color: var(--hawk-accent);
        }

        .category-sidebar .list-group-item.active {
            background: linear-gradient(145deg, #6200ea, #7c4dff);
            border-color: transparent;
            color: white;
        }

        /* Input Field Styles */
        .form-control {
            background-color: var(--hawk-bg);
            border-color: var(--hawk-border);
            color: var(--hawk-text);
            transition: all 0.3s ease;
        }

        .alert-container {
            position: fixed;
            top: 20px;
            left: 50%;
            transform: translateX(-50%);
            z-index: 1050;
            max-width: 500px;
            width: 90%;
        }

        .alert {
            margin-bottom: 0;
            box-shadow: 0 0 15px rgba(0,0,0,0.1);
        }
        .form-control:focus {
            border-color: var(--hawk-accent);
            box-shadow: 0 0 0 0.2rem rgba(98, 0, 234, 0.25);
        }

        /* Custom Scrollbar */
        ::-webkit-scrollbar {
            width: 8px;
        }

        ::-webkit-scrollbar-track {
            background: var(--hawk-bg);
        }

        ::-webkit-scrollbar-thumb {
            background: var(--hawk-accent);
            border-radius: 4px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: var(--hawk-secondary);
        }
    </style>
</head>
<body class="page-transition">
    @if(session('success'))
        <div class="alert-container">
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>

                @if(session('showCartOptions'))
                    <div class="mt-2">
                        <a href="{{ route('cart.index') }}" class="btn btn-sm btn-primary me-2">
                            <i class="fas fa-shopping-cart me-1"></i>Sepete Git
                        </a>
                        <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="alert">
                            <i class="fas fa-shopping-bag me-1"></i>Alışverişe Devam Et
                        </button>
                    </div>
                @endif
            </div>
        </div>
    @endif
    <div class="content-wrapper">
        <nav class="navbar navbar-expand-lg">
            <div class="container">
                <a class="navbar-brand" href="/">
                    <i class="fas fa-store me-2"></i>HAWKMARKT
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav me-auto">
                        <li class="nav-item">
                            <a class="nav-link {{ request()->is('/') ? 'active' : '' }}" href="/">
                                <i class="fas fa-home me-1"></i>Anasayfa
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->is('kategoriler*') ? 'active' : '' }}" href="/kategoriler">
                                <i class="fas fa-tags me-1"></i>Kategoriler
                            </a>
                        </li>
                    </ul>
                    <ul class="navbar-nav align-items-center">
                        <li class="nav-item">
                            <div class="theme-switch-wrapper">
                                <input type="checkbox" class="theme-switch" id="theme-switch">
                                <label class="theme-switch-label" for="theme-switch">
                                    <div class="theme-switch-icons">
                                        <i class="fas fa-sun"></i>
                                        <i class="fas fa-moon"></i>
                                    </div>
                                </label>
                            </div>
                        </li>
                        @auth
                            <li class="nav-item">
                                <a class="nav-link {{ request()->is('sepetim*') ? 'active' : '' }}" href="{{ route('cart.index') }}">
                                    <i class="fas fa-shopping-cart me-1"></i>Sepetim
                                    @php
                                        $cartItemCount = Auth::user()->carts()
                                            ->where('is_active', true)
                                            ->first()?->details()
                                            ->sum('quantity');
                                    @endphp
                                    @if($cartItemCount > 0)
                                        <span class="badge bg-primary">{{ $cartItemCount }}</span>
                                    @endif
                                </a>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown">
                                    <i class="fas fa-user me-1"></i>{{ Auth::user()->name }}
                                </a>
                                <ul class="dropdown-menu dropdown-menu-end">
                                    <li>
                                        <form action="{{ route('logout') }}" method="POST">
                                            @csrf
                                            <button type="submit" class="dropdown-item">
                                                <i class="fas fa-sign-out-alt me-1"></i>Çıkış Yap
                                            </button>
                                        </form>
                                    </li>
                                </ul>
                            </li>
                        @else
                            <li class="nav-item">
                                <a class="nav-link {{ request()->is('giris') ? 'active' : '' }}" href="{{ route('signin.form') }}">
                                    <i class="fas fa-sign-in-alt me-1"></i>Giriş Yap
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ request()->is('kayit') ? 'active' : '' }}" href="{{ route('signup.form') }}">
                                    <i class="fas fa-user-plus me-1"></i>Kayıt Ol
                                </a>
                            </li>
                        @endauth
                    </ul>
                </div>
            </div>
        </nav>

        <div class="container my-4">
            @yield('content')
        </div>
    </div>

    <footer>
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <h5 class="text-accent">HawkMarkt Hakkında</h5>
                    <p>Güvenilir ve hızlı alışverişin adresi. Kaliteli ürünler, uygun fiyatlar ve hızlı teslimat.</p>
                </div>
                <div class="col-md-4">
                    <h5 class="text-accent">Hızlı Linkler</h5>
                    <ul class="list-unstyled">
                        <li><a href="/">Anasayfa</a></li>
                        <li><a href="/kategoriler">Kategoriler</a></li>
                        <li><a href="/sepetim">Sepetim</a></li>
                    </ul>
                </div>
                <div class="col-md-4">
                    <h5 class="text-accent">İletişim</h5>
                    <p>
                        <i class="fas fa-envelope me-2"></i>info@hawkmarkt.com<br>
                        <i class="fas fa-phone me-2"></i>+90 555 123 4567<br>
                        <i class="fas fa-map-marker-alt me-2"></i>İstanbul, Türkiye
                    </p>
                </div>
            </div>
            <hr class="mt-4" style="border-color: var(--hawk-accent);">
            <div class="text-center">
                <p class="mb-0">&copy; {{ date('Y') }} HawkMarkt. Tüm hakları saklıdır.</p>
            </div>
        </div>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    <script src="{{asset('js/app.js')}}"></script>
    <script>
        // Sayfa yüklenme animasyonu
        document.addEventListener('DOMContentLoaded', () => {
            document.body.classList.add('visible');

            const themeSwitch = document.getElementById('theme-switch');
            const savedTheme = localStorage.getItem('theme') || 'light';

            document.documentElement.setAttribute('data-bs-theme', savedTheme);
            themeSwitch.checked = savedTheme === 'dark';

            themeSwitch.addEventListener('change', () => {
                const newTheme = themeSwitch.checked ? 'dark' : 'light';

                // Smooth transition
                document.body.style.opacity = '0';

                setTimeout(() => {
                    document.documentElement.setAttribute('data-bs-theme', newTheme);
                    localStorage.setItem('theme', newTheme);
                    document.body.style.opacity = '1';
                }, 200);
            });
        });
          // Alert otomatik kapanma
          setTimeout(function() {
                const alerts = document.querySelectorAll('.alert');
                alerts.forEach(function(alert) {
                    const bsAlert = new bootstrap.Alert(alert);
                    bsAlert.close();
                });
            }, 5000);

    </script>
</body>
</html>
