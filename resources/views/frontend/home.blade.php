@extends('layouts.frontend')

@section('title', ($profile->company_name ?? 'Gugugaga') . ' - ' . ($profile->tagline ?? 'Wedding Organizer Premium'))

@section('styles')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css">
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

<style>
    /* ─── Hero ─── */
    .hero {
        min-height: 100vh;
        position: relative;
        display: flex;
        align-items: center;
        justify-content: center;
        overflow: hidden;
        background: var(--charcoal);
    }

    .hero-bg {
        position: absolute;
        inset: 0;
        background: url('https://images.unsplash.com/photo-1519741497674-611481863552?w=1920&q=80') center/cover no-repeat;
        opacity: 0.35;
        transform: scale(1.05);
        animation: slowZoom 20s ease-in-out infinite alternate;
    }

    @keyframes slowZoom {
        from { transform: scale(1.05); }
        to { transform: scale(1.12); }
    }

    .hero-overlay {
        position: absolute;
        inset: 0;
        background: linear-gradient(to bottom, rgba(26,26,26,0.2) 0%, rgba(26,26,26,0.5) 100%);
    }

    .hero-content {
        position: relative;
        z-index: 2;
        text-align: center;
        color: white;
        max-width: 900px;
        padding: 0 2rem;
        animation: fadeUp 1.2s ease forwards;
    }

    .hero-label {
        display: inline-flex;
        align-items: center;
        gap: 1rem;
        font-size: 0.7rem;
        font-weight: 500;
        letter-spacing: 0.35em;
        text-transform: uppercase;
        color: var(--gold-light);
        margin-bottom: 2rem;
    }

    .hero-label::before, .hero-label::after {
        content: '';
        width: 40px;
        height: 1px;
        background: var(--gold-light);
    }

    .hero-title {
        font-family: var(--font-serif);
        font-size: clamp(3rem, 8vw, 7rem);
        font-weight: 300;
        line-height: 1.05;
        margin-bottom: 1.5rem;
        letter-spacing: -0.01em;
    }

    .hero-title em {
        font-style: italic;
        color: var(--gold-light);
    }

    .hero-subtitle {
        font-size: clamp(0.9rem, 2vw, 1.05rem);
        font-weight: 300;
        letter-spacing: 0.05em;
        opacity: 0.85;
        margin-bottom: 3rem;
        line-height: 1.8;
    }

    .hero-buttons {
        display: flex;
        gap: 1.5rem;
        justify-content: center;
        flex-wrap: wrap;
    }

    .hero-scroll {
        position: absolute;
        bottom: 2.5rem;
        left: 50%;
        transform: translateX(-50%);
        z-index: 2;
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 0.5rem;
        color: rgba(255,255,255,0.5);
        font-size: 0.65rem;
        letter-spacing: 0.2em;
        text-transform: uppercase;
        cursor: pointer;
        animation: bounce 2s infinite;
    }

    .hero-scroll::after {
        content: '';
        width: 1px;
        height: 40px;
        background: linear-gradient(to bottom, var(--gold-light), transparent);
    }

    @keyframes bounce {
        0%, 100% { transform: translateX(-50%) translateY(0); }
        50% { transform: translateX(-50%) translateY(-8px); }
    }

    /* ─── Stats ─── */
    .stats-strip {
        background: white;
        padding: 3rem 0;
        border-bottom: 1px solid var(--border);
    }

    .stats-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        text-align: center;
        gap: 2rem;
    }

    .stat-item { padding: 1rem; }

    .stat-number {
        font-family: var(--font-serif);
        font-size: clamp(2.5rem, 4vw, 3.5rem);
        font-weight: 300;
        color: var(--gold);
        line-height: 1;
        margin-bottom: 0.5rem;
    }

    .stat-label {
        font-size: 0.75rem;
        letter-spacing: 0.15em;
        text-transform: uppercase;
        color: var(--warm-gray);
    }

    /* ─── About Snippet ─── */
    .about-section {
        background: var(--cream);
    }

    .about-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 6rem;
        align-items: center;
    }

    .about-image-wrap {
        position: relative;
        min-width: 0;
        overflow: hidden;
    }

    .about-img-main {
        width: 100%;
        aspect-ratio: 4/5;
        object-fit: cover;
        display: block;
    }

    .about-img-badge {
        position: absolute;
        bottom: -2rem;
        right: -2rem;
        width: 160px;
        height: 160px;
        background: var(--gold);
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        color: white;
    }

    .about-img-badge .num {
        font-family: var(--font-serif);
        font-size: 3rem;
        font-weight: 300;
        line-height: 1;
    }

    .about-img-badge .text {
        font-size: 0.7rem;
        letter-spacing: 0.15em;
        text-transform: uppercase;
        text-align: center;
        margin-top: 0.25rem;
    }

    .about-content { 
        padding-left: 1rem;
        min-width: 0;
    }

    .about-content p {
        font-size: 0.95rem;
        line-height: 1.9;
        color: var(--warm-gray);
        margin-bottom: 1.5rem;
    }

    /* ─── Services ─── */
    .services-section { background: white; }

    .services-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 2px;
    }

    .service-card {
        position: relative;
        background: var(--cream);
        padding: 3rem 2.5rem;
        border: 1px solid var(--border);
        transition: all 0.4s;
        overflow: hidden;
    }

    .service-card::before {
        content: '';
        position: absolute;
        bottom: 0; left: 0; right: 0;
        height: 3px;
        background: var(--gold);
        transform: scaleX(0);
        transition: transform 0.4s;
    }

    .service-card:hover {
        background: white;
        transform: translateY(-4px);
        box-shadow: 0 20px 60px rgba(0,0,0,0.08);
    }

    .service-card:hover::before { transform: scaleX(1); }

    .service-icon {
        font-size: 2.5rem;
        margin-bottom: 1.5rem;
        display: block;
    }

    .service-card h3 {
        font-family: var(--font-serif);
        font-size: 1.4rem;
        font-weight: 400;
        margin-bottom: 1rem;
        color: var(--charcoal);
    }

    .service-card p {
        font-size: 0.875rem;
        color: var(--warm-gray);
        line-height: 1.8;
        margin-bottom: 1.5rem;
    }

    .service-price {
        font-family: var(--font-serif);
        font-size: 0.85rem;
        color: var(--gold);
        margin-bottom: 1.5rem;
    }

    .service-link {
        font-size: 0.75rem;
        font-weight: 500;
        letter-spacing: 0.2em;
        text-transform: uppercase;
        color: var(--charcoal);
        text-decoration: none;
        display: flex;
        align-items: center;
        gap: 0.75rem;
        transition: gap 0.3s, color 0.3s;
    }

    .service-link:hover { gap: 1.25rem; color: var(--gold); }

    /* ─── Gallery Masonry ─── */
    .gallery-section { background: var(--charcoal); color: white; }

    .gallery-section .section-title { color: white; }

    .gallery-masonry {
        columns: 3;
        column-gap: 1rem;
    }

    .gallery-item {
        break-inside: avoid;
        margin-bottom: 1rem;
        position: relative;
        overflow: hidden;
        cursor: pointer;
    }

    .gallery-item img {
        width: 100%;
        display: block;
        transition: transform 0.5s ease;
    }

    .gallery-item:hover img { transform: scale(1.05); }

    .gallery-item-overlay {
        position: absolute;
        inset: 0;
        background: rgba(0, 0, 0, 0.85);
        display: flex;
        align-items: center;
        justify-content: center;
        opacity: 0;
        transition: opacity 0.4s;
    }

    .gallery-item:hover .gallery-item-overlay { opacity: 1; }

    .gallery-item-overlay span {
        color: white;
        font-family: var(--font-serif);
        font-size: 1.1rem;
        font-weight: 300;
        letter-spacing: 0.05em;
    }

    /* ─── Testimonials ─── */
    .testimonials-section { background: var(--cream); }

    .testimonials-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 2rem;
    }

    .testimonial-card {
        background: white;
        padding: 2.5rem;
        border: 1px solid var(--border);
        position: relative;
    }

    .testimonial-quote {
        font-family: var(--font-serif);
        font-size: 4rem;
        color: var(--gold-light);
        line-height: 0.5;
        margin-bottom: 1rem;
        display: block;
    }

    .testimonial-text {
        font-size: 0.9rem;
        line-height: 1.9;
        color: var(--warm-gray);
        font-style: italic;
        margin-bottom: 1.5rem;
    }

    .testimonial-author {
        display: flex;
        align-items: center;
        gap: 1rem;
    }

    .testimonial-avatar {
        width: 48px; height: 48px;
        border-radius: 50%;
        background: var(--gold-light);
        display: flex; align-items: center; justify-content: center;
        font-family: var(--font-serif);
        font-size: 1.2rem;
        color: var(--gold-dark);
        overflow: hidden;
    }

    .testimonial-avatar img { width: 100%; height: 100%; object-fit: cover; }

    .testimonials-swiper {
        padding-bottom: 50px;
    }

    .testimonials-swiper .swiper-slide {
        height: auto;
        display: grid;
        gap: 2rem;
    }

    .swiper-pagination {
        bottom: 0 !important;
    }

    .swiper-pagination-bullet {
        width: 10px;
        height: 10px;
        opacity: 0.3;
        transition: all 0.3s ease;
    }

    .swiper-pagination-bullet-active {
        opacity: 1;
        transform: scale(1.3);
        background: #002E7A;
    }

    .author-name {
        font-family: var(--font-serif);
        font-size: 1rem;
        font-weight: 500;
    }

    .author-event {
        font-size: 0.75rem;
        color: var(--warm-gray);
        margin-top: 2px;
    }

    .stars { color: var(--gold); font-size: 0.8rem; margin-bottom: 0.5rem; }

    /* ─── Partners ─── */
    .partners-section { background: white; }

    .partners-strip {
        display: flex;
        align-items: center;
        gap: 3rem;
        flex-wrap: wrap;
        justify-content: center;
    }

    .partner-logo-item {
        filter: grayscale(1);
        opacity: 0.5;
        transition: all 0.3s;
        font-family: var(--font-serif);
        font-size: 1.1rem;
        color: var(--charcoal);
    }

    .partner-logo-item:hover { filter: none; opacity: 1; color: var(--gold); }

    /* ─── CTA ─── */
    .cta-section {
        background: var(--charcoal);
        text-align: center;
        padding: 8rem 2rem;
        position: relative;
        overflow: hidden;
    }

    .cta-section::before {
        content: '';
        position: absolute;
        inset: 0;
        background: url('https://images.unsplash.com/photo-1464366400600-7168b8af9bc3?w=1920&q=80') center/cover;
        opacity: 0.15;
    }

    .cta-content { position: relative; z-index: 1; max-width: 700px; margin: 0 auto; }

    .cta-content h2 {
        font-family: var(--font-serif);
        font-size: clamp(2.5rem, 5vw, 4.5rem);
        font-weight: 300;
        color: white;
        line-height: 1.2;
        margin-bottom: 1.5rem;
    }

    .cta-content p {
        color: rgba(255,255,255,0.7);
        font-size: 0.95rem;
        line-height: 1.8;
        margin-bottom: 2.5rem;
    }

    /* ─── Responsive ─── */
    @media (max-width: 1024px) {
        .services-grid { grid-template-columns: repeat(2, 1fr); }
        .testimonials-grid { grid-template-columns: repeat(2, 1fr); }
        .gallery-masonry { columns: 2; }
    }

    @media (max-width: 768px) {
        .about-grid { grid-template-columns: 1fr; gap: 3rem; }
        .about-img-badge { right: 1rem; }
        .stats-grid { grid-template-columns: repeat(2, 1fr); }
        .services-grid { grid-template-columns: 1fr; }
        .testimonials-grid { grid-template-columns: 1fr; }
        .gallery-masonry { columns: 1; }
    }
