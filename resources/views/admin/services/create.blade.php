@extends('admin.layouts.app')

@section('title', 'إضافة خدمة جديدة')

@section('content')

<div class="mb-4">
    <div class="d-flex align-items-center gap-2 mb-2">
        <span class="badge bg-primary bg-opacity-10 text-primary px-3 py-2">
            إدارة الخدمات
        </span>
        <span class="text-secondary small">/ إضافة خدمة</span>
    </div>

    <h2 class="fw-bold text-white mb-2">إضافة خدمة جديدة</h2>
    <p class="text-secondary mb-0">أضف خدمة جديدة إلى موقع حكاية وحدد تفاصيلها وطريقة تسعيرها.</p>
</div>

<div class="row g-4">

    {{-- Main Form --}}
    <div class="col-lg-8">
        <div class="card bg-dark border-secondary shadow-sm">
            <div class="card-header bg-transparent border-secondary p-4">
                <h5 class="fw-bold text-white mb-1">بيانات الخدمة</h5>
                <p class="text-secondary small mb-0">أدخل المعلومات الأساسية للخدمة الجديدة</p>
            </div>

            <div class="card-body p-4">

                @if ($errors->any())
                <div class="alert alert-danger border-0 mb-4">
                    <div class="fw-bold mb-2">يرجى مراجعة الأخطاء التالية:</div>
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif

                <form action="{{ route('admin.services.store') }}" method="POST">
                    @csrf

                    {{-- Service Name --}}
                    <div class="mb-4">
                        <label for="name" class="form-label text-white fw-semibold">
                            اسم الخدمة <span class="text-danger">*</span>
                        </label>

                        <input
                            type="text"
                            class="form-control bg-dark text-light border-secondary py-2"
                            id="name"
                            name="name"
                            value="{{ old('name') }}"
                            placeholder="مثال: تحويل الملفات إلى Word"
                            required>

                        <div class="form-text text-secondary">
                            اختر اسماً واضحاً يعبّر عن الخدمة.
                        </div>
                    </div>

                    {{-- Description --}}
                    <div class="mb-4">
                        <label for="description" class="form-label text-white fw-semibold">
                            وصف الخدمة
                        </label>

                        <textarea
                            class="form-control bg-dark text-light border-secondary"
                            id="description"
                            name="description"
                            rows="4"
                            placeholder="اكتب وصفاً مختصراً يوضح تفاصيل الخدمة...">{{ old('description') }}</textarea>
                    </div>

                    {{-- Icon --}}
                    <div class="mb-4">
                        <label for="icon" class="form-label text-white fw-semibold">
                            أيقونة الخدمة
                        </label>

                        <input
                            type="text"
                            class="form-control bg-dark text-light border-secondary py-2"
                            id="icon"
                            name="icon"
                            value="{{ old('icon') }}"
                            placeholder="مثال: 📄">

                        <div class="form-text text-secondary">
                            اختياري — يمكنك إضافة إيموجي أو رمز لتمييز الخدمة.
                        </div>
                    </div>

                    <hr class="border-secondary my-4">

                    {{-- Pricing --}}
                    <h6 class="text-white fw-bold mb-3">تفاصيل التسعير</h6>

                    <div class="row g-3 mb-4">

                        <div class="col-md-6">
                            <label for="price" class="form-label text-white fw-semibold">
                                السعر (ج.م)
                            </label>

                            <input
                                type="number"
                                step="0.01"
                                min="0"
                                class="form-control bg-dark text-light border-secondary py-2"
                                id="price"
                                name="price"
                                value="{{ old('price') }}"
                                placeholder="0.00">
                        </div>

                        <div class="col-md-6">
                            <label for="pricing_type" class="form-label text-white fw-semibold">
                                نوع التسعير <span class="text-danger">*</span>
                            </label>

                            <select
                                class="form-select bg-dark text-light border-secondary py-2"
                                id="pricing_type"
                                name="pricing_type"
                                required>
                                <option value="per_page" {{ old('pricing_type') == 'per_page' ? 'selected' : '' }}>
                                    للصفحة
                                </option>

                                <option value="per_hour" {{ old('pricing_type') == 'per_hour' ? 'selected' : '' }}>
                                    للساعة
                                </option>

                                <option value="per_min" {{ old('pricing_type') == 'per_min' ? 'selected' : '' }}>
                                    للدقيقة
                                </option>

                                <option value="fixed" {{ old('pricing_type') == 'fixed' ? 'selected' : '' }}>
                                    سعر ثابت
                                </option>
                            </select>
                        </div>

                    </div>

                    <hr class="border-secondary my-4">

                    {{-- Status --}}
                    <div class="p-3 rounded border border-secondary bg-black bg-opacity-25 mb-4">
                        <div class="form-check form-switch mb-0">
                            <input
                                class="form-check-input"
                                type="checkbox"
                                id="is_active"
                                name="is_active"
                                value="1"
                                {{ old('is_active', true) ? 'checked' : '' }}>

                            <label class="form-check-label text-white fw-semibold" for="is_active">
                                تفعيل الخدمة وعرضها على الموقع
                            </label>

                            <div class="form-text text-secondary">
                                يمكنك تغيير حالة الخدمة لاحقاً من لوحة الإدارة.
                            </div>
                        </div>
                    </div>

                    {{-- Actions --}}
                    <div class="d-flex flex-wrap gap-2 pt-2">
                        <button type="submit" class="btn btn-primary px-4 py-2">
                            <i class="bi bi-check-lg me-1"></i>
                            حفظ الخدمة
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

    {{-- Help Panel --}}
    <div class="col-lg-4">

        <div class="card bg-dark border-secondary shadow-sm mb-4">
            <div class="card-body p-4">

                <h6 class="fw-bold text-white mb-3">
                    <i class="bi bi-lightbulb text-warning me-2"></i>
                    ملاحظات مهمة
                </h6>

                <ul class="list-unstyled text-secondary small mb-0">

                    <li class="d-flex gap-2 mb-3">
                        <i class="bi bi-check-circle text-success"></i>
                        <span>اسم الخدمة سيظهر كعنوان في بطاقة الخدمة على الموقع.</span>
                    </li>

                    <li class="d-flex gap-2 mb-3">
                        <i class="bi bi-check-circle text-success"></i>
                        <span>الوصف سيظهر أسفل اسم الخدمة.</span>
                    </li>

                    <li class="d-flex gap-2 mb-3">
                        <i class="bi bi-check-circle text-success"></i>
                        <span>الأيقونة اختيارية ويمكنك استخدام رموز إيموجي.</span>
                    </li>

                    <li class="d-flex gap-2 mb-3">
                        <i class="bi bi-check-circle text-success"></i>
                        <span>يمكنك تعطيل الخدمة لإخفائها من الموقع دون حذفها.</span>
                    </li>

                    <li class="d-flex gap-2">
                        <i class="bi bi-check-circle text-success"></i>
                        <span>السعر اختياري ويمكن تركه فارغاً.</span>
                    </li>

                </ul>

            </div>
        </div>

        <div class="card bg-dark border-secondary shadow-sm">
            <div class="card-body p-4">

                <div class="d-flex align-items-center gap-3 mb-3">
                    <div class="rounded-3 bg-primary bg-opacity-10 p-3">
                        <i class="bi bi-info-circle text-primary fs-4"></i>
                    </div>

                    <div>
                        <h6 class="text-white fw-bold mb-1">نصيحة</h6>
                        <small class="text-secondary">قبل حفظ الخدمة</small>
                    </div>
                </div>

                <p class="text-secondary small mb-0">
                    تأكد من كتابة اسم ووصف واضحين، واختيار طريقة التسعير المناسبة لطبيعة الخدمة.
                </p>

            </div>
        </div>

    </div>

</div>

@endsection