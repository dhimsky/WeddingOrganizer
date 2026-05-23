@extends('layouts.admin')
@section('title', 'Kelola Tim')
@section('page-title', 'Tim Kami')
@section('breadcrumb', 'Kelola anggota tim perusahaan')

@section('topbar-actions')
<a href="{{ route('admin.team.create') }}" class="topbar-btn primary">
    <i class="fas fa-plus"></i> Tambah Anggota
</a>
@endsection

@section('styles')
<style>
.team-admin-grid { display:grid; grid-template-columns:repeat(auto-fill,minmax(200px,1fr)); gap:1.25rem; }
.team-admin-card { background:white; border:1px solid #EDE9E3; padding:1.5rem; text-align:center; transition:box-shadow 0.2s; position:relative; }
.team-admin-card:hover { box-shadow:0 4px 20px rgba(0,0,0,0.07); }
.team-photo { width:80px; height:80px; border-radius:50%; overflow:hidden; margin:0 auto 1rem; background:rgba(201,169,110,0.1); display:flex; align-items:center; justify-content:center; font-family:var(--font-serif); font-size:2rem; color:var(--gold); }
.team-photo img { width:100%; height:100%; object-fit:cover; }
.team-admin-card h4 { font-family:var(--font-serif); font-size:1rem; font-weight:500; margin-bottom:0.25rem; }
.team-role { font-size:0.75rem; color:var(--gold); letter-spacing:0.08em; margin-bottom:0.875rem; }
.team-actions { display:flex; gap:0.4rem; justify-content:center; }
.inactive-badge { position:absolute; top:0.75rem; right:0.75rem; font-size:0.65rem; padding:0.2rem 0.5rem; background:#FEF2F2; color:#B91C1C; border:1px solid #FECACA; }
</style>
@endsection

@section('content')
<div class="card">
    @if($members->count())
    <div class="team-admin-grid">
        @foreach($members as $member)
        <div class="team-admin-card">
            @if(!$member->is_active)
            <span class="inactive-badge">Nonaktif</span>
            @endif
            <div class="team-photo">
                @if($member->photo && \Storage::disk('public')->exists($member->photo))
                    <img src="{{ asset('storage/'.$member->photo) }}" alt="{{ $member->name }}">
                @else
                    {{ strtoupper(substr($member->name, 0, 1)) }}
                @endif
            </div>
            <h4>{{ $member->name }}</h4>
            <div class="team-role">{{ $member->role }}</div>
            <div class="team-actions">
                <a href="{{ route('admin.team.edit', $member->id) }}" class="btn-sm btn-edit">
                    <i class="fas fa-pen"></i>
                </a>
                <form method="POST" action="{{ route('admin.team.destroy', $member->id) }}"
                      onsubmit="return confirm('Hapus anggota ini?')">
                    @csrf @method('DELETE')
                    <button type="submit" class="btn-sm btn-delete">
                        <i class="fas fa-trash"></i>
                    </button>
                </form>
            </div>
        </div>
        @endforeach
    </div>
    @else
    <div style="text-align:center;padding:4rem;color:var(--warm-gray)">
        <i class="fas fa-users" style="font-size:3rem;display:block;margin-bottom:1rem;opacity:0.2"></i>
        Belum ada anggota tim.
        <br><a href="{{ route('admin.team.create') }}" style="color:var(--gold);margin-top:0.5rem;display:inline-block">Tambah sekarang</a>
    </div>
    @endif
    <div style="padding:1.5rem 0 0">{{ $members->links() }}</div>
</div>
@endsection