<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin - LAkost</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/admin-login.css') }}">
    <style>

        .login-card {
            max-width: 480px !important; 
            padding: 30px 40px !important; 
        }
        .login-title {
            font-size: 24px !important;
            margin-bottom: 5px !important;
        }
        .login-subtitle {
            margin-bottom: 25px !important;
            font-size: 14px;
        }
        .form-group {
            margin-bottom: 15px !important; 
        }
        .btn-login {
            margin-top: 10px !important;
        }
    </style>
</head>
<body class="login-body">

    <div class="login-bg">
        <div class="bg-orb orb-1"></div>
        <div class="bg-orb orb-2"></div>
        <div class="bg-orb orb-3"></div>
        <div class="bg-grid"></div>
    </div>

    <div class="login-wrapper">
        <div class="login-card">

            @if(session('success_logout'))
            <div class="alert-success" style="color:#276749; background:#f0fff4; padding:10px; border-radius:10px; margin-bottom:15px; font-size:12px; border: 1px solid #9ae6b4; display: flex; align-items: center; gap: 8px;">
                <i class="fas fa-check-circle"></i> 
                <span>{{ session('success_logout') }}</span>
            </div>
            @endif

            <h1 class="login-title">Login Admin</h1>
            <p class="login-subtitle">Masuk untuk mengelola data website LAkost</p>

            @if(session('error') || $errors->any())
            <div class="alert-error" style="margin-bottom: 15px; padding: 10px; font-size: 12px;">
                <i class="fas fa-exclamation-circle"></i>
                <span>{{ session('error') ?? 'Email atau password salah.' }}</span>
            </div>
            @endif

            <form action="{{ route('admin.login.post') }}" method="POST" class="login-form">
                @csrf

                <div class="form-group">
                    <label for="email" style="font-size: 13px;">Email</label>
                    <div class="input-wrap">
                        <i class="fas fa-envelope input-icon"></i>
                        <input type="email" id="email" name="email"
                            class="form-control {{ $errors->has('email') ? 'error' : '' }}"
                            value="{{ old('email') }}"
                            placeholder="masukkan email" required>
                    </div>
                </div>

                <div class="form-group">
                    <label for="password" style="font-size: 13px;">Password</label>
                    <div class="input-wrap">
                        <i class="fas fa-lock input-icon"></i>
                        <input type="password" id="password" name="password"
                            class="form-control"
                            placeholder="••••••••" required>
                        <button type="button" class="toggle-pw" id="togglePw" tabindex="-1">
                            <i class="fas fa-eye" id="eyeIcon"></i>
                        </button>
                    </div>
                </div>

                {{-- Bagian Remember Me sudah dihapus --}}

                <button type="submit" class="btn-login" style="padding: 12px;">
                    <span>Masuk</span>
                    <i class="fas fa-arrow-right"></i>
                </button>
            </form>

            <div class="login-footer" style="margin-top: 20px;">
                <a href="{{ route('home') }}" style="font-size: 13px;"><i class="fas fa-chevron-left"></i> Kembali ke Beranda</a>
            </div>
        </div>
    </div>

    <script>
        const togglePw = document.getElementById('togglePw');
        const pwInput = document.getElementById('password');
        const eyeIcon = document.getElementById('eyeIcon');
        if (togglePw) {
            togglePw.addEventListener('click', () => {
                const isText = pwInput.type === 'text';
                pwInput.type = isText ? 'password' : 'text';
                eyeIcon.className = isText ? 'fas fa-eye' : 'fas fa-eye-slash';
            });
        }
    </script>
</body>
</html>