@extends('layouts.admin')
@section('title', isset($testimonial->id) ? 'Edit Testimoni' : 'Tambah Testimoni')
@section('page-title', isset($testimonial->id) ? 'Edit Testimoni' : 'Tambah Testimoni')
@section('breadcrumb', 'Testimoni » ' . (isset($testimonial->id) ? 'Edit' : 'Tambah Baru'))

@section('topbar-actions')
<a href="{{ route('admin.testimonials.index') }}" class="topbar-btn"><i class="fas fa-arrow-left"></i> Kembali</a>
<button type="submit" form="testimonialForm" class="topbar-btn primary"><i class="fas fa-save"></i> Simpan</button>
@endsection

@section('content')
<form id="testimonialForm" method="POST"
    action="{{ isset($testimonial->id) ? route('admin.testimonials.update', $testimonial->id) : route('admin.testimonials.store') }}"
    enctype="multipart/form-data">
    @csrf
    @if(isset($testimonial->id)) @method('PUT') @endif

    <div style="display:grid;grid-template-columns:2fr 1fr;gap:1.5rem">
        <div class="card">
            <div class="card-header"><h3 class="card-title">Data Testimoni</h3></div>
            <div class="form-grid">
                <div class="form-group">
                    <label>Nama Pasangan *</label>
                    <input type="text" name="couple_name" class="form-control" value="{{ old('couple_name', $testimonial->couple_name) }}" required placeholder="Rania & Dimas">
                </div>
                <div class="form-group">
                    <label>Tanggal Acara *</label>
                    <input type="text" name="event_date" class="form-control" value="{{ old('event_date', $testimonial->event_date) }}" required placeholder="Maret 2024">
                </div>
            </div>
            <div class="form-group">
                <label>Jenis Acara</label>
                <input type="text" name="event_type" class="form-control" value="{{ old('event_type', $testimonial->event_type) }}" placeholder="Outdoor Garden, Ballroom, Intimate...">
            </div>
            <div class="form-group">
                <label>Isi Testimoni *</label>
                <textarea name="testimonial" class="form-control" rows="6" required placeholder="Ceritakan pengalaman pasangan dengan layanan kami...">{{ old('testimonial', $testimonial->testimonial) }}</textarea>
            </div>
            <div class="form-group">
                <label>Rating</label>
                <div style="display:flex;gap:0.5rem;margin-bottom:0.5rem" id="starRating">
                    @for($i = 1; $i <= 5; $i++)
                    <button type="button" onclick="setRating({{ $i }})"
                        style="font-size:1.5rem;background:none;border:none;cursor:pointer;color:{{ ($testimonial->rating ?? 5) >= $i ? '#C9A96E' : '#DDD' }}"
                        id="star{{ $i }}">★</button>
                    @endfor
                </div>
                <input type="hidden" name="rating" id="ratingInput" value="{{ old('rating', $testimonial->rating ?? 5) }}">
            </div>
        </div>

        <div>
            <div class="card" style="position:sticky;top:80px">
                <div class="card-header"><h3 class="card-title">Foto & Status</h3></div>
                <div class="form-group">
                    <label>Foto Pasangan</label>
                    @if(isset($testimonial->id) && $testimonial->photo)
                    <img src="{{ asset('storage/'.$testimonial->photo) }}" style="width:100%;height:120px;object-fit:cover;margin-bottom:0.75rem">
                    @endif
                    <input type="file" name="photo" class="form-control" accept="image/*">
                    <div class="form-hint">Opsional. Foto pasangan untuk ditampilkan. Maks 2MB.</div>
                </div>
                <div class="form-group">
                    <div class="form-check" style="padding:0.875rem;border:1px solid #EDE9E3;margin-bottom:0.75rem">
                        <input type="checkbox" id="is_featured" name="is_featured" value="1"
                            {{ old('is_featured', $testimonial->is_featured) ? 'checked' : '' }}>
                        <label for="is_featured">★ Featured (tampil di home)</label>
                    </div>
                    <div class="form-check" style="padding:0.875rem;border:1px solid #EDE9E3">
                        <input type="checkbox" id="is_active" name="is_active" value="1"
                            {{ old('is_active', $testimonial->is_active ?? true) ? 'checked' : '' }}>
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
function setRating(val) {
    document.getElementById('ratingInput').value = val;
    for (let i = 1; i <= 5; i++) {
        document.getElementById('star' + i).style.color = i <= val ? '#C9A96E' : '#DDD';
    }
}
</script>
@endsection
