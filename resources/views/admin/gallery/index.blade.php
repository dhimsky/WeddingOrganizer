@extends('layouts.admin')
@section('title', 'Kelola Gallery')
@section('page-title', 'Gallery')
@section('breadcrumb', 'Kelola foto dan video wedding')

@section('topbar-actions')
<a href="{{ route('admin.gallery.create') }}" class="topbar-btn primary">
    <i class="fas fa-upload"></i> Upload Media
</a>
@endsection

@section('styles')
<style>
.gallery-admin-grid { display:grid; grid-template-columns:repeat(auto-fill,minmax(200px,1fr)); gap:1rem; }
.gallery-admin-item { position:relative; background:white; border:1px solid #EDE9E3; overflow:hidden; }
.gallery-admin-thumb { position:relative; aspect-ratio:4/3; overflow:hidden; background:var(--bg); }
.gallery-admin-thumb img { width:100%;height:100%;object-fit:cover;transition:transform 0.3s; }
.gallery-admin-item:hover .gallery-admin-thumb img { transform:scale(1.04); }
.gallery-item-info { padding:0.875rem; }
.gallery-item-info h5 { font-size:0.82rem;font-weight:500;margin-bottom:0.25rem;white-space:nowrap;overflow:hidden;text-overflow:ellipsis; }
.gallery-item-meta { font-size:0.72rem;color:var(--warm-gray); }
.gallery-item-actions { display:flex;gap:0.35rem;margin-top:0.625rem; }
.featured-badge { position:absolute;top:0.5rem;left:0.5rem;background:var(--gold);color:white;font-size:0.65rem;padding:0.2rem 0.5rem;letter-spacing:0.08em; }
.type-badge { position:absolute;top:0.5rem;right:0.5rem;background:rgba(0,0,0,0.6);color:white;font-size:0.65rem;padding:0.2rem 0.5rem; }
</style>
@endsection

@section('content')
<div class="card">
    @if($galleries->count())
    <div class="gallery-admin-grid">
        @php
        $imgs = [
            'https://images.unsplash.com/photo-1519741497674-611481863552?w=400&q=70',
            'https://images.unsplash.com/photo-1465495976277-4387d4b0b4c6?w=400&q=70',
            'https://images.unsplash.com/photo-1510076857177-7470076d4098?w=400&q=70',
            'https://images.unsplash.com/photo-1583939003579-730e3918a45a?w=400&q=70',
        ];
        @endphp
        @foreach($galleries as $i => $item)
        <div class="gallery-admin-item">
            <div class="gallery-admin-thumb">
                @if($item->file_type === 'video')
                    <div style="width:100%;height:100%;display:flex;align-items:center;justify-content:center;background:#1A1A1A">
                        <i class="fas fa-play-circle" style="font-size:3rem;color:rgba(255,255,255,0.6)"></i>
                    </div>
                    <span class="type-badge"><i class="fas fa-video"></i> Video</span>
                @else
                    <img src="{{ $imgs[$i % count($imgs)] }}" alt="{{ $item->title }}">
                    <span class="type-badge"><i class="fas fa-image"></i> Foto</span>
                @endif
                @if($item->is_featured)
                <span class="featured-badge">★ Featured</span>
                @endif
            </div>
            <div class="gallery-item-info">
                <h5 title="{{ $item->title }}">{{ $item->title }}</h5>
                <div class="gallery-item-meta">{{ $item->category ?? 'Uncategorized' }}</div>
                <div class="gallery-item-actions">
                    <a href="{{ route('admin.gallery.edit', $item->id) }}" class="btn-sm btn-edit" style="flex:1;justify-content:center"><i class="fas fa-pen"></i></a>
                    <form method="POST" action="{{ route('admin.gallery.destroy', $item->id) }}" onsubmit="return confirm('Hapus media ini?')">
                        @csrf @method('DELETE')
                        <button type="submit" class="btn-sm btn-delete"><i class="fas fa-trash"></i></button>
                    </form>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    @else
    <div style="text-align:center;padding:4rem;color:var(--warm-gray)">
        <i class="fas fa-images" style="font-size:3rem;margin-bottom:1rem;display:block;opacity:0.2"></i>
        Belum ada media di gallery.
        <br><a href="{{ route('admin.gallery.create') }}" style="color:var(--gold);margin-top:0.5rem;display:inline-block">Upload foto/video pertama</a>
    </div>
    @endif

    <div style="padding:1.5rem 0 0">{{ $galleries->links() }}</div>
</div>
@endsection
