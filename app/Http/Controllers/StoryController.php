<?php

namespace App\Http\Controllers;

use App\Models\Story;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class StoryController extends Controller
{
    /**
     * Display a listing of the resource. (Main stories listing or filtered by type)
     */
    public function index(Request $request)
    {
        $query = Story::query();
        $currentSectionName = 'جميع القصص'; // اسم القسم الافتراضي
        $searchQuery = $request->input('search', '');
        $typeFilter = $request->input('type', '');

        // تعريف الأقسام الثابتة ومطابقة الـ slug مع الاسم العربي
        $typeMapping = [
            'suffering' => 'معاناة',
            'resilience' => 'صمود',
            'hope' => 'أمل',
            'challenge' => 'تحدي',
            'heritage' => 'تراث',
        ];

        // البحث في العنوان والمحتوى
        if ($searchQuery) {
            $query->where(function ($q) use ($searchQuery) {
                $q->where('title', 'like', '%'.$searchQuery.'%')
                  ->orWhere('content', 'like', '%'.$searchQuery.'%');
            });
        }

        // التحقق مما إذا كان هناك طلب لفلترة حسب النوع
        if ($typeFilter) {
            $typeSlug = $typeFilter;

            // البحث عن الاسم العربي المطابق للـ slug
            $arabicTypeName = $typeMapping[$typeSlug] ?? null;

            if ($arabicTypeName) {
                $query->where('type', $arabicTypeName);
                $currentSectionName = $arabicTypeName; // تحديث اسم القسم الحالي
            }
        }

        $stories = $query->latest()->paginate(12); // جلب القصص مع تقسيم الصفحات

        // لتمريرها إلى الـ layout (إن كان layout.app يستخدمها)
        $user = Auth::user();

        return view('stories.index', compact('stories', 'currentSectionName', 'user', 'searchQuery', 'typeFilter', 'typeMapping'));
    }

    /**
     * Display a listing of stories written by the authenticated user.
     */
    public function myStories(Request $request)
    {
        $user = Auth::user();
        $searchQuery = $request->input('search', '');
        $typeFilter = $request->input('type', '');
        
        $typeMapping = [
            'suffering' => 'معاناة',
            'resilience' => 'صمود',
            'hope' => 'أمل',
            'challenge' => 'تحدي',
            'heritage' => 'تراث',
        ];
        
        $query = Story::where('user_id', Auth::id());
        
        // البحث في العنوان والمحتوى
        if ($searchQuery) {
            $query->where(function ($q) use ($searchQuery) {
                $q->where('title', 'like', '%'.$searchQuery.'%')
                  ->orWhere('content', 'like', '%'.$searchQuery.'%');
            });
        }
        
        // فلترة حسب النوع
        if ($typeFilter) {
            $arabicTypeName = $typeMapping[$typeFilter] ?? null;
            if ($arabicTypeName) {
                $query->where('type', $arabicTypeName);
            }
        }
        
        $myStories = $query->latest()->get();

        return view('stories.my-stories', compact('myStories', 'user', 'searchQuery', 'typeFilter', 'typeMapping'));
    }

    /**
     * Show the form for creating a new resource.
     * (واجهة كتابة القصة)
     */
    public function create()
    {
        // استخدام Auth Facade بشكل صحيح
        $user = Auth::user(); // <--- استخدام Auth::user() بدلاً من Auth()->user()

        return view('stories.create', compact('user'));
    }

    /**
     * Store a newly created resource in storage.
     * (معالجة حفظ القصة الجديدة)
     */
    public function store(Request $request)
    {
        // التحقق من صحة البيانات المدخلة
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'cover_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // للصور
            'type' => 'nullable|string|max:255',
        ]);

        $coverImagePath = null;
        if ($request->hasFile('cover_image')) {
            // تخزين الصورة في مجلد 'story_covers' داخل 'storage/app/public'
            $coverImagePath = $request->file('cover_image')->store('story_covers', 'public');
        }

        // توليد الـ slug والتأكد من فرادته
        $slug = Str::slug($request->title);
        $originalSlug = $slug;
        $count = 1;
        while (Story::where('slug', $slug)->exists()) {
            $slug = $originalSlug.'-'.$count++;
        }

        // إنشاء قصة جديدة وحفظها في قاعدة البيانات
        $story = Story::create([
            'user_id' => Auth::id(), // <--- استخدام Auth::id() بدلاً من FacadesAuth::id()
            'title' => $request->title,
            'slug' => $slug,
            'content' => $request->content,
            'cover_image' => $coverImagePath,
            'type' => $request->type,
            'published_at' => now(), // تعيين تاريخ النشر
        ]);

        return redirect()->route('stories.show', $story->slug)
            ->with('success', 'Story created successfully!');
    }

    /**
     * Display the specified resource.
     * (واجهة عرض القصة الفردية)
     */
    public function show(string $slug)
    {
        // استخدام Auth Facade بشكل صحيح
        $user = Auth::user(); // <--- استخدام Auth::user() بدلاً من Auth()->user()
        $story = Story::where('slug', $slug)->firstOrFail();

        return view('stories.show', compact('story', 'user')); // ستحتاج لإنشاء هذا الـ View
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $slug)
    {
        $user = Auth::user();
        $story = Story::where('slug', $slug)->firstOrFail();
        // التأكد أن المستخدم الحالي هو مالك القصة
        if (Auth::id() !== $story->user_id) { // <--- استخدام Auth::id()
            abort(403, 'Unauthorized action.');
        }

        return view('stories.edit', compact('story', 'user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $slug)
    {
        $story = Story::where('slug', $slug)->firstOrFail();
        if (Auth::id() !== $story->user_id) {
            abort(403, 'Unauthorized action.');
        }

        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'cover_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'type' => 'nullable|string|max:255',
        ]);

        $coverImagePath = $story->cover_image;
        if ($request->hasFile('cover_image')) {
            // حذف الصورة القديمة إذا كانت موجودة
            if ($story->cover_image) {
                // استخدام Storage Facade بشكل صحيح
                Storage::disk('public')->delete($story->cover_image); // <--- استخدام Storage::disk
            }
            // تخزين الصورة الجديدة
            $coverImagePath = $request->file('cover_image')->store('story_covers', 'public');
        }

        // توليد slug جديد للتحديث إذا تغير العنوان
        $newSlug = Str::slug($request->title);
        if ($newSlug !== $story->slug) { // فقط إذا تغير العنوان أو كان الـ slug الجديد مختلفاً
            $originalNewSlug = $newSlug;
            $count = 1;
            while (Story::where('slug', $newSlug)->exists()) {
                $newSlug = $originalNewSlug.'-'.$count++;
            }
        } else {
            $newSlug = $story->slug; // إذا لم يتغير العنوان، احتفظ بنفس الـ slug
        }

        $story->update([
            'title' => $request->title,
            'slug' => $newSlug, // <--- تحديث الـ SLUG هنا أيضاً
            'content' => $request->content,
            'cover_image' => $coverImagePath,
            'type' => $request->type,
        ]);

        // بعد التحديث، قم بإعادة التوجيه إلى صفحة عرض القصة باستخدام الـ SLUG الجديد
        return redirect()->route('stories.show', $story->slug) // <--- استخدام $story->slug
            ->with('success', 'Story updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $slug)
    {
        $story = Story::where('slug', $slug)->firstOrFail();
        if (Auth::id() !== $story->user_id) { // <--- استخدام Auth::id()
            abort(403, 'Unauthorized action.');
        }

        // حذف الصورة المرتبطة بالقصة
        if ($story->cover_image) {
            // استخدام Storage Facade بشكل صحيح
            Storage::disk('public')->delete($story->cover_image); // <--- استخدام Storage::disk
        }

        $story->delete();

        return redirect()->route('stories.my-stories')
            ->with('success', 'Story deleted successfully!');
    }

    /**
     * Display published stories for the public homepage.
     */
    public function publicStories(Request $request): \Illuminate\View\View
    {
        $searchQuery = $request->input('search', '');
        $typeFilter = $request->input('type', '');

        // تعريف الأقسام الثابتة ومطابقة الـ slug مع الاسم العربي
        $typeMapping = [
            'suffering' => 'معاناة',
            'resilience' => 'صمود',
            'hope' => 'أمل',
            'challenge' => 'تحدي',
            'heritage' => 'تراث',
        ];

        $query = Story::whereNotNull('published_at');

        // البحث في العنوان والمحتوى
        if ($searchQuery) {
            $query->where(function ($q) use ($searchQuery) {
                $q->where('title', 'like', '%'.$searchQuery.'%')
                  ->orWhere('content', 'like', '%'.$searchQuery.'%');
            });
        }

        // التحقق مما إذا كان هناك طلب لفلترة حسب النوع
        if ($typeFilter) {
            $typeSlug = $typeFilter;
            $arabicTypeName = $typeMapping[$typeSlug] ?? null;

            if ($arabicTypeName) {
                $query->where('type', $arabicTypeName);
            }
        }

        $stories = $query->latest('published_at')->paginate(12);

        return view('stories.public', compact('stories', 'searchQuery', 'typeFilter', 'typeMapping'));
    }
}
