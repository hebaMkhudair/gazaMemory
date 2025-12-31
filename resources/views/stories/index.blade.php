@extends('layouts.app')

@section('title', $currentSectionName . ' - ذاكرة غزة')

@section('content')
    <main class="flex-grow container mx-auto px-4 py-8">
        <h1 class="text-4xl font-bold mb-2 text-gray-800 dark:text-gray-100 text-center">
            @if ($currentSectionName == 'جميع القصص')
                جميع القصص
            @else
                <span class="text-indigo-600 dark:text-indigo-400">{{ $currentSectionName }}</span>
            @endif
        </h1>
        <p class="text-center text-gray-600 dark:text-gray-400 mb-8">استكشف القصص والتجارب المختلفة</p>

        <!-- Search and Filter Section -->
        <div class="max-w-7xl mx-auto mb-6">
            <form method="GET" action="{{ route('stories.index') }}"
                class="bg-white dark:bg-gray-800 rounded-xl shadow-sm
               border border-gray-100 dark:border-gray-700
               px-6 py-6">

                <div class="flex items-center gap-3">

                    <!-- SEARCH (ياخد أغلب المساحة) -->
                    <div class="flex-grow">
                        <div class="relative">
                            <span class="absolute inset-y-0 right-3 flex items-center text-gray-400 text-sm">
                                🔍
                            </span>
                            <input type="text" name="search" value="{{ $searchQuery }}" placeholder="ابحث في القصص"
                                class="w-full h-10 pr-9 pl-4 rounded-lg
                               bg-gray-50 dark:bg-gray-700
                               border border-gray-200 dark:border-gray-600
                               focus:ring-2 focus:ring-indigo-500
                               text-sm text-gray-700 dark:text-white">
                        </div>
                    </div>

                    <!-- CATEGORY (عرض ثابت) -->
                    <div style="width:180px;">
                        <select name="type"
                            class="w-full h-10 px-4 rounded-lg
                           bg-gray-50 dark:bg-gray-700
                           border border-gray-200 dark:border-gray-600
                           focus:ring-2 focus:ring-indigo-500
                           text-sm text-gray-700 dark:text-white">
                            <option value="">كل التصنيفات</option>
                            @foreach ($typeMapping as $slug => $arabicName)
                                <option value="{{ $slug }}" @selected($typeFilter === $slug)>
                                    {{ $arabicName }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- BUTTON (صغير أنيق) -->
                    <div style="width:96px;">
                        <button type="submit"
                            class="w-full h-10 bg-indigo-600 hover:bg-indigo-700
                           text-white rounded-lg font-medium text-sm transition">
                            بحث
                        </button>
                    </div>

                </div>

                <div class="mt-3 py-6 text-xs text-gray-500 dark:text-gray-400">
                    يتم عرض <span class="text-indigo-600 dark:text-indigo-400 font-bold">{{ $stories->total() }}</span> قصة
                </div>
            </form>
        </div>


        @if ($stories->isEmpty())
            <div
                class="bg-white dark:bg-gray-800 p-12 rounded-2xl shadow-md text-center border border-gray-100 dark:border-gray-700">
                <svg class="w-16 h-16 mx-auto mb-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 6.253v13m0-13C6.5 6.253 2 10.998 2 16.5S6.5 26.5 12 26.5s10-4.745 10-10.5S17.5 6.253 12 6.253z">
                    </path>
                </svg>
                <p class="text-lg font-semibold text-gray-700 dark:text-gray-300">لا توجد قصص تطابق بحثك</p>
                <p class="mt-2 text-gray-600 dark:text-gray-400">حاول تغيير معايير البحث أو الفلترة.</p>
                <a href="{{ route('stories.create') }}"
                    class="mt-6 inline-flex items-center px-6 py-3 border border-transparent text-sm font-semibold rounded-lg shadow-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-900 transition">
                    <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                    </svg>
                    أضف قصتك الآن
                </a>
            </div>
        @else
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                @foreach ($stories as $story)
                    <div
                        class="bg-white dark:bg-gray-800 rounded-xl shadow-md overflow-hidden flex flex-col hover:shadow-xl transition-shadow duration-300">
                        <a href="{{ route('stories.show', $story->slug) }}" class="block">
                            <div
                                class="w-full h-48 overflow-hidden bg-gradient-to-br from-gray-200 to-gray-300 dark:from-gray-700 dark:to-gray-800 relative">
                                @if ($story->cover_image)
                                    <img src="{{ asset('storage/' . $story->cover_image) }}" alt="{{ $story->title }}"
                                        class="w-full h-full object-cover hover:scale-110 transition-transform duration-300">
                                @else
                                    <img src="{{ asset('assets/img/default-story-cover.png') }}" alt="صورة غلاف افتراضية"
                                        class="w-full h-full object-cover hover:scale-110 transition-transform duration-300">
                                @endif
                                <div class="absolute top-3 right-3">
                                    <span
                                        class="inline-block bg-indigo-600 text-white text-xs font-bold px-3 py-1 rounded-full">
                                        {{ $story->type ?? 'غير محدد' }}
                                    </span>
                                </div>
                            </div>
                            <div class="p-4 flex-grow flex flex-col justify-between">
                                <div>
                                    <h3
                                        class="text-lg font-bold text-gray-800 dark:text-gray-100 mb-2 truncate line-clamp-2">
                                        {{ $story->title }}</h3>
                                    <p class="text-gray-600 dark:text-gray-400 text-sm mb-3 line-clamp-2">
                                        {{ Str::limit($story->content, 80) }}</p>
                                </div>
                                <div class="mt-auto space-y-1 text-xs text-gray-500 dark:text-gray-400">
                                    <p class="flex items-center">
                                        <svg class="w-4 h-4 ml-1" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z"></path>
                                        </svg>
                                        {{ $story->user->name ?? 'كاتب غير معروف' }}
                                    </p>
                                    <p class="flex items-center">
                                        <svg class="w-4 h-4 ml-1" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd"
                                                d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                                clip-rule="evenodd"></path>
                                        </svg>
                                        {{ $story->published_at->format('Y-m-d') }}
                                    </p>
                                </div>
                            </div>
                        </a>
                        <div
                            class="p-4 bg-gray-50 dark:bg-gray-700 border-t border-gray-100 dark:border-gray-600 flex justify-end">
                            <a href="{{ route('stories.show', $story->slug) }}"
                                class="text-indigo-600 dark:text-indigo-400 hover:text-indigo-800 dark:hover:text-indigo-300 text-sm font-semibold transition">
                                قراءة المزيد
                                <svg class="inline w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7">
                                    </path>
                                </svg>
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="mt-8">
                {{ $stories->links() }}
            </div>
        @endif
    </main>
@endsection
