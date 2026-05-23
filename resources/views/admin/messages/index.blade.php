@extends('layouts.admin')
@section('title', 'Pesan Masuk')
@section('page-title', 'Pesan Masuk')
@section('breadcrumb', 'Kelola pesan dan inquiry dari calon klien')

@section('content')
<div class="card">
    <div class="table-wrap">
        <table>
            <thead>
                <tr>
                    <th></th>
                    <th>Pengirim</th>
                    <th>Jenis Acara</th>
                    <th>Budget</th>
                    <th>Tanggal Acara</th>
                    <th>Diterima</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($messages as $msg)
                <tr style="{{ !$msg->is_read ? 'font-weight:500;background:#FFFEF9' : '' }}">
                    <td style="width:8px;padding:0">
                        @if(!$msg->is_read)
                        <div style="width:4px;height:100%;background:var(--gold);min-height:60px"></div>
                        @endif
                    </td>
                    <td>
                        <div style="display:flex;align-items:center;gap:0.75rem">
                            <div style="width:36px;height:36px;background:rgba(201,169,110,0.1);display:flex;align-items:center;justify-content:center;font-family:var(--font-serif);font-size:1.1rem;color:var(--gold);border-radius:50%;flex-shrink:0">
                                {{ strtoupper(substr($msg->name,0,1)) }}
                            </div>
                            <div>
                                <div style="font-size:0.875rem">{{ $msg->name }}</div>
                                <div style="font-size:0.75rem;color:var(--warm-gray)">{{ $msg->email }}</div>
                            </div>
                        </div>
                    </td>
                    <td style="font-size:0.82rem">{{ $msg->event_type ?? '—' }}</td>
                    <td style="font-size:0.82rem;color:var(--gold)">{{ $msg->budget_range ?? '—' }}</td>
                    <td style="font-size:0.82rem">{{ $msg->event_date ? \Carbon\Carbon::parse($msg->event_date)->format('d M Y') : '—' }}</td>
                    <td style="font-size:0.78rem;color:var(--warm-gray)">{{ $msg->created_at->format('d M Y') }}</td>
                    <td>
                        @if($msg->is_read)
                        <span class="badge-status badge-success">Dibaca</span>
                        @else
                        <span class="badge-status badge-warning">Baru</span>
                        @endif
                    </td>
                    <td>
                        <div class="action-btns">
                            <a href="{{ route('admin.messages.show', $msg->id) }}" class="btn-sm btn-view"><i class="fas fa-eye"></i></a>
                            <form method="POST" action="{{ route('admin.messages.destroy', $msg->id) }}" onsubmit="return confirm('Hapus pesan ini?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn-sm btn-delete"><i class="fas fa-trash"></i></button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr><td colspan="8" style="text-align:center;padding:3rem;color:var(--warm-gray)">
                    <i class="fas fa-inbox" style="font-size:2.5rem;display:block;margin-bottom:0.75rem;opacity:0.2"></i>
                    Belum ada pesan masuk
                </td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div style="padding:1rem 0 0">{{ $messages->links() }}</div>
</div>
@endsection
