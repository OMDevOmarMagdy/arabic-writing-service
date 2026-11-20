<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('title', 'حكاية | خدمات الكتابة')</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    {{-- Bootstrap Icons --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>

    <div class="site-wrapper">

        {{-- Navbar --}}
        <nav class="main-navbar navbar navbar-expand-lg">
            <div class="container navbar-container d-flex align-items-center flex-wrap">

                <a href="{{ route('home') }}" class="brand">
                    <span class="brand-icon">✦</span>
                    <span>حكاية</span>
                </a>

                <button class="navbar-toggler custom-toggler"
                    type="button"
                    data-bs-toggle="collapse"
                    data-bs-target="#mainNavbar"
                    aria-controls="mainNavbar"
                    aria-expanded="false"
                    aria-label="Toggle navigation">

                    <i class="bi bi-list text-light fs-3"></i>

                </button>

                <div class="collapse navbar-collapse" id="mainNavbar">

                    <ul class="navbar-nav nav-links mx-auto">

                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('home') }}">
                                الرئيسية
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('home') }}#services">
                                خدماتنا
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('home') }}#about">
                                عن حكاية
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('home') }}#contact">
                                تواصل معنا
                            </a>
                        </li>

                    </ul>

                    <a href="{{ route('home') }}#services" class="navbar-cta">
                        اطلب خدمتك
                        <span>✦</span>
                    </a>

                </div>

            </div>
        </nav>


        {{-- Main Content --}}
        <main>
            @yield('content')
        </main>


        {{-- Footer --}}
        <footer class="main-footer">

            <div class="container">

                <div class="footer-content">

                    <div class="footer-brand">
                        <a href="{{ route('home') }}" class="brand">
                            <span class="brand-icon">✦</span>
                            <span>حكاية</span>
                        </a>

                        <p>
                            لكل فكرة حكاية تستحق أن تُكتب.
                        </p>
                    </div>

                    <div class="footer-links">
                        <a href="{{ route('home') }}">الرئيسية</a>
                        <a href="{{ route('home') }}#services">خدماتنا</a>
                        <a href="{{ route('home') }}#about">عنّا</a>
                        <a href="{{ route('home') }}#contact">تواصل معنا</a>
                    </div>

                </div>

                <div class="footer-bottom">
                    <span>
                        جميع الحقوق محفوظة © {{ date('Y') }} حكاية
                    </span>

                    <span class="footer-star">مصنوعة بكل اهتمام ✦</span>
                </div>

            </div>

        </footer>

    </div>

</body>

</html>