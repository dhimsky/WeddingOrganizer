<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @php $settings = \App\Models\Setting::all()->pluck('value','key'); @endphp
    <meta name="description" content="{{ $settings['meta_description'] ?? 'Wedding organizer premium' }}">
    <title>{{ $settings['site_title'] }} - {{ $settings['hero_tagline'] }}</title>
    

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Cormorant+Garamond:ital,wght@0,300;0,400;0,500;0,600;1,300;1,400;1,600&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <style>
        :root {
            --blue: #002E7A;
            --blue-light: #1A4A9A;
            --blue-dark: #001F54;
            --blue-muted: rgba(0,46,122,0.08);
            --cream: #FFFFFF;
            --off-white: #F5F7FB;
            --charcoal: #0A1628;
            --warm-gray: #5A6A82;
            --border: rgba(0,46,122,0.12);
            --font-serif: 'Inter', Georgia, serif;
            --font-sans: 'Inter', sans-serif;
        }

        * { margin: 0; padding: 0; box-sizing: border-box; }

        html { scroll-behavior: smooth; }

        body {
            font-family: var(--font-sans);
            background: var(--cream);
            color: var(--charcoal);
            overflow-x: hidden;
        }

        ::-webkit-scrollbar { width: 6px; }
        ::-webkit-scrollbar-track { background: var(--off-white); }
        ::-webkit-scrollbar-thumb { background: var(--blue); border-radius: 3px; }

        .navbar {
            position: fixed; top: 0; left: 0; right: 0; z-index: 1000;
            padding: 1.5rem 0;
            transition: all 0.4s ease;
        }

        .navbar.scrolled {
            background: rgba(255,255,255,0.97);
            backdrop-filter: blur(20px);
            padding: 1rem 0;
            box-shadow: 0 1px 30px rgba(0,46,122,0.08);
        }

        .navbar-inner {
            max-width: 1400px;
            margin: 0 auto;
            padding: 0 2rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .nav-logo {
            font-family: var(--font-serif);
            font-size: 1.8rem;
            font-weight: 600;
            color: var(--charcoal);
            text-decoration: none;
            letter-spacing: 0.05em;
        }

        .nav-logo span { color: var(--blue); }

        .nav-links {
            display: flex;
            align-items: center;
            gap: 2.5rem;
            list-style: none;
        }

        .nav-links a {
            font-size: 0.75rem;
            font-weight: 500;
            letter-spacing: 0.12em;
            text-transform: uppercase;
            color: var(--charcoal);
            text-decoration: none;
            position: relative;
            transition: color 0.3s;
        }

        .nav-links a::after {
            content: '';
            position: absolute;
            bottom: -4px; left: 0; right: 0;
            height: 1.5px;
            background: var(--blue);
            transform: scaleX(0);
            transition: transform 0.3s;
        }

        .nav-links a:hover { color: var(--blue); }
        .nav-links a:hover::after { transform: scaleX(1); }

        .nav-cta {
            padding: 0.65rem 1.8rem;
            border: 1.5px solid var(--blue);
            color: var(--blue) !important;
            border-radius: 0;
            font-size: 0.72rem !important;
            letter-spacing: 0.18em;
            transition: all 0.3s !important;
        }

        .nav-cta:hover {
            background: var(--blue) !important;
            color: white !important;
        }

        .nav-cta::after { display: none !important; }

        .hamburger {
            display: none;
            flex-direction: column;
            gap: 5px;
            cursor: pointer;
            padding: 5px;
            background: none;
            border: none;
        }

        .hamburger span {
            display: block;
            width: 25px;
            height: 1.5px;
            background: var(--charcoal);
            transition: all 0.3s;
        }

        .mobile-menu {
            position: fixed;
            top: 0; right: -100%;
            width: 300px; height: 100vh;
            background: white;
            z-index: 1001;
            padding: 5rem 2rem 2rem;
            transition: right 0.4s ease;
            border-left: 1px solid var(--border);
        }

        .mobile-menu.open { right: 0; }

        .mobile-menu-overlay {
            position: fixed;
            inset: 0;
            background: rgba(0,46,122,0.35);
            z-index: 998;
            opacity: 0;
            pointer-events: none;
            transition: opacity 0.3s;
        }

        .mobile-menu-overlay.open { opacity: 1; pointer-events: all; }

        .mobile-menu a {
            display: block;
            font-family: var(--font-serif);
            font-size: 1.5rem;
            color: var(--charcoal);
            text-decoration: none;
            padding: 0.75rem 0;
            border-bottom: 1px solid var(--border);
            transition: color 0.3s;
        }

        .mobile-menu a:hover { color: var(--blue); }

        .close-menu {
            position: absolute;
            top: 1.5rem; right: 1.5rem;
            background: none; border: none;
            font-size: 1.5rem;
            cursor: pointer;
            color: var(--charcoal);
        }

        .btn-primary {
            display: inline-flex;
            align-items: center;
            gap: 0.75rem;
            padding: 1rem 2.5rem;
            background: var(--blue);
            color: white;
            text-decoration: none;
            font-size: 0.78rem;
            font-weight: 500;
            letter-spacing: 0.18em;
            text-transform: uppercase;
            transition: all 0.3s;
            border: 1.5px solid var(--blue);
        }

        .btn-primary:hover {
            background: transparent;
            color: var(--blue);
        }

        .btn-outline {
            display: inline-flex;
            align-items: center;
            gap: 0.75rem;
            padding: 1rem 2.5rem;
            background: transparent;
            color: var(--blue);
            text-decoration: none;
            font-size: 0.78rem;
            font-weight: 500;
            letter-spacing: 0.18em;
            text-transform: uppercase;
            transition: all 0.3s;
            border: 1.5px solid var(--blue);
        }

        .btn-outline:hover {
            background: var(--blue);
            color: white;
        }

        .section-header {
            text-align: center;
            margin-bottom: 4rem;
        }

        .section-label {
            display: inline-block;
            font-size: 0.68rem;
            font-weight: 600;
            letter-spacing: 0.28em;
            text-transform: uppercase;
            color: var(--blue);
            margin-bottom: 1rem;
        }

        .section-title {
            font-family: var(--font-serif);
            font-size: clamp(2rem, 4vw, 3.5rem);
            font-weight: 300;
            line-height: 1.2;
            color: var(--charcoal);
        }

        .section-divider {
            width: 60px;
            height: 2px;
            background: var(--blue);
            margin: 1.5rem auto;
            opacity: 0.3;
        }

        .section-subtitle {
            font-size: 0.95rem;
            color: var(--warm-gray);
            max-width: 600px;
            margin: 0 auto;
            line-height: 1.8;
            font-weight: 300;
        }

        .container {
            max-width: 1400px;
            margin: 0 auto;
            padding: 0 2rem;
        }

        section { padding: 7rem 0; }

        footer {
            background: var(--blue-dark);
            color: rgba(255,255,255,0.7);
            padding: 5rem 0 2rem;
        }

        .footer-grid {
            display: grid;
            grid-template-columns: 1.5fr 1fr 1fr 1fr;
            gap: 3rem;
            margin-bottom: 3rem;
        }

        .footer-brand .nav-logo { color: white; }
        .footer-brand p { font-size: 0.9rem; line-height: 1.8; margin: 1rem 0 1.5rem; font-weight: 300; }

        .footer-social {
            display: flex;
            gap: 1rem;
        }

        .footer-social a {
            width: 38px; height: 38px;
            border: 1px solid rgba(255,255,255,0.2);
            display: flex; align-items: center; justify-content: center;
            color: rgba(255,255,255,0.7);
            text-decoration: none;
            font-size: 0.9rem;
            transition: all 0.3s;
        }

        .footer-social a:hover {
            background: white;
            color: var(--blue);
            border-color: white;
        }

        .footer-col h4 {
            font-family: var(--font-serif);
            font-size: 1.1rem;
            font-weight: 400;
            color: white;
            margin-bottom: 1.5rem;
            padding-bottom: 0.75rem;
            border-bottom: 1px solid rgba(255,255,255,0.1);
        }

        .footer-col ul { list-style: none; }
        .footer-col ul li { margin-bottom: 0.75rem; }
        .footer-col ul li a {
            color: rgba(255,255,255,0.55);
            text-decoration: none;
            font-size: 0.875rem;
            font-weight: 300;
            transition: color 0.3s;
        }
        .footer-col ul li a:hover { color: white; }

        .footer-contact li { display: flex; gap: 0.75rem; align-items: flex-start; }
        .footer-contact li i { color: rgba(255,255,255,0.5); margin-top: 3px; font-size: 0.8rem; }

        .footer-bottom {
            border-top: 1px solid rgba(255,255,255,0.06);
            padding-top: 2rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-size: 0.8rem;
            color: rgba(255,255,255,0.35);
            font-weight: 300;
        }

        .ornament {
            display: flex;
            align-items: center;
            gap: 1rem;
            justify-content: center;
            margin: 1.5rem 0;
        }

        .ornament::before, .ornament::after {
            content: '';
            width: 60px;
            height: 1px;
            background: rgba(0,46,122,0.25);
        }

        .ornament i { color: var(--blue); font-size: 0.9rem; opacity: 0.6; }

        @keyframes fadeUp {
            from { opacity: 0; transform: translateY(30px); }
            to { opacity: 1; transform: translateY(0); }
        }

        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }

        .fade-up { animation: fadeUp 0.8s ease forwards; }

        .reveal {
            opacity: 0;
            transform: translateY(30px);
            transition: opacity 0.7s ease, transform 0.7s ease;
        }

        .reveal.visible {
            opacity: 1;
            transform: translateY(0);
        }

        @media (max-width: 1024px) {
            .footer-grid { grid-template-columns: 1fr 1fr; }
        }

        @media (max-width: 768px) {
            .nav-links { display: none; }
            .hamburger { display: flex; }
            .footer-grid { grid-template-columns: 1fr; }
            .footer-bottom { flex-direction: column; gap: 1rem; text-align: center; }
            section { padding: 5rem 0; }
        }

        /* =========================
        HANYA UNTUK HALAMAN HOME
        ========================= */

        .navbar-home .nav-logo,
        .navbar-home .nav-logo span {
            color: #fff;
        }

        .navbar-home .nav-links a {
            color: #fff;
        }

        .navbar-home .nav-links a::after {
            background: #fff;
        }

        .navbar-home .nav-links a:hover {
            color: #fff;
        }

        .navbar-home .nav-cta {
            border-color: #fff;
            color: #fff !important;
        }

        .navbar-home .nav-cta:hover {
            background: #fff !important;
            color: var(--blue) !important;
        }

        .navbar-home .hamburger span {
            background: #fff;
        }

        /* Setelah discroll di Home */
        .navbar-home.scrolled .nav-logo {
            color: var(--charcoal);
        }

        .navbar-home.scrolled .nav-logo span {
            color: var(--blue);
        }

        .navbar-home.scrolled .nav-links a {
            color: var(--charcoal);
        }

        .navbar-home.scrolled .nav-links a::after {
            background: var(--blue);
        }

        .navbar-home.scrolled .nav-links a:hover {
            color: var(--blue);
        }

        .navbar-home.scrolled .nav-cta {
            border-color: var(--blue);
            color: var(--blue) !important;
        }

        .navbar-home.scrolled .nav-cta:hover {
            background: var(--blue) !important;
            color: #fff !important;
        }

        .navbar-home.scrolled .hamburger span {
            background: var(--charcoal);
        }
    </style>

    @yield('styles')
