@extends('admin.layouts.app')

@section('title', 'تعديل الخدمة - ' . $service->name)

@section('content')

    <div class="mb-4">
        <h2 class="fw-bold mb-1">تعديل الخدمة</h2>
        <p class="text-secondary mb-0">تعديل بيانات خدمة «{{ $service->name }}»</p>
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

                    <form action="{{ route('admin.services.update', $service) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label for="name" class="form-label">اسم الخدمة <span class="text-danger">*</span></label>
                            <input type="text" class="form-control bg-dark text-light border-secondary"
                                id="name" name="name" value="{{ old('name', $service->name) }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="description" class="form-label">وصف الخدمة</label>
                            <textarea class="form-control bg-dark text-light border-secondary"
                                id="description" name="description" rows="4">{{ old('description', $service->description) }}</textarea>
                        </div>

                        <div class="mb-3">
                            <label for="icon" class="form-label">أيقونة الخدمة</label>
                            <input type="text" class="form-control bg-dark text-light border-secondary"
                                id="icon" name="icon" value="{{ old('icon', $service->icon) }}"
                                placeholder="مثال: 📄 أو أي رمز إيموجي">
                            <div class="form-text text-secondary">اختياري — يمكنك إضافة إيموجي أو رمز لتمييز الخدمة.</div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="price" class="form-label">السعر (ج.م)</label>
                                <input type="number" step="0.01" min="0"
                                    class="form-control bg-dark text-light border-secondary"
                                    id="price" name="price" value="{{ old('price', $service->price) }}">
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="pricing_type" class="form-label">نوع التسعير <span class="text-danger">*</span></label>
                                <select class="form-select bg-dark text-light border-secondary"
                                    id="pricing_type" name="pricing_type" required>
                                    <option value="per_page" {{ old('pricing_type', $service->pricing_type) == 'per_page' ? 'selected' : '' }}>
                                        للصفحة
                                    </option>
                                    <option value="per_hour" {{ old('pricing_type', $service->pricing_type) == 'per_hour' ? 'selected' : '' }}>
                                        للساعة
                                    </option>
                                    <option value="per_min" {{ old('pricing_type', $service->pricing_type) == 'per_min' ? 'selected' : '' }}>
                                        للدقيقة
                                    </option>
                                    <option value="fixed" {{ old('pricing_type', $service->pricing_type) == 'fixed' ? 'selected' : '' }}>
                                        سعر ثابت
                                    </option>
                                </select>
                            </div>
                        </div>

                        <div class="mb-4">
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox"
                                    id="is_active" name="is_active" value="1"
                                    {{ old('is_active', $service->is_active) ? 'checked' : '' }}>
                                <label class="form-check-label" for="is_active">
                                    تفعيل الخدمة وعرضها على الموقع
                                </label>
                            </div>
                        </div>

                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-primary px-4">
                                تحديث الخدمة
                            </button>
                            <a href="{{ route('admin.services.index') }}" class="btn btn-outline-secondary">
                                إلغاء
                            </a>
                        </div>

                    </form>

                </div>
            </div>
        </div>

        {{-- Service Info --}}
        <div class="col-lg-4">
            <div class="card bg-dark border-secondary">
                <div class="card-body">
                    <h6 class="fw-bold mb-3">معلومات الخدمة</h6>
                    <ul class="list-unstyled text-secondary small mb-0">
                        <li class="mb-2">
                            <span class="text-light">المعرّف:</span> #{{ $service->id }}
                        </li>
                        <li class="mb-2">
                            <span class="text-light">الرابط:</span> {{ $service->slug }}
                        </li>
                        <li class="mb-2">
                            <span class="text-light">الحالة:</span>
                            @if ($service->is_active)
                                <span class="badge bg-success">مفعّلة</span>
                            @else
                                <span class="badge bg-secondary">معطّلة</span>
                            @endif
                        </li>
                        <li class="mb-2">
                            <span class="text-light">تاريخ الإنشاء:</span>
                            {{ $service->created_at->format('Y/m/d h:i A') }}
                        </li>
                        <li>
                            <span class="text-light">آخر تحديث:</span>
                            {{ $service->updated_at->format('Y/m/d h:i A') }}
                        </li>
                    </ul>
                </div>
            </div>

            {{-- Danger Zone --}}
            <div class="card bg-dark border-danger mt-3">
                <div class="card-body">
                    <h6 class="fw-bold text-danger mb-3">منطقة الخطر</h6>
                    <p class="text-secondary small">حذف الخدمة نهائياً من قاعدة البيانات. هذا الإجراء لا يمكن التراجع عنه.</p>
                    <form action="{{ route('admin.services.destroy', $service) }}" method="POST"
                        onsubmit="return confirm('هل أنت متأكد من حذف خدمة «{{ $service->name }}»؟\nهذا الإجراء لا يمكن التراجع عنه.')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-outline-danger btn-sm">
                            حذف الخدمة نهائياً
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
