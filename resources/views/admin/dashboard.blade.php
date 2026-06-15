@extends('layouts.admin')
@section('title', 'Dashboard')
@section('page-title', 'Dashboard')
@section('breadcrumb', 'Selamat datang kembali!')

@section('styles')
<style>
.stats-row { display:grid; grid-template-columns:repeat(4,1fr); gap:1.25rem; margin-bottom:1.5rem; }
.stat-card {
    background:white; border:1px solid #EDE9E3; padding:1.5rem;
    display:flex; align-items:center; gap:1.25rem; position:relative; overflow:hidden;
    transition: transform 0.2s, box-shadow 0.2s;
}
.stat-card:hover { transform:translateY(-2px); box-shadow:0 8px 30px rgba(0,0,0,0.07); }
.stat-card::after { content:''; position:absolute; bottom:0; left:0; right:0; height:3px; background:var(--gold); transform:scaleX(0); transition:transform 0.3s; }
.stat-card:hover::after { transform:scaleX(1); }
.stat-icon {
    width:52px; height:52px;
    background:rgba(201,169,110,0.1);
    display:flex; align-items:center; justify-content:center;
    font-size:1.3rem; color:var(--gold); flex-shrink:0;
}
.stat-info .num { font-family:var(--font-serif); font-size:2rem; font-weight:300; color:var(--charcoal); line-height:1; }
.stat-info .lbl { font-size:0.72rem; letter-spacing:0.12em; text-transform:uppercase; color:var(--warm-gray); margin-top:0.3rem; }
.stat-card.alert-card .stat-icon { background:rgba(239,68,68,0.08); color:#EF4444; }
.stat-card.alert-card .stat-info .num { color:#EF4444; }

.dash-grid { display:grid; grid-template-columns:2fr 1fr; gap:1.5rem; }

.quick-actions { display:grid; grid-template-columns:repeat(3,1fr); gap:1rem; margin-bottom:1.5rem; }
.quick-btn {
    display:flex; flex-direction:column; align-items:center; justify-content:center;
    gap:0.6rem; padding:1.25rem; background:white; border:1px solid #EDE9E3;
    text-decoration:none; color:var(--charcoal); transition:all 0.25s; text-align:center;
}
.quick-btn:hover { border-color:var(--gold); background:rgba(201,169,110,0.03); }
.quick-btn i { font-size:1.4rem; color:var(--gold); }
.quick-btn span { font-size:0.78rem; letter-spacing:0.05em; }

.msg-item { display:flex; gap:1rem; align-items:flex-start; padding:1rem 0; border-bottom:1px solid #EDE9E3; }
.msg-item:last-child { border:none; }
.msg-avatar { width:38px; height:38px; background:rgba(201,169,110,0.1); display:flex; align-items:center; justify-content:center; font-family:var(--font-serif); font-size:1.1rem; color:var(--gold); flex-shrink:0; }
.msg-name { font-size:0.875rem; font-weight:500; color:var(--charcoal); }
.msg-preview { font-size:0.8rem; color:var(--warm-gray); margin-top:2px; white-space:nowrap; overflow:hidden; text-overflow:ellipsis; max-width:260px; }
.msg-meta { font-size:0.7rem; color:var(--warm-gray); margin-top:3px; }
.msg-unread .msg-name::after { content:'•'; color:var(--gold); margin-left:0.4rem; }

.gallery-mini { display:grid; grid-template-columns:repeat(3,1fr); gap:0.5rem; }
.gallery-mini-item { aspect-ratio:1; overflow:hidden; background:var(--bg); }
.gallery-mini-item img { width:100%; height:100%; object-fit:cover; transition:transform 0.3s; }
.gallery-mini-item:hover img { transform:scale(1.08); }

.activity-item { display:flex; gap:0.875rem; align-items:flex-start; padding:0.75rem 0; border-bottom:1px solid #EDE9E3; }
.activity-item:last-child { border:none; }
.activity-dot { width:8px; height:8px; border-radius:50%; background:var(--gold); margin-top:5px; flex-shrink:0; }
.activity-text { font-size:0.82rem; color:var(--charcoal); line-height:1.5; }
.activity-time { font-size:0.72rem; color:var(--warm-gray); margin-top:2px; }

@media (max-width:1200px) { .stats-row { grid-template-columns:repeat(2,1fr); } }
@media (max-width:900px) { .dash-grid { grid-template-columns:1fr; } }
@media (max-width:640px) { .stats-row { grid-template-columns:1fr 1fr; } .quick-actions { grid-template-columns:repeat(2,1fr); } }
</style>
@endsection

@section('content')

<!-- Stats -->
<div class="stats-row">
    <div class="stat-card">
        <div class="stat-icon"><i class="fas fa-concierge-bell"></i></div>
        <div class="stat-info">
            <div class="num">{{ $stats['services'] }}</div>
            <div class="lbl">Layanan</div>
        </div>
    </div>
    <div class="stat-card">
        <div class="stat-icon"><i class="fas fa-handshake"></i></div>
        <div class="stat-info">
            <div class="num">{{ $stats['partners'] }}</div>
            <div class="lbl">Partner</div>
        </div>
    </div>
    <div class="stat-card">
        <div class="stat-icon"><i class="fas fa-images"></i></div>
        <div class="stat-info">
            <div class="num">{{ $stats['galleries'] }}</div>
            <div class="lbl">Gallery</div>
        </div>
    </div>
    <div class="stat-card {{ $stats['unread_messages'] > 0 ? 'alert-card' : '' }}">
        <div class="stat-icon"><i class="fas fa-envelope"></i></div>
        <div class="stat-info">
            <div class="num">{{ $stats['unread_messages'] }}</div>
            <div class="lbl">Pesan Belum Dibaca</div>
        </div>
    </div>
</div>

<!-- Quick Actions -->
<div class="quick-actions">
    <a href="{{ route('admin.gallery.create') }}" class="quick-btn">
        <i class="fas fa-plus-circle"></i>
        <span>Upload Gallery</span>
    </a>
    <a href="{{ route('admin.services.create') }}" class="quick-btn">
        <i class="fas fa-plus-circle"></i>
        <span>Tambah Layanan</span>
    </a>
    <a href="{{ route('admin.partners.create') }}" class="quick-btn">
        <i class="fas fa-plus-circle"></i>
        <span>Tambah Partner</span>
    </a>
    <a href="{{ route('admin.testimonials.create') }}" class="quick-btn">
        <i class="fas fa-plus-circle"></i>
        <span>Tambah Testimoni</span>
    </a>
    <a href="{{ route('admin.messages.index') }}" class="quick-btn">
        <i class="fas fa-envelope-open"></i>
        <span>Baca Pesan</span>
    </a>
    <a href="{{ route('admin.settings.edit') }}" class="quick-btn">
        <i class="fas fa-cog"></i>
        <span>Pengaturan</span>
    </a>
</div>

<!-- Main Grid -->
<div class="dash-grid">

    <!-- Recent Messages -->
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Pesan Terbaru</h3>
            <a href="{{ route('admin.messages.index') }}" class="topbar-btn" style="font-size:0.72rem;padding:0.4rem 0.875rem">
                Lihat Semua
            </a>
        </div>
        @forelse($recentMessages as $msg)
        <div class="msg-item {{ !$msg->is_read ? 'msg-unread' : '' }}">
            <div class="msg-avatar">{{ strtoupper(substr($msg->name, 0, 1)) }}</div>
            <div style="flex:1;min-width:0">
                <div class="msg-name">{{ $msg->name }}</div>
                <div class="msg-preview">{{ $msg->message }}</div>
                <div class="msg-meta">
                    {{ $msg->event_type ?? 'Inquiry' }} &nbsp;·&nbsp; {{ $msg->created_at->diffForHumans() }}
                </div>
            </div>
            <a href="{{ route('admin.messages.show', $msg->id) }}" class="btn-sm btn-view" style="flex-shrink:0">
                <i class="fas fa-eye"></i>
            </a>
        </div>
        @empty
        <div style="text-align:center;padding:2rem;color:var(--warm-gray);font-size:0.875rem">
            <i class="fas fa-inbox" style="font-size:2rem;margin-bottom:0.75rem;display:block;opacity:0.3"></i>
            Belum ada pesan masuk
        </div>
        @endforelse
    </div>

    <!-- Right Column -->
    <div>
        <!-- Gallery Preview -->
        @if($recentGalleries->count())
        <div class="gallery-mini">
            @foreach($recentGalleries->take(6) as $item)
                <div class="gallery-mini-item">
                    @if($item->file_type === 'video')
                        <video
                            autoplay
                            muted
                            loop
                            playsinline
                            preload="metadata"
                            style="width:100%;height:100%;object-fit:cover;"
                        >
                            <source src="{{ asset('storage/' . $item->file_path) }}" type="video/mp4">
                            Browser Anda tidak mendukung video.
                        </video>
                    @else
                        <img
                            src="{{ asset('storage/' . $item->file_path) }}"
                            alt="{{ $item->title }}"
                            style="width:100%;height:100%;object-fit:cover;"
                        >
                    @endif
                </div>
            @endforeach
        </div>
        @else
        <div style="text-align:center;padding:2rem;color:var(--warm-gray);font-size:0.8rem">
            Belum ada foto/video
        </div>
        @endif

        <!-- Stats Summary -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Ringkasan</h3>
            </div>
            <div class="activity-item">
                <div class="activity-dot"></div>
                <div>
                    <div class="activity-text">{{ $stats['testimonials'] }} testimoni terdaftar</div>
                    <div class="activity-time">Total keseluruhan</div>
                </div>
            </div>
            <div class="activity-item">
                <div class="activity-dot"></div>
                <div>
                    <div class="activity-text">{{ $stats['messages'] }} total pesan masuk</div>
                    <div class="activity-time">Semua waktu</div>
                </div>
            </div>
            <div class="activity-item">
                <div class="activity-dot"></div>
                <div>
                    <div class="activity-text">{{ $stats['galleries'] }} media di gallery</div>
                    <div class="activity-time">Foto & video</div>
                </div>
            </div>
            <div class="activity-item">
                <div class="activity-dot"></div>
                <div>
                    <div class="activity-text">{{ $stats['partners'] }} partner aktif</div>
                    <div class="activity-time">Kolaborasi vendor</div>
                </div>
            </div>
            <div style="margin-top:1.25rem">
                <a href="{{ route('home') }}" target="_blank" class="topbar-btn" style="width:100%;justify-content:center;font-size:0.75rem">
                    <i class="fas fa-external-link-alt"></i> Lihat Website Publik
                </a>
            </div>
        </div>
    </div>

</div>
@endsection
