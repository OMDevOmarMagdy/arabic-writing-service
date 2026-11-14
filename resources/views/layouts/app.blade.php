<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('title', 'خدمات الكتابة والتنسيق')</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>

    {{-- Navbar --}}
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark border-bottom border-secondary">
        <div class="container">

            <a class="navbar-brand fw-bold" href="/">
                خدمات الكتابة
            </a>

            <button class="navbar-toggler" type="button"
                data-bs-toggle="collapse"
                data-bs-target="#mainNavbar">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="mainNavbar">

                <ul class="navbar-nav me-auto mb-2 mb-lg-0">

                    <li class="nav-item">
                        <a class="nav-link" href="/">الرئيسية</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="#services">خدماتنا</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('services.index') }}">إدارة الخدمات</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="#contact">تواصل معنا</a>
                    </li>

                </ul>

                <a href="#services" class="btn btn-outline-light">
                    اطلب خدمة
                </a>

            </div>
        </div>
    </nav>

    {{-- Main Content --}}
    <main>
        @yield('content')
    </main>

    {{-- Footer --}}
    <footer class="bg-dark border-top border-secondary py-4 mt-5">
        <div class="container text-center text-secondary">
            <p class="mb-0">
                جميع الحقوق محفوظة © {{ date('Y') }}
            </p>
        </div>
    </footer>

</body>
</html>