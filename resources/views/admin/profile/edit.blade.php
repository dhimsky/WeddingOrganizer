@extends('layouts.admin')
@section('title', 'Profil Perusahaan')
@section('page-title', 'Profil Perusahaan')
@section('breadcrumb', 'Kelola informasi profil website')

@section('topbar-actions')
<button type="submit" form="profileForm" class="topbar-btn primary">
    <i class="fas fa-save"></i> Simpan Perubahan
</button>
@endsection

@section('content')
<form id="profileForm" method="POST" action="{{ route('admin.profile.update') }}" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <div style="display:grid;grid-template-columns:2fr 1fr;gap:1.5rem">

        <!-- Left -->
        <div>
            <!-- Informasi Dasar -->
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Informasi Dasar</h3>
                </div>
                <div class="form-grid">
                    <div class="form-group">
                        <label>Nama Perusahaan *</label>
                        <input type="text" name="company_name" class="form-control" value="{{ old('company_name', $profile->company_name) }}" required>
                    </div>
                    <div class="form-group">
                        <label>Tagline</label>
                        <input type="text" name="tagline" class="form-control" value="{{ old('tagline', $profile->tagline) }}" placeholder="Crafting Your Perfect Love Story">
                    </div>
                </div>
                <div class="form-group">
                    <label>Deskripsi Perusahaan *</label>
                    <textarea name="description" class="form-control" rows="5" required>{{ old('description', $profile->description) }}</textarea>
                </div>
                <div class="form-grid">
                    <div class="form-group">
                        <label>Tahun Berdiri</label>
                        <input type="text" name="founded_year" class="form-control" value="{{ old('founded_year', $profile->founded_year) }}" placeholder="2013">
                    </div>
                    <div class="form-group mb-0"></div>
                </div>
            </div>

            <!-- Statistik -->
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Statistik & Angka</h3>
                </div>
                <div class="form-grid">
                    <div class="form-group">
                        <label>Jumlah Events</label>
                        <input type="number" name="events_done" class="form-control" value="{{ old('events_done', $profile->events_done) }}">
                    </div>
                    <div class="form-group">
                        <label>Pasangan Bahagia</label>
                        <input type="number" name="happy_couples" class="form-control" value="{{ old('happy_couples', $profile->happy_couples) }}">
                    </div>
                    <div class="form-group">
                        <label>Anggota Tim</label>
                        <input type="number" name="team_members" class="form-control" value="{{ old('team_members', $profile->team_members) }}">
                    </div>
                    <div class="form-group">
                        <label>Tahun Pengalaman</label>
                        <input type="number" name="years_experience" class="form-control" value="{{ old('years_experience', $profile->years_experience) }}">
                    </div>
                </div>
            </div>

            <!-- Kontak -->
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Informasi Kontak</h3>
                </div>
                <div class="form-grid">
                    <div class="form-group">
                        <label>Nomor Telepon *</label>
                        <input type="text" name="phone" class="form-control" value="{{ old('phone', $profile->phone) }}" required>
                    </div>
                    <div class="form-group">
                        <label>Email *</label>
                        <input type="email" name="email" class="form-control" value="{{ old('email', $profile->email) }}" required>
                    </div>
                </div>
                <div class="form-group">
                    <label>Alamat Lengkap *</label>
                    <textarea name="address" class="form-control" rows="3" required>{{ old('address', $profile->address) }}</textarea>
                </div>
            </div>

            <!-- Social Media -->
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Social Media</h3>
                </div>
                <div class="form-grid">
                    <div class="form-group">
                        <label><i class="fab fa-instagram" style="color:#E1306C"></i> Instagram Username</label>
                        <input type="text" name="instagram" class="form-control" value="{{ old('instagram', $profile->instagram) }}" placeholder="lumiere.wedding">
                    </div>
                    <div class="form-group">
                        <label><i class="fab fa-facebook-f" style="color:#1877F2"></i> Facebook Page</label>
                        <input type="text" name="facebook" class="form-control" value="{{ old('facebook', $profile->facebook) }}" placeholder="LumiereWeddingID">
                    </div>
                    <div class="form-group">
                        <label><i class="fab fa-whatsapp" style="color:#25D366"></i> WhatsApp (format: 628xxx)</label>
                        <input type="text" name="whatsapp" class="form-control" value="{{ old('whatsapp', $profile->whatsapp) }}" placeholder="6281234567890">
                    </div>
                    <div class="form-group">
                        <label><i class="fab fa-tiktok"></i> TikTok Username</label>
                        <input type="text" name="tiktok" class="form-control" value="{{ old('tiktok', $profile->tiktok) }}" placeholder="@lumiere.wedding">
                    </div>
                    <div class="form-group">
                        <label><i class="fab fa-youtube" style="color:#FF0000"></i> YouTube Channel</label>
                        <input type="text" name="youtube" class="form-control" value="{{ old('youtube', $profile->youtube) }}" placeholder="LumiereWeddingOrganizer">
                    </div>
                </div>
            </div>
        </div>

        <!-- Right: Images -->
        <div>
            <div class="card" style="position:sticky;top:80px">
                <div class="card-header"><h3 class="card-title">Logo & Gambar</h3></div>

                <!-- Logo -->
                <div class="form-group">
                    <label>Logo Perusahaan</label>
                    @if($profile->logo)
                    <div style="margin-bottom:0.75rem;padding:1rem;border:1px solid #EDE9E3;background:var(--bg);text-align:center">
                        <img src="{{ asset('storage/'.$profile->logo) }}" alt="Logo" style="max-height:80px;max-width:100%">
                    </div>
                    @endif
                    <input type="file" name="logo" class="form-control" accept="image/*">
                    <div class="form-hint">PNG/SVG dengan background transparan. Maks 2MB.</div>
                </div>

                <!-- Hero Image -->
                <div class="form-group">
                    <label>Foto Hero / Banner</label>
                    @if($profile->hero_image)
                    <div style="margin-bottom:0.75rem;overflow:hidden">
                        <img src="{{ asset('storage/'.$profile->hero_image) }}" alt="Hero" style="width:100%;height:120px;object-fit:cover">
                    </div>
                    @else
                    <div style="margin-bottom:0.75rem;height:120px;background:var(--bg);display:flex;align-items:center;justify-content:center;border:1px dashed #DDD;color:var(--warm-gray);font-size:0.8rem">
                        Belum ada foto
                    </div>
                    @endif
                    <input type="file" name="hero_image" class="form-control" accept="image/*">
                    <div class="form-hint">Ukuran ideal: 1920×1080px. Maks 5MB.</div>
                </div>

                <div style="padding:1rem;background:rgba(201,169,110,0.07);border:1px solid var(--border);font-size:0.8rem;color:var(--warm-gray)">
                    <i class="fas fa-info-circle" style="color:var(--gold)"></i>
                    Perubahan akan langsung terlihat di halaman website publik.
                </div>
            </div>
        </div>
    </div>
</form>
@endsection
