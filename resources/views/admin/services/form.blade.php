@extends('layouts.admin')
@section('title', isset($service->id) ? 'Edit Layanan' : 'Tambah Layanan')
@section('page-title', isset($service->id) ? 'Edit Layanan' : 'Tambah Layanan')
@section('breadcrumb', 'Layanan » ' . (isset($service->id) ? 'Edit' : 'Tambah Baru'))

@section('topbar-actions')
<a href="{{ route('admin.services.index') }}" class="topbar-btn">
    <i class="fas fa-arrow-left"></i> Kembali
</a>
<button type="submit" form="serviceForm" class="topbar-btn primary">
    <i class="fas fa-save"></i> Simpan
</button>
@endsection

@section('content')
<form id="serviceForm" method="POST"
    action="{{ isset($service->id) ? route('admin.services.update', $service->id) : route('admin.services.store') }}"
    enctype="multipart/form-data">
    @csrf
    @if(isset($service->id)) @method('PUT') @endif

    <div style="display:grid;grid-template-columns:2fr 1fr;gap:1.5rem">
        <div>
            <div class="card">
                <div class="card-header"><h3 class="card-title">Informasi Layanan</h3></div>
                <div class="form-grid">
                    <div class="form-group">
                        <label>Nama Layanan *</label>
                        <input type="text" name="name" class="form-control" value="{{ old('name', $service->name) }}" required placeholder="Full Wedding Organizer">
                        @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="form-group">
                        <label>Icon (emoji)</label>
                        <input type="text" name="icon" class="form-control" value="{{ old('icon', $service->icon) }}" placeholder="💍" maxlength="4">
                    </div>
                </div>
                <div class="form-group">
                    <label>Deskripsi Singkat *</label>
                    <input type="text" name="short_description" class="form-control" value="{{ old('short_description', $service->short_description) }}" required placeholder="Layanan lengkap dari awal perencanaan hingga hari H">
                </div>
                <div class="form-group">
                    <label>Deskripsi Lengkap *</label>
                    <textarea name="description" class="form-control" rows="6" required>{{ old('description', $service->description) }}</textarea>
                </div>
                <div class="form-grid">
                    <div class="form-group">
                        <label>Harga Mulai (Rp)</label>
                        <input type="number" name="price_start" class="form-control" value="{{ old('price_start', $service->price_start) }}" placeholder="25000000">
                    </div>
                    <div class="form-group">
                        <label>Harga Hingga (Rp)</label>
                        <input type="number" name="price_end" class="form-control" value="{{ old('price_end', $service->price_end) }}" placeholder="150000000">
                    </div>
                </div>
            </div>

            <!-- Features -->
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Fitur / Include</h3>
                    <button type="button" onclick="addFeature()" class="topbar-btn">
                        <i class="fas fa-plus"></i> Tambah
                    </button>
                </div>
                <div id="featuresContainer">
                    @if($service->features)
                        @foreach($service->features as $feat)
                        <div class="feature-item" style="display:flex;gap:0.75rem;margin-bottom:0.75rem">
                            <input type="text" name="features[]" class="form-control" value="{{ $feat }}" placeholder="Konsultasi unlimited">
                            <button type="button" onclick="this.closest('.feature-item').remove()" style="background:none;border:1px solid #EDE9E3;color:#999;padding:0 0.75rem;cursor:pointer;flex-shrink:0">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                        @endforeach
                    @else
                        <div class="feature-item" style="display:flex;gap:0.75rem;margin-bottom:0.75rem">
                            <input type="text" name="features[]" class="form-control" placeholder="Konsultasi unlimited">
                            <button type="button" onclick="this.closest('.feature-item').remove()" style="background:none;border:1px solid #EDE9E3;color:#999;padding:0 0.75rem;cursor:pointer;flex-shrink:0">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Sidebar -->
        <div>
            <div class="card" style="position:sticky;top:80px">
                <div class="card-header"><h3 class="card-title">Pengaturan</h3></div>

                <div class="form-group">
                    <label>Foto Layanan</label>
                    @if($service->image)
                    <img src="{{ asset('storage/'.$service->image) }}" style="width:100%;height:140px;object-fit:cover;margin-bottom:0.75rem">
                    @endif
                    <input type="file" name="image" class="form-control" accept="image/*">
                    <div class="form-hint">Ukuran ideal: 800×600px</div>
                </div>

                <div class="form-grid">
                    <div class="form-group">
                        <label>Urutan Tampil</label>
                        <input type="number" name="sort_order" class="form-control" value="{{ old('sort_order', $service->sort_order ?? 0) }}">
                    </div>
                    <div></div>
                </div>

                <div class="form-group">
                    <div class="form-check">
                        <input type="checkbox" id="is_featured" name="is_featured" value="1"
                            {{ old('is_featured', $service->is_featured) ? 'checked' : '' }}>
                        <label for="is_featured">Tampilkan sebagai featured</label>
                    </div>
                </div>
                <div class="form-group" style="margin-bottom:0">
                    <div class="form-check">
                        <input type="checkbox" id="is_active" name="is_active" value="1"
                            {{ old('is_active', $service->is_active ?? true) ? 'checked' : '' }}>
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
function addFeature() {
    const html = `<div class="feature-item" style="display:flex;gap:0.75rem;margin-bottom:0.75rem">
        <input type="text" name="features[]" class="form-control" placeholder="Fitur layanan...">
        <button type="button" onclick="this.closest('.feature-item').remove()" style="background:none;border:1px solid #EDE9E3;color:#999;padding:0 0.75rem;cursor:pointer;flex-shrink:0">
            <i class="fas fa-times"></i>
        </button>
    </div>`;
    document.getElementById('featuresContainer').insertAdjacentHTML('beforeend', html);
}
</script>
@endsection
