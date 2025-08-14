@extends('layouts.app')
@section('title', 'قصصي - ذاكرة غزة')
@section('content')

    <main class="flex-grow container mx-auto px-4 py-8">
        <h1 class="text-3xl font-bold mb-6 text-gray-800 text-center">قصصي التي كتبتها</h1>

        @if($myStories->isEmpty())
            <div class="bg-white p-6 rounded-lg shadow-md text-center">
                <p class="text-gray-600 text-lg mb-4">لم تقم بكتابة أي قصص بعد.</p>
                <a href="{{ route('stories.create') }}" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                    ابدأ بكتابة قصتك الأولى!
                </a>
            </div>
        @else
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($myStories as $story)
                    <div class="bg-white rounded-lg shadow-md overflow-hidden flex flex-col">
                        @if($story->cover_image)
                            <img src="{{ asset('storage/' . $story->cover_image) }}" alt="غلاف القصة" class="w-full h-48 object-cover">
                        @else
                            <img src="{{ asset('assets/img/default-story-cover.png') }}" alt="غلاف افتراضي" class="w-full h-48 object-cover">
                            {{-- تأكد من وجود صورة افتراضية في هذا المسار إذا لم يكن هناك غلاف --}}
                        @endif
                        <div class="p-4 flex-grow flex flex-col">
                            <h3 class="text-xl font-semibold text-gray-800 mb-2">
                                <a href="{{ route('stories.show', $story->slug) }}" class="hover:text-blue-600">{{ $story->title }}</a>
                            </h3>
                            <p class="text-gray-600 text-sm mb-3">النوع: {{ $story->type }}</p>
                            <p class="text-gray-700 text-base mb-4 flex-grow">{{ Str::limit($story->content, 100) }}</p>

                            <div class="mt-auto flex justify-between items-center pt-3 border-t border-gray-100">
                                <a href="{{ route('stories.show', $story->slug) }}" class="inline-flex items-center text-sm font-medium text-blue-600 hover:text-blue-700">
                                    قراءة القصة &rarr;
                                </a>
                                <div class="flex space-x-2 rtl:space-x-reverse">
                                    <a href="{{ route('stories.edit', $story->slug) }}" class="p-2 rounded-full hover:bg-gray-100 text-gray-500">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                                    </a>
                                    <form action="{{ route('stories.destroy', $story->slug) }}" method="POST" onsubmit="return confirm('هل أنت متأكد أنك تريد حذف هذه القصة؟')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="p-2 rounded-full hover:bg-gray-100 text-red-500">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
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