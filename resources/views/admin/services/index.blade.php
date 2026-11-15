@extends('admin.layouts.app')

@section('title', 'إدارة الخدمات')

@section('content')

    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="fw-bold mb-1">إدارة الخدمات</h2>
            <p class="text-secondary mb-0">إضافة وتعديل وحذف وتفعيل الخدمات المعروضة على الموقع</p>
        </div>
        <a href="{{ route('admin.services.create') }}" class="btn btn-primary">
            + إضافة خدمة جديدة
        </a>
    </div>

    {{-- Success Message --}}
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    {{-- Services Table --}}
    <div class="card bg-dark border-secondary">
        <div class="table-responsive">
            <table class="table table-dark table-hover mb-0">
                <thead class="border-bottom border-secondary">
                    <tr>
                        <th style="width: 50px;">#</th>
                        <th>الخدمة</th>
                        <th>السعر</th>
                        <th>نوع التسعير</th>
                        <th style="width: 120px;">الحالة</th>
                        <th style="width: 220px;">الإجراءات</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($services as $service)
                        <tr class="{{ !$service->is_active ? 'opacity-50' : '' }}">
                            <td>{{ $service->id }}</td>
                            <td>
                                <div class="d-flex align-items-center gap-2">
                                    @if ($service->icon)
                                        <span style="font-size: 1.2rem;">{{ $service->icon }}</span>
                                    @endif
                                    <div>
                                        <div class="fw-semibold">{{ $service->name }}</div>
                                        <div class="text-secondary small">{{ Str::limit($service->description, 60) }}</div>
                                    </div>
                                </div>
                            </td>
                            <td>
                                @if ($service->price)
                                    <span class="fw-semibold">{{ number_format($service->price, 2) }}</span>
                                    <span class="text-secondary small">ج.م</span>
                                @else
                                    <span class="text-secondary">-</span>
                                @endif
                            </td>
                            <td>
                                @switch($service->pricing_type)
                                    @case('per_page') للصفحة @break
                                    @case('per_hour') للساعة @break
                                    @case('per_min') للدقيقة @break
                                    @case('fixed') سعر ثابت @break
                                @endswitch
                            </td>
                            <td>
                                <form action="{{ route('admin.services.toggle-status', $service) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" class="btn btn-sm {{ $service->is_active ? 'btn-success' : 'btn-outline-secondary' }}"
                                        title="{{ $service->is_active ? 'انقر للتعطيل' : 'انقر للتفعيل' }}">
                                        @if ($service->is_active)
                                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor" viewBox="0 0 16 16">
                                                <path d="M13.854 3.646a.5.5 0 0 1 0 .708l-7 7a.5.5 0 0 1-.708 0l-3.5-3.5a.5.5 0 1 1 .708-.708L6.5 10.293l6.646-6.647a.5.5 0 0 1 .708 0"/>
                                            </svg>
                                            مفعّلة
                                        @else
                                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor" viewBox="0 0 16 16">
                                                <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708"/>
                                            </svg>
                                            معطّلة
                                        @endif
                                    </button>
                                </form>
                            </td>
                            <td>
                                <div class="d-flex gap-1">
                                    <a href="{{ route('admin.services.edit', $service) }}" class="btn btn-sm btn-outline-warning">
                                        تعديل
                                    </a>
                                    <form action="{{ route('admin.services.destroy', $service) }}" method="POST"
                                        onsubmit="return confirm('هل أنت متأكد من حذف خدمة «{{ $service->name }}»؟\nهذا الإجراء لا يمكن التراجع عنه.')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger">
                                            حذف
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center py-5 text-secondary">
                                <div class="mb-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" fill="currentColor" viewBox="0 0 16 16">
                                        <path d="M7.752.066a.5.5 0 0 1 .496 0l3.75 2.143a.5.5 0 0 1 .252.434v3.995l3.498 2A.5.5 0 0 1 16 9.07v4.286a.5.5 0 0 1-.252.434l-3.75 2.143a.5.5 0 0 1-.496 0l-3.502-2-3.502 2.001a.5.5 0 0 1-.496 0l-3.75-2.143A.5.5 0 0 1 0 13.357V9.071a.5.5 0 0 1 .252-.434L3.75 6.638V2.643a.5.5 0 0 1 .252-.434z"/>
                                    </svg>
                                </div>
                                <p class="mb-1">لا توجد خدمات بعد</p>
                                <a href="{{ route('admin.services.create') }}" class="btn btn-sm btn-primary mt-2">
                                    أضف خدمتك الأولى
                                </a>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

@endsection
