@extends('layouts.admin')
@section('title', isset($partner->id) ? 'Edit Partner' : 'Tambah Partner')
@section('page-title', isset($partner->id) ? 'Edit Partner' : 'Tambah Partner')
@section('breadcrumb', 'Partner » ' . (isset($partner->id) ? 'Edit' : 'Tambah Baru'))

@section('topbar-actions')
<a href="{{ route('admin.partners.index') }}" class="topbar-btn"><i class="fas fa-arrow-left"></i> Kembali</a>
<button type="submit" form="partnerForm" class="topbar-btn primary"><i class="fas fa-save"></i> Simpan</button>
@endsection

@section('content')
<form id="partnerForm" method="POST"
    action="{{ isset($partner->id) ? route('admin.partners.update', $partner->id) : route('admin.partners.store') }}"
    enctype="multipart/form-data">
    @csrf
    @if(isset($partner->id)) @method('PUT') @endif

    <div style="display:grid;grid-template-columns:2fr 1fr;gap:1.5rem">
        <div class="card">
            <div class="card-header"><h3 class="card-title">Informasi Partner</h3></div>
            <div class="form-grid">
                <div class="form-group">
                    <label>Nama Partner *</label>
                    <input type="text" name="name" class="form-control" value="{{ old('name', $partner->name) }}" required placeholder="Nama perusahaan/vendor">
                </div>
                <div class="form-group">
                    <label>Kategori</label>
                    <select name="category" class="form-control">
                        <option value="">Pilih kategori</option>
                        @foreach(['Venue','Catering','Photography','Videography','Florist','Bridal','Entertainment','Decoration','Makeup','Transportation','Lainnya'] as $cat)
                        <option value="{{ $cat }}" {{ old('category', $partner->category) == $cat ? 'selected' : '' }}>{{ $cat }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label>Website</label>
                <input type="url" name="website" class="form-control" value="{{ old('website', $partner->website) }}" placeholder="https://example.com">
            </div>
            <div class="form-group">
                <label>Deskripsi</label>
                <textarea name="description" class="form-control" rows="4" placeholder="Deskripsi singkat tentang partner ini...">{{ old('description', $partner->description) }}</textarea>
            </div>
        </div>

        <div>
            <div class="card" style="position:sticky;top:80px">
                <div class="card-header"><h3 class="card-title">Logo & Status</h3></div>
                <div class="form-group">
                    <label>Logo Partner *</label>
                    @if(isset($partner->id) && $partner->logo && !str_contains($partner->logo,'default'))
                    <div style="margin-bottom:0.75rem;padding:1rem;border:1px solid #EDE9E3;background:var(--bg);text-align:center">
                        <img src="{{ asset('storage/'.$partner->logo) }}" alt="Logo" style="max-height:80px;max-width:100%">
                    </div>
                    @endif
                    <input type="file" name="logo" class="form-control" accept="image/*" {{ !isset($partner->id) ? 'required' : '' }}>
                    <div class="form-hint">PNG transparan direkomendasikan. Maks 2MB.</div>
                </div>
                <div class="form-group">
                    <label>Urutan Tampil</label>
                    <input type="number" name="sort_order" class="form-control" value="{{ old('sort_order', $partner->sort_order ?? 0) }}">
                </div>
                <div class="form-group" style="margin-bottom:0">
                    <div class="form-check">
                        <input type="checkbox" id="is_active" name="is_active" value="1"
                            {{ old('is_active', $partner->is_active ?? true) ? 'checked' : '' }}>
                        <label for="is_active">Aktif (tampil di website)</label>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
@endsection
