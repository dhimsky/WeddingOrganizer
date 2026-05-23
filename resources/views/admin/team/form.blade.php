@extends('layouts.admin')
@section('title', isset($member->id) ? 'Edit Anggota Tim' : 'Tambah Anggota Tim')
@section('page-title', isset($member->id) ? 'Edit Anggota Tim' : 'Tambah Anggota Tim')
@section('breadcrumb', 'Tim » ' . (isset($member->id) ? 'Edit' : 'Tambah Baru'))

@section('topbar-actions')
<a href="{{ route('admin.team.index') }}" class="topbar-btn"><i class="fas fa-arrow-left"></i> Kembali</a>
<button type="submit" form="teamForm" class="topbar-btn primary"><i class="fas fa-save"></i> Simpan</button>
@endsection

@section('content')
<form id="teamForm" method="POST"
    action="{{ isset($member->id) ? route('admin.team.update', $member->id) : route('admin.team.store') }}"
    enctype="multipart/form-data">
    @csrf
    @if(isset($member->id)) @method('PUT') @endif

    <div style="display:grid;grid-template-columns:2fr 1fr;gap:1.5rem">
        <div class="card">
            <div class="card-header"><h3 class="card-title">Informasi Anggota</h3></div>
            <div class="form-grid">
                <div class="form-group">
                    <label>Nama Lengkap *</label>
                    <input type="text" name="name" class="form-control"
                           value="{{ old('name', $member->name) }}" required placeholder="Andini Putri">
                </div>
                <div class="form-group">
                    <label>Jabatan / Role *</label>
                    <input type="text" name="role" class="form-control"
                           value="{{ old('role', $member->role) }}" required placeholder="Wedding Coordinator">
                </div>
            </div>
            <div class="form-group">
                <label>Bio Singkat</label>
                <textarea name="bio" class="form-control" rows="4"
                          placeholder="Ceritakan sedikit tentang anggota tim ini...">{{ old('bio', $member->bio) }}</textarea>
            </div>
            <div class="form-group">
                <label><i class="fab fa-instagram" style="color:#E1306C"></i> Instagram Username</label>
                <input type="text" name="instagram" class="form-control"
                       value="{{ old('instagram', $member->instagram) }}" placeholder="username (tanpa @)">
            </div>
        </div>

        <div>
            <div class="card" style="position:sticky;top:80px">
                <div class="card-header"><h3 class="card-title">Foto & Status</h3></div>

                <!-- Preview foto -->
                <div style="text-align:center;margin-bottom:1.25rem">
                    @if(isset($member->id) && $member->photo && \Storage::disk('public')->exists($member->photo))
                        <img src="{{ asset('storage/'.$member->photo) }}" id="photoPreview"
                             style="width:100px;height:100px;border-radius:50%;object-fit:cover;border:3px solid var(--gold)">
                    @else
                        <div id="photoPreview" style="width:100px;height:100px;border-radius:50%;background:rgba(201,169,110,0.1);border:3px solid var(--border);display:flex;align-items:center;justify-content:center;margin:0 auto;font-family:var(--font-serif);font-size:2.5rem;color:var(--gold)">
                            {{ strtoupper(substr($member->name ?? 'A', 0, 1)) }}
                        </div>
                    @endif
                </div>

                <div class="form-group">
                    <label>Foto</label>
                    <input type="file" name="photo" class="form-control" accept="image/*"
                           onchange="previewPhoto(this)">
                    <div class="form-hint">Foto wajah. Maks 2MB.</div>
                </div>

                <div class="form-group">
                    <label>Urutan Tampil</label>
                    <input type="number" name="sort_order" class="form-control"
                           value="{{ old('sort_order', $member->sort_order ?? 0) }}">
                </div>

                <div class="form-group" style="margin-bottom:0">
                    <div class="form-check" style="padding:0.875rem;border:1px solid #EDE9E3">
                        <input type="checkbox" id="is_active" name="is_active" value="1"
                               {{ old('is_active', $member->is_active ?? true) ? 'checked' : '' }}>
                        <label for="is_active">Aktif (tampil di website)</label>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
@endsection

@section('scripts')
<script>
function previewPhoto(input) {
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = e => {
            const preview = document.getElementById('photoPreview');
            preview.outerHTML = `<img src="${e.target.result}" id="photoPreview"
                style="width:100px;height:100px;border-radius:50%;object-fit:cover;border:3px solid var(--gold);display:block;margin:0 auto 1.25rem">`;
        };
        reader.readAsDataURL(input.files[0]);
    }
}
</script>
@endsection