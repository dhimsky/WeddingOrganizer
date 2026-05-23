@extends('layouts.frontend')
@section('title', 'Visi & Misi - ' . ($profile->company_name ?? 'Gugugaga'))
@section('styles')
<style>
.page-hero { min-height:45vh; background:var(--charcoal); display:flex; align-items:center; justify-content:center; text-align:center; position:relative; }
.page-hero::before { content:''; position:absolute; inset:0; background:url('https://images.unsplash.com/photo-1469371670807-013ccf25f16a?w=1920&q=80') center/cover; opacity:0.25; }
.page-hero-content { position:relative; z-index:1; color:white; }
.page-hero h1 { font-family:var(--font-serif); font-size:clamp(2.5rem,5vw,4.5rem); font-weight:300; }
.vision-grid { display:grid; grid-template-columns:1fr 1fr; gap:4rem; }
.vision-box { padding:3.5rem; border:1px solid var(--border); background:white; position:relative; overflow:hidden; }
.vision-box::before { content:''; position:absolute; top:0; left:0; width:4px; height:100%; background:var(--gold); }
.vision-box h3 { font-family:var(--font-serif); font-size:1.5rem; font-weight:400; color:var(--gold); margin-bottom:1.5rem; display:flex; align-items:center; gap:0.75rem; }
.vision-box p { color:var(--warm-gray); line-height:1.9; font-size:0.95rem; }
.mission-list { list-style:none; margin-top:0.5rem; }
.mission-list li { display:flex; gap:1rem; align-items:flex-start; padding:0.9rem 0; border-bottom:1px solid var(--border); color:var(--warm-gray); font-size:0.9rem; line-height:1.7; }
.mission-list li:last-child { border:none; }
.mission-num { font-family:var(--font-serif); font-size:1.8rem; font-weight:300; color:var(--gold-light); line-height:1; flex-shrink:0; width:40px; }
.values-section { background:var(--charcoal); }
.values-section .section-title { color:white; }
.values-grid { display:grid; grid-template-columns:repeat(4,1fr); gap:1.5rem; }
.value-card { padding:2.5rem 2rem; border:1px solid rgba(201,169,110,0.2); text-align:center; transition:all 0.3s; }
.value-card:hover { border-color:var(--gold); background:rgba(201,169,110,0.05); }
.value-icon { font-size:2.5rem; margin-bottom:1rem; display:block; }
.value-card h4 { font-family:var(--font-serif); font-size:1.25rem; font-weight:400; color:white; margin-bottom:0.75rem; }
.value-card p { font-size:0.85rem; color:rgba(255,255,255,0.55); line-height:1.7; }
@media (max-width:768px) { .vision-grid { grid-template-columns:1fr; } .values-grid { grid-template-columns:repeat(2,1fr); } }
</style>
@endsection
@section('content')
<div style="padding-top:80px">
    <div class="page-hero">
        <div class="page-hero-content">
            <span class="section-label" style="color:var(--gold-light)">Our Direction</span>
            <h1>Visi & <em style="font-style:italic;color:var(--gold-light)">Misi</em></h1>
        </div>
    </div>
</div>

<section>
    <div class="container">
        @if($visionMission)
        <div class="vision-grid">
            <div class="vision-box reveal">
                <h3><i class="fas fa-eye"></i> Visi Kami</h3>
                <p>{{ $visionMission->vision }}</p>
            </div>
            <div class="vision-box reveal">
                <h3><i class="fas fa-bullseye"></i> Misi Kami</h3>
                @if($visionMission->mission)
                <ul class="mission-list">
                    @foreach($visionMission->mission as $i => $mission)
                    <li>
                        <span class="mission-num">0{{ $i+1 }}</span>
                        <span>{{ $mission }}</span>
                    </li>
                    @endforeach
                </ul>
                @endif
            </div>
        </div>
        @else
        <div style="text-align:center;padding:4rem;color:var(--warm-gray)">Konten visi & misi belum ditambahkan.</div>
        @endif
    </div>
</section>

@if($visionMission && $visionMission->values)
<section class="values-section">
    <div class="container">
        <div class="section-header reveal">
            <span class="section-label" style="color:var(--gold-light)">Core Values</span>
            <h2 class="section-title">Nilai yang Kami <em style="font-style:italic;color:var(--gold-light)">Junjung</em></h2>
            <div class="section-divider"></div>
        </div>
        <div class="values-grid">
            @foreach($visionMission->values as $value)
            <div class="value-card reveal">
                <span class="value-icon">{{ $value['icon'] ?? '⭐' }}</span>
                <h4>{{ $value['title'] }}</h4>
                <p>{{ $value['description'] }}</p>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endif
@endsection
