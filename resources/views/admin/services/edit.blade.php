@extends('admin.layouts.app')

@section('title', 'تعديل الخدمة - ' . $service->name)

@section('content')

{{-- Page Header --}}
<div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-4">
    <div>
        <h2 class="fw-bold mb-2">تعديل الخدمة</h2>
        <p class="text-secondary mb-0">
            تحديث بيانات خدمة «{{ $service->name }}»
        </p>
    </div>

    <a href="{{ route('admin.services.index') }}"
        class="btn btn-outline-secondary px-4 py-2">
        العودة للخدمات
    </a>
</div>

<div class="row g-4">

    {{-- Edit Form --}}
    <div class="col-lg-8">

        <div class="card bg-dark border-secondary rounded-4 overflow-hidden">

            <div class="card-header bg-transparent border-secondary p-3 p-md-4">
                <h5 class="fw-bold mb-1">بيانات الخدمة</h5>
                <small class="text-secondary">
                    يمكنك تعديل جميع بيانات الخدمة من هنا
                </small>
            </div>

            <div class="card-body p-3 p-md-4">

                {{-- Validation Errors --}}
                @if ($errors->any())
                <div class="alert alert-danger border-0 rounded-3 mb-4">
                    <div class="fw-bold mb-2">
                        يرجى مراجعة الأخطاء التالية:
                    </div>
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif

                <form action="{{ route('admin.services.update', $service) }}"
                    method="POST">

                    @csrf
                    @method('PUT')

                    {{-- Service Name --}}
                    <div class="mb-4">
                        <label for="name" class="form-label fw-semibold">
                            اسم الخدمة <span class="text-danger">*</span>
                        </label>

                        <input type="text"
                            class="form-control bg-dark text-light border-secondary rounded-3 py-2"
                            id="name"
                            name="name"
                            value="{{ old('name', $service->name) }}"
                            required>
                    </div>

                    {{-- Description --}}
                    <div class="mb-4">
                        <label for="description" class="form-label fw-semibold">
                            وصف الخدمة
                        </label>

                        <textarea
                            class="form-control bg-dark text-light border-secondary rounded-3"
                            id="description"
                            name="description"
                            rows="4">{{ old('description', $service->description) }}</textarea>

                        <div class="form-text text-secondary">
                            اكتب وصفاً واضحاً يساعد العملاء على فهم الخدمة.
                        </div>
                    </div>

                    {{-- Icon --}}
                    <div class="mb-4">
                        <label for="icon" class="form-label fw-semibold">
                            أيقونة الخدمة
                        </label>

                        <input type="text"
                            class="form-control bg-dark text-light border-secondary rounded-3 py-2"
                            id="icon"
                            name="icon"
                            value="{{ old('icon', $service->icon) }}"
                            placeholder="📄">

                        <div class="form-text text-secondary">
                            اختياري — أضف إيموجي لتمييز الخدمة.
                        </div>
                    </div>

                    {{-- Price & Pricing Type --}}
                    <div class="row">

                        <div class="col-md-6 mb-4">
                            <label for="price" class="form-label fw-semibold">
                                السعر (ج.م)
                            </label>

                            <input type="number"
                                step="0.01"
                                min="0"
                                class="form-control bg-dark text-light border-secondary rounded-3 py-2"
                                id="price"
                                name="price"
                                value="{{ old('price', $service->price) }}">
                        </div>

                        <div class="col-md-6 mb-4">
                            <label for="pricing_type" class="form-label fw-semibold">
                                نوع التسعير <span class="text-danger">*</span>
                            </label>

                            <select
                                class="form-select bg-dark text-light border-secondary rounded-3 py-2"
                                id="pricing_type"
                                name="pricing_type"
                                required>

                                <option value="per_page"
                                    {{ old('pricing_type', $service->pricing_type) == 'per_page' ? 'selected' : '' }}>
                                    للصفحة
                                </option>

                                <option value="per_hour"
                                    {{ old('pricing_type', $service->pricing_type) == 'per_hour' ? 'selected' : '' }}>
                                    للساعة
                                </option>

                                <option value="per_min"
                                    {{ old('pricing_type', $service->pricing_type) == 'per_min' ? 'selected' : '' }}>
                                    للدقيقة
                                </option>

                                <option value="fixed"
                                    {{ old('pricing_type', $service->pricing_type) == 'fixed' ? 'selected' : '' }}>
                                    سعر ثابت
                                </option>

                            </select>
                        </div>

                    </div>

                    {{-- Status --}}
                    <div class="bg-secondary bg-opacity-10 rounded-3 p-3 mb-4">
                        <div class="form-check form-switch mb-0">
                            <input class="form-check-input"
                                type="checkbox"
                                id="is_active"
                                name="is_active"
                                value="1"
                                {{ old('is_active', $service->is_active) ? 'checked' : '' }}>

                            <label class="form-check-label fw-semibold"
                                for="is_active">
                                تفعيل الخدمة وعرضها على الموقع
                            </label>

                            <div class="small text-secondary mt-1">
                                عند التفعيل ستصبح الخدمة متاحة للعملاء.
                            </div>
                        </div>
                    </div>

                    {{-- Actions --}}
                    <div class="d-flex flex-wrap gap-2 pt-3 border-top border-secondary">

                        <button type="submit"
                            class="btn btn-primary px-4 py-2">
                            حفظ التعديلات
                        </button>

                        <a href="{{ route('admin.services.index') }}"
                            class="btn btn-outline-secondary px-4 py-2">
                            إلغاء
                        </a>

                    </div>

                </form>

            </div>
        </div>
    </div>

    {{-- Sidebar --}}
    <div class="col-lg-4">

        {{-- Service Information --}}
        <div class="card bg-dark border-secondary rounded-4 mb-4">

            <div class="card-header bg-transparent border-secondary p-3">
                <h6 class="fw-bold mb-0">معلومات الخدمة</h6>
            </div>

            <div class="card-body p-3">

                <div class="d-flex align-items-center gap-3 mb-4">

                    <div class="rounded-3 bg-primary bg-opacity-25 d-flex align-items-center justify-content-center"
                        style="width: 50px; height: 50px; flex-shrink: 0;">

                        <span class="fs-4">
                            {{ $service->icon ?: '✦' }}
                        </span>

                    </div>

                    <div>
                        <div class="fw-bold">
                            {{ $service->name }}
                        </div>
                        <small class="text-secondary">
                            الخدمة #{{ $service->id }}
                        </small>
                    </div>

                </div>

                <hr class="border-secondary">

                <div class="mb-3">
                    <small class="text-secondary d-block mb-1">المعرّف</small>
                    <span class="fw-semibold">#{{ $service->id }}</span>
                </div>

                <div class="mb-3">
                    <small class="text-secondary d-block mb-1">الرابط</small>
                    <span class="fw-semibold">{{ $service->slug }}</span>
                </div>

                <div class="mb-3">
                    <small class="text-secondary d-block mb-1">الحالة الحالية</small>

                    @if ($service->is_active)
                    <span class="badge bg-success bg-opacity-25 text-success px-3 py-2">
                        مفعّلة
                    </span>
                    @else
                    <span class="badge bg-secondary px-3 py-2">
                        معطّلة
                    </span>
                    @endif
                </div>

                <hr class="border-secondary">

                <div class="mb-3">
                    <small class="text-secondary d-block mb-1">تاريخ الإنشاء</small>
                    <small>{{ $service->created_at->format('Y/m/d h:i A') }}</small>
                </div>

                <div>
                    <small class="text-secondary d-block mb-1">آخر تحديث</small>
                    <small>{{ $service->updated_at->format('Y/m/d h:i A') }}</small>
                </div>

            </div>
        </div>

        {{-- Danger Zone --}}
        <div class="card bg-dark border-danger rounded-4">

            <div class="card-header bg-transparent border-danger p-3">
                <h6 class="fw-bold text-danger mb-0">
                    منطقة الخطر
                </h6>
            </div>

            <div class="card-body p-3">

                <p class="text-secondary small mb-3">
                    حذف الخدمة نهائياً من قاعدة البيانات.
                    هذا الإجراء لا يمكن التراجع عنه.
                </p>

                <form action="{{ route('admin.services.destroy', $service) }}"
                    method="POST"
                    onsubmit="return confirm('هل أنت متأكد من حذف خدمة «{{ $service->name }}»؟\nهذا الإجراء لا يمكن التراجع عنه.')">

                    @csrf
                    @method('DELETE')

                    <button type="submit"
                        class="btn btn-outline-danger btn-sm w-100">
                        حذف الخدمة نهائياً
                    </button>

                </form>

            </div>
        </div>

    </div>
</div>

@endsection