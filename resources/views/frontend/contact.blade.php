@extends('layouts.frontend')
@section('title', 'Hubungi Kami - ' . ($profile->company_name ?? 'Gugugaga'))
@section('styles')
<style>
.page-hero { min-height:45vh; background:var(--charcoal); display:flex; align-items:center; justify-content:center; text-align:center; position:relative; }
.page-hero::before { content:''; position:absolute; inset:0; background:url('https://images.unsplash.com/photo-1464366400600-7168b8af9bc3?w=1920&q=80') center/cover; opacity:0.2; }
.page-hero-content { position:relative; z-index:1; color:white; }
.page-hero h1 { font-family:var(--font-serif); font-size:clamp(2.5rem,5vw,4.5rem); font-weight:300; }
.contact-grid { display:grid; grid-template-columns:1fr 1.5fr; gap:5rem; align-items:start; }
.contact-info h3 { font-family:var(--font-serif); font-size:2rem; font-weight:400; margin-bottom:1rem; }
.contact-info p { color:var(--warm-gray); font-size:0.9rem; line-height:1.9; margin-bottom:2rem; }
.contact-item { display:flex; gap:1.25rem; align-items:flex-start; margin-bottom:1.75rem; }
.contact-icon { width:44px; height:44px; background:rgba(201,169,110,0.1); border:1px solid var(--border); display:flex; align-items:center; justify-content:center; color:var(--gold); flex-shrink:0; }
.contact-item h5 { font-size:0.7rem; font-weight:500; letter-spacing:0.15em; text-transform:uppercase; color:var(--warm-gray); margin-bottom:0.3rem; }
.contact-item p { font-size:0.9rem; color:var(--charcoal); margin:0; }
.social-links { display:flex; gap:0.75rem; margin-top:2rem; }
.social-link { width:42px; height:42px; border:1px solid var(--border); display:flex; align-items:center; justify-content:center; color:var(--gold); text-decoration:none; transition:all 0.3s; }
.social-link:hover { background:var(--gold); color:white; border-color:var(--gold); }
.contact-form-wrap { background:white; padding:3rem; border:1px solid var(--border); }
.form-row { display:grid; grid-template-columns:1fr 1fr; gap:1.5rem; }
.form-group { margin-bottom:1.5rem; }
.form-group label { display:block; font-size:0.7rem; font-weight:500; letter-spacing:0.15em; text-transform:uppercase; color:var(--warm-gray); margin-bottom:0.5rem; }
.form-group input, .form-group select, .form-group textarea {
    width:100%; padding:0.875rem 1rem; border:1px solid var(--border); background:var(--cream);
    font-family:var(--font-sans); font-size:0.9rem; color:var(--charcoal); outline:none; transition:border-color 0.3s;
}
.form-group input:focus, .form-group select:focus, .form-group textarea:focus { border-color:var(--gold); }
.form-group textarea { height:130px; resize:vertical; }
.alert-success { padding:1rem 1.5rem; background:rgba(201,169,110,0.1); border:1px solid var(--gold); color:var(--gold-dark); margin-bottom:1.5rem; font-size:0.875rem; }
@media (max-width:768px) { .contact-grid { grid-template-columns:1fr; } .form-row { grid-template-columns:1fr; } }
</style>
@endsection

@section('content')
<div style="padding-top:80px">
    <div class="page-hero">
        <div class="page-hero-content">
            <span class="section-label" style="color:var(--gold-light)">Let's Connect</span>
            <h1>Hubungi <em style="font-style:italic;color:var(--gold-light)">Kami</em></h1>
        </div>
    </div>
</div>

