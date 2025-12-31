@extends('layouts.app')

@section('title', 'جميع القصص - ذاكرة غزة')

@section('content')
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Header Section -->
            <div class="mb-12 text-center">
                <h1 class="text-4xl font-bold text-gray-900 dark:text-gray-100 mb-4">
                    أحدث القصص
                </h1>
                <p class="text-lg text-gray-600 dark:text-gray-400">
                    شارك قصتك والحفظ من الذاكرة
                </p>
            </div>

            <!-- Search and Filter Section -->
            <div class="max-w-7xl mx-auto mb-6">
                <form method="GET" action="{{ route('home') }}"
                    class="bg-white dark:bg-gray-800 rounded-xl shadow-sm
                   border border-gray-100 dark:border-gray-700
                   px-6 py-4">

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

                </form>
            </div>

            @if ($stories->isEmpty())
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 dark:text-gray-100 text-center">
                        <p class="text-lg mb-4">لا توجد قصص منشورة حالياً.</p>
                        <p class="text-gray-600 dark:text-gray-400 mb-6">كن أول من يشارك قصته!</p>
                        @auth
                            <a href="{{ route('stories.create') }}" class="inline-block bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700 transition font-semibold">
                                اكتب قصتك
                            </a>
                        @else
                            <a href="{{ route('register') }}" class="inline-block bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700 transition font-semibold">
                                ابدأ الآن
                            </a>
                        @endauth
                    </div>
                </div>
            @else
                <!-- Stories Grid -->
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                    @foreach ($stories as $story)
                        <div class="bg-white dark:bg-gray-800 rounded-lg overflow-hidden shadow-sm hover:shadow-md transition flex flex-col border border-gray-200 dark:border-gray-700">
                            <!-- Story Image -->
                            <a href="{{ route('stories.show', $story->slug) }}" class="block overflow-hidden bg-gray-200 dark:bg-gray-700">
                                <div class="h-48 w-full overflow-hidden">
                                    @if ($story->cover_image)
                                        <img src="{{ asset('storage/' . $story->cover_image) }}" 
                                             alt="{{ $story->title }}"
                                             class="w-full h-full object-cover hover:scale-105 transition duration-300">
                                    @else
                                        <div class="w-full h-full bg-gradient-to-br from-blue-500 to-blue-600 dark:from-blue-700 dark:to-blue-800 flex items-center justify-center">
                                            <span class="text-white text-4xl">📖</span>
                                        </div>
                                    @endif
                                </div>
                            </a>

                            <!-- Story Content -->
                            <div class="p-4 flex-grow flex flex-col justify-between">
                                <div>
                                    <a href="{{ route('stories.show', $story->slug) }}" class="block">
                                        <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-2 line-clamp-2 hover:text-blue-600 dark:hover:text-blue-400 transition">
                                            {{ $story->title }}
                                        </h3>
                                    </a>
                                    <p class="text-gray-600 dark:text-gray-400 text-sm mb-3 line-clamp-3">
                                        {{ Str::limit($story->content, 100) }}
                                    </p>
                                </div>

                                <!-- Story Meta -->
                                <div class="pt-3 border-t border-gray-200 dark:border-gray-700 space-y-1">
                                    <p class="text-gray-600 dark:text-gray-400 text-xs">
                                        <span class="font-semibold">{{ $story->user->name ?? 'كاتب غير معروف' }}</span>
                                    </p>
                                    @if ($story->type)
                                        <p class="text-gray-600 dark:text-gray-400 text-xs">
                                            <span class="font-semibold">{{ $story->type }}</span>
                                        </p>
                                    @endif
                                    <p class="text-gray-500 dark:text-gray-400 text-xs">
                                        {{ $story->published_at->format('Y-m-d') }}
                                    </p>
                                </div>
                            </div>

                            <!-- Read More Button -->
                            <div class="p-4 bg-gray-50 dark:bg-gray-700 border-t border-gray-200 dark:border-gray-600">
                                <a href="{{ route('stories.show', $story->slug) }}" 
                                   class="block text-center text-blue-600 dark:text-blue-400 hover:text-blue-700 dark:hover:text-blue-300 py-2 font-semibold text-sm transition">
                                    اقرأ المزيد
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Pagination -->
                <div class="mt-12">
                    <div class="flex justify-center">
                        {{ $stories->links() }}
                    </div>
                </div>
            @endif
        </div>
    </div>
@endsection
