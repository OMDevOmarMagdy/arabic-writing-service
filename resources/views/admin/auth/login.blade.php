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
        }

        .login-card {
            max-width: 420px;
            width: 100%;
        }
    </style>
</head>

<body class="bg-dark text-light">

    <div class="login-card">

        {{-- Header --}}
        <div class="text-center mb-4">
            <div class="mb-3">
                <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" fill="#0d6efd" viewBox="0 0 16 16">
                    <path d="M8 1a2 2 0 0 1 2 2v4H6V3a2 2 0 0 1 2-2m3 6V3a3 3 0 0 0-6 0v4a2 2 0 0 0-2 2v5a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V9a2 2 0 0 0-2-2M5 9h6a1 1 0 0 1 1 1v5a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1v-5a1 1 0 0 1 1-1"/>
                </svg>
            </div>
            <h3 class="fw-bold">لوحة الإدارة</h3>
            <p class="text-secondary">قم بتسجيل الدخول للمتابعة</p>
        </div>

        {{-- Login Form --}}
        <div class="card bg-dark border-secondary">
            <div class="card-body p-4">

                @if ($errors->any())
                    <div class="alert alert-danger py-2">
                        @foreach ($errors->all() as $error)
                            <div>{{ $error }}</div>
                        @endforeach
                    </div>
                @endif

                <form action="{{ route('admin.login.submit') }}" method="POST">
                    @csrf

                    <div class="mb-3">
                        <label for="email" class="form-label">البريد الإلكتروني</label>
                        <input type="email"
                            class="form-control bg-dark text-light border-secondary @error('email') is-invalid @enderror"
                            id="email" name="email" value="{{ old('email') }}"
                            placeholder="admin@example.com"
                            autofocus required>
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label">كلمة المرور</label>
                        <input type="password"
                            class="form-control bg-dark text-light border-secondary @error('password') is-invalid @enderror"
                            id="password" name="password"
                            placeholder="••••••••"
                            required>
                    </div>

                    <div class="mb-4">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox"
                                id="remember" name="remember"
                                {{ old('remember') ? 'checked' : '' }}>
                            <label class="form-check-label" for="remember">
                                تذكرني
                            </label>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary w-100 py-2">
                        تسجيل الدخول
                    </button>

                </form>

            </div>
        </div>

        {{-- Back to Website --}}
        <div class="text-center mt-3">
            <a href="{{ route('home') }}" class="text-secondary text-decoration-none small">
                ← العودة إلى الموقع
            </a>
        </div>

    </div>

</body>

</html>