</style>
@endsection

@section('content')

<!-- Hero -->
<section class="hero">
    <div class="hero-bg"></div>
    <div class="hero-overlay"></div>

    <div class="hero-content">
        <div class="hero-label">
            {{ $profile->company_name ?? 'Gugugaga Wedding Organizer' }}
        </div>
        <h1 class="hero-title">
            Your Perfect<br><em>Love Story</em><br>Begins Here
        </h1>
        @php $settings = \App\Models\Setting::all()->pluck('value','key'); @endphp
        <p class="hero-subtitle">
            {{ $settings['hero_tagline'] ?? $profile->tagline ?? 'Kami hadir untuk mewujudkan...' }}
        </p>
        <div class="hero-buttons">
            <a href="{{ route('contact') }}" class="btn-primary">
                Konsultasi Gratis <i class="fas fa-arrow-right"></i>
            </a>
            <a href="{{ route('gallery') }}" class="btn-outline" style="border-color:rgba(255,255,255,0.5);color:white">
                Lihat Gallery
            </a>
        </div>
    </div>

    <div class="hero-scroll" onclick="document.querySelector('.stats-strip').scrollIntoView({behavior:'smooth'})">
        Scroll
    </div>
</section>

<!-- Stats -->
<div class="stats-strip">
    <div class="container">
        <div class="stats-grid">
            <div class="stat-item reveal">
                <div class="stat-number" data-count="{{ $profile->events_done ?? 350 }}">0</div>
                <div class="stat-label">Events Selesai</div>
            </div>
            <div class="stat-item reveal">
                <div class="stat-number" data-count="{{ $profile->happy_couples ?? 350 }}">0</div>
                <div class="stat-label">Pasangan Bahagia</div>
            </div>
            <div class="stat-item reveal">
                <div class="stat-number" data-count="{{ $profile->team_members ?? 25 }}">0</div>
                <div class="stat-label">Tim Profesional</div>
            </div>
            <div class="stat-item reveal">
                <div class="stat-number" data-count="{{ $profile->years_experience ?? 10 }}">0</div>
                <div class="stat-label">Tahun Pengalaman</div>
            </div>
        </div>
    </div>
