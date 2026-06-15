@extends('layouts.frontend')
@section('title', 'Partner Kami - ' . ($profile->company_name ?? 'Gugugaga'))
@section('styles')
<style>
.page-hero { min-height:45vh; background:var(--charcoal); display:flex; align-items:center; justify-content:center; text-align:center; position:relative; }
.page-hero::before { content:''; position:absolute; inset:0; background:url('https://images.unsplash.com/photo-1510076857177-7470076d4098?w=800&q=80') center/cover; opacity:0.2; }
.page-hero-content { position:relative; z-index:1; color:white; }
.page-hero h1 { font-family:var(--font-serif); font-size:clamp(2.5rem,5vw,4.5rem); font-weight:300; }
.filter-tabs { display:flex; gap:1rem; justify-content:center; flex-wrap:wrap; margin-bottom:3rem; }
.filter-btn { padding:0.6rem 1.8rem; border:1px solid var(--border); background:none; font-family:var(--font-sans); font-size:0.75rem; letter-spacing:0.15em; text-transform:uppercase; cursor:pointer; transition:all 0.3s; color:var(--warm-gray); }
.filter-btn.active, .filter-btn:hover { border-color:var(--gold); color:var(--gold); background:rgba(201,169,110,0.05); }
.partners-grid { display:grid; grid-template-columns:repeat(4,1fr); gap:1.5rem; }
.partner-card { background:white; border:1px solid var(--border); padding:2.5rem 2rem; text-align:center; transition:all 0.35s; display:flex; flex-direction:column; align-items:center; justify-content:center; }
.partner-card:hover { border-color:var(--gold); transform:translateY(-4px); box-shadow:0 15px 40px rgba(0,0,0,0.07); }
.partner-logo-wrap { width:80px; height:80px; background:var(--cream); border-radius:50%; display:flex; align-items:center; justify-content:center; margin-bottom:1.25rem; font-family:var(--font-serif); font-size:1.8rem; color:var(--gold); }
.partner-card h4 { font-family:var(--font-serif); font-size:1.05rem; font-weight:500; color:var(--charcoal); margin-bottom:0.3rem; }
.partner-cat { font-size:0.7rem; letter-spacing:0.15em; text-transform:uppercase; color:var(--gold); margin-bottom:0.75rem; }
.partner-card p { font-size:0.8rem; color:var(--warm-gray); line-height:1.6; }
.partner-website { display:inline-flex; align-items:center; gap:0.4rem; margin-top:1rem; font-size:0.75rem; color:var(--gold); text-decoration:none; letter-spacing:0.1em; }
.collab-cta { background:var(--cream); border:1px solid var(--border); padding:4rem; text-align:center; margin-top:4rem; }
.collab-cta h3 { font-family:var(--font-serif); font-size:2rem; font-weight:400; margin-bottom:1rem; }
.collab-cta p { color:var(--warm-gray); font-size:0.9rem; margin-bottom:2rem; }
@media (max-width:1024px) { .partners-grid { grid-template-columns:repeat(3,1fr); } }
@media (max-width:768px) { .partners-grid { grid-template-columns:repeat(2,1fr); } }
@media (max-width:480px) { .partners-grid { grid-template-columns:1fr; } }
</style>
@endsection

@section('content')
<div style="padding-top:80px">
    <div class="page-hero">
        <div class="page-hero-content">
            <span class="section-label" style="color:var(--gold-light)">Kolaborasi</span>
            <h1>Partner <em style="font-style:italic;color:var(--gold-light)">Kami</em></h1>
        </div>
    </div>
</div>

<section>
    <div class="container">
        <div class="section-header reveal">
            <span class="section-label">Trusted Network</span>
            <h2 class="section-title">Vendor & Partner <em style="font-style:italic;color:var(--gold)">Terpercaya</em></h2>
            <div class="section-divider"></div>
            <p class="section-subtitle">Kami berkolaborasi dengan vendor-vendor terbaik untuk memastikan kualitas terbaik di setiap aspek pernikahan Anda</p>
        </div>

        @if($categories->count())
        <div class="filter-tabs">
            <button class="filter-btn active" data-filter="all">Semua</button>
            @foreach($categories as $cat)
            <button class="filter-btn" data-filter="{{ Str::slug($cat) }}">{{ $cat }}</button>
            @endforeach
        </div>
        @endif

        <div class="partners-grid">
            @foreach($partners as $partner)
            <div class="partner-card reveal" data-category="{{ Str::slug($partner->category) }}">
                <div class="partner-logo-wrap">
                    @if($partner->logo && !str_contains($partner->logo, 'default'))
                        <img src="{{ asset('storage/'.$partner->logo) }}" alt="{{ $partner->name }}" style="width:60px;height:60px;object-fit:contain">
                    @else
                        {{ strtoupper(substr($partner->name, 0, 1)) }}
                    @endif
                </div>
                <div class="partner-cat">{{ $partner->category }}</div>
                <h4>{{ $partner->name }}</h4>
                @if($partner->description)
                <p>{{ $partner->description }}</p>
                @endif
                @if($partner->website)
                <a href="{{ $partner->website }}" target="_blank" class="partner-website">
                    <i class="fas fa-external-link-alt" style="font-size:0.65rem"></i> Visit Website
                </a>
                @endif
            </div>
            @endforeach
        </div>

        <!-- Collaboration CTA -->
        <div class="collab-cta reveal">
            <div class="ornament"><i class="fas fa-handshake"></i></div>
            <h3>Ingin Berkolaborasi Bersama Kami?</h3>
            <p>Kami selalu terbuka untuk menjalin kerjasama dengan vendor dan partner baru yang berpengalaman dan profesional</p>
            <a href="{{ route('contact') }}" class="btn-primary">Hubungi Kami <i class="fas fa-arrow-right"></i></a>
        </div>
    </div>
</section>
@endsection

@section('scripts')
<script>
document.querySelectorAll('.filter-btn').forEach(btn => {
    btn.addEventListener('click', function() {
        document.querySelectorAll('.filter-btn').forEach(b => b.classList.remove('active'));
        this.classList.add('active');
        const filter = this.dataset.filter;
        document.querySelectorAll('.partner-card').forEach(card => {
            card.style.display = (filter === 'all' || card.dataset.category === filter) ? '' : 'none';
        });
    });
});
</script>
@endsection
