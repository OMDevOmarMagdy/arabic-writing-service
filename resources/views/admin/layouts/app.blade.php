<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">

    <title>@yield('title', 'لوحة الإدارة')</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        :root {
            --sidebar-width: 260px;
        }

        body {
            min-height: 100vh;
        }

        .admin-sidebar {
            width: var(--sidebar-width);
            min-height: 100vh;
            position: fixed;
            top: 0;
            right: 0;
            z-index: 1030;
            transition: transform 0.3s ease;
        }

        .admin-content {
            margin-right: var(--sidebar-width);
            min-height: 100vh;
        }

        .sidebar-link {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            padding: 0.75rem 1.25rem;
            color: #adb5bd;
            text-decoration: none;
            border-radius: 0.375rem;
            transition: all 0.2s;
        }

        .sidebar-link:hover,
        .sidebar-link.active {
            color: #fff;
            background-color: rgba(255, 255, 255, 0.1);
        }

        .sidebar-link.active {
            background-color: rgba(13, 110, 253, 0.3);
            border-right: 3px solid #0d6efd;
        }

        .sidebar-link svg {
            width: 20px;
            height: 20px;
            flex-shrink: 0;
        }

        .stat-card {
            border: 1px solid #2d3748;
            border-radius: 0.75rem;
            transition: transform 0.2s;
        }

        .stat-card:hover {
            transform: translateY(-2px);
        }

        @media (max-width: 991.98px) {
            .admin-sidebar {
                transform: translateX(100%);
            }

            .admin-sidebar.show {
                transform: translateX(0);
            }

            .admin-content {
                margin-right: 0;
            }
        }



        /* =================================
   Admin Dashboard - Readability
================================= */

        /* Headings */
        .admin-content h1,
        .admin-content h2,
        .admin-content h3,
        .admin-content h4,
        .admin-content h5,
        .admin-content h6 {
            color: #f8fafc !important;
        }

        /* General Text */
        .admin-content p,
        .admin-content label,
        .admin-content li {
            color: #e2e8f0;
        }

        /* Secondary Text */
        .admin-content .text-secondary {
            color: #aebbc9 !important;
        }

        /* Form Labels */
        .admin-content .form-label,
        .admin-content .form-check-label {
            color: #f1f5f9 !important;
        }

        /* Inputs */
        .admin-content .form-control,
        .admin-content .form-select {
            background-color: #171e2b !important;
            color: #f8fafc !important;
            border-color: #465266 !important;
        }

        /* Placeholder */
        .admin-content .form-control::placeholder {
            color: #a0aec0 !important;
            opacity: 1;
        }

        /* Focus */
        .admin-content .form-control:focus,
        .admin-content .form-select:focus {
            border-color: #0d6efd !important;
            box-shadow: 0 0 0 0.2rem rgba(13, 110, 253, 0.2);
        }

        /* Cards */
        .admin-content .card {
            color: #f8fafc;
        }

        .admin-content .card-header {
            color: #f8fafc;
        }

        /* Form Help Text */
        .admin-content .form-text {
            color: #aebbc9 !important;
        }

        /* Table */
        .admin-content .table {
            color: #e2e8f0;
        }

        /* Links */
        .admin-content a:not(.btn) {
            color: #8bb9ff;
        }
    </style>

    @stack('styles')
</head>

