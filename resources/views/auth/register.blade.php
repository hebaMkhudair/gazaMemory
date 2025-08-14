<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>تسجيل حساب جديد - ذاكرة غزة</title>
    {{-- استخدام @vite لربط ملفات CSS المجمعة بواسطة Vite --}}
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2/dist/tailwind.min.css" rel="stylesheet">
    <style>
        /* مثال لخط عربي */
        @import url('https://fonts.googleapis.com/css2?family=Cairo:wght@400;600;700&display=swap');

        body {
            font-family: 'Cairo', sans-serif;
        }
    </style>
</head>

<body class="bg-gray-100 min-h-screen flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
    <div class="bg-white rounded-xl shadow-lg p-8 md:p-12 space-y-8 w-full max-w-md">
        <div class="text-center">
            <div class="flex items-center justify-center mb-4">
                <img src="{{ asset('assets/img/gazaMemory.png') }}" alt="Logo" class="h-20 w-20 rounded-full mr-2">
                <span class="text-2xl font-bold text-gray-900 p-1">ذاكرة غزة</span>
            </div>
            <h2 class="mt-4 text-3xl font-extrabold text-gray-900">
                أهلاً بك في ذاكرة غزة
            </h2>
            <p class="mt-2 text-sm text-gray-600">
                سجّل لكي تستمر
            </p>
        </div>

        {{-- إضافة enctype="multipart/form-data" لكي تتمكن الفورم من رفع الملفات --}}
        <form class="mt-8 space-y-6" action="{{ route('register') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div>
                <label for="name" class="sr-only">الاسم</label>
                <input id="name" name="name" type="text" autocomplete="name" required
                    class="appearance-none relative block w-full px-3 py-3 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-lg focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('name') border-red-500 @enderror"
                    placeholder="الاسم الكامل" value="{{ old('name') }}">
                @error('name')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="email" class="sr-only">البريد الإلكتروني</label>
                <input id="email" name="email" type="email" autocomplete="email" required
                    class="appearance-none relative block w-full px-3 py-3 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-lg focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('email') border-red-500 @enderror"
                    placeholder="البريد الإلكتروني" value="{{ old('email') }}">
                @error('email')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="password" class="sr-only">كلمة المرور</label>
                <input id="password" name="password" type="password" autocomplete="new-password" required
                    class="appearance-none relative block w-full px-3 py-3 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-lg focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('password') border-red-500 @enderror"
                    placeholder="كلمة المرور">
                @error('password')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="password_confirmation" class="sr-only">تأكيد كلمة المرور</label>
                <input id="password_confirmation" name="password_confirmation" type="password"
                    autocomplete="new-password" required
                    class="appearance-none relative block w-full px-3 py-3 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-lg focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                    placeholder="تأكيد كلمة المرور">
            </div>

            <div>
                <label for="avatar" class="block text-sm font-medium text-gray-700 mb-1">الصورة الشخصية
                    (اختياري)</label>
                <input id="avatar" name="avatar" type="file"
                    class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 focus:outline-none @error('avatar') border-red-500 @enderror">
                <p class="mt-1 text-xs text-gray-500">صيغ مدعومة: JPG, PNG, GIF. الحجم الأقصى: 2MB.</p>
                @error('avatar')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <button type="submit"
                    class="group relative w-full flex justify-center py-3 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                    تسجيل
                </button>
            </div>
        </form>

        <div class="text-center text-sm mt-6">
            <p class="text-gray-600">
                هل لديك حساب بالفعل؟
                <a href="{{ route('login') }}" class="font-medium text-blue-600 hover:text-blue-500">
                    سجل الدخول هنا
                </a>
            </p>
        </div>
    </div>
</body>

</html>
