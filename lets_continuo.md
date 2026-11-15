# نظام Authentication للـ Admin — نظرة عامة

> **السياق:** مشروع Laravel 13 + Blade، مفيش Customer Accounts، لذلك نستخدم **Laravel Session-Based Authentication** بدلاً من JWT.

---

## 1. شكل النظام

### المسار الكامل للـ Flow

المستخدم يفتح /admin/login
│
▼

يشوف صفحة Login (Form: email + password + CSRF token)
│
▼

يبعت البيانات بـ POST /admin/login
│
▼

النظام يتحقق من البيانات
│
┌─────┴─────┐
│ │
✅ صح ❌ غلط
│ │
▼ ▼

تسجيل رسالة خطأ
الدخول + رجوع للـ Form
│
▼

Session Regeneration
(تغيير Session ID)
│
▼

Redirect to /admin/dashboard
│
▼

Middleware يتحقق:

هل المستخدم عامل Login؟ (auth)

هل المستخدم Admin؟ (role)
│
┌───┴───┐
│ │
✅ ❌
│ │
▼ ▼

يدخل Redirect
Dashboard to Login

text

### الحالات الثلاثة الأساسية

| الحالة                 | الشرط                          | النتيجة                                      |
| ---------------------- | ------------------------------ | -------------------------------------------- |
| **Guest** (زائر)       | مش عامل Login                  | Redirect → `/admin/login`                    |
| **Authenticated User** | عامل Login بس مش Admin         | Redirect → `/admin/login` (بعد إبطال الجلسة) |
| **Admin**              | عامل Login + عنده صلاحية Admin | يدخل `/admin/dashboard`                      |

---

## 2. الخطوات التنفيذية

هنمشي بالترتيب ده، وكل خطوة هنفهم فيها إحنا بنعمل إيه وليه.

| #   | الخطوة                    | الهدف                               |
| --- | ------------------------- | ----------------------------------- |
| 1   | Admin Database Design     | تجهيز حسابات الأدمن                 |
| 2   | Authentication Setup      | تجهيز نظام تسجيل الدخول             |
| 3   | Login & Logout            | تسجيل الدخول والخروج                |
| 4   | Authentication Middleware | حماية صفحات الإدارة                 |
| 5   | Authorization             | التأكد إن المستخدم Admin            |
| 6   | Protect Routes            | حماية جميع Services CRUD            |
| 7   | Secure Sessions           | تأمين جلسات المستخدم                |
| 8   | Rate Limiting             | منع محاولات تخمين كلمة المرور       |
| 9   | Security Testing          | اختبار النظام ومحاولة تجاوز الحماية |

---

## 3. أهم قرارات الـ Security

عايزين نراعي الحاجات دي من البداية:

- **Password Hashing:** استخدام Hash آمن لكلمات المرور، وعدم تخزينها كنص عادي.
- **CSRF Protection:** حماية جميع Forms من CSRF.
- **Rate Limiting:** تحديد عدد محاولات تسجيل الدخول.
- **Session Regeneration:** تغيير Session ID بعد تسجيل الدخول.
- **Secure Logout:** إنهاء الجلسة وإبطال بياناتها عند الخروج.
- **Authorization:** مش مجرد إن المستخدم عامل Login، لازم نتأكد إنه Admin.
- **HTTPS:** استخدام اتصال مشفر في Production.
- **No Public Registration:** مفيش صفحة تسجيل حسابات للأدمن؛ الحسابات هتضاف من خلال Seeder أو بطريقة إدارية آمنة.

> ⚠️ **ملحوظة مهمة:** إخفاء زر إدارة الخدمات من الـ Navbar مش حماية. لازم نحمي الـ Routes نفسها باستخدام Middleware.

---

## 4. شكل الـ Routes النهائي

هنوصل لشكل قريب من ده:

```php
// Public Routes
Route::get('/', [HomeController::class, 'index'])
    ->name('home');

// Admin Authentication
Route::prefix('admin')->name('admin.')->group(function () {

    Route::get('/login', [AdminAuthController::class, 'showLogin'])
        ->name('login');

    Route::post('/login', [AdminAuthController::class, 'login'])
        ->name('login.submit');

    Route::post('/logout', [AdminAuthController::class, 'logout'])
        ->middleware('auth')
        ->name('logout');

});

// Protected Admin Routes
Route::middleware('auth')->prefix('admin')->group(function () {

    Route::resource('services', ServiceController::class);

});
ده تصور مبدئي، وهنضيف التحقق من صلاحيات الأدمن بشكل صحيح قبل الاعتماد عليه.

5. نبدأ منين؟
أنا مش عايز نستعجل ونكتب كود قبل ما نفهم تصميم النظام.

أول قرار محتاجين ناخده
هل نستخدم جدول users الموجود في Laravel ونضيف له role يحدد إن المستخدم Admin، ولا نعمل جدول admins منفصل؟

✅ الترشيح الحالي: استخدام جدول users مع صلاحية Admin؛ لأنه أبسط ومناسب لحجم مشروعنا الحالي، مع إمكانية تطوير نظام Roles & Permissions لاحقاً.

text
```
