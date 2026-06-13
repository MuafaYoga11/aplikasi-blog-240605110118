<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Sistem Manajemen Blog (CMS)')</title>
    <meta name="description" content="Sistem Manajemen Blog (CMS)">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <style>
        * { box-sizing: border-box; }
        body { margin: 0; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; background: #f0f2f5; }

        /* Header */
        .app-header {
            background: #2C3E50;
            color: #fff;
            padding: 0 24px;
            height: 52px;
            display: flex;
            align-items: center;
            gap: 12px;
        }
        .app-header .header-icon {
            font-size: 1.4rem;
        }
        .app-header .header-text {
            display: flex;
            align-items: baseline;
            gap: 8px;
        }
        .app-header .header-text h1 {
            margin: 0;
            font-size: 1.1rem;
            font-weight: 600;
        }
        .app-header .header-text small {
            color: #bdc3c7;
            font-size: 0.8rem;
        }

        /* Layout */
        .app-wrapper { display: flex; min-height: calc(100vh - 52px); }

        /* Sidebar */
        .app-sidebar {
            width: 210px;
            min-width: 210px;
            background: #fff;
            border-right: 1px solid #f0f0f0;
            display: flex;
            flex-direction: column;
        }
        
        .sidebar-profile {
            padding: 20px;
            text-align: center;
            border-bottom: 1px solid #f0f0f0;
            margin-bottom: 15px;
        }
        .sidebar-profile img {
            width: 48px;
            height: 48px;
            border-radius: 50%;
            object-fit: cover;
            margin-bottom: 10px;
            border: 2px solid #e9ecef;
        }
        .sidebar-profile .greeting {
            font-size: 0.85rem;
            color: #6c757d;
            margin: 0;
        }
        .sidebar-profile .name {
            font-size: 0.95rem;
            font-weight: 600;
            color: #333;
            margin: 0;
        }

        .menu-list {
            flex: 1;
        }

        .app-sidebar .menu-label {
            font-size: 0.7rem;
            text-transform: uppercase;
            color: #adb5bd;
            letter-spacing: 1px;
            font-weight: 600;
            padding: 0 20px;
            margin-bottom: 10px;
        }
        .app-sidebar .nav-link {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 9px 14px;
            margin: 0 10px 4px 10px;
            color: #555555;
            font-size: 13px;
            border-left: 3px solid transparent;
            transition: all 0.2s ease;
            text-decoration: none;
            cursor: pointer;
            border-radius: 0 4px 4px 0;
        }
        .app-sidebar .nav-link:hover {
            background: #f8f9fa;
        }
        .app-sidebar .nav-link.active {
            background: #e8f5e9;
            color: #2e7d32;
            border-left-color: #4CAF50;
            font-weight: 600;
        }
        .app-sidebar .nav-link i { font-size: 1.1rem; }

        /* Logout Button */
        .sidebar-footer {
            padding: 15px;
            border-top: 1px solid #f0f0f0;
        }
        .btn-logout {
            display: block;
            width: 100%;
            padding: 8px;
            background: #fff0f0;
            color: #c0392b;
            text-align: center;
            text-decoration: none;
            border-radius: 6px;
            font-size: 13px;
            font-weight: 600;
            transition: background 0.2s;
            border: none;
        }
        .btn-logout:hover {
            background: #fce4e4;
            color: #c0392b;
        }

        /* Content */
        .app-content {
            flex: 1;
            padding: 24px;
            background: #f4f4f9;
        }

        /* Card & Table styles moved to partials or kept standard */
        .content-card {
            background: #fff;
            border-radius: 6px;
            box-shadow: 0 1px 4px rgba(0,0,0,0.05);
            border: none;
        }
        .content-card .card-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 16px 20px;
            border-bottom: 1px solid #eee;
            background: #fff;
            border-radius: 6px 6px 0 0;
        }
        .content-card .card-header h5 {
            margin: 0;
            font-weight: 600;
            font-size: 1rem;
            color: #333;
        }

        .table thead { background: #fafafa; }
        .table thead th { font-size: 11px; text-transform: uppercase; color: #666666; padding: 12px 16px; border-bottom: 1px solid #eee; font-weight: 600; }
        .table td { padding: 12px 16px; vertical-align: middle; font-size: 13px; }
        
        .btn-edit-table { background: #e3f2fd; color: #1565c0; border: none; }
        .btn-edit-table:hover { background: #bbdefb; color: #1565c0; }
        .btn-delete-table { background: #ffebee; color: #c62828; border: none; }
        .btn-delete-table:hover { background: #ffcdd2; color: #c62828; }

        /* Modal / Form */
        .modal-content { border: none; box-shadow: 0 4px 12px rgba(0,0,0,0.1); }
        .modal-body label { font-size: 13px; font-weight: 600; }
        .btn-batal { background: #f0f0f0; border: none; color: #333; }
        .btn-batal:hover { background: #e2e2e2; }

        .modal-delete-icon {
            width: 64px;
            height: 64px;
            border-radius: 50%;
            background: #ffebee;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 16px;
        }
        .modal-delete-icon i { font-size: 1.8rem; color: #c62828; }

        /* Toast */
        .toast-container { position: fixed; bottom: 20px; right: 20px; z-index: 1100; }
        
        .photo-thumb { width: 40px; height: 40px; border-radius: 50%; object-fit: cover; }
        .article-thumb { width: 60px; height: 40px; border-radius: 4px; object-fit: cover; }
    </style>
</head>
<body>

    {{-- Header --}}
    <header class="app-header">
        <i class="bi bi-journal-richtext header-icon"></i>
        <div class="header-text">
            <h1>Sistem Manajemen Blog (CMS)</h1>
            <small>db_blog</small>
        </div>
    </header>

    <div class="app-wrapper">
        {{-- Sidebar --}}
        <nav class="app-sidebar">
            <div class="sidebar-profile">
                @php
                    $user = Auth::user();
                    $fotoUrl = $user && $user->foto && $user->foto !== 'default.png' 
                        ? asset('storage/uploads_penulis/' . $user->foto) 
                        : asset('storage/uploads_penulis/default.png');
                @endphp
                <img src="{{ $fotoUrl }}" alt="Profile" onerror="this.src='/storage/uploads_penulis/default.png'">
                <p class="greeting">Halo,</p>
                <p class="name">{{ $user ? $user->nama_depan . ' ' . $user->nama_belakang : 'Guest' }}</p>
            </div>

            <div class="menu-list">
                <div class="menu-label">Menu Utama</div>
                <a class="nav-link" id="menu-dashboard" onclick="loadMenu('dashboard', this)">
                    <i class="bi bi-house"></i> Dashboard
                </a>
                <a class="nav-link" id="menu-profil" onclick="loadMenu('profil', this)">
                    <i class="bi bi-person-circle"></i> Profil Saya
                </a>
                <a class="nav-link" id="menu-penulis" onclick="loadMenu('penulis', this)">
                    <i class="bi bi-people"></i> Kelola Penulis
                </a>
                <a class="nav-link" id="menu-artikel" onclick="loadMenu('artikel', this)">
                    <i class="bi bi-file-earmark-text"></i> Kelola Artikel
                </a>
                <a class="nav-link" id="menu-kategori" onclick="loadMenu('kategori', this)">
                    <i class="bi bi-folder2-open"></i> Kelola Kategori
                </a>
            </div>

            <div class="sidebar-footer">
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="btn-logout"><i class="bi bi-box-arrow-right me-1"></i> Keluar</button>
                </form>
            </div>
        </nav>

        {{-- Content --}}
        <main class="app-content" id="app-content">
            <div class="text-center text-muted py-5">
                <div class="spinner-border text-success" role="status">
                    <span class="visually-hidden">Loading...</span>
                </div>
                <p class="mt-2">Memuat data...</p>
            </div>
        </main>
    </div>

    {{-- Toast --}}
    <div class="toast-container">
        <div id="appToast" class="toast align-items-center border-0" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="d-flex">
                <div class="toast-body" id="toast-body"></div>
                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        const CSRF_TOKEN = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        function showToast(message, type = 'success') {
            const toastEl = document.getElementById('appToast');
            const toastBody = document.getElementById('toast-body');
            toastEl.className = 'toast align-items-center border-0 text-bg-' + (type === 'error' ? 'danger' : type);
            toastBody.textContent = message;
            const toast = new bootstrap.Toast(toastEl, { delay: 3000 });
            toast.show();
        }

        function loadMenu(menu, el) {
            document.querySelectorAll('.app-sidebar .nav-link').forEach(link => link.classList.remove('active'));
            if (el) el.classList.add('active');

            const content = document.getElementById('app-content');
            content.innerHTML = '<div class="text-center text-muted py-5"><div class="spinner-border text-success" role="status"><span class="visually-hidden">Loading...</span></div><p class="mt-2">Memuat data...</p></div>';

            fetch('/partial/' + menu, {
                headers: { 'X-Requested-With': 'XMLHttpRequest' }
            })
            .then(res => res.text())
            .then(html => {
                content.innerHTML = html;
                content.querySelectorAll('script').forEach(oldScript => {
                    const newScript = document.createElement('script');
                    if (oldScript.src) newScript.src = oldScript.src;
                    else newScript.textContent = oldScript.textContent;
                    oldScript.parentNode.replaceChild(newScript, oldScript);
                });
            })
            .catch(err => {
                content.innerHTML = '<div class="alert alert-danger m-4">Gagal memuat data. Silakan coba lagi.</div>';
                console.error(err);
            });
        }

        document.addEventListener('DOMContentLoaded', function() {
            loadMenu('dashboard', document.getElementById('menu-dashboard'));
        });
    </script>
</body>
</html>