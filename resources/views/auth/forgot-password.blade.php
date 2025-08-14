<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>نسيت كلمة المرور - ذاكرة غزة</title>
    {{-- استخدام @vite لربط ملفات CSS المجمعة بواسطة Vite --}}
    @vite('resources/css/app.css')
    <style>
        /* مثال لخط عربي */
        @import url('https://fonts.googleapis.com/css2?family=Cairo:wght@400;600;700&display=swap');
        body {
            font-family: 'Cairo', sans-serif;
        }
        /* لتطبيق الصورة كخلفية لـ div */
        .auth-image-bg {
            background-image: url("{{ asset('assets/img/child.jpg') }}");
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
        }
    </style>
</head>
<body class="bg-gray-100 min-h-screen flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-md w-full bg-white rounded-xl shadow-lg overflow-hidden md:max-w-4xl flex flex-col md:flex-row-reverse">
        {{-- قسم الصورة الجانبية --}}
        {{-- استبدال img بـ div مع خلفية، وتحديد ارتفاع معين للموبايل وللشاشات الكبيرة --}}
        {{-- تم إضافة 'h-64' للموبايل و 'md:h-auto' (لتأخذ ارتفاع الـ flexbox في الشاشات الكبيرة) --}}
        <div class="md:w-1/2 h-64 md:h-auto auth-image-bg bg-blue-500 hidden md:flex items-center justify-center p-6 relative">
            {{-- الصورة أصبحت خلفية للـ div، لذا لا حاجة لـ img tag هنا --}}
            <div class="absolute inset-0 bg-gradient-to-t from-blue-600 to-transparent opacity-50"></div>
        </div>

        {{-- قسم النموذج (الفورم) --}}
        <div class="md:w-1/2 p-8 md:p-12 space-y-8 flex flex-col justify-center">
            <div class="text-center">
                <div class="flex items-center justify-center mb-4">
                    {{-- لا زلنا نستخدم الصورة هنا للشعار --}}
                    <img src="{{ asset('assets/img/child.jpg') }}" alt="Logo" class="h-10 w-auto rounded-full">
                    <span class="text-2xl font-bold text-gray-900 mr-2">ذاكرة غزة</span>
                </div>
                <h2 class="mt-4 text-3xl font-extrabold text-gray-900">
                    نسيت كلمة المرور؟
                </h2>
                <p class="mt-2 text-sm text-gray-600">
                    أدخل بريدك الإلكتروني وسنرسل لك رابط لإعادة تعيين كلمة المرور.
                </p>
            </div>

            {{-- رسالة حالة الجلسة (إذا كان هناك رسالة نجاح أو خطأ) --}}
            @if (session('status'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative text-sm" role="alert">
                    <span class="block sm:inline">{{ session('status') }}</span>
                </div>
            @endif

            <form class="mt-8 space-y-6" method="POST" action="{{ route('password.email') }}">
                @csrf

                {{-- حقل البريد الإلكتروني --}}
                <div>
                    <label for="email" class="sr-only">البريد الإلكتروني</label>
                    <input id="email" name="email" type="email" autocomplete="email" required autofocus
                           class="appearance-none relative block w-full px-3 py-3 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-lg focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('email') border-red-500 @enderror"
                           placeholder="البريد الإلكتروني" value="{{ old('email') }}">
                    @error('email')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                {{-- زر إرسال الرابط --}}
                <div>
                    <button type="submit"
                            class="group relative w-full flex justify-center py-3 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        إرسال رابط إعادة تعيين كلمة المرور
                    </button>
                </div>
            </form>

            {{-- رابط العودة لتسجيل الدخول (اختياري) --}}
            <div class="text-center text-sm mt-6">
                <p class="text-gray-600">
                    <a href="{{ route('login') }}" class="font-medium text-blue-600 hover:text-blue-500">
                        العودة لتسجيل الدخول
                    </a>
                </p>
            </div>
        </div>
    </div>
</body>
</html>