</div>

<!-- About -->
<section class="about-section">
    <div class="container">
        <div class="about-grid">
            <div class="about-image-wrap reveal">
                <img src="{{ ($profile->hero_image && \Storage::disk('public')->exists($profile->hero_image)) ? asset('storage/'.$profile->hero_image) : 'https://images.unsplash.com/photo-1583939003579-730e3918a45a?w=800&q=80' }}"
                     alt="Wedding Organizer"
                     class="about-img-main">
                <div class="about-img-badge">
                    <span class="num">{{ $profile->years_experience ?? 10 }}+</span>
                    <span class="text">Years of Excellence</span>
                </div>
            </div>

            <div class="about-content reveal">
                <span class="section-label">Tentang Kami</span>
                <h2 class="section-title" style="text-align:left">
                    {{ $profile->tagline ?? 'Crafting Your Perfect Love Story' }}</em>
                </h2>
                <div class="section-divider" style="margin:1.5rem 0"></div>
                <p>
                    {{ $profile->description ?? 'Gugugaga Wedding Organizer adalah tim profesional yang berdedikasi untuk menciptakan momen pernikahan impian Anda.' }}
                </p>               
                <a href="{{ route('profile') }}" class="btn-primary" style="margin-top:0.5rem">
                    Pelajari Lebih Lanjut <i class="fas fa-arrow-right"></i>
                </a>
            </div>
        </div>
    </div>
