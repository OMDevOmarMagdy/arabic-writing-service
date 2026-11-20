<?php

namespace Database\Seeders;

use App\Models\Service;
use Illuminate\Database\Seeder;

class ServiceSeeder extends Seeder
{
    public function run(): void
    {
        $services = [

            // 1. PDF to Word
            [
                'name' => 'تحويل PDF إلى Word',
                'slug' => 'pdf-to-word',
                'description' => 'حوّل ملفات PDF إلى مستندات Word قابلة للتعديل مع الحفاظ على ترتيب النصوص والفقرات والتنسيق قدر الإمكان، لتتمكن من تعديل محتواك بسهولة.',
                'icon' => 'bi bi-file-earmark-word',
                'price' => 7.50,
                'pricing_type' => 'per_page',
                'is_active' => true,
            ],

            // 2. Image to Text
            [
                'name' => 'تحويل الصور إلى نصوص',
                'slug' => 'image-to-text',
                'description' => 'حوّل الصور التي تحتوي على نصوص عربية أو إنجليزية إلى ملفات نصية قابلة للتعديل، دون الحاجة إلى إعادة كتابة المحتوى يدويًا.',
                'icon' => 'bi bi-card-image',
                'price' => 8.00,
                'pricing_type' => 'per_page',
                'is_active' => true,
            ],

            // 3. Audio Transcription
            [
                'name' => 'التفريغ الصوتي',
                'slug' => 'audio-transcription',
                'description' => 'حوّل التسجيلات الصوتية إلى نصوص مكتوبة بدقة ووضوح، مع مراعاة ترتيب الكلام والحفاظ على المعنى الأصلي للمحتوى.',
                'icon' => 'bi bi-mic',
                'price' => 15.00,
                'pricing_type' => 'per_min',
                'is_active' => true,
            ],

            // 4. Lecture Transcription
            [
                'name' => 'تفريغ المحاضرات التعليمية',
                'slug' => 'lecture-transcription',
                'description' => 'حوّل المحاضرات والدروس المسجلة إلى مذكرات مكتوبة ومنظمة، لتسهيل المراجعة والدراسة والاحتفاظ بالمعلومات.',
                'icon' => 'bi bi-mortarboard',
                'price' => 15.00,
                'pricing_type' => 'per_min',
                'is_active' => true,
            ],

            // 5. Meeting Transcription
            [
                'name' => 'تفريغ الاجتماعات والمقابلات',
                'slug' => 'meeting-transcription',
                'description' => 'حوّل تسجيلات الاجتماعات والمقابلات إلى نصوص واضحة تساعدك على توثيق المناقشات والقرارات والنقاط المهمة.',
                'icon' => 'bi bi-people',
                'price' => 20.00,
                'pricing_type' => 'per_min',
                'is_active' => true,
            ],

            // 6. Handwriting to Text
            [
                'name' => 'كتابة المحتوى المكتوب بخط اليد',
                'slug' => 'handwriting-to-text',
                'description' => 'أرسل صور أوراقك وملاحظاتك المكتوبة بخط اليد، وسنعيد كتابتها إلكترونيًا في مستند منظم يسهل قراءته وتعديله.',
                'icon' => 'bi bi-pencil-square',
                'price' => 12.00,
                'pricing_type' => 'per_page',
                'is_active' => true,
            ],

            // 7. Content Writing
            [
                'name' => 'كتابة المحتوى العربي',
                'slug' => 'arabic-content-writing',
                'description' => 'احصل على محتوى عربي أصلي بأسلوب واضح وجذاب، مصمم ليتناسب مع هدفك والجمهور الذي ترغب في الوصول إليه.',
                'icon' => 'bi bi-pen',
                'price' => 50.00,
                'pricing_type' => 'per_page',
                'is_active' => true,
            ],

            // 8. Articles Writing
            [
                'name' => 'كتابة المقالات',
                'slug' => 'article-writing',
                'description' => 'مقالات احترافية تقدم الأفكار والمعلومات بطريقة مترابطة وممتعة، مع تنظيم العناوين والفقرات لتقديم تجربة قراءة مميزة.',
                'icon' => 'bi bi-journal-text',
                'price' => 60.00,
                'pricing_type' => 'per_page',
                'is_active' => true,
            ],

            // 9. Rewriting
            [
                'name' => 'إعادة صياغة النصوص',
                'slug' => 'text-rewriting',
                'description' => 'أعد تقديم أفكارك بأسلوب أكثر احترافية وسلاسة، مع تحسين تركيب الجمل ووضوح المعاني دون الإخلال بالفكرة الأساسية.',
                'icon' => 'bi bi-arrow-repeat',
                'price' => 15.00,
                'pricing_type' => 'per_page',
                'is_active' => true,
            ],

            // 10. Proofreading
            [
                'name' => 'التدقيق اللغوي والإملائي',
                'slug' => 'proofreading',
                'description' => 'راجع مستنداتك وتخلص من الأخطاء الإملائية والنحوية وعلامات الترقيم، واجعل نصوصك أكثر دقة واحترافية.',
                'icon' => 'bi bi-spellcheck',
                'price' => 15.00,
                'pricing_type' => 'per_page',
                'is_active' => true,
            ],

            // 11. Word Formatting
            [
                'name' => 'تنسيق ملفات Word',
                'slug' => 'word-formatting',
                'description' => 'حوّل مستندات Word العادية إلى ملفات أنيقة ومنظمة من خلال ضبط الخطوط والعناوين والمسافات والهوامش وترتيب الصفحات.',
                'icon' => 'bi bi-file-earmark-richtext',
                'price' => 15.00,
                'pricing_type' => 'per_page',
                'is_active' => true,
            ],

            // 12. Academic Research
            [
                'name' => 'تنسيق الأبحاث العلمية',
                'slug' => 'academic-research-formatting',
                'description' => 'جهّز بحثك العلمي بصورة منظمة من خلال تنسيق العناوين والفصول والجداول والمراجع وترقيم الصفحات وفق متطلباتك.',
                'icon' => 'bi bi-journal-bookmark',
                'price' => 25.00,
                'pricing_type' => 'per_page',
                'is_active' => true,
            ],

            // 13. CV Writing
            [
                'name' => 'إعداد وتنسيق السيرة الذاتية',
                'slug' => 'cv-preparation',
                'description' => 'قدّم خبراتك ومهاراتك بصورة احترافية من خلال إعداد سيرة ذاتية منظمة وجذابة تساعدك على إبراز نقاط قوتك عند التقديم للوظائف.',
                'icon' => 'bi bi-person-vcard',
                'price' => 150.00,
                'pricing_type' => 'fixed',
                'is_active' => true,
            ],

            // 14. Official Letters
            [
                'name' => 'كتابة الخطابات الرسمية',
                'slug' => 'official-letters',
                'description' => 'صياغة خطابات وطلبات رسمية بلغة عربية سليمة وأسلوب مهني مناسب للمؤسسات والجهات الحكومية والشركات.',
                'icon' => 'bi bi-envelope-paper',
                'price' => 75.00,
                'pricing_type' => 'fixed',
                'is_active' => true,
            ],

            // 15. Reports Writing
            [
                'name' => 'إعداد وكتابة التقارير',
                'slug' => 'report-writing',
                'description' => 'نظّم معلوماتك وأفكارك في تقارير واضحة ومتسلسلة، مع تقسيم المحتوى إلى أقسام وعناوين تسهّل فهم النتائج والمعلومات.',
                'icon' => 'bi bi-file-earmark-bar-graph',
                'price' => 50.00,
                'pricing_type' => 'per_page',
                'is_active' => true,
            ],

            // 16. Presentations
            [
                'name' => 'إعداد العروض التقديمية',
                'slug' => 'presentation-design',
                'description' => 'حوّل أفكارك ومعلوماتك إلى عرض تقديمي منظم وجذاب، مع توزيع المحتوى على شرائح واضحة تناسب الاجتماعات والدراسة والعمل.',
                'icon' => 'bi bi-easel2',
                'price' => 25.00,
                'pricing_type' => 'fixed',
                'is_active' => true,
            ],

            // 17. Data Entry
            [
                'name' => 'إدخال البيانات وتنظيمها',
                'slug' => 'data-entry',
                'description' => 'أدخل بياناتك بدقة في ملفات إلكترونية منظمة، مع ترتيب المعلومات وتصنيفها لتسهيل الوصول إليها ومراجعتها واستخدامها.',
                'icon' => 'bi bi-database',
                'price' => 10.00,
                'pricing_type' => 'per_page',
                'is_active' => true,
            ],

            // 18. Excel Formatting
            [
                'name' => 'تنسيق جداول Excel',
                'slug' => 'excel-formatting',
                'description' => 'حوّل جداول Excel إلى ملفات منظمة وسهلة الاستخدام من خلال تنسيق الخلايا وترتيب البيانات وتنسيق الأعمدة والصفوف.',
                'icon' => 'bi bi-file-earmark-spreadsheet',
                'price' => 20.00,
                'pricing_type' => 'fixed',
                'is_active' => true,
            ],

            // 19. Document Summarization
            [
                'name' => 'تلخيص المستندات والملفات',
                'slug' => 'document-summarization',
                'description' => 'اختصر المستندات الطويلة إلى ملخصات مركزة تحتفظ بالأفكار الرئيسية والمعلومات المهمة، لتصل إلى ما تحتاجه في وقت أقل.',
                'icon' => 'bi bi-file-earmark-text',
                'price' => 20.00,
                'pricing_type' => 'per_page',
                'is_active' => true,
            ],

            // 20. E-book Formatting
            [
                'name' => 'تنسيق الكتب والمستندات الإلكترونية',
                'slug' => 'ebook-formatting',
                'description' => 'جهّز كتبك ومستنداتك للنشر أو المشاركة الإلكترونية من خلال تنسيق الفصول والعناوين والفهارس وترتيب المحتوى بصورة احترافية.',
                'icon' => 'bi bi-book-half',
                'price' => 25.00,
                'pricing_type' => 'per_page',
                'is_active' => true,
            ],

        ];

        foreach ($services as $service) {
            Service::firstOrCreate(
                ['slug' => $service['slug']],
                $service
            );
        }
    }
}
