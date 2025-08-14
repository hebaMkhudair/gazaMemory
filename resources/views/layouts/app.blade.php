<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'ذاكرة غزة')</title> {{-- هذا يسمح بتحديد عنوان خاص لكل صفحة --}}
    {{-- بما أنك تستخدم Vite لـ CSS في صفحة البروفايل، فمن الأفضل استخدامه هنا أيضاً لتوحيد العملية --}}
    {{-- إذا كنت تستخدم TailwindCSS فقط عبر CDN (كما هو موجود حالياً)، فاتركه كما هو --}}
    {{-- لكن الطريقة الأفضل للمشاريع الكبيرة هي استخدام Vite لـ CSS أيضاً --}}
    {{-- <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2/dist/tailwind.min.css" rel="stylesheet"> --}}
    
    {{-- هنا يجب أن تضع @vite لملفات CSS إذا كنت تستخدمه بشكل عام في المشروع --}}
    @vite('resources/css/app.css') 

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Cairo:wght@400;600;700&display=swap');
        body {
            font-family: 'Cairo', sans-serif;
        }
        .text-nude {
            color: #ffbf84; /* هذا هو اللون النود. تقدري تغيريه لو بدك درجة تانية */
        }
        .nude{
            color: #ffbf84;
        }
    </style>
    @yield('styles') {{-- لتمكين إضافة CSS خاص بالصفحة --}}
</head>
<body class="bg-gray-100 font-sans antialiased min-h-screen flex flex-col">

    @include('partials.header')

    <main class="flex-grow container mx-auto px-4 py-8">
        @yield('content') {{-- هذا هو المكان الذي سيتم فيه عرض محتوى كل صفحة --}}
    </main>

    {{-- @include('partials.footer') --}}

    {{-- *************************************************************** --}}
    {{-- هذا هو السطر الحاسم الذي يجب إضافته لتحميل JavaScript و Alpine.js --}}
    @vite('resources/js/app.js') 
    {{-- *************************************************************** --}}

    @yield('scripts') {{-- لتمكين إضافة JavaScript خاص بالصفحة --}}
</body>
</html>