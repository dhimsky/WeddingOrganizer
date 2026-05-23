@extends('layouts.admin')
@section('title', 'Detail Pesan')
@section('page-title', 'Detail Pesan')
@section('breadcrumb', 'Pesan Masuk » Detail')

@section('topbar-actions')
<a href="{{ route('admin.messages.index') }}" class="topbar-btn"><i class="fas fa-arrow-left"></i> Kembali</a>
<form method="POST" action="{{ route('admin.messages.destroy', $message->id) }}" onsubmit="return confirm('Hapus pesan ini?')" style="display:inline">
    @csrf @method('DELETE')
    <button type="submit" class="topbar-btn" style="border-color:#EF4444;color:#EF4444">
        <i class="fas fa-trash"></i> Hapus
    </button>
</form>
@endsection

@section('content')
<div style="display:grid;grid-template-columns:2fr 1fr;gap:1.5rem">
    <div>
        <!-- Message -->
        <div class="card">
            <div style="display:flex;align-items:center;gap:1.25rem;margin-bottom:2rem;padding-bottom:1.5rem;border-bottom:1px solid #EDE9E3">
                <div style="width:56px;height:56px;background:rgba(201,169,110,0.1);display:flex;align-items:center;justify-content:center;font-family:var(--font-serif);font-size:1.8rem;color:var(--gold);border-radius:50%">
                    {{ strtoupper(substr($message->name,0,1)) }}
                </div>
                <div>
                    <h3 style="font-family:var(--font-serif);font-size:1.4rem;font-weight:400">{{ $message->name }}</h3>
                    <div style="font-size:0.82rem;color:var(--warm-gray);margin-top:2px">
                        {{ $message->email }}
                        @if($message->phone) &nbsp;·&nbsp; {{ $message->phone }} @endif
                    </div>
                </div>
                <div style="margin-left:auto">
                    @if($message->is_read)
                    <span class="badge-status badge-success">Sudah Dibaca</span>
                    @else
                    <span class="badge-status badge-warning">Belum Dibaca</span>
                    @endif
                </div>
            </div>

            <div style="font-size:0.9rem;color:var(--charcoal);line-height:1.9;background:var(--bg);padding:1.5rem;border-left:3px solid var(--gold)">
                {{ $message->message }}
            </div>

            <div style="margin-top:2rem;display:flex;gap:1rem;flex-wrap:wrap">
                <a href="mailto:{{ $message->email }}" class="topbar-btn primary">
                    <i class="fas fa-reply"></i> Balas via Email
                </a>
                @if($message->phone)
                <a href="https://wa.me/{{ preg_replace('/[^0-9]/','',$message->phone) }}" target="_blank" class="topbar-btn" style="border-color:#25D366;color:#25D366">
                    <i class="fab fa-whatsapp"></i> WhatsApp
                </a>
                @endif
            </div>
        </div>
    </div>

    <!-- Info Sidebar -->
    <div>
        <div class="card">
            <div class="card-header"><h3 class="card-title">Detail Inquiry</h3></div>

            <div style="display:flex;flex-direction:column;gap:1rem">
                <div style="padding:1rem;background:var(--bg);border:1px solid #EDE9E3">
                    <div style="font-size:0.65rem;letter-spacing:0.2em;text-transform:uppercase;color:var(--warm-gray);margin-bottom:0.3rem">Jenis Acara</div>
                    <div style="font-size:0.9rem;font-weight:500">{{ $message->event_type ?? '—' }}</div>
                </div>
                <div style="padding:1rem;background:var(--bg);border:1px solid #EDE9E3">
                    <div style="font-size:0.65rem;letter-spacing:0.2em;text-transform:uppercase;color:var(--warm-gray);margin-bottom:0.3rem">Tanggal Acara</div>
                    <div style="font-size:0.9rem;font-weight:500">
                        {{ $message->event_date ? \Carbon\Carbon::parse($message->event_date)->isoFormat('D MMMM YYYY') : '—' }}
                    </div>
                </div>
                <div style="padding:1rem;background:var(--bg);border:1px solid #EDE9E3">
                    <div style="font-size:0.65rem;letter-spacing:0.2em;text-transform:uppercase;color:var(--warm-gray);margin-bottom:0.3rem">Budget Range</div>
                    <div style="font-size:0.9rem;font-weight:500;color:var(--gold)">{{ $message->budget_range ?? '—' }}</div>
                </div>
                <div style="padding:1rem;background:var(--bg);border:1px solid #EDE9E3">
                    <div style="font-size:0.65rem;letter-spacing:0.2em;text-transform:uppercase;color:var(--warm-gray);margin-bottom:0.3rem">Diterima pada</div>
                    <div style="font-size:0.9rem">{{ $message->created_at->isoFormat('D MMMM YYYY, HH:mm') }}</div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
