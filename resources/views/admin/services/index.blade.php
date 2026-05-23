@extends('layouts.admin')
@section('title', 'Kelola Layanan')
@section('page-title', 'Layanan')
@section('breadcrumb', 'Kelola paket layanan wedding organizer')

@section('topbar-actions')
<a href="{{ route('admin.services.create') }}" class="topbar-btn primary">
    <i class="fas fa-plus"></i> Tambah Layanan
</a>
@endsection

@section('content')
<div class="card">
    <div class="table-wrap">
        <table>
            <thead>
                <tr>
                    <th>#</th>
                    <th>Layanan</th>
                    <th>Harga Mulai</th>
                    <th>Featured</th>
                    <th>Status</th>
                    <th>Urutan</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($services as $i => $service)
                <tr>
                    <td style="color:var(--warm-gray);font-size:0.8rem">{{ $services->firstItem() + $i }}</td>
                    <td>
                        <div style="display:flex;align-items:center;gap:0.75rem">
                            <span style="font-size:1.5rem">{{ $service->icon ?? '💍' }}</span>
                            <div>
                                <div style="font-weight:500;font-size:0.875rem">{{ $service->name }}</div>
                                <div style="font-size:0.75rem;color:var(--warm-gray)">{{ Str::limit($service->short_description, 60) }}</div>
                            </div>
                        </div>
                    </td>
                    <td style="font-family:var(--font-serif);color:var(--gold)">
                        @if($service->price_start) Rp {{ number_format($service->price_start, 0, ',', '.') }} @else <span style="color:var(--warm-gray)">—</span> @endif
                    </td>
                    <td>
                        @if($service->is_featured)
                        <span class="badge-status badge-success"><i class="fas fa-star" style="font-size:0.65rem"></i> Ya</span>
                        @else
                        <span class="badge-status badge-warning">Tidak</span>
                        @endif
                    </td>
                    <td>
                        @if($service->is_active)
                        <span class="badge-status badge-success">Aktif</span>
                        @else
                        <span class="badge-status badge-danger">Nonaktif</span>
                        @endif
                    </td>
                    <td style="color:var(--warm-gray)">{{ $service->sort_order }}</td>
                    <td>
                        <div class="action-btns">
                            <a href="{{ route('admin.services.edit', $service->id) }}" class="btn-sm btn-edit"><i class="fas fa-pen"></i></a>
                            <form method="POST" action="{{ route('admin.services.destroy', $service->id) }}" onsubmit="return confirm('Hapus layanan ini?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn-sm btn-delete"><i class="fas fa-trash"></i></button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr><td colspan="7" style="text-align:center;padding:3rem;color:var(--warm-gray)">Belum ada layanan. <a href="{{ route('admin.services.create') }}" style="color:var(--gold)">Tambah sekarang</a></td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div style="padding:1rem 0 0">{{ $services->links() }}</div>
</div>
@endsection
