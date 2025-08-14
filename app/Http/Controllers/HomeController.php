<?php

namespace App\Http\Controllers;

use App\Models\Story;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Display the main reading page.
     */
    public function index()
    {
        // 1. جلب قصة اليوم
        $todaysStory = Story::latest('published_at')->first(); // أحدث قصة كقصة اليوم

        // 2. جلب أشهر القصص (Trending Stories)
        $trendingStories = Story::inRandomOrder()->limit(6)->get(); // 6 قصص عشوائية

        // 3. بيانات المستخدم الحالي (لصورة البروفايل في الهيدر)
        $user = Auth()->user(); // يجلب المستخدم الذي قام بتسجيل الدخول حالياً

        // 4. الأقسام (Sections) - إضافة 'slug' لكل قسم
        $sections = [
            ['name' => 'جميع القصص', 'image' => 'sections/all-stories.png', 'slug' => 'all'], // اختر صورة وslug مناسبين
            ['name' => 'معاناة', 'image' => 'sections/suffering.jpg', 'slug' => 'suffering'],
            ['name' => 'صمود', 'image' => 'sections/resilience.png', 'slug' => 'resilience'],
            ['name' => 'أمل', 'image' => 'sections/hope.png', 'slug' => 'hope'],
            ['name' => 'تحدي', 'image' => 'sections/challenge.png', 'slug' => 'challenge'],
            ['name' => 'تراث', 'image' => 'sections/heritage.jpg', 'slug' => 'heritage'],

        ];

        // تمرير البيانات إلى الـ view
        return view('home', compact('todaysStory', 'trendingStories', 'user', 'sections'));
    }
}