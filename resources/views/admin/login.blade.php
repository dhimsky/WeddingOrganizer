<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login - Gugugaga Wedding Organizer</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,300;0,400;0,500;0,600;1,300;1,400&family=Jost:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        :root {
            --gold: #C9A96E; --gold-light: #E8D5B0; --gold-dark: #9B7B4C;
            --cream: #FAF7F2; --charcoal: #1A1A1A; --warm-gray: #6B6B6B;
            --font-serif: 'Cormorant Garamond', Georgia, serif;
            --font-sans: 'Jost', sans-serif;
        }
        * { margin:0; padding:0; box-sizing:border-box; }
        body { font-family:var(--font-sans); min-height:100vh; display:grid; grid-template-columns:1fr 1fr; background:var(--cream); }

        .login-left {
            background: var(--charcoal);
            position: relative;
            overflow: hidden;
            display: flex;
            flex-direction: column;
            justify-content: flex-end;
            padding: 4rem;
        }
        .login-left::before {
            content: '';
            position: absolute; inset: 0;
            background: url('https://images.unsplash.com/photo-1519741497674-611481863552?w=1200&q=80') center/cover;
            opacity: 0.3;
        }
        .login-left-content { position: relative; z-index: 1; color: white; }
        .brand-logo {
            font-family: var(--font-serif);
            font-size: 2.5rem;
            font-weight: 300;
            letter-spacing: 0.05em;
            color: white;
            margin-bottom: 2rem;
        }
        .brand-logo span { color: var(--gold); }
        .login-left h2 {
            font-family: var(--font-serif);
            font-size: clamp(2rem, 3vw, 3rem);
            font-weight: 300;
            line-height: 1.2;
            margin-bottom: 1rem;
        }
        .login-left p { color: rgba(255,255,255,0.6); font-size: 0.9rem; line-height: 1.8; }
        .login-left-divider { width: 50px; height: 1px; background: var(--gold); margin: 1.5rem 0; }

        .login-right {
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 3rem;
        }
        .login-box { width: 100%; max-width: 440px; }
        .login-box h3 {
            font-family: var(--font-serif);
            font-size: 2rem;
            font-weight: 400;
            color: var(--charcoal);
            margin-bottom: 0.5rem;
        }
        .login-box > p { color: var(--warm-gray); font-size: 0.875rem; margin-bottom: 2.5rem; }

        .form-group { margin-bottom: 1.5rem; }
        .form-group label {
            display: block;
            font-size: 0.7rem;
            font-weight: 500;
            letter-spacing: 0.15em;
            text-transform: uppercase;
            color: var(--warm-gray);
            margin-bottom: 0.5rem;
        }
        .input-wrap { position: relative; }
        .input-wrap i {
            position: absolute;
            left: 1rem; top: 50%;
            transform: translateY(-50%);
            color: var(--warm-gray);
            font-size: 0.85rem;
        }
        .form-group input {
            width: 100%;
            padding: 0.875rem 1rem 0.875rem 2.75rem;
            border: 1px solid #E0DDD8;
            background: var(--cream);
            font-family: var(--font-sans);
            font-size: 0.9rem;
            color: var(--charcoal);
            outline: none;
            transition: border-color 0.3s;
        }
        .form-group input:focus { border-color: var(--gold); }

        .form-options {
            display: flex; justify-content: space-between; align-items: center;
            margin-bottom: 2rem; font-size: 0.8rem;
        }
        .form-options label { display: flex; align-items: center; gap: 0.5rem; color: var(--warm-gray); cursor: pointer; }
        .form-options input[type=checkbox] { accent-color: var(--gold); }

        .btn-login {
            width: 100%;
            padding: 1rem;
            background: var(--gold);
            color: white;
            border: none;
            font-family: var(--font-sans);
            font-size: 0.8rem;
            font-weight: 500;
            letter-spacing: 0.2em;
            text-transform: uppercase;
            cursor: pointer;
            transition: all 0.3s;
        }
        .btn-login:hover { background: var(--gold-dark); }

        .alert-error {
            padding: 1rem 1.25rem;
            background: #FEF2F2;
            border: 1px solid #FECACA;
            color: #B91C1C;
            font-size: 0.875rem;
            margin-bottom: 1.5rem;
            display: flex; align-items: center; gap: 0.75rem;
        }

        .back-link {
            display: flex; align-items: center; gap: 0.5rem;
            color: var(--warm-gray); font-size: 0.8rem; text-decoration: none;
            margin-top: 2rem; letter-spacing: 0.05em;
            transition: color 0.3s;
        }
        .back-link:hover { color: var(--gold); }

        @media (max-width: 768px) {
            body { grid-template-columns: 1fr; }
            .login-left { display: none; }
        }
    </style>
</head>
<body>
    <div class="login-left">
        <div class="login-left-content">
            <div class="brand-logo">Gugugaga<span>✦</span></div>
            <h2>Admin<br>Dashboard</h2>
            <div class="login-left-divider"></div>
            <p>Kelola seluruh konten website Gugugaga Wedding Organizer dengan mudah dan efisien.</p>
        </div>
    </div>

    <div class="login-right">
        <div class="login-box">
            <h3>Selamat Datang</h3>
            <p>Masuk ke panel administrasi Gugugaga</p>

            @if($errors->any())
            <div class="alert-error">
                <i class="fas fa-exclamation-circle"></i>
                {{ $errors->first() }}
            </div>
            @endif

            @if(session('success'))
            <div style="padding:1rem 1.25rem;background:#F0FDF4;border:1px solid #BBF7D0;color:#15803D;font-size:0.875rem;margin-bottom:1.5rem">
                {{ session('success') }}
            </div>
            @endif

            <form method="POST" action="{{ route('login.post') }}">
                @csrf
                <div class="form-group">
                    <label>Email Address</label>
                    <div class="input-wrap">
                        <i class="fas fa-envelope"></i>
                        <input type="email" name="email" value="{{ old('email') }}" placeholder="admin@lumiere-wedding.com" required autofocus>
                    </div>
                </div>
                <div class="form-group">
                    <label>Password</label>
                    <div class="input-wrap">
                        <i class="fas fa-lock"></i>
                        <input type="password" name="password" placeholder="••••••••" required>
                    </div>
                </div>
                <div class="form-options">
                    <label>
                        <input type="checkbox" name="remember">
                        Ingat saya
                    </label>
                </div>
                <button type="submit" class="btn-login">
                    Masuk <i class="fas fa-arrow-right" style="margin-left:0.5rem"></i>
                </button>
            </form>

            <a href="{{ route('home') }}" class="back-link">
                <i class="fas fa-arrow-left"></i> Kembali ke Website
            </a>
        </div>
    </div>
</body>
</html>
