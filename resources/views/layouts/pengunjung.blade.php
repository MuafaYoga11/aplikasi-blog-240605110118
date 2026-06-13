<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Blog Kami')</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        :root {
            --bg-light: #f1f5f9;
            --navy-dark: #1e293b;
            --green-accent: #16a34a;
            --green-hover: #15803d;
        }
        body {
            background-color: var(--bg-light);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }
        .navbar-custom {
            background-color: var(--navy-dark);
        }
        .navbar-custom .navbar-brand {
            color: #fff;
            font-weight: bold;
        }
        .navbar-custom .nav-link {
            color: #cbd5e1;
            transition: color 0.3s;
        }
        .navbar-custom .nav-link:hover, .navbar-custom .nav-link.active {
            color: #fff;
        }
        .tagline {
            font-size: 0.8rem;
            color: #94a3b8;
            margin-left: 10px;
        }
        .footer-custom {
            background-color: var(--navy-dark);
            color: #cbd5e1;
            margin-top: auto;
        }
        .btn-green {
            background-color: var(--green-accent);
            color: white;
            border: none;
            transition: background-color 0.3s;
        }
        .btn-green:hover {
            background-color: var(--green-hover);
            color: white;
        }
        .card {
            border: none;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
            border-radius: 0.5rem;
        }
        .badge-kategori {
            background-color: var(--green-accent);
            font-weight: normal;
        }
        .list-group-item.active-kategori {
            background-color: var(--green-accent) !important;
            border-color: var(--green-accent) !important;
            color: white !important;
        }
        .text-green {
            color: var(--green-accent);
        }
        a {
            text-decoration: none;
        }
    </style>
</head>
<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-custom py-3">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center" href="{{ route('beranda') }}">
                Blog Kami
                <span class="tagline d-none d-md-inline">Berbagi Inspirasi & Pengetahuan</span>
            </a>
            <button class="navbar-toggler border-0 shadow-none" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon" style="filter: invert(1) grayscale(100%) brightness(200%);"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('beranda') ? 'active' : '' }}" href="{{ route('beranda') }}">Beranda</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('beranda') }}">Artikel</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('beranda') }}">Kategori</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Tentang</a>
                    </li>
                    @auth
                    <li class="nav-item">
                        <a class="nav-link text-warning" href="{{ route('dashboard') }}">CMS</a>
                    </li>
                    @else
                    <li class="nav-item">
                        <a class="nav-link text-warning" href="{{ route('login') }}">Login</a>
                    </li>
                    @endauth
                </ul>
            </div>
        </div>
    </nav>

    <!-- Content -->
    <main class="container py-5">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="footer-custom py-4 text-center mt-auto">
        <div class="container">
            <p class="mb-0">&copy; {{ date('Y') }} Blog Kami. All rights reserved.</p>
        </div>
    </footer>

    <!-- Bootstrap 5 JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
