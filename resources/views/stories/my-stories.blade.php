@extends('layouts.app')
@section('title', 'قصصي - ذاكرة غزة')
@section('content')

    <main class="flex-grow container mx-auto px-4 py-8">
        <div class="flex justify-between items-center mb-8">
            <div>
                <h1 class="text-4xl font-bold text-gray-800 dark:text-gray-100">قصصي التي كتبتها</h1>
                <p class="text-gray-600 dark:text-gray-400 mt-2">أدير وتتبع قصصك الشخصية</p>
            </div>
            <a href="{{ route('stories.create') }}"
                class="inline-flex items-center justify-center px-6 py-3 border border-transparent text-sm font-semibold rounded-lg shadow-sm text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 dark:focus:ring-offset-gray-900 transition duration-150">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-2" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd"
                        d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z"
                        clip-rule="evenodd" />
                </svg>
                كتابة قصة جديدة
            </a>
        </div>

        <div class="max-w-6xl mx-auto mb-6">
            <form method="GET" action="{{ route('stories.my-stories') }}"
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
                            <input type="text" name="search" value="{{ $searchQuery }}" placeholder="ابحث في قصصك"
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
                    يتم عرض <span class="text-indigo-600 dark:text-indigo-400 font-bold">{{ $myStories->count() }}</span> قصة من أرشيفك
                </div>







                @if ($myStories->isEmpty())
                    <div
                        class="bg-white dark:bg-gray-800 p-12 rounded-2xl shadow-md text-center border border-gray-100 dark:border-gray-700">
                        <svg class="w-16 h-16 mx-auto mb-4 text-gray-400" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 6.253v13m0-13C6.5 6.253 2 10.998 2 16.5S6.5 26.5 12 26.5s10-4.745 10-10.5S17.5 6.253 12 6.253z">
                            </path>
                        </svg>
                        <p class="text-lg font-semibold text-gray-700 dark:text-gray-300">لم تقم بكتابة أي قصص بعد</p>
                        <p class="mt-2 text-gray-600 dark:text-gray-400">شارك قصتك الأولى وأضفها إلى ذاكرة غزة</p>
                        <a href="{{ route('stories.create') }}"
                            class="mt-6 inline-flex items-center px-6 py-3 border border-transparent text-sm font-semibold rounded-lg shadow-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-900 transition">
                            <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4">
                                </path>
                            </svg>
                            ابدأ بكتابة قصتك الأولى
                        </a>
                    </div>
                @else
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        @foreach ($myStories as $story)
                            <div
                                class="bg-white dark:bg-gray-800 rounded-xl shadow-md overflow-hidden flex flex-col hover:shadow-xl transition-shadow duration-300">
                                <a href="{{ route('stories.show', $story->slug) }}" class="block relative overflow-hidden">
                                    <div
                                        class="w-full h-48 overflow-hidden bg-gradient-to-br from-gray-200 to-gray-300 dark:from-gray-700 dark:to-gray-800">
                                        @if ($story->cover_image)
                                            <img src="{{ asset('storage/' . $story->cover_image) }}" alt="غلاف القصة"
                                                class="w-full h-full object-cover hover:scale-110 transition-transform duration-300">
                                        @else
                                            <img src="{{ asset('assets/img/default-story-cover.png') }}" alt="غلاف افتراضي"
                                                class="w-full h-full object-cover hover:scale-110 transition-transform duration-300">
                                        @endif
                                    </div>
                                </a>
                                <div class="p-4 flex-grow flex flex-col">
                                    <a href="{{ route('stories.show', $story->slug) }}"
                                        class="hover:text-indigo-600 dark:hover:text-indigo-400 transition">
                                        <h3 class="text-xl font-bold text-gray-800 dark:text-gray-100 mb-2 line-clamp-2">
                                            {{ $story->title }}</h3>
                                    </a>
                                    <div class="mb-3">
                                        <span
                                            class="inline-block bg-indigo-100 dark:bg-indigo-900 text-indigo-800 dark:text-indigo-300 text-xs font-semibold px-3 py-1 rounded-full">
                                            {{ $story->type }}
                                        </span>
                                    </div>
                                    <p class="text-gray-700 dark:text-gray-400 text-sm mb-4 flex-grow line-clamp-2">
                                        {{ Str::limit($story->content, 100) }}</p>

                                    <div
                                        class="mt-auto flex justify-between items-center pt-4 border-t border-gray-100 dark:border-gray-700">
                                        <a href="{{ route('stories.show', $story->slug) }}"
                                            class="inline-flex items-center text-sm font-semibold text-indigo-600 dark:text-indigo-400 hover:text-indigo-800 dark:hover:text-indigo-300 transition">
                                            قراءة
                                            <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M9 5l7 7-7 7"></path>
                                            </svg>
                                        </a>
                                        <div class="flex space-x-2 rtl:space-x-reverse">
                                            <a href="{{ route('stories.edit', $story->slug) }}"
                                                class="p-2 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700 text-gray-500 dark:text-gray-400 hover:text-indigo-600 dark:hover:text-indigo-400 transition"
                                                title="تعديل">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                                    viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                                                    </path>
                                                </svg>
                                            </a>
                                            <form action="{{ route('stories.destroy', $story->slug) }}" method="POST"
                                                onsubmit="return confirm('هل أنت متأكد أنك تريد حذف هذه القصة؟')"
                                                class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    class="p-2 rounded-lg hover:bg-red-50 dark:hover:bg-red-900/20 text-gray-500 dark:text-gray-400 hover:text-red-600 dark:hover:text-red-400 transition"
                                                    title="حذف">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5"
                                                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                                                        </path>
                                                    </svg>
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
    </main>

@endsection
