@extends('layouts.admin')
@section('title', 'Kelola Partner')
@section('page-title', 'Partner & Kolaborasi')
@section('breadcrumb', 'Kelola vendor dan partner kolaborasi')

@section('topbar-actions')
<a href="{{ route('admin.partners.create') }}" class="topbar-btn primary">
    <i class="fas fa-plus"></i> Tambah Partner
</a>
@endsection

@section('styles')
<style>
.partners-cards { display:grid; grid-template-columns:repeat(auto-fill,minmax(200px,1fr)); gap:1.25rem; }
.partner-admin-card { background:white; border:1px solid #EDE9E3; padding:1.5rem; text-align:center; position:relative; transition:box-shadow 0.2s; }
.partner-admin-card:hover { box-shadow:0 4px 20px rgba(0,0,0,0.07); }
.partner-logo-circle { width:70px; height:70px; background:var(--bg); border-radius:50%; display:flex; align-items:center; justify-content:center; margin:0 auto 1rem; font-family:var(--font-serif); font-size:1.8rem; color:var(--gold); overflow:hidden; }
.partner-logo-circle img { width:100%; height:100%; object-fit:contain; }
.partner-admin-card h4 { font-family:var(--font-serif); font-size:1rem; font-weight:500; margin-bottom:0.25rem; }
.partner-cat-tag { font-size:0.7rem; letter-spacing:0.12em; text-transform:uppercase; color:var(--gold); margin-bottom:0.75rem; display:block; }
.partner-actions { display:flex; gap:0.4rem; justify-content:center; margin-top:0.875rem; }
.inactive-overlay { position:absolute; top:0.75rem; right:0.75rem; font-size:0.65rem; padding:0.2rem 0.5rem; background:#FEF2F2; color:#B91C1C; border:1px solid #FECACA; }
</style>
@endsection

@section('content')
<div class="card">
    <div class="partners-cards">
        @forelse($partners as $partner)
        <div class="partner-admin-card">
            @if(!$partner->is_active)
            <span class="inactive-overlay">Nonaktif</span>
            @endif
            <div class="partner-logo-circle">
                @if($partner->logo && !str_contains($partner->logo, 'default'))
                    <img src="{{ asset('storage/'.$partner->logo) }}" alt="{{ $partner->name }}">
                @else
                    {{ strtoupper(substr($partner->name, 0, 1)) }}
                @endif
            </div>
            <h4>{{ $partner->name }}</h4>
            <span class="partner-cat-tag">{{ $partner->category ?? 'Vendor' }}</span>
            <div class="partner-actions">
                <a href="{{ route('admin.partners.edit', $partner->id) }}" class="btn-sm btn-edit"><i class="fas fa-pen"></i></a>
                <form method="POST" action="{{ route('admin.partners.destroy', $partner->id) }}" onsubmit="return confirm('Hapus partner ini?')">
                    @csrf @method('DELETE')
                    <button type="submit" class="btn-sm btn-delete"><i class="fas fa-trash"></i></button>
                </form>
            </div>
        </div>
        @empty
        <div style="grid-column:1/-1;text-align:center;padding:3rem;color:var(--warm-gray)">
            Belum ada partner. <a href="{{ route('admin.partners.create') }}" style="color:var(--gold)">Tambah sekarang</a>
        </div>
        @endforelse
    </div>
    <div style="padding:1.5rem 0 0">{{ $partners->links() }}</div>
</div>
@endsection
