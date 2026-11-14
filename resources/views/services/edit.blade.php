@extends('layouts.app')

@section('title', 'تعديل الخدمة - ' . $service->name)

@section('content')

<section class="container py-5">

    <div class="row justify-content-center">
        <div class="col-md-8">

            <h2 class="mb-4">تعديل الخدمة: {{ $service->name }}</h2>

            @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            <form action="{{ route('services.update', $service) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="name" class="form-label">اسم الخدمة</label>
                    <input type="text" class="form-control bg-dark text-light border-secondary"
                        id="name" name="name" value="{{ old('name', $service->name) }}" required>
                </div>

                <div class="mb-3">
                    <label for="description" class="form-label">وصف الخدمة</label>
                    <textarea class="form-control bg-dark text-light border-secondary"
                        id="description" name="description" rows="4">{{ old('description', $service->description) }}</textarea>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="price" class="form-label">السعر (ر.س)</label>
                        <input type="number" step="0.01" min="0"
                            class="form-control bg-dark text-light border-secondary"
                            id="price" name="price" value="{{ old('price', $service->price) }}">
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="pricing_type" class="form-label">نوع التسعير</label>
                        <select class="form-select bg-dark text-light border-secondary"
                            id="pricing_type" name="pricing_type">
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
                            تفعيل الخدمة
                        </label>
                    </div>
                </div>

                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-primary">
                        تحديث الخدمة
                    </button>
                    <a href="{{ route('services.index') }}" class="btn btn-outline-secondary">
                        إلغاء
                    </a>
                </div>

            </form>

        </div>
    </div>

</section>

@endsection