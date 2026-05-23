@extends('layouts.admin')
@section('title', 'Visi & Misi')
@section('page-title', 'Visi & Misi')
@section('breadcrumb', 'Kelola visi, misi, dan nilai perusahaan')

@section('topbar-actions')
<button type="submit" form="vmForm" class="topbar-btn primary">
    <i class="fas fa-save"></i> Simpan Perubahan
</button>
@endsection

@section('content')
<form id="vmForm" method="POST" action="{{ route('admin.vision-mission.update') }}">
    @csrf
    @method('PUT')

    <div style="display:grid;grid-template-columns:1fr 1fr;gap:1.5rem;margin-bottom:1.5rem">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title"><i class="fas fa-eye" style="color:var(--gold);margin-right:0.5rem"></i>Visi</h3>
            </div>
            <div class="form-group" style="margin-bottom:0">
                <label>Pernyataan Visi *</label>
                <textarea name="vision" class="form-control" rows="8" required placeholder="Tuliskan visi perusahaan Anda...">{{ old('vision', $vm->vision ?? '') }}</textarea>
                <div class="form-hint">Visi adalah gambaran masa depan ideal yang ingin dicapai.</div>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <h3 class="card-title"><i class="fas fa-bullseye" style="color:var(--gold);margin-right:0.5rem"></i>Misi</h3>
            </div>
            <div id="missionContainer">
                @if($vm && $vm->mission)
                    @foreach($vm->mission as $i => $m)
                    <div class="mission-item" style="display:flex;gap:0.75rem;margin-bottom:0.75rem;align-items:flex-start">
                        <span style="font-family:var(--font-serif);font-size:1.5rem;color:var(--gold-light);line-height:1;flex-shrink:0;margin-top:8px">0{{ $i+1 }}</span>
                        <textarea name="mission[]" class="form-control" rows="2" placeholder="Tulis misi ke-{{ $i+1 }}">{{ $m }}</textarea>
                        <button type="button" onclick="removeMission(this)" style="background:none;border:1px solid #EDE9E3;color:#999;padding:0.4rem 0.6rem;cursor:pointer;flex-shrink:0;margin-top:4px">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                    @endforeach
                @else
                    <div class="mission-item" style="display:flex;gap:0.75rem;margin-bottom:0.75rem;align-items:flex-start">
                        <span style="font-family:var(--font-serif);font-size:1.5rem;color:var(--gold-light);line-height:1;flex-shrink:0;margin-top:8px">01</span>
                        <textarea name="mission[]" class="form-control" rows="2" placeholder="Tulis misi pertama..."></textarea>
                        <button type="button" onclick="removeMission(this)" style="background:none;border:1px solid #EDE9E3;color:#999;padding:0.4rem 0.6rem;cursor:pointer;flex-shrink:0;margin-top:4px">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                @endif
            </div>
            <button type="button" onclick="addMission()" class="topbar-btn" style="width:100%;justify-content:center;margin-top:0.5rem">
                <i class="fas fa-plus"></i> Tambah Misi
            </button>
        </div>
    </div>

    <!-- Core Values -->
    <div class="card">
        <div class="card-header">
            <h3 class="card-title"><i class="fas fa-gem" style="color:var(--gold);margin-right:0.5rem"></i>Core Values</h3>
            <button type="button" onclick="addValue()" class="topbar-btn">
                <i class="fas fa-plus"></i> Tambah Value
            </button>
        </div>
        <div id="valuesContainer" style="display:grid;grid-template-columns:repeat(auto-fill,minmax(280px,1fr));gap:1.25rem">
            @if($vm && $vm->values)
                @foreach($vm->values as $i => $val)
                <div class="value-item" style="border:1px solid #EDE9E3;padding:1.25rem;position:relative">
                    <button type="button" onclick="removeValue(this)" style="position:absolute;top:0.75rem;right:0.75rem;background:none;border:none;color:#CCC;cursor:pointer;font-size:1rem">
                        <i class="fas fa-times"></i>
                    </button>
                    <div class="form-group">
                        <label>Icon (emoji)</label>
                        <input type="text" name="values[{{ $i }}][icon]" class="form-control" value="{{ $val['icon'] ?? '' }}" placeholder="✨" maxlength="4">
                    </div>
                    <div class="form-group">
                        <label>Judul Value</label>
                        <input type="text" name="values[{{ $i }}][title]" class="form-control" value="{{ $val['title'] ?? '' }}" placeholder="Elegance">
                    </div>
                    <div class="form-group" style="margin-bottom:0">
                        <label>Deskripsi</label>
                        <textarea name="values[{{ $i }}][description]" class="form-control" rows="2" placeholder="Deskripsi singkat...">{{ $val['description'] ?? '' }}</textarea>
                    </div>
                </div>
                @endforeach
            @endif
        </div>
    </div>
