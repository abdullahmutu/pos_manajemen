<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login — TokoKu</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            min-height: 100vh;
            background: #f0f9f4;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 1rem;
        }
        .login-wrapper {
            display: grid;
            grid-template-columns: 1fr 1fr;
            max-width: 860px;
            width: 100%;
            background: white;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 20px 60px rgba(0,0,0,0.08);
        }
        /* Left panel */
        .login-left {
            background: #1a6b3c;
            padding: 2.5rem;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            position: relative;
            overflow: hidden;
        }
        .login-left::before {
            content: '';
            position: absolute;
            width: 300px; height: 300px;
            border-radius: 50%;
            background: rgba(255,255,255,0.05);
            top: -80px; right: -80px;
        }
        .login-left::after {
            content: '';
            position: absolute;
            width: 200px; height: 200px;
            border-radius: 50%;
            background: rgba(255,255,255,0.04);
            bottom: -60px; left: -60px;
        }
        .brand-top { position: relative; z-index: 1; }
        .brand-icon {
            width: 48px; height: 48px;
            background: rgba(255,255,255,0.2);
            border-radius: 12px;
            display: flex; align-items: center; justify-content: center;
            font-size: 24px; margin-bottom: 1.5rem;
        }
        .brand-top h1 { color: white; font-size: 26px; font-weight: 700; line-height: 1.3; }
        .brand-top p { color: rgba(255,255,255,0.7); font-size: 14px; margin-top: 0.5rem; line-height: 1.6; }
        .features { position: relative; z-index: 1; }
        .feature-item {
            display: flex; align-items: center; gap: 10px;
            margin-bottom: 0.75rem;
        }
        .feature-dot {
            width: 8px; height: 8px; border-radius: 50%;
            background: rgba(255,255,255,0.5); flex-shrink: 0;
        }
        .feature-text { color: rgba(255,255,255,0.8); font-size: 13px; }
        /* Right panel */
        .login-right { padding: 2.5rem; }
        .login-right h2 { font-size: 22px; font-weight: 700; margin-bottom: 0.25rem; }
        .login-right p { color: #6b7280; font-size: 14px; margin-bottom: 2rem; }
        .form-label { font-weight: 600; font-size: 13px; margin-bottom: 0.4rem; color: #374151; }
        .form-control {
            border: 1px solid #e5e7eb; border-radius: 10px;
            padding: 0.65rem 1rem; font-size: 14px;
            font-family: inherit; transition: all 0.15s;
        }
        .form-control:focus {
            border-color: #1a6b3c;
            box-shadow: 0 0 0 3px rgba(26,107,60,0.1);
            outline: none;
        }
        .input-group-text {
            border: 1px solid #e5e7eb; background: #f9fafb;
            border-radius: 10px 0 0 10px; color: #6b7280;
        }
        .input-group .form-control { border-radius: 0 10px 10px 0; }
        .btn-login {
            width: 100%;
            background: #1a6b3c; color: white; border: none;
            padding: 0.75rem; border-radius: 10px;
            font-size: 15px; font-weight: 600; font-family: inherit;
            cursor: pointer; transition: background 0.15s;
            display: flex; align-items: center; justify-content: center; gap: 8px;
        }
        .btn-login:hover { background: #15593200; }
        .btn-login:hover { background: #155932; }
        .alert {
            border: none; border-radius: 10px;
            padding: 0.75rem 1rem; font-size: 13px;
            background: #fee2e2; color: #991b1b;
            display: flex; align-items: center; gap: 8px;
            margin-bottom: 1.25rem;
        }
        .demo-box {
            background: #f0f9f4; border-radius: 10px;
            padding: 0.75rem 1rem; margin-top: 1.5rem;
        }
        .demo-label { font-size: 11px; font-weight: 700; text-transform: uppercase;
            letter-spacing: 0.05em; color: #1a6b3c; margin-bottom: 0.5rem; }
        .demo-row { display: flex; justify-content: space-between; font-size: 12px; color: #374151; }
        @media (max-width: 640px) {
            .login-wrapper { grid-template-columns: 1fr; }
            .login-left { display: none; }
        }
    </style>
</head>
<body>
    <div class="login-wrapper">
        <!-- Left: Branding -->
        <div class="login-left">
            <div class="brand-top">
                <div class="brand-icon">🏪</div>
                <h1>Kelola Toko Anda Lebih Mudah</h1>
                <p>Sistem manajemen toko modern untuk mencatat produk, stok, dan transaksi penjualan.</p>
            </div>
            <div class="features">
                <div class="feature-item">
                    <div class="feature-dot"></div>
                    <span class="feature-text">CRUD Produk lengkap dengan kategori</span>
                </div>
                <div class="feature-item">
                    <div class="feature-dot"></div>
                    <span class="feature-text">Transaksi penjualan & kembalian otomatis</span>
                </div>
                <div class="feature-item">
                    <div class="feature-dot"></div>
                    <span class="feature-text">Monitoring stok menipis real-time</span>
                </div>
                <div class="feature-item">
                    <div class="feature-dot"></div>
                    <span class="feature-text">Dashboard statistik penjualan harian</span>
                </div>
            </div>
        </div>

        <!-- Right: Form -->
        <div class="login-right">
            <h2>Masuk ke Akun</h2>
            <p>Masukkan email dan password Anda</p>

            @if(session('error'))
                <div class="alert">
                    <i class="bi bi-exclamation-circle-fill"></i>
                    {{ session('error') }}
                </div>
            @endif

            <form action="{{ route('login.post') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label class="form-label">Email</label>
                    <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                        placeholder="admin@toko.com" value="{{ old('email') }}" required autofocus>
                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-4">
                    <label class="form-label">Password</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="bi bi-lock"></i></span>
                        <input type="password" name="password" id="passwordInput"
                            class="form-control @error('password') is-invalid @enderror"
                            placeholder="••••••••" required>
                    </div>
                    @error('password')
                        <div class="text-danger" style="font-size:12px;margin-top:4px">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit" class="btn-login">
                    <i class="bi bi-arrow-right-circle"></i> Masuk Sekarang
                </button>
            </form>

            <div class="demo-box">
                <div class="demo-label">Akun Demo</div>
                <div class="demo-row"><span>Email:</span><strong>admin@toko.com</strong></div>
                <div class="demo-row mt-1"><span>Password:</span><strong>password123</strong></div>
            </div>
        </div>
    </div>
</body>
</html>
