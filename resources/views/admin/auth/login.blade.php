<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>تسجيل الدخول | لوحة الإدارة</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 24px 16px;
            background:
                radial-gradient(circle at top right, rgba(13, 110, 253, 0.13), transparent 35%),
                radial-gradient(circle at bottom left, rgba(13, 110, 253, 0.08), transparent 35%),
                #0b1120;
        }

        .login-wrapper {
            max-width: 440px;
            width: 100%;
        }

        .login-logo {
            width: 76px;
            height: 76px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 20px;
            border-radius: 22px;
            background: rgba(13, 110, 253, 0.12);
            border: 1px solid rgba(13, 110, 253, 0.25);
            box-shadow: 0 8px 30px rgba(13, 110, 253, 0.08);
        }

        .login-card {
            background: #111827 !important;
            border: 1px solid #293548 !important;
            border-radius: 18px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
        }

        .login-card .form-control {
            min-height: 48px;
            background-color: #0b1120 !important;
            color: #f8fafc !important;
            border: 1px solid #354258 !important;
            border-radius: 10px;
            transition: all 0.2s ease;
        }

        .login-card .form-control::placeholder {
            color: #8491a5;
            opacity: 1;
        }

        .login-card .form-control:focus {
            border-color: #0d6efd !important;
            box-shadow: 0 0 0 3px rgba(13, 110, 253, 0.15);
        }

        .login-card .form-label {
            color: #e2e8f0;
            font-weight: 600;
            margin-bottom: 9px;
        }

        .login-card .form-check-label {
            color: #cbd5e1;
        }

        .login-btn {
            min-height: 48px;
            border-radius: 10px;
            font-weight: 600;
            transition: all 0.2s ease;
        }

        .login-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 7px 20px rgba(13, 110, 253, 0.2);
        }

        .back-link {
            color: #94a3b8;
            transition: color 0.2s ease;
        }

        .back-link:hover {
            color: #ffffff;
        }
    </style>
</head>

<body class="bg-dark text-light">

    <div class="login-wrapper">

        {{-- Header --}}
        <div class="text-center mb-4">

            <div class="login-logo">
                <svg xmlns="http://www.w3.org/2000/svg"
                    width="38" height="38"
                    fill="#3b82f6"
                    viewBox="0 0 16 16">
                    <path d="M8 1a2 2 0 0 1 2 2v4H6V3a2 2 0 0 1 2-2m3 6V3a3 3 0 0 0-6 0v4a2 2 0 0 0-2 2v5a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V9a2 2 0 0 0-2-2M5 9h6a1 1 0 0 1 1 1v5a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1v-5a1 1 0 0 1 1-1" />
                </svg>
            </div>

            <h3 class="fw-bold text-white mb-2">مرحباً بعودتك</h3>

            <p class="text-secondary mb-0">
                سجّل الدخول للوصول إلى لوحة إدارة حكاية
            </p>

        </div>

        {{-- Login Form --}}
        <div class="card login-card">
            <div class="card-body p-4 p-md-5">

                <div class="mb-4">
                    <h5 class="text-white fw-bold mb-1">تسجيل الدخول</h5>
                    <p class="text-secondary small mb-0">
                        أدخل بيانات حساب الإدارة للمتابعة
                    </p>
                </div>

                @if ($errors->any())
                <div class="alert alert-danger py-3">
                    @foreach ($errors->all() as $error)
                    <div>{{ $error }}</div>
                    @endforeach
                </div>
                @endif

                <form action="{{ route('admin.login.submit') }}" method="POST">
                    @csrf

                    <div class="mb-3">
                        <label for="email" class="form-label">
                            البريد الإلكتروني
                        </label>

                        <input
                            type="email"
                            class="form-control @error('email') is-invalid @enderror"
                            id="email"
                            name="email"
                            value="{{ old('email') }}"
                            placeholder="admin@example.com"
                            autofocus
                            required>
                    </div>

                    <div class="mb-4">
                        <label for="password" class="form-label">
                            كلمة المرور
                        </label>

                        <input
                            type="password"
                            class="form-control @error('password') is-invalid @enderror"
                            id="password"
                            name="password"
                            placeholder="••••••••"
                            required>
                    </div>

                    <div class="mb-4">
                        <div class="form-check">
                            <input
                                class="form-check-input"
                                type="checkbox"
                                id="remember"
                                name="remember"
                                {{ old('remember') ? 'checked' : '' }}>

                            <label class="form-check-label" for="remember">
                                تذكرني
                            </label>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary w-100 login-btn">
                        تسجيل الدخول
                    </button>

                </form>

            </div>
        </div>

        {{-- Back to Website --}}
        <div class="text-center mt-4">
            <a href="{{ route('home') }}"
                class="back-link text-decoration-none small">
                ← العودة إلى الموقع
            </a>
        </div>

        <p class="text-center text-secondary small mt-4 mb-0">
            © {{ date('Y') }} حكاية — جميع الحقوق محفوظة
        </p>

    </div>

</body>

</html>