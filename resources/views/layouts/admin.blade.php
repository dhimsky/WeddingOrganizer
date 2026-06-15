<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard') — Admin</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Cormorant+Garamond:ital,wght@0,300;0,400;0,500;0,600;1,300;1,400;1,600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        :root {
            --gold: #002E7A; --gold-light: #1A4A9A; --gold-dark: #001F54;
            --cream: #FAF7F2; --charcoal: #1A1A1A; --warm-gray: #6B6B6B;
            --sidebar-bg: #111111; --sidebar-w: 260px;
            --font-serif: 'Inter', serif;
            --font-sans: 'Jost', sans-serif;
            --border: rgba(201,169,110,0.15);   
            --bg: #F5F3EF;
        }
        * { margin:0; padding:0; box-sizing:border-box; }
        body { font-family:var(--font-sans); background:var(--bg); color:var(--charcoal); min-height:100vh; display:flex; }

        /* ── Sidebar ── */
        .sidebar {
            width: var(--sidebar-w);
            background: var(--sidebar-bg);
            height: 100vh;
            position: fixed; top:0; left:0;
            z-index: 100;
            display: flex;
            flex-direction: column;
            transition: transform 0.3s ease;
            overflow-y: auto;
            overflow-x: hidden;
        }

        .sidebar-brand {
            padding: 2rem 1.5rem;
            border-bottom: 1px solid rgba(255,255,255,0.05);
        }

        .sidebar-logo {
            font-family: var(--font-serif);
            font-size: 1.6rem;
            font-weight: 300;
            color: white;
            letter-spacing: 0.05em;
            text-decoration: none;
            display: block;
        }

        .sidebar-logo span { color: var(--gold); }
        .sidebar-tagline { font-size: 0.65rem; color: rgba(255,255,255,0.35); letter-spacing: 0.2em; text-transform: uppercase; margin-top: 0.25rem; }

        .sidebar-nav { padding: 1.5rem 0; flex: 1; }

        .nav-section-label {
            font-size: 0.6rem;
            letter-spacing: 0.25em;
            text-transform: uppercase;
            color: rgba(255,255,255,0.25);
            padding: 0.5rem 1.5rem;
            margin-top: 1rem;
        }

        .sidebar-nav a {
            display: flex;
            align-items: center;
            gap: 0.875rem;
            padding: 0.75rem 1.5rem;
            color: rgba(255,255,255,0.55);
            text-decoration: none;
            font-size: 0.82rem;
            letter-spacing: 0.05em;
            transition: all 0.25s;
            position: relative;
        }

        .sidebar-nav a:hover { color: rgba(255,255,255,0.9); background: rgba(255,255,255,0.04); }

        .sidebar-nav a.active {
            color: white;
            background: var(--gold);
        }

        .sidebar-nav a.active::before {
            content: '';
            position: absolute;
            left: 0; top: 0; bottom: 0;
            width: 3px;
            background: var(--gold);
        }

        .sidebar-nav a i {
            width: 18px;
            text-align: center;
            font-size: 0.85rem;
            opacity: 0.7;
        }

        .sidebar-nav a.active i { opacity: 1; }

        .sidebar-nav .badge {
            margin-left: auto;
            background: #e74c3c;
            color: white;
            font-size: 0.65rem;
            padding: 0.15rem 0.5rem;
            border-radius: 10px;
        }

        .sidebar-footer {
            padding: 1.5rem;
            border-top: 1px solid rgba(255,255,255,0.05);
        }

        .sidebar-user {
            display: flex;
            align-items: center;
            gap: 0.875rem;
            margin-bottom: 1rem;
        }

        .user-avatar {
            width: 36px; height: 36px;
            background: var(--gold);
            border-radius: 50%;
            display: flex; align-items: center; justify-content: center;
            font-family: var(--font-serif);
            font-size: 1rem;
            color: white;
            flex-shrink: 0;
        }

        .user-name { font-size: 0.82rem; color: rgba(255,255,255,0.8); font-weight: 500; }
        .user-role { font-size: 0.7rem; color: rgba(255,255,255,0.35); margin-top: 1px; }

        .btn-logout {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            width: 100%;
            padding: 0.6rem 1rem;
            background: rgba(255,255,255,0.04);
            border: 1px solid rgba(255,255,255,0.08);
            color: rgba(255,255,255,0.45);
            font-family: var(--font-sans);
            font-size: 0.75rem;
            cursor: pointer;
            letter-spacing: 0.1em;
            transition: all 0.25s;
            text-align: left;
        }

        .btn-logout:hover { color: #e74c3c; border-color: rgba(231,76,60,0.3); background: rgba(231,76,60,0.05); }

        /* ── Main ── */
        .main-wrap {
            margin-left: var(--sidebar-w);
            flex: 1;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        /* ── Topbar ── */
        .topbar {
            background: white;
            border-bottom: 1px solid #EDE9E3;
            padding: 0 2rem;
            height: 64px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            position: sticky; top: 0;
            z-index: 50;
        }

        .topbar-left h1 {
            font-family: var(--font-serif);
            font-size: 1.4rem;
            font-weight: 400;
            color: var(--charcoal);
        }

        .topbar-breadcrumb {
            font-size: 0.75rem;
            color: var(--warm-gray);
            margin-top: 1px;
        }

        .topbar-actions { display: flex; align-items: center; gap: 1rem; }

        .topbar-btn {
            padding: 0.5rem 1.25rem;
            border: 1px solid var(--gold);
            background: none;
            color: var(--gold);
            font-family: var(--font-sans);
            font-size: 0.75rem;
            letter-spacing: 0.1em;
            cursor: pointer;
            text-decoration: none;
            display: flex; align-items: center; gap: 0.5rem;
            transition: all 0.25s;
        }

        .topbar-btn:hover { background: var(--gold); color: white; }
        .topbar-btn.primary { background: var(--gold); color: white; }
        .topbar-btn.primary:hover { background: var(--gold-dark); border-color: var(--gold-dark); }

        .hamburger-btn {
            display: none;
            background: none;
            border: none;
            font-size: 1.2rem;
            cursor: pointer;
            color: var(--charcoal);
            padding: 0.5rem;
        }

        /* ── Content ── */
        .content { padding: 2rem; flex: 1; }

        /* ── Alerts ── */
        .alert {
            padding: 0.875rem 1.25rem;
            margin-bottom: 1.5rem;
            font-size: 0.875rem;
            display: flex; align-items: center; gap: 0.75rem;
            border-left: 3px solid;
        }
        .alert-success { background: #F0FDF4; border-color: #22C55E; color: #15803D; }
        .alert-error { background: #FEF2F2; border-color: #EF4444; color: #B91C1C; }

        /* ── Cards ── */
        .card {
            background: white;
            border: 1px solid #EDE9E3;
            padding: 1.75rem;
            margin-bottom: 1.5rem;
        }

        .card-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 1.5rem;
            padding-bottom: 1rem;
            border-bottom: 1px solid #EDE9E3;
        }

        .card-title {
            font-family: var(--font-serif);
            font-size: 1.2rem;
            font-weight: 400;
        }

        /* ── Tables ── */
        .table-wrap { overflow-x: auto; }
        table { width: 100%; border-collapse: collapse; }
        thead th {
            padding: 0.75rem 1rem;
            font-size: 0.7rem;
            font-weight: 500;
            letter-spacing: 0.15em;
            text-transform: uppercase;
            color: var(--warm-gray);
            background: var(--bg);
            text-align: left;
            border-bottom: 1px solid #EDE9E3;
        }
        tbody td {
            padding: 1rem;
            font-size: 0.875rem;
            border-bottom: 1px solid #EDE9E3;
            vertical-align: middle;
        }
        tbody tr:hover { background: #FAFAF8; }
        tbody tr:last-child td { border-bottom: none; }

        /* ── Badges ── */
        .badge-status {
            display: inline-flex; align-items: center; gap: 0.35rem;
            padding: 0.25rem 0.75rem;
            font-size: 0.7rem;
            font-weight: 500;
            letter-spacing: 0.05em;
        }
        .badge-success { background: #F0FDF4; color: #15803D; }
        .badge-warning { background: #FFFBEB; color: #B45309; }
        .badge-danger { background: #FEF2F2; color: #B91C1C; }

        /* ── Action Buttons ── */
        .action-btns { display: flex; gap: 0.5rem; }
        .btn-sm {
            padding: 0.4rem 0.875rem;
            font-size: 0.75rem;
            font-family: var(--font-sans);
            cursor: pointer;
            border: 1px solid;
            transition: all 0.2s;
            text-decoration: none;
            display: inline-flex; align-items: center; gap: 0.35rem;
        }
        .btn-edit { border-color: var(--gold); color: var(--gold); background: none; }
        .btn-edit:hover { background: var(--gold); color: white; }
        .btn-delete { border-color: #EF4444; color: #EF4444; background: none; }
        .btn-delete:hover { background: #EF4444; color: white; }
        .btn-view { border-color: #3B82F6; color: #3B82F6; background: none; }
        .btn-view:hover { background: #3B82F6; color: white; }

        /* ── Forms ── */
        .form-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 1.5rem; }
        .form-group { margin-bottom: 1.5rem; }
        .form-group label {
            display: block;
            font-size: 0.7rem;
            font-weight: 500;
            letter-spacing: 0.12em;
            text-transform: uppercase;
            color: var(--warm-gray);
            margin-bottom: 0.5rem;
        }
        .form-control {
            width: 100%;
            padding: 0.75rem 1rem;
            border: 1px solid #E0DDD8;
            background: var(--cream);
            font-family: var(--font-sans);
            font-size: 0.875rem;
            color: var(--charcoal);
            outline: none;
            transition: border-color 0.25s;
        }
        .form-control:focus { border-color: var(--gold); }
        textarea.form-control { min-height: 120px; resize: vertical; }
        .form-check { display: flex; align-items: center; gap: 0.6rem; }
        .form-check input { accent-color: var(--gold); width: 16px; height: 16px; }
        .form-check label { font-size: 0.85rem; color: var(--charcoal); cursor: pointer; }
        .form-hint { font-size: 0.75rem; color: var(--warm-gray); margin-top: 0.3rem; }
        .invalid-feedback { font-size: 0.75rem; color: #EF4444; margin-top: 0.25rem; }

        /* ── Pagination ── */
        .pagination { display: flex; gap: 0.25rem; justify-content: center; margin-top: 2rem; }
        .pagination a, .pagination span {
            padding: 0.5rem 0.875rem;
            border: 1px solid #E0DDD8;
            font-size: 0.8rem;
            color: var(--warm-gray);
            text-decoration: none;
            transition: all 0.2s;
        }
        .pagination a:hover { border-color: var(--gold); color: var(--gold); }
        .pagination .active { border-color: var(--gold); background: var(--gold); color: white; }

        /* ── Sidebar overlay (mobile) ── */
        .sidebar-overlay {
            display: none;
            position: fixed; inset: 0;
            background: rgba(0,0,0,0.5);
            z-index: 99;
        }

        /* ── Responsive ── */
        @media (max-width: 1024px) {
            .sidebar { transform: translateX(-100%); }
            .sidebar.open { transform: translateX(0); }
            .sidebar-overlay { display: block; opacity: 0; pointer-events: none; transition: opacity 0.3s; }
            .sidebar-overlay.open { opacity: 1; pointer-events: all; }
            .main-wrap { margin-left: 0; }
            .hamburger-btn { display: block; }
            .form-grid { grid-template-columns: 1fr; }
        }

        @media (max-width: 640px) {
            .content { padding: 1rem; }
            .topbar { padding: 0 1rem; }
        }
    </style>
    @yield('styles')
</head>
<body>

<!-- Sidebar Overlay -->
<div class="sidebar-overlay" id="sidebarOverlay"></div>

<!-- Sidebar -->
<aside class="sidebar" id="sidebar">
    @php
    $profile = \App\Models\Profile::first();
@endphp

<div class="sidebar-brand">
    <a href="{{ route('admin.dashboard') }}" class="sidebar-logo">
        @if($profile && $profile->logo)
            <img
                src="{{ asset('storage/' . $profile->logo) }}"
                alt="{{ $profile->company_name }}"
                style="height: 50px; width: auto; object-fit: contain;"
            >
        @else
            Gugugaga<span>✦</span>
        @endif
    </a>

    <div class="sidebar-tagline">
        {{ $profile->company_name ?? 'Admin Panel' }}
    </div>
</div>

    <nav class="sidebar-nav">
        <div class="nav-section-label">Overview</div>
        <a href="{{ route('admin.dashboard') }}" class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
            <i class="fas fa-th-large"></i> Dashboard
        </a>

        <div class="nav-section-label">Konten Website</div>
        <a href="{{ route('admin.profile.edit') }}" class="{{ request()->routeIs('admin.profile.*') ? 'active' : '' }}">
            <i class="fas fa-building"></i> Profil Perusahaan
        </a>
        <a href="{{ route('admin.vision-mission.edit') }}" class="{{ request()->routeIs('admin.vision-mission.*') ? 'active' : '' }}">
            <i class="fas fa-eye"></i> Visi & Misi
        </a>
        <a href="{{ route('admin.team.index') }}" class="{{ request()->routeIs('admin.team.*') ? 'active' : '' }}">
            <i class="fas fa-users"></i> Tim Kami
        </a>
        <a href="{{ route('admin.services.index') }}" class="{{ request()->routeIs('admin.services.*') ? 'active' : '' }}">
            <i class="fas fa-concierge-bell"></i> Layanan
        </a>
        <a href="{{ route('admin.partners.index') }}" class="{{ request()->routeIs('admin.partners.*') ? 'active' : '' }}">
            <i class="fas fa-handshake"></i> Partner
        </a>

        <div class="nav-section-label">Media & Testimoni</div>
        <a href="{{ route('admin.gallery.index') }}" class="{{ request()->routeIs('admin.gallery.*') ? 'active' : '' }}">
            <i class="fas fa-images"></i> Gallery
        </a>
        <a href="{{ route('admin.testimonials.index') }}" class="{{ request()->routeIs('admin.testimonials.*') ? 'active' : '' }}">
            <i class="fas fa-star"></i> Testimoni
        </a>

        <div class="nav-section-label">Komunikasi</div>
        <a href="{{ route('admin.messages.index') }}" class="{{ request()->routeIs('admin.messages.*') ? 'active' : '' }}">
            <i class="fas fa-envelope"></i> Pesan Masuk
            @php $unread = \App\Models\ContactMessage::where('is_read',false)->count() @endphp
            @if($unread > 0)<span class="badge">{{ $unread }}</span>@endif
        </a>

        <div class="nav-section-label">Sistem</div>
        <a href="{{ route('admin.settings.edit') }}" class="{{ request()->routeIs('admin.settings.*') ? 'active' : '' }}">
            <i class="fas fa-cog"></i> Pengaturan
        </a>
        <a href="{{ route('home') }}" target="_blank">
            <i class="fas fa-external-link-alt"></i> Lihat Website
        </a>
    </nav>

    <div class="sidebar-footer">
        <div class="sidebar-user">
            <div class="user-avatar">{{ strtoupper(substr(Auth::user()->name ?? 'A', 0, 1)) }}</div>
            <div>
                <div class="user-name">{{ Auth::user()->name ?? 'Admin' }}</div>
                <div class="user-role">Administrator</div>
            </div>
        </div>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="btn-logout">
                <i class="fas fa-sign-out-alt"></i> Keluar
            </button>
        </form>
    </div>
</aside>

<!-- Main -->
<div class="main-wrap">
    <!-- Topbar -->
    <header class="topbar">
        <div style="display:flex;align-items:center;gap:1rem">
            <button class="hamburger-btn" id="sidebarToggle">
                <i class="fas fa-bars"></i>
            </button>
            <div class="topbar-left">
                <h1>@yield('page-title', 'Dashboard')</h1>
                <div class="topbar-breadcrumb">@yield('breadcrumb', 'Gugugaga Admin')</div>
            </div>
        </div>
        <div class="topbar-actions">
            @yield('topbar-actions')
            <a href="{{ route('home') }}" target="_blank" class="topbar-btn">
                <i class="fas fa-eye"></i> <span class="d-hide-mobile">Preview</span>
            </a>
        </div>
    </header>

    <!-- Content -->
    <main class="content">
        @if(session('success'))
        <div class="alert alert-success">
            <i class="fas fa-check-circle"></i> {{ session('success') }}
        </div>
        @endif
        @if(session('error'))
        <div class="alert alert-error">
            <i class="fas fa-exclamation-circle"></i> {{ session('error') }}
        </div>
        @endif

        @yield('content')
    </main>
</div>

<script>
    const sidebar = document.getElementById('sidebar');
    const overlay = document.getElementById('sidebarOverlay');
    const toggle = document.getElementById('sidebarToggle');

    toggle.addEventListener('click', () => {
        sidebar.classList.toggle('open');
        overlay.classList.toggle('open');
    });
    overlay.addEventListener('click', () => {
        sidebar.classList.remove('open');
        overlay.classList.remove('open');
    });
</script>
@yield('scripts')
</body>
</html>
