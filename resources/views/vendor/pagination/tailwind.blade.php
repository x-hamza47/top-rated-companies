@if ($paginator->hasPages())
    <nav role="navigation" aria-label="{{ __('Pagination Navigation') }}" class="flex items-center justify-between gap-4 flex-wrap">

        {{-- Mobile --}}
        <div class="flex justify-between flex-1 sm:hidden gap-2">
            @if ($paginator->onFirstPage())
                <span class="px-4 py-2 text-sm rounded-md border border-(--color-border) text-(--color-text-muted) cursor-default bg-(--color-surface)">
                    Previous
                </span>
            @else
                <a href="{{ $paginator->previousPageUrl() }}" class="px-4 py-2 text-sm rounded-md border border-(--color-border) text-(--color-text) bg-(--color-surface) hover:bg-(--color-surface-hover) transition-colors">
                    Previous
                </a>
            @endif

            @if ($paginator->hasMorePages())
                <a href="{{ $paginator->nextPageUrl() }}" class="px-4 py-2 text-sm rounded-md border border-(--color-border) text-(--color-text) bg-(--color-surface) hover:bg-(--color-surface-hover) transition-colors">
                    Next
                </a>
            @else
                <span class="px-4 py-2 text-sm rounded-md border border-(--color-border) text-(--color-text-muted) cursor-default bg-(--color-surface)">
                    Next
                </span>
            @endif
        </div>

        {{-- Desktop --}}
        <div class="hidden sm:flex sm:items-center sm:justify-between flex-1 gap-4">

            {{-- Result count --}}
            <p class="text-sm text-(--color-text-muted)">
                Showing
                <span class="font-semibold text-(--color-text)">{{ $paginator->firstItem() }}</span>
                to
                <span class="font-semibold text-(--color-text)">{{ $paginator->lastItem() }}</span>
                of
                <span class="font-semibold text-(--color-text)">{{ $paginator->total() }}</span>
                results
            </p>

            {{-- Page buttons --}}
            <div class="flex items-center gap-1">

                {{-- Prev --}}
                @if ($paginator->onFirstPage())
                    <span class="w-9 h-9 flex items-center justify-center rounded-md border border-(--color-border) text-(--color-text-muted) cursor-default bg-(--color-surface)">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" />
                        </svg>
                    </span>
                @else
                    <a href="{{ $paginator->previousPageUrl() }}" class="w-9 h-9 flex items-center justify-center rounded-md border border-(--color-border) text-(--color-text) bg-(--color-surface) hover:bg-(--color-surface-hover) transition-colors">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" />
                        </svg>
                    </a>
                @endif

                {{-- Page numbers --}}
                @foreach ($elements as $element)
                    @if (is_string($element))
                        <span class="w-9 h-9 flex items-center justify-center text-sm text-(--color-text-muted)">{{ $element }}</span>
                    @endif

                    @if (is_array($element))
                        @foreach ($element as $page => $url)
                            @if ($page == $paginator->currentPage())
                                <span class="w-9 h-9 flex items-center justify-center rounded-md text-sm font-semibold bg-(--color-primary) text-white cursor-default">
                                    {{ $page }}
                                </span>
                            @else
                                <a href="{{ $url }}" class="w-9 h-9 flex items-center justify-center rounded-md text-sm text-(--color-text) border border-(--color-border) bg-(--color-surface) hover:bg-(--color-surface-hover) transition-colors">
                                    {{ $page }}
                                </a>
                            @endif
                        @endforeach
                    @endif
                @endforeach

                {{-- Next --}}
                @if ($paginator->hasMorePages())
                    <a href="{{ $paginator->nextPageUrl() }}" class="w-9 h-9 flex items-center justify-center rounded-md border border-(--color-border) text-(--color-text) bg-(--color-surface) hover:bg-(--color-surface-hover) transition-colors">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                        </svg>
                    </a>
                @else
                    <span class="w-9 h-9 flex items-center justify-center rounded-md border border-(--color-border) text-(--color-text-muted) cursor-default bg-(--color-surface)">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                        </svg>
                    </span>
                @endif

            </div>
        </div>
    </nav>
@endif