@if ($paginator->hasPages())
    <nav role="navigation" aria-label="تنقل الصفحات" class="flex items-center justify-center">
        <ul class="inline-flex items-center -space-x-px flex-row-reverse">
            {{-- First Page Link (الأول) --}}
            @if ($paginator->onFirstPage())
                <li aria-disabled="true" aria-label="الأول">
                    <span class="px-3 py-1 rounded-md bg-gray-100 text-gray-400">« الأول</span>
                </li>
            @else
                <li>
                    <a href="{{ $paginator->url(1) }}" rel="first" class="px-3 py-1 rounded-md bg-white border hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 transition">« الأول</a>
                </li>
            @endif

            {{-- Previous Page Link (السابق) --}}
            @if ($paginator->onFirstPage())
                <li aria-disabled="true" aria-label="السابق">
                    <span class="px-3 py-1 text-gray-400">السابق</span>
                </li>
            @else
                <li>
                    <a href="{{ $paginator->previousPageUrl() }}" rel="prev" class="px-3 py-1 bg-white border hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 transition">السابق</a>
                </li>
            @endif

            {{-- Pagination Elements (أرقام الصفحات) --}}
            @foreach ($elements as $element)
                @if (is_string($element))
                    <li aria-disabled="true"><span class="px-3 py-1">{{ $element }}</span></li>
                @endif

                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li aria-current="page"><span class="px-3 py-1 bg-indigo-600 text-white rounded-md">{{ $page }}</span></li>
                        @else
                            <li><a href="{{ $url }}" class="px-3 py-1 bg-white border hover:bg-gray-50 rounded-md transition">{{ $page }}</a></li>
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- Next Page Link (التالي) --}}
            @if ($paginator->hasMorePages())
                <li>
                    <a href="{{ $paginator->nextPageUrl() }}" rel="next" class="px-3 py-1 bg-white border hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 transition">التالي</a>
                </li>
            @else
                <li aria-disabled="true" aria-label="التالي">
                    <span class="px-3 py-1 text-gray-400">التالي</span>
                </li>
            @endif

            {{-- Last Page Link (الأخير) --}}
            @if ($paginator->hasMorePages())
                <li>
                    <a href="{{ $paginator->url($paginator->lastPage()) }}" rel="last" class="px-3 py-1 rounded-md bg-white border hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 transition">الأخير »</a>
                </li>
            @else
                <li aria-disabled="true" aria-label="الأخير">
                    <span class="px-3 py-1 rounded-md bg-gray-100 text-gray-400">الأخير »</span>
                </li>
            @endif
        </ul>
    </nav>
@endif
