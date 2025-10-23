<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buat Akun Peduli Kasih</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link
        rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css"
    />
    <style>
        body {
            background: linear-gradient(135deg, #f5f7fa 0%, #e8eef5 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            padding: 20px;
        }

        .main-container {
            max-width: 1000px;
            width: 100%;
        }

        .card-container {
            background: white;
            border-radius: 20px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.05);
            overflow: hidden;
        }

        .left-section {
            padding: 50px 40px;
            position: relative;
        }

        .heart-icon {
            width: 50px;
            height: 50px;
            background: #DBEAFE;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 20px;
        }

        .heart-icon i {
            color: #2563EB;
            font-size: 24px;
        }

        .title {
            font-size: 28px;
            font-weight: 700;
            color: #2d3748;
            text-align: center;
            margin-bottom: 10px;
        }

        .subtitle {
            color: #718096;
            text-align: center;
            margin-bottom: 35px;
            font-size: 14px;
        }

        .form-label {
            font-size: 14px;
            font-weight: 600;
            color: #2d3748;
            margin-bottom: 8px;
        }

        .input-group {
            position: relative;
            margin-bottom: 20px;
        }

        .form-control {
            padding: 12px 15px 12px 45px;
            border: 1px solid #e2e8f0;
            border-radius: 8px;
            font-size: 14px;
            transition: all 0.3s;
        }

        .form-control:focus {
            border-color: #667eea;
            box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
        }

        .input-icon {
            position: absolute;
            left: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: #a0aec0;
            font-size: 16px;
            z-index: 2;
        }

        .password-toggle {
            position: absolute;
            right: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: #a0aec0;
            cursor: pointer;
            font-size: 16px;
        }

        .btn-register {
            width: 100%;
            padding: 14px;
            background: #2563EB;
            border: none;
            border-radius: 8px;
            color: white;
            font-weight: 600;
            font-size: 15px;
            transition: all 0.3s;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }

        .btn-register:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(102, 126, 234, 0.4);
        }

        .login-link {
            text-align: center;
            margin-top: 20px;
            font-size: 14px;
            color: #718096;
        }

        .login-link a {
            color: #2563EB;
            text-decoration: none;
            font-weight: 600;
        }

        .login-link a:hover {
            text-decoration: underline;
        }

        .right-section {
            background: linear-gradient(135deg, #EFF6FF 0%, #E0E7FF 100%);
            padding: 50px 40px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: center;
            min-height: 100%;
        }
        
        .row.g-0 {
            min-height: 100%;
        }

        .illustration {
            width: 100%;
            max-width: 350px;
            margin-bottom: 30px;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 10px 15px rgba(0, 0, 0, 0.14);
        }

        .illustration img {
            width: 100%;
            max-height: 300px;
            object-fit: cover;
            height: auto;
            
        }

        .input-icon {
            color: #2563EB;
        }

        .right-title {
            font-size: 24px;
            font-weight: 700;
            color: #2d3748;
            margin-bottom: 15px;
        }

        .right-description {
            color: #4a5568;
            font-size: 14px;
            line-height: 1.6;
            margin-bottom: 30px;
        }

        .stats {
            display: flex;
            gap: 30px;
            justify-content: center;
        }

        .stat-item {
            text-align: center;
        }

        .stat-number {
            font-size: 24px;
            font-weight: 700;
            color: #2563EB;
            margin-bottom: 5px;
        }

        .stat-label {
            font-size: 13px;
            color: #718096;
        }

        @media (max-width: 768px) {
            .left-section, .right-section {
                padding: 30px 25px;
            }

            .title {
                font-size: 24px;
            }

            .stats {
                gap: 20px;
            }
        }
    </style>
</head>
<body>
    <div class="main-container">
        <div class="card-container">
            <div class="row g-0">
                <div class="col-lg-6">
                    <div class="left-section">
                        <div class="heart-icon">
                            <i class="bi bi-heart-fill"></i>
                        </div>
                        
                        <h1 class="title">Buat Akun Peduli Kasih</h1>
                        <p class="subtitle">Selamat datang! Silakan buat akun untuk bergabung</p>

                        <form action="{{ route('register') }}" method="POST">
                            @csrf

                            <div class="mb-3">
                                <label class="form-label">Username/Email</label>
                                <div class="input-group">
                                    <i class="bi bi-person-badge input-icon"></i>
                                    <input type="text" class="form-control" name="username" placeholder="Masukkan username/email" required>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Password</label>
                                <div class="input-group">
                                    <i class="bi bi-lock input-icon"></i>
                                    <input type="password" class="form-control" name="password" id="password" placeholder="Masukkan password" required>
                                    <i class="bi bi-eye password-toggle" id="togglePassword"></i>
                                </div>
                            </div>

                            <button type="submit" class="btn-register mt-4">
                                <i class="bi bi-arrow-right"></i>
                                Login Sekarang
                            </button>

                            <div class="login-link">
                                Belum punya akun? <a href="{{ route('register') }}">Daftar di sini</a>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="right-section">
                        <div class="illustration">
                            <img src="{{ asset('images/donasiLogin.jpg') }}" alt="Illustration">
                        </div>

                        <h2 class="right-title">Bersama Membangun Kebaikan</h2>
                        <p class="right-description">
                            Bergabunglah dengan ribuan orang baik hati yang telah mempercayai platform kami untuk menyalurkan bantuan kepada mereka yang membutuhkan.
                        </p>

                        <div class="stats">
                            <div class="stat-item">
                                <div class="stat-number">10K+</div>
                                <div class="stat-label">Donatur</div>
                            </div>
                            <div class="stat-item">
                                <div class="stat-number">50K+</div>
                                <div class="stat-label">Terbantu</div>
                            </div>
                            <div class="stat-item">
                                <div class="stat-number">1M+</div>
                                <div class="stat-label">Donasi</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Toggle password visibility
        const togglePassword = document.getElementById('togglePassword');
        const password = document.getElementById('password');
        
        togglePassword.addEventListener('click', function() {
            const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
            password.setAttribute('type', type);
            this.classList.toggle('bi-eye-slash');
            this.classList.toggle('bi-eye');
        });

        const toggleConfirmPassword = document.getElementById('toggleConfirmPassword');
        const confirmPassword = document.getElementById('confirmPassword');
        
        toggleConfirmPassword.addEventListener('click', function() {
            const type = confirmPassword.getAttribute('type') === 'password' ? 'text' : 'password';
            confirmPassword.setAttribute('type', type);
            this.classList.toggle('bi-eye-slash');
            this.classList.toggle('bi-eye');
        });
    </script>
</body>
</html>