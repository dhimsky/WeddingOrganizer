@extends('layouts.frontend')
@section('title', 'Profil - ' . ($profile->company_name ?? 'Gugugaga'))
@section('styles')
<style>
.page-hero { min-height:45vh; background:var(--charcoal); display:flex; align-items:center; justify-content:center; text-align:center; position:relative; }
.page-hero::before { content:''; position:absolute; inset:0; background:url('https://images.unsplash.com/photo-1511285560929-80b456503681?w=1920&q=80') center/cover; opacity:0.25; }
.page-hero-content { position:relative; z-index:1; color:white; }
.page-hero h1 { font-family:var(--font-serif); font-size:clamp(2.5rem,5vw,4.5rem); font-weight:300; }
.profile-intro { display:grid; grid-template-columns:1fr 1fr; gap:6rem; align-items:center; }
.profile-img-wrap { position:relative; }
.profile-img-wrap img { width:100%; aspect-ratio:4/5; object-fit:cover; }
.profile-text h2 { font-family:var(--font-serif); font-size:2.5rem; font-weight:300; margin-bottom:1rem; }
.profile-text p { color:var(--warm-gray); line-height:1.9; font-size:0.95rem; margin-bottom:1rem; }
.profile-stats { display:grid; grid-template-columns:repeat(2,1fr); gap:1.5rem; margin-top:2rem; }
.profile-stat { padding:1.5rem; border:1px solid var(--border); text-align:center; }
.profile-stat .num { font-family:var(--font-serif); font-size:2.5rem; font-weight:300; color:var(--gold); line-height:1; }
.profile-stat .lbl { font-size:0.7rem; letter-spacing:0.15em; text-transform:uppercase; color:var(--warm-gray); margin-top:0.4rem; }
.team-section { background:var(--charcoal); }
.team-section .section-title { color:white; }
.team-grid { display:grid; grid-template-columns:repeat(4,1fr); gap:1.5rem; }
.team-card {
    text-align: center;
    position: relative;
}

.team-img {
    aspect-ratio: 1;
    overflow: hidden;
    margin-bottom: 1rem;
    position: relative;
}

.team-img img,
.team-img .team-initials {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.4s ease;
    display: block;
}

.team-card:hover .team-img img,
.team-card:hover .team-img .team-initials {
    transform: scale(1.04);
}

/* Overlay muncul dari bawah, hanya seperempat card */
.team-img-overlay {
    position: absolute;
    bottom: 0;
    left: 0;
    right: 0;
    height: 25%;          /* seperempat tinggi gambar */
    background: linear-gradient(to top, rgba(201,169,110,0.95), rgba(201,169,110,0.7));
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 1rem;
    transform: translateY(100%);   /* awalnya tersembunyi di bawah */
    transition: transform 0.35s ease;
}

.team-card:hover .team-img-overlay {
    transform: translateY(0);      /* muncul ke atas saat hover */
}

.team-img-overlay a {
    color: white;
    font-size: 1rem;
    text-decoration: none;
    display: flex;
    align-items: center;
    gap: 0.35rem;
    font-size: 0.78rem;
    font-weight: 500;
    letter-spacing: 0.05em;
    transition: opacity 0.2s;
}

.team-img-overlay a:hover {
    opacity: 0.8;
}
.team-card h4 { font-family:var(--font-serif); font-size:1.1rem; font-weight:400; color:white; }
.team-card span { font-size:0.75rem; color:var(--gold-light); letter-spacing:0.1em; }
@media (max-width:768px) { .profile-intro { grid-template-columns:1fr; } .team-grid { grid-template-columns:repeat(2,1fr); } }
</style>
@endsection
@section('content')
<div style="padding-top:80px">
    <div class="page-hero">
        <div class="page-hero-content">
            <span class="section-label" style="color:var(--gold-light)">Who We Are</span>
            <h1>Tentang <em style="font-style:italic;color:var(--gold-light)">Kami</em></h1>
        </div>
    </div>
</div>

<section>
    <div class="container">
        <div class="profile-intro">
            <div class="profile-img-wrap reveal">
                <img src="{{ $profile->hero_image ? asset('storage/'.$profile->hero_image) : 'https://images.unsplash.com/photo-1543333995-a78aea2eee50?w=800&q=80' }}" alt="Profile">            
            </div>
            <div class="reveal">
                <span class="section-label">{{ $profile->company_name ?? 'Wedding Organizer' }}</span>
                <h2>{{ $profile->tagline ?? 'Crafting Your Perfect Love Story' }}</h2>
                <div class="section-divider" style="margin:1.5rem 0"></div>
                <p>{{ $profile->description ?? '' }}</p>
                @if($profile && $profile->founded_year)
                <p>Berdiri sejak tahun {{ $profile->founded_year }}, kami telah berkembang menjadi salah satu wedding organizer terpercaya di Indonesia.</p>
                @endif
                <div class="profile-stats">
                    <div class="profile-stat"><div class="num">{{ $profile->events_done ?? 350 }}+</div><div class="lbl">Events</div></div>
                    <div class="profile-stat"><div class="num">{{ $profile->happy_couples ?? 350 }}+</div><div class="lbl">Happy Couples</div></div>
                    <div class="profile-stat"><div class="num">{{ $profile->team_members ?? 25 }}+</div><div class="lbl">Tim Profesional</div></div>
                    <div class="profile-stat"><div class="num">{{ $profile->years_experience ?? 10 }}+</div><div class="lbl">Tahun Pengalaman</div></div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="team-section">
    <div class="container">
        <div class="section-header reveal">
            <span class="section-label" style="color:var(--gold-light)">Tim Kami</span>
            <h2 class="section-title">Meet the <em style="font-style:italic;color:var(--gold-light)">Dream Team</em></h2>
            <div class="section-divider"></div>
        </div>
        <div class="team-grid">
            @foreach($teamMembers as $member)
            <div class="team-card reveal">
                <div class="team-img">
                    @if($member->photo && \Storage::disk('public')->exists($member->photo))
                        <img src="{{ asset('storage/'.$member->photo) }}" alt="{{ $member->name }}">
                    @else
                        <div style="width:100%;height:100%;background:rgba(201,169,110,0.1);display:flex;align-items:center;justify-content:center;font-family:var(--font-serif);font-size:3rem;color:var(--gold)">
                            {{ strtoupper(substr($member->name, 0, 1)) }}
                        </div>
                    @endif
                    @if($member->instagram)
                    <div class="team-img-overlay">
                        <a href="https://instagram.com/{{ $member->instagram }}" target="_blank">
                            <i class="fab fa-instagram"></i> {{ $member->instagram }}
                        </a>
                    </div>
                    @endif
                </div>
                <h4>{{ $member->name }}</h4>
                <span>{{ $member->role }}</span>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endsection
