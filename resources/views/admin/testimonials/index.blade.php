@extends('layouts.admin')
@section('title', 'Kelola Testimoni')
@section('page-title', 'Testimoni')
@section('breadcrumb', 'Kelola ulasan dari pasangan bahagia')

@section('topbar-actions')
<a href="{{ route('admin.testimonials.create') }}" class="topbar-btn primary">
    <i class="fas fa-plus"></i> Tambah Testimoni
</a>
@endsection

@section('content')
<div class="card">
    <div class="table-wrap">
        <table>
            <thead>
                <tr>
                    <th>#</th>
                    <th>Pasangan</th>
                    <th>Testimoni</th>
                    <th>Rating</th>
                    <th>Featured</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($testimonials as $i => $t)
                <tr>
                    <td style="color:var(--warm-gray);font-size:0.8rem">{{ $testimonials->firstItem() + $i }}</td>
                    <td>
                        <div style="display:flex;align-items:center;gap:0.75rem">
                            <div style="width:38px;height:38px;border-radius:50%;background:rgba(201,169,110,0.1);display:flex;align-items:center;justify-content:center;font-family:var(--font-serif);color:var(--gold);overflow:hidden;flex-shrink:0">
                                @if($t->photo)
                                    <img src="{{ asset('storage/'.$t->photo) }}" style="width:100%;height:100%;object-fit:cover">
                                @else
                                    {{ substr($t->couple_name,0,1) }}
                                @endif
                            </div>
                            <div>
                                <div style="font-size:0.875rem;font-weight:500">{{ $t->couple_name }}</div>
                                <div style="font-size:0.75rem;color:var(--warm-gray)">{{ $t->event_date }} · {{ $t->event_type }}</div>
                            </div>
                        </div>
                    </td>
                    <td style="max-width:300px">
                        <div style="font-size:0.82rem;color:var(--warm-gray);font-style:italic;white-space:nowrap;overflow:hidden;text-overflow:ellipsis">"{{ Str::limit($t->testimonial, 80) }}"</div>
                    </td>
                    <td><span style="color:var(--gold)">{{ str_repeat('★', $t->rating) }}</span></td>
                    <td>
                        @if($t->is_featured)
                        <span class="badge-status badge-success">Ya</span>
                        @else
                        <span class="badge-status" style="background:#F5F5F5;color:#999">Tidak</span>
                        @endif
                    </td>
                    <td>
                        @if($t->is_active)
                        <span class="badge-status badge-success">Aktif</span>
                        @else
                        <span class="badge-status badge-danger">Nonaktif</span>
                        @endif
                    </td>
                    <td>
                        <div class="action-btns">
                            <a href="{{ route('admin.testimonials.edit', $t->id) }}" class="btn-sm btn-edit"><i class="fas fa-pen"></i></a>
                            <form method="POST" action="{{ route('admin.testimonials.destroy', $t->id) }}" onsubmit="return confirm('Hapus testimoni ini?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn-sm btn-delete"><i class="fas fa-trash"></i></button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr><td colspan="7" style="text-align:center;padding:3rem;color:var(--warm-gray)">Belum ada testimoni.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div style="padding:1rem 0 0">{{ $testimonials->links() }}</div>
</div>
@endsection