</form>
@endsection

@section('scripts')
<script>
let missionCount = {{ ($vm && $vm->mission) ? count($vm->mission) : 1 }};
let valueCount = {{ ($vm && $vm->values) ? count($vm->values) : 0 }};

function addMission() {
    missionCount++;
    const num = missionCount.toString().padStart(2, '0');
    const html = `
        <div class="mission-item" style="display:flex;gap:0.75rem;margin-bottom:0.75rem;align-items:flex-start">
            <span style="font-family:'Cormorant Garamond',serif;font-size:1.5rem;color:#E8D5B0;line-height:1;flex-shrink:0;margin-top:8px">${num}</span>
            <textarea name="mission[]" class="form-control" rows="2" placeholder="Tulis misi ke-${missionCount}..."></textarea>
            <button type="button" onclick="removeMission(this)" style="background:none;border:1px solid #EDE9E3;color:#999;padding:0.4rem 0.6rem;cursor:pointer;flex-shrink:0;margin-top:4px">
                <i class="fas fa-times"></i>
            </button>
        </div>`;
    document.getElementById('missionContainer').insertAdjacentHTML('beforeend', html);
}

function removeMission(btn) {
    btn.closest('.mission-item').remove();
}

function addValue() {
    const i = valueCount++;
    const html = `
        <div class="value-item" style="border:1px solid #EDE9E3;padding:1.25rem;position:relative">
            <button type="button" onclick="removeValue(this)" style="position:absolute;top:0.75rem;right:0.75rem;background:none;border:none;color:#CCC;cursor:pointer;font-size:1rem">
                <i class="fas fa-times"></i>
            </button>
            <div class="form-group">
                <label style="font-size:0.7rem;font-weight:500;letter-spacing:0.12em;text-transform:uppercase;color:var(--warm-gray);display:block;margin-bottom:0.5rem">Icon (emoji)</label>
                <input type="text" name="values[${i}][icon]" class="form-control" placeholder="✨" maxlength="4">
            </div>
            <div class="form-group">
                <label style="font-size:0.7rem;font-weight:500;letter-spacing:0.12em;text-transform:uppercase;color:var(--warm-gray);display:block;margin-bottom:0.5rem">Judul Value</label>
                <input type="text" name="values[${i}][title]" class="form-control" placeholder="Elegance">
            </div>
            <div class="form-group" style="margin-bottom:0">
                <label style="font-size:0.7rem;font-weight:500;letter-spacing:0.12em;text-transform:uppercase;color:var(--warm-gray);display:block;margin-bottom:0.5rem">Deskripsi</label>
                <textarea name="values[${i}][description]" class="form-control" rows="2" placeholder="Deskripsi singkat..."></textarea>
            </div>
        </div>`;
    document.getElementById('valuesContainer').insertAdjacentHTML('beforeend', html);
}

function removeValue(btn) {
    btn.closest('.value-item').remove();
}
</script>
@endsection
