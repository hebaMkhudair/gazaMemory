@extends('layouts.app')
@section('title', 'إنشاء قصة جديدة - ذاكرة غزة') {{-- يفضل تغيير العنوان ليكون أكثر دقة --}}
@section('content')
    <main class="flex-grow container mx-auto px-4 py-8 mt-20 flex justify-center items-start">
        <div class="w-full max-w-2xl bg-white dark:bg-gray-800 p-6 rounded-lg shadow-md">
            <h1 class="text-2xl sm:text-3xl font-bold mb-6 text-gray-900 dark:text-gray-100 text-center">إنشاء قصة جديدة</h1>

            <form action="{{ route('stories.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    {{-- Book Name (عنوان القصة) --}}
                    <div>
                        <label for="title" class="block text-sm font-medium text-gray-700 dark:text-gray-300">عنوان القصة <span
                                class="text-red-500">*</span></label>
                        <input type="text" name="title" id="title"
                            class="mt-1 block w-full border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-100 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm p-2"
                            required value="{{ old('title') }}">
                        @error('title')
                            <p class="text-red-500 dark:text-red-400 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Section (قسم/نوع القصة) --}}
                    <div>
                        <label for="type" class="block text-sm font-medium text-gray-700 dark:text-gray-300">القسم / النوع <span
                                class="text-red-500">*</span></label>
                        <select name="type" id="type"
                            class="mt-1 block w-full border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-100 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm p-2"
                            required>
                            <option value="">اختر القسم</option>
                            {{-- **هنا التعديل الرئيسي: توحيد الخيارات** --}}
                            <option value="معاناة" {{ old('type') == 'معاناة' ? 'selected' : '' }}>معاناة</option>
                            <option value="صمود" {{ old('type') == 'صمود' ? 'selected' : '' }}>صمود</option>
                            <option value="أمل" {{ old('type') == 'أمل' ? 'selected' : '' }}>أمل</option>
                            <option value="تحدي" {{ old('type') == 'تحدي' ? 'selected' : '' }}>تحدي</option>
                            <option value="تحدي" {{ old('type') == 'تراث' ? 'selected' : '' }}>تراث</option>
                            {{-- إذا أضفت "تكافل" أو أي نوع آخر، يجب أن يكون موجودًا هنا أيضاً وفي الكنترولرات الأخرى --}}
                            {{-- <option value="تكافل" {{ old('type') == 'تكافل' ? 'selected' : '' }}>تكافل</option> --}}
                        </select>
                        @error('type')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    {{-- Full Name (اسم المستخدم الحالي، للقراءة فقط) --}}
                    <div>
                        <label for="author_name" class="block text-sm font-medium text-gray-700 dark:text-gray-300">الاسم الكامل</label>
                        <input type="text" id="author_name"
                            class="mt-1 block w-full border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-100 rounded-md shadow-sm bg-gray-100 dark:bg-gray-600 sm:text-sm p-2"
                            value="{{ Auth::user()->name }}" disabled>
                        <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">سيتم حفظ قصتك باسمك المسجل.</p>
                    </div>

                    {{-- Cover Image (صورة الغلاف) --}}
                    <div>
                        <label for="cover_image" class="block text-sm font-medium text-gray-700 dark:text-gray-300">صورة الغلاف</label>
                        <input type="file" name="cover_image" id="cover_image"
                            class="mt-1 block w-full text-sm text-gray-900 dark:text-gray-100 border border-gray-300 dark:border-gray-600 rounded-lg cursor-pointer bg-gray-50 dark:bg-gray-700 focus:outline-none p-2">
                        @error('cover_image')
                            <p class="text-red-500 dark:text-red-400 text-xs mt-1">{{ $message }}</p>
                        @enderror
                        <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">بصيغ: JPG, PNG, GIF (الحد الأقصى 2MB)</p>
                    </div>
                </div>

                {{-- Write your book (محتوى القصة) --}}
                <div>
                    <label for="content" class="block text-sm font-medium text-gray-700 dark:text-gray-300">محتوى القصة <span
                            class="text-red-500">*</span></label>
                    <textarea name="content" id="content" rows="10"
                        class="mt-1 block w-full border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-100 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm p-2"
                        required>{{ old('content') }}</textarea>
                    @error('content')
                        <p class="text-red-500 dark:text-red-400 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex justify-end">
                    <button type="submit"
                        class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 dark:bg-indigo-600 dark:hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        إنشاء القصة
                    </button>
                </div>
            </form>
        </div>
    </main>
@endsection