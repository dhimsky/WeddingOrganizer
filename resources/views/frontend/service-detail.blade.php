@extends('layouts.frontend')
@section('title', $service->name . ' - ' . ($profile->company_name ?? 'Gugugaga'))
@section('styles')
<style>
.service-hero { min-height:55vh; background:var(--charcoal); display:flex; align-items:center; position:relative; overflow:hidden; }
.service-hero::before { content:''; position:absolute; inset:0; background:url('https://images.unsplash.com/photo-1519741497674-611481863552?w=1920&q=80') center/cover; opacity:0.25; }
.service-hero-content { position:relative; z-index:1; color:white; max-width:700px; padding:0 2rem; }
.service-hero h1 { font-family:var(--font-serif); font-size:clamp(2.5rem,5vw,4rem); font-weight:300; margin:0.5rem 0 1rem; }
.breadcrumb { display:flex; align-items:center; gap:0.75rem; font-size:0.75rem; color:rgba(255,255,255,0.6); margin-bottom:1rem; }
.breadcrumb a { color:var(--gold-light); text-decoration:none; }
.breadcrumb span { color:rgba(255,255,255,0.4); }
.detail-grid { display:grid; grid-template-columns:1fr 380px; gap:4rem; align-items:start; }
.detail-content h2 { font-family:var(--font-serif); font-size:1.8rem; font-weight:400; margin-bottom:1rem; }
.detail-content p { color:var(--warm-gray); line-height:1.9; font-size:0.95rem; margin-bottom:1.5rem; }
.features-list { list-style:none; margin:2rem 0; }
.features-list li { display:flex; align-items:center; gap:0.875rem; padding:0.875rem 0; border-bottom:1px solid var(--border); font-size:0.9rem; }
.features-list li i { color:var(--gold); font-size:0.8rem; background:rgba(201,169,110,0.1); width:28px; height:28px; border-radius:50%; display:flex; align-items:center; justify-content:center; flex-shrink:0; }
.sidebar-card { background:white; border:1px solid var(--border); padding:2.5rem; position:sticky; top:120px; }
.sidebar-card h3 { font-family:var(--font-serif); font-size:1.4rem; font-weight:400; margin-bottom:0.5rem; }
.price-display { font-family:var(--font-serif); font-size:1.8rem; font-weight:300; color:var(--gold); margin:1.5rem 0; }
.price-display small { font-size:0.8rem; color:var(--warm-gray); font-family:var(--font-sans); }
.sidebar-card .btn-primary, .sidebar-card .btn-outline { display:block; text-align:center; justify-content:center; width:100%; margin-bottom:0.75rem; }
.related-section { background:var(--cream); }
.related-grid { display:grid; grid-template-columns:repeat(3,1fr); gap:1.5rem; }
@media (max-width:1024px) { .detail-grid { grid-template-columns:1fr; } .sidebar-card { position:static; } }
@media (max-width:768px) { .related-grid { grid-template-columns:1fr; } }
</style>
@endsection

@section('content')
<div style="padding-top:80px">
    <div class="service-hero">
        <div class="service-hero-content">
            <div class="breadcrumb">
                <a href="{{ route('home') }}">Home</a><span>/</span>
                <a href="{{ route('services') }}">Layanan</a><span>/</span>
                <span>{{ $service->name }}</span>
            </div>
            <span style="font-size:3rem">{{ $service->icon ?? '💍' }}</span>
            <h1>{{ $service->name }}</h1>
            <p style="color:rgba(255,255,255,0.7);font-size:0.95rem;line-height:1.7">{{ $service->short_description }}</p>
        </div>
    </div>
</div>

<section>
    <div class="container">
        <div class="detail-grid">
            <div class="detail-content reveal">
                <h2>Tentang Layanan Ini</h2>
                <p>{{ $service->description }}</p>

                @if($service->features)
                <h3 style="font-family:var(--font-serif);font-size:1.3rem;font-weight:400;margin-bottom:0.5rem">Apa yang Anda Dapatkan</h3>
                <ul class="features-list">
                    @foreach($service->features as $feature)
                    <li><i class="fas fa-check"></i> {{ $feature }}</li>
                    @endforeach
                </ul>
                @endif
            </div>

            <div class="reveal">
                <div class="sidebar-card">
                    <h3>{{ $service->name }}</h3>
                    @if($service->price_start)
                    <div class="price-display">
                        Rp {{ number_format($service->price_start, 0, ',', '.') }}
                        @if($service->price_end) - {{ number_format($service->price_end, 0, ',', '.') }} @endif
                        <br><small>*Harga dapat disesuaikan</small>
                    </div>
                    @endif
                    <a href="{{ route('contact') }}?service={{ $service->slug }}" class="btn-primary">
                        Konsultasi Gratis
                    </a>
                    @if($profile && $profile->whatsapp)
                    <a href="https://wa.me/{{ $profile->whatsapp }}?text=Halo, saya tertarik dengan layanan {{ $service->name }}" target="_blank" class="btn-outline">
                        <i class="fab fa-whatsapp"></i> WhatsApp
                    </a>
                    @endif

                    <div style="margin-top:2rem;padding-top:2rem;border-top:1px solid var(--border)">
                        <div style="display:flex;align-items:center;gap:0.75rem;margin-bottom:0.75rem">
                            <i class="fas fa-phone" style="color:var(--gold);width:20px"></i>
                            <span style="font-size:0.875rem">{{ $profile->phone ?? '' }}</span>
                        </div>
                        <div style="display:flex;align-items:center;gap:0.75rem">
                            <i class="fas fa-envelope" style="color:var(--gold);width:20px"></i>
                            <span style="font-size:0.875rem">{{ $profile->email ?? '' }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@if($related->count())
<section class="related-section">
    <div class="container">
        <div class="section-header reveal">
            <span class="section-label">Layanan Lainnya</span>
            <h2 class="section-title">You Might Also <em style="font-style:italic;color:var(--gold)">Like</em></h2>
            <div class="section-divider"></div>
        </div>
        <div class="related-grid">
            @foreach($related as $item)
            <a href="{{ route('services.show', $item->slug) }}" style="text-decoration:none">
                <div class="service-card reveal" style="height:100%">
                    <span class="service-icon">{{ $item->icon ?? '💍' }}</span>
                    <h3>{{ $item->name }}</h3>
                    <p>{{ $item->short_description }}</p>
                    <span class="service-link">Selengkapnya <i class="fas fa-arrow-right"></i></span>
                </div>
            </a>
            @endforeach
        </div>
    </div>
</section>
@endif
@endsection
