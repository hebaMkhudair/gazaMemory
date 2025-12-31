<header class="fixed top-0 right-0 left-0 bg-white dark:bg-gray-800 p-4 shadow-md z-40 w-full border-b border-gray-100 dark:border-gray-700">
    <div class="container mx-auto">
        <!-- Desktop and Mobile Top Bar -->
        <div class="flex items-center justify-between gap-4">
            <!-- Logo and Brand + Desktop Navigation -->
            <div class="flex items-center gap-6">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 sm:w-12 sm:h-12 rounded-full overflow-hidden bg-gray-200 dark:bg-gray-700 flex items-center justify-center flex-shrink-0">
                        <img src="{{ asset('assets/img/gazaMemory.png') }}" alt="Logo" class="w-full h-full object-cover">
                    </div>
                    <a href="{{ route('home') }}" class="text-lg sm:text-xl font-semibold text-gray-800 dark:text-gray-100 hover:text-blue-600 dark:hover:text-blue-400 transition">ذاكرة غزة</a>
                </div>

                <!-- Desktop Navigation (inline with logo) -->
                <nav class="hidden md:flex items-center gap-6 border-r border-gray-200 dark:border-gray-700 pr-6">
                    @auth
                        <a href="{{ route('dashboard') }}" class="text-gray-600 dark:text-gray-400 hover:text-blue-600 dark:hover:text-blue-400 font-medium transition">الرئيسية</a>
                        <a href="{{ route('stories.my-stories') }}" class="text-gray-600 dark:text-gray-400 hover:text-blue-600 dark:hover:text-blue-400 font-medium transition">قصصي</a>
                    @endauth
                </nav>
            </div>

            <!-- Right Side Icons (Dark Mode + Auth) -->
            <div class="flex items-center gap-2 sm:gap-4">
                <!-- Dark Mode Toggle -->
                <button id="theme-toggle" type="button" class="p-2 rounded-lg bg-gray-100 dark:bg-gray-700 text-gray-600 dark:text-gray-300 hover:bg-gray-200 dark:hover:bg-gray-600 transition duration-200 flex items-center justify-center flex-shrink-0">
                    <svg id="sun-icon" class="w-5 h-5 hidden dark:flex" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zm4.22 1.78a1 1 0 011.414 0l.707.707a1 1 0 01-1.414 1.414l-.707-.707a1 1 0 010-1.414zm2.828 2.828a1 1 0 011.414 0l.707.707a1 1 0 01-1.414 1.414l-.707-.707a1 1 0 010-1.414zM10 7a3 3 0 110 6 3 3 0 010-6zm-4.22-1.78a1 1 0 011.414 0l.707.707a1 1 0 01-1.414 1.414L5.78 5.22a1 1 0 010-1.414zm2.828 2.828a1 1 0 011.414 0l.707.707a1 1 0 01-1.414 1.414l-.707-.707a1 1 0 010-1.414zM10 18a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zm4.22-1.78a1 1 0 011.414 0l.707.707a1 1 0 01-1.414 1.414l-.707-.707a1 1 0 010-1.414zm2.828-2.828a1 1 0 011.414 0l.707.707a1 1 0 01-1.414 1.414l-.707-.707a1 1 0 010-1.414zM4.22 18.22a1 1 0 011.414 0l.707.707a1 1 0 01-1.414 1.414l-.707-.707a1 1 0 010-1.414zm2.828-2.828a1 1 0 011.414 0l.707.707a1 1 0 01-1.414 1.414l-.707-.707a1 1 0 010-1.414zM4 10a1 1 0 110-2 1 1 0 010 2zm12 0a1 1 0 110-2 1 1 0 010 2z" clip-rule="evenodd"/>
                    </svg>
                    <svg id="moon-icon" class="w-5 h-5 flex dark:hidden" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M17.293 13.293A8 8 0 016.707 2.707a8.001 8.001 0 1010.586 10.586z"/>
                    </svg>
                </button>

                <!-- Mobile Menu Button -->
                <button id="mobile-menu-btn" type="button" class="md:hidden p-2 rounded-lg bg-gray-100 dark:bg-gray-700 text-gray-600 dark:text-gray-300 hover:bg-gray-200 dark:hover:bg-gray-600 transition flex-shrink-0">
                    <svg id="menu-icon" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                    </svg>
                    <svg id="close-icon" class="w-6 h-6 hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>

                <!-- Desktop Auth Links -->
                @auth
                    <a href="{{ route('profile.edit') }}" class="hidden md:flex items-center gap-2 group">
                        <div class="w-9 h-9 rounded-full overflow-hidden bg-gray-300 dark:bg-gray-600 flex items-center justify-center group-hover:ring-2 group-hover:ring-blue-500 transition flex-shrink-0">
                            @if (Auth::user()->avatar)
                                <img src="{{ asset('storage/' . Auth::user()->avatar) }}" alt="User Profile" class="w-full h-full object-cover">
                            @else
                                <img src="{{ asset('storage/avatars/defaultAvatar.jpg') }}" alt="Default User Profile" class="w-full h-full object-cover">
                            @endif
                        </div>
                        <span class="hidden lg:inline font-medium text-gray-700 dark:text-gray-300 group-hover:text-blue-600 dark:group-hover:text-blue-400 transition">
                            {{ Auth::user()->name }}
                        </span>
                    </a>
                @else
                    <a href="{{ route('login') }}" class="hidden sm:inline text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 font-medium p-2 transition text-sm">
                        دخول
                    </a>
                    <a href="{{ route('register') }}" class="hidden sm:inline bg-blue-600 text-white px-3 sm:px-4 py-2 rounded-lg hover:bg-blue-700 dark:bg-blue-600 dark:hover:bg-blue-500 transition font-semibold text-sm">
                        تسجيل
                    </a>
                @endauth
            </div>
        </div>

        <!-- Mobile Navigation Menu -->
        <nav id="mobile-nav" class="hidden md:hidden mt-4 pb-4 border-t border-gray-200 dark:border-gray-700 pt-4">
            @auth
                <a href="{{ route('dashboard') }}" class="block px-4 py-2 text-gray-600 dark:text-gray-400 hover:text-blue-600 dark:hover:text-blue-400 font-medium">الرئيسية</a>
                <a href="{{ route('stories.my-stories') }}" class="block px-4 py-2 text-gray-600 dark:text-gray-400 hover:text-blue-600 dark:hover:text-blue-400 font-medium">قصصي</a>
                <a href="{{ route('profile.edit') }}" class="block px-4 py-2 text-gray-600 dark:text-gray-400 hover:text-blue-600 dark:hover:text-blue-400 font-medium">الملف الشخصي</a>
                <form method="POST" action="{{ route('logout') }}" class="block">
                    @csrf
                    <button type="submit" class="w-full text-right px-4 py-2 text-gray-600 dark:text-gray-400 hover:text-red-600 dark:hover:text-red-400 font-medium">
                        تسجيل الخروج
                    </button>
                </form>
            @else
                <a href="{{ route('login') }}" class="block px-4 py-2 text-gray-600 dark:text-gray-400 hover:text-blue-600 dark:hover:text-blue-400 font-medium">
                    دخول
                </a>
                <a href="{{ route('register') }}" class="block px-4 py-2 text-gray-600 dark:text-gray-400 hover:text-blue-600 dark:hover:text-blue-400 font-medium">
                    تسجيل جديد
                </a>
            @endauth
        </nav>
    </div>
</header>