@extends('admin.layouts.app')

@section('title', 'لوحة الإدارة')

@section('content')

    <div class="mb-4">
        <h2 class="fw-bold mb-1">مرحباً، {{ Auth::user()->name }}</h2>
        <p class="text-secondary mb-0">نظرة عامة على حالة الموقع</p>
    </div>

    {{-- Stats Cards --}}
    <div class="row g-4 mb-5">

        <div class="col-sm-6 col-xl-3">
            <div class="stat-card bg-dark p-4">
                <div class="d-flex align-items-center gap-3">
                    <div class="rounded-3 bg-primary bg-opacity-25 p-3">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="#0d6efd" viewBox="0 0 16 16">
                            <path d="M7.752.066a.5.5 0 0 1 .496 0l3.75 2.143a.5.5 0 0 1 .252.434v3.995l3.498 2A.5.5 0 0 1 16 9.07v4.286a.5.5 0 0 1-.252.434l-3.75 2.143a.5.5 0 0 1-.496 0l-3.502-2-3.502 2.001a.5.5 0 0 1-.496 0l-3.75-2.143A.5.5 0 0 1 0 13.357V9.071a.5.5 0 0 1 .252-.434L3.75 6.638V2.643a.5.5 0 0 1 .252-.434z"/>
                        </svg>
                    </div>
                    <div>
                        <div class="text-secondary small">إجمالي الخدمات</div>
                        <div class="fs-3 fw-bold">{{ $stats['total_services'] }}</div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-sm-6 col-xl-3">
            <div class="stat-card bg-dark p-4">
                <div class="d-flex align-items-center gap-3">
                    <div class="rounded-3 bg-success bg-opacity-25 p-3">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="#198754" viewBox="0 0 16 16">
                            <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0m-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
                        </svg>
                    </div>
                    <div>
                        <div class="text-secondary small">خدمات مفعّلة</div>
                        <div class="fs-3 fw-bold text-success">{{ $stats['active_services'] }}</div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-sm-6 col-xl-3">
            <div class="stat-card bg-dark p-4">
                <div class="d-flex align-items-center gap-3">
                    <div class="rounded-3 bg-warning bg-opacity-25 p-3">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="#ffc107" viewBox="0 0 16 16">
                            <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16"/>
                            <path d="M4.285 9.567a.5.5 0 0 1 .683.183A3.5 3.5 0 0 0 8 11.5a3.5 3.5 0 0 0 3.032-1.75.5.5 0 1 1 .866.5A4.5 4.5 0 0 1 8 12.5a4.5 4.5 0 0 1-3.898-2.25.5.5 0 0 1 .183-.683M7 6.5C7 7.328 6.552 8 6 8s-1-.672-1-1.5S5.448 5 6 5s1 .672 1 1.5m4 0c0 .828-.448 1.5-1 1.5s-1-.672-1-1.5S9.448 5 10 5s1 .672 1 1.5"/>
                        </svg>
                    </div>
                    <div>
                        <div class="text-secondary small">خدمات معطّلة</div>
                        <div class="fs-3 fw-bold text-warning">{{ $stats['inactive_services'] }}</div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-sm-6 col-xl-3">
            <div class="stat-card bg-dark p-4">
                <div class="d-flex align-items-center gap-3">
                    <div class="rounded-3 bg-info bg-opacity-25 p-3">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="#0dcaf0" viewBox="0 0 16 16">
                            <path d="M11 5.5a.5.5 0 0 1 .5-.5h2a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1-.5-.5zM0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2zm1 0v8a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V4a1 1 0 0 0-1-1H2a1 1 0 0 0-1 1"/>
                        </svg>
                    </div>
                    <div>
                        <div class="text-secondary small">إجمالي الطلبات</div>
                        <div class="fs-3 fw-bold text-info">{{ $stats['total_orders'] }}</div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    {{-- Quick Actions --}}
    <div class="row g-4">
        <div class="col-md-6">
            <div class="card bg-dark border-secondary">
                <div class="card-body">
                    <h5 class="card-title mb-3">إجراءات سريعة</h5>
                    <div class="d-flex flex-wrap gap-2">
                        <a href="{{ route('admin.services.create') }}" class="btn btn-primary">
                            + إضافة خدمة جديدة
                        </a>
                        <a href="{{ route('admin.services.index') }}" class="btn btn-outline-light">
                            عرض جميع الخدمات
                        </a>
                        <a href="{{ route('home') }}" class="btn btn-outline-secondary" target="_blank">
                            زيارة الموقع ←
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
