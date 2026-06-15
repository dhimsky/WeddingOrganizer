@extends('layouts.admin')
@section('title', 'Pengaturan Website')
@section('page-title', 'Pengaturan')
@section('breadcrumb', 'Konfigurasi umum website')

@section('topbar-actions')
<button type="submit" form="settingsForm" class="topbar-btn primary">
    <i class="fas fa-save"></i> Simpan Pengaturan
</button>
@endsection

@section('content')
<form id="settingsForm" method="POST" action="{{ route('admin.settings.update') }}">
    @csrf @method('PUT')

    <div style="display:grid;grid-template-columns:2fr 1fr;gap:1.5rem">
        <div>
            <!-- SEO -->
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title"><i class="fas fa-search" style="color:var(--gold);margin-right:0.5rem"></i>SEO & Meta</h3>
                </div>
                <div class="form-group">
                    <label>Judul Website (Site Title)</label>
                    <input type="text" name="site_title" class="form-control"
                        value="{{ old('site_title', $settings['site_title'] ?? '') }}"
                        placeholder="Lumière Wedding Organizer">
                    <div class="form-hint">Tampil di tab browser dan hasil pencarian Google.</div>
                </div>
                <div class="form-group" style="margin-bottom:0">
                    <label>Meta Description</label>
                    <textarea name="meta_description" class="form-control" rows="3"
                        placeholder="Deskripsi singkat website (maks 160 karakter)...">{{ old('meta_description', $settings['meta_description'] ?? '') }}</textarea>
                    <div class="form-hint">Penting untuk SEO. Idealnya 120–160 karakter.</div>
                </div>
            </div>

            <!-- Hero Section -->
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title"><i class="fas fa-home" style="color:var(--gold);margin-right:0.5rem"></i>Halaman Utama (Hero)</h3>
                </div>
                <div class="form-group" style="margin-bottom:0">
                    <label>Tagline Hero</label>
                    <input type="text" name="hero_tagline" class="form-control"
                        value="{{ old('hero_tagline', $settings['hero_tagline'] ?? '') }}"
                        placeholder="Crafting Your Perfect Love Story">
                    <div class="form-hint">Teks utama yang tampil di atas gambar hero.</div>
                </div>
            </div>
        </div>

        <!-- Appearance -->
        <div>
            <div class="card" style="position:sticky;top:80px">
                <div class="card-header">
                    <h3 class="card-title"><i class="fas fa-palette" style="color:var(--gold);margin-right:0.5rem"></i>Tech Stack</h3>
                </div>

                <div style="padding:1.5rem;border:1px solid var(--border);background:rgba(201,169,110,0.04);margin-top:0.5rem">
                    <div style="font-size:0.7rem;letter-spacing:0.15em;text-transform:uppercase;color:var(--warm-gray);margin-bottom:1rem">Info Sistem</div>
                    <div style="font-size:0.8rem;color:var(--warm-gray);display:flex;flex-direction:column;gap:0.5rem">
                        <div><i class="fab fa-laravel" style="color:var(--gold);width:20px"></i> Laravel 10</div>
                        <div><i class="fas fa-database" style="color:var(--gold);width:20px"></i> MySQL Database</div>
                        <div><i class="fas fa-code" style="color:var(--gold);width:20px"></i> PHP 8.1+</div>
                        <div><i class="fas fa-calendar" style="color:var(--gold);width:20px"></i> v1.0.0 — {{ date('Y') }}</div>
                    </div>
                </div>

                <div style="margin-top:1.5rem">
                    <a href="{{ route('home') }}" target="_blank" class="topbar-btn" style="width:100%;justify-content:center">
                        <i class="fas fa-external-link-alt"></i> Preview Website
                    </a>
                </div>
            </div>
        </div>
    </div>
</form>
@endsection

@section('scripts')
<script>
const colorPicker = document.getElementById('colorPicker');
const colorText = document.getElementById('colorText');
colorPicker.addEventListener('input', () => { colorText.value = colorPicker.value; });

const toggle = document.getElementById('maintenanceToggle');
const knob = document.getElementById('knob');
const track = document.getElementById('toggleKnob');

function updateToggle() {
    if (toggle.checked) {
        track.style.background = '#EF4444';
        knob.style.transform = 'translateX(22px)';
    } else {
        track.style.background = '#DDD';
        knob.style.transform = 'translateX(0)';
    }
}
toggle.addEventListener('change', updateToggle);
updateToggle();
</script>
@endsection
