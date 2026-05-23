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

            <!-- Maintenance -->
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title"><i class="fas fa-tools" style="color:var(--gold);margin-right:0.5rem"></i>Mode Maintenance</h3>
                </div>
                <div style="display:flex;align-items:center;justify-content:space-between;padding:1rem;border:1px solid #EDE9E3">
                    <div>
                        <div style="font-size:0.875rem;font-weight:500">Aktifkan Maintenance Mode</div>
                        <div style="font-size:0.78rem;color:var(--warm-gray);margin-top:2px">Website tidak dapat diakses oleh publik</div>
                    </div>
                    <label style="position:relative;width:46px;height:24px;cursor:pointer">
                        <input type="checkbox" name="maintenance_mode" value="1"
                            {{ ($settings['maintenance_mode'] ?? '0') == '1' ? 'checked' : '' }}
                            style="opacity:0;width:0;height:0" id="maintenanceToggle">
                        <span id="toggleKnob" style="position:absolute;inset:0;background:#DDD;border-radius:24px;transition:background 0.3s">
                            <span style="position:absolute;width:18px;height:18px;background:white;border-radius:50%;top:3px;left:3px;transition:transform 0.3s;box-shadow:0 1px 3px rgba(0,0,0,0.2)" id="knob"></span>
                        </span>
                    </label>
                </div>
            </div>
        </div>

        <!-- Appearance -->
        <div>
            <div class="card" style="position:sticky;top:80px">
                <div class="card-header">
                    <h3 class="card-title"><i class="fas fa-palette" style="color:var(--gold);margin-right:0.5rem"></i>Tampilan</h3>
                </div>
                <div class="form-group">
                    <label>Warna Utama (Gold)</label>
                    <div style="display:flex;gap:0.75rem;align-items:center">
                        <input type="color" name="primary_color" id="colorPicker"
                            value="{{ old('primary_color', $settings['primary_color'] ?? '#C9A96E') }}"
                            style="width:48px;height:38px;border:1px solid #EDE9E3;cursor:pointer;padding:2px">
                        <input type="text" id="colorText"
                            value="{{ old('primary_color', $settings['primary_color'] ?? '#C9A96E') }}"
                            class="form-control" style="font-family:monospace" readonly>
                    </div>
                    <div class="form-hint">Warna gold utama brand Anda.</div>
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
