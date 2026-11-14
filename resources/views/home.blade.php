@extends('layouts.app')

@section('title', 'الرئيسية | خدمات الكتابة')

@section('content')

<section class="container py-5 text-center">

    <div class="py-5">

        <h1 class="display-5 fw-bold mb-4">
            خدمات الكتابة والتنسيق باحترافية
        </h1>

        <p class="text-secondary fs-5 mb-4">
            نحول ملفاتك وصورك وتسجيلاتك إلى محتوى منظم
            وقابل للتعديل بسهولة.
        </p>

        <a href="#services" class="btn btn-primary btn-lg">
            اكتشف خدماتنا
        </a>

    </div>

</section>

<section id="services" class="container py-5">

    <h2 class="text-center mb-5">خدماتنا</h2>

    <div class="row g-4">

        @forelse ($services as $service)
        <div class="col-md-4">
            <div class="card bg-dark text-light border-secondary h-100">
                <div class="card-body">
                    <h5 class="card-title">{{ $service->name }}</h5>
                    <p class="card-text text-secondary">
                        {{ $service->description }}
                    </p>
                    @if ($service->price)
                    <p class="text-info fw-bold mb-0">
                        {{ number_format($service->price, 2) }}
                        @switch($service->pricing_type)
                        @case('per_page') ج.م / للصفحة @break
                        @case('per_hour') ج.م / للساعة @break
                        @case('per_min') ج.م / للدقيقة @break
                        @case('fixed') ج.م @break
                        @endswitch
                    </p>
                    @endif
                </div>
            </div>
        </div>
        @empty
        <div class="col-12 text-center text-secondary">
            <p>لا توجد خدمات متاحة حالياً.</p>
        </div>
        @endforelse

    </div>

</section>

<section id="contact" class="container py-5 text-center">
    <h2>هل تحتاج إلى خدمة؟</h2>
    <p class="text-secondary">
        يسعدنا مساعدتك في تنفيذ طلبك.
    </p>
</section>

@endsection