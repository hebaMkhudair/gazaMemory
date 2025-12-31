<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>تعديل الملف الشخصي - ذاكرة غزة</title>
    {{-- استخدام @vite لربط ملفات CSS المجمعة بواسطة Vite --}}
    @vite('resources/css/app.css')
    <style>
        /* مثال لخط عربي */
        @import url('https://fonts.googleapis.com/css2?family=Cairo:wght@400;600;700&display=swap');

        body {
            font-family: 'Cairo', sans-serif;
        }
    </style>
</head>

{{-- إضافة x-data="{}" إلى body لضمان تهيئة Alpine.js بشكل صحيح على مستوى الصفحة --}}
<body class="bg-gray-100 min-h-screen flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8"
    x-data="{}">

    {{-- زر العودة للصفحة الرئيسية (الخيار 1: زر عائم) --}}
    <div class="fixed top-4 right-4 z-50">
        <a href="{{ url('dashboard') }}"
            class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 shadow-md transition ease-in-out duration-150">
            <svg class="h-5 w-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m0 0l7 7m-9 2v10a1 1 0 001 1h3"></path>
            </svg>
            العودة للرئيسية
        </a>
    </div>

    {{-- قسم المحتوى الرئيسي للبروفايل --}}
    <div class="md:w-1/2 p-8 md:p-12 space-y-8 flex flex-col justify-center">
        <div class="text-center">
            <div class="flex items-center justify-center mb-4">
                {{-- عرض صورة البروفايل الحالية للمستخدم --}}
                @if (Auth::user()->avatar)
                    <img src="{{ asset('storage/' . $user->avatar) }}" alt="User Avatar"
                        class="h-20 w-20 object-cover rounded-full border-2 border-blue-500">
                @else
                    <img src="{{ asset('storage/avatars/defaultAvatar.jpg') }}" alt="Default Avatar"
                        class="h-20 w-20 object-cover rounded-full border-2 border-blue-500">
                @endif
                <span class="text-2xl font-bold text-gray-900 mr-2">ملفي الشخصي</span>
            </div>
            <h2 class="mt-4 text-3xl font-extrabold text-gray-900">
                تعديل معلومات الحساب
            </h2>
            <p class="mt-2 text-sm text-gray-600">
                قم بتحديث معلومات ملفك الشخصي وعنوان بريدك الإلكتروني.
            </p>
        </div>

        {{-- رسالة حالة الجلسة (إذا كان هناك رسالة نجاح أو خطأ) --}}
        @if (session('status') === 'profile-updated')
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative text-sm mb-4"
                role="alert">
                <span class="block sm:inline">تم حفظ معلومات الملف الشخصي بنجاح.</span>
            </div>
        @endif
        @if (session('status') === 'password-updated')
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative text-sm mb-4"
                role="alert">
                <span class="block sm:inline">تم تحديث كلمة المرور بنجاح.</span>
            </div>
        @endif
        @if (session('status') === 'verification-link-sent')
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative text-sm mb-4"
                role="alert">
                <span class="block sm:inline">تم إرسال رابط تحقق جديد إلى عنوان بريدك الإلكتروني.</span>
            </div>
        @endif
        {{-- رسائل أخطاء التحقق العامة --}}
        @if ($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative text-sm mb-4"
                role="alert">
                <ul class="list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif


        {{-- ================================================================================= --}}
        {{-- قسم تحديث معلومات الملف الشخصي (دمج محتوى update-profile-information-form) --}}
        {{-- ================================================================================= --}}
        <section class="space-y-6 bg-gray-50 p-6 rounded-lg shadow-sm border border-gray-200">
            <header>
                <h2 class="text-lg font-medium text-gray-900">
                    تحديث معلومات الملف الشخصي
                </h2>
                <p class="mt-1 text-sm text-gray-600">
                    قم بتحديث معلومات ملفك الشخصي وعنوان بريدك الإلكتروني.
                </p>
            </header>

            <form id="send-verification" method="post" action="{{ route('verification.send') }}">
                @csrf
            </form>

            <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6"
                enctype="multipart/form-data">
                @csrf
                @method('patch')

                {{-- حقل الاسم --}}
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700 mb-1">الاسم</label>
                    <input id="name" name="name" type="text"
                        class="appearance-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-lg focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('name') border-red-500 @enderror"
                        value="{{ old('name', $user->name) }}" required autofocus autocomplete="name">
                    @error('name')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                {{-- حقل البريد الإلكتروني --}}
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-1">البريد الإلكتروني</label>
                    <input id="email" name="email" type="email"
                        class="appearance-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-lg focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('email') border-red-500 @enderror"
                        value="{{ old('email', $user->email) }}" required autocomplete="username">
                    @error('email')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror

                    @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && !$user->hasVerifiedEmail())
                        <div>
                            <p class="text-sm mt-2 text-gray-800">
                                عنوان بريدك الإلكتروني غير مؤكد.
                                <button form="send-verification"
                                    class="underline text-sm text-blue-600 hover:text-blue-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                    انقر هنا لإعادة إرسال بريد التحقق.
                                </button>
                            </p>
                        </div>
                    @endif
                </div>

                {{-- حقل الصورة الشخصية --}}
                <div>
                    <label for="avatar" class="block text-sm font-medium text-gray-700 mb-1">الصورة الشخصية</label>
                    <input type="file" id="avatar" name="avatar"
                        class="appearance-none relative block w-full px-3 py-2 border border-gray-300 text-gray-900 rounded-lg focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('avatar') border-red-500 @enderror">
                    <p class="mt-1 text-xs text-gray-500">صيغ مدعومة: JPG, PNG, GIF. الحجم الأقصى: 2MB. (اترك فارغاً
                        لعدم التغيير)</p>
                    @error('avatar')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                    {{-- عرض الصورة الحالية --}}
                    @if ($user->avatar)
                        <div class="mt-4 flex items-center">
                            <span class="text-sm text-gray-600 mr-2 p-3">الصورة الحالية:</span>
                            <img src="{{ asset('storage/' . $user->avatar) }}" alt="Current Avatar"
                                class="w-20 h-20 object-cover rounded-full border border-gray-300">
                            <button type="button" onclick="document.getElementById('delete_avatar_form').submit();"
                                class="ml-4 text-red-600 hover:text-red-800 text-sm p-3">
                                حذف الصورة
                            </button>
                        </div>
                    @endif
                </div>

                <div class="flex items-center gap-4">
                    <button type="submit"
                        class="group relative flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        حفظ
                    </button>
                    @if (session('status') === 'profile-updated')
                        <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)"
                            class="text-sm text-gray-600">تم الحفظ.</p>
                    @endif
                </div>
            </form>
        </section>

        {{-- ================================================================================= --}}
        {{-- قسم تحديث كلمة المرور (دمج محتوى update-password-form) --}}
        {{-- ================================================================================= --}}
        <section class="space-y-6 bg-gray-50 p-6 rounded-lg shadow-sm border border-gray-200">
            <header>
                <h2 class="text-lg font-medium text-gray-900">
                    تحديث كلمة المرور
                </h2>
                <p class="mt-1 text-sm text-gray-600">
                    تأكد من أن حسابك يستخدم كلمة مرور طويلة وعشوائية ليبقى آمنًا.
                </p>
            </header>

            <form method="post" action="{{ route('password.update') }}" class="mt-6 space-y-6">
                @csrf
                @method('put')

                <div>
                    <label for="update_password_current_password"
                        class="block text-sm font-medium text-gray-700 mb-1">كلمة المرور الحالية</label>
                    <input id="update_password_current_password" name="current_password" type="password"
                        class="appearance-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-lg focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('current_password', 'updatePassword') border-red-500 @enderror"
                        autocomplete="current-password">
                    @error('current_password', 'updatePassword')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="update_password_password" class="block text-sm font-medium text-gray-700 mb-1">كلمة
                        المرور الجديدة</label>
                    <input id="update_password_password" name="password" type="password"
                        class="appearance-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-lg focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('password', 'updatePassword') border-red-500 @enderror"
                        autocomplete="new-password">
                    @error('password', 'updatePassword')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="update_password_password_confirmation"
                        class="block text-sm font-medium text-gray-700 mb-1">تأكيد كلمة المرور</label>
                    <input id="update_password_password_confirmation" name="password_confirmation" type="password"
                        class="appearance-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-lg focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('password_confirmation', 'updatePassword') border-red-500 @enderror"
                        autocomplete="new-password">
                    @error('password_confirmation', 'updatePassword')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex items-center gap-4">
                    <button type="submit"
                        class="group relative flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        حفظ
                    </button>
                    {{-- رسالة "Saved." --}}
                    @if (session('status') === 'password-updated')
                        <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)"
                            class="text-sm text-gray-600">تم الحفظ.</p>
                    @endif
                </div>
            </form>
        </section>

        {{-- ================================================================================= --}}
        {{-- قسم تسجيل الخروج --}}
        {{-- ================================================================================= --}}
        <section class="space-y-6 bg-blue-50 dark:bg-blue-900/20 p-6 rounded-lg shadow-sm border border-blue-200 dark:border-blue-700">
            <header>
                <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                    تسجيل الخروج
                </h2>
                <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                    قم بتسجيل الخروج من حسابك بأمان.
                </p>
            </header>

            <form method="POST" action="{{ route('logout') }}" class="space-y-4">
                @csrf

                <p class="text-sm text-gray-600 dark:text-gray-400">
                    سيتم تسجيل خروجك من حسابك وستعود إلى الصفحة الرئيسية.
                </p>

                <div class="flex items-center gap-4">
                    <button type="submit"
                        class="group relative flex justify-center py-2 px-6 border border-transparent text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 dark:bg-blue-600 dark:hover:bg-blue-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 dark:focus:ring-offset-gray-900 transition ease-in-out duration-150">
                        تسجيل الخروج
                    </button>
                </div>
            </form>
        </section>

        {{-- ================================================================================= --}}
        {{-- قسم حذف الحساب (دمج محتوى delete-user-form) --}}
        {{-- ================================================================================= --}}
        <section class="space-y-6 bg-gray-50 p-6 rounded-lg shadow-sm border border-gray-200">
            <header>
                <h2 class="text-lg font-medium text-gray-900">
                    حذف الحساب
                </h2>
                <p class="mt-1 text-sm text-gray-600">
                    بمجرد حذف حسابك، سيتم حذف جميع موارده وبياناته بشكل دائم. قبل حذف حسابك، يرجى تنزيل أي بيانات أو
                    معلومات ترغب في الاحتفاظ بها.
                </p>
            </header>

            {{-- هذا هو الـ div الرئيسي الذي يحتوي على زر الفتح والـ Modal --}}
            <div x-data="{ showDeleteModal: false }">
                {{-- الزر الذي سيفتح الـ Modal --}}
                <button type="button" x-on:click.prevent="showDeleteModal = true"
                    class="inline-flex items-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-700 focus:bg-red-700 active:bg-red-900 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition ease-in-out duration-150">
                    حذف الحساب
                </button>

                {{-- Modal لحذف الحساب --}}
                <div x-show="showDeleteModal" x-on:click.self="showDeleteModal = false"
                    x-transition:enter="ease-out duration-300"
                    x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                    x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                    x-transition:leave="ease-in duration-200"
                    x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                    x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                    class="fixed inset-0 z-50 overflow-y-auto flex items-center justify-center">

                    {{-- خلفية Modal --}}
                    <div class="fixed inset-0 transition-opacity bg-gray-500 bg-opacity-75" aria-hidden="true"></div>

                    {{-- محتوى Modal --}}
                    <div
                        class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                        <form method="post" action="{{ route('profile.destroy') }}" class="p-6">
                            @csrf
                            @method('delete')

                            <h2 class="text-lg font-medium text-gray-900">
                                هل أنت متأكد أنك تريد حذف حسابك؟
                            </h2>

                            <p class="mt-1 text-sm text-gray-600">
                                بمجرد حذف حسابك، سيتم حذف جميع موارده وبياناته بشكل دائم. يرجى إدخال كلمة المرور الخاصة
                                بك لتأكيد رغبتك في حذف حسابك بشكل دائم.
                            </p>

                            <div class="mt-6">
                                <label for="password_delete" class="sr-only">كلمة المرور</label>
                                <input id="password_delete" name="password" type="password"
                                    class="mt-1 block w-3/4 appearance-none relative block px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-lg focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('password', 'userDeletion') border-red-500 @enderror"
                                    placeholder="كلمة المرور" />
                                @error('password', 'userDeletion')
                                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="mt-6 flex justify-end">
                                <button type="button" x-on:click="showDeleteModal = false"
                                    class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:opacity-25 transition ease-in-out duration-150">
                                    إلغاء
                                </button>

                                <button type="submit"
                                    class="ms-3 inline-flex items-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-700 focus:bg-red-700 active:bg-red-900 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                    حذف الحساب
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>

        {{-- فورم مخفي لحذف الصورة الشخصية --}}
        <form id="delete_avatar_form" method="POST" action="{{ route('profile.delete-avatar') }}"
            style="display: none;">
            @csrf
            @method('delete')
        </form>

    </div>
</body>

{{-- هذا الجزء مهم جداً: تأكد أن ملف app.js يتم تحميله هنا --}}
@vite('resources/js/app.js')

</html>