</section>

<!-- Services -->
<section class="services-section">
    <div class="container">
        <div class="section-header reveal">
            <span class="section-label">Layanan Kami</span>
            <h2 class="section-title">Everything You Need<br>for Your Special Day</h2>
            <div class="section-divider"></div>
            <p class="section-subtitle">Dari perencanaan awal hingga hari H, kami hadir dengan layanan lengkap dan profesional</p>
        </div>

        <div class="services-grid">
            @foreach($services->take(6) as $service)
            <div class="service-card reveal">
                <span class="service-icon">{{ $service->icon ?? '💍' }}</span>
                <h3>{{ $service->name }}</h3>
                <p>{{ $service->short_description }}</p>
                @if($service->price_start)
                <div class="service-price">
                    Mulai dari Rp {{ number_format($service->price_start, 0, ',', '.') }}
                </div>
                @endif
                <a href="{{ route('services.show', $service->slug) }}" class="service-link">
                    Selengkapnya <i class="fas fa-arrow-right"></i>
                </a>
            </div>
            @endforeach
        </div>

        <div style="text-align:center;margin-top:3rem">
            <a href="{{ route('services') }}" class="btn-outline">Lihat Semua Layanan</a>
        </div>
    </div>
</section>

<!-- Gallery -->
<section class="gallery-section">
    <div class="container">
        <div class="section-header reveal">
            <span class="section-label" style="color:var(--gold-light)">Gallery</span>
            <h2 class="section-title">Moments We've <em style="font-style:italic;color:var(--gold-light)">Captured</em></h2>
            <div class="section-divider"></div>
        </div>

        <div class="gallery-masonry">
            @php
                $galleryFallback = [
                    'https://images.unsplash.com/photo-1519741497674-611481863552?w=800&q=80',
                    'https://images.unsplash.com/photo-1465495976277-4387d4b0b4c6?w=800&q=80',
                    'https://images.unsplash.com/photo-1510076857177-7470076d4098?w=800&q=80',
                    'https://images.unsplash.com/photo-1583939003579-730e3918a45a?w=800&q=80',
                    'https://images.unsplash.com/photo-1469371670807-013ccf25f16a?w=800&q=80',
                    'https://images.unsplash.com/photo-1518049362265-d5b2a6467637?w=800&q=80',
                ];
            @endphp

            @foreach($galleries->take(6) as $i => $item)
            @php
                $fileExists = $item->file_path && \Storage::disk('public')->exists($item->file_path);
                $fallbackSrc = $galleryFallback[$i % count($galleryFallback)];
                $src = $fileExists ? asset('storage/' . $item->file_path) : $fallbackSrc;
            @endphp

            <div class="gallery-item reveal">
                @if($fileExists && $item->file_type === 'video')
                    <video muted autoplay loop playsinline style="width:100%;display:block">
                        <source src="{{ $src }}" type="video/mp4">
                    </video>
                @else
                    <img src="{{ $src }}"
                        alt="{{ $item->title }}"
                        loading="lazy"
                        onerror="this.src='{{ $fallbackSrc }}'">
                @endif
                <div class="gallery-item-overlay">
                    <span>{{ $item->title }}</span>
                </div>
            </div>
            @endforeach
        </div>

        <div style="text-align:center;margin-top:3rem">
            <a href="{{ route('gallery') }}" class="btn-outline" style="border-color:rgba(255, 255, 255, 0.5);color:var(--gold-light)">
                Lihat Semua Gallery
            </a>
        </div>
    </div>
