<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str; // استيراد Str Facade لإنشاء الـ slug

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // --- بيانات المستخدمين (Authors) ---
        $defaultAvatar = 'avatars/defaultAvatar.jpg';

        DB::table('users')->insert([
            [
                'name' => 'هبة محمد خضير',
                'email' => 'eng.hkhudair@gmail.com',
                'password' => Hash::make('password'), // كلمة مرور: password
                'avatar' => $defaultAvatar,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'أحمد محمود',
                'email' => 'ahmed.mahmoud@example.com',
                'password' => Hash::make('password'), // كلمة مرور: password
                'avatar' => $defaultAvatar,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'سارة علي',
                'email' => 'sara.ali@example.com',
                'password' => Hash::make('password'), // كلمة مرور: password
                'avatar' => $defaultAvatar,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            // أضف المزيد من المستخدمين هنا
        ]);

        // --- بيانات القصص (Stories) ---
        $defaultCover1 = 'story_covers/defaultCover.jpg';
        $defaultCover2 = 'story_covers/storyCover.jpg';
        $defaultCover3 = 'story_covers/child.jpg';

        // تعريف القصص في مصفوفة لتسهيل توليد الـ slugs
        $storiesData = [
            [
                'title' => 'صمود غزة: حكايات من قلب الحصار',
                'user_id' => 1,
                'content' => 'في قلب غزة، تتجسد روح الصمود في كل زاوية، حيث يروي الناس قصصاً ملهمة عن التحدي والأمل. هذه الحكايات هي شهادات حية على قوة الإرادة البشرية في مواجهة الظروف الصعبة، وتعكس إصرار الشعب الفلسطيني على الحياة والبناء رغم كل التحديات. من أزقة المخيمات إلى شوارع المدينة، كل حجر يحمل قصة، وكل وجه يحكي فصلاً من فصول النضال اليومي.',
                'cover_image' => $defaultCover2,
                'type' => 'صمود',
                'published_at' => Carbon::parse('2024-01-15'),
            ],
            [
                'title' => 'أطفال غزة: أحلام لا تموت',
                'user_id' => 2,
                'content' => 'على الرغم من قسوة الواقع، يظل أطفال غزة يحملون في قلوبهم أحلاماً كبيرة. يبتكرون طرقاً للعب والفرح، ويجدون السعادة في أبسط الأشياء. قصصهم مليئة بالبراءة والشجاعة، وتذكرنا بأن الأمل يزهر حتى في أصعب الظروف. إنهم جيل المستقبل الذي يحمل على عاتقه بناء غد أفضل، مستلهمين من صمود آبائهم وأجدادهم.',
                'cover_image' => $defaultCover3,
                'type' => 'أمل',
                'published_at' => Carbon::parse('2024-03-20'),
            ],
            [
                'title' => 'ذاكرة الأجداد: قصص من التراث الفلسطيني',
                'user_id' => 3,
                'content' => 'التراث الفلسطيني غني بالقصص والحكايات التي توارثتها الأجيال. هذه القصص ليست مجرد سرد لأحداث ماضية، بل هي جزء حي من الهوية الفلسطينية، تحمل في طياتها قيم الصبر والتضحية والانتماء للأرض. من حكايات الحصاد إلى قصص البطولة، كل واحدة منها تروي فصلاً من تاريخ شعب لا ينسى جذوره.',
                'cover_image' => $defaultCover1,
                'type' => 'تراث',
                'published_at' => Carbon::parse('2024-05-01'),
            ],
            [
                'title' => 'رحلة صيد في بحر غزة',
                'user_id' => 1,
                'content' => 'كل صباح، ينطلق صيادو غزة في رحلة محفوفة بالمخاطر والأمل. يواجهون تحديات البحر والحصار، لكنهم يعودون محملين بالرزق وقصص الصبر. هذه القصص ليست مجرد يوميات عمل، بل هي تعبير عن علاقة الإنسان بأرضه وبحره، وكفاحه من أجل البقاء والكرامة.',
                'cover_image' => $defaultCover2,
                'type' => 'تحدي',
                'published_at' => Carbon::parse('2024-06-10'),
            ],
            [
                'title' => 'فن التطريز الفلسطيني: حكاية خيط وإبرة',
                'user_id' => 2,
                'content' => 'التطريز الفلسطيني ليس مجرد حرفة، بل هو فن يحكي قصصاً عن التاريخ والهوية. كل غرزة تحكي عن قرية، وكل لون يرمز إلى معنى. النساء الفلسطينيات يحافظن على هذا التراث العريق، وينقلنه من جيل إلى جيل، ليظل شاهداً على الإبداع والصمود.',
                'cover_image' => $defaultCover1,
                'type' => 'أمل',
                'published_at' => Carbon::parse('2024-07-20'),
            ],
            // أضف المزيد من القصص هنا، مع تغيير user_id و title و content و type
        ];

        foreach ($storiesData as $story) {
            DB::table('stories')->insert([
                'title' => $story['title'],
                'slug' => Str::slug($story['title']), // توليد الـ slug من العنوان
                'user_id' => $story['user_id'],
                'content' => $story['content'],
                'cover_image' => $story['cover_image'],
                'type' => $story['type'],
                'published_at' => $story['published_at'],
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }

        // يمكنك إضافة استدعاءات لـ Seeders أخرى هنا إذا كان لديك:
        // $this->call(AnotherTableSeeder::class);
    }
}
