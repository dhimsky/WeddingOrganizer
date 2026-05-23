@extends('layouts.frontend')
@section('title', 'Layanan - ' . ($profile->company_name ?? 'Gugugaga'))
@section('styles')
<style>
.page-hero { min-height:45vh; background:var(--charcoal); display:flex; align-items:center; justify-content:center; text-align:center; position:relative; }
.page-hero::before { content:''; position:absolute; inset:0; background:url('https://images.unsplash.com/photo-1583939003579-730e3918a45a?w=1920&q=80') center/cover; opacity:0.2; }
.page-hero-content { position:relative; z-index:1; color:white; }
.page-hero h1 { font-family:var(--font-serif); font-size:clamp(2.5rem,5vw,4.5rem); font-weight:300; }
.services-list { display:grid; grid-template-columns:1fr; gap:0; }
.service-row { display:grid; grid-template-columns:1fr 1fr; min-height:420px; border-bottom:1px solid var(--border); }
.service-row:nth-child(even) { direction:rtl; }
.service-row:nth-child(even) > * { direction:ltr; }
.service-img { overflow:hidden; position:relative; }
.service-img img { width:100%; height:100%; object-fit:cover; transition:transform 0.6s; }
.service-row:hover .service-img img { transform:scale(1.04); }
.service-body { padding:4rem; display:flex; flex-direction:column; justify-content:center; background:white; }
.service-body .service-icon { font-size:2.5rem; margin-bottom:1rem; }
.service-body h2 { font-family:var(--font-serif); font-size:2rem; font-weight:400; margin-bottom:1rem; }
.service-body p { color:var(--warm-gray); font-size:0.9rem; line-height:1.9; margin-bottom:1.5rem; }
.service-features { list-style:none; margin-bottom:2rem; }
.service-features li { display:flex; align-items:center; gap:0.75rem; font-size:0.875rem; color:var(--warm-gray); padding:0.4rem 0; border-bottom:1px solid var(--border); }
.service-features li i { color:var(--gold); font-size:0.75rem; }
.price-tag { font-family:var(--font-serif); font-size:1.1rem; color:var(--gold); margin-bottom:1.5rem; }
@media (max-width:768px) {
    .service-row { grid-template-columns:1fr; }
    .service-row:nth-child(even) { direction:ltr; }
    .service-img { height:280px; }
    .service-body { padding:2.5rem; }
}
</style>
@endsection

@section('content')
<div style="padding-top:80px">
    <div class="page-hero">
        <div class="page-hero-content">
            <span class="section-label" style="color:var(--gold-light)">What We Offer</span>
            <h1>Layanan <em style="font-style:italic;color:var(--gold-light)">Kami</em></h1>
        </div>
    </div>
</div>

<section style="padding:0">
    <div class="services-list">
        @php
        $serviceImages = [
            'https://images.unsplash.com/photo-1519741497674-611481863552?w=900&q=80',
            'https://images.unsplash.com/photo-1465495976277-4387d4b0b4c6?w=900&q=80',
            'https://images.unsplash.com/photo-1510076857177-7470076d4098?w=900&q=80',
            'https://images.unsplash.com/photo-1583939003579-730e3918a45a?w=900&q=80',
        ];
        @endphp

        @foreach($services as $i => $service)
        <div class="service-row reveal">
            <div class="service-img">
                <img src="{{ $service->image ? asset('storage/' . $service->image) : $serviceImages[$i % count($serviceImages)] }}" alt="{{ $service->name }}">
            </div>
            <div class="service-body">
                <span class="service-icon">{{ $service->icon ?? '💍' }}</span>
                <h2>{{ $service->name }}</h2>
                <p>{{ $service->description }}</p>
                @if($service->features)
                <ul class="service-features">
                    @foreach(array_slice($service->features, 0, 5) as $feature)
                    <li><i class="fas fa-check"></i> {{ $feature }}</li>
                    @endforeach
                </ul>
                @endif
                @if($service->price_start)
                <div class="price-tag">Mulai dari Rp {{ number_format($service->price_start, 0, ',', '.') }}</div>
                @endif
                <a href="{{ route('contact') }}" class="btn-primary" style="align-self:flex-start">
                    Konsultasi <i class="fas fa-arrow-right"></i>
                </a>
            </div>
        </div>
        @endforeach
    </div>
</section>

<!-- CTA -->
<section style="background:var(--charcoal);text-align:center;padding:6rem 2rem;position:relative">
    <div style="position:absolute;inset:0;background:url('https://images.unsplash.com/photo-1464366400600-7168b8af9bc3?w=1920&q=80') center/cover;opacity:0.12"></div>
    <div style="position:relative;z-index:1;max-width:600px;margin:0 auto">
        <span class="section-label" style="color:var(--gold-light)">Mulai Sekarang</span>
        <h2 style="font-family:var(--font-serif);font-size:clamp(2rem,4vw,3.5rem);font-weight:300;color:white;margin:1rem 0">Tidak Menemukan Paket yang Sesuai?</h2>
        <p style="color:rgba(255,255,255,0.7);margin-bottom:2rem">Kami juga menerima permintaan custom sesuai kebutuhan dan budget Anda</p>
        <a href="{{ route('contact') }}" class="btn-primary">Diskusi Custom Package</a>
    </div>
</section>
@endsection