</section>

<!-- Testimonials -->
<section class="testimonials-section">
    <div class="container">
        <div class="section-header reveal">
            <span class="section-label">Testimoni</span>
            <h2 class="section-title">Words from Happy <em style="font-style:italic;color:var(--gold)">Couples</em></h2>
            <div class="section-divider"></div>
        </div>


            <div class="swiper testimonials-swiper">
                <div class="swiper-wrapper">
                    @foreach($testimonials->take(5) as $testimonial)
                        <div class="swiper-slide">
                            <div class="testimonial-card">
                                <div class="stars">★★★★★</div>
                                <span class="testimonial-quote">"</span>

                                <p class="testimonial-text">
                                    {{ $testimonial->testimonial }}
                                </p>

                                <div class="testimonial-author">
                                    <div class="testimonial-avatar">
                                        @if($testimonial->photo)
                                            <img src="{{ asset('storage/' . $testimonial->photo) }}"
                                                alt="{{ $testimonial->couple_name }}">
                                        @else
                                            {{ substr($testimonial->couple_name, 0, 1) }}
                                        @endif
                                    </div>

                                    <div>
                                        <div class="author-name">{{ $testimonial->couple_name }}</div>
                                        <div class="author-event">
                                            {{ $testimonial->event_date }} · {{ $testimonial->event_type }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="swiper-pagination"></div>
            </div>

    </div>
</section>

<!-- Partners -->
<section class="partners-section">
    <div class="container">
        <div class="section-header reveal">
            <span class="section-label">Kolaborasi</span>
            <h2 class="section-title">Our Trusted <em style="font-style:italic;color:var(--gold)">Partners</em></h2>
            <div class="section-divider"></div>
        </div>

        <div class="partners-strip reveal">
            @foreach($partners as $partner)
            <div class="partner-logo-item" title="{{ $partner->name }}">
                @if($partner->logo && !str_contains($partner->logo, 'default'))
                    <img src="{{ asset('storage/'.$partner->logo) }}"
                        alt="{{ $partner->name }}"
                        style="height:40px;object-fit:contain;filter:grayscale(1);opacity:0.6;transition:all 0.3s"
                        onmouseover="this.style.filter='none';this.style.opacity='1'"
                        onmouseout="this.style.filter='grayscale(1)';this.style.opacity='0.6'">
                @else
                    <span style="font-family:var(--font-serif);font-size:1.1rem">{{ $partner->name }}</span>
                @endif
            </div>
            @endforeach
        </div>

        <div style="text-align:center;margin-top:3rem">
            <a href="{{ route('partners') }}" class="btn-outline">Lihat Semua Partner</a>
        </div>
    </div>
</section>

<!-- CTA -->
<section class="cta-section">
    <div class="cta-content reveal">
        <div class="ornament"><i class="fas fa-ring"></i></div>
        <h2>Ready to Start Your<br><em style="font-style:italic;color:var(--gold-light)">Love Story?</em></h2>
        <p>Hubungi kami sekarang dan dapatkan konsultasi gratis untuk mewujudkan pernikahan impian Anda</p>
        <div style="display:flex;gap:1.5rem;justify-content:center;flex-wrap:wrap">
            <a href="{{ route('contact') }}" class="btn-primary">
                Konsultasi Sekarang <i class="fas fa-arrow-right"></i>
            </a>
            @if($profile && $profile->whatsapp)
            <a href="https://wa.me/{{ $profile->whatsapp }}" target="_blank" class="btn-outline" style="border-color:rgba(255,255,255,0.4);color:white">
                <i class="fab fa-whatsapp"></i> WhatsApp
            </a>
            @endif
        </div>
    </div>
</section>

@endsection

@section('scripts')
<script>
new Swiper(".testimonials-swiper", {
    loop: true,
    speed: 800,
    spaceBetween: 24,

    autoplay: {
        delay: 4000,
        disableOnInteraction: false,
        pauseOnMouseEnter: true,
    },

    pagination: {
        el: ".swiper-pagination",
        clickable: true,
    },

    breakpoints: {
        0: {
            slidesPerView: 1,
        },
        768: {
            slidesPerView: 2,
        },
        1200: {
            slidesPerView: 3,
        }
    }
});
</script>
<script>
    // Counter animation
    const counters = document.querySelectorAll('[data-count]');
    const countObserver = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                const el = entry.target;
                const target = parseInt(el.dataset.count);
                const duration = 2000;
                const step = target / (duration / 16);
                let current = 0;
                const timer = setInterval(() => {
                    current += step;
                    if (current >= target) { current = target; clearInterval(timer); }
                    el.textContent = Math.floor(current) + '+';
                }, 16);
                countObserver.unobserve(el);
            }
        });
    }, { threshold: 0.5 });
    counters.forEach(c => countObserver.observe(c));
</script>
@endsection