</head>
<body>

<nav class="navbar {{ request()->routeIs('home') ? 'navbar-home' : '' }}" id="navbar">
    <div class="navbar-inner">
        @if(isset($profile) && $profile->logo)
            <a href="{{ route('home') }}" class="nav-logo">
                <img src="{{ asset('storage/'.$profile->logo) }}"
                    alt="{{ $profile->company_name }}"
                    style="height:40px;object-fit:contain">
            </a>
        @else
            <a href="{{ route('home') }}" class="nav-logo">Wedding<span>✦</span></a>
        @endif

        <ul class="nav-links">
            <li><a href="{{ route('profile') }}">Profil</a></li>
            <li><a href="{{ route('vision-mission') }}">Visi & Misi</a></li>
            <li><a href="{{ route('services') }}">Services</a></li>
            <li><a href="{{ route('partners') }}">Partners</a></li>
            <li><a href="{{ route('gallery') }}">Gallery</a></li>
            <li><a href="{{ route('contact') }}" class="nav-cta">Konsultasi</a></li>
        </ul>

        <button class="hamburger" id="hamburgerBtn" aria-label="Menu">
            <span></span><span></span><span></span>
        </button>
    </div>
</nav>

<div class="mobile-menu-overlay" id="menuOverlay"></div>
<div class="mobile-menu" id="mobileMenu">
    <button class="close-menu" id="closeMenu">✕</button>
    <a href="{{ route('home') }}">Home</a>
    <a href="{{ route('profile') }}">Profil</a>
    <a href="{{ route('vision-mission') }}">Visi & Misi</a>
    <a href="{{ route('services') }}">Services</a>
    <a href="{{ route('partners') }}">Partners</a>
    <a href="{{ route('gallery') }}">Gallery</a>
    <a href="{{ route('contact') }}">Hubungi Kami</a>
