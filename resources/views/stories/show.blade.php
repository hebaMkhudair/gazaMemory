@extends('layouts.app')
@section('title', 'قصصي - ذاكرة غزة')
@section('content')

    <main class="flex-grow container mx-auto px-4 py-8 flex justify-center">
        <div class="w-full max-w-3xl">
            {{-- Story Content Card --}}
            <div class="bg-white dark:bg-gray-800 p-8 rounded-lg shadow-md mb-8">
                <h1 class="text-4xl font-extrabold text-gray-900 dark:text-gray-100 mb-4 text-center">{{ $story->title }}</h1>

                <div class="text-center text-gray-600 dark:text-gray-400 mb-6">
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

                <div class="prose dark:prose-invert prose-lg text-gray-800 dark:text-gray-200 leading-relaxed mb-8">
                    {{-- لعرض المحتوى مع الحفاظ على تنسيقات HTML إن وجدت --}}
                    {!! nl2br(e($story->content)) !!}
                </div>

                {{-- ================================================= --}}
                {{-- أزرار التعديل والحذف (تظهر فقط لمالك القصة) --}}
                {{-- ================================================= --}}
                @auth {{-- تأكد أن المستخدم مسجل الدخول أولاً --}}
                    @if (Auth::id() === $story->user_id) {{-- تحقق مما إذا كان ID المستخدم الحالي هو نفسه user_id للقصة --}}
                        <div class="mt-8 pt-4 border-t border-gray-200 dark:border-gray-700 flex justify-end space-x-4 space-x-reverse">
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

                <div class="mt-8 pt-4 border-t border-gray-200 dark:border-gray-700 text-gray-700 dark:text-gray-300">
                    <p class="text-sm">
                        هذه القصة مقدمة من المستخدم: <span class="font-semibold">{{ $story->user->name }}</span>.
                    </p>
                </div>
            </div>

            {{-- Comments Section --}}
            <div class="bg-white dark:bg-gray-800 p-8 rounded-lg shadow-md">
                <h2 class="text-2xl font-bold text-gray-900 dark:text-gray-100 mb-6">
                    التعليقات ({{ $story->comments->count() }})
                </h2>

                {{-- Comment Form --}}
                @auth
                    <form action="{{ route('comments.store', $story) }}" method="POST" class="mb-8 pb-8 border-b border-gray-200 dark:border-gray-700">
                        @csrf
                        <div class="space-y-4">
                            <div>
                                <label for="content" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                    أضف تعليقك
                                </label>
                                <textarea
                                    id="content"
                                    name="content"
                                    rows="4"
                                    class="block w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg shadow-sm text-gray-900 dark:text-gray-100 dark:bg-gray-700 placeholder-gray-500 dark:placeholder-gray-400 focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                                    placeholder="شارك رأيك وتعليقك على القصة..."
                                    required
                                ></textarea>
                                @error('content')
                                    <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                                @enderror
                            </div>
                            <button
                                type="submit"
                                class="inline-flex items-center px-6 py-2 bg-blue-600 text-white font-semibold rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition ease-in-out duration-150"
                            >
                                أرسل التعليق
                            </button>
                        </div>
                    </form>
                @else
                    <div class="mb-8 pb-8 border-b border-gray-200 dark:border-gray-700 bg-blue-50 dark:bg-blue-900/20 p-4 rounded-lg">
                        <p class="text-gray-700 dark:text-gray-300 mb-3">
                            يجب عليك <a href="{{ route('login') }}" class="text-blue-600 dark:text-blue-400 hover:underline font-semibold">تسجيل الدخول</a> لإضافة تعليق.
                        </p>
                    </div>
                @endauth

                {{-- Comments List --}}
                @if ($story->comments->isNotEmpty())
                    <div class="space-y-6">
                        @foreach ($story->comments as $comment)
                            <div class="bg-gray-50 dark:bg-gray-700 p-4 rounded-lg">
                                <div class="flex items-start justify-between mb-2">
                                    <div class="flex items-center gap-3">
                                        <div class="w-10 h-10 rounded-full overflow-hidden bg-gray-300 dark:bg-gray-600 flex items-center justify-center">
                                            @if ($comment->user->avatar)
                                                <img src="{{ asset('storage/' . $comment->user->avatar) }}" alt="User Avatar" class="w-full h-full object-cover">
                                            @else
                                                <span class="text-gray-600 dark:text-gray-300 font-bold">{{ substr($comment->user->name, 0, 1) }}</span>
                                            @endif
                                        </div>
                                        <div>
                                            <p class="font-semibold text-gray-900 dark:text-gray-100">{{ $comment->user->name }}</p>
                                            <p class="text-xs text-gray-500 dark:text-gray-400">{{ $comment->created_at->format('Y-m-d H:i') }}</p>
                                        </div>
                                    </div>

                                    {{-- Delete Comment Button --}}
                                    @auth
                                        @if (Auth::id() === $comment->user_id || Auth::id() === $story->user_id)
                                            <form action="{{ route('comments.destroy', $comment) }}" method="POST" class="inline-block" onsubmit="return confirm('هل أنت متأكد أنك تريد حذف هذا التعليق؟');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-600 dark:text-red-400 hover:text-red-700 dark:hover:text-red-300 text-sm font-medium transition">
                                                    حذف
                                                </button>
                                            </form>
                                        @endif
                                    @endauth
                                </div>
                                <p class="text-gray-700 dark:text-gray-300 leading-relaxed">
                                    {{ $comment->content }}
                                </p>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="text-center py-8">
                        <p class="text-gray-600 dark:text-gray-400">
                            لا توجد تعليقات حالياً. كن أول من يعلق على هذه القصة!
                        </p>
                    </div>
                @endif
            </div>
        </div>
    </main>

@endsection