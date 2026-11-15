@extends('admin.layouts.app')

@section('title', 'إضافة خدمة جديدة')

@section('content')

<div class="mb-4">
    <h2 class="fw-bold mb-1">إضافة خدمة جديدة</h2>
    <p class="text-secondary mb-0">أضف خدمة جديدة لعرضها على الموقع</p>
</div>

<div class="row">
    <div class="col-lg-8">
        <div class="card bg-dark border-secondary">
            <div class="card-body p-4">

                @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif

                <form action="{{ route('admin.services.store') }}" method="POST">
                    @csrf

                    <div class="mb-3">
                        <label for="name" class="form-label text-white">اسم الخدمة <span class="text-danger">*</span></label>
                        <input type="text" class="form-control bg-dark text-light border-secondary"
                            id="name" name="name" value="{{ old('name') }}"
                            placeholder="مثال: تحويل الملفات" required>
                    </div>

                    <div class="mb-3">
                        <label for="description" class="form-label text-white">وصف الخدمة</label>
                        <textarea class="form-control bg-dark text-light border-secondary"
                            id="description" name="description" rows="4"
                            placeholder="اكتب وصفاً مختصراً للخدمة...">{{ old('description') }}</textarea>
                    </div>

                    <div class="mb-3">
                        <label for="icon" class="form-label text-white">أيقونة الخدمة</label>
                        <input type="text" class="form-control bg-dark text-light border-secondary"
                            id="icon" name="icon" value="{{ old('icon') }}"
                            placeholder="مثال: 📄 أو أي رمز إيموجي">
                        <div class="form-text text-secondary">اختياري — يمكنك إضافة إيموجي أو رمز لتمييز الخدمة.</div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="price" class="form-label text-white">السعر (ج.م)</label>
                            <input type="number" step="0.01" min="0"
                                class="form-control bg-dark text-light border-secondary"
                                id="price" name="price" value="{{ old('price') }}"
                                placeholder="0.00">
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="pricing_type" class="form-label text-white">نوع التسعير <span class="text-danger">*</span></label>
                            <select class="form-select bg-dark text-light border-secondary"
                                id="pricing_type" name="pricing_type" required>
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

                    <div class="mb-4">
                        <div class="form-check form-switch">
                            <input class="form-check-input text-white" type="checkbox"
                                id="is_active" name="is_active" value="1"
                                {{ old('is_active', true) ? 'checked' : '' }}>
                            <label class="form-check-label text-white" for="is_active">
                                تفعيل الخدمة وعرضها على الموقع
                            </label>
                        </div>
                    </div>

                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-primary px-4">
                            حفظ الخدمة
                        </button>
                        <a href="{{ route('admin.services.index') }}" class="btn btn-outline-secondary">
                            إلغاء
                        </a>
                    </div>

                </form>

            </div>
        </div>
    </div>

    {{-- Help Panel --}}
    <div class="col-lg-4">
        <div class="card bg-dark border-secondary">
            <div class="card-body">
                <h6 class="fw-bold mb-3">💡 ملاحظات</h6>
                <ul class="list-unstyled text-secondary small mb-0">
                    <li class="mb-2">• اسم الخدمة سيظهر كعنوان في بطاقة الخدمة على الموقع.</li>
                    <li class="mb-2">• الوصف سيظهر أسفل العنوان في البطاقة.</li>
                    <li class="mb-2">• الأيقونة اختيارية ويمكنك استخدام رموز إيموجي.</li>
                    <li class="mb-2">• يمكنك تعطيل الخدمة لإخفائها من الموقع دون حذفها.</li>
                    <li>• السعر اختياري ويمكن تركه فارغاً.</li>
                </ul>
            </div>
        </div>
    </div>
</div>

@endsection