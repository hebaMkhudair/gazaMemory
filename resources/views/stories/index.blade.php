@extends('layouts.app')

@section('title', $currentSectionName . ' - ذاكرة غزة')

@section('content')
    <main class="flex-grow container mx-auto px-4 py-8">
        <h1 class="text-3xl font-bold mb-8 text-gray-800 text-center">
            @if ($currentSectionName == 'جميع القصص')
                جميع القصص
            @else
                قصص نوع: <span class="text-indigo-500">{{ $currentSectionName }}</span>
            @endif
        </h1>

        @if ($stories->isEmpty())
            <div class="bg-white p-6 rounded-lg shadow-md text-center text-gray-600">
                <p class="text-lg">لا توجد قصص في هذا القسم حالياً.</p>
                <p class="mt-2">كن أول من يشارك قصة من نوع {{ $currentSectionName }}!</p>
                <a href="{{ route('stories.create') }}" class="mt-4 inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                    أضف قصتك الآن
                </a>
            </div>
        @else
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                @foreach ($stories as $story)
                    <div class="bg-white rounded-lg shadow-md overflow-hidden flex flex-col">
                        <a href="{{ route('stories.show', $story->slug) }}" class="block">
                            <div class="w-full h-48 overflow-hidden bg-gray-200">
                                @if ($story->cover_image)
                                    <img src="{{ asset('storage/' . $story->cover_image) }}" alt="{{ $story->title }}"
                                        class="w-full h-full object-cover">
                                @else
                                    <img src="{{ asset('assets/img/default-story-cover.png') }}" alt="صورة غلاف افتراضية"
                                        class="w-full h-full object-cover">
                                @endif
                            </div>
                            <div class="p-4 flex-grow flex flex-col justify-between">
                                <div>
                                    <h3 class="text-lg font-semibold text-gray-800 mb-2 truncate">{{ $story->title }}</h3>
                                    <p class="text-gray-600 text-sm mb-3 line-clamp-3">{{ Str::limit($story->content, 100) }}</p>
                                </div>
                                <div class="mt-auto">
                                    <p class="text-gray-500 text-xs">بواسطة: {{ $story->user->name ?? 'كاتب غير معروف' }}</p>
                                    <p class="text-gray-500 text-xs mt-1">القسم: {{ $story->type ?? 'غير محدد' }}</p>
                                    <p class="text-gray-500 text-xs mt-1">تاريخ النشر: {{ $story->published_at->format('Y-m-d') }}</p>
                                </div>
                            </div>
                        </a>
                        <div class="p-4 bg-gray-50 border-t border-gray-100 flex justify-end">
                            <a href="{{ route('stories.show', $story->slug) }}"
                                class="text-blue-600 hover:text-blue-800 text-sm font-medium">قراءة المزيد &rarr;</a>
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