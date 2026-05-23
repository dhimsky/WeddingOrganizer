@extends('layouts.admin')
@section('title', isset($gallery->id) ? 'Edit Media' : 'Upload Media')
@section('page-title', isset($gallery->id) ? 'Edit Media' : 'Upload Media')
@section('breadcrumb', 'Gallery » ' . (isset($gallery->id) ? 'Edit' : 'Upload Baru'))

@section('topbar-actions')
<a href="{{ route('admin.gallery.index') }}" class="topbar-btn"><i class="fas fa-arrow-left"></i> Kembali</a>
<button type="submit" form="galleryForm" class="topbar-btn primary"><i class="fas fa-save"></i> Simpan</button>
@endsection

@section('content')
<form id="galleryForm" method="POST"
    action="{{ isset($gallery->id) ? route('admin.gallery.update', $gallery->id) : route('admin.gallery.store') }}"
    enctype="multipart/form-data">
    @csrf
    @if(isset($gallery->id)) @method('PUT') @endif

    <div style="display:grid;grid-template-columns:2fr 1fr;gap:1.5rem">
        <div>
            <div class="card">
                <div class="card-header"><h3 class="card-title">Upload File Media</h3></div>

                <!-- Drag & Drop Upload Zone -->
                <div id="dropZone" style="border:2px dashed #DDD;padding:3rem 2rem;text-align:center;cursor:pointer;transition:border-color 0.3s;background:var(--bg);margin-bottom:1.5rem"
                     onclick="document.getElementById('fileInput').click()">
                    <i class="fas fa-cloud-upload-alt" style="font-size:2.5rem;color:var(--gold-light);margin-bottom:1rem;display:block"></i>
                    <div style="font-family:var(--font-serif);font-size:1.2rem;margin-bottom:0.5rem">Drop file di sini</div>
                    <div style="font-size:0.8rem;color:var(--warm-gray)">atau klik untuk memilih file (JPG, PNG, MP4, MOV — maks 20MB)</div>
                    <div id="fileName" style="margin-top:1rem;font-size:0.8rem;color:var(--gold);display:none"></div>
                </div>

                <input type="file" id="fileInput" name="file_path" accept="image/*,video/*" style="display:none"
                    {{ !isset($gallery->id) ? 'required' : '' }}
                    onchange="handleFileSelect(this)">

                @if(isset($gallery->id) && $gallery->file_path)
                <div style="padding:0.875rem;background:rgba(201,169,110,0.07);border:1px solid var(--border);font-size:0.8rem;color:var(--warm-gray);margin-bottom:1rem">
                    <i class="fas fa-file" style="color:var(--gold)"></i>
                    File saat ini: <strong>{{ basename($gallery->file_path) }}</strong>
                    <br><small>Biarkan kosong jika tidak ingin mengganti file</small>
                </div>
                @endif

                <div class="form-grid">
                    <div class="form-group">
                        <label>Judul Media *</label>
                        <input type="text" name="title" class="form-control" value="{{ old('title', $gallery->title) }}" required placeholder="Wedding Rania & Dimas">
                    </div>
                    <div class="form-group">
                        <label>Jenis File *</label>
                        <select name="file_type" class="form-control" required id="fileTypeSelect">
                            <option value="image" {{ old('file_type', $gallery->file_type ?? 'image') == 'image' ? 'selected' : '' }}>Foto / Image</option>
                            <option value="video" {{ old('file_type', $gallery->file_type) == 'video' ? 'selected' : '' }}>Video</option>
                        </select>
                    </div>
                </div>
                <div class="form-grid">
                    <div class="form-group">
                        <label>Kategori</label>
                        <input type="text" name="category" class="form-control" value="{{ old('category', $gallery->category) }}" placeholder="Wedding, Pre-Wedding, Intimate...">
                        <div class="form-hint">Digunakan untuk filter di gallery</div>
                    </div>
                    <div class="form-group">
                        <label>Urutan Tampil</label>
                        <input type="number" name="sort_order" class="form-control" value="{{ old('sort_order', $gallery->sort_order ?? 0) }}">
                    </div>
                </div>
                <div class="form-group">
                    <label>Deskripsi</label>
                    <textarea name="description" class="form-control" rows="3" placeholder="Deskripsi singkat mengenai foto/video ini...">{{ old('description', $gallery->description) }}</textarea>
                </div>
            </div>
        </div>

        <div>
            <div class="card" style="position:sticky;top:80px">
                <div class="card-header"><h3 class="card-title">Status & Visibility</h3></div>

                <div class="form-group">
                    <div class="form-check" style="padding:1rem;border:1px solid #EDE9E3;margin-bottom:0.75rem">
                        <input type="checkbox" id="is_featured" name="is_featured" value="1"
                            {{ old('is_featured', $gallery->is_featured) ? 'checked' : '' }}>
                        <label for="is_featured" style="cursor:pointer">
                            <strong>★ Featured</strong>
                            <div style="font-size:0.75rem;color:var(--warm-gray);margin-top:2px">Ditampilkan di halaman utama</div>
                        </label>
                    </div>
                    <div class="form-check" style="padding:1rem;border:1px solid #EDE9E3">
                        <input type="checkbox" id="is_active" name="is_active" value="1"
                            {{ old('is_active', $gallery->is_active ?? true) ? 'checked' : '' }}>
                        <label for="is_active" style="cursor:pointer">
                            <strong>Aktif</strong>
                            <div style="font-size:0.75rem;color:var(--warm-gray);margin-top:2px">Tampil di halaman gallery</div>
                        </label>
                    </div>
                </div>

                <!-- Preview area -->
                <div id="previewArea" style="display:none;margin-top:1rem">
                    <label style="font-size:0.7rem;font-weight:500;letter-spacing:0.12em;text-transform:uppercase;color:var(--warm-gray);display:block;margin-bottom:0.5rem">Preview</label>
                    <img id="imgPreview" style="width:100%;object-fit:cover" alt="Preview">
                </div>
            </div>
        </div>
    </div>
</form>
@endsection

@section('scripts')
<script>
const dropZone = document.getElementById('dropZone');
const fileInput = document.getElementById('fileInput');

dropZone.addEventListener('dragover', e => {
    e.preventDefault();
    dropZone.style.borderColor = 'var(--gold)';
});
dropZone.addEventListener('dragleave', () => {
    dropZone.style.borderColor = '#DDD';
});
dropZone.addEventListener('drop', e => {
    e.preventDefault();
    dropZone.style.borderColor = '#DDD';
    if (e.dataTransfer.files.length) {
        fileInput.files = e.dataTransfer.files;
        handleFileSelect(fileInput);
    }
});

function handleFileSelect(input) {
    if (!input.files.length) return;
    const file = input.files[0];
    document.getElementById('fileName').style.display = 'block';
    document.getElementById('fileName').textContent = '✓ ' + file.name;

    // Auto-detect type
    if (file.type.startsWith('video/')) {
        document.getElementById('fileTypeSelect').value = 'video';
    } else {
        document.getElementById('fileTypeSelect').value = 'image';
        // Show preview
        const reader = new FileReader();
        reader.onload = e => {
            document.getElementById('imgPreview').src = e.target.result;
            document.getElementById('previewArea').style.display = 'block';
        };
        reader.readAsDataURL(file);
    }
}
</script>
@endsection