</div>

@yield('content')

<footer>
    <div class="container">
        <div class="footer-grid">
            <div class="footer-brand">
                @if(isset($profile) && $profile->logo)
                    <a href="{{ route('home') }}" style="display:block;margin-bottom:1rem">
                        <img src="{{ asset('storage/'.$profile->logo) }}"
                            alt="{{ $profile->company_name }}"
                            style="height:40px;object-fit:contain">
                    </a>
                @else
                    <a href="{{ route('home') }}" class="nav-logo" style="display:block;margin-bottom:1rem">
                        Wedding<span style="color:rgba(255,255,255,0.5)">✦</span>
                    </a>
                @endif
                <p>{{ $profile->tagline ?? 'Crafting Your Perfect Love Story' }}</p>
                <div class="footer-social">
                    @if($profile && $profile->instagram)
                    <a href="https://instagram.com/{{ $profile->instagram }}" target="_blank"><i class="fab fa-instagram"></i></a>
                    @endif
                    @if($profile && $profile->facebook)
                    <a href="https://facebook.com/{{ $profile->facebook }}" target="_blank"><i class="fab fa-facebook-f"></i></a>
                    @endif
                    @if($profile && $profile->tiktok)
                    <a href="https://tiktok.com/{{ $profile->tiktok }}" target="_blank"><i class="fab fa-tiktok"></i></a>
                    @endif
                    @if($profile && $profile->youtube)
                    <a href="https://youtube.com/@{{ $profile->youtube }}" target="_blank"><i class="fab fa-youtube"></i></a>
                    @endif
                    @if($profile && $profile->whatsapp)
                    <a href="https://wa.me/{{ $profile->whatsapp }}" target="_blank"><i class="fab fa-whatsapp"></i></a>
                    @endif
                </div>
            </div>

            <div class="footer-col">
                <h4>Navigasi</h4>
                <ul>
                    <li><a href="{{ route('home') }}">Home</a></li>
                    <li><a href="{{ route('profile') }}">Tentang Kami</a></li>
                    <li><a href="{{ route('vision-mission') }}">Visi & Misi</a></li>
                    <li><a href="{{ route('services') }}">Layanan</a></li>
                    <li><a href="{{ route('partners') }}">Partner Kami</a></li>
                    <li><a href="{{ route('gallery') }}">Gallery</a></li>
                </ul>
            </div>

            <div class="footer-col">
                <h4>Layanan</h4>
                <ul>
                    <li><a href="#">Full Wedding Organizer</a></li>
                    <li><a href="#">Wedding Day Coordinator</a></li>
                    <li><a href="#">Wedding Decoration</a></li>
                    <li><a href="#">Pre-Wedding Package</a></li>
                    <li><a href="#">Intimate Wedding</a></li>
                    <li><a href="#">Destination Wedding</a></li>
                </ul>
            </div>

            <div class="footer-col">
                <h4>Kontak</h4>
                <ul class="footer-contact">
                    @if($profile)
                    <li><i class="fas fa-map-marker-alt"></i><span>{{ $profile->address }}</span></li>
                    <li><i class="fas fa-phone"></i><span>{{ $profile->phone }}</span></li>
                    <li><i class="fas fa-envelope"></i><span>{{ $profile->email }}</span></li>
                    @endif
                </ul>
            </div>
        </div>

        <div class="footer-bottom">
            <p>&copy; {{ date('Y') }} Wedding Organizer. All rights reserved.</p>
            {{-- <p>Made with <span style="color:rgba(255,255,255,0.4)">♥</span> Love</p> --}}
        </div>
    </div>
</footer>

<script>
    const navbar = document.getElementById('navbar');
    window.addEventListener('scroll', () => {
        navbar.classList.toggle('scrolled', window.scrollY > 50);
    });

    const hamburger = document.getElementById('hamburgerBtn');
    const mobileMenu = document.getElementById('mobileMenu');
    const overlay = document.getElementById('menuOverlay');
    const closeMenu = document.getElementById('closeMenu');

    function openMenu() { mobileMenu.classList.add('open'); overlay.classList.add('open'); document.body.style.overflow = 'hidden'; }
    function closeMobileMenu() { mobileMenu.classList.remove('open'); overlay.classList.remove('open'); document.body.style.overflow = ''; }

    hamburger.addEventListener('click', openMenu);
    closeMenu.addEventListener('click', closeMobileMenu);
    overlay.addEventListener('click', closeMobileMenu);

    const reveals = document.querySelectorAll('.reveal');
    const observer = new IntersectionObserver((entries) => {
        entries.forEach((entry, i) => {
            if (entry.isIntersecting) {
                setTimeout(() => entry.target.classList.add('visible'), i * 100);
            }
        });
    }, { threshold: 0.1 });
    reveals.forEach(el => observer.observe(el));
</script>

@yield('scripts')
</body>
</html>