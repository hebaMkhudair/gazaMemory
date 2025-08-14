<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>تسجيل الدخول - ذاكرة غزة</title>
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
                أهلاً بعودتك!
            </h2>
            <p class="mt-2 text-sm text-gray-600">
                سجّل الدخول للمتابعة
            </p>
        </div>

        <form class="mt-8 space-y-6" action="{{ route('login') }}" method="POST">
            @csrf

            <div>
                <label for="email" class="sr-only">البريد الإلكتروني</label>
                <input id="email" name="email" type="email" autocomplete="email" required autofocus
                       class="appearance-none relative block w-full px-3 py-3 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-lg focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('email') border-red-500 @enderror"
                       placeholder="البريد الإلكتروني" value="{{ old('email') }}">
                @error('email')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="password" class="sr-only">كلمة المرور</label>
                <input id="password" name="password" type="password" autocomplete="current-password" required
                       class="appearance-none relative block w-full px-3 py-3 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-lg focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('password') border-red-500 @enderror"
                       placeholder="كلمة المرور">
                @error('password')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex items-center justify-between">
                <div class="flex items-center">
                    <input id="remember_me" name="remember" type="checkbox"
                           class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                    <label for="remember_me" class="mr-2 block text-sm text-gray-900">
                        تذكرني
                    </label>
                </div>

                {{-- @if (Route::has('password.request'))
                    <div class="text-sm">
                        <a href="{{ route('password.request') }}" class="font-medium text-blue-600 hover:text-blue-500">
                            هل نسيت كلمة المرور؟
                        </a>
                    </div>
                @endif --}}
            </div>

            <div>
                <button type="submit"
                        class="group relative w-full flex justify-center py-3 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                    تسجيل الدخول
                </button>
            </div>
        </form>

        <div class="text-center text-sm mt-6">
            <p class="text-gray-600">
                مستخدم جديد؟
                <a href="{{ route('register') }}" class="font-medium text-blue-600 hover:text-blue-500">
                    سجل حساب جديد
                </a>
            </p>
        </div>
    </div>
</body>
</html>