<section>
    <div class="container">
        <div class="contact-grid">
            <!-- Info -->
            <div class="reveal">
                <span class="section-label">Konsultasi Gratis</span>
                <div class="contact-info">
                <h3>Wujudkan Pernikahan Impian Anda</h3>
                    <p>Kami siap membantu Anda merencanakan hari istimewa yang tak terlupakan. Hubungi kami untuk konsultasi gratis dan diskusikan visi pernikahan Anda bersama tim kami.</p>
                </div>

                @if($profile)
                <div class="contact-item">
                    <div class="contact-icon"><i class="fas fa-map-marker-alt"></i></div>
                    <div>
                        <h5>Alamat</h5>
                        <p>{{ $profile->address }}</p>
                    </div>
                </div>
                <div class="contact-item">
                    <div class="contact-icon"><i class="fas fa-phone"></i></div>
                    <div>
                        <h5>Telepon</h5>
                        <p>{{ $profile->phone }}</p>
                    </div>
                </div>
                <div class="contact-item">
                    <div class="contact-icon"><i class="fas fa-envelope"></i></div>
                    <div>
                        <h5>Email</h5>
                        <p>{{ $profile->email }}</p>
                    </div>
                </div>
                @endif

                <div class="social-links">
                    @if($profile && $profile->instagram)<a href="https://instagram.com/{{ $profile->instagram }}" target="_blank" class="social-link"><i class="fab fa-instagram"></i></a>@endif
                    @if($profile && $profile->whatsapp)<a href="https://wa.me/{{ $profile->whatsapp }}" target="_blank" class="social-link"><i class="fab fa-whatsapp"></i></a>@endif
                    @if($profile && $profile->facebook)<a href="https://facebook.com/{{ $profile->facebook }}" target="_blank" class="social-link"><i class="fab fa-facebook-f"></i></a>@endif
                    @if($profile && $profile->tiktok)<a href="https://tiktok.com/{{ $profile->tiktok }}" target="_blank" class="social-link"><i class="fab fa-tiktok"></i></a>@endif
                </div>
            </div>

            <!-- Form -->
            <div class="reveal">
                <div class="contact-form-wrap">
                    <h3 style="font-family:var(--font-serif);font-size:1.6rem;font-weight:400;margin-bottom:0.5rem">Kirim Pesan</h3>
                    <p style="color:var(--warm-gray);font-size:0.875rem;margin-bottom:2rem">Isi formulir di bawah dan kami akan segera menghubungi Anda</p>

                    @if(session('success'))
                    <div class="alert-success">
                        <i class="fas fa-check-circle"></i> {{ session('success') }}
                    </div>
                    @endif

                    <form method="POST" action="{{ route('contact.store') }}">
                        @csrf
                        <div class="form-row">
                            <div class="form-group">
                                <label>Nama Lengkap *</label>
                                <input type="text" name="name" required value="{{ old('name') }}" placeholder="Nama Anda">
                                @error('name')<small style="color:#e74c3c">{{ $message }}</small>@enderror
                            </div>
                            <div class="form-group">
                                <label>Email *</label>
                                <input type="email" name="email" required value="{{ old('email') }}" placeholder="email@domain.com">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group">
                                <label>No. WhatsApp</label>
                                <input type="text" name="phone" value="{{ old('phone') }}" placeholder="+62 812-xxxx-xxxx">
                            </div>
                            <div class="form-group">
                                <label>Jenis Acara</label>
                                <select name="event_type">
                                    <option value="">Pilih jenis acara</option>
                                    <option value="Full Wedding Organizer">Full Wedding Organizer</option>
                                    <option value="Wedding Day Coordinator">Wedding Day Coordinator</option>
                                    <option value="Wedding Decoration">Wedding Decoration</option>
                                    <option value="Pre-Wedding">Pre-Wedding</option>
                                    <option value="Intimate Wedding">Intimate Wedding</option>
                                    <option value="Destination Wedding">Destination Wedding</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group">
                                <label>Tanggal Acara</label>
                                <input type="date" name="event_date" value="{{ old('event_date') }}">
                            </div>
                            <div class="form-group">
                                <label>Budget Range</label>
                                <select name="budget_range">
                                    <option value="">Pilih budget</option>
                                    <option value="< 25 juta">Di bawah 25 juta</option>
                                    <option value="25 - 50 juta">25 - 50 juta</option>
                                    <option value="50 - 100 juta">50 - 100 juta</option>
                                    <option value="100 - 200 juta">100 - 200 juta</option>
                                    <option value="> 200 juta">Di atas 200 juta</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Pesan *</label>
                            <textarea name="message" required placeholder="Ceritakan impian pernikahan Anda...">{{ old('message') }}</textarea>
                        </div>
                        <button type="submit" class="btn-primary" style="width:100%;justify-content:center;border:none;cursor:pointer;font-family:var(--font-sans)">
                            Kirim Pesan <i class="fas fa-paper-plane"></i>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