<body class="bg-dark text-light">

    {{-- Sidebar --}}
    <aside class="admin-sidebar bg-dark border-start border-secondary d-flex flex-column" id="adminSidebar">

        {{-- Brand --}}
        <div class="p-3 border-bottom border-secondary">
            <a href="{{ route('admin.dashboard') }}" class="text-decoration-none text-light d-flex align-items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" fill="currentColor" viewBox="0 0 16 16">
                    <path d="M8 4a.5.5 0 0 1 .5.5V6a.5.5 0 0 1-1 0V4.5A.5.5 0 0 1 8 4M3.732 5.732a.5.5 0 0 1 .707 0l.915.914a.5.5 0 1 1-.708.708l-.914-.915a.5.5 0 0 1 0-.707M2 10a.5.5 0 0 1 .5-.5h1.586a.5.5 0 0 1 0 1H2.5A.5.5 0 0 1 2 10m9.5 0a.5.5 0 0 1 .5-.5h1.5a.5.5 0 0 1 0 1H12a.5.5 0 0 1-.5-.5m.754-4.246a.5.5 0 0 0-.708 0l-.914.914a.5.5 0 0 0 .708.708l.914-.914a.5.5 0 0 0 0-.708M0 12a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v1a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2zM4.5 13.5a.5.5 0 1 0-1 0 .5.5 0 0 0 1 0m3 0a.5.5 0 1 0-1 0 .5.5 0 0 0 1 0m3 0a.5.5 0 1 0-1 0 .5.5 0 0 0 1 0m3 0a.5.5 0 1 0-1 0 .5.5 0 0 0 1 0" />
                </svg>
                <span class="fw-bold fs-5">لوحة الإدارة</span>
            </a>
        </div>

        {{-- Navigation --}}
        <nav class="flex-grow-1 p-3">
            <ul class="list-unstyled mb-0 d-flex flex-column gap-1">

                <li>
                    <a href="{{ route('admin.dashboard') }}"
                        class="sidebar-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 16 16">
                            <path d="M6 .5a.5.5 0 0 0-1 0V3H1.5a.5.5 0 0 0 0 1H5v2.5a.5.5 0 0 0 1 0V4h3.5a.5.5 0 0 0 0-1H6zM11 .5a.5.5 0 0 0-1 0V3H6.5a.5.5 0 0 0 0 1H10v5.5a.5.5 0 0 0 1 0V4h3.5a.5.5 0 0 0 0-1H11z" />
                            <path d="M0 2a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2zm15 0a1 1 0 0 0-1-1H2a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1z" />
                        </svg>
                        <span>الرئيسية</span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('admin.services.index') }}"
                        class="sidebar-link {{ request()->routeIs('admin.services.*') ? 'active' : '' }}">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 16 16">
                            <path d="M7.752.066a.5.5 0 0 1 .496 0l3.75 2.143a.5.5 0 0 1 .252.434v3.995l3.498 2A.5.5 0 0 1 16 9.07v4.286a.5.5 0 0 1-.252.434l-3.75 2.143a.5.5 0 0 1-.496 0l-3.502-2-3.502 2.001a.5.5 0 0 1-.496 0l-3.75-2.143A.5.5 0 0 1 0 13.357V9.071a.5.5 0 0 1 .252-.434L3.75 6.638V2.643a.5.5 0 0 1 .252-.434zM4.25 7.504 1 9.071v4.286l3.75 2.143L8.502 13.5zm3.75 5.996.502.287 3.75-2.143V7.504L8.748 5.504zM8 5.428 4.75 3.286v3.996l3.25 1.858 3.25-1.858V3.286z" />
                        </svg>
                        <span>إدارة الخدمات</span>
                    </a>
                </li>

                <li>
                    <a href="#" class="sidebar-link disabled" style="opacity: 0.4; pointer-events: none;">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 16 16">
                            <path d="M11 5.5a.5.5 0 0 1 .5-.5h2a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1-.5-.5zM0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2zm1 0v8a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V4a1 1 0 0 0-1-1H2a1 1 0 0 0-1 1" />
                        </svg>
                        <span>إدارة الطلبات</span>
                        <span class="badge bg-secondary ms-auto" style="font-size: 0.65rem;">قريباً</span>
                    </a>
                </li>

                <li>
                    <a href="#" class="sidebar-link disabled" style="opacity: 0.4; pointer-events: none;">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 16 16">
                            <path d="M8 4.754a3.246 3.246 0 1 0 0 6.492 3.246 3.246 0 0 0 0-6.492M5.754 8a2.246 2.246 0 1 1 4.492 0 2.246 2.246 0 0 1-4.492 0" />
                            <path d="M9.796 1.343c-.527-1.79-3.065-1.79-3.592 0l-.094.319a.873.873 0 0 1-1.255.52l-.292-.16c-1.64-.892-3.433.902-2.54 2.541l.159.292a.873.873 0 0 1-.52 1.255l-.319.094c-1.79.527-1.79 3.065 0 3.592l.319.094a.873.873 0 0 1 .52 1.255l-.16.292c-.892 1.64.901 3.434 2.541 2.54l.292-.159a.873.873 0 0 1 1.255.52l.094.319c.527 1.79 3.065 1.79 3.592 0l.094-.319a.873.873 0 0 1 1.255-.52l.292.16c1.64.893 3.434-.902 2.54-2.541l-.159-.292a.873.873 0 0 1 .52-1.255l.319-.094c1.79-.527 1.79-3.065 0-3.592l-.319-.094a.873.873 0 0 1-.52-1.255l.16-.292c.893-1.64-.902-3.433-2.541-2.54l-.292.159a.873.873 0 0 1-1.255-.52zm-2.633.283c.246-.835 1.428-.835 1.674 0l.094.319a1.873 1.873 0 0 0 2.693 1.115l.291-.16c.764-.415 1.6.42 1.184 1.185l-.159.292a1.873 1.873 0 0 0 1.116 2.692l.318.094c.835.246.835 1.428 0 1.674l-.319.094a1.873 1.873 0 0 0-1.115 2.693l.16.291c.415.764-.42 1.6-1.185 1.184l-.291-.159a1.873 1.873 0 0 0-2.693 1.116l-.094.318c-.246.835-1.428.835-1.674 0l-.094-.319a1.873 1.873 0 0 0-2.692-1.115l-.292.16c-.764.415-1.6-.42-1.184-1.185l.159-.291A1.873 1.873 0 0 0 1.945 8.93l-.319-.094c-.835-.246-.835-1.428 0-1.674l.319-.094A1.873 1.873 0 0 0 3.06 4.377l-.16-.292c-.415-.764.42-1.6 1.185-1.184l.292.159a1.873 1.873 0 0 0 2.692-1.115z" />
                        </svg>
                        <span>الإعدادات</span>
                        <span class="badge bg-secondary ms-auto" style="font-size: 0.65rem;">قريباً</span>
                    </a>
                </li>

            </ul>
        </nav>

        {{-- User Info & Logout --}}
        <div class="p-3 border-top border-secondary">
            <div class="d-flex align-items-center gap-2 mb-3">
                <div class="rounded-circle bg-primary d-flex align-items-center justify-content-center"
                    style="width: 36px; height: 36px; font-size: 0.85rem;">
                    {{ mb_substr(Auth::user()->name, 0, 1) }}
                </div>
                <div>
                    <div class="small fw-semibold">{{ Auth::user()->name }}</div>
                    <div class="small text-secondary" style="font-size: 0.75rem;">{{ Auth::user()->email }}</div>
                </div>
            </div>

            <form action="{{ route('admin.logout') }}" method="POST">
                @csrf
                <button type="submit" class="sidebar-link w-100 border-0 bg-transparent text-danger">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M10 12.5a.5.5 0 0 1-.5.5h-8a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5h8a.5.5 0 0 1 .5.5v2a.5.5 0 0 0 1 0v-2A1.5 1.5 0 0 0 9.5 2h-8A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h8a1.5 1.5 0 0 0 1.5-1.5v-2a.5.5 0 0 0-1 0z" />
                        <path fill-rule="evenodd" d="M15.854 8.354a.5.5 0 0 0 0-.708l-3-3a.5.5 0 0 0-.708.708L14.293 7.5H5.5a.5.5 0 0 0 0 1h8.793l-2.147 2.146a.5.5 0 0 0 .708.708z" />
                    </svg>
                    <span>تسجيل الخروج</span>
                </button>
            </form>
        </div>

    </aside>

    {{-- Mobile Navbar --}}
    <nav class="navbar navbar-dark bg-dark border-bottom border-secondary d-lg-none sticky-top">
        <div class="container-fluid">
            <a class="navbar-brand" href="{{ route('admin.dashboard') }}">لوحة الإدارة</a>
            <button class="navbar-toggler" type="button" onclick="document.getElementById('adminSidebar').classList.toggle('show')">
                <span class="navbar-toggler-icon"></span>
            </button>
        </div>
    </nav>

    {{-- Main Content --}}
    <div class="admin-content">
        <div class="p-4">
            @yield('content')
        </div>
    </div>

    @stack('scripts')
</body>

</html>