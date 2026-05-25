@extends('shared.main')
@push('styles')
    @vite('resources/css/listicle.css')
@endpush
@section('title', $insight->title . ' | Top Firms Reviewer')
@section('meta_description', $insight->meta_description ?? '')

@section('content')

    <section class="w-full bg-(--color-background) py-8 md:py-10 md:px-8 sm:px-6 px-4">

        <div class="max-w-7xl mx-auto flex gap-6">

            {{-- ── LEFT: TABLE OF CONTENTS ──────────────────────────────── --}}
            @if ($toc->count())
                <aside class="w-[30%] hidden lg:block">
                    <div class="sticky top-28 bg-(--color-surface) rounded-xl shadow-md p-6 border border-(--color-border)">

                        <h3 class="text-lg font-bold text-(--color-text) mb-4 border-b pb-3 shrink-0">
                            What You'll Learn
                        </h3>

                        <ul class="space-y-1 text-sm text-(--color-text-muted) overflow-y-auto max-h-[calc(100vh-15rem)]"
                            id="toc-list">
                            @foreach ($toc as $item)
                                <li style="padding-left: {{ ($item['level'] - 2) * 12 }}px">
                                    <a href="#{{ $item['anchor'] }}"
                                        class="toc-link block py-2 border-b border-(--color-border) hover:text-(--color-primary) transition leading-snug
                                {{ $item['level'] === 2 ? 'font-semibold text-(--color-muted)' : 'font-normal text-(--color-text-muted)' }}"
                                        data-anchor="{{ $item['anchor'] }}">
                                        {{ $item['text'] }}
                                    </a>
                                </li>
                            @endforeach
                        </ul>

                    </div>
                </aside>
            @endif

            <article class="flex-1 min-w-0 mt-20">

                {{-- ── HERO CARD ─────────────────────────────────────────── --}}
                <div class="bg-(--color-surface) rounded-xl overflow-hidden shadow-xl">

                    @if ($insight->thumbnail_url)
                        <img src="{{ $insight->thumbnail_url }}" alt="{{ $insight->title }}"
                            class="w-full max-h-[380px] object-cover">
                    @endif

                    <div class="p-8">

                        <h1 class="text-3xl md:text-4xl font-bold text-(--color-primary)">
                            {{ $insight->title }}
                        </h1>

                        <div class="flex flex-wrap items-center gap-6 text-sm text-(--color-text) mt-4">

                            {{-- Author --}}
                            @if ($insight->author)
                                <div class="flex items-center gap-2">
                                    <div class="w-10 h-10 rounded-full overflow-hidden shrink-0">
                                        @if ($insight->author->image)
                                            <img src="{{ asset('storage/' . $insight->author->image) }}"
                                                alt="{{ $insight->author->name }}" class="w-full h-full object-cover">
                                        @else
                                            <div class="w-full h-full flex items-center justify-center font-bold text-white text-base"
                                                style="background: var(--color-primary)">
                                                {{ strtoupper(substr($insight->author->name, 0, 1)) }}
                                            </div>
                                        @endif
                                    </div>
                                    <span class="font-medium">
                                        By {{ $insight->author->name }}
                                        @if ($insight->author->designation)
                                            · <span
                                                class="text-(--color-primary)">{{ $insight->author->designation }}</span>
                                        @endif
                                    </span>
                                </div>
                            @endif

                            {{-- Date --}}
                            <div class="flex items-center gap-2">
                                <i class="fas fa-calendar-alt text-(--color-primary)"></i>
                                <time datetime="{{ $insight->created_at->toDateString() }}">
                                    {{ $insight->created_at->format('M d, Y') }}
                                </time>
                            </div>

                            {{-- Read Time --}}
                            @if ($insight->read_time)
                                <div class="flex items-center gap-2">
                                    <i class="fas fa-clock text-(--color-primary)"></i>
                                    <span>{{ $insight->read_time }} min read</span>
                                </div>
                            @endif

                        </div>

                        {{-- Excerpt --}}
                        @if ($insight->excerpt)
                            <p class="text-sm text-(--color-text-muted) mt-3 leading-relaxed">
                                {{ $insight->excerpt }}
                            </p>
                        @endif

                        {{-- Service Badge --}}
                        @if ($insight->service)
                            <span
                                class="inline-block text-xs font-bold uppercase tracking-wider px-3 py-1 rounded-full my-4"
                                style="background: color-mix(in srgb, var(--color-primary) 12%, transparent); color: var(--color-primary)">
                                {{ $insight->service->name }}
                            </span>
                        @endif

                    </div>
                </div>

                {{-- ── EDITORJS CONTENT ──────────────────────────────────── --}}
                <div class="bg-(--color-surface) rounded-xl shadow-xl mt-8 p-8 md:p-10">
                    <x-editorjs-renderer :blocks="$contentJson['blocks'] ?? []" />

                    {{-- ── AUTHOR BOX ────────────────────────────────────── --}}
                    @if ($insight->author)
                        <section class="mt-12 pt-8 border-t border-(--color-border)">
                            <div class="flex flex-col md:flex-row gap-6 items-start">

                                <div class="w-20 h-20 rounded-full overflow-hidden shrink-0">
                                    @if ($insight->author->image)
                                        <img src="{{ asset('storage/' . $insight->author->image) }}"
                                            class="w-full h-full object-cover" alt="{{ $insight->author->name }}">
                                    @else
                                        <div class="w-full h-full flex items-center justify-center font-bold text-white text-2xl"
                                            style="background: var(--color-primary)">
                                            {{ strtoupper(substr($insight->author->name, 0, 1)) }}
                                        </div>
                                    @endif
                                </div>

                                <div class="flex-1">

                                    @if ($insight->author->designation)
                                        <p class="text-base text-(--color-primary) font-semibold mb-1">
                                            {{ $insight->author->designation }}
                                        </p>
                                    @endif

                                    <h3 class="text-4xl font-bold text-(--color-primary)">
                                        {{ $insight->author->name }}
                                    </h3>

                                    <p class="text-xs text-(--color-text-muted) mt-1 mb-4">
                                        Browse all articles
                                        ({{ $insight->author->insights()->where('is_published', true)->count() }})
                                    </p>

                                    @if ($insight->author->bio)
                                        <p class="text-base text-(--color-text) leading-relaxed">
                                            {{ $insight->author->bio }}
                                        </p>
                                    @endif

                                    @if ($insight->author->linkedin_url || $insight->author->twitter_url)
                                        <div class="flex gap-4 mt-4">
                                            @if ($insight->author->linkedin_url)
                                                <a href="{{ $insight->author->linkedin_url }}" target="_blank"
                                                    class="text-sm font-bold text-(--color-primary) hover:text-(--color-secondary) transition flex items-center gap-1">
                                                    <i class="fab fa-linkedin"></i> LinkedIn
                                                </a>
                                            @endif
                                            @if ($insight->author->twitter_url)
                                                <a href="{{ $insight->author->twitter_url }}" target="_blank"
                                                    class="text-sm font-bold text-(--color-primary) hover:text-(--color-secondary) transition flex items-center gap-1">
                                                    <i class="fab fa-twitter"></i> Twitter
                                                </a>
                                            @endif
                                        </div>
                                    @endif

                                </div>
                            </div>
                        </section>
                    @endif
                </div>

                {{-- ── BACK LINK ─────────────────────────────────────────── --}}
                <div class="mt-8">
                    <a href="{{ route('insights.list') }}"
                        class="inline-flex items-center gap-2 text-sm font-bold text-(--color-primary) hover:text-(--color-secondary) transition">
                        <i class="fas fa-arrow-left"></i>
                        Back to Insights
                    </a>
                </div>

            </article>

        </div>

    </section>

    {{-- ── RELATED INSIGHTS ────────────────────────────────────────────── --}}
    @if ($relatedInsights->count())
        <section class="w-full mt-14 bg-(--color-background) py-8 md:py-10 md:px-12 sm:px-6 px-4">

            <div class="max-w-7xl mx-auto">

                <div class="mb-8">
                    <h2 class="text-3xl md:text-4xl font-bold text-(--color-text)">
                        Read <span class="text-(--color-primary)">Next</span>
                    </h2>
                    <p class="text-gray-500 mt-2 text-sm">More insights you might find useful</p>
                </div>

                <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach ($relatedInsights as $related)
                        <article
                            class="outline-2 outline-gray-500/55 hover:outline-(--color-primary) bg-(--color-surface) rounded-md overflow-hidden hover:scale-[1.01] hover:shadow-2xl transition-all duration-300">

                            {{-- Thumbnail --}}
                            <a href="{{ route('insights.showInsight', $related->slug) }}" class="block overflow-hidden">
                                @if ($related->thumbnail_url)
                                    <img src="{{ $related->thumbnail_url }}" alt="{{ $related->title }}"
                                        class="h-48 w-full object-cover transition-transform duration-500 hover:scale-105"
                                        loading="lazy" decoding="async">
                                @else
                                    <div
                                        class="h-48 w-full bg-linear-to-br from-gray-100 to-gray-200 flex items-center justify-center">
                                        <i class="fas fa-image text-4xl text-gray-300"></i>
                                    </div>
                                @endif
                            </a>

                            <div class="p-6">

                                {{-- Meta row --}}
                                <div
                                    class="flex items-center justify-between text-xs uppercase tracking-widest text-gray-400 mb-2">
                                    <time datetime="{{ $related->created_at->toDateString() }}">
                                        {{ $related->created_at->format('M d, Y') }}
                                    </time>

                                    @if ($related->author)
                                        <div class="flex items-center gap-2 normal-case tracking-normal">
                                            <div class="w-6 h-6 rounded-full overflow-hidden shrink-0">
                                                @if ($related->author->image)
                                                    <img src="{{ asset('storage/' . $related->author->profile_image) }}"
                                                        class="w-full h-full object-cover"
                                                        alt="{{ $related->author->name }}">
                                                @else
                                                    <div class="w-6 h-6 rounded-full flex items-center justify-center text-[10px] font-bold text-white"
                                                        style="background: var(--color-primary)">
                                                        {{ strtoupper(substr($related->author->name, 0, 1)) }}
                                                    </div>
                                                @endif
                                            </div>
                                            <span class="text-gray-500 font-medium">{{ $related->author->name }}</span>
                                        </div>
                                    @endif
                                </div>

                                {{-- Service Badge --}}
                                @if ($related->service)
                                    <span
                                        class="inline-block text-[10px] font-bold uppercase tracking-wider px-2 py-1 rounded-full mb-2"
                                        style="background: color-mix(in srgb, var(--color-primary) 10%, transparent); color: var(--color-primary)">
                                        {{ $related->service->name }}
                                    </span>
                                @endif

                                {{-- Title --}}
                                <h3 class="text-lg font-bold text-(--color-secondary) mb-2 line-clamp-2">
                                    <a href="{{ route('insights.showInsight', $related->slug) }}"
                                        class="hover:text-(--color-primary) transition">
                                        {{ $related->title }}
                                    </a>
                                </h3>

                                {{-- Description --}}
                                @if ($related->excerpt)
                                    <p class="text-sm text-gray-500 leading-relaxed line-clamp-2">
                                        {{ $related->excerpt }}
                                    </p>
                                @endif

                                <a href="{{ route('insights.showInsight', $related->slug) }}"
                                    class="inline-block mt-4 text-sm font-bold text-(--color-primary) hover:text-(--color-secondary) transition">
                                    Read More →
                                </a>

                            </div>
                        </article>
                    @endforeach
                </div>

            </div>
        </section>
    @endif

@endsection

@push('scripts')
    <script>
        (function() {
            const links = document.querySelectorAll('.toc-link');
            const anchors = [...links].map(l => document.getElementById(l.dataset.anchor));

            if (!links.length) return;

            const onScroll = () => {
                let current = 0;
                anchors.forEach((el, i) => {
                    if (el && el.getBoundingClientRect().top <= 170) current = i;
                });

                links.forEach((l, i) => l.classList.toggle('active', i === current));

                const activeLink = links[current];
                if (activeLink) {
                    activeLink.closest('#toc-list')?.scrollTo({
                        top: activeLink.offsetTop - 80,
                        behavior: 'smooth'
                    });
                }
            };

            window.addEventListener('scroll', onScroll, { passive: true });
            onScroll();
        })();
    </script>
@endpush
