<header class="fixed top-0 right-0 left-0 bg-white dark:bg-gray-800 p-4 shadow-md z-40 w-full border-b border-gray-100 dark:border-gray-700"> {{-- تم إضافة 'fixed top-0 right-0 left-0 z-40 w-full' --}}
    <div class="container mx-auto flex items-center justify-between">
        <div class="flex items-center space-x-3 space-x-reverse"> {{-- إضافة space-x-reverse لمراعاة RTL --}}
            <div class="w-12 h-12 rounded-full overflow-hidden bg-gray-200 dark:bg-gray-700 flex items-center justify-center">
                {{-- شعار الموقع --}}
                <img src="{{ asset('assets/img/gazaMemory.png') }}" alt="Logo" class="w-full h-full object-cover">
            </div>
            <a href="{{ route('home') }}" class="text-xl font-semibold text-gray-800 dark:text-gray-100 hover:text-blue-600 dark:hover:text-blue-400 transition">ذاكرة غزة</a>
            @auth
                <a href="{{ route('dashboard') }}" class="text-gray-600 dark:text-gray-400 hover:text-blue-600 dark:hover:text-blue-400 font-medium p-3 transition">الرئيسية</a>
                <a href="{{ route('stories.my-stories')}}" class="text-gray-600 dark:text-gray-400 hover:text-blue-600 dark:hover:text-blue-400 font-medium p-3 transition">قصصي</a>
            @endauth
        </div>

        <nav class="hidden md:flex items-center space-x-4 space-x-reverse"> {{-- تغيير space-x-8 إلى space-x-4 وتعديل to space-x-reverse --}}
            @auth
                {{-- اسم المستخدم وصورة البروفايل للمستخدم الحالي --}}
                <a href="{{ route('profile.edit') }}" class="flex items-center group"> {{-- إضافة 'flex items-center group' --}}
                    <div class="w-10 h-10 rounded-full overflow-hidden bg-gray-300 dark:bg-gray-600 flex items-center justify-center ml-2 group-hover:ring-2 group-hover:ring-blue-500 transition ease-in-out duration-150"> {{-- ml-2 للمسافة بين الصورة والاسم --}}
                        @if (Auth::user()->avatar) {{-- استخدم Auth::user() مباشرة إذا كنت في صفحة لا تمرر $user --}}
                            <img src="{{ asset('storage/' . Auth::user()->avatar) }}" alt="User Profile" class="w-full h-full object-cover">
                        @else
                            <img src="{{ asset('storage/avatars/defaultAvatar.jpg') }}" alt="Default User Profile" class="w-full h-full object-cover">
                        @endif
                    </div>
                    <span class="font-medium text-gray-700 dark:text-gray-300 group-hover:text-blue-600 dark:group-hover:text-blue-400 transition ease-in-out duration-150">
                        {{ Auth::user()->name }} {{-- عرض اسم المستخدم --}}
                    </span>
                </a>
            @else
                {{-- زر الدخول والتسجيل للزوار --}}
                <a href="{{ route('login') }}" class="text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 font-medium p-2 transition">
                    دخول
                </a>
                <a href="{{ route('register') }}" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 dark:hover:bg-blue-500 transition font-semibold">
                    تسجيل جديد
                </a>
            @endauth
        </nav>

        <button class="md:hidden text-gray-600 dark:text-gray-400">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16">
                </path>
            </svg>
        </button>
    </div>
</header>

{{-- تذكر أن محتوى الصفحة يجب أن يأتي بعد الهيدر مباشرةً --}}
{{-- مثال: هذا هو الـ div الرئيسي للمحتوى الخاص بصفحة الملف الشخصي --}}
<div class="md:w-1/2 p-8 md:p-1 space-y-8 flex flex-col justify-center mt-12"> {{-- تم إضافة mt-12 كبديل للـ padding-top في الـ body إذا كان الـ body يحتوي على justify-center --}}
    </div>