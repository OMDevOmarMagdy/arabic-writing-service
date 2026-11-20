@extends('admin.layouts.app')

@section('title', 'إدارة الخدمات')

@section('content')

{{-- Page Header --}}
<div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-4">

    <div>
        <h2 class="fw-bold mb-2">إدارة الخدمات</h2>
        <p class="text-secondary mb-0">
            تحكم في الخدمات والأسعار المعروضة على موقع حكاية
        </p>
    </div>

    <a href="{{ route('admin.services.create') }}" class="btn btn-primary px-4 py-2">
        <span class="me-1">+</span>
        إضافة خدمة جديدة
    </a>

</div>


{{-- Success Message --}}
@if (session('success'))
<div class="alert alert-success alert-dismissible fade show border-0 mb-4" role="alert">
    {{ session('success') }}

    <button type="button" class="btn-close" data-bs-dismiss="alert"
        aria-label="Close"></button>
</div>
@endif


{{-- Services Section --}}
<div class="card bg-dark border-secondary rounded-4 overflow-hidden">

    {{-- Card Header --}}
    <div class="card-header bg-transparent border-secondary p-3 p-md-4">

        <div class="d-flex flex-wrap justify-content-between align-items-center gap-2">

            <div>
                <h5 class="fw-bold mb-1">جميع الخدمات</h5>
                <small class="text-secondary">
                    الخدمات المسجلة في لوحة الإدارة
                </small>
            </div>

            <span class="badge bg-primary bg-opacity-25 text-info px-3 py-2">
                {{ $services->count() }} خدمة
            </span>

        </div>

    </div>


    {{-- Services Table --}}
    <div class="table-responsive">

        <table class="table table-dark table-hover align-middle mb-0">

            <thead>
                <tr class="text-secondary small">
                    <th class="px-3 py-3">#</th>
                    <th class="py-3">الخدمة</th>
                    <th class="py-3">السعر</th>
                    <th class="py-3">نوع التسعير</th>
                    <th class="py-3">الحالة</th>
                    <th class="py-3 text-center">الإجراءات</th>
                </tr>
            </thead>

            <tbody>

                @forelse ($services as $service)

                <tr class="{{ !$service->is_active ? 'opacity-50' : '' }}">

                    {{-- ID --}}
                    <td class="px-3 text-secondary">
                        {{ $service->id }}
                    </td>


                    {{-- Service Information --}}
                    <td>
                        <div class="d-flex align-items-center gap-3 py-2">

                            <div class="rounded-3 bg-primary bg-opacity-25 text-info d-flex align-items-center justify-content-center"
                                style="width: 42px; height: 42px; flex-shrink: 0;">

                                <i class="{{ $service->icon ?: 'bi bi-stars' }} fs-5"></i>

                            </div>

                            <div>
                                <div class="fw-semibold mb-1">
                                    {{ $service->name }}
                                </div>

                                <div class="text-secondary small">
                                    {{ Str::limit($service->description, 55) }}
                                </div>
                            </div>

                        </div>
                    </td>


                    {{-- Price --}}
                    <td>

                        @if ($service->price)
                        <div class="fw-semibold">
                            {{ number_format($service->price, 2) }}
                            <small class="text-secondary">ج.م</small>
                        </div>
                        @else
                        <span class="text-secondary">غير محدد</span>
                        @endif

                    </td>


                    {{-- Pricing Type --}}
                    <td>
                        <span class="text-secondary small">

                            @switch($service->pricing_type)
                            @case('per_page')
                            لكل صفحة
                            @break

                            @case('per_hour')
                            لكل ساعة
                            @break

                            @case('per_min')
                            لكل دقيقة
                            @break

                            @case('fixed')
                            سعر ثابت
                            @break

                            @default
                            غير محدد
                            @endswitch

                        </span>
                    </td>


                    {{-- Status --}}
                    <td>

                        <form action="{{ route('admin.services.toggle-status', $service) }}"
                            method="POST">

                            @csrf
                            @method('PATCH')

                            <button type="submit"
                                class="btn btn-sm rounded-pill px-3
                                        {{ $service->is_active
                                            ? 'btn-success bg-opacity-25'
                                            : 'btn-outline-secondary' }}">

                                {{ $service->is_active ? '● مفعّلة' : '○ معطّلة' }}

                            </button>

                        </form>

                    </td>


                    {{-- Actions --}}
                    <td>

                        <div class="d-flex justify-content-center gap-2">

                            <a href="{{ route('admin.services.edit', $service) }}"
                                class="btn btn-sm btn-outline-warning px-3">
                                تعديل
                            </a>

                            <form action="{{ route('admin.services.destroy', $service) }}"
                                method="POST"
                                onsubmit="return confirm('هل أنت متأكد من حذف خدمة {{ $service->name }}؟ هذا الإجراء لا يمكن التراجع عنه.')">

                                @csrf
                                @method('DELETE')

                                <button type="submit"
                                    class="btn btn-sm btn-outline-danger px-3">
                                    حذف
                                </button>

                            </form>

                        </div>

                    </td>

                </tr>

                @empty

                {{-- Empty State --}}
                <tr>
                    <td colspan="6" class="text-center py-5">

                        <div class="mb-3 text-secondary" style="font-size: 42px;">
                            ✧
                        </div>

                        <h5 class="fw-bold mb-2">
                            لا توجد خدمات حتى الآن
                        </h5>

                        <p class="text-secondary small mb-3">
                            ابدأ بإضافة أول خدمة لتظهر على موقعك
                        </p>

                        <a href="{{ route('admin.services.create') }}"
                            class="btn btn-primary px-4">
                            + إضافة أول خدمة
                        </a>

                    </td>
                </tr>

                @endforelse

            </tbody>

        </table>

    </div>

</div>

@endsection