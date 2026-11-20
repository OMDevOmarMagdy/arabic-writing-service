@extends('layouts.app')

@section('title', 'حكاية | لكل فكرة حكاية تستحق أن تُكتب')

@section('content')

<div class="universe">

    {{-- Hero --}}
    <section class="hero-section container">

        <div class="hero-content">

            <span class="hero-badge">
                <span class="badge-star">✦</span>
                عالم من الكلمات والإبداع
            </span>

            <h1>
                لكل فكرة
                <span class="gradient-text">حكاية تستحق</span>
                أن تُكتب
            </h1>

            <p class="hero-description">
                من صورة بسيطة إلى مستند احترافي،
                ومن تسجيل صوتي إلى كلمات تعبّر عنك.
                نحن نهتم بالتفاصيل، لتصبح أفكارك أكثر وضوحًا وجمالًا.
            </p>

            <div class="hero-actions">

                <a href="#services" class="btn-explore">
                    اكتشف خدماتنا
                    <span>←</span>
                </a>

                <a href="#about" class="btn-secondary-custom">
                    اكتشف عالمنا
                </a>

            </div>

            <div class="hero-trust">
                <span>✦</span>
                دقة في التفاصيل
                <span class="trust-divider">|</span>
                جودة في كل كلمة
            </div>

        </div>


        {{-- Artwork --}}
        <div class="hero-art">

            <div class="orbit orbit-one"></div>
            <div class="orbit orbit-two"></div>

            <div class="floating-star star-one">✦</div>
            <div class="floating-star star-two">✧</div>
            <div class="floating-star star-three">✦</div>
            <div class="floating-star star-four">✧</div>

            <div class="art-card">

                <div class="art-card-top">
                    <span>THE ART OF WORDS</span>
                    <span>✦</span>
                </div>

                <div class="book-art">

                    <div class="book-page book-left">
                        <div class="book-line"></div>
                        <div class="book-line"></div>
                        <div class="book-line short"></div>
                        <div class="book-line"></div>
                    </div>

                    <div class="book-page book-right">
                        <div class="book-title">Words</div>
                        <div class="book-line"></div>
                        <div class="book-line short"></div>
                        <div class="book-line"></div>
                    </div>

                </div>

                <div class="art-caption">

                    <span class="caption-icon">✧</span>

                    <div>
                        <strong>Every detail matters</strong>
                        <small>Turning ideas into beautiful work</small>
                    </div>

                </div>

            </div>

        </div>

    </section>


    {{-- Services --}}
    <section id="services" class="services-section container">

        <div class="section-heading">

            <div>
                <span class="section-eyebrow">WHAT WE DO</span>

                <h2>
                    خدمات تجعل
                    <span class="gradient-text">حياتك أسهل</span>
                </h2>

                <p>
                    اختر الخدمة التي تحتاجها، واترك لنا الاهتمام بالتفاصيل.
                </p>
            </div>

            <div class="section-decoration">✦</div>

        </div>

        <div class="row g-4">

            @forelse ($services as $service)

            <div class="col-md-6 col-lg-4">

                <div class="service-card">

                    <div class="service-icon">
                        <i class="{{ $service->icon ?: 'bi bi-stars' }}"></i>
                    </div>

                    <h3>{{ $service->name }}</h3>

                    <p>
                        {{ $service->description }}
                    </p>

                    @if ($service->price)

                    <div class="service-price">

                        <span class="price-label">
                            السعر
                        </span>

                        <strong>
                            {{ number_format($service->price, 2) }}
                            <small>ج.م</small>
                        </strong>

                        <span class="price-unit">

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

                            @endswitch

                        </span>

                    </div>

                    @endif

                    <div class="service-card-footer">
                        <span>اكتشف الخدمة</span>
                        <span class="service-arrow">←</span>
                    </div>

                </div>

            </div>

            @empty

            <div class="col-12">
                <div class="empty-services">
                    <span>✧</span>
                    <p>هناك خدمات جديدة يتم تجهيزها قريبًا.</p>
                </div>
            </div>

            @endforelse

        </div>

    </section>


    {{-- About --}}
    <section id="about" class="about-section container">

        <div class="about-box">

            <div class="about-decoration">✦</div>

            <span class="section-eyebrow">
                A LITTLE MAGIC IN EVERY DETAIL
            </span>

            <h2>
                التفاصيل الصغيرة<br>
                <span class="gradient-text">تصنع فرقًا كبيرًا</span>
            </h2>

            <p>
                نؤمن أن كل كلمة، وكل صفحة، وكل تفصيلة تستحق الاهتمام.
                هدفنا أن نوفر لك وقتك، ونحول ما تحتاجه إلى عمل منظم،
                واضح، وجاهز للاستخدام.
            </p>

            <a href="#contact" class="btn-explore">
                ابدأ رحلتك معنا
                <span>←</span>
            </a>

        </div>

    </section>


    {{-- Contact --}}
    <section id="contact" class="contact-section container">

        <div class="contact-content">

            <span class="section-eyebrow">
                YOUR NEXT IDEA STARTS HERE
            </span>

            <h2>
                هل لديك فكرة تحتاج إلى كلمات؟
            </h2>

            <p>
                دعنا نساعدك في تحويلها إلى شيء جميل ومنظم.
            </p>

            <a href="#services" class="btn-explore">
                اطلب خدمتك الآن
                <span>←</span>
            </a>

        </div>

    </section>

</div>

@endsection