@extends('layouts.frontend')
@section('title', 'Gallery - ' . ($profile->company_name ?? 'Gugugaga'))
@section('styles')
<style>
.page-hero { min-height: 50vh; background: var(--charcoal); display:flex; align-items:center; justify-content:center; text-align:center; position:relative; overflow:hidden; }
.page-hero::before { content:''; position:absolute; inset:0; background:url('https://images.unsplash.com/photo-1465495976277-4387d4b0b4c6?w=1920&q=80') center/cover; opacity:0.25; }
.page-hero-content { position:relative; z-index:1; color:white; }
.page-hero h1 { font-family:var(--font-serif); font-size:clamp(3rem,6vw,5rem); font-weight:300; margin-top:1rem; }
.filter-tabs { display:flex; gap:1rem; justify-content:center; flex-wrap:wrap; margin-bottom:3rem; }
.filter-btn { padding:0.6rem 1.8rem; border:1px solid var(--border); background:none; font-family:var(--font-sans); font-size:0.75rem; letter-spacing:0.15em; text-transform:uppercase; cursor:pointer; transition:all 0.3s; color:var(--warm-gray); }
.filter-btn.active, .filter-btn:hover { border-color:var(--gold); color:var(--gold); background:rgba(201,169,110,0.05); }
.gallery-masonry { columns:3; column-gap:1rem; }
.gallery-item { break-inside:avoid; margin-bottom:1rem; position:relative; overflow:hidden; cursor:pointer; }
.gallery-item img, .gallery-item video { width:100%; display:block; transition:transform 0.5s; }
.gallery-item:hover img, .gallery-item:hover video { transform:scale(1.04); }
.gallery-overlay { position:absolute; inset:0; background:rgba(0,0,0,0.6); display:flex; flex-direction:column; align-items:center; justify-content:center; opacity:0; transition:opacity 0.4s; }
.gallery-item:hover .gallery-overlay { opacity:1; }
.gallery-overlay h4 { color:white; font-family:var(--font-serif); font-size:1.1rem; font-weight:400; margin-bottom:0.3rem; }
.gallery-overlay span { color:var(--gold-light); font-size:0.75rem; letter-spacing:0.1em; }
/* Lightbox */
.lightbox { display:none; position:fixed; inset:0; background:rgba(0,0,0,0.95); z-index:2000; align-items:center; justify-content:center; }
.lightbox.open { display:flex; }
.lightbox-content { max-width:90vw; max-height:90vh; }
.lightbox-content img { max-width:100%; max-height:85vh; object-fit:contain; }
.lightbox-close { position:fixed; top:1.5rem; right:2rem; color:white; font-size:2rem; cursor:pointer; background:none; border:none; }
@media (max-width:768px) { .gallery-masonry { columns:2; } }
@media (max-width:480px) { .gallery-masonry { columns:1; } }
</style>
@endsection

@section('content')
<div style="padding-top:80px">
    <div class="page-hero">
        <div class="page-hero-content">
            <span class="section-label" style="color:var(--gold-light)">Our Work</span>
            <h1>Gallery & <em style="font-style:italic;color:var(--gold-light)">Moments</em></h1>
        </div>
    </div>
</div>

<section>
    <div class="container">
        <div class="filter-tabs">
            <button class="filter-btn active" data-filter="all">Semua</button>
            @foreach($categories as $cat)
            <button class="filter-btn" data-filter="{{ Str::slug($cat) }}">{{ $cat }}</button>
            @endforeach
        </div>

        @php
        $stockImages = [
            'https://images.unsplash.com/photo-1519741497674-611481863552?w=800&q=80',
            'https://images.unsplash.com/photo-1465495976277-4387d4b0b4c6?w=800&q=80',
            'https://images.unsplash.com/photo-1510076857177-7470076d4098?w=800&q=80',
            'https://images.unsplash.com/photo-1583939003579-730e3918a45a?w=800&q=80',
            'https://images.unsplash.com/photo-1469371670807-013ccf25f16a?w=800&q=80',
            'https://images.unsplash.com/photo-1518049362265-d5b2a6467637?w=800&q=80',
        ];
        @endphp

        <div class="gallery-masonry" id="galleryGrid">
            @foreach($galleries as $i => $item)
            <div class="gallery-item reveal" data-category="{{ Str::slug($item->category) }}"
                onclick="openLightbox('{{ asset('storage/' . $item->file_path) }}', '{{ $item->title }}', '{{ $item->file_type }}')">

                {{-- Cek apakah file dari database atau pakai placeholder --}}
                @if($item->file_path && !str_contains($item->file_path, 'placeholder'))
                    @if($item->file_type === 'video')
                        {{-- Tampilkan video --}}
                        <video muted autoplay loop playsinline style="width:100%;display:block">
                            <source src="{{ asset('storage/' . $item->file_path) }}" type="video/mp4">
                        </video>
                    @else
                        {{-- Tampilkan gambar dari database --}}
                        <img src="{{ asset('storage/' . $item->file_path) }}"
                            alt="{{ $item->title }}" loading="lazy">
                    @endif
                @else
                    {{-- Fallback ke stock image --}}
                    <img src="{{ $stockImages[$i % count($stockImages)] }}"
                        alt="{{ $item->title }}" loading="lazy">
                @endif

                <div class="gallery-overlay">
                    <h4>{{ $item->title }}</h4>
                    <span>{{ $item->category }}</span>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

<!-- Lightbox -->
<div class="lightbox" id="lightbox" onclick="closeLightbox()">
    <button class="lightbox-close">✕</button>
    <div class="lightbox-content" onclick="event.stopPropagation()">
        <img src="" id="lightboxImg" alt="">
    </div>
</div>
@endsection

@section('scripts')
<script>
function openLightbox(src, title, type) {
    const lightbox = document.getElementById('lightbox');
    const container = lightbox.querySelector('.lightbox-content');

    // Kosongkan dulu
    container.innerHTML = '';

    if (type === 'video') {
        container.innerHTML = `
            <video controls autoplay style="max-width:90vw;max-height:85vh;display:block">
                <source src="${src}" type="video/mp4">
            </video>`;
    } else {
        container.innerHTML = `
            <img src="${src}" alt="${title}" style="max-width:90vw;max-height:85vh;object-fit:contain">`;
    }

    lightbox.classList.add('open');
    document.body.style.overflow = 'hidden';
}

function closeLightbox() {
    const lightbox = document.getElementById('lightbox');
    // Hentikan video saat lightbox ditutup
    const video = lightbox.querySelector('video');
    if (video) video.pause();

    lightbox.classList.remove('open');
    document.body.style.overflow = '';
}

document.addEventListener('keydown', e => { if(e.key === 'Escape') closeLightbox(); });

// Filter kategori
document.querySelectorAll('.filter-btn').forEach(btn => {
    btn.addEventListener('click', function() {
        document.querySelectorAll('.filter-btn').forEach(b => b.classList.remove('active'));
        this.classList.add('active');
        const filter = this.dataset.filter;
        document.querySelectorAll('.gallery-item').forEach(item => {
            item.style.display = (filter === 'all' || item.dataset.category === filter) ? '' : 'none';
        });
    });
});
</script>
@endsection
