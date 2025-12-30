@extends('layouts.app')
@section('title', 'قصصي - ذاكرة غزة')
@section('content')

    <div class="flex-grow mt-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            <!-- Grid Layout: Responsive from mobile to desktop -->
            <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-4 gap-6">
                
                <!-- Left Sidebar - Hidden on mobile, visible on larger screens -->
                <div class="hidden md:flex md:col-span-1 lg:col-span-1 flex-col space-y-6">
                    <!-- Story of the Day -->
                    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-6">
                        <p class="text-gray-500 dark:text-gray-400 text-sm mb-2">{{ \Carbon\Carbon::now()->format('l, F j') }}</p>
                        <h2 class="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-4">قصة اليوم</h2>
                        @if ($todaysStory)
                            <a href="{{ route('stories.show', $todaysStory->slug) }}" class="block hover:opacity-80 transition">
                                <div class="w-full h-32 rounded-lg overflow-hidden bg-gray-200 dark:bg-gray-700 mb-3">
                                    <img src="{{ asset('storage/' . $todaysStory->cover_image) }}" alt="{{ $todaysStory->title }}"
                                        class="w-full h-full object-cover hover:scale-105 transition duration-300">
                                </div>
                                <p class="text-gray-900 dark:text-gray-100 font-medium text-sm line-clamp-2">{{ $todaysStory->title }}</p>
                                <p class="text-gray-600 dark:text-gray-400 text-xs mt-2">{{ $todaysStory->user->name ?? 'كاتب غير معروف' }}</p>
                            </a>
                        @else
                            <p class="text-gray-600 dark:text-gray-400">لا توجد قصة لهذا اليوم حالياً.</p>
                        @endif
                    </div>

                    <!-- Featured Story -->
                    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-6">
                        @if ($todaysStory)
                            <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-3">{{ $todaysStory->title }}</h3>
                            <p class="text-gray-700 dark:text-gray-300 text-sm line-clamp-3 mb-4">
                                {{ Str::words($todaysStory->content, 30, '...') }}
                            </p>
                            <a href="{{ route('stories.show', $todaysStory->slug) }}"
                                class="text-blue-600 dark:text-blue-400 hover:text-blue-700 dark:hover:text-blue-300 font-medium text-sm transition">
                                أكمل القراءة &rarr;
                            </a>
                        @endif
                    </div>
                </div>

                <!-- Main Content Area -->
                <div class="col-span-1 md:col-span-2 lg:col-span-2 space-y-6">
                    <!-- Trending Stories -->
                    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-6">
                        <h2 class="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-4 text-center">أشهر القصص</h2>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            @forelse ($trendingStories as $story)
                                <a href="{{ route('stories.show', $story->slug) }}" class="hover:opacity-80 transition">
                                    <div class="flex flex-col bg-gray-50 dark:bg-gray-700 p-4 rounded-lg h-full">
                                        <div class="w-full h-40 rounded-lg overflow-hidden bg-gray-200 dark:bg-gray-600 mb-3">
                                            <img src="{{ asset('storage/' . $story->cover_image) }}" alt="{{ $story->title }}"
                                                class="w-full h-full object-cover hover:scale-105 transition duration-300">
                                        </div>
                                        <h3 class="font-semibold text-gray-900 dark:text-gray-100 line-clamp-2">{{ $story->title }}</h3>
                                        <p class="text-gray-600 dark:text-gray-400 text-sm mt-2">{{ $story->user->name ?? 'كاتب غير معروف' }}</p>
                                    </div>
                                </a>
                            @empty
                                <p class="col-span-full text-center text-gray-600 dark:text-gray-400">لا توجد قصص شائعة حالياً.</p>
                            @endforelse
                        </div>
                    </div>

                    <!-- Categories -->
                    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-6">
                        <h2 class="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-4">الأقسام</h2>
                        <div class="grid grid-cols-2 sm:grid-cols-3 gap-4">
                            @forelse ($sections as $section)
                                <a href="{{ route('stories.index', ['type' => $section['slug']]) }}" class="hover:opacity-80 transition">
                                    <div class="flex flex-col items-center text-center">
                                        <div class="w-full h-24 sm:h-28 rounded-lg overflow-hidden bg-gray-200 dark:bg-gray-700 mb-2">
                                            <img src="{{ asset('assets/img/' . $section['image']) }}" alt="{{ $section['name'] }}"
                                                class="w-full h-full object-cover hover:scale-105 transition duration-300">
                                        </div>
                                        <p class="text-gray-900 dark:text-gray-100 font-medium text-sm">{{ $section['name'] }}</p>
                                    </div>
                                </a>
                            @empty
                                <p class="col-span-full text-center text-gray-600 dark:text-gray-400">لا توجد أقسام حالياً.</p>
                            @endforelse
                        </div>
                    </div>
                </div>

                <!-- Right Sidebar - Hidden on mobile, visible on larger screens -->
                <div class="hidden lg:flex lg:col-span-1 flex-col space-y-6">
                    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-6 flex flex-col items-center text-center h-fit sticky top-24">
                        <h2 class="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-4">اكتب قصتك</h2>
                        <p class="text-gray-600 dark:text-gray-400 text-sm mb-4">
                            شارك قصتك معنا لتبقى محفورة في ذاكرة غزة
                        </p>
                        <div class="bg-blue-100 dark:bg-blue-900/30 p-4 rounded-lg w-full mb-4">
                            <h3 class="text-lg font-bold text-blue-800 dark:text-blue-300 mb-2">ذاكرة غزة</h3>
                            <img src="{{ asset('assets/img/gazaMemory.png') }}" alt="Write Story"
                                class="w-28 h-24 object-contain mx-auto mb-2">
                            <p class="text-gray-700 dark:text-gray-300 font-medium text-sm">عبر عن نفسك</p>
                        </div>
                        <a href="{{ route('stories.create') }}"
                            class="w-14 h-14 bg-blue-500 hover:bg-blue-600 dark:bg-blue-600 dark:hover:bg-blue-700 text-white rounded-full flex items-center justify-center text-3xl font-light shadow-lg transition">
                            +
                        </a>
                    </div>
                </div>
            </div>

            <!-- Mobile CTA - Visible only on mobile -->
            <div class="md:hidden mt-8 bg-white dark:bg-gray-800 rounded-lg shadow-md p-6 text-center">
                <h2 class="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-3">اكتب قصتك</h2>
                <p class="text-gray-600 dark:text-gray-400 text-sm mb-4">
                    شارك قصتك معنا لتبقى محفورة في ذاكرة غزة
                </p>
                <a href="{{ route('stories.create') }}"
                    class="inline-block bg-blue-500 hover:bg-blue-600 dark:bg-blue-600 dark:hover:bg-blue-700 text-white px-6 py-2 rounded-lg font-medium transition">
                    ابدأ الآن
                </a>
            </div>
        </div>
    </div>

@endsection
