@extends('layouts.app')
@section('title', 'قصصي - ذاكرة غزة')
@section('content')

    <div class="flex-grow flex p-6 space-x-6">
        {{-- الشريط الجانبي الأيسر --}}
        <div class="w-1/4 bg-white rounded-lg shadow-md p-6 flex flex-col space-y-6">
            {{-- قصة اليوم --}}
            <div>
                <p class="text-gray-500 text-sm">{{ \Carbon\Carbon::now()->format('l, F j') }}</p>
                <h2 class="text-lg font-semibold text-gray-800 mb-4">قصة اليوم</h2>
                @if ($todaysStory)
                    <div class="flex items-start">
                        <div class="w-16 h-16 rounded-lg overflow-hidden bg-gray-200 flex-shrink-0">
                            <img src="{{ asset('storage/' . $todaysStory->cover_image) }}" alt="{{ $todaysStory->title }}"
                                class="w-full h-full object-cover">
                        </div>
                        <div class="mt-1 ml-4 p-3">
                            <p class="text-gray-700 font-medium">{{ $todaysStory->title }}</p>
                            <p class="text-gray-500 text-sm">{{ $todaysStory->user->name ?? 'كاتب غير معروف' }}</p>
                        </div>
                    </div>
                @else
                    <p class="text-gray-600">لا توجد قصة لهذا اليوم حالياً.</p>
                @endif
            </div>

            <hr class="border-t border-gray-200">

            {{-- تحدي القراءة (بيانات ثابتة حالياً) --}}
            <div class="flex flex-col items-center text-center">
                <h3 class="text-lg font-semibold text-gray-800 mb-2">من ذاكرة غزة</h3>
                <div class="bg-blue-100 p-4 rounded-lg flex flex-col items-center">
                    <img src="{{ asset('storage/' . $todaysStory->cover_image) }}" alt="gazaMemory"
                        class="w-32 h-24 object-contain mb-2 rounded-lg">
                    <p class="text-gray-800 font-bold">{{ $todaysStory->title }}</p>
                    <p class="text-gray-700 text-sm">{{ $todaysStory->user->name ?? 'كاتب غير معروف' }}</p>
                </div>
            </div>

            <hr class="border-t border-gray-200">

            {{-- الكاتب (من قصة اليوم) --}}
            <div>
                <p class="text-gray-600">الكاتب</p>
                <p class="text-lg font-semibold text-gray-800">
                    {{ $todaysStory->user->name ?? 'كاتب غير معروف' }}
                </p>
            </div>

            <hr class="border-t border-gray-200">

            {{-- رفوف القصة (الآن بيانات ديناميكية) --}}
            <div>
                <h3 class="text-lg font-semibold text-gray-800 mb-2">{{ $todaysStory->title }}</h3>
                <div class="space-y-2">
                    {{-- عرض أول 30 كلمة من القصة --}}
                    <p class="text-gray-600">
                        {{ Str::words($todaysStory->content, 30, '...') }}
                    </p>
                    <p class="text-gray-600 mt-2">
                        {{-- زر "أكمل القراءة" ينقل إلى صفحة القصة كاملة --}}
                        <a href="{{ route('stories.show', $todaysStory->slug) }}"
                            class="text-blue-600 hover:underline font-medium">
                            أكمل القراءة &rarr;
                        </a>
                    </p>
                </div>
            </div>
        </div>

        <hr class="border-t border-gray-200">

        {{-- القسم الأوسط (أشهر القصص والأقسام) --}}
        <div class="w-2/4 flex flex-col space-y-6">
            {{-- أشهر القصص --}}
            <div class="bg-white rounded-lg shadow-md p-6">
                <h2 class="text-lg font-semibold text-gray-800 mb-4 text-center">أشهر القصص</h2>
                <div class="grid grid-cols-2 gap-4">
                    @forelse ($trendingStories as $story)
                        <a href="{{ route('stories.show', $story->slug) }}">
                            <div class="flex items-center bg-gray-50 p-3 rounded-lg">
                                <div class="w-16 h-16 rounded-lg overflow-hidden bg-gray-200 flex-shrink-0">
                                    <img src="{{ asset('storage/' . $story->cover_image) }}" alt="{{ $story->title }}"
                                        class="w-full h-full object-cover">
                                </div>
                                <div class="ml-3 p-3">
                                    <h3 class="font-semibold text-gray-800">{{ $story->title }}</h3>
                                    <p class="text-gray-600 text-sm">{{ $story->user->name ?? 'كاتب غير معروف' }}
                                    </p>
                                    <p class="text-gray-500 text-xs">{{ Str::limit($story->content, 30) }}</p>
                                </div>
                            </div>
                        </a>
                    @empty
                        <p class="col-span-2 text-center text-gray-600">لا توجد قصص شائعة حالياً.</p>
                    @endforelse
                </div>
            </div>

           {{-- الأقسام (تُمرر من HomeController@index) --}}
            <div class="bg-white rounded-lg shadow-md p-6">
                <h2 class="text-lg font-semibold text-gray-800 mb-4">الأقسام</h2>
                {{-- التعديل هنا: استخدام flexbox مع التمرير الأفقي --}}
                <div class="flex overflow-x-auto space-x-4 pb-4 scrollbar-hide"> {{-- أضفنا scrollbar-hide لإخفاء شريط التمرير الافتراضي إذا أردت --}}
                    @forelse ($sections as $section)
                        {{-- هنا نستخدم المتغير $sections الممرر من HomeController --}}
                        <a href="{{ route('stories.index', ['type' => $section['slug']]) }}" class="flex-shrink-0 w-36"> {{-- flex-shrink-0 و w-36 لتحديد عرض كل عنصر --}}
                            <div class="flex flex-col items-center text-center p-2">
                                <div class="w-full h-32 rounded-lg overflow-hidden bg-gray-200 mb-2">
                                    <img src="{{ asset('assets/img/' . $section['image']) }}" alt="{{ $section['name'] }}"
                                        class="w-full h-full object-cover">
                                </div>
                                <p class="text-gray-800 font-medium">{{ $section['name'] }}</p>
                            </div>
                        </a>
                    @empty
                        <p class="col-span-4 text-center text-gray-600">لا توجد أقسام حالياً.</p>
                    @endforelse
                </div>
            </div>
        </div>


        {{-- الشريط الجانبي الأيمن --}}
        <div class="w-1/4 bg-white rounded-lg shadow-md p-6 flex flex-col items-center text-center space-y-6">
            <h2 class="text-lg font-semibold text-gray-800">أكتب قصتك</h2>
            <p class="text-gray-600 text-sm">شارك قصتك معنا لتبقى محفورة في ذاكرة غزة ونبعث الأمل ونشارك أفراحنا
                وأتراحنا مع العالم</p>
            <div class="bg-blue-100 p-4 rounded-lg flex flex-col items-center w-full">
                <h3 class="text-xl font-bold text-blue-800 mb-2">ذاكرة غزة</h3>
                <img src="{{ asset('assets/img/gazaMemory.png') }}" alt="Write Story Illustration"
                    class="w-40 h-32 object-contain mb-4">
                <p class="text-gray-700 font-medium">عبر عن نفسك وعن مشاعرك</p>
            </div>
            <div class="mt-auto w-full">
                <h3 class="text-lg font-semibold text-gray-800 mb-2">شارك في صنع ذاكرة غزة</h3>
                <a href="{{ route('stories.create') }}"
                    class="w-16 h-16 bg-blue-500 hover:bg-blue-600 text-white rounded-full flex items-center justify-center text-3xl font-light mx-auto shadow-lg">
                    +
                </a>
            </div>
        </div>
    </div>

    </div>
@endsection
