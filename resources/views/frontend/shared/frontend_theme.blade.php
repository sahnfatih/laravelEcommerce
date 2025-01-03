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
    background-color: var(--hawk-bg-card);
    border: 1px solid var(--hawk-border-color);
    transition: all 0.3s ease;
}
.card:hover {
    transform: translateY(-5px);
    border-color: var(--hawk-accent);
    box-shadow: 0 8px 20px rgba(var(--hawk-shadow-rgb));
}
.list-group-item {
    background-color: var(--hawk-card-bg);
    border: 1px solid var(--hawk-border);
    color: var(--hawk-text);
    padding: 0.75rem 1rem;
    margin-bottom: 4px;
    border-radius: 6px;
    transition: all 0.3s ease;
    font-weight: 500;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.list-group-item:hover {
    background-color: var(--hawk-hover);
    color: var(--hawk-accent);
    transform: translateX(5px);
}
.list-group-item .badge {
    background-color: rgba(255, 255, 255, 0.2);
    color: inherit;
    font-weight: 500;
    padding: 0.35em 0.65em;
    border-radius: 20px;
    transition: all 0.3s ease;
    min-width: 24px;
    text-align: center;
}

.list-group-item:not(.active) .badge {
    background-color: var(--hawk-accent);
    color: #ffffff;
}
.list-group-item.active {
    background: linear-gradient(145deg, var(--hawk-accent), #b917c3);
    border: 1px solid var(--hawk-accent);
    color: #ffffff;
    font-weight: 600;
    box-shadow: 0 2px 8px rgba(206, 26, 219, 0.2);
}
.list-group-item.active:hover {
    transform: translateX(5px);
    background: linear-gradient(145deg, #b917c3, var(--hawk-accent));
}

.list-group {
    border-radius: 8px;
    overflow: hidden;
    background: var(--hawk-card-bg);
}



.card-text {
    color: var(--hawk-text-secondary);
}

.btn-primary {
    background-color: var(--hawk-primary);
    border-color: var(--hawk-primary);
}

.btn-primary:hover {
    background-color: var(--hawk-primary-dark);
    border-color: var(--hawk-primary-dark);
}


.badge.bg-primary {
    background-color: #7c3aed !important;
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

        .category-sidebar {
            background: transparent;
            border-color: var(--hawk-border);
            color: var(--hawk-text);
            transition: all 0.3s ease;
        }

        .category-sidebar  {
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
        .navbar-brand svg {
    width: 48px;
    height: 48px;
    margin-right: 8px;
    transition: transform 0.3s ease;
}

.navbar-brand:hover svg {
    transform: scale(1.1);
}

/* SVG rengi tema değişkenine göre ayarlanır */
[data-bs-theme="light"] .navbar-brand svg {
    fill: var(--hawk-text-color);
}

[data-bs-theme="dark"] .navbar-brand svg {
    fill: var(--hawk-text-white);
}

/* Logo yazısı için stil */
.navbar-brand span {
    font-size: 1.5rem;
    letter-spacing: 0.5px;

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
                <a class="navbar-brand d-flex align-items-center" href="{{ route('home') }}">
                 <svg width="195px" height="195px" viewBox="0 0 512 512" xmlns="http://www.w3.org/2000/svg" fill="#ce1adb" stroke="#ce1adb"><g id="SVGRepo_<svg width="195px" height="195px" viewBox="-51.2 -51.2 614.40 614.40" xmlns="http://www.w3.org/2000/svg" fill="#a48dc3" stroke="#a48dc3"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round" stroke="#a18ac1" stroke-width="6.144"><path fill="#000000" d="M43.66 18.375l77.942 83.28-103.56-52.25v20.933l110.624 55.814-110.623-18.687v18.955l104.29 17.615-104.29 12.373v18.82L126.19 162.4 18.042 204.95v20.083l113.16-44.525L19.496 256.43l-1.453-.793v21.217c65.806 34.34 132.51 46.543 179.203 32.154 3.824 12.527 9.197 23.717 15.95 33.09l-98.87 151.527h22.315l86.89-133.172-51.378 133.172h20.032l47.38-122.8-16.668 122.8h18.86l16.707-123.1 16.707 123.1h18.857l-16.666-122.8 47.38 122.8h20.033L293.527 360.8l86.666 132.825h22.313l-98.83-151.47c6.884-9.366 12.474-20.595 16.433-33.208 45.343 13.82 109.376 2.79 173.2-29.29v-24.466L383.425 180.51l109.887 43.236v-20.082l-104.87-41.264 104.87 12.442v-18.82l-101.013-11.985 101.014-17.062V108.02l-104.84 17.71 104.84-52.664V52.152L388.42 104.838l80.92-86.463h-25.596l-87.07 93.033 10.346 9.684 1.197 3.215c2.333 6.264 3.502 11.874 3.502 18.347 0 27.94-22.42 53.896-57.76 67.795-14.693-15.965-20.836-32.194-19.682-40.395.63-4.474 2.12-6.77 6.56-8.858 4.442-2.087 12.65-3.236 24.878-1.088l10.978 1.93-.014-11.147c-.03-20-4.383-35.828-14.752-46.682-10.37-10.852-25.516-15.307-43.395-15.79h-.005c-21.498-.587-47.89 4.298-80.78 12.54l-12.01 3.01 6.185 10.72c17.82 30.892 20.35 45.607 18.635 57.835-1.41 10.04-6.747 20.57-11.127 36.323-33.276-14.21-54.31-39.248-54.31-66.194 0-5.457 1.75-11.222 4.128-17.884l2.77-7.768c4.31-5.594 3.082-4.444 4.31-5.594l-87.07-93.033zm231.328 88.69c1.032-.002 2.043.01 3.03.037h.004c15.15.41 24.503 3.856 30.39 10.02 4.566 4.78 7.734 12.16 8.965 23.27-9.47-.514-17.64.672-24.49 3.89-7.2 3.385-12.52 9.362-15.278 16.282-8.773-10.16-11.91-19.657-13.213-30.957-30.474 13.652-38.452-12.414-13.153-20.542 8.877-1.28 16.82-1.978 23.744-2zm.412 64.958c-.395 14.73 6.987 30.445 19.77 45.592-27.713 8.296-55.653 9.176-78.88.162 3.84-15.15 9.727-25.68 12.27-39.562 12.53 3.915 33.24 3.23 46.84-6.192zm-131.336 22.34L77.098 281.68c-12.686-4.224-25.63-9.41-38.614-15.56zm226.5 0L477.04 266.73c-13.155 6.165-26.255 11.33-39.08 15.508zm-213.287 13.48l-29.925 85.85c-9.986-1.393-20.393-3.487-31.086-6.298zm200.077.005l61.345 79.988c-10.8 2.753-21.3 4.773-31.35 6.066zm-185.18 14.04l-1.494 73.176c-7.553.735-15.648.887-24.176.463zm170.28 0l25.67 73.637c-8.555.31-16.65.02-24.183-.857zm-151.665 3.776c3.903 1.71 7.927 3.273 12.052 4.678l5.54 1.887-1.448 53.043-7.024 2.942c-3.268 1.368-6.77 2.548-10.473 3.547zm133.07 1.133l1.312 64.123c-2.69-.806-5.263-1.713-7.71-2.723L307.288 284c-3.073-.493 1.872-51.797 1.872-51.797l5.438-1.87c3.153-1.083 6.238-2.27 9.26-3.536z"></path></g><g id="SVGRepo_iconCarrier"><path fill="#000000" d="M43.66 18.375l77.942 83.28-103.56-52.25v20.933l110.624 55.814-110.623-18.687v18.955l104.29 17.615-104.29 12.373v18.82L126.19 162.4 18.042 204.95v20.083l113.16-44.525L19.496 256.43l-1.453-.793v21.217c65.806 34.34 132.51 46.543 179.203 32.154 3.824 12.527 9.197 23.717 15.95 33.09l-98.87 151.527h22.315l86.89-133.172-51.378 133.172h20.032l47.38-122.8-16.668 122.8h18.86l16.707-123.1 16.707 123.1h18.857l-16.666-122.8 47.38 122.8h20.033L293.527 360.8l86.666 132.825h22.313l-98.83-151.47c6.884-9.366 12.474-20.595 16.433-33.208 45.343 13.82 109.376 2.79 173.2-29.29v-24.466L383.425 180.51l109.887 43.236v-20.082l-104.87-41.264 104.87 12.442v-18.82l-101.013-11.985 101.014-17.062V108.02l-104.84 17.71 104.84-52.664V52.152L388.42 104.838l80.92-86.463h-25.596l-87.07 93.033 10.346 9.684 1.197 3.215c2.333 6.264 3.502 11.874 3.502 18.347 0 27.94-22.42 53.896-57.76 67.795-14.693-15.965-20.836-32.194-19.682-40.395.63-4.474 2.12-6.77 6.56-8.858 4.442-2.087 12.65-3.236 24.878-1.088l10.978 1.93-.014-11.147c-.03-20-4.383-35.828-14.752-46.682-10.37-10.852-25.516-15.307-43.395-15.79h-.005c-21.498-.587-47.89 4.298-80.78 12.54l-12.01 3.01 6.185 10.72c17.82 30.892 20.35 45.607 18.635 57.835-1.41 10.04-6.747 20.57-11.127 36.323-33.276-14.21-54.31-39.248-54.31-66.194 0-5.457 1.75-11.222 4.128-17.884l2.77-7.768c4.31-5.594 3.082-4.444 4.31-5.594l-87.07-93.033zm231.328 88.69c1.032-.002 2.043.01 3.03.037h.004c15.15.41 24.503 3.856 30.39 10.02 4.566 4.78 7.734 12.16 8.965 23.27-9.47-.514-17.64.672-24.49 3.89-7.2 3.385-12.52 9.362-15.278 16.282-8.773-10.16-11.91-19.657-13.213-30.957-30.474 13.652-38.452-12.414-13.153-20.542 8.877-1.28 16.82-1.978 23.744-2zm.412 64.958c-.395 14.73 6.987 30.445 19.77 45.592-27.713 8.296-55.653 9.176-78.88.162 3.84-15.15 9.727-25.68 12.27-39.562 12.53 3.915 33.24 3.23 46.84-6.192zm-131.336 22.34L77.098 281.68c-12.686-4.224-25.63-9.41-38.614-15.56zm226.5 0L477.04 266.73c-13.155 6.165-26.255 11.33-39.08 15.508zm-213.287 13.48l-29.925 85.85c-9.986-1.393-20.393-3.487-31.086-6.298zm200.077.005l61.345 79.988c-10.8 2.753-21.3 4.773-31.35 6.066zm-185.18 14.04l-1.494 73.176c-7.553.735-15.648.887-24.176.463zm170.28 0l25.67 73.637c-8.555.31-16.65.02-24.183-.857zm-151.665 3.776c3.903 1.71 7.927 3.273 12.052 4.678l5.54 1.887-1.448 53.043-7.024 2.942c-3.268 1.368-6.77 2.548-10.473 3.547zm133.07 1.133l1.312 64.123c-2.69-.806-5.263-1.713-7.71-2.723L307.288 284c-3.073-.493 1.872-51.797 1.872-51.797l5.438-1.87c3.153-1.083 6.238-2.27 9.26-3.536z"></path></g></svg>
                    <span class="fw-bold">HAWKMARKT</span>
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
