<?php

namespace Database\Factories;

use App\Models\Story;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str; // لا تنسَ استيراد Str لدالة slug

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Story>
 */
class StoryFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Story::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $destinationPath = 'story_covers'; // المجلد الذي ستُخزن فيه صور الأغلفة بعد النسخ
        $seedImagesPath = 'seed_images'; // اسم مجلد الصور المصدر داخل storage/app/public

        // الحصول على جميع الصور من مجلد المصدر
        $images = Storage::disk('public')->files($seedImagesPath);

        $coverImage = null;

        if (! empty($images)) {
            // اختيار صورة عشوائية من الصور الموجودة
            $randomImage = $this->faker->randomElement($images);
            $imageFileName = basename($randomImage); // الحصول على اسم الملف فقط

            // التأكد من وجود مجلد الوجهة، وإنشاءه إذا لم يكن موجوداً
            if (! Storage::disk('public')->exists($destinationPath)) {
                Storage::disk('public')->makeDirectory($destinationPath);
            }

            // إنشاء اسم فريد للصورة الجديدة لتجنب التكرار
            $newImageName = time().'_'.uniqid().'_'.$imageFileName;

            // نسخ الصورة من المصدر إلى الوجهة
            Storage::disk('public')->copy($randomImage, $destinationPath.'/'.$newImageName);

            // حفظ المسار النسبي للصورة (الذي سيستخدم في Blade)
            $coverImage = $destinationPath.'/'.$newImageName;
        } else {
            dd($images, Storage::disk('public')->exists($seedImagesPath), Storage::disk('public')->files($seedImagesPath));
            // **هذا الجزء هو المهم إذا لم يكن لديك صور في seed_images**
            // يمكنك هنا:
            // 1. استخدام صورة placeholder من Faker (يتطلب تثبيت Faker)
            //    $coverImage = $this->faker->imageUrl(640, 480, 'nature', true);
            // 2. استخدام مسار صورة افتراضية لديك في public/assets
            //    $coverImage = 'assets/img/default_story_cover.png'; // تأكد من وجودها
            // 3. تركها null إذا كنت متأكداً أن هذا لن يسبب مشاكل في العرض
            $coverImage = 'default_cover_image.jpg'; // مثال: استخدام اسم صورة افتراضية موجودة في public/storage/story_covers
            // يجب أن تضع هذه الصورة يدوياً هناك
        }

        // إنشاء العنوان ومن ثم السلاغ
        $title = $this->faker->sentence(mt_rand(3, 8));
        $slug = Str::slug($title);

        // أنواع قصص عشوائية
        $storyTypes = ['قصة قصيرة', 'شعر', 'تحدي قراءة', 'مقال'];

        return [
            'user_id' => User::factory(),
            'title' => $title,
            'slug' => $slug, // تأكد من وجود عمود slug في قاعدة البيانات
            'cover_image' => $coverImage,
            'content' => $this->faker->paragraphs(mt_rand(5, 15), true),
            'type' => $this->faker->randomElement($storyTypes),
            'published_at' => $this->faker->dateTimeBetween('-1 year', 'now'),
        ];
    }

    /**
     * Configure the model factory.
     */
    public function configure(): static
    {
        return $this->afterCreating(function (Story $story) {
            //
        });
    }
}
