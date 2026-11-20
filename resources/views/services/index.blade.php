@extends('layouts.app')

@section('title', 'إدارة الخدمات')

@section('content')

<section class="container py-5">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>إدارة الخدمات</h2>

        <a href="{{ route('services.create') }}" class="btn btn-primary">
            + إضافة خدمة جديدة
        </a>
    </div>

    @if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif

    <div class="table-responsive">
        <table class="table table-dark table-hover border-secondary">

            <thead>
                <tr>
                    <th>#</th>
                    <th>الأيقونة</th>
                    <th>اسم الخدمة</th>
                    <th>الوصف</th>
                    <th>السعر</th>
                    <th>نوع التسعير</th>
                    <th>الحالة</th>
                    <th>الإجراءات</th>
                </tr>
            </thead>

            <tbody>
                @forelse ($services as $service)

                <tr>
                    <td>{{ $service->id }}</td>

                    <td>
                        <i class="{{ $service->icon }} fs-4 text-info"></i>
                    </td>

                    <td>{{ $service->name }}</td>

                    <td>
                        {{ Str::limit($service->description, 50) }}
                    </td>

                    <td>
                        {{ $service->price ? number_format($service->price, 2) . ' ج.م' : '-' }}
                    </td>

                    <td>
                        @switch($service->pricing_type)

                        @case('per_page')
                        للصفحة
                        @break

                        @case('per_hour')
                        للساعة
                        @break

                        @case('per_min')
                        للدقيقة
                        @break

                        @case('fixed')
                        سعر ثابت
                        @break

                        @default
                        غير محدد

                        @endswitch
                    </td>

                    <td>
                        @if ($service->is_active)
                        <span class="badge bg-success">
                            مفعّلة
                        </span>
                        @else
                        <span class="badge bg-secondary">
                            معطّلة
                        </span>
                        @endif
                    </td>

                    <td>
                        <a href="{{ route('services.edit', $service) }}"
                            class="btn btn-sm btn-outline-warning">
                            تعديل
                        </a>

                        <form action="{{ route('services.destroy', $service) }}"
                            method="POST"
                            class="d-inline"
                            onsubmit="return confirm('هل أنت متأكد من حذف هذه الخدمة؟')">

                            @csrf
                            @method('DELETE')

                            <button type="submit" class="btn btn-sm btn-outline-danger">
                                حذف
                            </button>

                        </form>
                    </td>
                </tr>

                @empty

                <tr>
                    <td colspan="8" class="text-center text-secondary">
                        لا توجد خدمات بعد.
                    </td>
                </tr>

                @endforelse
            </tbody>

        </table>
    </div>

</section>

@endsection