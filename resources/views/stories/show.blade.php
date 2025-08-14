@extends('layouts.app')
@section('title', 'قصصي - ذاكرة غزة')
@section('content')

    <main class="flex-grow container mx-auto px-4 py-8 flex justify-center">
        <div class="w-full max-w-3xl bg-white p-8 rounded-lg shadow-md">
            <h1 class="text-4xl font-extrabold text-gray-900 mb-4 text-center">{{ $story->title }}</h1>

            <div class="text-center text-gray-600 mb-6">
                بواسطة <span class="font-semibold">{{ $story->user->name }}</span>
                <span class="mx-2">|</span>
                القسم: <span class="font-semibold">{{ $story->type }}</span>
                <span class="mx-2">|</span>
                نشرت بتاريخ: <span class="font-semibold">{{ $story->published_at->format('Y-m-d') }}</span>
            </div>

            @if($story->cover_image)
                <div class="mb-8 overflow-hidden rounded-lg shadow-lg">
                    <img src="{{ asset('storage/' . $story->cover_image) }}" alt="صورة غلاف القصة" class="w-full h-96 object-cover object-center">
                </div>
            @endif

            <div class="prose prose-lg text-gray-800 leading-relaxed mb-8">
                {{-- لعرض المحتوى مع الحفاظ على تنسيقات HTML إن وجدت --}}
                {!! nl2br(e($story->content)) !!}
            </div>

            {{-- ================================================= --}}
            {{-- أزرار التعديل والحذف (تظهر فقط لمالك القصة) --}}
            {{-- ================================================= --}}
            @auth {{-- تأكد أن المستخدم مسجل الدخول أولاً --}}
                @if (Auth::id() === $story->user_id) {{-- تحقق مما إذا كان ID المستخدم الحالي هو نفسه user_id للقصة --}}
                    <div class="mt-8 pt-4 border-t border-gray-200 flex justify-end space-x-4 space-x-reverse">
                        {{-- زر التعديل --}}
                        <a href="{{ route('stories.edit', $story->slug) }}" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 shadow-sm transition ease-in-out duration-150">
                            <svg class="h-5 w-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                            تعديل القصة
                        </a>

                        {{-- زر الحذف (يجب أن يكون نموذج POST/DELETE) --}}
                        <form action="{{ route('stories.destroy', $story->slug) }}" method="POST" onsubmit="return confirm('هل أنت متأكد أنك تريد حذف هذه القصة؟ لا يمكن التراجع عن هذا الإجراء.');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 shadow-sm transition ease-in-out duration-150">
                                <svg class="h-5 w-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                حذف القصة
                            </button>
                        </form>
                    </div>
                @endif
            @endauth

            <div class="mt-8 pt-4 border-t border-gray-200 text-gray-700">
                <p class="text-sm">
                    هذه القصة مقدمة من المستخدم: <span class="font-semibold">{{ $story->user->name }}</span>.
                </p>
            </div>
        </div>
    </main>

@endsection